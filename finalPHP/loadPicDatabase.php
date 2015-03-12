<?php
/**********************************************************
* File: loadPicDatabase.php
* Author: James Richter
* 
* Description: Loads the database.  The user should not know
*	about this file.
*
*	Very useful as the production environment can change
*	and this is the only file needed to be edited.
***********************************************************/

// Load the database.
// Here, we are loading the OpenShift Database.
function loadDatabase()
{
	$dbHost = "http://php-jamesrichter.rhcloud.com";
	$dbPort = "3306";
	// These should probably be in a different file.
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