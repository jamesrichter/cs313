<?php
include 'loadPicDatabase.php';
include 'showLoginBar.php';
session_start();

if (isset($_GET['id'])) 
{
	$picID = $_GET['id'];
}
else {
	echo "Image not found.";
}

function getPicSite() {
	$conn = loadDatabase();

	try {
		$sql = 'SELECT * FROM picture where pictureID = $picID';  
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":id", $picID);
		echo $stmt;
		$stmt->execute();
		$data = $stmt->fetchAll();
		$stmt->closeCursor();
		echo $sql;
	} catch (PDOException $ex) {
		echo 'PDO error in model.';
	}

	if (is_array($data)) {
		echo "fine";
		return $data;
	} else {
		return FALSE;
	}
}

$test = getPicSite();
if (isset($test))
{
	echo "set";
}
if ($test == FALSE)
{
	echo "false";
}
if ($test == TRUE)
{
	echo "true";
}
if (is_array($test))
{
	echo "array";
}
if ($test != FALSE)
{
	echo "not galse";
}

echo $test;
foreach ($test as $key => $value) {
	echo $key;
	echo $value;
	/*echo " " .
	$value['title'] . 
	" <img src='" .
	$value['image'] .
	"' width='600'>";*/
}
/**
showLoginBar();

echo $data['pictureID'];
echo $data['title'];
echo $data['image'];
echo $data['userID'];
echo "
</body>
</html>
";
**/
?>