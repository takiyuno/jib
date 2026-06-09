<?php
	error_reporting(0);

	 $dbhost = "localhost";
	//$dbuser = "admin_motorfix";
	//$dbpasswd = "hello2528";
	//$dbname = "admin_motorfix";

	$dbuser = "root";
	$dbpasswd = "12345678";
	$dbname = "motorfix";
	$config = mysqli_connect($dbhost, $dbuser, $dbpasswd, $dbname);
	if (!$config) {
		trigger_error(mysqli_connect_error(), E_USER_ERROR);
	}
	mysqli_set_charset($config, 'utf8');
	date_default_timezone_set('Asia/Bangkok');
	session_start();

?>