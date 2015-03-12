<?php
/**********************************************************
* File: insertTopic.php
* Author: James RIchter, Br. Burton
* 
* Description: Takes input posted from pictureEntry.php
*   This file enters a new picture into the database.
*
*   This file actually does not do any rendering at all,
*   instead it redirects the user to showPictures.php to see
*   the resulting list.
***********************************************************/
include 'loadPicDatabase.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inserting...</title>
</head>

<body>

<?php
// get the data from the POST
$title = $_POST['txtTitle'];
$image = $_POST['txtImage'];
$userID = $_SESSION['userID'];

try
{
	// Create the PDO connection
	$db = loadDatabase();

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	// First Add the Picture
	$query = 'INSERT INTO picture(title, image, userID) VALUES(:title, :image, :userID)';

	$statement = $db->prepare($query);

	$statement->bindParam(':title', $title);
	$statement->bindParam(':image', $image);
	$statement->bindParam(':userID', $userID);

	$statement->execute();

	// get the new id
	$pictureID = $db->lastInsertId();
}
catch (Exception $ex)
{
	echo "Error with DB.";
	die();
}

// finally, redirect them to a new page to actually show the pictures.
header("Location: showPictures.php");
die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.
?>

</body>
</html>