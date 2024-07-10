<?php
	session_start();
	$_SESSION['qn'];
	include 'config.php';
	$sql_clq = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['qn']."' ");
    $row_clq = mysqli_fetch_assoc($sql_clq);

	$cl_lname = $_SESSION['cl_lname'];
    $cl_fname = $_SESSION['cl_fname'];
    $cl_mname = $_SESSION['cl_mname'];
    $cl_nameext = $_SESSION['cl_nameext'];
    $cl_contact_num = $_SESSION['cl_contact_num'];
    $cl_cstatus = $_SESSION['cl_cstatus'];
    $cl_bday = $_SESSION['cl_bday'];
    $cl_age = $_SESSION['cl_age'];
    $cl_sex = $_SESSION['cl_sex'];
    $cl_occupation = $_SESSION['cl_occupation'];
    $cl_salary = $_SESSION['cl_salary'];
    //RELATIONSHIP
    $cl_reltobene_initial = $_SESSION['cl_reltobene'];
    $cl_reltobene_others_initial = $_SESSION['cl_reltobene_others'];
    $cl_reltobene = "";
    if ($cl_reltobene_initial == "Others") {
        $cl_reltobene = $cl_reltobene_others_initial;
    } else {
        $cl_reltobene = $cl_reltobene_initial;
    }
    //CATEGORY
    $cl_category = $_SESSION['cl_category'];
    //SUB-CATEGORY
    $cl_subcategory_initial = $_SESSION['cl_subcategory'];
    $cl_subcategory_others_initial = $_SESSION['cl_subcategory_others'];
    $cl_subcategory = "";
    if ($cl_subcategory_initial == "Others") {
        $cl_subcategory = $cl_subcategory_others_initial;
    } else {
        $cl_subcategory = $cl_subcategory_initial;
    }
    //SUB-CATEGORY2
    $cl_subcategory2_initial = $_SESSION['cl_subcategory2'];
    $cl_subcategory2_others_initial = $_SESSION['cl_subcategory2_others'];
    $cl_subcategory2 = "";
    if ($cl_subcategory2_initial == "Others") {
        $cl_subcategory2 = $cl_subcategory2_others_initial;
    } else {
        $cl_subcategory2 = $cl_subcategory2_initial;
    }
    $cl_ipAffiliation = $_SESSION['cl_ipAffiliation'];
    $cl_status = $_SESSION['cl_status'];
    $cl_pcn = $_SESSION['cl_pcn'];
    $cl_4Pschoice = $_SESSION['cl_4Pschoice'];
    $cl_4Psnum = $_SESSION['cl_4Psnum'];
    
    //update client details
    if ($row_clq['cl_reltobene'] == "Self") {
    	$sql = "UPDATE tbl_clientqueue SET cl_pcn='$cl_pcn', cl_4Pschoice='$cl_4Pschoice', cl_4Psnum='$cl_4Psnum', cl_lname='$cl_lname', cl_fname='$cl_fname', cl_mname='$cl_mname', cl_nameext='$cl_nameext', cl_contact_num='$cl_contact_num', cl_bday='$cl_bday', cl_age='$cl_age', cl_cstatus='$cl_cstatus', cl_sex='$cl_sex', cl_occupation='$cl_occupation', cl_salary='$cl_salary', cl_reltobene='$cl_reltobene', cl_category='$cl_category', cl_subcategory='$cl_subcategory', cl_subcategory2='$cl_subcategory2', cl_ipAffiliation='$cl_ipAffiliation', cl_status='$cl_status', bn_4Pschoice='$cl_4Pschoice', bn_4Psnum='$cl_4Psnum', bn_lname='$cl_lname', bn_fname='$cl_fname', bn_mname='$cl_mname', bn_nameext='$cl_nameext', bn_contact_num='$cl_contact_num', bn_bday='$cl_bday', bn_age='$cl_age', bn_cstatus='$cl_cstatus', bn_sex='$cl_sex', bn_occupation='$cl_occupation', bn_salary='$cl_salary', bn_reltoclient='$cl_reltobene', bn_category='$cl_category', bn_subcategory='$cl_subcategory', bn_subcategory2='$cl_subcategory2', bn_ipAffiliation='$cl_ipAffiliation' WHERE cl_qn='".$_SESSION['qn']."' ";
        if ($conn->query($sql) === TRUE) {
		    echo "Client/Bene Details updated successfully!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
    } else {       
		$sql = "UPDATE tbl_clientqueue SET cl_pcn='$cl_pcn', cl_4Pschoice='$cl_4Pschoice', cl_4Psnum='$cl_4Psnum', cl_lname='$cl_lname', cl_fname='$cl_fname', cl_mname='$cl_mname', cl_nameext='$cl_nameext', cl_contact_num='$cl_contact_num', cl_bday='$cl_bday', cl_age='$cl_age', cl_cstatus='$cl_cstatus', cl_sex='$cl_sex', cl_occupation='$cl_occupation', cl_salary='$cl_salary', cl_reltobene='$cl_reltobene', cl_category='$cl_category', cl_subcategory='$cl_subcategory', cl_subcategory2='$cl_subcategory2', cl_ipAffiliation='$cl_ipAffiliation', cl_status='$cl_status' WHERE cl_qn='".$_SESSION['qn']."' ";
        if ($conn->query($sql) === TRUE) {
		    echo "Client Details updated successfully!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}
	$conn->close();
    header("location: viewGIS.php");
	?>