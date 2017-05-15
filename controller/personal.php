<?php
class personal extends Controller
{
	function __construct() {
		require CORE.'TBLink.php';
		$this->userinfo = new TBLink('userinfo');
	}

	function index() {
		$link = DBLink::$connect;
		$row = $this->userinfo->select(['nickname','head_photo'])->where([['id',$_SESSION['userId']]])->first();
		$data['nickname'] = $row['nickname'];
		$data['head_photo'] = $row['head_photo'];
		$sql = 'SELECT count(0) as count from msg as b,userinfo as a where b.recId = '.$_SESSION['userId'].' and a.id = b.sendId and b.status = 0';
		$rs = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($rs);
		$data['unread'] = $row['count'];
		$this->display('personal.php',$data);
	}
}
?>