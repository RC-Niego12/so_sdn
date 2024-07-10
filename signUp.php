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

<body>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
        <div class="login-page" style="margin-top: 0px !important;">
            <div class="text-center" style="color: white; text-shadow: 4px 3px black;">
                <img class="login-DSWD-logo" src="images/DSWD-logo.png">
                <h1><b><?php echo $sys_acronym; ?></b></h1>
                <h3 style="letter-spacing: -1px;"><?php echo $sysname; ?></h3>
            </div>
            <?php
            
                $_SESSION['staffid'] = $_SESSION['fname'] = $_SESSION['mname'] = $_SESSION['lname'] = $_SESSION['nameext'] = $_SESSION['sex'] = $_SESSION['bday'] = $_SESSION['utype'] = $_SESSION['lic_no'] = $_SESSION['uname'] = $_SESSION['pword'] = "";
                $staffidErr = $fnameErr = $mnameErr = $lnameErr = $nameextErr = $sexErr = $bdayErr = $utypeErr = $unameErr = $pwordErr = $match = $notmatch = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $_SESSION['staffid'] = mysqli_real_escape_string($conn, test_input($_POST['staffid']));
                    $_SESSION['fname'] = mysqli_real_escape_string($conn, test_input($_POST['fname']));
                    $_SESSION['mname'] = mysqli_real_escape_string($conn, test_input($_POST['mname']));
                    $_SESSION['lname'] = mysqli_real_escape_string($conn, test_input($_POST['lname']));
                    $_SESSION['nameext'] = mysqli_real_escape_string($conn, test_input($_POST['nameext']));
                    $_SESSION['sex'] = mysqli_real_escape_string($conn, test_input($_POST['sex']));
                    $_SESSION['bday'] = mysqli_real_escape_string($conn, test_input($_POST['bday']));
                    $_SESSION['utype'] = mysqli_real_escape_string($conn, test_input($_POST['utype']));
                    $_SESSION['lic_no'] = mysqli_real_escape_string($conn, test_input($_POST['lic_no']));
                    $_SESSION['uname'] = mysqli_real_escape_string($conn, test_input($_POST['uname']));
                    $_SESSION['pword'] = mysqli_real_escape_string($conn, test_input($_POST['pword']));
                    $sql = "SELECT staffid FROM tbl_staffs WHERE staffid = '".$_SESSION['staffid']."'";
                    $result = mysqli_query($conn, $sql);
                    if ($rowcount=mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $staffid=$row['staffid'];
                        if (($staffid==$_SESSION['staffid'])) {
                            $match = "A record matches your entry and we found out that you are already registered! Please click 'Cancel' and sign-in directly.";
                        } else {
                            
                        }
                    } else {
                        header("location: insert_newStaff.php");
                    }
                }
                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }
            ?>
            <h2 class="text-center" style="color: darkblue;">REGISTRATION FORM</h2>
            <div class="panel-group">
                <div class="panel panel-primary-dswd">
                    <div class="panel-heading panel-title"> 
                        <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Personal Data <span class="fa fa-file-text-o"></span></h4>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="panel-body">
                        <i><b>Note:</b> (<span style="color: red;">*</span>) sign denotes a required field!</i><br><hr>
                            <!-- Staff/Employee ID -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="staffid" placeholder="Staff/Employee ID" required autofocus> <span class="error" style="font-style: italic; color: red;"><?php echo $staffidErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <!-- first name -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="fname" placeholder="First Name" required autofocus> <span class="error" style="font-style: italic; color: red;"><?php echo $fnameErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <!-- middle name -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mname" placeholder="Middle Name"> <span class="error" style="font-style: italic; color: red;"><?php echo $mnameErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;"></span>
                                </div>
                            </div>
                            <!-- last name -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required autofocus> <span class="error" style="font-style: italic; color: red;"><?php echo $lnameErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <!-- name extension -->
                            <div class="row clearfix">
                                <div class="col-xs-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nameext" placeholder="Name Extension"> <span class="error" style="font-style: italic; color: red;"><?php echo $nameextErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sex -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <label>Sex (M/F):</label>
                                        <div class="form-line">
                                            <select class="form-control" id="sex" name="sex">
                                                <option>M</option>
                                                <option>F</option>
                                            </select>
                                            <span class="error" style="font-style: italic; color: red;"><?php echo $sexErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <!-- birthday -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <label>Date of Birth:</label>
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="bday" placeholder="Birthday" required autofocus> <span class="error" style="font-style: italic; color: red;"><?php echo $bdayErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <!-- usertype -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <label>Assigned User Type:</label>
                                        <div class="form-line">
                                            <select class="form-control" id="utype" name="utype">
                                                <option>Verifier</option>
                                                <option>Social Worker</option>
                                                <option>Billings</option>
                                                <option>Administrator</option>
                                            </select>
                                            <span class="error" style="font-style: italic; color: red;"><?php echo $utypeErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-xs-12">
                                    <div class="form-group form-float" style="text-align: left;">
                                        <div class="form-line">
                                        <label>License No. (for Social Workers only):</label>
                                            <input type="number" class="form-control" name="lic_no" placeholder="ex. 00xxxxx">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- username -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="uname" placeholder="Desired Username" required autofocus> <span class="error" style="font-style: italic; color: red;"><?php echo $unameErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <!-- password -->
                            <div class="row clearfix">
                                <div class="col-xs-11">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="pword" placeholder="Desired Password" required autofocus> <span class="error" style="font-style: italic; color: red;"><?php echo $pwordErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <span style="color: red; font-size: 2em;">*</span>
                                </div>
                            </div>
                            <span class="error text-center" style="font-style: italic; color: red;"><?php echo $notmatch; ?></span> <span class="error text-center" style="font-style: italic; color: green;"><?php echo $match; ?>
                            </span>
                        </div>
                        </div>
                       <div class="panel-footer">
                            <ul class="pager">
                                <li class="previous"><a href="index.php" style="color: white;"><button class="btn btn-sm btn-block btn-danger waves-effect" type="button">Cancel <span class="fa fa-times"></span></button></a></li>
                                <li class="next"><a style="color: white;"><button class="btn btn-block btn-sm btn-block btn-primary waves-effect" type="submit">Submit <span class="fa fa-paper-plane"></span></button></a></li>
                            </ul>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">
        <img src="images/best_cis_2024.png" style="width: 870px;">
        <img src="images/dswd_aics_logo_3.png" style="width: 65%; margin-top: -40px;">
    </div>


    <!-- Jquery Core Js -->

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>
</html>