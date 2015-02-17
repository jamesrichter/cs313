<?php
if(isset($_POST['submit'])){ 
	if(isset($_GET['go'])){ 
		if(preg_match("/^[a-zA-Z]+/", $_POST['username'])){
			$_SESSION["user"] = "adminYwPVfAG";
			$_SESSION["password"] = "pCTEtPQQJZI8";
			header("Location: https://php-jamesrichter.rhcloud.com/showPictures.php");
			die();
		}
	}
}

<form  method="post" action="login.php?go"  id="searchform"> 
  <input  type="text" name="username"> 
  <input  type="text" name="password"> 
  <input  type="submit" name="submit" value="Login"> 
</form>

?>