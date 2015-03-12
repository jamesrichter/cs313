<?php 

function loadDatabase()
{

	$dbHost = "127.0.0.1";
    $dbPort = "3307";
	$dbUser = "root";
	$dbPassword = "c06ke1";
	$dbName = "Scriptures";
	
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

function postScriptures() {
	$conn = loadDatabase();

	try {
		$sql = "INSERT INTO Scriptures(book, chapter, verse, content) VALUES (:book, :chapter, :verse, :text)";  

		$stmt = $conn->prepare($sql);

		$book = $_POST['book'];
		$chapter = $_POST['chapter'];
		$verse = $_POST['verse'];
		$text = $_POST['text'];

		$stmt->bindParam(':book',$book);
		$stmt->bindParam(':verse',$verse);
		$stmt->bindParam(':chapter',$chapter);
		$stmt->bindParam(':text',$text);

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

if (!isset($_POST)){
	postScriptures();
}

// action "." saves the names in an array called POST.
// action "displayScriptures.php" saves the names in an array
// 		  in another php file called displayScriptures.
echo '<form action="." method="POST">
	Book<input type="text" name="book"><br/>
	Chapter<input type="text" name="chapter"><br/>
	Verse<input type="text" name="verse"><br/>
	Text<textarea name="text"></textarea><br/>
	<input type="submit" value="submit"/>
</form>'

?>
