<?php

function loadDatabase()
{
	$dbHost = "http://php-jamesrichter.rhcloud.com";
	$dbPort = "3306";
	$dbName = "picSite";
	$dbUser = "adminYwPVfAG";
	$dbPassword = "pCTEtPQQJZI8";
	$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
	if ($openShiftVar === null || $openShiftVar == "")
	{
// Not in the openshift environment
//echo "Using local credentials: ";
//require("setLocalDatabaseCredentials.php");
	}
	else
	{
// In the openshift environment
//echo "Using openshift credentials: ";
		$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
		$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	}
//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
	$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	return $db;
}

?>