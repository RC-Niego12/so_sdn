<?php
    session_start();
    $_SESSION['cl_qn']; $_SESSION['swo_staffid'];
    $cl_qn = $_SESSION['cl_qn'];
    include 'config.php';
    //select from tbl_clientqueue
    $sql_clq = mysqli_query($conn, "SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['cl_qn']."'");
    $row_clq = mysqli_fetch_assoc($sql_clq);
    //select from tbl_addl_entry
    $sql_addl_entry = mysqli_query($conn, "SELECT * FROM tbl_addl_entry WHERE cl_qn='".$_SESSION['cl_qn']."'");
    $row_addl_entry = mysqli_fetch_assoc($sql_addl_entry);

    $clq_sql = "UPDATE tbl_clientqueue SET queue_status='SERVED' WHERE cl_qn='$cl_qn'";
        if ($conn->query($clq_sql) === TRUE) {
        echo "Queue Status updated successfully<br>";
        } else {
            echo "Error: " . $clq_sql . "<br>" . $conn->error . "<br>";
        }

    //insert to tbl_save_clientbene
    //cl
    $cl_lname = mysqli_real_escape_string($conn, $row_clq['cl_lname']);
    $cl_fname = mysqli_real_escape_string($conn, $row_clq['cl_fname']);
    $cl_mname = mysqli_real_escape_string($conn, $row_clq['cl_mname']);
    $cl_nameext = mysqli_real_escape_string($conn, $row_clq['cl_nameext']);
    $cl_occupation = mysqli_real_escape_string($conn, $row_clq['cl_occupation']);
    $cl_purok = mysqli_real_escape_string($conn, $row_clq['cl_purok']);
    $cl_brgy = mysqli_real_escape_string($conn, $row_clq['cl_brgy']);
    $cl_brgy_code = mysqli_real_escape_string($conn, $row_clq['cl_brgy_code']);
    $cl_mun = mysqli_real_escape_string($conn, $row_clq['cl_mun']);
    $cl_mun_code = mysqli_real_escape_string($conn, $row_clq['cl_mun_code']);
    $cl_prov = mysqli_real_escape_string($conn, $row_clq['cl_prov']);
    $cl_prov_code = mysqli_real_escape_string($conn, $row_clq['cl_prov_code']);
    $cl_district = mysqli_real_escape_string($conn, $row_clq['cl_district']);
    $cl_region = mysqli_real_escape_string($conn, $row_clq['cl_region']);
    $cl_region_code = mysqli_real_escape_string($conn, $row_clq['cl_region_code']);
    $cl_ipAffiliation = mysqli_real_escape_string($conn, $row_clq['cl_ipAffiliation']);
    $cl_reltobene = mysqli_real_escape_string($conn, $row_clq['cl_reltobene']);

    //bn
    $bn_lname = mysqli_real_escape_string($conn, $row_clq['bn_lname']);
    $bn_fname = mysqli_real_escape_string($conn, $row_clq['bn_fname']);
    $bn_mname = mysqli_real_escape_string($conn, $row_clq['bn_mname']);
    $bn_nameext = mysqli_real_escape_string($conn, $row_clq['bn_nameext']);
    $bn_occupation = mysqli_real_escape_string($conn, $row_clq['bn_occupation']);
    $bn_purok = mysqli_real_escape_string($conn, $row_clq['bn_purok']);
    $bn_brgy = mysqli_real_escape_string($conn, $row_clq['bn_brgy']);
    $bn_brgy_code = mysqli_real_escape_string($conn, $row_clq['bn_brgy_code']);
    $bn_mun = mysqli_real_escape_string($conn, $row_clq['bn_mun']);
    $bn_mun_code = mysqli_real_escape_string($conn, $row_clq['bn_mun_code']);
    $bn_prov = mysqli_real_escape_string($conn, $row_clq['bn_prov']);
    $bn_prov_code = mysqli_real_escape_string($conn, $row_clq['bn_prov_code']);
    $bn_district = mysqli_real_escape_string($conn, $row_clq['bn_district']);
    $bn_region = mysqli_real_escape_string($conn, $row_clq['bn_region']);
    $bn_region_code = mysqli_real_escape_string($conn, $row_clq['bn_region_code']);
    $bn_ipAffiliation = mysqli_real_escape_string($conn, $row_clq['bn_ipAffiliation']);
    $bn_reltoclient = mysqli_real_escape_string($conn, $row_clq['bn_reltoclient']);
    $gl_code = $row_addl_entry['gl_code'];
    $clq_date_added = $row_clq['date_added'];
    $addl_entry_date_added = $row_addl_entry['date_added'];

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];

    $result = mysqli_query($conn,"SELECT * FROM tbl_save_clientbene WHERE cl_qn='$cl_qn' AND cl_lname='$cl_lname' AND cl_fname='$cl_fname' AND cl_mname='$cl_mname' AND cl_nameext='$cl_nameext' AND bn_lname='$bn_lname' AND bn_fname='$bn_fname' AND bn_mname='$bn_mname' AND bn_nameext='$bn_nameext' AND time_start='$clq_date_added' AND time_end='$addl_entry_date_added' ");

    if ($result->num_rows > 0) {
        echo "No. of Results: ".$result->num_rows."<br>";
        echo "Transaction Already Saved!<br>";
        echo '<script>';
            echo 'alert("Transaction Already Saved!.\nGL Code: '. $gl_code .'");';
            echo 'window.location.href = "../'.$sys_acronym.'/home_sw.php";';
        echo '</script>';
    } else {
        $sql_save_clq = "INSERT INTO tbl_save_clientbene (transaction_code, cl_qn, cl_pcn, cl_4Pschoice, cl_4Psnum, cl_lname, cl_fname, cl_mname, cl_nameext, cl_purok, cl_brgy, cl_brgy_code, cl_mun, cl_mun_code, cl_prov, cl_prov_code, cl_district, cl_region, cl_region_code, cl_contact_num, cl_bday, cl_age, cl_cstatus, cl_sex, cl_occupation, cl_salary, cl_reltobene, cl_category, cl_subcategory, cl_subcategory2, cl_ipAffiliation, cl_status, bn_4Pschoice, bn_4Psnum, bn_lname, bn_fname, bn_mname, bn_nameext, bn_purok, bn_brgy, bn_brgy_code, bn_mun, bn_mun_code, bn_prov, bn_prov_code, bn_district, bn_region, bn_region_code, bn_contact_num, bn_bday, bn_age, bn_cstatus, bn_sex, bn_occupation, bn_salary, bn_reltoclient, bn_category, bn_subcategory, bn_subcategory2, bn_ipAffiliation, verifier, cancellation, date_cancelled, remarks, time_start, time_end)
            VALUES ('".$row_addl_entry['gl_code']."', '".$_SESSION['cl_qn']."', '".$row_clq['cl_pcn']."', '".$row_clq['cl_4Pschoice']."', '".$row_clq['cl_4Psnum']."', '$cl_lname', '$cl_fname', '$cl_mname', '$cl_nameext', '$cl_purok', '$cl_brgy', '$cl_brgy_code', '$cl_mun', '$cl_mun_code', '$cl_prov', '$cl_prov_code', '$cl_district', '$cl_region', '$cl_region_code', '".$row_clq['cl_contact_num']."', '".$row_clq['cl_bday']."', '".$row_clq['cl_age']."', '".$row_clq['cl_cstatus']."', '".$row_clq['cl_sex']."', '$cl_occupation', '".$row_clq['cl_salary']."', '$cl_reltobene', '".$row_clq['cl_category']."', '".$row_clq['cl_subcategory']."', '".$row_clq['cl_subcategory2']."', '$cl_ipAffiliation', '".$row_clq['cl_status']."',  '".$row_clq['bn_4Pschoice']."', '".$row_clq['bn_4Psnum']."', '$bn_lname', '$bn_fname', '$bn_mname', '$bn_nameext', '$bn_purok', '$bn_brgy', '$bn_brgy_code', '$bn_mun', '$bn_mun_code', '$bn_prov', '$bn_prov_code', '$bn_district', '$bn_region', '$bn_region_code', '".$row_clq['bn_contact_num']."', '".$row_clq['bn_bday']."', '".$row_clq['bn_age']."', '".$row_clq['bn_cstatus']."', '".$row_clq['bn_sex']."', '$bn_occupation', '".$row_clq['bn_salary']."', '$bn_reltoclient', '".$row_clq['bn_category']."', '".$row_clq['bn_subcategory']."', '".$row_clq['bn_subcategory2']."', '$bn_ipAffiliation', '".$row_clq['verifier']."', 'N/A', '', 'N/A', '".$row_clq['date_added']."', '".$row_addl_entry['date_added']."')";
        
        if ($conn->query($sql_save_clq) === TRUE) {
            echo "Client & Bene Data Saved Successfully!<br>";
        } else {
            echo "Error: " . $sql_save_clq . "<br>" . $conn->error . "<br>";
        }

        $sql_lastid_inserted = mysqli_query($conn,"SELECT * FROM tbl_save_clientbene ORDER BY id_tbl_save_clientbene DESC LIMIT 1");

        $row_lastid = mysqli_fetch_assoc($sql_lastid_inserted); 
        echo "<br> " . $row_lastid['id_tbl_save_clientbene'];

        //insert to tbl_save_addl_entry
        $remarks_pcv = "";
        $fund_source = mysqli_real_escape_string($conn, $row_addl_entry['fund_source']);
        $referral = mysqli_real_escape_string($conn, $row_addl_entry['referral']);
        $diagnosis = mysqli_real_escape_string($conn, $row_addl_entry['diagnosis']);
        $assessment = mysqli_real_escape_string($conn, $row_addl_entry['assessment']);
        $cl_id = mysqli_real_escape_string($conn, $row_addl_entry['cl_id']);
        $bn_id = mysqli_real_escape_string($conn, $row_addl_entry['bn_id']);
        $sp = mysqli_real_escape_string($conn, $row_addl_entry['sp']);
        $sp_address = mysqli_real_escape_string($conn, $row_addl_entry['sp_address']);
        $other_attachments = mysqli_real_escape_string($conn, $row_addl_entry['other_attachments']);
        $other_attachments2 = mysqli_real_escape_string($conn, $row_addl_entry['other_attachments2']);
        $other_addl_attachments = mysqli_real_escape_string($conn, $row_addl_entry['other_addl_attachments']);

            $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
            $row_sysname = mysqli_fetch_assoc($sql_sysname); $branch_served = $row_sysname['office'];

        $sql_save_addl_entry = "INSERT INTO tbl_save_addl_entry (id_tbl_save_addl_entry, transaction_code, swo_staffid, cl_qn, release_mode, admission_mode, assistance_type, purpose, remarks_pcv, canvassed_by, sp, sp_address, amount_in_figures, amount_in_words, fund_source, cl_id, bn_id, other_attachments, other_attachments2, other_addl_attachments, material_assistance, psycho_support, referral, diagnosis, assessment, branch_served, time_start2, time_end2)
            VALUES ('".$row_lastid['id_tbl_save_clientbene']."', '".$row_addl_entry['gl_code']."', '".$_SESSION['swo_staffid']."', '".$_SESSION['cl_qn']."', '".$row_addl_entry['release_mode']."', '".$row_addl_entry['admission_mode']."', '".$row_addl_entry['assistance_type']."', '".$row_addl_entry['purpose']."',  '".$remarks_pcv."', '".$row_addl_entry['canvassed_by']."', '".$sp."', '".$sp_address."', '".$row_addl_entry['amount_in_figures']."', '".$row_addl_entry['amount_in_words']."', '$fund_source', '$cl_id', '$bn_id', '$other_attachments', '$other_attachments2', '$other_addl_attachments', '".$row_addl_entry['material_assistance']."', '".$row_addl_entry['psycho_support']."', '$referral', '$diagnosis', '$assessment', '$branch_served', '".$row_clq['date_added']."', '".$row_addl_entry['date_added']."')";
            
        if ($conn->query($sql_save_addl_entry) === TRUE) {
            echo "Additional Entry Saved Successfully!<br>";
        } else {
            echo "Error: " . $sql_save_addl_entry . "<br>" . $conn->error . "<br>";
        }

        //select from tbl_famcomposition
        $sql_famcom = mysqli_query($conn, "SELECT * FROM tbl_famcomposition WHERE qn='".$_SESSION['cl_qn']."' ");
        if ($sql_famcom->num_rows > 0) {
            while($row_famcom = mysqli_fetch_array($sql_famcom)) {
                //insert to tbl_save_famcomposition
                $sql_save_famcom = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
                    VALUES ('".$row_lastid['id_tbl_save_clientbene']."', '".$row_addl_entry['gl_code']."', '".$_SESSION['cl_qn']."', '".$row_famcom['lname']."', '".$row_famcom['fname']."', '".$row_famcom['mname']."', '".$row_famcom['nameext']."', '".$row_famcom['reltobene']."', '".$row_famcom['bday']."', '".$row_famcom['age']."', '".$row_famcom['occupation']."', '".$row_famcom['salary']."', '".$row_clq['date_added']."', '".$row_addl_entry['date_added']."')";
                if ($conn->query($sql_save_famcom) === TRUE) {
                    echo "Family Member/s Saved Successfully!<br>";
                } else {
                    echo "Error: " . $sql_save_famcom . "<br>" . $conn->error . "<br>";
                }
            }
        }

        //select from tbl_computation
        $sql_comp1 = mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='".$_SESSION['cl_qn']."'");
        if ($sql_comp1->num_rows > 0) {
            while($row_comp1 = mysqli_fetch_array($sql_comp1)) {
                //insert to tbl_save_computation
                $description = mysqli_real_escape_string($conn, $row_comp1['description']);
                $sql_save_comp1 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('".$row_lastid['id_tbl_save_clientbene']."', '".$row_addl_entry['gl_code']."', '".$_SESSION['cl_qn']."', '$description', '".$row_comp1['uprice']."', '".$row_comp1['qty']."',  '".$row_comp1['tprice']."',  '".$row_clq['date_added']."', '".$row_addl_entry['date_added']."' )";
                if ($conn->query($sql_save_comp1) === TRUE) {
                    echo "Initial Computation Saved Successfully!<br>";
                } else {
                    echo "Error: " . $sql_save_comp1 . "<br>" . $conn->error . "<br>";
                }
            }
        }

        //select from tbl_computation2
        $sql_comp2 = mysqli_query($conn, "SELECT * FROM tbl_computation2 WHERE cl_qn='".$_SESSION['cl_qn']."'");
        $row_comp2 = mysqli_fetch_assoc($sql_comp2);
        //insert to tbl_save_computation2
        $sql_save_comp2 = "INSERT INTO tbl_save_computation2 (id_tbl_save_computation2, transaction_code, cl_qn, stotal, dcnt, totalamt, time_start, time_end) VALUES ('".$row_lastid['id_tbl_save_clientbene']."', '".$row_addl_entry['gl_code']."', '".$_SESSION['cl_qn']."', '".$row_comp2['stotal']."', '".$row_comp2['dcnt']."', '".$row_comp2['totalamt']."',  '".$row_clq['date_added']."', '".$row_addl_entry['date_added']."' )";
        if ($conn->query($sql_save_comp2) === TRUE) {
            echo "Final Computation Saved Successfully!<br>";
        } else {
            echo "Error: " . $sql_save_comp2 . "<br>" . $conn->error . "<br>";
        }

        //notification alert message SUCCESS
        echo "GL Transaction Saved Successfully!";
        echo '<script>';
            echo 'alert("GL Transaction Saved Successfully!.\nGL Code: '. $gl_code .'\nYou can now go back to your Homepage.");';
            echo 'window.location.href = "../'.$sys_acronym.'/home_sw.php";';
        echo '</script>';
        $conn->close();
    }
    
    //header("location: home_sw.php");
?>