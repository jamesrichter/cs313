<?php
/**********************************************************
* File: showLoginBar.php
* Author: James Richter
* 
* Description: This is the PHP file that shows whether the
*	user is logged in.  It is shown at the top of most pages.   
***********************************************************/
function showLoginBar(){
	// if the user is not "guest"
	if ($_SESSION["userID"] != "")
	{
		echo "
		<div id='loginBar'>
			You are logged in as " . $_SESSION["username"] . ". 
			<a href='logout.php'>Logout</a>  
			<a href='pictureEntry.php'>Upload a Picture</a> 
			Not you? 
			<a href='login.php'>Login</a>  
			<a href='signUp.php'>Sign Up</a>
		</div>

		";
	}
	// if the user is guest
	else
	{
		echo "
		<div id='loginBar'>
			You are logged in as a guest. 
			<a href='login.php'>Login</a>  
			<a href='signUp.php'>Sign Up</a>
		</div>

		";
	}
}

?>