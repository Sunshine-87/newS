<?php
class qiubangzhu extends Controller
{
	function __construct() {
		require CORE.'TBLink.php';
		$this->qiubangzhu = new TBLink('course');
	}

	function index() {
		$link = DBLink::$connect;
		$sql = "SELECT b.content,b.time,b.id,b.title,b.publish_time,b.payment,b.price from userInfo as a,course as b where a.id = b.userId and b.status = 0";
		$result = mysqli_query($link, $sql);
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			if ($row['payment'] == 2) {
				$price = '议价';
			} else {
				$price = $row['price'];
			}
			$publish_time = date('m-d',$row['publish_time']);
			if (mb_strlen($row['content']) > 15) {
				$row['content'] = mb_substr($row['content'], 0, 15);
				$row['long'] = true;
			} else {
				$row['long'] = false;
			}
			array_push($json, array('id' => $row['id'], 'title' => $row['title'], 'publish_time' =>$publish_time, 'price' =>$price, 'time' => $row['time'], 'content' => $row['content'], 'long' => $row['long']));
		}
		$data['qiubangzhu'] = $json;
		$this->display('list/qiubangzhu.php' ,$data);
	}

	function detail() {
		$link = DBLink::$connect;
		$sql = "SELECT a.nickname,b.userId,b.id,a.grade,b.title,b.publish_time,b.content from userInfo as a,course as b where a.id = b.userId and b.id = ".$_GET['id'];
		$result = mysqli_query($link, $sql);
		$json = array();
		$row = mysqli_fetch_array($result);
		$mine = ($_SESSION['userId'] == $row['userId']) ? 1 : 0;
		$row['mine'] = $mine;
		if ($mine == 1) {
			$source = '1'.$_GET['id'];
			$sql = "SELECT distinct(a.sendId),b.nickname from msg as a,userinfo as b where source = '$source' and a.sendId = b.id";
			$rs = mysqli_query($link, $sql);
			$contactors = array();
			while ($rrow = mysqli_fetch_array($rs)) {
				array_push($contactors, array('id' => $rrow['sendId'], 'nickname' =>$rrow['nickname']));
			}
			$row['contactors'] = $contactors;
		}
		$data['detail'] = $row;
		$this->display('detail/qiubangzhu.php',$data);
	}
}
?>