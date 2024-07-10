<?php
	session_start();
    $_SESSION['cl_qn2'];
	include 'config.php';

	$bn_lname = $_SESSION['bn_lname'];
    $bn_fname = $_SESSION['bn_fname'];
    $bn_mname = $_SESSION['bn_mname'];
    $bn_nameext = $_SESSION['bn_nameext'];
    $bn_contact_num = $_SESSION['bn_contact_num'];
    $bn_cstatus = $_SESSION['bn_cstatus'];
    $bn_bday = $_SESSION['bn_bday'];
    $bn_age = $_SESSION['bn_age'];
    $bn_sex = $_SESSION['bn_sex'];
    $bn_occupation = $_SESSION['bn_occupation'];
    $bn_salary = $_SESSION['bn_salary'];
    //RELATIONSHIP
    $bn_reltoclient_initial = $_SESSION['bn_reltoclient'];
    $bn_reltoclient_others_initial = $_SESSION['bn_reltoclient_others'];
    $bn_reltoclient = "";
    if ($bn_reltoclient_initial == "Others") {
        $bn_reltoclient = $bn_reltoclient_others_initial;
    } else {
        $bn_reltoclient = $bn_reltoclient_initial;
    }
    //CATEGORY
    $bn_category = $_SESSION['bn_category'];
    //SUB-CATEGORY
    $bn_subcategory_initial = $_SESSION['bn_subcategory'];
    $bn_subcategory_others_initial = $_SESSION['bn_subcategory_others'];
    $bn_subcategory = "";
    if ($bn_subcategory_initial == "Others") {
        $bn_subcategory = $bn_subcategory_others_initial;
    } else {
        $bn_subcategory = $bn_subcategory_initial;
    }
    //SUB-CATEGORY2
    $bn_subcategory2_initial = $_SESSION['bn_subcategory2'];
    $bn_subcategory2_others_initial = $_SESSION['bn_subcategory2_others'];
    $bn_subcategory2 = "";
    if ($bn_subcategory2_initial == "Others") {
        $bn_subcategory2 = $bn_subcategory2_others_initial;
    } else {
        $bn_subcategory2 = $bn_subcategory2_initial;
    }
    $bn_ipAffiliation = $_SESSION['bn_ipAffiliation'];
    $bn_4Pschoice = $_SESSION['bn_4Pschoice'];
    $bn_4Psnum = $_SESSION['bn_4Psnum'];
    
    //update client
	$sql = "UPDATE tbl_save_clientbene SET bn_4Pschoice='$bn_4Pschoice', bn_4Psnum='$bn_4Psnum', bn_lname='$bn_lname', bn_fname='$bn_fname', bn_mname='$bn_mname', bn_nameext='$bn_nameext', bn_contact_num='$bn_contact_num', bn_bday='$bn_bday', bn_age='$bn_age', bn_cstatus='$bn_cstatus', bn_sex='$bn_sex', bn_occupation='$bn_occupation', bn_salary='$bn_salary', bn_reltoclient='$bn_reltoclient', bn_category='$bn_category', bn_subcategory='$bn_subcategory', bn_subcategory2='$bn_subcategory2', bn_ipAffiliation='$bn_ipAffiliation' WHERE id_tbl_save_clientbene ='".$_SESSION['cl_qn2']."' ";
        if ($conn->query($sql) === TRUE) {
		    echo "Bene Details updated successfully!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	$conn->close();
    header("location: modify_cl_bn_sw.php");
	?>