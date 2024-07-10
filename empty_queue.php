<?php
	session_start();
	include 'config.php';

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];
    
    $sql_empty_assigntbl = "TRUNCATE TABLE tbl_assign_table";
        if ($conn->query($sql_empty_assigntbl) === TRUE) {
            echo "Truncated/Emptied Table tbl_assign_table Successfully!";
        } else {
            echo "Error: " . $sql_empty_assigntbl . "<br>" . $conn->error;
        }

	$sql_empty_clq = "TRUNCATE TABLE tbl_clientqueue";
        if ($conn->query($sql_empty_clq) === TRUE) {
            echo "Truncated/Emptied Table tbl_clientqueue Successfully!";
        } else {
            echo "Error: " . $sql_empty_clq . "<br>" . $conn->error;
        }

    $sql_empty_famcomposition = "TRUNCATE TABLE tbl_famcomposition";
        if ($conn->query($sql_empty_famcomposition) === TRUE) {
            echo "Truncated/Emptied Table tbl_famcomposition Successfully!";
        } else {
            echo "Error: " . $sql_empty_famcomposition . "<br>" . $conn->error;
        }

    $sql_empty_addlentry = "TRUNCATE TABLE tbl_addl_entry";
        if ($conn->query($sql_empty_addlentry) === TRUE) {
            echo "Truncated/Emptied Table tbl_addl_entry Successfully!";
        } else {
            echo "Error: " . $sql_empty_addlentry . "<br>" . $conn->error;
        }

    $sql_empty_computation = "TRUNCATE TABLE tbl_computation";
        if ($conn->query($sql_empty_computation) === TRUE) {
            echo "Truncated/Emptied Table tbl_computation Successfully!";
        } else {
            echo "Error: " . $sql_empty_computation . "<br>" . $conn->error;
        }

    $sql_empty_computation2 = "TRUNCATE TABLE tbl_computation2";
        if ($conn->query($sql_empty_computation2) === TRUE) {
            echo "Truncated/Emptied Table tbl_computation2 Successfully!";
        } else {
            echo "Error: " . $sql_empty_computation2 . "<br>" . $conn->error;
        }

    echo '<script>';
        echo 'alert("Previous Queue Emptied Successfully!.\nPrepare to go back to your Homepage.");';
        echo 'window.location.href = "../'.$sys_acronym.'/home_verifier.php";';
    echo '</script>';
    $conn->close();
    //header("location: home_verifier.php");
?>