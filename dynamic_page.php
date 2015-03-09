<?php
include 'loadPicDatabase.php';
include 'showLoginBar.php';
session_start();
showLoginBar();

if (isset($_GET['id'])) 
{
	$picID = $_GET['id'];
}
else {
	echo "Image not found.";
}

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

function getComments($picID){
	$conn = loadDatabase();
	try {
		$sql = 'SELECT * FROM picture 
				INNER JOIN comment ON comment.pictureID=picture.pictureID
				INNER JOIN login ON comment.userID=login.id
				WHERE picture.pictureID=1:id';  
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

foreach ($picture as $key => $value) {
	echo " <h1>" .
	$value['title'] . 
	"</h1><br/><img src='" .
	$value['image'] .
	"' width='600'><br/>";
}

foreach ($comments as $key => $value) {
	echo "<br/>" .
	$value['username'] .
	"<br/>" .
	$value['text'] .
	"<br/>";
}

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