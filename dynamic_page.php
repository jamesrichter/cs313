<?php
/**********************************************************
* File: dynamic_page.php
* Author: James Richter
* 
* Description: This is the page for viewing a generic picture.
*   It dynamically loads the picture information from the
*	database.
*
***********************************************************/
include 'loadPicDatabase.php';
include 'showLoginBar.php';
session_start();
showLoginBar();

// set the picture ID.
if (isset($_GET['id'])) 
{
	$picID = $_GET['id'];
}
else {
	echo "Image not found.";
}

// Load the picture's information from the database.
function getPicSite($picID) {
	$conn = loadDatabase();

	try {
		$sql = 'SELECT * FROM picture WHERE pictureID=:id';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id", $picID);
		$stmt->execute();
		$data = $stmt->fetchAll();
		$stmt->closeCursor();
	} catch (PDOException $ex) {
		echo 'PDO error in model.';
	}

	if (is_array($data)) {
		return $data;
	} else {
		return FALSE;
	}
}

// Load the picture's comments from the database.
function getComments($picID){
	$conn = loadDatabase();
	try {
		$sql = 'SELECT * FROM picture 
				INNER JOIN comment ON comment.pictureID=picture.pictureID
				INNER JOIN login ON comment.userID=login.id
				WHERE picture.pictureID=:id';  
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id", $picID);
		$stmt->execute();
		$data = $stmt->fetchAll();
		$stmt->closeCursor();
	}
	catch (PDOException $ex) {
		echo 'PDO error in model';
	}
	if (is_array($data)) {
		return $data;
	} else {
		return FALSE;
	}
}

$picture = getPicSite($picID);
$comments = getComments($picID);

// Display the picture.
foreach ($picture as $key => $value) {
	echo " <h1>" .
	$value['title'] . 
	"</h1><br/><img src='" .
	$value['image'] .
	"' width='600'><br/>";
}

// Display the comments.
foreach ($comments as $key => $value) {
	echo "<br/>" .
	$value['username'] .
	"<br/>" .
	$value['text'] .
	"<br/>";
}

// Allow the user to add a comment, if they are logged in.
if (isset($_SESSION['userID']) && ($_SESSION['username'] != 'guest'))
{
	$_SESSION['picID'] = $picID;
	echo '<br/>Add a Comment:

	<form id="commentForm" action="insertComment.php" method="POST">

	<textarea id="txtText" name="txtText"></textarea>
	<br />

	<input type="submit" value="Add Comment" />

</form>';
}
?>