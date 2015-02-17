<?php
session_start();
if !isset($SESSION["user"]){
	$_SESSION["user"] = "adminYwPVfAG";
	$_SESSION["password"] = "pCTEtPQQJZI8";
}
include "showLoginBar.php";
showLoginBar();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Picture Entry</title>
</head>

<body>
<div>

<h1>Enter New Pictures</h1>

<form id="mainForm" action="insertPicture.php" method="POST">

	<input type="text" id="txtTitle" name="txtTitle"></input>
	<label for="txtTitle">Title</label>
	<br /><br />

	<input type="text" id="txtImage" name="txtImage"></input>
	<label for="txtImage">Image</label>
	<br />
	<br />

	<input type="submit" value="Add to Database" />

</form>


</div>

</body>
</html>