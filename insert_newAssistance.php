<?php
	session_start();
	include 'config.php';

	$assistance_type = $_SESSION['assistance_type'];
	$assistance_purpose = $_SESSION['assistance_purpose'];
    
    //insert staff
	$sql = "INSERT INTO tbl_assistance (assistance_type, assistance_purpose) VALUES ('$assistance_type', '$assistance_purpose')";
        if ($conn->query($sql) === TRUE) {
            echo "New assistance created successfully";
            //header("location: manage_assistance.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	$conn->close();
    header("location: manage_assistance.php");
	?>