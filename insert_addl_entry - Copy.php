<?php
    session_start();
    $_SESSION['cl_qn'];
    include 'config.php';
    
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
    $gl_code = $_SESSION['gl_code'];

    $result = mysqli_query($conn,"SELECT * FROM tbl_addl_entry WHERE cl_qn='$cl_qn' AND release_mode='$release_mode' AND admission_mode='$admission_mode' AND assistance_type='$assistance_type' AND purpose='$purpose' AND sp='$sp' AND amount_in_figures='$amount_in_figures' AND fund_source='$fund_source' AND assessment='$assessment' AND gl_code='$gl_code' ");

    if ($result->num_rows > 0) {
        echo "No. of Results: ".$result->num_rows."<br>";
        echo "Additional Entry Already Saved!<br>";
    } else {
        //insert addl entry
        $sql = "INSERT INTO tbl_addl_entry (cl_qn, release_mode, admission_mode, assistance_type, purpose, remarks_pcv, canvassed_by, sp, sp_address, amount_in_figures, amount_in_words, fund_source, cl_id, bn_id, other_attachments, other_attachments2, other_addl_attachments, material_assistance, psycho_support, referral, diagnosis, assessment, gl_code, swo_staffid)
            VALUES ('$cl_qn', '$release_mode', '$admission_mode', '$assistance_type', '$purpose', '$remarks_pcv', '$canvassed_by', '$sp', '$sp_address', '$amount_in_figures', '$amount_in_words', '$fund_source', '$cl_id', '$bn_id', '$other_attachments', '$other_attachments2', '$other_addl_attachments', '$material_assistance', '$psycho_support', '$referral', '$diagnosis', '$assessment', '$gl_code', '$swo_staffid')";
        if ($conn->query($sql) === TRUE) {
            echo "New data added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stotal = $_SESSION['stotal'];
        $dcnt = $_SESSION['dcnt'];
        $totalamt = $_SESSION['totalamt'];

        $desc1 = $_SESSION['desc1'];
        $uprice1 = $_SESSION['uprice1'];
        $qty1 = $_SESSION['qty1'];
        $tprice1 = $_SESSION['tprice1'];

        $desc2 = $_SESSION['desc2'];
        $uprice2 = $_SESSION['uprice2'];
        $qty2 = $_SESSION['qty2'];
        $tprice2 = $_SESSION['tprice2'];

        $desc3 = $_SESSION['desc3'];
        $uprice3 = $_SESSION['uprice3'];
        $qty3 = $_SESSION['qty3'];
        $tprice3 = $_SESSION['tprice3'];

        $desc4 = $_SESSION['desc4'];
        $uprice4 = $_SESSION['uprice4'];
        $qty4 = $_SESSION['qty4'];
        $tprice4 = $_SESSION['tprice4'];

        $desc5 = $_SESSION['desc5'];
        $uprice5 = $_SESSION['uprice5'];
        $qty5 = $_SESSION['qty5'];
        $tprice5 = $_SESSION['tprice5'];

        $desc6 = $_SESSION['desc6'];
        $uprice6 = $_SESSION['uprice6'];
        $qty6 = $_SESSION['qty6'];
        $tprice6 = $_SESSION['tprice6'];

        $desc7 = $_SESSION['desc7'];
        $uprice7 = $_SESSION['uprice7'];
        $qty7 = $_SESSION['qty7'];
        $tprice7 = $_SESSION['tprice7'];

        $desc8 = $_SESSION['desc8'];
        $uprice8 = $_SESSION['uprice8'];
        $qty8 = $_SESSION['qty8'];
        $tprice8 = $_SESSION['tprice8'];

        $desc9 = $_SESSION['desc9'];
        $uprice9 = $_SESSION['uprice9'];
        $qty9 = $_SESSION['qty9'];
        $tprice9 = $_SESSION['tprice9'];

        $desc10 = $_SESSION['desc10'];
        $uprice10 = $_SESSION['uprice10'];
        $qty10 = $_SESSION['qty10'];
        $tprice10 = $_SESSION['tprice10'];

        $desc11 = $_SESSION['desc11'];
        $uprice11 = $_SESSION['uprice11'];
        $qty11 = $_SESSION['qty11'];
        $tprice11 = $_SESSION['tprice11'];

        $desc12 = $_SESSION['desc12'];
        $uprice12 = $_SESSION['uprice12'];
        $qty12 = $_SESSION['qty12'];
        $tprice12 = $_SESSION['tprice12'];

        $desc13 = $_SESSION['desc13'];
        $uprice13 = $_SESSION['uprice13'];
        $qty13 = $_SESSION['qty13'];
        $tprice13 = $_SESSION['tprice13'];

        $desc14 = $_SESSION['desc14'];
        $uprice14 = $_SESSION['uprice14'];
        $qty14 = $_SESSION['qty14'];
        $tprice14 = $_SESSION['tprice14'];

        $desc15 = $_SESSION['desc15'];
        $uprice15 = $_SESSION['uprice15'];
        $qty15 = $_SESSION['qty15'];
        $tprice15 = $_SESSION['tprice15'];

        $desc16 = $_SESSION['desc16'];
        $uprice16 = $_SESSION['uprice16'];
        $qty16 = $_SESSION['qty16'];
        $tprice16 = $_SESSION['tprice16'];

        $desc17 = $_SESSION['desc17'];
        $uprice17 = $_SESSION['uprice17'];
        $qty17 = $_SESSION['qty17'];
        $tprice17 = $_SESSION['tprice17'];

        $desc18 = $_SESSION['desc18'];
        $uprice18 = $_SESSION['uprice18'];
        $qty18 = $_SESSION['qty18'];
        $tprice18 = $_SESSION['tprice18'];

        $desc19 = $_SESSION['desc19'];
        $uprice19 = $_SESSION['uprice19'];
        $qty19 = $_SESSION['qty19'];
        $tprice19 = $_SESSION['tprice19'];

        $desc20 = $_SESSION['desc20'];
        $uprice20 = $_SESSION['uprice20'];
        $qty20 = $_SESSION['qty20'];
        $tprice20 = $_SESSION['tprice20'];

        //get date now
        date_default_timezone_set('Asia/Manila');
        $y_now = date('Y');
        $m_now = date('m');
        $d_now = date('d');

        if (!empty($desc1)) {
            //check item #1 first in tbl_computation
            $chk_comp_sql1 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc1' AND uprice='$uprice1' AND qty='$qty1' AND tprice='$tprice1' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql1->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql1->num_rows."<br>";
                echo "Item #1 Already Saved Today!<br>";
            } else {
                //insert item #1
                $comp_sql1 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc1', '$uprice1', '$qty1', '$tprice1')";
                if ($conn->query($comp_sql1) === TRUE) {
                echo "Item #1 added successfully";
                } else {
                    echo "Error: " . $comp_sql1 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc2)) {
            //check item #2 first in tbl_computation
            $chk_comp_sql2 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc2' AND uprice='$uprice2' AND qty='$qty2' AND tprice='$tprice2' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql2->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql2->num_rows."<br>";
                echo "Item #2 Already Saved Today!<br>";
            } else {
                //insert item #2
                $comp_sql2 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc2', '$uprice2', '$qty2', '$tprice2')";
                if ($conn->query($comp_sql2) === TRUE) {
                echo "Item #2 added successfully";
                } else {
                    echo "Error: " . $comp_sql2 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc3)) {
            //check item #3 first in tbl_computation
            $chk_comp_sql3 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc3' AND uprice='$uprice3' AND qty='$qty3' AND tprice='$tprice3' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql3->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql3->num_rows."<br>";
                echo "Item #3 Already Saved Today!<br>";
            } else {
                //insert item #3
                $comp_sql3 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc3', '$uprice3', '$qty3', '$tprice3')";
                if ($conn->query($comp_sql3) === TRUE) {
                echo "Item #3 added successfully";
                } else {
                    echo "Error: " . $comp_sql3 . "<br>" . $conn->error;
                }
            }
        } else {}
        
        if (!empty($desc4)) {
            //check item #4 first in tbl_computation
            $chk_comp_sql4 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn'AND description='$desc4' AND uprice='$uprice4' AND qty='$qty4' AND tprice='$tprice4' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql4->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql4->num_rows."<br>";
                echo "Item #4 Already Saved Today!<br>";
            } else {
                //insert item #4
                $comp_sql4 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc4', '$uprice4', '$qty4', '$tprice4')";
                if ($conn->query($comp_sql4) === TRUE) {
                echo "Item #4 added successfully";
                } else {
                    echo "Error: " . $comp_sql4 . "<br>" . $conn->error;
                }
            }
        } else {}
        
        if (!empty($desc5)) {
            //check item #5 first in tbl_computation
            $chk_comp_sql5 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc5' AND uprice='$uprice5' AND qty='$qty5' AND tprice='$tprice5' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql5->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql5->num_rows."<br>";
                echo "Item #5 Already Saved Today!<br>";
            } else {
                //insert item #5
                $comp_sql5 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc5', '$uprice5', '$qty5', '$tprice5')";
                if ($conn->query($comp_sql5) === TRUE) {
                echo "Item #5 added successfully";
                } else {
                    echo "Error: " . $comp_sql5 . "<br>" . $conn->error;
                }
            }
        } else {}
        
        if (!empty($desc6)) {
            //check item #6 first in tbl_computation
            $chk_comp_sql6 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn'AND description='$desc6' AND uprice='$uprice6' AND qty='$qty6' AND tprice='$tprice6' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql6->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql6->num_rows."<br>";
                echo "Item #6 Already Saved Today!<br>";
            } else {
                //insert item #6
                $comp_sql6 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc6', '$uprice6', '$qty6', '$tprice6')";
                if ($conn->query($comp_sql6) === TRUE) {
                echo "Item #6 added successfully";
                } else {
                    echo "Error: " . $comp_sql6 . "<br>" . $conn->error;
                }
            }
        } else {}
        
        if (!empty($desc7)) {
            //check item #7 first in tbl_computation
            $chk_comp_sql7 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn'AND description='$desc7' AND uprice='$uprice7' AND qty='$qty7' AND tprice='$tprice7' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql7->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql7->num_rows."<br>";
                echo "Item #7 Already Saved Today!<br>";
            } else {
                //insert item #7
                $comp_sql7 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc7', '$uprice7', '$qty7', '$tprice7')";
                if ($conn->query($comp_sql7) === TRUE) {
                echo "Item #7 added successfully";
                } else {
                    echo "Error: " . $comp_sql7 . "<br>" . $conn->error;
                }
            }
        } else {}
        
        if (!empty($desc8)) {
            //check item #8 first in tbl_computation
            $chk_comp_sql8 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn'AND description='$desc8' AND uprice='$uprice8' AND qty='$qty8' AND tprice='$tprice8' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql8->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql8->num_rows."<br>";
                echo "Item #8 Already Saved Today!<br>";
            } else {
                //insert item #8
                $comp_sql8 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc8', '$uprice8', '$qty8', '$tprice8')";
                if ($conn->query($comp_sql8) === TRUE) {
                echo "Item #8 added successfully";
                } else {
                    echo "Error: " . $comp_sql8 . "<br>" . $conn->error;
                }
            }
        } else {}
        
        if (!empty($desc9)) {
            //check item #9 first in tbl_computation
            $chk_comp_sql9 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn'AND description='$desc9' AND uprice='$uprice9' AND qty='$qty9' AND tprice='$tprice9' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql9->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql9->num_rows."<br>";
                echo "Item #9 Already Saved Today!<br>";
            } else {
                //insert item #9
                $comp_sql9 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc9', '$uprice9', '$qty9', '$tprice9')";
                if ($conn->query($comp_sql9) === TRUE) {
                echo "Item #9 added successfully";
                } else {
                    echo "Error: " . $comp_sql9 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc10)) {
            //check item #10 first in tbl_computation
            $chk_comp_sql10 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc10' AND uprice='$uprice10' AND qty='$qty10' AND tprice='$tprice10' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql10->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql10->num_rows."<br>";
                echo "Item #10 Already Saved Today!<br>";
            } else {
                //insert item #10
                $comp_sql10 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc10', '$uprice10', '$qty10', '$tprice10')";
                if ($conn->query($comp_sql10) === TRUE) {
                echo "Item #10 added successfully";
                } else {
                    echo "Error: " . $comp_sql10 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc11)) {
            //check item #11 first in tbl_computation
            $chk_comp_sql11 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc11' AND uprice='$uprice11' AND qty='$qty11' AND tprice='$tprice11' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql11->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql11->num_rows."<br>";
                echo "Item #11 Already Saved Today!<br>";
            } else {
                //insert item #11
                $comp_sql11 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc11', '$uprice11', '$qty11', '$tprice11')";
                if ($conn->query($comp_sql11) === TRUE) {
                echo "Item #11 added successfully";
                } else {
                    echo "Error: " . $comp_sql11 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc12)) {
            //check item #12 first in tbl_computation
            $chk_comp_sql12 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc12' AND uprice='$uprice12' AND qty='$qty12' AND tprice='$tprice12' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql12->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql12->num_rows."<br>";
                echo "Item #12 Already Saved Today!<br>";
            } else {
                //insert item #12
                $comp_sql12 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc12', '$uprice12', '$qty12', '$tprice12')";
                if ($conn->query($comp_sql12) === TRUE) {
                echo "Item #12 added successfully";
                } else {
                    echo "Error: " . $comp_sql12 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc13)) {
            //check item #13 first in tbl_computation
            $chk_comp_sql13 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc13' AND uprice='$uprice13' AND qty='$qty13' AND tprice='$tprice13' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql13->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql13->num_rows."<br>";
                echo "Item #13 Already Saved Today!<br>";
            } else {
                //insert item #13
                $comp_sql13 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc13', '$uprice13', '$qty13', '$tprice13')";
                if ($conn->query($comp_sql13) === TRUE) {
                echo "Item #13 added successfully";
                } else {
                    echo "Error: " . $comp_sql13 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc14)) {
            //check item #14 first in tbl_computation
            $chk_comp_sql14 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc14' AND uprice='$uprice14' AND qty='$qty14' AND tprice='$tprice14' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql14->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql14->num_rows."<br>";
                echo "Item #14 Already Saved Today!<br>";
            } else {
                //insert item #14
                $comp_sql14 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc14', '$uprice14', '$qty14', '$tprice14')";
                if ($conn->query($comp_sql14) === TRUE) {
                echo "Item #14 added successfully";
                } else {
                    echo "Error: " . $comp_sql14 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc15)) {
            //check item #15 first in tbl_computation
            $chk_comp_sql15 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc15' AND uprice='$uprice15' AND qty='$qty15' AND tprice='$tprice15' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql15->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql15->num_rows."<br>";
                echo "Item #15 Already Saved Today!<br>";
            } else {
                //insert item #15
                $comp_sql15 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc15', '$uprice15', '$qty15', '$tprice15')";
                if ($conn->query($comp_sql15) === TRUE) {
                echo "Item #15 added successfully";
                } else {
                    echo "Error: " . $comp_sql15 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc16)) {
            //check item #16 first in tbl_computation
            $chk_comp_sql16 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc16' AND uprice='$uprice16' AND qty='$qty16' AND tprice='$tprice16' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql16->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql16->num_rows."<br>";
                echo "Item #16 Already Saved Today!<br>";
            } else {
                //insert item #16
                $comp_sql16 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc16', '$uprice16', '$qty16', '$tprice16')";
                if ($conn->query($comp_sql16) === TRUE) {
                echo "Item #16 added successfully";
                } else {
                    echo "Error: " . $comp_sql16 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc17)) {
            //check item #17 first in tbl_computation
            $chk_comp_sql17 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc17' AND uprice='$uprice17' AND qty='$qty17' AND tprice='$tprice17' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql17->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql17->num_rows."<br>";
                echo "Item #17 Already Saved Today!<br>";
            } else {
                //insert item #17
                $comp_sql17 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc17', '$uprice17', '$qty17', '$tprice17')";
                if ($conn->query($comp_sql17) === TRUE) {
                echo "Item #17 added successfully";
                } else {
                    echo "Error: " . $comp_sql17 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc18)) {
            //check item #18 first in tbl_computation
            $chk_comp_sql18 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc18' AND uprice='$uprice18' AND qty='$qty18' AND tprice='$tprice18' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql18->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql18->num_rows."<br>";
                echo "Item #18 Already Saved Today!<br>";
            } else {
                //insert item #18
                $comp_sql18 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc18', '$uprice18', '$qty18', '$tprice18')";
                if ($conn->query($comp_sql18) === TRUE) {
                echo "Item #18 added successfully";
                } else {
                    echo "Error: " . $comp_sql18 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc19)) {
            //check item #19 first in tbl_computation
            $chk_comp_sql19 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc19' AND uprice='$uprice19' AND qty='$qty19' AND tprice='$tprice19' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql19->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql19->num_rows."<br>";
                echo "Item #19 Already Saved Today!<br>";
            } else {
                //insert item #19
                $comp_sql19 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc19', '$uprice19', '$qty19', '$tprice19')";
                if ($conn->query($comp_sql19) === TRUE) {
                echo "Item #19 added successfully";
                } else {
                    echo "Error: " . $comp_sql19 . "<br>" . $conn->error;
                }
            }
        } else {}

        if (!empty($desc20)) {
            //check item #20 first in tbl_computation
            $chk_comp_sql20 =  mysqli_query($conn, "SELECT * FROM tbl_computation WHERE cl_qn='$cl_qn' AND description='$desc20' AND uprice='$uprice20' AND qty='$qty20' AND tprice='$tprice20' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
            if ($chk_comp_sql20->num_rows > 0) {
                echo "No. of Results: ".$chk_comp_sql20->num_rows."<br>";
                echo "Item #20 Already Saved Today!<br>";
            } else {
                //insert item #20
                $comp_sql20 = "INSERT INTO tbl_computation (cl_qn, description, uprice, qty, tprice)
                VALUES ('$cl_qn', '$desc20', '$uprice20', '$qty20', '$tprice20')";
                if ($conn->query($comp_sql20) === TRUE) {
                echo "Item #20 added successfully";
                } else {
                    echo "Error: " . $comp_sql20 . "<br>" . $conn->error;
                }
            }
        } else {}

        $stotal = $_SESSION['stotal'];
        $dcnt = $_SESSION['dcnt'];
        $totalamt = $_SESSION['totalamt'];
        //check computation first in tbl_computation2
        $chk_comp2_sql =  mysqli_query($conn, "SELECT * FROM tbl_computation2 WHERE cl_qn='$cl_qn' AND stotal='$stotal' AND dcnt='$dcnt' AND totalamt='$totalamt' AND YEAR(date_added)='$y_now' AND MONTH(date_added)='$m_now' AND DATE(date_added)='$d_now'");
        if ($chk_comp2_sql->num_rows > 0) {
            echo "No. of Results: ".$chk_comp2_sql->num_rows."<br>";
            echo "Computation of Client # ".$cl_qn."Already Saved Today!<br>";
        } else {
            //insert computation of items for current client
            $comp2_sql = "INSERT INTO tbl_computation2 (cl_qn, stotal, dcnt, totalamt)
                VALUES ('$cl_qn', '$stotal', '$dcnt', '$totalamt')";
            if ($conn->query($comp2_sql) === TRUE) {
            echo "Computation of Client # ".$cl_qn."added successfully";
            } else {
                echo "Error: " . $comp2_sql . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    header("location: forms_sw.php");
?>