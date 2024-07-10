<?php
	session_start();
    $_SESSION['start_date3']; $_SESSION['end_date3']; $_SESSION['datenow'];
	include 'config.php';
    $checked_gls = $_SESSION['checkbox'];
    //$billing_code = $_SESSION['billing_code'];
    $billing_date = $_SESSION['billing_date'];
    $sp_id = $_SESSION['sp_id'];
    $date_received = $_SESSION['date_received'];
    $received_by = $_SESSION['received_by'];
    $period_from = $_SESSION['period_from'];
    $period_to = $_SESSION['period_to'];
    $tracked_by = $_SESSION['staffid'];

    $checkbox_exp = explode(',', $_SESSION['checkbox']);
    $checkbox_arrval = array_values($checkbox_exp);
    $count = count($checkbox_arrval)-2;
    $count2 = $count+1;

//SET BILLING CODE START
    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $cis_office = $row_sysname['cis_office'];
    //GET CURRENT YEAR & MONTH
    $ynow = date_format(new DateTime($_SESSION['datenow']), "Y");
    $mnow = date_format(new DateTime($_SESSION['datenow']), "m");
    //echo 'Year now: '.$ynow.'<br>Month now: '.$mnow.'<br>';
    $bill_mo = $mnow;
    $bill_y = $ynow;
    //COUNT BILLINGS TRACKED FOR THE CURRENT YEAR & MONTH AND SET NEXT BILLING CODE
    $sql_billingcode = mysqli_query($conn,"SELECT * FROM tbl_track_gl WHERE YEAR(date_tracked)='$ynow' AND MONTH(date_tracked)='$mnow' ");
    if ($sql_billingcode->num_rows > 0){
        $bill_count = $sql_billingcode->num_rows;
        $bill_count2 = $bill_count+1;
        if (strlen($bill_count2)==1) {
            $bill_count2 = "000".$bill_count2;
        } else if (strlen($bill_count2)==2) {
            $bill_count2 = "00".$bill_count2;
        } else if (strlen($bill_count2)==3) {
            $bill_count2 = "0".$bill_count2;
        } else {$bill_count2;}
        $billing_code = $cis_office."-GLBill-".$bill_y."-".$bill_mo."-".$bill_count2;
    } else {
        $bill_count = 0;
        $bill_count2 = $bill_count+1;
        if (strlen($bill_count2)==1) {
            $bill_count2 = "000".$bill_count2;
        } else if (strlen($bill_count2)==2) {
            $bill_count2 = "00".$bill_count2;
        } else if (strlen($bill_count2)==3) {
            $bill_count2 = "0".$bill_count2;
        } else {$bill_count2;}
        $billing_code = $cis_office."-GLBill-".$bill_y."-".$bill_mo."-".$bill_count2;
    }
//SET BILLING CODE END

    //Loop through each array index
    for($i = 0; $i <= $count; $i++) {
        $i2 = $i+1;
        //Assign the value of the array key to a variable
        $gl_id = $checkbox_arrval[$i];

        //insert to tbl_tracked_gls
        $sql2 = "INSERT INTO tbl_tracked_gls (billing_code, gl_id) VALUES ('$billing_code', '$gl_id')";
        if ($conn->query($sql2) === TRUE) {
            echo "Newly tracked GLs added successfully!";
            //echo '<script>alert("Newly tracked billing added successfully!");</script>';
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
            //echo '<script>alert("Error: " . $sql2 . "<br>" . $conn->error");</script>';
        }
    }

    //insert to tbl_track_gl
	$sql = "INSERT INTO tbl_track_gl (billing_code, billing_date, sp_id, checked_gls, date_received, received_by, period_from, period_to, tracked_by) VALUES ('$billing_code', '$billing_date', '$sp_id', '$checked_gls', '$date_received', '$received_by', '$period_from', '$period_to', '$tracked_by')";
        if ($conn->query($sql) === TRUE) {
            //echo "Newly tracked billing added successfully!";
            echo '<script>';
                echo 'alert("NEWLY TRACKED BILLING ADDED SUCCESSFULLY!\nThis code is Automated. Write this code on the bill.\nBilling Code: '. $billing_code .'");';
                echo 'window.location.href = "../'.$sys_acronym.'/track_billings.php";';
            echo '</script>';
            //echo '<script>alert("Newly tracked billing added successfully!<br><b>Billing Code: " .$billing_code. "</b>"); window.location.href=..\track_billings.php; </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            //echo '<script>alert("Error: " . $sql . "<br>" . $conn->error");</script>';
        }
     
	$conn->close();
    //header("location: track_billings.php");
	?>