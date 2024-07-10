<?php
	session_start();
	include 'config.php';

    $dt_start1 = $_SESSION['dt_start'];
    $dt_end1 = $_SESSION['dt_end'];
    $id_clbene = $_SESSION['id_clbene'];
    $id_addl_entry = $_SESSION['id_addl_entry'];
	$date_start = $_SESSION['date_start2'];
    $time_start = $_SESSION['time_start2'];
    $dt_start = $date_start.' '.$time_start;
    $date_end = $_SESSION['date_end2'];
    $time_end = $_SESSION['time_end2'];
    $dt_end = $date_end.' '.$time_end;

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];
    
	$sql_clbene = "UPDATE tbl_save_clientbene SET time_start='$dt_start', time_end='$dt_end' WHERE id_tbl_save_clientbene='$id_clbene'";
        if ($conn->query($sql_clbene) === TRUE) {
		    echo '<script>';
		        echo 'alert("Date/Time Start '.$dt_start1.' in tbl_save_clientbene has been changed into '.$dt_start.' successfully!.\nDate/Time End '.$dt_end1.' in tbl_save_clientbene has been changed into '.$dt_end.' successfully!.");';
		        //echo 'window.location.href = "../'.$sys_acronym.'/modify_forms_sw.php";';
		    echo '</script>';
            //echo "OBDV Code '.$obdv_code.' in tbl_vouched_bills is updated into '.$obdv_code_edit.' successfully!";
        } else {
            echo "Error: " . $sql_clbene . "<br>" . $conn->error;
        }
    
	$sql_addlentry = "UPDATE tbl_save_addl_entry SET time_start2='$dt_start', time_end2='$dt_end' WHERE id_tbl_save_addl_entry='$id_addl_entry'";
        if ($conn->query($sql_addlentry) === TRUE) {
		    echo '<script>';
		        echo 'alert("Date/Time Start '.$dt_start1.' in tbl_save_addl_entry has been changed into '.$dt_start.' successfully!.\nDate/Time End '.$dt_end1.' in tbl_save_clientbene has been changed into '.$dt_end.' successfully!.");';
		        echo 'window.location.href = "../'.$sys_acronym.'/modify_forms_sw.php";';
		    echo '</script>';
            //echo "OBDV Code '.$obdv_code.' in tbl_vouched_bills is updated into '.$obdv_code_edit.' successfully!";
        } else {
            echo "Error: " . $sql_addlentry . "<br>" . $conn->error;
        }

	$conn->close();
    //header("location: track_billings.php");
	?>