<?php
/**********************************************************
* File: signUp.php
* Author: James Richter, Br. Burton
* 
* Description: Allows a user to enter a new username
*   and password to add to the DB.
*
* It actually posts to a file called "createAccount.php"
*   which does the actual creation.
*
***********************************************************/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>

<body>
<div>

<h1>Sign up for new account</h1>

<form id="mainForm" action="createAccount.php" method="POST">

	<input type="text" id="txtUser" name="txtUser"></input>
	<label for="txtUser">Username</label>
	<br /><br />

	<input type="password" id="txtPassword" name="txtPassword"></input>
	<label for="txtPassword">Password</label>
	<br /><br />

	<input type="submit" value="Create Account" />

</form>


</div>

</body>
</html>