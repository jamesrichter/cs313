<?php
/**********************************************************
* File: topicEntry.php
* Author: James Richter, Br. Burton
* 
* Description: This is the PHP file that the user enters
*	pictures with.  It has a form to enter a new picture url
*	and title.
*   It posts to the insertPicture.php page.
***********************************************************/
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