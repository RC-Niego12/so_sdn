<?php
	session_start();
	include 'config.php';
    $checked_obdv = $_SESSION['checkbox'];
    $trml_code = $_SESSION['trml_code'];
    $prep_by = $_SESSION['prep_by'];

    $checkbox_exp = explode(',', $_SESSION['checkbox']);
    $checkbox_arrval = array_values($checkbox_exp);
    $count = count($checkbox_arrval)-2;
    $count2 = $count+1;
    //Loop through each array index
    for($i = 0; $i <= $count; $i++) {
        $i2 = $i+1;
        //Assign the value of the array key to a variable
        $obs_dv_code = $checkbox_arrval[$i];

        //insert to tbl_obs_dv_transmittal
        $sql2 = "INSERT INTO tbl_obs_dv_transmittal (transmittal_code, obdv_code, prep_by) VALUES ('$trml_code', '$checked_obdv', '$prep_by')";
        if ($conn->query($sql2) === TRUE) {
            echo "New Transmittal created successfully!";
            echo '<script>alert("New Transmittal created successfully!");</script>';
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
            echo '<script>alert("Error: " . $sql2 . "<br>" . $conn->error");</script>';
        }

        //insert to tbl_obs_dv_transmitted
        $sql = "INSERT INTO tbl_obs_dv_transmitted (obdv_code2, transmittal_code2, prep_by2) VALUES ('$obs_dv_code', '$trml_code', '$prep_by')";
        if ($conn->query($sql) === TRUE) {
            echo "OBs & DV added to transmittal successfully!";
            echo '<script>alert("OBs & DV added to transmittal successfully!");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo '<script>alert("Error: " . $sql . "<br>" . $conn->error");</script>';
        }
    }
     
	$conn->close();
    header("location: track_obsdv.php");
	?>