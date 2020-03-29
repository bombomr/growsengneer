<?php
require_once('../private/ge_conf.php');

function db_connect() {
	$db['user'] = DB_USER;
	$db['host'] = DB_HOST;
	$db['pass'] = DB_PASSWORD;
	$db['dbname'] = DB_NAME;
	$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $db['host'], $db['dbname']);

	try {
		$dbh = new PDO($dsn, $db['user'], $db['pass'],
			array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		return $dbh;
	} catch (PDOException $e) {
		print('Error: '.$e->getMessage());
		die();
	}
}
?>
