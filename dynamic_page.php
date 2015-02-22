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

function getPic($id) {
	$conn = loadDatabase();

	try {
		$sql = 'SELECT * FROM picture WHERE pictureID=1'; 
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':picID', $id);
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

$data = getPic($picID);

echo "
<!DOCTYPE html>
<html>
<head>
	<title>" . $data['title'] . "</title>
</head>
<body>
";

showLoginBar();
echo $data;
foreach ($key in $data) 
{
	echo ";";
	echo $key;
	echo ";";
}

echo $data['pictureID'];
echo $data['title'];
echo $data['image'];
echo $data['userID'];
echo "
</body>
</html>
";

?>