<?php
include_once 'medoo.min.php';

$database = new medoo([
	// required
	'database_type' => db_type,
	'database_name' => db_name,
	'server' => db_server,
	'username' => db_username,
	'password' => db_password,
	'charset' => 'utf8',
 
	// [optional]
	'port' => 3306,
 
	// [optional] Table prefix
	//'prefix' => 'PREFIX_',
 
	// [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);

