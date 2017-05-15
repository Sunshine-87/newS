<?php
class xiaojishi extends Controller
{
	function __construct() {
		require CORE.'TBLink.php';
		$this->jishi = new TBLink('jishi');
	}

	function index() {
		$link = DBLink::$connect;
		$sql = 'SELECT a.id,a.title,a.content,a.image,a.payment,a.price,a.publish_time from jishi as a,userinfo as b where a.userId = b.id and a.status = 0';
		$rs = mysqli_query($link,$sql);
		$result = mysqli_query($link, $sql);
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			$imageIds = explode(',', $row['image']);
			if (!empty($imageIds)) {
				$imageId = $imageIds[0];
			}
			$image_table = new TBLink('image');
			$imageRs = $image_table->where([['id', $imageId]])->first();
			$imageUrl = $imageRs['url'];
			$row['imageUrl'] = $imageUrl;
			if (mb_strlen($row['content']) > 15) {
				$row['content'] = mb_substr($row['content'], 0, 15);
				$row['long'] = true;
			}
			array_push($json, $row);
		}
		$data['jishi']  = $json;
		$this->display('list/xiaojishi.php' ,$data);
	}

	function detail() {
		$link = DBLink::$connect;
		$sql = "SELECT a.nickname,b.userId,b.image,b.id,a.grade,b.title,b.publish_time,b.content from userInfo as a,jishi as b where a.id = b.userId and b.id = ".$_GET['id'];
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($result);
		$imagestr = $row['image'];
		$imagearr = explode(',', $imagestr);
		$imgurlarr = array();
		$mine = ($_SESSION['userId'] == $row['userId']) ? 1 : 0;
		$json = array('content' => $row['content'], 'id' => $row['id'], 'title' => $row['title'], 'publish_time' =>$row['publish_time'], 'grade' =>$row['grade'], 'nickname' => $row['nickname'], 'userId' => $row['userId'], 'mine' => $mine);
		if ($mine == 1) {
			$source = '3'.$_GET['id'];
			$sql = "SELECT distinct(a.sendId),b.nickname from msg as a,userinfo as b where source = '$source' and a.sendId = b.id";
			$rs = mysqli_query($link, $sql);
			$contactors = array();
			while ($row = mysqli_fetch_array($rs)) {
				array_push($contactors, array('id' => $row['sendId'], 'nickname' =>$row['nickname']));
			}
			$json['contactors'] = $contactors;
		}
		foreach ($imagearr as $imageid) {
			$sql = "SELECT url from image where id = $imageid";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_array($result);
			array_push($imgurlarr, $row['url']);
		}
		$json['image'] = $imgurlarr;
		$data['detail'] = $json;
		$this->display('detail/xiaojishi.php', $data);
	}
}
?>