<?php
	session_start();
	$_SESSION['modal_clqn']; $_SESSION['cancel_option']; $_SESSION['cancel_remarks'];
	include 'config.php';

	$id_tbl_save_clientbene = $_SESSION['modal_clqn'];
	$cancellation = $_SESSION['cancel_option'];
	date_default_timezone_set('Asia/Manila');
	$date_cancelled = date('Y-m-d H:i:s');
	$remarks = $_SESSION['cancel_remarks'];

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];

    if ($cancellation=='YES') {
		$sql = "UPDATE tbl_save_clientbene SET cancellation='$cancellation', date_cancelled='$date_cancelled', remarks='$remarks' WHERE id_tbl_save_clientbene='$id_tbl_save_clientbene'";
        if ($conn->query($sql) === TRUE) {
		    //echo "Transaction CANCELLED successfully!";
            echo '<script>';
                echo 'alert("Transaction CANCELLED successfully!\nTransaction ID: '. $id_tbl_save_clientbene .'");';
            echo '</script>';
		} else {
		    echo "Error CANCELLING record: " . $conn->error;
		}
	} else {
		$sql = "UPDATE tbl_save_clientbene SET cancellation='', date_cancelled='', remarks='' WHERE id_tbl_save_clientbene='$id_tbl_save_clientbene'";
        if ($conn->query($sql) === TRUE) {
		    //echo "Transaction UNCANCELLED successfully!";
            echo '<script>';
                echo 'alert("Transaction UNCANCELLED successfully!\nTransaction ID: '. $id_tbl_save_clientbene .'");';
            echo '</script>';
		} else {
		    echo "Error UNCANCELLING record: " . $conn->error;
		}
	}
	$conn->close();
    
    echo '<script>';
        echo 'window.location.href = "../'.$sys_acronym.'/manage_db.php";';
    echo '</script>';
    //header("location: manage_db.php");
?>