<?php
    session_start();
    $_SESSION['id_tbl_save_addl_entry']; $_SESSION['cl_qn'];
    include 'config.php';
    
    $id_tbl_save_addl_entry = $_SESSION['id_tbl_save_addl_entry'];
    $cl_qn = $_SESSION['cl_qn'];
    $transaction_code = $_SESSION['transaction_code'];
    $admission_mode = $_SESSION['admission_mode'];
    $release_mode = $_SESSION['release_mode'];
    $purpose = $_SESSION['purpose'];
    $remarks_pcv = $_SESSION['remarks_pcv'];
        $sql_as_type = mysqli_query($conn,"SELECT assistance_type FROM tbl_assistance WHERE assistance_purpose='".$purpose."' ");
        $row_as_type = mysqli_fetch_assoc($sql_as_type);
    $assistance_type = $row_as_type['assistance_type'];
    $assistance_type = $row_as_type['assistance_type'];
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

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];
    
    //update addl entry
	$sql = "UPDATE tbl_save_addl_entry SET transaction_code='$transaction_code', release_mode='$release_mode', admission_mode='$admission_mode', assistance_type='$assistance_type', purpose='$purpose', remarks_pcv='$remarks_pcv', amount_in_figures='$amount_in_figures', amount_in_words='$amount_in_words', fund_source='$fund_source', cl_id='$cl_id', bn_id='$bn_id', other_attachments='$other_attachments', other_attachments2='$other_attachments2', other_addl_attachments='$other_addl_attachments', material_assistance='$material_assistance', psycho_support='$psycho_support', referral='$referral', diagnosis='$diagnosis', assessment='$assessment' WHERE id_tbl_save_addl_entry='$id_tbl_save_addl_entry'";
        if ($conn->query($sql) === TRUE) {
            echo "Additional Entry/ies Updated Successfully!";
            echo '<script>';
                echo 'alert("Additional Entry/ies Updated Successfully!.\nPCV Code: '. $transaction_code .'");';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
    echo '<script>';
        echo 'window.location.href = "../'.$sys_acronym.'/modify_forms_sw_pcv.php";';
    echo '</script>';
    
	$conn->close();
    //header("location: modify_forms_sw_pcv.php");
?>