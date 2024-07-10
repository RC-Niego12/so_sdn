<?php
	session_start();
	include 'config.php';

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];

	$gl_id_edit = $_SESSION['gl_id_edit'];
	$gl_code_edit =  $_SESSION['gl_code_edit'];
	$billing_code_edit = $_SESSION['billing_code_edit'];
    
    
	$sql = "UPDATE tbl_tracked_gls SET billing_code='$billing_code_edit' WHERE gl_id='$gl_id_edit'";
        if ($conn->query($sql) === TRUE) {
		    echo '<script>';
		        echo 'alert("Billing Code in tbl_tracked_gls is updated successfully!.\n");';
		        echo 'window.location.href = "../'.$sys_acronym.'/track_GLs.php";';
		    echo '</script>';
            //echo "Billing Code in tbl_tracked_gls is updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

	$conn->close();
    //header("location: track_GLs.php");
	?>