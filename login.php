<?php
session_start();
require("password.php"); // used for password hashing.
require("loadPicDatabase.php");

$badLogin = false;

if (isset($_POST['txtUsername']) && isset($_POST['txtPassword']))
{
	// they have submitted a username and password for us to check
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	try
	{
		// Create the PDO connection
		$db = loadDatabase();

		// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$query = 'SELECT password FROM login WHERE username=:username';

		$statement = $db->prepare($query);
		$statement->bindParam(':username', $username);

		$result = $statement->execute();

		if ($result)
		{
			$row = $statement->fetch();
			$hashedPasswordFromDB = $row['password'];
			$userID = $row['id'];
			if (isset($userID))
			{
				echo $userID;
			}
			// now check to see if the hashed password matches
			if (password_verify($password, $hashedPasswordFromDB))
			{
				// password was correct, put the user on the session, and redirect to home
				$_SESSION['username'] = $username;
				if (isset($_SESSION['userID']))
				{
					echo $_SESSION['userID'];
				}
				//header("Location: showPictures.php");
				die(); // we always include a die after redirects.
			}
			else
			{
				$badLogin = true;
			}

		}
		else
		{
			$badLogin = true;
		}
	}
	catch (Exception $ex)
	{
		// Please be aware that you don't want to output the Exception message in
		// a production environment
		echo "Error with DB. Details: $ex";
		die();
	}

}
else
{
	$badLogin = true;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
</head>

<body>
<div>

<?php
if ($badLogin)
{
	echo "Incorrect username or password!<br/><br/>Please try again:<br/>\n";
}
?>

</div>
<form  method="POST" action="login.php"  id="loginForm">
	Username<input  type="text" name="txtUsername"><br/>
	Password<input  type="password" name="txtPassword">
	<input  type="submit" name="submit" value="Login"> 
</form>
</body>
</html>