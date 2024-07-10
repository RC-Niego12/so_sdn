<?php
	session_start();
	include 'config.php';

	$gl_id = $_SESSION['gl_id'];
	$gl_code =  $_SESSION['gl_code'];
	$billing_code = $_SESSION['billing_code'];
    
    
	$sql = "DELETE FROM tbl_tracked_gls WHERE billing_code='$billing_code' AND gl_id='$gl_id' " ;
        if ($conn->query($sql) === TRUE) {
            echo "GL excluded from this bill successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	$conn->close();
    header("location: track_GLs.php");
	?>