<?php
	session_start();
	include 'config.php';

	$fund_saa = $_SESSION['fund_saa'];
    $fund_code = $_SESSION['fund_code'];
    $fund_source = $_SESSION['fund_source'];
	$fund_proponent = $_SESSION['fund_proponent'];
    $fund_allocation = $_SESSION['fund_allocation'];
    $fund_status = $_SESSION['fund_status'];
    $fund_remarks = $_SESSION['fund_remarks'];
    
    //insert new fund
	$sql = "INSERT INTO tbl_funds (fund_saa, fund_code, fund_source,fund_proponent, fund_allocation, fund_status, fund_remarks) VALUES ('$fund_saa', '$fund_code', '$fund_source', '$fund_proponent', '$fund_allocation', '$fund_status', '$fund_remarks')";
        if ($conn->query($sql) === TRUE) {
            echo "New fund added successfully";
            //header("location: manage_assistance.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	$conn->close();
    header("location: manage_funds.php");
	?>