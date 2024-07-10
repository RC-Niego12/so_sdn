<?php
	session_start();
	include 'config.php';

    $staffid = $_SESSION['staffid'];
	$lname = $_SESSION['lname'];
	$fname = $_SESSION['fname'];
	$mname = $_SESSION['mname'];
	$nameext = $_SESSION['nameext'];
    $sex = $_SESSION['sex'];
	$bday = $_SESSION['bday'];
    $utype = $_SESSION['utype'];
    $lic_no = $_SESSION['lic_no'];
	$uname = $_SESSION['uname'];
	$pword = $_SESSION['pword'];
    $activityStatus = "";
    $since = "";
    
    //insert staff
	$sql = "INSERT INTO tbl_staffs(staffid, lname, fname, mname, nameext, sex, bday, utype, lic_no, uname, pword, activityStatus, since) VALUES ('$staffid','$lname', '$fname', '$mname','$nameext','$sex', '$bday', '$utype', '$lic_no', '$uname', '$pword', '$activityStatus', '$since')";
        if ($conn->query($sql) === TRUE) {
            echo "New account created successfully";
            header("location: firstSignIn.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    //insert profile pic
    //$sql2 = mysqli_query($conn, "SELECT * FROM alumnus WHERE lastName='$lastName' && firstName='$firstName' && middleName='$middleName' && userName='$userName'");
    //    $row = mysqli_fetch_assoc($sql2);
    //    $alumID = $row['alumnusID'];

    //    $dirtmp1 = "uploads";
    //    mkdir($dirtmp1, 0777);

    //    $dirtmp2 = $dirtmp1."/".$alumID."/";
    //    mkdir($dirtmp2,0777);

    //    $dir = $dirtmp2."my profile pics/";
    //    mkdir($dir, 0777);

    //    $target_dir = $dir;
    //    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //    $uploadOk = 1;
    //    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //    $imageFileSize = ($_FILES["fileToUpload"]["size"]);
    //    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    //    if($check !== false) {
    //        echo "File is an image - " . $check["mime"] . ".";
    //        $uploadOk = 1;
    //    } else {
    //        echo "File is not an image.";
    //        $uploadOk = 0;
    //    }
        // Check if $uploadOk is set to 0 by an error
    //    if ($uploadOk == 0) {
    //        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    //    } else {
    //        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //        $uploadedby=$alumID;
    //        $imagename=basename( $_FILES["fileToUpload"]["name"]);
    //        $imagedir=$dir;
    //       $imagefiletype=$imageFileType;
    //        $imagesize=$imageFileSize;

    //            $s = "INSERT INTO imageprofpic_table (uploadedBy, imagename, imagedir, imagefiletype, imagesize) VALUES ('$uploadedby', '$imagename', '$imagedir','$imagefiletype', '$imagesize')";
    //            if ($conn->query($s) === TRUE) {
    //                echo "New record created successfully";
    //                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. File size is ".$imagesize.".";
    //            } else {
    //                echo "Error: " . $s . "<br>" . $conn->error;
    //            }

    //        } else {
    //            echo "Sorry, there was an error uploading your file.";
    //        }
    //    }

	$conn->close();
    header("location: firstSignIn.php");
	?>