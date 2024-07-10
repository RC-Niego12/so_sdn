<?php
	session_start();
	include 'config.php';

	$lname = $_SESSION['lname'];
	$fname = $_SESSION['fname'];
	$mname = $_SESSION['mname'];
	$nameext = $_SESSION['nameext'];
    $suffix = $_SESSION['suffix'];
	$designation = $_SESSION['designation'];
    $amt_from = $_SESSION['amt_from'];
	$amt_to = $_SESSION['amt_to'];
    
    //insert staff
	$sql = "INSERT INTO tbl_signatories (lname, fname, mname, nameext, suffix, designation, amt_from, amt_to) VALUES ('$lname', '$fname', '$mname','$nameext', '$suffix', '$designation','$amt_from','$amt_to')";
        if ($conn->query($sql) === TRUE) {
            echo "New account created successfully";
            //header("location: manage_signatories.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	$conn->close();
    header("location: manage_signatories.php");
	?>