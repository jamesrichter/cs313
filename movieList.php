<?php 

// connects to the test database
function testConnection() {
	$server = '127.0.0.1';
	$username = 'phpbob';
	$password = 'cs313pass';
	$db = new PDO("mysql:host=127.0.0.1;dbname=movieTest", $user, $pass);
	echo "Connection Established.";

	

}

$test = testConnection();


function loadDatabase()
{

	$dbHost = "127.0.0.1";
    $dbPort = "3307";
	$dbUser = "root";
	$dbPassword = "c06ke1";

	$dbName = "Scriptures";

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
function getScriptures($id) {
	$conn = loadDatabase();

	try {
		$sql = "SELECT * FROM Scriptures";  
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
	echo "<strong> " . $value['book'] . " " . $value['chapter'] . ":" . $value['verse'] . "</strong>" . "-" . $value['content'] . "<br /><br />";
}



?>