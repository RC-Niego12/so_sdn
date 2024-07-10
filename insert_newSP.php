<?php
	session_start();
	include 'config.php';

	$sp_name = $_SESSION['sp_name'];
	$sp_type = $_SESSION['sp_type'];
	$sp_pd_address = $_SESSION['sp_pd_address'];
	$sp_address = $_SESSION['sp_address'];
    $sp_contact_person = $_SESSION['sp_contact_person'];
    $sp_contact_num = $_SESSION['sp_contact_num'];
    $status = $_SESSION['status'];
    
    //insert staff
	$sql = "INSERT INTO tbl_sp_caraga (sp_name, sp_type, sp_pd_address, sp_address, contact_person, contact_num, status) VALUES ('$sp_name', '$sp_type', '$sp_pd_address','$sp_address', '$sp_contact_person', '$sp_contact_num', '$status')";
        if ($conn->query($sql) === TRUE) {
            echo "New SP added successfully!";
            //header("location: manage_signatories.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	$conn->close();
    header("location: manage_SPs.php");
	?>