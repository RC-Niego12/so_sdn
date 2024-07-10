<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "so_sdn_system_swad_sdn2_2024";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>