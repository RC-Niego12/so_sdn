<?php
	session_start();
    $_SESSION['start_date3']; $_SESSION['end_date3']; $_SESSION['datenow'];
	include 'config.php';
    $checked_gls = $_SESSION['checkbox'];
    $billing_code = $_SESSION['gl_bill_code'];

    $checkbox_exp = explode(',', $_SESSION['checkbox']);
    $checkbox_arrval = array_values($checkbox_exp);
    $count = count($checkbox_arrval)-2;
    $count2 = $count+1;

    //Loop through each array index
    for($i = 0; $i <= $count; $i++) {
        $i2 = $i+1;
        //Assign the value of the array key to a variable
        $gl_id = $checkbox_arrval[$i];

        //insert to tbl_tracked_gls
        $sql2 = "INSERT INTO tbl_tracked_gls (billing_code, gl_id) VALUES ('$billing_code', '$gl_id')";
        if ($conn->query($sql2) === TRUE) {
            echo "Newly tracked GL (GL ID: ".$gl_id.") added successfully to existing GL-Bill!";
            //echo '<script>alert("Newly tracked GLs added successfully to existing GL-Bill!");</script>';
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
            //echo '<script>alert("Error: " . $sql2 . "<br>" . $conn->error");</script>';
        }
    }

    //get previously checked GLs
    $sql_get_prev_chkd_gls = mysqli_query($conn,"SELECT * FROM tbl_track_gl WHERE billing_code='$billing_code' ");
    $row_get_prev_chkd_gls = mysqli_fetch_assoc($sql_get_prev_chkd_gls);
    $prev_chkd_gls = $row_get_prev_chkd_gls['checked_gls'];

    //combine previously checked GLs with add'l. GLs
    $updated_chkd_gls = $prev_chkd_gls."".$checked_gls;

    //update checked GLs
    $sql_updt_tbl_track_gl = "UPDATE tbl_track_gl SET checked_gls='$updated_chkd_gls' WHERE billing_code='$billing_code'";
    if ($conn->query($sql_updt_tbl_track_gl) === TRUE) {
        echo '<script>';
            echo 'alert("Record of checked_gls on tbl_track_gl updated successfully(Current GLs: ".$updated_chkd_gls.")!\n");';
            echo 'window.location.href = "../'.$sys_acronym.'/track_GLs.php";';
        echo '</script>';
        //echo "Record of checked_gls on tbl_track_gl updated successfully(Current GLs: ".$updated_chkd_gls.")!";
    } else {
        echo "Error updating tbl_track_gl record on checked_gls: " . $sql_updt_tbl_track_gl . "<br>" . $conn->error;
    }
     
	$conn->close();
    //header("location: track_GLs.php");
	?>