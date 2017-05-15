<?php
class Auth
{
	function __construct() {
		session_start();
		require CORE.'TBLink.php';
		$this->userinfo = new TBLink('userinfo');
	}

	function Login() {
		if (!isset($_SESSION['userId'])) {
			if (isset($_GET['code'])) {
				$appid = APPID;  
				$secret = APPSECRET;  
				$code = $_GET["code"];
				$now_time = time();
				$token = file_get_weixin_token($now_time);
				$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
				$oauth2 = getJson($oauth2Url);
				$access_token = $token['access_token'];  
				$openid = $oauth2['openid'];  
				$get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
				$userinfo = getJson($get_user_info_url);
				$link = getLink();
				$nickname = $userinfo['nickname'];
				$head_photo = $userinfo['headimgurl'];
				$sex = $userinfo['sex'];
				$row = $this->userinfo->select(['id','nickname','head_photo'])->where([['openid',$openid]])->first();
				if (!empty($row)) {
					$this->loginA($row);
				} else {
					$this->register($nickname,$head_photo,$sex,$openid,$row);
				}
			} else {
				exit('server error');
			}
		}
	}

	function loginA($row) {
		$link = DBLink::$connect;
		$today = date('Y-m-d');
		$sql = "UPDATE userinfo SET last_login = '$today' WHERE id = ".$row['id'];
		mysqli_query($link, $sql);

		$sql = "SELECT count(0) from userinfo where last_login = '$today'";
		$rs = mysqli_query($link, $sql);
		$shuliang = mysqli_fetch_row($rs);

		$sql = "SELECT count(0) from rihuo where date = '$today'";
		$rs = mysqli_query($link, $sql);
		$cunzai = mysqli_fetch_row($rs);

		if ($cunzai[0] != 0) {
			$sql = "UPDATE rihuo SET login_num = '$shuliang[0]' where date = '$today'";
		} else {
			$sql = "INSERT INTO rihuo SET login_num = '$shuliang[0]', date = '$today'";
		}

		$rs = mysqli_query($link, $sql); 
		$_SESSION['userId'] = $row['id'];
	}

	function register($nickname,$head_photo,$sex,$openid,$row) {
		$link = DBLink::$connect;
		if (isset($row['id'])) {
			$sql = "UPDATE `userinfo` set nickname = '$nickname', head_photo = '$head_photo' where openid = '$openid'";
		} else {
			$today = date('Y-m-d');
			$sql = "INSERT INTO `userinfo`(`openid`, `nickname`, `head_photo`, `sex`, `last_login`) VALUES ('$openid','$nickname','$head_photo','$sex','$today')";
		}
		if(mysqli_query($link, $sql) == true ) {
			$_SESSION['userId'] = mysqli_insert_id($link);
			header('index.php?c=qiubangzhu&m=index');
			exit;
		} else {
			header('index.php?p=error');
		}
	}
}
?>