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
		$sql = 'SELECT * FROM picture where pictureID = :id';  
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':id', $picID);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
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
if ($test = FALSE)
{
	echo "false";
}
echo $test;
foreach ($test as $key => $value) {
	echo " " .
	$value['title'] . 
	" <img src='" .
	$value['image'] .
	"' width='600'>";
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