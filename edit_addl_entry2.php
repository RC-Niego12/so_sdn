<?php
	session_start();
    $_SESSION['id_tbl_save_addl_entry']; $_SESSION['cl_qn'];
	include 'config.php';
    
    $id_tbl_save_addl_entry = $_SESSION['id_tbl_save_addl_entry'];
    $cl_qn = $_SESSION['cl_qn'];
    $transaction_code = $_SESSION['transaction_code'];
    $swo_staffid = $_SESSION['swo_staffid'];
    $cl_qn = $_SESSION['cl_qn'];
    $release_mode = $_SESSION['release_mode'];
    $admission_mode = $_SESSION['admission_mode'];
    $purpose = $_SESSION['purpose'];
    $remarks_pcv = "";
    $canvassed_by = $_SESSION['canvassed_by'];
        $sql_as_type = mysqli_query($conn,"SELECT assistance_type FROM tbl_assistance WHERE assistance_purpose='".$purpose."' ");
        $row_as_type = mysqli_fetch_assoc($sql_as_type);
    $assistance_type = $row_as_type['assistance_type'];
    $sp = $_SESSION['sp'];
    $sp_address = $_SESSION['sp_address'];
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
    
    //update tbl_save_addl_entry
	$sql = "UPDATE tbl_save_addl_entry SET transaction_code='$transaction_code', release_mode='$release_mode', admission_mode='$admission_mode', assistance_type='$assistance_type', purpose='$purpose', remarks_pcv='$remarks_pcv', canvassed_by='$canvassed_by', sp='$sp', sp_address='$sp_address', amount_in_figures='$amount_in_figures', amount_in_words='$amount_in_words', fund_source='$fund_source', cl_id='$cl_id', bn_id='$bn_id', other_attachments='$other_attachments', other_attachments2='$other_attachments2', other_addl_attachments='$other_addl_attachments', material_assistance='$material_assistance', psycho_support='$psycho_support', referral='$referral', diagnosis='$diagnosis', assessment='$assessment' WHERE id_tbl_save_addl_entry='$id_tbl_save_addl_entry'";
        if ($conn->query($sql) === TRUE) {
            echo "Additional Entry/ies Updated Successfully!";
            echo '<script>';
                echo 'alert("Additional Entry/ies Updated Successfully!.\nGL Code: '. $transaction_code .'");';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    $stotal = $_SESSION['stotal'];
    $dcnt = $_SESSION['dcnt'];
    $totalamt = $_SESSION['totalamt'];

    $id1 = $_SESSION['id1'];
    $desc1 = $_SESSION['desc1'];
    $uprice1 = $_SESSION['uprice1'];
    $qty1 = $_SESSION['qty1'];
    $tprice1 = $_SESSION['tprice1'];

    $id2 = $_SESSION['id2'];
    $desc2 = $_SESSION['desc2'];
    $uprice2 = $_SESSION['uprice2'];
    $qty2 = $_SESSION['qty2'];
    $tprice2 = $_SESSION['tprice2'];

    $id3 = $_SESSION['id3'];
    $desc3 = $_SESSION['desc3'];
    $uprice3 = $_SESSION['uprice3'];
    $qty3 = $_SESSION['qty3'];
    $tprice3 = $_SESSION['tprice3'];

    $id4 = $_SESSION['id4'];
    $desc4 = $_SESSION['desc4'];
    $uprice4 = $_SESSION['uprice4'];
    $qty4 = $_SESSION['qty4'];
    $tprice4 = $_SESSION['tprice4'];

    $id5 = $_SESSION['id5'];
    $desc5 = $_SESSION['desc5'];
    $uprice5 = $_SESSION['uprice5'];
    $qty5 = $_SESSION['qty5'];
    $tprice5 = $_SESSION['tprice5'];

    $id6 = $_SESSION['id6'];
    $desc6 = $_SESSION['desc6'];
    $uprice6 = $_SESSION['uprice6'];
    $qty6 = $_SESSION['qty6'];
    $tprice6 = $_SESSION['tprice6'];

    $id7 = $_SESSION['id7'];
    $desc7 = $_SESSION['desc7'];
    $uprice7 = $_SESSION['uprice7'];
    $qty7 = $_SESSION['qty7'];
    $tprice7 = $_SESSION['tprice7'];

    $id8 = $_SESSION['id8'];
    $desc8 = $_SESSION['desc8'];
    $uprice8 = $_SESSION['uprice8'];
    $qty8 = $_SESSION['qty8'];
    $tprice8 = $_SESSION['tprice8'];

    $id9 = $_SESSION['id9'];
    $desc9 = $_SESSION['desc9'];
    $uprice9 = $_SESSION['uprice9'];
    $qty9 = $_SESSION['qty9'];
    $tprice9 = $_SESSION['tprice9'];

    $id10 = $_SESSION['id10'];
    $desc10 = $_SESSION['desc10'];
    $uprice10 = $_SESSION['uprice10'];
    $qty10 = $_SESSION['qty10'];
    $tprice10 = $_SESSION['tprice10'];

    $id11 = $_SESSION['id11'];
    $desc11 = $_SESSION['desc11'];
    $uprice11 = $_SESSION['uprice11'];
    $qty11 = $_SESSION['qty11'];
    $tprice11 = $_SESSION['tprice11'];

    $id12 = $_SESSION['id12'];
    $desc12 = $_SESSION['desc12'];
    $uprice12 = $_SESSION['uprice12'];
    $qty12 = $_SESSION['qty12'];
    $tprice12 = $_SESSION['tprice12'];

    $id13 = $_SESSION['id13'];
    $desc13 = $_SESSION['desc13'];
    $uprice13 = $_SESSION['uprice13'];
    $qty13 = $_SESSION['qty13'];
    $tprice13 = $_SESSION['tprice13'];

    $id14 = $_SESSION['id14'];
    $desc14 = $_SESSION['desc14'];
    $uprice14 = $_SESSION['uprice14'];
    $qty14 = $_SESSION['qty14'];
    $tprice14 = $_SESSION['tprice14'];

    $id15 = $_SESSION['id15'];
    $desc15 = $_SESSION['desc15'];
    $uprice15 = $_SESSION['uprice15'];
    $qty15 = $_SESSION['qty15'];
    $tprice15 = $_SESSION['tprice15'];

    $id16 = $_SESSION['id16'];
    $desc16 = $_SESSION['desc16'];
    $uprice16 = $_SESSION['uprice16'];
    $qty16 = $_SESSION['qty16'];
    $tprice16 = $_SESSION['tprice16'];

    $id17 = $_SESSION['id17'];
    $desc17 = $_SESSION['desc17'];
    $uprice17 = $_SESSION['uprice17'];
    $qty17 = $_SESSION['qty17'];
    $tprice17 = $_SESSION['tprice17'];

    $id18 = $_SESSION['id18'];
    $desc18 = $_SESSION['desc18'];
    $uprice18 = $_SESSION['uprice18'];
    $qty18 = $_SESSION['qty18'];
    $tprice18 = $_SESSION['tprice18'];

    $id19 = $_SESSION['id19'];
    $desc19 = $_SESSION['desc19'];
    $uprice19 = $_SESSION['uprice19'];
    $qty19 = $_SESSION['qty19'];
    $tprice19 = $_SESSION['tprice19'];

    $id20 = $_SESSION['id20'];
    $desc20 = $_SESSION['desc20'];
    $uprice20 = $_SESSION['uprice20'];
    $qty20 = $_SESSION['qty20'];
    $tprice20 = $_SESSION['tprice20'];

    if (!empty($desc1)) {
        $sql_time_tbl_save_computation1 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id1' ");
        $row_time_tbl_save_computation1 = mysqli_fetch_assoc($sql_time_tbl_save_computation1);
        $time_start1 = $row_time_tbl_save_computation1['time_start']; $time_end1 = $row_time_tbl_save_computation1['time_end'];
        if ($sql_time_tbl_save_computation1->num_rows > 0) {
            //update comp1
            $comp_sql1 = "UPDATE tbl_save_computation SET description='$desc1', uprice='$uprice1', qty='$qty1', tprice='$tprice1' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id1' ";
            if ($conn->query($comp_sql1) === TRUE) {
            echo "Computation1-1 updated successfully";
            } else {
                echo "Error: " . $comp_sql1 . "<br>" . $conn->error;
            }
        } else {
            //insert comp1
            $comp_insert_sql1 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc1', '$uprice1', '$qty1', '$tprice1', '$time_start1', '$time_end1')";
            if ($conn->query($comp_insert_sql1) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql1 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc2)) {
        $sql_time_tbl_save_computation2 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id2' ");
        $row_time_tbl_save_computation2 = mysqli_fetch_assoc($sql_time_tbl_save_computation2);
        $time_start2 = $row_time_tbl_save_computation2['time_start']; $time_end2 = $row_time_tbl_save_computation2['time_end'];
        if ($sql_time_tbl_save_computation2->num_rows > 0) {
            //update comp2
            $comp_sql2 = "UPDATE tbl_save_computation SET description='$desc2', uprice='$uprice2', qty='$qty2', tprice='$tprice2' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id2' ";
            if ($conn->query($comp_sql2) === TRUE) {
            echo "Computation1-2 updated successfully";
            } else {
                echo "Error: " . $comp_sql2 . "<br>" . $conn->error;
            }
        } else {
            //insert comp2
            $comp_insert_sql2 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc2', '$uprice2', '$qty2', '$tprice2', '$time_start2', '$time_end2')";
            if ($conn->query($comp_insert_sql2) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql2 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc3)) {
        $sql_time_tbl_save_computation3 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id3' ");
        $row_time_tbl_save_computation3 = mysqli_fetch_assoc($sql_time_tbl_save_computation3);
        $time_start3 = $row_time_tbl_save_computation3['time_start']; $time_end3 = $row_time_tbl_save_computation3['time_end'];
        if ($sql_time_tbl_save_computation3->num_rows > 0) {
            //update comp3
            $comp_sql3 = "UPDATE tbl_save_computation SET description='$desc3', uprice='$uprice3', qty='$qty3', tprice='$tprice3' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id3' ";
            if ($conn->query($comp_sql3) === TRUE) {
            echo "Computation1-3 updated successfully";
            } else {
                echo "Error: " . $comp_sql3 . "<br>" . $conn->error;
            }
        } else {
            //insert comp3
            $comp_insert_sql3 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc3', '$uprice3', '$qty3', '$tprice3', '$time_start3', '$time_end3')";
            if ($conn->query($comp_insert_sql3) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql3 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc4)) {
        $sql_time_tbl_save_computation4 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id4' ");
        $row_time_tbl_save_computation4 = mysqli_fetch_assoc($sql_time_tbl_save_computation4);
        $time_start4 = $row_time_tbl_save_computation4['time_start']; $time_end4 = $row_time_tbl_save_computation4['time_end'];
        if ($sql_time_tbl_save_computation4->num_rows > 0) {
            //update comp4
            $comp_sql4 = "UPDATE tbl_save_computation SET description='$desc4', uprice='$uprice4', qty='$qty4', tprice='$tprice4' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id4' ";
            if ($conn->query($comp_sql4) === TRUE) {
            echo "Computation1-4 updated successfully";
            } else {
                echo "Error: " . $comp_sql4 . "<br>" . $conn->error;
            }
        } else {
            //insert comp4
            $comp_insert_sql4 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc4', '$uprice4', '$qty4', '$tprice4', '$time_start4', '$time_end4')";
            if ($conn->query($comp_insert_sql4) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql4 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc5)) {
        $sql_time_tbl_save_computation5 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id5' ");
        $row_time_tbl_save_computation5 = mysqli_fetch_assoc($sql_time_tbl_save_computation5);
        $time_start5 = $row_time_tbl_save_computation5['time_start']; $time_end5 = $row_time_tbl_save_computation5['time_end'];
        if ($sql_time_tbl_save_computation5->num_rows > 0) {
            //update comp5
            $comp_sql5 = "UPDATE tbl_save_computation SET description='$desc5', uprice='$uprice5', qty='$qty5', tprice='$tprice5' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id5' ";
            if ($conn->query($comp_sql5) === TRUE) {
            echo "Computation1-5 updated successfully";
            } else {
                echo "Error: " . $comp_sql5 . "<br>" . $conn->error;
            }
        } else {
            //insert comp5
            $comp_insert_sql5 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc5', '$uprice5', '$qty5', '$tprice5', '$time_start5', '$time_end5')";
            if ($conn->query($comp_insert_sql5) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql5 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc6)) {
        $sql_time_tbl_save_computation6 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id6' ");
        $row_time_tbl_save_computation6 = mysqli_fetch_assoc($sql_time_tbl_save_computation6);
        $time_start6 = $row_time_tbl_save_computation6['time_start']; $time_end6 = $row_time_tbl_save_computation6['time_end'];
        if ($sql_time_tbl_save_computation6->num_rows > 0) {
            //update comp6
            $comp_sql6 = "UPDATE tbl_save_computation SET description='$desc6', uprice='$uprice6', qty='$qty6', tprice='$tprice6' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id6' ";
            if ($conn->query($comp_sql6) === TRUE) {
            echo "Computation1-6 updated successfully";
            } else {
                echo "Error: " . $comp_sql6 . "<br>" . $conn->error;
            }
        } else {
            //insert comp6
            $comp_insert_sql6 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc6', '$uprice6', '$qty6', '$tprice6', '$time_start6', '$time_end6')";
            if ($conn->query($comp_insert_sql6) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql6 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc7)) {
        $sql_time_tbl_save_computation7 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id7' ");
        $row_time_tbl_save_computation7 = mysqli_fetch_assoc($sql_time_tbl_save_computation7);
        $time_start7 = $row_time_tbl_save_computation7['time_start']; $time_end7 = $row_time_tbl_save_computation7['time_end'];
        if ($sql_time_tbl_save_computation7->num_rows > 0) {
            //update comp7
            $comp_sql7 = "UPDATE tbl_save_computation SET description='$desc7', uprice='$uprice7', qty='$qty7', tprice='$tprice7' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id7' ";
            if ($conn->query($comp_sql7) === TRUE) {
            echo "Computation1-7 updated successfully";
            } else {
                echo "Error: " . $comp_sql7 . "<br>" . $conn->error;
            }
        } else {
            //insert comp7
            $comp_insert_sql7 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc7', '$uprice7', '$qty7', '$tprice7', '$time_start7', '$time_end7')";
            if ($conn->query($comp_insert_sql7) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql7 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc8)) {
        $sql_time_tbl_save_computation8 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id8' ");
        $row_time_tbl_save_computation8 = mysqli_fetch_assoc($sql_time_tbl_save_computation8);
        $time_start8 = $row_time_tbl_save_computation8['time_start']; $time_end8 = $row_time_tbl_save_computation8['time_end'];
        if ($sql_time_tbl_save_computation8->num_rows > 0) {
            //update comp8
            $comp_sql8 = "UPDATE tbl_save_computation SET description='$desc8', uprice='$uprice8', qty='$qty8', tprice='$tprice8' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id8' ";
            if ($conn->query($comp_sql8) === TRUE) {
            echo "Computation1-8 updated successfully";
            } else {
                echo "Error: " . $comp_sql8 . "<br>" . $conn->error;
            }
        } else {
            //insert comp8
            $comp_insert_sql8 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc8', '$uprice8', '$qty8', '$tprice8', '$time_start8', '$time_end8')";
            if ($conn->query($comp_insert_sql8) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql8 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc9)) {
        $sql_time_tbl_save_computation9 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id9' ");
        $row_time_tbl_save_computation9 = mysqli_fetch_assoc($sql_time_tbl_save_computation9);
        $time_start9 = $row_time_tbl_save_computation9['time_start']; $time_end9 = $row_time_tbl_save_computation9['time_end'];
        if ($sql_time_tbl_save_computation9->num_rows > 0) {
            //update comp9
            $comp_sql9 = "UPDATE tbl_save_computation SET description='$desc9', uprice='$uprice9', qty='$qty9', tprice='$tprice9' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id9' ";
            if ($conn->query($comp_sql9) === TRUE) {
            echo "Computation1-9 updated successfully";
            } else {
                echo "Error: " . $comp_sql9 . "<br>" . $conn->error;
            }
        } else {
            //insert comp9
            $comp_insert_sql9 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc9', '$uprice9', '$qty9', '$tprice9', '$time_start9', '$time_end9')";
            if ($conn->query($comp_insert_sql9) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql9 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc10)) {
        $sql_time_tbl_save_computation10 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id10' ");
        $row_time_tbl_save_computation10 = mysqli_fetch_assoc($sql_time_tbl_save_computation10);
        $time_start10 = $row_time_tbl_save_computation10['time_start']; $time_end10 = $row_time_tbl_save_computation10['time_end'];
        if ($sql_time_tbl_save_computation10->num_rows > 0) {
            //update comp10
            $comp_sql10 = "UPDATE tbl_save_computation SET description='$desc10', uprice='$uprice10', qty='$qty10', tprice='$tprice10' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id10' ";
            if ($conn->query($comp_sql10) === TRUE) {
            echo "Computation1-10 updated successfully";
            } else {
                echo "Error: " . $comp_sql10 . "<br>" . $conn->error;
            }
        } else {
            //insert comp10
            $comp_insert_sql10 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc10', '$uprice10', '$qty10', '$tprice10', '$time_start10', '$time_end10')";
            if ($conn->query($comp_insert_sql10) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql10 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc11)) {
        $sql_time_tbl_save_computation11 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id11' ");
        $row_time_tbl_save_computation11 = mysqli_fetch_assoc($sql_time_tbl_save_computation11);
        $time_start11 = $row_time_tbl_save_computation11['time_start']; $time_end11 = $row_time_tbl_save_computation11['time_end'];
        if ($sql_time_tbl_save_computation11->num_rows > 0) {
            //update comp11
            $comp_sql11 = "UPDATE tbl_save_computation SET description='$desc11', uprice='$uprice11', qty='$qty11', tprice='$tprice11' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id11' ";
            if ($conn->query($comp_sql11) === TRUE) {
            echo "Computation1-11 updated successfully";
            } else {
                echo "Error: " . $comp_sql11 . "<br>" . $conn->error;
            }
        } else {
            //insert comp11
            $comp_insert_sql11 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc11', '$uprice11', '$qty11', '$tprice11', '$time_start11', '$time_end11')";
            if ($conn->query($comp_insert_sql11) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql11 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc12)) {
        $sql_time_tbl_save_computation12 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id12' ");
        $row_time_tbl_save_computation12 = mysqli_fetch_assoc($sql_time_tbl_save_computation12);
        $time_start12 = $row_time_tbl_save_computation12['time_start']; $time_end12 = $row_time_tbl_save_computation12['time_end'];
        if ($sql_time_tbl_save_computation12->num_rows > 0) {
            //update comp12
            $comp_sql12 = "UPDATE tbl_save_computation SET description='$desc12', uprice='$uprice12', qty='$qty12', tprice='$tprice12' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id12' ";
            if ($conn->query($comp_sql12) === TRUE) {
            echo "Computation1-12 updated successfully";
            } else {
                echo "Error: " . $comp_sql12 . "<br>" . $conn->error;
            }
        } else {
            //insert comp12
            $comp_insert_sql12 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc12', '$uprice12', '$qty12', '$tprice12', '$time_start12', '$time_end12')";
            if ($conn->query($comp_insert_sql12) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql12 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc13)) {
        $sql_time_tbl_save_computation13 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id13' ");
        $row_time_tbl_save_computation13 = mysqli_fetch_assoc($sql_time_tbl_save_computation13);
        $time_start13 = $row_time_tbl_save_computation13['time_start']; $time_end13 = $row_time_tbl_save_computation13['time_end'];
        if ($sql_time_tbl_save_computation13->num_rows > 0) {
            //update comp13
            $comp_sql13 = "UPDATE tbl_save_computation SET description='$desc13', uprice='$uprice13', qty='$qty13', tprice='$tprice13' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id13' ";
            if ($conn->query($comp_sql13) === TRUE) {
            echo "Computation1-13 updated successfully";
            } else {
                echo "Error: " . $comp_sql13 . "<br>" . $conn->error;
            }
        } else {
            //insert comp13
            $comp_insert_sql13 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc13', '$uprice13', '$qty13', '$tprice13', '$time_start13', '$time_end13')";
            if ($conn->query($comp_insert_sql13) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql13 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc14)) {
        $sql_time_tbl_save_computation14 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id14' ");
        $row_time_tbl_save_computation14 = mysqli_fetch_assoc($sql_time_tbl_save_computation14);
        $time_start14 = $row_time_tbl_save_computation14['time_start']; $time_end14 = $row_time_tbl_save_computation14['time_end'];
        if ($sql_time_tbl_save_computation14->num_rows > 0) {
            //update comp14
            $comp_sql14 = "UPDATE tbl_save_computation SET description='$desc14', uprice='$uprice14', qty='$qty14', tprice='$tprice14' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id14' ";
            if ($conn->query($comp_sql14) === TRUE) {
            echo "Computation1-14 updated successfully";
            } else {
                echo "Error: " . $comp_sql14 . "<br>" . $conn->error;
            }
        } else {
            //insert comp14
            $comp_insert_sql14 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc14', '$uprice14', '$qty14', '$tprice14', '$time_start14', '$time_end14')";
            if ($conn->query($comp_insert_sql14) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql14 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc15)) {
        $sql_time_tbl_save_computation15 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id15' ");
        $row_time_tbl_save_computation15 = mysqli_fetch_assoc($sql_time_tbl_save_computation15);
        $time_start15 = $row_time_tbl_save_computation15['time_start']; $time_end15 = $row_time_tbl_save_computation15['time_end'];
        if ($sql_time_tbl_save_computation15->num_rows > 0) {
            //update comp15
            $comp_sql15 = "UPDATE tbl_save_computation SET description='$desc15', uprice='$uprice15', qty='$qty15', tprice='$tprice15' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id15' ";
            if ($conn->query($comp_sql15) === TRUE) {
            echo "Computation1-15 updated successfully";
            } else {
                echo "Error: " . $comp_sql15 . "<br>" . $conn->error;
            }
        } else {
            //insert comp15
            $comp_insert_sql15 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc15', '$uprice15', '$qty15', '$tprice15', '$time_start15', '$time_end15')";
            if ($conn->query($comp_insert_sql15) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql15 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc16)) {
        $sql_time_tbl_save_computation16 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id16' ");
        $row_time_tbl_save_computation16 = mysqli_fetch_assoc($sql_time_tbl_save_computation16);
        $time_start16 = $row_time_tbl_save_computation16['time_start']; $time_end16 = $row_time_tbl_save_computation16['time_end'];
        if ($sql_time_tbl_save_computation16->num_rows > 0) {
            //update comp16
            $comp_sql16 = "UPDATE tbl_save_computation SET description='$desc16', uprice='$uprice16', qty='$qty16', tprice='$tprice16' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id16' ";
            if ($conn->query($comp_sql16) === TRUE) {
            echo "Computation1-16 updated successfully";
            } else {
                echo "Error: " . $comp_sql16 . "<br>" . $conn->error;
            }
        } else {
            //insert comp16
            $comp_insert_sql16 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc16', '$uprice16', '$qty16', '$tprice16', '$time_start16', '$time_end16')";
            if ($conn->query($comp_insert_sql16) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql16 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc17)) {
        $sql_time_tbl_save_computation17 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id17' ");
        $row_time_tbl_save_computation17 = mysqli_fetch_assoc($sql_time_tbl_save_computation17);
        $time_start17 = $row_time_tbl_save_computation17['time_start']; $time_end17 = $row_time_tbl_save_computation17['time_end'];
        if ($sql_time_tbl_save_computation17->num_rows > 0) {
            //update comp17
            $comp_sql17 = "UPDATE tbl_save_computation SET description='$desc17', uprice='$uprice17', qty='$qty17', tprice='$tprice17' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id17' ";
            if ($conn->query($comp_sql17) === TRUE) {
            echo "Computation1-17 updated successfully";
            } else {
                echo "Error: " . $comp_sql17 . "<br>" . $conn->error;
            }
        } else {
            //insert comp17
            $comp_insert_sql17 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc17', '$uprice17', '$qty17', '$tprice17', '$time_start17', '$time_end17')";
            if ($conn->query($comp_insert_sql17) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql17 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc18)) {
        $sql_time_tbl_save_computation18 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id18' ");
        $row_time_tbl_save_computation18 = mysqli_fetch_assoc($sql_time_tbl_save_computation18);
        $time_start18 = $row_time_tbl_save_computation18['time_start']; $time_end18 = $row_time_tbl_save_computation18['time_end'];
        if ($sql_time_tbl_save_computation18->num_rows > 0) {
            //update comp18
            $comp_sql18 = "UPDATE tbl_save_computation SET description='$desc18', uprice='$uprice18', qty='$qty18', tprice='$tprice18' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id18' ";
            if ($conn->query($comp_sql18) === TRUE) {
            echo "Computation1-18 updated successfully";
            } else {
                echo "Error: " . $comp_sql18 . "<br>" . $conn->error;
            }
        } else {
            //insert comp18
            $comp_insert_sql18 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc18', '$uprice18', '$qty18', '$tprice18', '$time_start18', '$time_end18')";
            if ($conn->query($comp_insert_sql18) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql18 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc19)) {
        $sql_time_tbl_save_computation19 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id19' ");
        $row_time_tbl_save_computation19 = mysqli_fetch_assoc($sql_time_tbl_save_computation19);
        $time_start19 = $row_time_tbl_save_computation19['time_start']; $time_end19 = $row_time_tbl_save_computation19['time_end'];
        if ($sql_time_tbl_save_computation19->num_rows > 0) {
            //update comp19
            $comp_sql19 = "UPDATE tbl_save_computation SET description='$desc19', uprice='$uprice19', qty='$qty19', tprice='$tprice19' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id19' ";
            if ($conn->query($comp_sql19) === TRUE) {
            echo "Computation1-19 updated successfully";
            } else {
                echo "Error: " . $comp_sql19 . "<br>" . $conn->error;
            }
        } else {
            //insert comp19
            $comp_insert_sql19 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc19', '$uprice19', '$qty19', '$tprice19', '$time_start19', '$time_end19')";
            if ($conn->query($comp_insert_sql19) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql19 . "<br>" . $conn->error;
            }
        }
    } else {}

    if (!empty($desc20)) {
        $sql_time_tbl_save_computation20 = mysqli_query($conn, "SELECT * FROM tbl_save_computation WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' AND num_series='$id20' ");
        $row_time_tbl_save_computation20 = mysqli_fetch_assoc($sql_time_tbl_save_computation20);
        $time_start20 = $row_time_tbl_save_computation20['time_start']; $time_end20 = $row_time_tbl_save_computation20['time_end'];
        if ($sql_time_tbl_save_computation20->num_rows > 0) {
            //update comp20
            $comp_sql20 = "UPDATE tbl_save_computation SET description='$desc20', uprice='$uprice20', qty='$qty20', tprice='$tprice20' WHERE id_tbl_save_computation='$id_tbl_save_addl_entry' && num_series='$id20' ";
            if ($conn->query($comp_sql20) === TRUE) {
            echo "Computation1-20 updated successfully";
            } else {
                echo "Error: " . $comp_sql20 . "<br>" . $conn->error;
            }
        } else {
            //insert comp20
            $comp_insert_sql20 = "INSERT INTO tbl_save_computation (id_tbl_save_computation, transaction_code, cl_qn, description, uprice, qty, tprice, time_start, time_end) VALUES ('$id_tbl_save_addl_entry', '$transaction_code', '$cl_qn', '$desc20', '$uprice20', '$qty20', '$tprice20', '$time_start20', '$time_end20')";
            if ($conn->query($comp_insert_sql20) === TRUE) {
            echo "New data added successfully";
            } else {
                echo "Error: " . $comp_insert_sql20 . "<br>" . $conn->error;
            }
        }
    } else {}

    $stotal = $_SESSION['stotal'];
    $dcnt = $_SESSION['dcnt'];
    $totalamt = $_SESSION['totalamt'];
    $comp2_sql = "UPDATE tbl_save_computation2 SET stotal='$stotal', dcnt='$dcnt', totalamt='$totalamt' WHERE id_tbl_save_computation2='$id_tbl_save_addl_entry'";
        if ($conn->query($comp2_sql) === TRUE) {
        echo "Computation-2 updated successfully";
        } else {
            echo "Error: " . $comp2_sql . "<br>" . $conn->error;
        }
    
    echo '<script>';
        echo 'window.location.href = "../'.$sys_acronym.'/modify_forms_sw.php";';
    echo '</script>';
    
	$conn->close();
    //header("location: modify_forms_sw.php");
?>