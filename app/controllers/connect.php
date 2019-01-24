<?php
	require_once 'constants.php';
	$conn = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8mb4', DBUSER, DBPASS);
?>