<?php
	$servername = "localhost";
	$username = "Zdeno5";
	$password = "q6a8*a90";
	$dbname = "finzad";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  	die("Connection failed: " . $conn->connect_error);
	}
    mysqli_set_charset($conn,"utf8");
    
?>
