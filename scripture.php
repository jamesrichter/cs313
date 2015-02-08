<!DOCTYPE html>
<html>
<title>David A. Jones's compositions</title>
<body>
	hii
<?php 

echo ":)";

define('DB_HOST', getenv('127.4.215.130'));
define('DB_PORT', getenv('3306'));
define('DB_USER', getenv('adminYwPVfAG'));
define('DB_PASS', getenv('pCTEtPQQJZI8'));
define('DB_NAME', getenv('php'));

// connects to the test database
function testConnection() {
	$dbHost = constant("DB_HOST");;
    $dbPort = constant("DB_PORT");;
	$dbUser = constant("DB_USER");;
	$dbPassword = constant("DB_PASS");;
	$dbName = constant("DB_NAME");;
	echo ":)";
	$dsn = "mysql:host=$server;dbname=$database";
	try {
		$connTest = new PDO($dsn, $username, $password);
		echo "It worked!"
;	} catch (PDOException $exc) {
		echo "Sorry the connection could not be established";
	}

	if (is_object($connTest)) {
		return $connTest;
	} else {
		echo 'It failed';
	}
}

$test = testConnection();


function loadDatabase()
{

	$dbHost = "127.4.215.130";
    $dbPort = "3306";
	$dbUser = "adminYwPVfAG";
	$dbPassword = "pCTEtPQQJZI8";
	$dbName = "picSite";
	echo ":)";
     // $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

     // if ($openShiftVar === null || $openShiftVar == "")
     // {
     //      // Not in the openshift environment
     //      //echo "Using local credentials: "; 
     //      require("setLocalDatabaseCredentials.php");
     // }
     // else 
     // { 
     //      // In the openshift environment
     //      //echo "Using openshift credentials: ";

     //      $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
     //      $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
     //      $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
     //      $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
     // } 
     //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br>\n";
  //echo "host:$dbHost:$dbPort <br>dbName:$dbName <br>user:$dbUser <br>password:$dbPassword<br />\n";

  // $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

	try {
		$connTest = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	} catch (PDOException $exc) {
		echo "Sorry the connection could not be established";
	}

	if (is_object($connTest)) {
		return $connTest;
	} else {
		echo ' It failed';
	}
	return $connTest;
}

// This will retrieve scriptures from the database
function getPicSite($id) {
	$conn = loadDatabase();
	echo ":)3";
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

echo ":)1";
$test = getScriptures(1);
echo $test;
echo "<h1>Team Faith</h1>";
foreach ($test as $key => $value) {
	echo "<strong> " . $value['title'] . " " . $value['image'] . ":" . $value['pictureID'] . "</strong>" . "-" . $value['userID'] . "<br /><br />";
}


?>
</body>
</html>