<?php
    // Start the session
    session_start();
    $_SESSION['qn'];

    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $roww = mysqli_fetch_assoc($sql);

    $sql_clq = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['qn']."' ");
    $row_clq = mysqli_fetch_assoc($sql_clq);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>DSWD AICS System (SWAD-SDN2)</title>
    <!-- Favicon-->
    <link rel="icon" href="images/DSWD-logo.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

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

    <style>
      .carousel-inner > .item > img,
      .carousel-inner > .item > a > img {
          width: 90%;
          margin: auto;
      }
        .int {
            width: 40px; height: 40px; border-radius: 50%;
            -webkit-transition: width 0.3s, height 0.3s; /* For Safari 3.1 to 6.0 */
            transition: width 0.1s, height 0.1s;
            margin-bottom: 20px;
        }

        .int:hover {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body class="theme-darkblue">
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
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <span class="glyphicon glyphicon-search"></span>
        </div>
        <input type="text" placeholder="Search">
        <div class="close-search"> &times;
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="#" class="bars"></a>
                <a class="navbar-brand" href="home_verifier.php" title="Homepage" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Verifier Level</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
            
                    <!-- Call Search
                    <li><a href="#" class="js-search" data-close="true"><span class="glyphicon glyphicon-search"></span> Search</a></li> -->
                    <!-- #END# Call Search -->
                    <li><a href="#" class="js-right-sidebar" data-close="true">Menu <span class="caret"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <img src="images/DSWD-Logo.png" style="width: 100%; margin-top: -40px;" alt="User" title="Default Photo">
                <?php
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$roww['staffid']."'");
                    $row = mysqli_fetch_assoc($sql); $USER=$row['fname'];
                ?>
                <div class="image">
                    <?php
                        //$sql="SELECT * FROM imageprofpic_table WHERE uploadedBy='".$_SESSION['staffid']."'";
                        //$result = mysqli_query($conn, $sql);
                        //if ($rowcount=mysqli_num_rows($result) > 0) {
                         //   $row = mysqli_fetch_assoc($result);
                        //    $imagename=$row['imagename'];
                         //   $imagedir=$row['imagedir'];
                        //    echo '<img src = "'.$imagedir.'/'.$imagename.'" alt = "'.$imagename.'" title="Profile Photo" class="pull-left" width="80" height="80" /> <br>';  
                       // }
                       // else {
                         //   
                        if ($row['sex']=="M") {
                            ?>
                                <img src="images/user.png"  style="margin-top: -20px;" width="60" height="60" alt="User" title="Default Photo" /><br>
                            <?php
                        } else {
                            ?>
                                <img src="images/user_girl.png"  style="margin-top: -20px;" width="60" height="60" alt="User" title="Default Photo" /><br>
                            <?php
                        }
                        //}
                    ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $row['fname'].' '.substr($row['mname'],0,1).'. '.$row['lname'].' '.$row['nameext']; ?>
                    </div>
                    <div class="email"><?php echo $row['uname']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <span class="glyphicon glyphicon-log-out"><a href="logout.php"></span> Sign Out</a></span>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        <a href="edit_beneV3.php">
                            <span class="fa fa-edit"></span>
                            <span>Edit Bene Details</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright" style="color: darkblue; text-align: center;">
                    &copy;2023 <a href="#" style="color: darkblue;"><?php echo $sys_acronym; ?></a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <!-- <li role="presentation"><a href="#settings" data-toggle="tab">TEAM</a></li> -->
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
    <section class="content">
        <?php
            //bene session
            $_SESSION['bn_lname'] = $_SESSION['bn_fname'] = $_SESSION['bn_mname'] = $_SESSION['bn_nameext'] = $_SESSION['bn_contact_num'] = $_SESSION['bn_cstatus'] = $_SESSION['bn_bday'] = $_SESSION['bn_age'] = $_SESSION['bn_sex'] = $_SESSION['bn_occupation'] = $_SESSION['bn_salary'] = $_SESSION['bn_reltoclient'] = $_SESSION['bn_reltoclient_others'] = $_SESSION['bn_category'] = $_SESSION['bn_subcategory_others'] = $_SESSION['bn_subcategory'] = $_SESSION['bn_subcategory2_others'] = $_SESSION['bn_subcategory2'] = $_SESSION['bn_ipAffiliation'] = "";
            //bene error
            $bn_4PschoiceErr = $bn_4PsnumErr = $bn_lnameErr = $bn_fnameErr = $bn_mnameErr = $bn_nameextErr = $bn_contact_numErr = $bn_cstatusErr = $bn_bdayErr = $bn_sexErr = $bn_occupationErr = $bn_salaryErr = $bn_reltoclientErr = $bn_reltoclient_othersErr = $bn_categoryErr = $bn_subcategoryErr = $bn_subcategory_othersErr = $bn_subcategory2Err = $bn_subcategory2_othersErr = $bn_ipAffiliationErr = $match = $notmatch = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION['bn_4Pschoice'] = mysqli_real_escape_string($conn, test_input($_POST['bn_4Pschoice']));
                $_SESSION['bn_4Psnum'] = mysqli_real_escape_string($conn, test_input($_POST['bn_4Psnum']));
                $_SESSION['bn_lname'] = mysqli_real_escape_string($conn, test_input($_POST['bn_lname']));
                $_SESSION['bn_fname'] = mysqli_real_escape_string($conn, test_input($_POST['bn_fname']));
                $_SESSION['bn_mname'] = mysqli_real_escape_string($conn, test_input($_POST['bn_mname']));
                $_SESSION['bn_nameext'] = mysqli_real_escape_string($conn, test_input($_POST['bn_nameext']));
                $_SESSION['bn_contact_num'] = mysqli_real_escape_string($conn, test_input($_POST['bn_contact_num']));
                $_SESSION['bn_cstatus'] = mysqli_real_escape_string($conn, test_input($_POST['bn_cstatus']));
                $_SESSION['bn_bday'] = mysqli_real_escape_string($conn, test_input($_POST['bn_bday']));
                $_SESSION['bn_age'] = mysqli_real_escape_string($conn, test_input($_POST['bn_age']));
                $_SESSION['bn_sex'] = mysqli_real_escape_string($conn, test_input($_POST['bn_sex']));
                $_SESSION['bn_occupation'] = mysqli_real_escape_string($conn, test_input($_POST['bn_occupation']));
                $_SESSION['bn_salary'] = mysqli_real_escape_string($conn, test_input($_POST['bn_salary']));
                $_SESSION['bn_reltoclient'] = mysqli_real_escape_string($conn, test_input($_POST['bn_reltoclient']));
                $_SESSION['bn_reltoclient_others'] = mysqli_real_escape_string($conn, test_input($_POST['bn_reltoclient_others']));
                $_SESSION['bn_category'] = mysqli_real_escape_string($conn, test_input($_POST['bn_category']));
                $_SESSION['bn_subcategory'] = mysqli_real_escape_string($conn, test_input($_POST['bn_subcategory']));
                $_SESSION['bn_subcategory_others'] = mysqli_real_escape_string($conn, test_input($_POST['bn_subcategory_others']));
                $_SESSION['bn_subcategory2'] = mysqli_real_escape_string($conn, test_input($_POST['bn_subcategory2']));
                $_SESSION['bn_subcategory2_others'] = mysqli_real_escape_string($conn, test_input($_POST['bn_subcategory2_others']));
                $_SESSION['bn_ipAffiliation'] = mysqli_real_escape_string($conn, test_input($_POST['bn_ipAffiliation']));

                header("location: update_bene_details.php");
            }
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
        ?>
        <div class="container-fluid" style="margin-top: -30px;">
            <div class="row clearfix">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right" style="bottom: 1; right: 0;">
                        <div class="card col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tab-content" style="margin-top: 10px; overflow-y: auto; margin: -1px;">
                                        <!-- add client -->
                                        <div class="container-fluid" style="opacity: 0.9;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h2 class="text-center" style="color: darkblue;">GENERAL INTAKE SHEET</h2>
                                                    <i><b>Note:</b> (<span style="color: red;">*</span>) sign denotes a required field!</i><hr>
                                                </div>
                                            </div>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <div class="row">
                                            <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-align: left;">II: BENEFICIARY'S IDENTIFYING INFORMATION</h4>
                                                <div class="col-sm-4 text-center">
                                                    <div class="panel-group">
                                                        <div class="panel panel-primary-dswd">
                                                            <div class="panel-heading panel-title"> 
                                                                <h4 style="margin: auto; padding: 10px 0; color: white;">4Ps Beneficiary?</h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <!-- Client 4Ps YES/NO -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_4Pschoice" name="bn_4Pschoice">
                                                                                    <option><?php echo $row_clq['bn_4Pschoice']; ?></option>
                                                                                    <option>No</option>
                                                                                    <option>Yes</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_4PschoiceErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- 4Ps# -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 100%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label style="float: left;">4Ps Number:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" name="bn_4Psnum" value="<?php echo $row_clq['bn_4Psnum']; ?>" placeholder="If YES, kindly enter DSWD 4Ps ID No. here...">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_4PsnumErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--<div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="panel-group">
                                                        <div class="panel panel-primary-dswd">
                                                            <div class="panel-heading panel-title"> 
                                                                <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Complete Name</h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <!-- Bene Last Name -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>Last Name:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" name="bn_lname" value="<?php echo $row_clq['bn_lname']; ?>" placeholder="Last Name" required autofocus>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_lnameErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Bene First Name -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>First Name:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" name="bn_fname" value="<?php echo $row_clq['bn_fname']; ?>" placeholder="First Name" required autofocus>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_fnameErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Bene Middle Name -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 100%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>Middle Name:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" name="bn_mname" value="<?php echo $row_clq['bn_mname']; ?>" placeholder="Middle Name">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_mnameErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div> -->
                                                                </div>
                                                                <!-- Bene Name Ext. -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 100%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Name Extension:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_nameext" name="bn_nameext">
                                                                                    <option><?php echo $row_clq['bn_nameext']; ?></option>
                                                                                    <option>N/A</option>
                                                                                    <option>JR.</option>
                                                                                    <option>SR.</option>
                                                                                    <option>I</option>
                                                                                    <option>II</option>
                                                                                    <option>III</option>
                                                                                    <option>IV</option>
                                                                                    <option>V</option>
                                                                                    <option>VI</option>
                                                                                    <option>VII</option>
                                                                                    <option>VIII</option>
                                                                                    <option>IX</option>
                                                                                    <option>X</option>
                                                                                    <option>XI</option>
                                                                                    <option>XII</option>
                                                                                    <option>XIII</option>
                                                                                    <option>XIV</option>
                                                                                    <option>XV</option>
                                                                                    <option>XVI</option>
                                                                                    <option>XVII</option>
                                                                                    <option>XVIII</option>
                                                                                    <option>XIX</option>
                                                                                    <option>XX</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_nameextErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="panel-group">
                                                        <div class="panel panel-primary-dswd">
                                                            <div class="panel-heading panel-title"> 
                                                                <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Other Information</h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <!--Contact Information-->
                                                                <div class="row clearfix">
                                                                    <div style="width: 100%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>Contact Number:</label>
                                                                            <div class="form-line">
                                                                                <input type="number" class="form-control" maxlength="11" name="bn_contact_num" value="<?php echo $row_clq['bn_contact_num']; ?>" placeholder="Contact Number">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_contact_numErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>-->
                                                                </div>
                                                                <!-- Client Civil Status -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Civil Status:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_cstatus" name="bn_cstatus">
                                                                                    <option><?php echo $row_clq['bn_cstatus']; ?></option>
                                                                                    <option>Single</option>
                                                                                    <option>Married</option>
                                                                                    <option>Common-Law</option>
                                                                                    <option>Widowed</option>
                                                                                    <option>Separated</option>
                                                                                    <option>Divorced</option>
                                                                                    <option>Annulled</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_cstatusErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <! -- Sex -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Sex:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_sex" name="bn_sex">
                                                                                    <option><?php echo $row_clq['bn_sex']; ?></option>
                                                                                    <option value="M">Male</option>
                                                                                    <option value="F">Female</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_sexErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <! -- Occupation -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>Occupation:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" name="bn_occupation" value="<?php echo $row_clq['bn_occupation']; ?>" placeholder="Occupation" required autofocus>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_occupationErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Monthly Salary -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>Monthly Salary:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" name="bn_salary">
                                                                                    <option><?php echo $row_clq['bn_salary']; ?></option>
                                                                                    <option>N/A</option>
                                                                                    <option>P5,000 and below</option>
                                                                                    <option>P5,001 - P10,000</option>
                                                                                    <option>P10,001 - P15,000</option>
                                                                                    <option>P15,001 - P20,000</option>
                                                                                    <option>P20,001 - P25,000</option>
                                                                                    <option>P25,001 - P30,000</option>
                                                                                    <option>P30,001 - P35,000</option>
                                                                                    <option>P35,001 - P40,000</option>
                                                                                    <option>P40,001 - P45,000</option>
                                                                                    <option>P45,001 - P50,000</option>
                                                                                    <option>P50,001 - P60,000</option>
                                                                                    <option>P60,001 - P70,000</option>
                                                                                    <option>P70,001 - P80,000</option>
                                                                                    <option>P80,001 - P90,000</option>
                                                                                    <option>P90,001 - P100,000</option>
                                                                                    <option>P100,001 and above</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_salaryErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Date of Birth -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Date of Birth:</label>
                                                                            <div class="form-line">
                                                                                <input type="date" class="form-control" id="bn_bday" name="bn_bday" value="<?php echo $row_clq['bn_bday']; ?>" placeholder="Date of Birth" required autofocus>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_bdayErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--Age -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Age:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="bn_age" name="bn_age" value="<?php echo $row_clq['bn_age']; ?>" placeholder="Click here to show Age" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <! -- Bene Category -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Beneficiary Category:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_category" name="bn_category">
                                                                                    <option><?php echo $row_clq['bn_category']; ?></option>
                                                                                		<option value="CHILD">(CHILD) Child (0-17 y/o)</option>
                                                                                        <option value="FHONA">(FHONA) Family Head & Other Needy Adult (18-59 y/o)</option>
                                                                                        <option value="WEDC">(WEDC) Women/Men in Especially Difficult Circumstances</option>
                                                                                        <option value="CNSP">(CNSP) Child in Need of Special Protection (0-17 y/o)</option>
                                                                                        <option value="YNSP">(YNSP) Youth in Need of Special Protection (18-30 y/o)</option>
                                                                                        <option value="PWD">(PWD) Person With Disability</option>
                                                                                        <option value="SC">(SC) Senior Citizen (60 y/o & above)</option>
                                                                                        <option value="PLHIV">(PLHIV) Persons Living w/ HIV-AIDS</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_categoryErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Bene Sub-Category -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Beneficiary Sub-Category:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_subcategory" name="bn_subcategory">
                                                                                    <option><?php echo $row_clq['bn_subcategory']; ?></option>
                                                                                    <option>N/A</option>
                                                                                    <option>Solo Parents</option>
                                                                                    <option>Indigenous People</option>
                                                                                    <option>Recovering Person who used drugs</option>
                                                                                    <option>4Ps DSWD Beneficiary</option>
                                                                                    <option>Street Dwellers</option>
                                                                                    <option>Psychosocial/Mental/Learning Disability</option>
                                                                                    <option>Stateless Person/Asylum Seekers/Refugees</option>
                                                                                    <option>Others</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_subcategoryErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Bene Sub-Category: Others -->
                                                                <div class="row clearfix" id="div_bn_subcategory_others">
                                                                    <div style="width: 5%; display: inline-block;"></div>
                                                                    <div style="width: 86%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input class="form-control" name="bn_subcategory_others" id="bn_subcategory_others" type="text" placeholder="If Others: Please Specify Sub-Category Here">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_subcategory_othersErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Other Bene Sub-Category -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Other Beneficiary Sub-Category:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_subcategory2" name="bn_subcategory2">
                                                                                    <option><?php echo $row_clq['bn_subcategory2']; ?></option>
                                                                                    <option>N/A</option>
                                                                                    <option>Solo Parents</option>
                                                                                    <option>Indigenous People</option>
                                                                                    <option>Recovering Person who used drugs</option>
                                                                                    <option>4Ps DSWD Beneficiary</option>
                                                                                    <option>Street Dwellers</option>
                                                                                    <option>Psychosocial/Mental/Learning Disability</option>
                                                                                    <option>Stateless Person/Asylum Seekers/Refugees</option>
                                                                                    <option>Others</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_subcategory2Err; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Other Bene Sub-Category: Others -->
                                                                <div class="row clearfix" id="div_bn_subcategory2_others">
                                                                    <div style="width: 5%; display: inline-block;"></div>
                                                                    <div style="width: 86%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input class="form-control" name="bn_subcategory2_others" id="bn_subcategory2_others" type="text" placeholder="If Others: Please Specify Other Sub-Category Here">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_subcategory2_othersErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <! -- Bene IP Affiliation -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 100%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <label>IP Affiliation:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="bn_ipAffiliation" name="bn_ipAffiliation" value="<?php echo $row_clq['bn_ipAffiliation']; ?>" placeholder="IP Affiliation">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_ipAffiliationErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>-->
                                                                </div>
                                                                <! -- Relationship to Client -->
                                                                <div class="row clearfix">
                                                                    <div style="width: 93%; display: inline-block;">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Relationship to Client:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="bn_reltoclient" name="bn_reltoclient">
                                                                                    <!-- Direct Family -->
                                                                                    <option><?php echo $row_clq['bn_reltoclient']; ?></option>
                                                                                    <option>Husband</option>
                                                                                    <option>Wife</option>
                                                                                    <option>Father</option>
                                                                                    <option>Mother</option>
                                                                                    <option>Son</option>
                                                                                    <option>Daughter</option>
                                                                                    <option>Brother</option>
                                                                                    <option>Sister</option>
                                                                                    <option>Uncle</option>
                                                                                    <option>Aunt</option>
                                                                                    <option>Nephew</option>
                                                                                    <option>Niece</option>
                                                                                    <option>Grandfather</option>
                                                                                    <option>Grandmother</option>
                                                                                    <option>Grandson</option>
                                                                                    <option>Granddaughter</option>
                                                                                    <option>1st Cousin</option>
                                                                                    <option>2nd Cousin</option>
                                                                                    <option>3rd Cousin</option>
                                                                                    <!-- In-Laws -->
                                                                                    <option>Father-in-Law</option>
                                                                                    <option>Mother-in-Law</option>
                                                                                    <option>Son-in-Law</option>
                                                                                    <option>Daughter-in-Law</option>
                                                                                    <option>Brother-in-Law</option>
                                                                                    <option>Sister-in-Law</option>
                                                                                    <option>Uncle-in-Law</option>
                                                                                    <option>Aunt-in-Law</option>
                                                                                    <option>Nephew-in-Law</option>
                                                                                    <option>Niece-in-Law</option>
                                                                                    <option>Grandfather-in-Law</option>
                                                                                    <option>Grandmother-in-Law</option>
                                                                                    <option>Grandson-in-Law</option>
                                                                                    <option>Granddaughter-in-Law</option>
                                                                                    <option>1st Cousin-in-Law</option>
                                                                                    <option>2nd Cousin-in-Law</option>
                                                                                    <option>3rd Cousin-in-Law</option>
                                                                                    <!-- Common-Laws -->
                                                                                    <option>Common-Law Husband</option>
                                                                                    <option>Common-Law Wife</option>
                                                                                    <option>Common-Law Father</option>
                                                                                    <option>Common-Law Mother</option>
                                                                                    <option>Common-Law Brother</option>
                                                                                    <option>Common-Law Sister</option>
                                                                                    <option>Common-Law Uncle</option>
                                                                                    <option>Common-Law Aunt</option>
                                                                                    <option>Common-Law Nephew</option>
                                                                                    <option>Common-Law Niece</option>
                                                                                    <option>Common-Law Grandfather</option>
                                                                                    <option>Common-Law Grandmother</option>
                                                                                    <option>Common-Law Grandson</option>
                                                                                    <option>Common-Law Granddaughter</option>
                                                                                    <option>Common-Law 1st Cousin</option>
                                                                                    <option>Common-Law 2nd Cousin</option>
                                                                                    <option>Common-Law 3rd Cousin</option>
                                                                                    <!-- Steps -->
                                                                                    <option>Step Father</option>
                                                                                    <option>Step Mother</option>
                                                                                    <option>Step Son</option>
                                                                                    <option>Step Daughter</option>
                                                                                    <option>Step Brother</option>
                                                                                    <option>Step Sister</option>
                                                                                    <option>Step Uncle</option>
                                                                                    <option>Step Aunt</option>
                                                                                    <option>Step Nephew</option>
                                                                                    <option>Step Niece</option>
                                                                                    <option>Step Grandfather</option>
                                                                                    <option>Step Grandmother</option>
                                                                                    <option>Step Grandson</option>
                                                                                    <option>Step Granddaughter</option>
                                                                                    <!-- Others -->
                                                                                    <option>Neighbor</option>
                                                                                    <option>Friend</option>
                                                                                    <option>Others</option>
                                                                                </select>
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_reltoclientErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Relationship to Client: Others -->
                                                                <div class="row clearfix"  id="div_bn_reltoclient_others">
                                                                    <div style="width: 5%; display: inline-block;"></div>
                                                                    <div style="width: 86%; display: inline-block;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input class="form-control" name="bn_reltoclient_others" id="bn_reltoclient_others" type="text" placeholder="If Others: Please Specify Relationship Here">
                                                                                <span class="error" style="font-style: italic; color: red;"><?php echo $bn_reltoclient_othersErr; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width: 5%; display: inline-block;">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="">
                                                        <ul class="pager" style="margin: auto auto 10px;">
                                                            <li class=""><a href="viewGIS.php"><button class="btn btn-block waves-effect" type="button"><span class="fa fa-arrow-left"> Back to GIS</button></a></li>
                                                            <li class=""><a a href="update_bene_details.php" style="color: white;"><button class="btn btn-primary btn-block waves-effect" type="submit">Save Changes <span class="fa fa-save"></button></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
        
    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#div_bn_subcategory_others").hide();
            $("#bn_subcategory").click(function() {
                if ($("#bn_subcategory").val() == 'Others') {
                    $("#div_bn_subcategory_others").show();
                } else {
                    $("#div_bn_subcategory_others").hide();
                }
            });
            $("#div_bn_subcategory2_others").hide();
            $("#bn_subcategory2").click(function() {
                if ($("#bn_subcategory2").val() == 'Others') {
                    $("#div_bn_subcategory2_others").show();
                } else {
                    $("#div_bn_subcategory2_others").hide();
                }
            });
            $("#div_bn_reltoclient_others").hide();
            $("#bn_reltoclient").click(function() {
                if ($("#bn_reltoclient").val() == 'Others') {
                    $("#div_bn_reltoclient_others").show();
                } else {
                    $("#div_bn_reltoclient_others").hide();
                }
            });

            $("#bn_4Pschoice").click(function() {
                var val = "";
                if ($("#bn_4Pschoice").val() == 'Yes') {
                    val = "4Ps DSWD Beneficiary";
                    $("#bn_subcategory").val(val);
                } else {
                    val = "N/A";
                    $("#bn_subcategory").val(val);
                }
            });

            $("#bn_age").click(function() {

                var d = new Date();
                console.log("new date: "+d);
                var year_now = d.getFullYear();
                var month_now = d.getMonth()+1;
                var date_now = d.getDate();
                console.log("date now: "+date_now);
                    //month_now
                    if (month_now < 10) {
                        month_now = "0"+month_now;
                        console.log("month_now: "+month_now);
                    } else if (month_now >= 10) {
                        month_now = month_now;
                        console.log("month_now: "+month_now);
                    }
                    //date_now
                    if (date_now < 10) {
                        date_now = "0"+date_now;
                        console.log("date_now: "+date_now);
                    } else if (date_now >= 10) {
                        date_now = date_now;
                        console.log("date_now: "+date_now);
                    }
                    var d2 = year_now+"."+month_now+date_now;

                var b = new Date($("#bn_bday").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                    console.log("Age: "+age);
                 var cat = "";
                    $("#bn_age").val(age);
                    if (age >= 60) {
                        cat = "SC";
                        $("#bn_category").val(cat);
                    } else if (age < 18) {
                        cat = "CHILD";
                        $("#bn_category").val(cat);
                    } else {
                        cat = "FHONA";
                        $("#bn_category").val(cat);
                    }             
            });
        });
    </script>
</body>
</html>