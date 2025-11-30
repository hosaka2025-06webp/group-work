<?php
function getDb(): PDO
{
	$dsn = 'mysql53.conoha.ne.jp; charset=utf8';
	$usr = 'i8wcc_hosaka_test';
	$passwd = 'kagayaki@1234';
	$db = new PDO($dsn, $usr, $passwd);
	return $db;
}
