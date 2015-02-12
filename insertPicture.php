<?php
/**********************************************************
* File: insertTopic.php
* Author: Br. Burton
* 
* Description: Takes input posted from topicEntry.php
*   This file enters a new scripture into the database
*   along with its associated topics.
*
*   This file actually does not do any rendering at all,
*   instead it redirects the user to showTopics.php to see
*   the resulting list.
***********************************************************/

// get the data from the POST
$title = $_POST['txtTitle'];
$image = $_POST['txtImage'];

// we could put additional checks here to verify that all this data is actually provided

	$dbHost = "http://php-jamesrichter.rhcloud.com";
	$dbPort = "3306";
	$dbUser = "adminYwPVfAG";
	$dbPassword = "pCTEtPQQJZI8";
	$dbName = "picSite";

try
{
	// Create the PDO connection
	$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	// First Add the Scripture
	$query = 'INSERT INTO picture(title, image, userID) VALUES(:title, :image, 1)';

	$statement = $db->prepare($query);

	$statement->bindParam(':title', $title);
	$statement->bindParam(':image', $image);

	$statement->execute();

	// get the new id
	$pictureID = $db->lastInsertId();
}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}

// finally, redirect them to a new page to actually show the topics
header("Location: showPictures.php");
die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.

?>