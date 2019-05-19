<?php
	$servername = "localhost";
	$username = "xzuffad1";
	$password = "bwvWG3bsABqX";
	$dbname = "finzad";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  	die("Connection failed: " . $conn->connect_error);
	}
    mysqli_set_charset($conn,"utf8");
    
?>