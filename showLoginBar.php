<?php

function showLoginBar(){
	echo "
	<div id='loginBar'>
		You are logged in as " . $_SESSION["user"] . ". Not you? 
		<a href='login.php'>Login</a>
	</div>

	";
}

?>