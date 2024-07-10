<?php 
    session_start();
    include 'config.php';
    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];
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
		                <h3 style="margin-top: -10px; margin-bottom: -10px; color: white;">USER SIGN-IN</h3>
		            </div>
		            <?php
		                if (isset($_POST['signIn'])) {
		                    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
		                    $pword = mysqli_real_escape_string($conn, $_POST['pword']);

		                    $result = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE uname = '$uname' AND pword = '$pword'");
		                        $row = mysqli_fetch_assoc($result);
		                            if (($row['uname'] == $uname) && ($row['pword'] == $pword)){
		                                $_SESSION['loggedin'] = true;
		                                $_SESSION['staffid'] = $row['staffid'];
		                                $_SESSION['lname'] = $row['lname'];
		                                $_SESSION['fname'] = $row['fname'];
		                                $_SESSION['mname'] = $row['mname'];
		                                $_SESSION['bday'] = $row['bday'];
		                                $_SESSION['utype'] = $row['utype'];
		                                $_SESSION['uname'] = $row['uname'];
		                                $_SESSION['pword'] = $row['pword'];
		                                date_default_timezone_set('Asia/Manila');
		                                $date = date('Y-m-d H:i:s');
		                                $activityStatus = "Active";

		                                if ($_SESSION['utype'] == "Verifier") {
		                                    $sql = mysqli_query($conn,"UPDATE tbl_staffs SET activityStatus='$activityStatus', since='$date' WHERE staffid='".$_SESSION['staffid']."' AND uname = '".$_SESSION['uname']."' AND pword = '".$_SESSION['pword']."' ");
		                                        $result = mysqli_query($conn, $sql);
		                                        if ($result) {
		                                            echo "New record updated successfully";
		                                        } else {
		                                            echo "Error: " . $sql . "<br>" . $conn->error;
		                                        }
		                                    echo "Staff Signed in!";
		                                    header("location: home_verifier.php");
		                                }
		                                else if (($_SESSION['utype'] == "Social Worker") && ($row['activityStatus'] != $activityStatus)) {
		                                    $sql = mysqli_query($conn,"UPDATE tbl_staffs SET activityStatus='$activityStatus', since='$date' WHERE staffid='".$_SESSION['staffid']."' AND uname = '".$_SESSION['uname']."' AND pword = '".$_SESSION['pword']."' ");
		                                        $result = mysqli_query($conn, $sql);
		                                        if ($result) {
		                                            echo "New record updated successfully";
		                                        } else {
		                                            echo "Error: " . $sql . "<br>" . $conn->error;
		                                        }
		                                    echo "Staff Signed in!";
		                                    header("location: assignTable_sw.php");
		                                }
		                                else if (($_SESSION['utype'] == "Social Worker") && ($row['activityStatus'] == $activityStatus)) {
		                                    header("location: home_sw.php");
		                                }
		                                else if ( $_SESSION['utype'] == "Billings") {
		                                    $sql = mysqli_query($conn,"UPDATE tbl_staffs SET activityStatus='$activityStatus', since='$date' WHERE staffid='".$_SESSION['staffid']."' AND uname = '".$_SESSION['uname']."' AND pword = '".$_SESSION['pword']."' ");
		                                        $result = mysqli_query($conn, $sql);
		                                        if ($result) {
		                                            echo "New record updated successfully";
		                                        } else {
		                                            echo "Error: " . $sql . "<br>" . $conn->error;
		                                        }
		                                    echo "Staff Signed in!";
		                                    header("location: home_billings.php");
		                                }
		                                else if ( $_SESSION['utype'] == "Administrator") {
		                                    $sql = mysqli_query($conn,"UPDATE tbl_staffs SET activityStatus='$activityStatus', since='$date' WHERE staffid='".$_SESSION['staffid']."' AND uname = '".$_SESSION['uname']."' AND pword = '".$_SESSION['pword']."' ");
		                                        $result = mysqli_query($conn, $sql);
		                                        if ($result) {
		                                            echo "New record updated successfully";
		                                        } else {
		                                            echo "Error: " . $sql . "<br>" . $conn->error;
		                                        }
		                                    echo "Staff Signed in!";
		                                    header("location: home_admin.php");
		                                }
		                            }
		                            else if (($row['uname'] != $uname) || ($row['pword'] != $pword)) {
		                                ?>
		                                <small>
		                                    <div class="alert alert-warning alert-dismissable fade in text-center">
		                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: black;">&times;</a>
		                                        <strong>Account not found!</strong><br>Please check your entry and try again or sign-up now if you're not yet registered.
		                                    </div>
		                                </small>
		                                <?php
		                            }
		                    }
		                ?>
		            <div class="body">
		                <form action="" method="POST">
		                    <div class="input-group">
		                        <span class="input-group-addon">
		                            <span class="glyphicon glyphicon-user"></span>
		                        </span>
		                        <div class="form-line">
		                            <input type="text" class="form-control" name="uname" placeholder="Username" required autofocus>
		                        </div>
		                    </div>
		                    <div class="input-group">
		                        <span class="input-group-addon">
		                            <span class="glyphicon glyphicon-lock"></span>
		                        </span>
		                        <div class="form-line">
		                            <input type="password" class="form-control" name="pword" placeholder="Password" required>
		                        </div>
		                    </div>
		                    <div class="row" style="border-bottom: solid teal 1px;">
		                        <div class="col-xs-4">
		                        </div>
		                        <div class="col-xs-4">
		                            <a style="color: white;"><button class="btn btn-sm btn-block btn-primary waves-effect" name="signIn" type="submit">SIGN-IN <span class="fa fa-sign-in"></span></button></a>
		                        </div>
		                    </div>
		                    <button style="color: white" type="button" id="show" class="btn-show btn-xs bg-darkblue pull-right" data-toggle="tooltip" data-placement="top" title="Sign-up Now">SIGN-UP <span class="glyphicon glyphicon-chevron-down"></span></button>
		                    <button type="button" id="hide" class="btn-hide btn-xs bg-darkblue pull-right" data-toggle="tooltip" data-placement="top" title="Hide" style="display: none;"><span class="glyphicon glyphicon-chevron-up"></span></button>
		                    <br>
		                    
		                    
		                    <div id="signup" style="display: none;">
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <label for="rememberme" style="color: orange;">Not yet registered?</label><br>
		                            <span class="text-center"><small>Sign-up first.</small></span>
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-xs-4">
		                        </div>
		                        <div class="col-xs-4" style="color: white;">
		                            <a href="signUp.php"><button style="color: white" class="btn btn-sm btn-block btn-primary waves-effect"  type="button">SIGN-UP <span class="fa fa-edit"></span></button></a>
		                        </div>
		                    </div>
		                    </div>
		                </form>
		            </div>
		            <div class="footer bg-darkblue">
		                <div class="row">
		                    <div class="col-xs-12 text-center" style="padding: 15px 0px;">
		                        <p>DEVELOPED BY: ROGER L. ONGUE, AA-II (SWAD-SDN2)</p>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		<img src="images/dswd_aics_logo_3.png" style="width: 100%; margin-top: -40px;">
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