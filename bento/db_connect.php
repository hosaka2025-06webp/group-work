<?php
function getDb(): PDO
{
	$dsn = 'mysql53.conoha.ne.jp; charset=utf8';
	$usr = 'root';
	$passwd = '12345';
	$db = new PDO($dsn, $usr, $passwd);
	return $db;
}
