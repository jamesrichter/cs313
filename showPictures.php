<?php
session_start();
include "showLoginBar.php";
include "loadPicDatabase.php";

if (!isset($_SESSION["username"]))
{
	$_SESSION["username"] = guest;
}
?>

<!DOCTYPE html>
<html>
<title>Pictures</title>
<body>
<?php 
showLoginBar();

// This will retrieve images from the database
function getPicSite($id) {
	$conn = loadDatabase();

	try {
		$sql = 'SELECT * FROM picture';  
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

$test = getPicSite(1);
echo "<h1>Recent Pictures</h1>";
foreach ($test as $key => $value) {
	echo " " .
	$value['title'] . 
	"<a href=\"dynamic_page.php?id=" .
	$value['pictureID'] .
	"><img src=\"" .
	$value['image'] .
	"\" height=\"200\"></a>";

}


?>

<?php 
if(isset($_POST['submit'])){ 
	if(isset($_GET['go'])){ 
		if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){ 
			$name=$_POST['name']; 
	  		//connect  to the database 
			$conn = loadDatabase(); 
	  		//-query  the database table 
			try {
				$sql="SELECT * FROM picture WHERE title LIKE '%" . $name .  "%'"; 
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$data = $stmt->fetchAll();
				$stmt->closeCursor();
			} catch (PDOException $ex) {
				echo 'PDO error in model.';
			}
		}
		else{ 
			echo  "<p>Please enter a search query</p>"; 
		} 
	} 
} 
?> 

	<form  method="post" action="showPictures.php?go"  id="searchform"> 
      <input  type="text" name="name"> 
      <input  type="submit" name="submit" value="Search"> 
    </form> 
</body>
</html>