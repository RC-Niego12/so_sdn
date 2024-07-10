<?php
	session_start();
	include 'config.php';

	$sp_id = $_SESSION['modal_sp_id'];
	$sp_name = $_SESSION['modal_sp_name'];
	$sp_type = $_SESSION['modal_sp_type'];
	$sp_district = $_SESSION['modal_sp_district'];
	$sp_address = $_SESSION['modal_sp_address'];
    $sp_contact_person = $_SESSION['modal_sp_contact_person'];
    $sp_contact_num = $_SESSION['modal_sp_contact_num'];
    $sp_status = $_SESSION['modal_sp_status'];
    
    //insert staff
	$sql = "UPDATE tbl_sp_caraga SET sp_name='$sp_name', sp_type='$sp_type', sp_pd_address='$sp_district', sp_address='$sp_address', contact_person='$sp_contact_person', contact_num='$sp_contact_num', status='$sp_status' WHERE id='$sp_id'";
        if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	$conn->close();
    header("location: manage_SPs.php");
	?>