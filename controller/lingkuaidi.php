<?php
class lingkuaidi extends Controller
{
	function __construct() {
		require CORE.'TBLink.php';
		$this->kuaidi = new TBLink('kuaidi');
	}

	function index() {
		$link = DBLink::$connect;
		$now = time();
		$sql = "SELECT b.kuaidiTime,b.id,a.nickname,b.place,b.publish_time from userInfo as a,kuaidi as b where a.id = b.userId  and b.status = 0 and b.kuaidiTime>$now";
		$result = mysqli_query($link, $sql);
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			$publish_time = date('m-d',$row['publish_time']);
			$kuaidiTime = date('m-d H:i',$row['kuaidiTime']);
			array_push($json, array('nickname' => $row['nickname'], 'place' =>$row['place'],'id'=>$row['id'],'publish_time'=>$publish_time,'kuaidiTime'=>$kuaidiTime));
		}
		$data['kuaidi']  = $json;
		$this->display('list/lingkuaidi.php' ,$data);
	}

	function detail() {
		$link = DBLink::$connect;
		$sql = "SELECT a.nickname,a.head_photo,b.destination,b.place,b.kuaidiTime,b.userId,b.getTime from userInfo as a,kuaidi as b where a.id = b.userId and b.id = ".$_GET['id'];
		$result = mysqli_query($link, $sql);
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			$kuaidiTime = date('Y-m-d H:i',$row['kuaidiTime']);
			$getTime = date('Y-m-d H:i',$row['getTime']);
			$mine = ($_SESSION['userId'] == $row['userId']) ? 1 : 0;
			$json= array('nickname' => $row['nickname'], 'place' =>$row['place'], 'kuaidiTime'=>$kuaidiTime, 'getTime'=>$getTime, 'userId' => $row['userId'], 'mine' =>$mine ,'destination' => $row['destination'], 'head_photo' => $row['head_photo']);
			if ($mine == 1) {
				$source = '2'.$_GET['id'];
				$sql = "SELECT distinct(a.sendId),b.nickname from msg as a,userinfo as b where source = '$source' and a.sendId = b.id";
				$rs = mysqli_query($link, $sql);
				$contactors = array();
				while ($row = mysqli_fetch_array($rs)) {
					array_push($contactors, array('id' => $row['sendId'], 'nickname' =>$row['nickname']));
				}
				$json['contactors'] = $contactors;
			}
		}
		$data['detail'] = $json;
		$this->display('detail/lingkuaidi.php', $data);
	}
}
?>