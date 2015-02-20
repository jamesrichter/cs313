<?php

function showLoginBar(){
	if ($_SESSION["username"] != "guest")
	{
		echo "
		<div id='loginBar'>
			You are logged in as " . $_SESSION["username"] . ". 
			<a href='logout.php'>Logout</a>  
			Not you? 
			<a href='login.php'>Login</a>  
			<a href='signUp.php'>Sign Up</a>
		</div>

		";
	}
	else
	{
		echo "
		<div id='loginBar'>
			You are logged in as " . $_SESSION["username"] . ". 
			<a href='login.php'>Login</a>  
			<a href='signUp.php'>Sign Up</a>
		</div>

		";
	}
}

?>