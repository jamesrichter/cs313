<?php
/**********************************************************
* File: verifyLogin.php
* Author: James Richter
* 
* Description: Automatically redirects the logged in
*	user to the showPictures.php home page.  Does a
*	double check to make sure that the database loaded
*	the right user.
***********************************************************/
if(isset($_POST['submit'])){ 
	$_SESSION["user"] = $_POST['username'];
	$_SESSION["password"] = $_POST['password'];

	try {
		loadDatabase($_SESSION["user"], $_SESSION["password"]);
		$sql = 'SELECT * FROM picture';
		header("Location: https://php-jamesrichter.rhcloud.com/showPictures.php");
		die();
	}
	catch (Exception $ex){
		echo 'Could not login.';
		echo '
			<form  method="post" action="login.php"  id="searchform"> 
			  Username<input  type="text" name="username"><br/>
			  Password<input  type="password" name="password"> 
			  <input  type="submit" name="submit" value="Login"> 
			</form>
			';
	}
}

?>