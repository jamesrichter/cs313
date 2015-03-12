<?php
/**********************************************************
* File: signOut.php
* Author: James Richter
* 
* Description: Clears the username from the session if there.
*
***********************************************************/
session_start();

// Set the username to guest.
$_SESSION['username'] = "guest";
$_SESSION['userID'] = '';

header("Location: showPictures.php");
die(); // we always include a die after redirects.
?>