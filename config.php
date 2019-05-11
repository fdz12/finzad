<?php
	$servername = "localhost";

	$username = "xraslavsky";
	$password = "WebTechDBS1";

	$dbname = "finzad";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  	die("Connection failed: " . $conn->connect_error);
	}
    mysqli_set_charset($conn,"utf8");
    
?>