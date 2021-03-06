<?php 

// connects to the test database
function testConnection() {
	$dbHost = "127.4.215.130";
    $dbPort = "3306";
	$dbUser = "adminYwPVfAG"@"127.4.215.130";
	$dbPassword = "pCTEtPQQJZI8";
	$dbName = "picSite";

	$dsn = "mysql:host=$server;dbname=$database";
	try {
		$connTest = new PDO($dsn, $username, $password);
	} catch (PDOException $exc) {
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
     //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
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

	try {
		$sql = "SELECT * FROM picSite";  
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

$test = getScriptures(1);
echo "<h1>Team Faith</h1>";
foreach ($test as $key => $value) {
	echo "<strong> " . $value['username'] . " " . $value['text'] . ":" . $value['verse'] . "</strong>" . "-" . $value['content'] . "<br /><br />";
}



?>