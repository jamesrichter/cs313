<?php
/**********************************************************
* File: insertComment.php
* Author: James Richter, Bro. Burton
* 
* Description: Allows a user to enter a comment to add to
*	the DB.
*
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
$text = $_POST['txtText'];
$userID = $_SESSION['userID'];
$picID = $_SESSION['picID'];
try
{
	$link = "Location: dynamic_page.php?id=" . $picID;
	// Create the PDO connection
	$db = loadDatabase();

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	// First Add the Comment
	$query = 'INSERT INTO comment(text, userID, pictureID) VALUES(:text, :userID, :picID)';

	$statement = $db->prepare($query);

	$statement->bindParam(':text', $text);
	$statement->bindParam(':userID', $userID);
	$statement->bindParam(':picID', $picID);

	$statement->execute();

	// get the new id
	$pictureID = $db->lastInsertId();
}
catch (Exception $ex)
{
	echo "Error with DB.";
	die();
}

// finally, redirect them to a page that shows the same picture.
header($link);
die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.
?>

</body>
</html>