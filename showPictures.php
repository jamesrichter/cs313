<?php
/**********************************************************
* File: viewScriptures.php
* Author: Br. Burton
* 
* Description: This file shows an example of how to query a
*   MySql database from PHP.
***********************************************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Picture List</title>
</head>

<body>
<div>

<h1>Picture List</h1>

<?php

// It would be better to store these in a different file
$dbUser = 'root';
$dbPass = 'c06ke1';
$dbName = 'picSite';
$dbHost = '127.0.0.1'; // for my configuration, I need this rather than 'localhost'
$dbPort = '3307';

try
{
	// Create the PDO connection
	$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	// prepare the statement
	$statement = $db->prepare('SELECT pictureID, title, image, userID FROM picture');
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['pictureID'] . ' ' . $row['title'] . ' ';
		echo $row['image'] . '</strong>' . ' ' . $row['userID'];
		echo '<br />';
		echo '</p>';
	}


}
catch (PDOException $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}

?>

</div>

</body>
</html>