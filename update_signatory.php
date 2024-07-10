<?php
	session_start();
	include 'config.php';

	$sig_id = $_SESSION['modal_sig_id'];
	$lname = $_SESSION['modal_lname'];
	$fname = $_SESSION['modal_fname'];
	$mname = $_SESSION['modal_mname'];
	$nameext = $_SESSION['modal_nameext'];
    $suffix = $_SESSION['modal_suffix'];
	$designation = $_SESSION['modal_designation'];
    $amt_from = $_SESSION['modal_amt_from'];
	$amt_to = $_SESSION['modal_amt_to'];
    
    //insert staff
	$sql = "UPDATE tbl_signatories SET lname='$lname', fname='$fname', mname='$mname', nameext='$nameext', suffix='$suffix', designation='$designation', amt_from='$amt_from', amt_to='$amt_to' WHERE sig_id='$sig_id'";
        if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	$conn->close();
    header("location: manage_signatories.php");
	?>