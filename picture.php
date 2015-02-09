<!DOCTYPE html>
<html>
<title>Pictures</title>
<body>
<?php 

function loadDatabase()
{
	$dbHost = "http://php-jamesrichter.rhcloud.com";
	$dbPort = "3306";
	$dbUser = "adminYwPVfAG";
	$dbPassword = "pCTEtPQQJZI8";
	$dbName = "picSite";
	$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
	if ($openShiftVar === null || $openShiftVar == "")
	{
// Not in the openshift environment
//echo "Using local credentials: ";
//require("setLocalDatabaseCredentials.php");
	}
	else
	{
// In the openshift environment
//echo "Using openshift credentials: ";
		$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
		$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	}
//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
	$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	return $db;
}

// This will retrieve scriptures from the database
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
	echo " " . $value['title'] . "
	 <img src=\"" . $value['image'] . "\" height=\"400\"
	 width=\"400\">
	  " . $value['pictureID']
	. " " . " " . $value['userID'] .
	"<br /><br />";

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

	<form  method="post" action="search.php?go"  id="searchform"> 
      <input  type="text" name="name"> 
      <input  type="submit" name="submit" value="Search"> 
    </form> 
</body>
</html>