<?php
include 'loadPicDatabase.php';
include 'showLoginBar.php';
session_start();

if (isset($_GET['id'])) 
{
	echo $_GET['id'];
	$picID = $_GET['id'];
}
else {
	echo "Image not found.";
}

function getPicSite() {
	$conn = loadDatabase();

	try {
		$sql = 'SELECT * FROM picture where pictureID = 1';  
		$stmt = $conn->prepare($sql);
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

$test = getPicSite();
echo "<h1>Recent Pictures</h1>";
foreach ($test as $key => $value) {
	echo " " .
	$value['title'] . 
	"<a href=\"dynamic_page.php?id=" .
	$value['pictureID'] .
	"\"><img src=\"" .
	$value['image'] .
	"\" height=\"200\"></a>";
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