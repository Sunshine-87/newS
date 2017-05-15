<?php
	require_once 'comm.php';
	$config = parse_ini_file('.env');
	require_once 'define.php';

	date_default_timezone_set('PRC');

	// $Auth = new Auth();
	// $login = $Auth->Login();
	$_SESSION['userId'] = 23;

	$c = isset($_GET['c']) ? $_GET['c'] : 'qiubangzhu';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index';

	$controller = new $c();

	try {
		$controller -> $method();
	} catch (Exception $e) {
		throw $e;
	}
	
?>