<?php
function getDb(): PDO
{
	$dsn = 'mysql:dbname=bento; host=127.0.0.1; charset=utf8';
	$usr = 'root';
	$passwd = '12345';
	$db = new PDO($dsn, $usr, $passwd);
	return $db;
}
