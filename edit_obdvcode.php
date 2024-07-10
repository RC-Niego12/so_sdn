<?php
	session_start();
	include 'config.php';

	$billing_code = $_SESSION['billing_code_edit'];
	$obdv_code = $_SESSION['obdv_code_edit'];
	$obdv_code_edit = $_SESSION['obdv_code_edited'];

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];

	//GET obs_dv_date
    $sql_obs_dv_date = mysqli_query($conn,"SELECT * FROM tbl_obs_dv WHERE obs_dv_code = '$obdv_code_edit' ");
    $row_obs_dv_date = mysqli_fetch_assoc($sql_obs_dv_date);
    $obs_dv_date = $row_obs_dv_date['obs_dv_date'];
    
	$sql = "UPDATE tbl_vouched_bills SET obs_dv_code2='$obdv_code_edit', obs_dv_date2='$obs_dv_date' WHERE billing_code2='$billing_code'";
        if ($conn->query($sql) === TRUE) {
		    echo '<script>';
		        echo 'alert("OBDV Code '.$obdv_code.' in tbl_vouched_bills has been updated/changed into OBDV Code '.$obdv_code_edit.' successfully!.\n");';
		        echo 'window.location.href = "../'.$sys_acronym.'/track_billings.php";';
		    echo '</script>';
            //echo "OBDV Code '.$obdv_code.' in tbl_vouched_bills is updated into '.$obdv_code_edit.' successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

	$conn->close();
    //header("location: track_billings.php");
	?>