<?php
	session_start();
	include 'config.php';

	$assistance_id = $_SESSION['modal_assistance_id'];
	$assistance_type = $_SESSION['modal_assistance_type'];
	$assistance_purpose = $_SESSION['modal_assistance_purpose'];
    
    //insert staff
	$sql = "UPDATE tbl_assistance SET assistance_type='$assistance_type', assistance_purpose='$assistance_purpose' WHERE assistance_id='$assistance_id'";
        if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	$conn->close();
    header("location: manage_assistance.php");
	?>