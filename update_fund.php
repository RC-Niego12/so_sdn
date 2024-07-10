<?php
	session_start();
	include 'config.php';

	$fund_id = $_SESSION['modal_fund_id'];
	$fund_saa = $_SESSION['modal_fund_saa'];
	$fund_code = $_SESSION['modal_fund_code'];
	$fund_source = $_SESSION['modal_fund_source'];
	$fund_proponent = $_SESSION['modal_fund_proponent'];
	$fund_allocation = $_SESSION['modal_fund_allocation'];
	$fund_status = $_SESSION['modal_fund_status'];
	$fund_remarks = $_SESSION['modal_fund_remarks'];
    
    //insert staff
	$sql = "UPDATE tbl_funds SET fund_saa='$fund_saa', fund_code='$fund_code', fund_source='$fund_source', fund_proponent='$fund_proponent', fund_allocation='$fund_allocation', fund_status='$fund_status', fund_remarks='$fund_remarks' WHERE fund_id='$fund_id'";
        if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	$conn->close();
    header("location: manage_funds.php");
	?>