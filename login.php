<?php
if(isset($_POST['submit'])){ 
	if(isset($_GET['go'])){ 
		if(preg_match("/^[a-zA-Z]+/", $_POST['username'])){
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
					<form  method="post" action="login.php?go"  id="searchform"> 
					  Username<input  type="text" name="username"><br/>
					  Password<input  type="text" name="password"> 
					  <input  type="submit" name="submit" value="Login"> 
					</form>
					';
			}
		}
	}
}

echo '
<form  method="post" action="login.php?go"  id="searchform"> 
  Username<input  type="text" name="username"><br/>
  Password<input  type="text" name="password"> 
  <input  type="submit" name="submit" value="Login"> 
</form>
';
?>