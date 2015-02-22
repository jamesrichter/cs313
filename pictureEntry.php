<?php
session_start();
include "showLoginBar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Picture Entry</title>
</head>

<body>
<div>

<?php
showLoginBar();
?>

<h1>Enter New Pictures</h1>

<form id="mainForm" action="insertPicture.php" method="POST">

	<input type="text" id="txtTitle" name="txtTitle"></input>
	<label for="txtTitle">Title</label>
	<br /><br />

	<input type="text" id="txtImage" name="txtImage"></input>
	<label for="txtImage">Image</label>
	<br />
	<br />

	<input type="submit" value="Upload Picture" />

</form>


</div>

</body>
</html>