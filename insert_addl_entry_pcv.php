<?php
	session_start();
	include 'config.php';
    
    $cl_qn = $_SESSION['cl_qn'];
    $release_mode = $_SESSION['release_mode'];
    $admission_mode = $_SESSION['admission_mode'];

    $purpose = $_SESSION['purpose'];
    $remarks_pcv = $_SESSION['remarks_pcv'];
    $canvassed_by = "";
    $sql_as_type = mysqli_query($conn,"SELECT assistance_type FROM tbl_assistance WHERE assistance_purpose='".$purpose."' ");
    $row_as_type = mysqli_fetch_assoc($sql_as_type);
    $assistance_type = $row_as_type['assistance_type'];

    $sp = "";
    $sp_address = "";

    $amount_in_figures = $_SESSION['amount_in_figures'];
    $amount_in_words = $_SESSION['amount_in_words'];
    $fund_source = $_SESSION['fund_source'];

    $cl_id = "";
    $cl_id_initial = $_SESSION['cl_id'];
    $cl_id_others = $_SESSION['cl_id_others'];
    if ($cl_id_initial == 'Others') {
        $cl_id = $cl_id_others;
    } else {
        $cl_id = $cl_id_initial;
    }

    $bn_id = "";
    $bn_id_initial = $_SESSION['bn_id'];
    $bn_id_others = $_SESSION['bn_id_others'];
    if ($bn_id_initial == 'Others') {
        $bn_id = $bn_id_others;
    } else {
        $bn_id = $bn_id_initial;
    }

    $other_attachments = $_SESSION['other_attachments'];
    $other_attachments2 = $_SESSION['other_attachments2'];
    $other_addl_attachments = $_SESSION['other_addl_attachments'];

    $material_assistance = $_SESSION['material_assistance'];
    $psycho_support = $_SESSION['psycho_support'];
    $referral = $_SESSION['referral'];
    $diagnosis = $_SESSION['diagnosis'];
    $assessment = $_SESSION['assessment'];

    $swo_staffid = $_SESSION['swo_staffid'];

//SET PCV CODE START
    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];
    $pcv_code_prefix = $row_sysname['cis_office']; $office = $row_sysname['office'];

    date_default_timezone_set('Asia/Manila');
    $mnow = date('m');
    $ynow = date('Y');
    $sql_pcvcode = mysqli_query($conn,"SELECT * FROM tbl_save_addl_entry INNER JOIN tbl_save_clientbene ON tbl_save_addl_entry.id_tbl_save_addl_entry=tbl_save_clientbene.id_tbl_save_clientbene WHERE release_mode='CASH' AND cancellation!='YES' AND YEAR(time_end2)='$ynow' AND MONTH(time_end2)='$mnow' AND branch_served='$office' ");
    $pcv_code = '';
    if ($sql_pcvcode->num_rows > 0){
        $pcv_count = $sql_pcvcode->num_rows;
        $pcv_count2 = $pcv_count+1;
        if (strlen($pcv_count2)==1) {
            $pcv_count2 = "000".$pcv_count2;
        } else if (strlen($pcv_count2)==2) {
            $pcv_count2 = "00".$pcv_count2;
        } else if (strlen($pcv_count2)==3) {
            $pcv_count2 = "0".$pcv_count2;
        } else {$pcv_count2;}
        $pcv_mo = date('m');
        $pcv_y = date('Y');
        $pcv_code = $pcv_code_prefix."-".$pcv_y."-".$pcv_mo."-".$pcv_count2;
    } else {
        $pcv_count = 0;
        $pcv_count2 = $pcv_count+1;
        if (strlen($pcv_count2)==1) {
            $pcv_count2 = "000".$pcv_count2;
        } else if (strlen($gl_count2)==2) {
            $pcv_count2 = "00".$pcv_count2;
        } else if (strlen($pcv_count2)==3) {
            $pcv_count2 = "0".$pcv_count2;
        } else {$pcv_count2;}
        $pcv_mo = date('m');
        $pcv_y = date('Y');
        $pcv_code = $pcv_code_prefix."-".$pcv_y."-".$pcv_mo."-".$pcv_count2;
        //$pcv_code = $_SESSION['pcv_code'];
    }

    $result = mysqli_query($conn,"SELECT * FROM tbl_addl_entry WHERE cl_qn='$cl_qn' AND release_mode='$release_mode' AND admission_mode='$admission_mode' AND assistance_type='$assistance_type' AND purpose='$purpose' AND sp='$sp' AND amount_in_figures='$amount_in_figures' AND fund_source='$fund_source' AND assessment='$assessment' AND gl_code='$pcv_code' ");

    if ($result->num_rows > 0) {
        echo "No. of Results: ".$result->num_rows."<br>";
        echo "Additional Entries Already Submitted!<br>";
        echo '<script>';
            echo 'alert("Additional Entries Already Submitted!.\nPCV Code: '. $pcv_code .'");';
            echo 'window.location.href = "../'.$sys_acronym.'/forms_sw_pcv.php";';
        echo '</script>';
    } else {
        //insert addl entry
    	$sql = "INSERT INTO tbl_addl_entry (cl_qn, release_mode, admission_mode, assistance_type, purpose, remarks_pcv, canvassed_by, sp, sp_address, amount_in_figures, amount_in_words, fund_source, cl_id, bn_id, other_attachments, other_attachments2, other_addl_attachments, material_assistance, psycho_support, referral, diagnosis, assessment, gl_code, swo_staffid)
            VALUES ('$cl_qn', '$release_mode', '$admission_mode', '$assistance_type', '$purpose', '$remarks_pcv', '$canvassed_by', '$sp', '$sp_address', '$amount_in_figures', '$amount_in_words', '$fund_source', '$cl_id', '$bn_id', '$other_attachments', '$other_attachments2', '$other_addl_attachments', '$material_assistance', '$psycho_support', '$referral', '$diagnosis', '$assessment', '$pcv_code', '$swo_staffid')";

        if ($conn->query($sql) === TRUE) {
            echo "New data added successfully";
            echo '<script>';
                echo 'alert("Additional Entries Submitted Successfully!.\nPCV Code: '. $pcv_code .'\nPrepare to Save Transaction.");';
                echo 'window.location.href = "../'.$sys_acronym.'/forms_sw_pcv.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
	$conn->close();
    //header("location: forms_sw_pcv.php");
?>