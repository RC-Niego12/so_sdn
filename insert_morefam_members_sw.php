<?php
	session_start();
    $_SESSION['cl_qn2'];
	include 'config.php';
	//client session
    $id = $_SESSION['cl_qn2'];
    $transaction_code = $_SESSION['transaction_code'];
    $qn = $_SESSION['qn'];
    $time_start = $_SESSION['time_start'];
    $time_end = $_SESSION['time_end'];
    $lname1 = $_SESSION['lname1'];
    $fname1 = $_SESSION['fname1'];
    $mname1 = $_SESSION['mname1'];
    $nameext1 = $_SESSION['nameext1'];
    $bday1 = $_SESSION['bday1'];
    $age1 = $_SESSION['age1'];
    $occupation1 = $_SESSION['occupation1'];
    $salary1 = $_SESSION['salary1'];
    $reltobene1 = $_SESSION['reltobene1'];

    $lname2 = $_SESSION['lname2'];
    $fname2 = $_SESSION['fname2'];
    $mname2 = $_SESSION['mname2'];
    $nameext2 = $_SESSION['nameext2'];
    $bday2 = $_SESSION['bday2'];
    $age2 = $_SESSION['age2'];
    $occupation2 = $_SESSION['occupation2'];
    $salary2 = $_SESSION['salary2'];
    $reltobene2 = $_SESSION['reltobene2'];

    $lname3 = $_SESSION['lname3'];
    $fname3 = $_SESSION['fname3'];
    $mname3 = $_SESSION['mname3'];
    $nameext3 = $_SESSION['nameext3'];
    $bday3 = $_SESSION['bday3'];
    $age3 = $_SESSION['age3'];
    $occupation3 = $_SESSION['occupation3'];
    $salary3 = $_SESSION['salary3'];
    $reltobene3 = $_SESSION['reltobene3'];

    $lname4 = $_SESSION['lname4'];
    $fname4 = $_SESSION['fname4'];
    $mname4 = $_SESSION['mname4'];
    $nameext4 = $_SESSION['nameext4'];
    $bday4 = $_SESSION['bday4'];
    $age4 = $_SESSION['age4'];
    $occupation4 = $_SESSION['occupation4'];
    $salary4 = $_SESSION['salary4'];
    $reltobene4 = $_SESSION['reltobene4'];

    $lname5 = $_SESSION['lname5'];
    $fname5 = $_SESSION['fname5'];
    $mname5 = $_SESSION['mname5'];
    $nameext5 = $_SESSION['nameext5'];
    $bday5 = $_SESSION['bday5'];
    $age5 = $_SESSION['age5'];
    $occupation5 = $_SESSION['occupation5'];
    $salary5 = $_SESSION['salary5'];
    $reltobene5 = $_SESSION['reltobene5'];

    $lname6 = $_SESSION['lname6'];
    $fname6 = $_SESSION['fname6'];
    $mname6 = $_SESSION['mname6'];
    $nameext6 = $_SESSION['nameext6'];
    $bday6 = $_SESSION['bday6'];
    $age6 = $_SESSION['age6'];
    $occupation6 = $_SESSION['occupation6'];
    $salary6 = $_SESSION['salary6'];
    $reltobene6 = $_SESSION['reltobene6'];

    $lname7 = $_SESSION['lname7'];
    $fname7 = $_SESSION['fname7'];
    $mname7 = $_SESSION['mname7'];
    $nameext7 = $_SESSION['nameext7'];
    $bday7 = $_SESSION['bday7'];
    $age7 = $_SESSION['age7'];
    $occupation7 = $_SESSION['occupation7'];
    $salary7 = $_SESSION['salary7'];
    $reltobene7 = $_SESSION['reltobene7'];

    $table_num = $_SESSION['table_num'];
    $assistance_type = $_SESSION['assistance_type'];
    $remarks = $_SESSION['remarks'];

    if (!empty($lname1)) {
        //insert famComposition
        $sql1 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname1', '$fname1', '$mname1', '$nameext1', '$reltobene1', '$bday1', '$age1', '$occupation1', '$salary1', '$time_start', '$time_end')";
            if ($conn->query($sql1) === TRUE) {
                echo "FamMember#1 added successfully!";
            } else {
                echo "Error: " . $sql1 . "<br>" . $conn->error;
            }
    } else {

    }
    
    if (!empty($lname2)) {
        $sql2 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname2', '$fname2', '$mname2', '$nameext2', '$reltobene2', '$bday2', '$age2', '$occupation2', '$salary2', '$time_start', '$time_end')";
            if ($conn->query($sql2) === TRUE) {
                echo "FamMember#2 added successfully!";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
    } else {

    }

    if (!empty($lname3)) {
        $sql3 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname3', '$fname3', '$mname3', '$nameext3', '$reltobene3', '$bday3', '$age3', '$occupation3', '$salary3', '$time_start', '$time_end')";
            if ($conn->query($sql3) === TRUE) {
                echo "FamMember#3 added successfully!";
            } else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }
    } else {

    }

    if (!empty($lname4)) {
        $sql4 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname4', '$fname4', '$mname4', '$nameext4', '$reltobene4', '$bday4', '$age4', '$occupation4', '$salary4', '$time_start', '$time_end')";
            if ($conn->query($sql4) === TRUE) {
                echo "FamMember#4 added successfully!";
            } else {
                echo "Error: " . $sql4 . "<br>" . $conn->error;
            }
    } else {

    }

    if (!empty($lname5)) {
        $sql5 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname5', '$fname5', '$mname5', '$nameext5', '$reltobene5', '$bday5', '$age5', '$occupation5', '$salary5', '$time_start', '$time_end')";
            if ($conn->query($sql5) === TRUE) {
                echo "FamMember#5 added successfully!";
            } else {
                echo "Error: " . $sql5 . "<br>" . $conn->error;
            }
    } else {

    }

    if (!empty($lname6)) {
        $sql6 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname6', '$fname6', '$mname6', '$nameext6', '$reltobene6', '$bday6', '$age6', '$occupation6', '$salary6', '$time_start', '$time_end')";
            if ($conn->query($sql6) === TRUE) {
                echo "FamMember#6 added successfully!";
            } else {
                echo "Error: " . $sql6 . "<br>" . $conn->error;
            }
    } else {

    }

    if (!empty($lname7)) {
        $sql7 = "INSERT INTO tbl_save_famcomposition (id_tbl_save_famcomposition, transaction_code, cl_qn, lname, fname, mname, nameext, reltobene, bday, age, occupation, salary, time_start, time_end)
            VALUES ( '$id', '$transaction_code', '$qn', '$lname7', '$fname7', '$mname7', '$nameext7', '$reltobene7', '$bday7', '$age7', '$occupation7', '$salary7', '$time_start', '$time_end')";
            if ($conn->query($sql7) === TRUE) {
                echo "FamMember#7 added successfully!";
            } else {
                echo "Error: " . $sql7 . "<br>" . $conn->error;
            }
    } else {

    }
	$conn->close();
    header("location: add_morefam_members_sw.php");
?>