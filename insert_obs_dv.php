<?php
	session_start();
    date_default_timezone_set('Asia/Manila'); $datenow = date('d-m-Y');
	include 'config.php';
    $checked_bills = $_SESSION['checkbox'];
    //$obs_dv_code = $_SESSION['obs_dv_code'];
    $obs_dv_date = $_SESSION['obs_dv_date'];
    $prep_by = $_SESSION['prep_by'];

    $checkbox_exp = explode(',', $_SESSION['checkbox']);
    $checkbox_arrval = array_values($checkbox_exp);
    $count = count($checkbox_arrval)-2;
    $count2 = $count+1;

//SET OBDV CODE START
    $dnow = date_format(new DateTime($datenow), "d-m-Y");
    $ynow = date_format(new DateTime($datenow), "Y");
    $mnow = date_format(new DateTime($datenow), "m");
    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $cis_office = $row_sysname['cis_office'];
    //COUNT OBDVs TRACKED FOR THE CURRENT YEAR & MONTH AND SET NEXT OBDV CODE
    $sql_obdv_code = mysqli_query($conn,"SELECT * FROM tbl_obs_dv WHERE YEAR(date_tracked)='$ynow' AND MONTH(date_tracked)=$mnow;");
    if ($sql_obdv_code->num_rows > 0){
        $obdv_count = $sql_obdv_code->num_rows;
        $obdv_count2 = $obdv_count+1;
        //echo 'ROW COUNT FOR FEB.: '.$obdv_count;
        if (strlen($obdv_count2)==1) {
            $obdv_count2 = "000".$obdv_count2;
        } else if (strlen($obdv_count2)==2) {
            $obdv_count2 = "00".$obdv_count2;
        } else if (strlen($obdv_count2)==3) {
            $obdv_count2 = "0".$obdv_count2;
        } else {$obdv_count2;}
        $obdv_mo = date_format(new DateTime($datenow), "m");
        $obdv_y = date_format(new DateTime($datenow), "Y");
        $obdv_code = $cis_office."-OBDV-".$obdv_y."-".$obdv_mo."-".$obdv_count2;
    } else {
        $obdv_count = 0;
        $obdv_count2 = $obdv_count+1;
        if (strlen($obdv_count2)==1) {
            $obdv_count2 = "000".$obdv_count2;
        } else if (strlen($obdv_count2)==2) {
            $obdv_count2 = "00".$obdv_count2;
        } else if (strlen($obdv_count2)==3) {
            $obdv_count2 = "0".$obdv_count2;
        } else {$obdv_count2;}
        $obdv_mo = date_format(new DateTime($datenow), "m");
        $obdv_y = date_format(new DateTime($datenow), "Y");
        $obdv_code = $cis_office."-OBDV-".$obdv_y."-".$obdv_mo."-".$obdv_count2;
    }
//SET OBDV CODE END

    //Loop through each array index
    for($i = 0; $i <= $count; $i++) {
        $i2 = $i+1;
        //Assign the value of the array key to a variable
        $billing_code = $checkbox_arrval[$i];

        //insert to tbl_vouched_bills
        $sql2 = "INSERT INTO tbl_vouched_bills (billing_code2, obs_dv_code2, obs_dv_date2, prep_by2) VALUES ('$billing_code', '$obdv_code', '$obs_dv_date', '$prep_by')";
        if ($conn->query($sql2) === TRUE) {
            echo "Vouched billings updated successfully!";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }

    //insert to tbl_obs_dv
	$sql = "INSERT INTO tbl_obs_dv (obs_dv_code, billing_code, obs_dv_date, prep_by) VALUES ('$obdv_code', '$checked_bills', '$obs_dv_date', '$prep_by')";
        if ($conn->query($sql) === TRUE) {
            //echo "Newly tracked OBs & DV added successfully!";
            echo '<script>';
                echo 'alert("NEWLY TRACKED OBDV ADDED SUCCESSFULLY!\nThis code is Automated. Write this code on the OB.\nOBDV Code: '. $obdv_code .'");';
                echo 'window.location.href = "../'.$sys_acronym.'/track_obsdv.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
     
	$conn->close();
    //header("location: track_billings.php");
	?>