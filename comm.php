<?php
    // error_reporting(0);
	session_start();
	define('APPID', 'wx24006a371badc06e');
	define('APPSECRET', '1738b173b4911ec0e84f2c74a1fafe30');
	
    function skip($path) {
        header('Location:'.$path);
    }

    function __autoload($classname) {
        $destination = CONTROLLER.$classname.SURFIX;
        if (file_exists($destination)) {
            require_once $destination;
        } else {
            throw new Exception("Wrong C");
        }
    }
    
	function getJson($url){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($ch);
	    curl_close($ch);
	    return json_decode($output, true);
	}

	function getLink(){
		require 'api/DBlink.func.php';
		$link = new DBlink('shiyi');
		$link = $link->connect;
		return $link;
	}

	function curl( $url , $postFields = NULL )
    {
        $ch = curl_init();
        curl_setopt( $ch , CURLOPT_TIMEOUT , 3 );
        curl_setopt( $ch , CURLOPT_URL , $url );
        curl_setopt( $ch , CURLOPT_FAILONERROR , FALSE );
        curl_setopt( $ch , CURLOPT_RETURNTRANSFER , TRUE );
        //https 请求
        if ( strlen( $url ) > 5 && strtolower( substr( $url , 0 , 5 ) ) == 'https' ){
            curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , FALSE );
            curl_setopt( $ch , CURLOPT_SSL_VERIFYHOST , FALSE );
        }

        if ( $postFields != NULL ){
            curl_setopt( $ch , CURLOPT_POST , TRUE );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $postFields );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json',
			    'Content-Length: ' . strlen($postFields))
			);
        }

        $reponse = curl_exec( $ch );
        curl_close( $ch );
        return $reponse;
    }

    define('TOKENROOT',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
    $wx_url = 'https://api.weixin.qq.com/cgi-bin';
    //获取微信token
    //远程获取 微信token
    function curl_get_weixin_token(){
        //去微信获取，然后保存
        $TOKEN = curl('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET);
        $TOKEN_json = json_decode($TOKEN,true);
        $TOKEN_json['get_token_time'] = time();
        file_put_contents(weixin_token_file(),json_encode($TOKEN_json));//保存到本地
        return $TOKEN_json;
    }
    //本地获取 微信token（如果不成功或者超时，就去远程获取）
    function file_get_weixin_token($now_time){
        //去微信获取，然后保存
        $get_local_token = file_get_contents(weixin_token_file());
        $token_array = json_decode($get_local_token,true);
        //判断本地的weixin_token是否存在
        if( !is_array($token_array) || !isset($token_array['get_token_time']) || !isset($token_array['access_token']) ){
            //去微信获取，然后保存
            $token_array = curl_get_weixin_token();
        }
        else{
            //判断 当前时间 减去 本地获取微信token的时间 大于7000秒 ,就要重新获取
            if( $now_time - $token_array['get_token_time'] >7000 ){
                $token_array = curl_get_weixin_token();
            }
        }
        return $token_array;
    }
    
    function weixin_token_file(){
        return TOKENROOT.'log/weixin/get_token.txt';
    }
