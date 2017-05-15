<?php
	define('SURFIX', '.php');
	define('ROOT', __DIR__);
	define('CONTROLLER', ROOT.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR);
	define('CORE', ROOT.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR);
	define('TPL', ROOT.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR);
	define('DBNAME', $config['DB_NAME']);
	define('DBHOST', $config['DB_HOST']);
	define('DBUSERNAME', $config['DB_USERNAME']);
	define('DBPASSWORD', $config['DB_PASSWORD']);
?>