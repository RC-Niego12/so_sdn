<?php
    // Start the session
    session_start();
    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];
    
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname='".$_SESSION['uname']."' AND pword='".$_SESSION['pword']."' ");
    $row = mysqli_fetch_assoc($sql);
    if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==false)) {
        header("Location: index.php");
    }
    $staffid = $row['staffid'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $sys_acronym; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="images/DSWD-logo.png">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    
    <!-- Custom Fonts -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/theme-darkblue.css" rel="stylesheet" />  

    <!-- Custom Css -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">  

</head>
    
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->

<body>
	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
		<div class="login-page">
		    <div class="text-center" style="color: white; text-shadow: 4px 3px black;">
		        <img class="login-DSWD-logo" src="images/DSWD-logo.png">
		        <h1><b><?php echo $sys_acronym; ?></b></h1>
		        <h3 style="letter-spacing: -1px;"><?php echo $sysname; ?></h3>
		    </div>
		    <div class="login-box">
		        <div class="card" id="membersignin" style="opacity: 0.9;">
		            <div class="header text-center bg-darkblue">
		                <h3 style="margin-top: -10px; margin-bottom: -10px; color: white;">Serving as Table No.___:</h3>
		            </div>
		            <?php
		                $_SESSION['table_num'] = $tablematch = $staffidmatch = $no_table_added_yet = $error = "";
		                if (isset($_POST['assign_table'])) {
		                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		                        $_SESSION['table_num'] = mysqli_real_escape_string($conn, $_POST['table_num']);
		                        $table_num = $_SESSION['table_num'];
		                         //echo $table_num; ?><br><?php

		                        $sql2 = mysqli_query($conn,"SELECT * FROM tbl_sw_table");
		                        if ($sql2->num_rows > 0) {
		                            if ($sql2->num_rows < $table_num) {
		                                $error = "The number you entered exceeds the total number of tables available! Please enter another number again.";
		                            } else {
		                                $table_sql = mysqli_query($conn, "SELECT * FROM tbl_sw_table WHERE table_num = '".$table_num."'");
		                                $row2 = mysqli_fetch_assoc($table_sql);
		                                $staffid2 = $row2['staffid2'];
		                                if (!empty($staffid2)) {
		                                    //echo $staffid2; ?><br> <?php
		                                    $tablematch = "Table No. $table_num is already in use! Please select another Table No.";
		                                } else {
		                                    //echo "Not in use!"; ?><br> <?php
		                                    $update_sql = mysqli_query($conn, "UPDATE tbl_sw_table SET staffid2 = '$staffid' WHERE table_num = '".$table_num."'");
		                                    $result = ($update_sql);
		                                        if ($result === TRUE) {
		                                          echo "Record updated successfully"; ?><br> <?php
		                                        } else {
		                                          echo "Error updating record: " . $conn->error; ?><br> <?php
		                                        }
		                                    echo "Table Assigned Successfully!"; ?><br> <?php
		                                    header("location: home_sw.php");
		                                }
		                            }
		                        } else {
		                            $no_table_added_yet = "Administrator has not yet added tables. Please contact Administrator immediately!";
		                        }
		                    }
		                    function test_input($data) {
		                      $data = trim($data);
		                      $data = stripslashes($data);
		                      $data = htmlspecialchars($data);
		                      return $data;
		                    }
		                }
		            ?>
		            <div class="body">
		                <form action="" method="POST">
		                    <!-- Other Client Sub-Category -->
		                    <div class="row clearfix">
		                        <div class="col-xs-11">
		                            <div class="form-group form-float" style="text-align: left;">
		                                <!-- <label>Username: <?php echo $row['uname']; ?></label><br>
		                                <label>Password: <?php echo $row['pword']; ?></label><br> -->
		                                <label>Kindly enter your Table No.</label>
		                                <div class="form-line">
		                                    <input class="form-control" type="number" name="table_num" id="table_num" maxlength="2" autofocus required>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-xs-1">
		                            <span style="color: red; font-size: 2em;">*</span>
		                        </div>
		                    </div>
		                    <div class="row clearfix">
		                        <span class="error"><?php echo $tablematch; ?></span>
		                        <span class="error"><?php echo $staffidmatch; ?></span>
		                        <span class="error"><?php echo $no_table_added_yet; ?></span>
		                        <span class="error"><?php echo $error; ?></span>
		                    </div>
		                    <div class="row clearfix">
		                        <div class="col-xs-4">
		                        </div>
		                        <div class="col-xs-4">
		                            <a style="color: white;"><button class="btn btn-block bg-darkblue waves-effect" name="assign_table" type="submit">Proceed</button></a>
		                        </div>
		                    </div><hr>
		                    <div class="row clearfix">
		                        <div class="col-xs-12">
		                            <div class="form-group form-float" style="text-align: left;">
		                                <h5>Total # of Tables:<span>
		                                <?php
		                                    $sql = mysqli_query($conn, "SELECT * FROM tbl_sw_table");
		                                    if ($result = $sql) {
		                                        // Return the number of rows in result set
		                                        $rowcount = mysqli_num_rows($result);
		                                        echo $rowcount;
		                                        // Free result set
		                                        mysqli_free_result($result);
		                                    }
		                                ?>
		                            </div>
		                            <div class="table-responsive" style="overflow-x: hidden; font-size: 1em; width: 100%;">
		                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable text-left">
		                                    <thead class="bg-darkblue" style="color: white;">
		                                        <tr>
		                                            <th>Taken Table Nos.</th>
		                                            <th>SWO Assigned</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                    <?php
		                                        $sql = mysqli_query($conn, "SELECT * FROM tbl_staffs INNER JOIN tbl_sw_table ON tbl_staffs.staffid = tbl_sw_table.staffid2");
		                                        if ($sql->num_rows > 0){
		                                            while($row = mysqli_fetch_assoc($sql)) {
		                                                $table_num = $row['table_num']; $staffid = $row['staffid'];
		                                                $swoname = substr($row['fname'],0,1).''.substr($row['mname'],0,1).''.substr($row['lname'],0,1);
		                                                ?>
		                                                <tr>
		                                                    <td><?php echo $table_num; ?></td>
		                                                    <td><?php echo $swoname; ?></td>
		                                                </tr>
		                                                <?php
		                                            }
		                                        } else {

		                                        }
		                                    ?>
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                </form>
		            </div>
		            <div class="footer bg-darkblue">
		                <div class="row">
		                    <div class="col-xs-12 text-center" style="margin: 5px auto;">
		                        DEVELOPED BY: ROGER L. ONGUE, AA-II (SWAD-SDN2)
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">
		<img src="images/best_cis_2024.png" style="width: 870px;">
	</div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 4000);
            $(".btn-show").click(function(){
                $("#hide").show("fast");
                $("#signup").show("fast");
                $("#show").hide("fast");
            });
            $(".btn-hide").click(function(){
                $("#hide").hide("fast");
                $("#signup").hide("fast");
                $("#show").show("fast");
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>
    
    <!-- Custom Js -->
    <script src="js/admin.js"></script> 
    
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    
    <script src="js/pages/examples/sign-in.js"></script>

</body>
</html>