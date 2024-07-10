<?php
	session_start();
	include 'config.php';

    $cl_qn2 = $_SESSION['cl_qn22'];
    $queue_status = "Pending";

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];

    $up_sql = "UPDATE tbl_clientqueue SET queue_status = '$queue_status' WHERE cl_qn = '$cl_qn2' ";
        if ($conn->query($up_sql) === TRUE) {
            echo '<script>';
                echo 'alert("Client`s queueing status updated to <Pending> successfully!.");';
                echo 'window.location.href = "../'.$sys_acronym.'/home_sw.php";';
            echo '</script>';
            //echo "Client's queueing status updated to <Pending> successfully!";
        } else {
            echo "Error: " . $up_sql . "<br>" . $conn->error;
        }
	$conn->close();
    //header("location: track_billings.php");
	?>