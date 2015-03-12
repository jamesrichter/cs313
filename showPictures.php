<?php
/**********************************************************
* File: showPictures.php
* Author: James Richter
* 
* Description: Our main home page.  It shows all of the 
*   pictures in our database, starting with the earliest.
*
***********************************************************/
session_start();
include "showLoginBar.php";
include "loadPicDatabase.php";

// User is a guest by default.
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

    // Display all of the pictures in turn.
    $test = getPicSite(1);
    echo "<h1>Recent Pictures</h1>";
    foreach (array_reverse($test as $key => $value)) {
        echo " " .
        $value['title'] .
        "<a href=\"dynamic_page.php?id=" .
        $value['pictureID'] .
        "\"><img src=\"" .
        $value['image'] .
        "\" height=\"200\"></a>";
    }
    ?>
</body>
</html>