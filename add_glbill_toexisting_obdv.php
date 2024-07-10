<?php
	session_start();
    //$_SESSION['start_date3']; $_SESSION['end_date3']; $_SESSION['datenow'];
	include 'config.php';
    $checked_glbill = $_SESSION['checkbox'];
    $obs_dv_code2 = $_SESSION['mdl_obdv_code'];

    //get details of existing OBDV
    $sql_get_dtls_x_obdv = mysqli_query($conn,"SELECT * FROM tbl_vouched_bills WHERE obs_dv_code2='$obs_dv_code2' ");
    $row_get_dtls_x_obdv = mysqli_fetch_assoc($sql_get_dtls_x_obdv);
    $obs_dv_date2 = $row_get_dtls_x_obdv['obs_dv_date2'];
    $prep_by2 = $row_get_dtls_x_obdv['prep_by2'];

    $checkbox_exp = explode(',', $checked_glbill);
    $checkbox_arrval = array_values($checkbox_exp);
    $count = count($checkbox_arrval)-2;
    $count2 = $count+1;

    //Loop through each array index
    for($i = 0; $i <= $count; $i++) {
        $i2 = $i+1;
        //Assign the value of the array key to a variable
        $billing_code2 = $checkbox_arrval[$i];

        //insert to tbl_vouched_bills
        $sql_addglbill_to_x_obdv = "INSERT INTO tbl_vouched_bills (billing_code2, obs_dv_code2, obs_dv_date2, prep_by2) VALUES ('$billing_code2', '$obs_dv_code2', '$obs_dv_date2', '$prep_by2')";
        if ($conn->query($sql_addglbill_to_x_obdv) === TRUE) {
            echo "Newly tracked GL-Bill (Code: ".$billing_code2.") added successfully to existing OBDV!";
            //echo '<script>alert("Newly tracked GL-Bill (Code: ".$billing_code2.") added successfully to existing OBDV!");</script>';
        } else {
            echo "Error: " . $sql_addglbill_to_x_obdv . "<br>" . $conn->error;
            //echo '<script>alert("Error: " . $sql_addglbill_to_x_obdv . "<br>" . $conn->error");</script>';
        }
    }

    //get previously checked GL-Bills
    $sql_get_prev_chkd_glbill = mysqli_query($conn,"SELECT * FROM tbl_obs_dv WHERE obs_dv_code='$obs_dv_code2' ");
    $row_get_prev_chkd_glbill = mysqli_fetch_assoc($sql_get_prev_chkd_glbill);
    $prev_chkd_glbill = $row_get_prev_chkd_glbill['billing_code'];

    //combine previously checked GLBills with add'l. GLBills
    $updated_chkd_glbill = $prev_chkd_glbill."".$checked_glbill;

    //update checked GLBills
    $sql_updt_tbl_obs_dv = "UPDATE tbl_obs_dv SET billing_code='$updated_chkd_glbill' WHERE obs_dv_code='$obs_dv_code2'";
    if ($conn->query($sql_updt_tbl_obs_dv) === TRUE) {
        echo "Record of checked billing_code/s on tbl_obs_dv updated successfully(Current GL-Bill/s: ".$updated_chkd_glbill.")!";
    } else {
        echo "Error updating tbl_obs_dv record on checked billing_code/s: " . $sql_updt_tbl_obs_dv . "<br>" . $conn->error;
    }
     
	$conn->close();
    header("location: track_billings.php");
?>