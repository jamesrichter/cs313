<?php
/**********************************************************
* File: createAccount.php
* Author: Br. Burton
* 
* Description: Allows a user to enter a new username
*   and password to add to the DB.
*
* It actually posts to a file called "createAccount.php"
*   which does the actual creation.
*
***********************************************************/
session_start();
// used for password hashing. If we don't have php 5.5 or later (e.g. openshift)
// then we will need to have this file in our path (e.g., in the current directory)
require("loadPicDatabase.php");
require("password.php");

// get the data from the POST
$username = $_POST['txtUser'];
$password = $_POST['txtPassword'];

if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: signUp.php");
	die(); // we always include a die after redirects.
}

// Let's not allow HTML in our usernames. It would be best to detect this before
// submitting the form and prevent the submission.
$username = htmlspecialchars($username);

// Get the hashed password.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try
{
	// Create the PDO connection
	$db = loadDatabase();

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$query = 'INSERT INTO login(username, password) VALUES(:username, :password)';

	$statement = $db->prepare($query);

	$statement->bindParam(':username', $username);

	// **********************************************
	// NOTICE: We are submitting the hashed password!
	// **********************************************
	$statement->bindParam(':password', $hashedPassword);

	$statement->execute();
}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}


// finally, redirect them to the sign in page
header("Location: logIn.php");
die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.

?>