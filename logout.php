<?php
/**********************************************************
* File: signOut.php
* Author: Br. Burton
* 
* Description: Clears the username from the session if there.
*
***********************************************************/

session_start();
$_SESSION['username'] = "guest";

header("Location: showPictures.php");
die(); // we always include a die after redirects.
?>