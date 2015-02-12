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

include 'loadPicDatabase.php';


try
{
	// Create the PDO connection
	$db = loadDatabase();

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