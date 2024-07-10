<?php
session_start();
include 'config.php';
	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d H:i:s');
	$status = "Inactive";
	$sql = "UPDATE tbl_staffs SET activityStatus='$status', since='$date' WHERE staffid='".$_SESSION['staffid']."'";
		if ($conn->query($sql) === TRUE) {
		    echo "Sign-out successful!";
		} else {
		  echo "Error updating record: " . $sql . "<br>" . $conn->error;
		}
	$sql2 = "UPDATE tbl_sw_table SET staffid2 = '' WHERE staffid2 = '".$_SESSION['staffid']."'";
        if ($conn->query($sql2) === TRUE) {
          echo "Table vacated successfully!";
        } else {
          echo "Error updating record: " . $sql2 . "<br>" . $conn->error;
        }
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
header ('location: index.php');
?>