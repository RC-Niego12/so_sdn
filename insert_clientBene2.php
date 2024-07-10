<?php
	session_start();
	include 'config.php';
	//client session
    //PCN AND 4PS
    $cl_pcn = $_SESSION['cl_pcn'];
    $cl_4Pschoice = $_SESSION['cl_4Pschoice'];
    $cl_4Psnum = $_SESSION['cl_4Psnum'];
    $verifier = $_SESSION['verifier'];
    //NAME
    $cl_lname = $_SESSION['cl_lname'];
    $cl_fname = $_SESSION['cl_fname'];
    $cl_mname = $_SESSION['cl_mname'];
    $cl_nameext = $_SESSION['cl_nameext'];
    //ADDRESS
    $cl_purok = $_SESSION['cl_purok'];
    $cl_brgy = $_SESSION['cl_brgy'];
    $cl_brgy_code = $_SESSION['cl_brgy_code'];
    $cl_mun = $_SESSION['cl_mun'];
    $cl_mun_code = $_SESSION['cl_mun_code'];
    $cl_prov = $_SESSION['cl_prov'];
    $cl_prov_code = $_SESSION['cl_prov_code'];
    $cl_district = $_SESSION['cl_district'];
    $cl_region = $_SESSION['cl_region'];
    $cl_region_code = $_SESSION['cl_region_code'];
    //OTHERS
    $cl_contact_num = $_SESSION['cl_contact_num'];
    $cl_bday = $_SESSION['cl_bday'];
    $cl_age = $_SESSION['cl_age'];
    $cl_cstatus = $_SESSION['cl_cstatus'];
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

    //bene session
    //4PS
    $bn_4Pschoice = $_SESSION['bn_4Pschoice'];
    $bn_4Psnum = $_SESSION['bn_4Psnum'];
    //NAME
    $bn_lname = $_SESSION['bn_lname'];
    $bn_fname = $_SESSION['bn_fname'];
    $bn_mname = $_SESSION['bn_mname'];
    $bn_nameext = $_SESSION['bn_nameext'];
    //ADDRESS
    $bn_purok = $_SESSION['bn_purok'];
    $bn_brgy = $_SESSION['bn_brgy'];
    $bn_brgy_code = $_SESSION['bn_bry_code'];
    $bn_mun = $_SESSION['bn_mun'];
    $bn_mun_code = $_SESSION['bn_mun_code'];
    $bn_prov = $_SESSION['bn_prov'];
    $bn_prov_code = $_SESSION['bn_prov_code'];
    $bn_district = $_SESSION['bn_district'];
    $bn_region = $_SESSION['bn_region'];
    $bn_region_code = $_SESSION['bn_region_code'];
    //OTHERS
    $bn_contact_num = $_SESSION['bn_contact_num'];
    $bn_bday = $_SESSION['bn_bday'];
    $bn_age = $_SESSION['bn_age'];
    $bn_cstatus = $_SESSION['bn_cstatus'];
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
    $queue_status = "Waiting";

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];
    
    //insert client & bene
    $sql = "INSERT INTO tbl_clientQueue (cl_pcn, cl_4Pschoice, cl_4Psnum, cl_lname, cl_fname, cl_mname, cl_nameext, cl_purok, cl_brgy, cl_brgy_code, cl_mun, cl_mun_code, cl_prov, cl_prov_code, cl_district, cl_region, cl_region_code, cl_contact_num, cl_bday, cl_age, cl_cstatus, cl_sex, cl_occupation, cl_salary, cl_reltobene, cl_category, cl_subcategory, cl_subcategory2, cl_ipAffiliation, cl_status, bn_4Pschoice, bn_4Psnum, bn_lname, bn_fname, bn_mname, bn_nameext, bn_purok, bn_brgy, bn_brgy_code, bn_mun, bn_mun_code, bn_prov, bn_prov_code, bn_district, bn_region, bn_region_code, bn_contact_num, bn_bday, bn_age, bn_cstatus, bn_sex, bn_occupation, bn_salary, bn_reltoclient, bn_category, bn_subcategory, bn_subcategory2, bn_ipAffiliation, queue_status, verifier)
        VALUES ('$cl_pcn', '$cl_4Pschoice', '$cl_4Psnum', '$cl_lname', '$cl_fname', '$cl_mname', '$cl_nameext', '$cl_purok', '$cl_brgy', '$cl_brgy_code', '$cl_mun', '$cl_mun_code', '$cl_prov', '$cl_prov_code', '$cl_district', '$cl_region', '$cl_region_code', '$cl_contact_num', '$cl_bday', '$cl_age', '$cl_cstatus', '$cl_sex', '$cl_occupation', '$cl_salary', '$cl_reltobene', '$cl_category', '$cl_subcategory', '$cl_subcategory2', '$cl_ipAffiliation', '$cl_status', '$bn_4Pschoice', '$bn_4Psnum', '$bn_lname', '$bn_fname', '$bn_mname', '$bn_nameext', '$bn_purok', '$bn_brgy', '$bn_brgy_code', '$bn_mun', '$bn_mun_code', '$bn_prov', '$bn_prov_code', '$bn_district', '$bn_region', '$bn_region_code', '$bn_contact_num', '$bn_bday', '$bn_age', '$bn_cstatus', '$bn_sex', '$bn_occupation', '$bn_salary', '$bn_reltoclient', '$bn_category', '$bn_subcategory', '$bn_subcategory2', '$bn_ipAffiliation', '$queue_status', '$verifier')";
        if ($conn->query($sql) === TRUE) {
            echo "Client & Bene Data Saved Successfully!<br>";
            echo '<script>';
                echo 'alert("Client & Bene Data Saved Successfully!\nPrepare to input Bene'."'".'s Family Composition.");';
            echo '</script>';
            $qn = $conn->insert_id;
            echo "QN:". $qn;
            $_SESSION['qn'] = mysqli_real_escape_string($conn, $qn);
            //header("location: add_famComposition.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    $_SESSION['qn'] = mysqli_real_escape_string($conn, $qn);
    echo "QN:". $_SESSION['qn'];

    echo '<script>';
        echo 'window.location.href = "../'.$sys_acronym.'/add_famComposition.php";';
    echo '</script>';
    $conn->close();
    //header("location: add_famComposition.php");
?>