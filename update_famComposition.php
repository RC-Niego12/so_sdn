<?php
	session_start();
    $_SESSION['qn'];
	include 'config.php';
	//client session
    $qn = $_SESSION['qn'];
    $id1 = $_SESSION['id1'];
    $lname1 = $_SESSION['lname1'];
    $fname1 = $_SESSION['fname1'];
    $mname1 = $_SESSION['mname1'];
    $nameext1 = $_SESSION['nameext1'];
    $bday1 = $_SESSION['bday1'];
    $age1 = $_SESSION['age1'];
    $occupation1 = $_SESSION['occupation1'];
    $salary1 = $_SESSION['salary1'];
    $reltobene1 = $_SESSION['reltobene1'];

    $id2 = $_SESSION['id2'];
    $lname2 = $_SESSION['lname2'];
    $fname2 = $_SESSION['fname2'];
    $mname2 = $_SESSION['mname2'];
    $nameext2 = $_SESSION['nameext2'];
    $bday2 = $_SESSION['bday2'];
    $age2 = $_SESSION['age2'];
    $occupation2 = $_SESSION['occupation2'];
    $salary2 = $_SESSION['salary2'];
    $reltobene2 = $_SESSION['reltobene2'];

    $id3 = $_SESSION['id3'];
    $lname3 = $_SESSION['lname3'];
    $fname3 = $_SESSION['fname3'];
    $mname3 = $_SESSION['mname3'];
    $nameext3 = $_SESSION['nameext3'];
    $bday3 = $_SESSION['bday3'];
    $age3 = $_SESSION['age3'];
    $occupation3 = $_SESSION['occupation3'];
    $salary3 = $_SESSION['salary3'];
    $reltobene3 = $_SESSION['reltobene3'];

    $id4 = $_SESSION['id4'];
    $lname4 = $_SESSION['lname4'];
    $fname4 = $_SESSION['fname4'];
    $mname4 = $_SESSION['mname4'];
    $nameext4 = $_SESSION['nameext4'];
    $bday4 = $_SESSION['bday4'];
    $age4 = $_SESSION['age4'];
    $occupation4 = $_SESSION['occupation4'];
    $salary4 = $_SESSION['salary4'];
    $reltobene4 = $_SESSION['reltobene4'];

    $id5 = $_SESSION['id5'];
    $lname5 = $_SESSION['lname5'];
    $fname5 = $_SESSION['fname5'];
    $mname5 = $_SESSION['mname5'];
    $nameext5 = $_SESSION['nameext5'];
    $bday5 = $_SESSION['bday5'];
    $age5 = $_SESSION['age5'];
    $occupation5 = $_SESSION['occupation5'];
    $salary5 = $_SESSION['salary5'];
    $reltobene5 = $_SESSION['reltobene5'];

    $id6 = $_SESSION['id6'];
    $lname6 = $_SESSION['lname6'];
    $fname6 = $_SESSION['fname6'];
    $mname6 = $_SESSION['mname6'];
    $nameext6 = $_SESSION['nameext6'];
    $bday6 = $_SESSION['bday6'];
    $age6 = $_SESSION['age6'];
    $occupation6 = $_SESSION['occupation6'];
    $salary6 = $_SESSION['salary6'];
    $reltobene6 = $_SESSION['reltobene6'];

    $id7 = $_SESSION['id7'];
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

    //update famComposition
    if (!empty($lname1)) {
        $sql1 = "UPDATE tbl_famcomposition SET lname='$lname1', fname='$fname1', mname='$mname1', nameext='$nameext1', reltobene='$reltobene1', bday='$bday1', age='$age1', occupation='$occupation1', salary='$salary1' WHERE qn='$qn' && id='$id1' ";
            if ($conn->query($sql1) === TRUE) {
            echo "Family Member #1's details are updated successfully!";
            } else {
                echo "Error: " . $sql1 . "<br>" . $conn->error;
            }
    } else {}

    if (!empty($lname2)) {
        $sql2 = "UPDATE tbl_famcomposition SET lname='$lname2', fname='$fname2', mname='$mname2', nameext='$nameext2', reltobene='$reltobene2', bday='$bday2', age='$age2', occupation='$occupation2', salary='$salary2' WHERE qn='$qn' && id='$id2' ";
            if ($conn->query($sql2) === TRUE) {
            echo "Family Member #2's details are updated successfully!";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
    } else {}
    
    if (!empty($lname3)) {
        $sql3 = "UPDATE tbl_famcomposition SET lname='$lname3', fname='$fname3', mname='$mname3', nameext='$nameext3', reltobene='$reltobene3', bday='$bday3', age='$age3', occupation='$occupation3', salary='$salary3' WHERE qn='$qn' && id='$id3' ";
            if ($conn->query($sql3) === TRUE) {
            echo "Family Member #3's details are updated successfully!";
            } else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }
    } else {}
    
    if (!empty($lname4)) {
        $sql4 = "UPDATE tbl_famcomposition SET lname='$lname4', fname='$fname4', mname='$mname4', nameext='$nameext4', reltobene='$reltobene4', bday='$bday4', age='$age4', occupation='$occupation4', salary='$salary4' WHERE qn='$qn' && id='$id4' ";
            if ($conn->query($sql4) === TRUE) {
            echo "Family Member #4's details are updated successfully!";
            } else {
                echo "Error: " . $sql4 . "<br>" . $conn->error;
            }
    } else {}
    
    if (!empty($lname5)) {
        $sql5 = "UPDATE tbl_famcomposition SET lname='$lname5', fname='$fname5', mname='$mname5', nameext='$nameext5', reltobene='$reltobene5', bday='$bday5, age='$age5', occupation='$occupation5', salary='$salary5' WHERE qn='$qn' && id='$id5' ";
            if ($conn->query($sql5) === TRUE) {
            echo "Family Member #5's details are updated successfully!";
            } else {
                echo "Error: " . $sql5 . "<br>" . $conn->error;
            }
    } else {}
    
    if (!empty($lname6)) {
        $sql6 = "UPDATE tbl_famcomposition SET lname='$lname6', fname='$fname6', mname='$mname6', nameext='$nameext6', reltobene='$reltobene6', bday='$bday6', age='$age6', occupation='$occupation6, salary='$salary6' WHERE qn='$qn' && id='$id6' ";
            if ($conn->query($sql6) === TRUE) {
            echo "Family Member #6's details are updated successfully!";
            } else {
                echo "Error: " . $sql6 . "<br>" . $conn->error;
            }
    } else {}
    
    if (!empty($lname7)) {
        $sql7 = "UPDATE tbl_famcomposition SET lname='$lname7', fname='$fname7', mname='$mname7', nameext='$nameext7', reltobene='$reltobene7', bday='$bday7', age='$age7', occupation='$occupation7', salary='$salary7' WHERE qn='$qn' && id='$id7' ";
            if ($conn->query($sql7) === TRUE) {
            echo "Family Member #7's details are updated successfully!";
            } else {
                echo "Error: " . $sql7 . "<br>" . $conn->error;
            }
    } else {}
    
    

    $sqltbl_num =  "UPDATE tbl_assign_table SET table_num='$table_num', assistance_type='$assistance_type', remarks='$remarks' WHERE cl_qn='$qn' ";
    if ($conn->query($sqltbl_num) === TRUE) {
        echo "Table Assignment updated successfully!";
    } else {
        echo "Error: " . $sqltbl_num . "<br>" . $conn->error;
    }  
	$conn->close();
    header("location: viewGIS.php");
?>