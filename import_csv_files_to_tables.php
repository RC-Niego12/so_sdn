<?php
	session_start();
	include 'config.php';

    //GET CIS-OFFICE NAME
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym'];

    //START clear entries in temp tables
    $clear_query1 = "TRUNCATE TABLE tbl_save_clientbene_mccrh";
    if ($conn->query($clear_query1) === TRUE) {
        echo "tbl_save_clientbene_mccrh emptied successfully!<br>";
    } else {
        echo "Error emptying tbl_save_clientbene_mccrh!: <br>";
        echo "Error: " . $clear_query1 . "<br>" . $conn->error . "<br>";
    }

    $clear_query2 = "TRUNCATE TABLE tbl_save_addl_entry_mccrh";
    if ($conn->query($clear_query2) === TRUE) {
        echo "tbl_save_addl_entry_mccrh emptied successfully!<br>";
    } else {
        echo "Error emptying tbl_save_addl_entry_mccrh!: <br>";
        echo "Error: " . $clear_query2 . "<br>" . $conn->error . "<br>";
    }
    //END clear entries in temp tables

    //START importing data from csv files to temp tables
    $query = "LOAD DATA LOCAL INFILE 'C:/wamp/www/SO SDN System - 2024/tbl_save_clientbene_mccrh.csv'
        INTO TABLE tbl_save_clientbene_mccrh
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"'
        LINES TERMINATED BY '\r\n'
        (id_tbl_save_clientbene, transaction_code, cl_qn, cl_pcn, cl_4Pschoice, cl_4Psnum, cl_lname, cl_fname, cl_mname, cl_nameext, cl_purok, cl_brgy, cl_brgy_code, cl_mun, cl_mun_code, cl_prov, cl_prov_code, cl_district, cl_region, cl_region_code, cl_contact_num, @cl_bday, cl_age, cl_cstatus, cl_sex, cl_occupation, cl_salary, cl_reltobene, cl_category, cl_subcategory, cl_subcategory2, cl_ipAffiliation, cl_status, bn_4Pschoice, bn_4Psnum, bn_lname, bn_fname, bn_mname, bn_nameext, bn_purok, bn_brgy, bn_brgy_code, bn_mun, bn_mun_code, bn_prov, bn_prov_code, bn_district, bn_region, bn_region_code, bn_contact_num, @bn_bday, bn_age, bn_cstatus, bn_sex, bn_occupation, bn_salary, bn_reltoclient, bn_category, bn_subcategory, bn_subcategory2, bn_ipAffiliation, verifier, cancellation, @date_cancelled, remarks,  @date_start, @time_start, @date_end, @time_end) SET cl_bday = STR_TO_DATE(@cl_bday,'%Y-%m-%d'), bn_bday = STR_TO_DATE(@bn_bday,'%Y-%m-%d'), date_cancelled = STR_TO_DATE(@date_cancelled,'%Y-%m-%d'), date_start = STR_TO_DATE(@date_start,'%Y-%m-%d'), time_start = STR_TO_DATE(@time_start,'%H:%i:%s'), date_end = STR_TO_DATE(@date_end,'%Y-%m-%d'), time_end = STR_TO_DATE(@time_end,'%H:%i:%s')
        ";
    if ($conn->query($query) === TRUE) {
        echo "CSV file of tbl_save_clientbene_mccrh uploaded successfully!<br>";
    } else {
        echo "Error uploading CSV file of tbl_save_clientbene_mccrh!: <br>";
        echo "Error: " . $query . "<br>" . $conn->error . "<br>";
    }

    $query2 = "LOAD DATA LOCAL INFILE 'C:/wamp/www/SO SDN System - 2024/tbl_save_addl_entry_mccrh.csv'
        INTO TABLE tbl_save_addl_entry_mccrh
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"'
        LINES TERMINATED BY '\r\n'
        (id_tbl_save_addl_entry, transaction_code, swo_staffid, cl_qn, release_mode, admission_mode, assistance_type, purpose, remarks_pcv, canvassed_by, sp, sp_address, amount_in_figures, amount_in_words, fund_source, cl_id, bn_id, other_attachments, other_attachments2, other_addl_attachments, material_assistance, psycho_support, referral, diagnosis, assessment, branch_served, @date_start2, @time_start2, @date_end2, @time_end2) SET date_start2 = STR_TO_DATE(@date_start2,'%Y-%m-%d'), time_start2 = STR_TO_DATE(@time_start2,'%H:%i:%s'), date_end2 = STR_TO_DATE(@date_end2,'%Y-%m-%d'), time_end2 = STR_TO_DATE(@time_end2,'%H:%i:%s')
        ";
    if ($conn->query($query2) === TRUE) {
        echo "CSV file of tbl_save_addl_entry_mccrh uploaded successfully!<br>";
    } else {
        echo "Error uploading CSV file of tbl_save_addl_entry_mccrh!: <br>";
        echo "Error: " . $query2 . "<br>" . $conn->error . "<br>";
    }
    //END importing data from csv files to temp tables

    //START select from tbl_save_clientbene_mccrh
    $sql_clq = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene_mccrh");
    if ($sql_clq->num_rows > 0) {
        while($row_clq = mysqli_fetch_array($sql_clq)) {
            //insert to tbl_save_clientbene
            $id_tbl_save_clientbene = mysqli_real_escape_string($conn, $row_clq['id_tbl_save_clientbene']);
            $transaction_code = mysqli_real_escape_string($conn, $row_clq['transaction_code']);
            //cl
            $cl_qn = mysqli_real_escape_string($conn, $row_clq['cl_qn']);
            $cl_pcn = mysqli_real_escape_string($conn, $row_clq['cl_pcn']);
            $cl_4Pschoice = mysqli_real_escape_string($conn, $row_clq['cl_4Pschoice']);
            $cl_4Psnum = mysqli_real_escape_string($conn, $row_clq['cl_4Psnum']);
            $cl_lname = mysqli_real_escape_string($conn, $row_clq['cl_lname']);
            $cl_fname = mysqli_real_escape_string($conn, $row_clq['cl_fname']);
            $cl_mname = mysqli_real_escape_string($conn, $row_clq['cl_mname']);
            $cl_nameext = mysqli_real_escape_string($conn, $row_clq['cl_nameext']);
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
            $cl_contact_num = mysqli_real_escape_string($conn, $row_clq['cl_contact_num']);
            $cl_bday = mysqli_real_escape_string($conn, $row_clq['cl_bday']);
            $cl_age = mysqli_real_escape_string($conn, $row_clq['cl_age']);
            $cl_cstatus = mysqli_real_escape_string($conn, $row_clq['cl_cstatus']);
            $cl_sex = mysqli_real_escape_string($conn, $row_clq['cl_sex']);
            $cl_occupation = mysqli_real_escape_string($conn, $row_clq['cl_occupation']);
            $cl_salary = mysqli_real_escape_string($conn, $row_clq['cl_salary']);
            $cl_reltobene = mysqli_real_escape_string($conn, $row_clq['cl_reltobene']);
            $cl_category = mysqli_real_escape_string($conn, $row_clq['cl_category']);
            $cl_subcategory = mysqli_real_escape_string($conn, $row_clq['cl_subcategory']);
            $cl_subcategory2 = mysqli_real_escape_string($conn, $row_clq['cl_subcategory2']);
            $cl_ipAffiliation = mysqli_real_escape_string($conn, $row_clq['cl_ipAffiliation']);
            $cl_status = mysqli_real_escape_string($conn, $row_clq['cl_status']);
            //bn
            $bn_4Pschoice = mysqli_real_escape_string($conn, $row_clq['bn_4Pschoice']);
            $bn_4Psnum = mysqli_real_escape_string($conn, $row_clq['bn_4Psnum']);
            $bn_lname = mysqli_real_escape_string($conn, $row_clq['bn_lname']);
            $bn_fname = mysqli_real_escape_string($conn, $row_clq['bn_fname']);
            $bn_mname = mysqli_real_escape_string($conn, $row_clq['bn_mname']);
            $bn_nameext = mysqli_real_escape_string($conn, $row_clq['bn_nameext']);
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
            $bn_contact_num = mysqli_real_escape_string($conn, $row_clq['bn_contact_num']);
            $bn_bday = mysqli_real_escape_string($conn, $row_clq['bn_bday']);
            $bn_age = mysqli_real_escape_string($conn, $row_clq['bn_age']);
            $bn_cstatus = mysqli_real_escape_string($conn, $row_clq['bn_cstatus']);
            $bn_sex = mysqli_real_escape_string($conn, $row_clq['bn_sex']);
            $bn_occupation = mysqli_real_escape_string($conn, $row_clq['bn_occupation']);
            $bn_salary = mysqli_real_escape_string($conn, $row_clq['bn_salary']);
            $bn_reltoclient = mysqli_real_escape_string($conn, $row_clq['bn_reltoclient']);
            $bn_category = mysqli_real_escape_string($conn, $row_clq['bn_category']);
            $bn_subcategory = mysqli_real_escape_string($conn, $row_clq['bn_subcategory']);
            $bn_subcategory2 = mysqli_real_escape_string($conn, $row_clq['bn_subcategory2']);
            $bn_ipAffiliation = mysqli_real_escape_string($conn, $row_clq['bn_ipAffiliation']);

            $verifier = mysqli_real_escape_string($conn, $row_clq['verifier']);
            $cancellation = mysqli_real_escape_string($conn, $row_clq['cancellation']);
            $date_cancelled = mysqli_real_escape_string($conn, $row_clq['date_cancelled']);
            $remarks = mysqli_real_escape_string($conn, $row_clq['remarks']);
            $date_start = mysqli_real_escape_string($conn, $row_clq['date_start']);
            $time_start = mysqli_real_escape_string($conn, $row_clq['time_start']);
            $date_end = mysqli_real_escape_string($conn, $row_clq['date_end']);
            $time_end = mysqli_real_escape_string($conn, $row_clq['time_end']);
            $time_start_fnl = $date_start.' '.$time_start;
            $time_end_fnl = $date_end.' '.$time_end;

            $sql_save_clq = "INSERT INTO tbl_save_clientbene (id_tbl_save_clientbene, transaction_code, cl_qn, cl_pcn, cl_4Pschoice, cl_4Psnum, cl_lname, cl_fname, cl_mname, cl_nameext, cl_purok, cl_brgy, cl_brgy_code, cl_mun, cl_mun_code, cl_prov, cl_prov_code, cl_district, cl_region, cl_region_code, cl_contact_num, cl_bday, cl_age, cl_cstatus, cl_sex, cl_occupation, cl_salary, cl_reltobene, cl_category, cl_subcategory, cl_subcategory2, cl_ipAffiliation, cl_status, bn_4Pschoice, bn_4Psnum, bn_lname, bn_fname, bn_mname, bn_nameext, bn_purok, bn_brgy, bn_brgy_code, bn_mun, bn_mun_code, bn_prov, bn_prov_code, bn_district, bn_region, bn_region_code, bn_contact_num, bn_bday, bn_age, bn_cstatus, bn_sex, bn_occupation, bn_salary, bn_reltoclient, bn_category, bn_subcategory, bn_subcategory2, bn_ipAffiliation, verifier, cancellation, date_cancelled, remarks, time_start, time_end) VALUES ('$id_tbl_save_clientbene', '$transaction_code', '$cl_qn', '$cl_pcn', '$cl_4Pschoice', '$cl_4Psnum', '$cl_lname', '$cl_fname', '$cl_mname', '$cl_nameext', '$cl_purok', '$cl_brgy', '$cl_brgy_code', '$cl_mun', '$cl_mun_code', '$cl_prov', '$cl_prov_code', '$cl_district', '$cl_region', '$cl_region_code', '$cl_contact_num', '$cl_bday', '$cl_age', '$cl_cstatus', '$cl_sex', '$cl_occupation', '$cl_salary', '$cl_reltobene', '$cl_category', '$cl_subcategory', '$cl_subcategory2', '$cl_ipAffiliation', '$cl_status',  '$bn_4Pschoice', '$bn_4Psnum', '$bn_lname', '$bn_fname', '$bn_mname', '$bn_nameext', '$bn_purok', '$bn_brgy', '$bn_brgy_code', '$bn_mun', '$bn_mun_code', '$bn_prov', '$bn_prov_code', '$bn_district', '$bn_region', '$bn_region_code', '$bn_contact_num', '$bn_bday', '$bn_age', '$bn_cstatus', '$bn_sex', '$bn_occupation', '$bn_salary', '$bn_reltoclient', '$bn_category', '$bn_subcategory', '$bn_subcategory2', '$bn_ipAffiliation', '$verifier', '$cancellation', '$date_cancelled', '$remarks', '$time_start_fnl', '$time_end_fnl')";
            
            if ($conn->query($sql_save_clq) === TRUE) {
                echo "Client & Bene Data Saved Successfully!<br>";
            } else {
                echo "Error: " . $sql_save_clq . "<br>" . $conn->error . "<br>";
            }
        }
    } else {}
    //END select from tbl_save_clientbene_mccrh

    //START select from tbl_save_addl_entry_mccrh
    $sql_addl_entry = mysqli_query($conn, "SELECT * FROM tbl_save_addl_entry_mccrh");
    if ($sql_addl_entry->num_rows > 0) {
        while($row_ae = mysqli_fetch_array($sql_addl_entry)) {
            //insert to tbl_save_addl_entry
            $id_tbl_save_addl_entry = mysqli_real_escape_string($conn, $row_ae['id_tbl_save_addl_entry']);
            $transaction_code = mysqli_real_escape_string($conn, $row_ae['transaction_code']);
            $swo_staffid = mysqli_real_escape_string($conn, $row_ae['swo_staffid']);
            $cl_qn = mysqli_real_escape_string($conn, $row_ae['cl_qn']);
            $release_mode = mysqli_real_escape_string($conn, $row_ae['release_mode']);
            $admission_mode = mysqli_real_escape_string($conn, $row_ae['admission_mode']);
            $assistance_type = mysqli_real_escape_string($conn, $row_ae['assistance_type']);
            $purpose = mysqli_real_escape_string($conn, $row_ae['purpose']);
            $remarks_pcv = mysqli_real_escape_string($conn, $row_ae['remarks_pcv']);
            $canvassed_by = mysqli_real_escape_string($conn, $row_ae['canvassed_by']);
            $sp = mysqli_real_escape_string($conn, $row_ae['sp']);
            $sp_address = mysqli_real_escape_string($conn, $row_ae['sp_address']);
            $amount_in_figures = mysqli_real_escape_string($conn, $row_ae['amount_in_figures']);
            $amount_in_words = mysqli_real_escape_string($conn, $row_ae['amount_in_words']);
            $fund_source = mysqli_real_escape_string($conn, $row_ae['fund_source']);
            $cl_id = mysqli_real_escape_string($conn, $row_ae['cl_id']);
            $bn_id = mysqli_real_escape_string($conn, $row_ae['bn_id']);
            $other_attachments = mysqli_real_escape_string($conn, $row_ae['other_attachments']);
            $other_attachments2 = mysqli_real_escape_string($conn, $row_ae['other_attachments2']);
            $other_addl_attachments = mysqli_real_escape_string($conn, $row_ae['other_addl_attachments']);
            $material_assistance = mysqli_real_escape_string($conn, $row_ae['material_assistance']);
            $psycho_support = mysqli_real_escape_string($conn, $row_ae['psycho_support']);
            $referral = mysqli_real_escape_string($conn, $row_ae['referral']);
            $diagnosis = mysqli_real_escape_string($conn, $row_ae['diagnosis']);
            $assessment = mysqli_real_escape_string($conn, $row_ae['assessment']);
            $branch_served = mysqli_real_escape_string($conn, $row_ae['branch_served']);

            $date_start = mysqli_real_escape_string($conn, $row_ae['date_start2']);
            $time_start = mysqli_real_escape_string($conn, $row_ae['time_start2']);
            $date_end = mysqli_real_escape_string($conn, $row_ae['date_end2']);
            $time_end = mysqli_real_escape_string($conn, $row_ae['time_end2']);

            $time_start_fnl = $date_start.' '.$time_start;
            $time_end_fnl = $date_end.' '.$time_end;

            $sql_save_addl_entry = "INSERT INTO tbl_save_addl_entry (id_tbl_save_addl_entry, transaction_code, swo_staffid, cl_qn, release_mode, admission_mode, assistance_type, purpose, remarks_pcv, canvassed_by, sp, sp_address, amount_in_figures, amount_in_words, fund_source, cl_id, bn_id, other_attachments, other_attachments2, other_addl_attachments, material_assistance, psycho_support, referral, diagnosis, assessment, branch_served, time_start2, time_end2) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$swo_staffid', '$cl_qn', '$release_mode', '$admission_mode', '$assistance_type', '$purpose',  '$remarks_pcv', '$canvassed_by', '$sp', '$sp_address', '$amount_in_figures', '$amount_in_words', '$fund_source', '$cl_id', '$bn_id', '$other_attachments', '$other_attachments2', '$other_addl_attachments', '$material_assistance', '$psycho_support', '$referral', '$diagnosis', '$assessment', '$branch_served', '$time_start_fnl', '$time_end_fnl')";
        
            if ($conn->query($sql_save_addl_entry) === TRUE) {
                echo "Additional Entry Saved Successfully!<br>";
            } else {
                echo "Error: " . $sql_save_addl_entry . "<br>" . $conn->error . "<br>";
            }
        }
    } else {}
    //END select from tbl_save_addl_entry_mccrh
    
    echo '<script>';
        echo 'window.location.href = "../'.$sys_acronym.'/import_csv_files.php";';
    echo '</script>';
	$conn->close();
    //header("location: import_csv_files.php");
?>