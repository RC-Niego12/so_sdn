<?php
    // Start the session
    session_start();

    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];
    $cis_office = $row_sysname['cis_office'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $row = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Track Billings</title>
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

    <!--dataTables CSS-->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/jquery.dataTables.css" rel="stylesheet">   
    <link href="plugins/jquery-datatable/skin/bootstrap/css/jquery.dataTables.min.css" rel="stylesheet">     

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
    
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body class="theme-darkblue">
    <!-- Page Loader
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
    </div> -->
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
                <a class="navbar-brand" href="#" title="Track Billings - Billings Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Billings Level</a>
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
                <?php
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
                    $row = mysqli_fetch_assoc($sql); $USER=$row['fname'];
                ?>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row['fname'].' '.substr($row['mname'],0,1).'. '.$row['lname'].' '.$row['nameext']; ?></div>
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
                    <li>
                        <a href="home_billings.php">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="track_GLs.php">
                            <span class="fa fa-file"></span>
                            <span>Track GLs (Step 1)</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="track_billings.php">
                            <span class="fa fa-list"></span>
                            <span>Track Billings</span>
                        </a>
                    </li>
                    <li>
                        <a href="track_obsdv.php">
                            <span class="glyphicon glyphicon-book"></span>
                            <span>Track OBs & DV</span>
                        </a>
                    </li>
                    <li>
                        <a href="transmittal_obsdv.php">
                            <span class="fa fa-arrow-circle-o-right"></span>
                            <span>Transmittal</span>
                        </a>
                    </li>
                    <li>
                        <a href="editprofile.php">
                            <span class="glyphicon glyphicon-edit"></span>
                            <span>Edit Profile</span>
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
    <div class="container-fluid" style="margin-top: -30px;">
    <div class="row clearfix">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right" style="bottom: 1; right: 0;">
                <div class="card col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="nav nav-tabs" style="font-size: 15px;">
                                <li class="active">
                                    <a href="#track_billings" data-toggle="tab">
                                        <span class="fa fa-list" style="color: #337ab7;"></span> Track Billings
                                    </a>
                                </li>
                                <li>
                                    <a href="#tracked_billings" data-toggle="tab">
                                        <span class="fa fa-file" style="color: lightgreen;"></span> Tracked Billings (w/ OBs & DV)
                                    </a>
                                </li>
                                <li>
                                    <a href="#for_obsdv_billings" data-toggle="tab">
                                        <span class="fa fa-file"></span> Billings still for OBs & DV
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- START Track Billings -->
                                <div id="track_billings" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <?php
                                            if (isset($_POST['submit'])) {
                                                if (!empty($_POST['checkbox'])) {
                                                    //checked checkboxes
                                                    $checkbox = $_POST['checkbox'];
                                                    foreach($checkbox as $chk1_checkbox) {  
                                                        $chk_checkbox .= $chk1_checkbox.',';
                                                   }
                                                    $_SESSION['checkbox'] = $chk_checkbox;
                                                    //$_SESSION['obs_dv_code'] = mysqli_real_escape_string($conn, $_POST['obs_dv_code']);
                                                    $_SESSION['obs_dv_date'] = mysqli_real_escape_string($conn, $_POST['obs_dv_date']);
                                                    $_SESSION['prep_by'] = mysqli_real_escape_string($conn, $_POST['prep_by']);
                                                    header("Location: insert_obs_dv.php");
                                                } else {    
                                                    echo '<script>alert("ERROR! You have not checked a box. Please try again.")</script>';
                                                }
                                            }

                                            if (isset($_POST['btn-addtoexisting'])) {
                                                if (!empty($_POST['checkbox'])) {
                                                    //checked checkboxes
                                                    $checkbox = $_POST['checkbox'];
                                                    foreach($checkbox as $chk1_checkbox) {  
                                                        $chk_checkbox .= $chk1_checkbox.',';
                                                   }
                                                    $_SESSION['checkbox'] = $chk_checkbox;
                                                    $_SESSION['mdl_obdv_code'] = mysqli_real_escape_string($conn, $_POST['mdl_obdv_code']);
                                                    header("Location: add_glbill_toexisting_obdv.php");
                                                } else {    
                                                    echo '<script>alert("ERROR! You have not checked a box. Please try again.")</script>';
                                                }
                                            }
                                        ?>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <div style="text-align: left; padding: 10px; background-color: silver; border-radius: 20px;">
                                                <label>
                                                    <span style="color: red;">NOTE #1:</span> If you are to track a GL-Bill with new OBDV, please enter first the data needed in "Date Prepared" and "Prepared by" then proceed to selecting row/s below before clicking "Submit as New OBDV" button.
                                                </label>
                                                <label>
                                                    <span style="color: red;">NOTE #2:</span> If you are only to add a GL-Bill on an existing OBDV, just skip entering "Date Prepared" and "Prepared by" then proceed to selecting row/s below before clicking "Add to Existing OBDV" button.
                                                </label>
                                                <div class="row clearfix">
                                                        <!-- SET OBDV CODE START
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                            <div class="form-group form-float" style="text-align: left;">
                                                                <div class="form-line">
                                                                    <label>OBs & DV Code (<span style="color: red;">Note: This code is Automated. Write this code on the OBs</span>): <span style="color: red; font-size: 14px;">*</span></label>
                                                                    <?php
                                                                        /**
                                                                        $dnow = date_format(new DateTime($datenow), "d-m-Y");
                                                                        $ynow = date_format(new DateTime($datenow), "Y");
                                                                        $mnow = date_format(new DateTime($datenow), "m");
                                                                        //$datenow = 02-12-2023;
                                                                        $sql_obdv_code = mysqli_query($conn,"SELECT * FROM tbl_obs_dv WHERE YEAR(obs_dv_date)='$ynow' AND MONTH(obs_dv_date)=$mnow;");
                                                                        if ($sql_obdv_code->num_rows > 0){
                                                                            $obdv_count = $sql_obdv_code->num_rows;
                                                                            $obdv_count2 = $obdv_count+1;
                                                                            if (strlen($obdv_count2)==1) {
                                                                                $obdv_count2 = "000".$obdv_count2;
                                                                            } else if (strlen($obdv_count2)==2) {
                                                                                $obdv_count2 = "00".$obdv_count2;
                                                                            } else if (strlen($obdv_count2)==3) {
                                                                                $obdv_count2 = "0".$obdv_count2;
                                                                            } else {$obdv_count2;}
                                                                            $obdv_mo = date_format(new DateTime($datenow), "m");
                                                                            $obdv_y = date_format(new DateTime($datenow), "Y");
                                                                            $obdv_code = $cis_office."-OBDV-".$obdv_y."-".$obdv_mo."-".$obdv_count2;
                                                                        } else {
                                                                            $obdv_count = 0;
                                                                            $obdv_count2 = $obdv_count+1;
                                                                            if (strlen($obdv_count2)==1) {
                                                                                $obdv_count2 = "000".$obdv_count2;
                                                                            } else if (strlen($obdv_count2)==2) {
                                                                                $obdv_count2 = "00".$obdv_count2;
                                                                            } else if (strlen($obdv_count2)==3) {
                                                                                $obdv_count2 = "0".$obdv_count2;
                                                                            } else {$obdv_count2;}
                                                                            $obdv_mo = date_format(new DateTime($datenow), "m");
                                                                            $obdv_y = date_format(new DateTime($datenow), "Y");
                                                                            $obdv_code = $cis_office."-OBDV-".$obdv_y."-".$obdv_mo."-".$obdv_count2;
                                                                        }
                                                                        **/
                                                                    ?>
                                                                    <input type="text" class="form-control" id="obs_dv_code" name="obs_dv_code" value="<?php echo $obdv_code;?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        SET OBDV CODE END -->
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                            <div class="form-group form-float" style="text-align: left;">
                                                                <div class="form-line">
                                                                    <label>Date Prepared: <span style="color: red; font-size: 14px;">*</span></label>
                                                                    <input class="form-control" id="obs_dv_date" type="date" name="obs_dv_date" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                            <div class="form-group form-float" style="text-align: left;">
                                                                <div class="form-line">
                                                                    <label>Prepared by: <span style="color: red; font-size: 14px;">*</span></label>
                                                                    <input class="form-control" id="prep_by" type="text" name="prep_by" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                        </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                        <ul class="pager" style="margin: 10px -20px;">
                                                            <li class="">
                                                                <a>
                                                                    <button type="submit" name="submit" id="submit-new" class="btn btn-primary waves-effect" style="display: block; margin: auto;">Submit as New OBDV <span class="fa fa-paper-plane"></span></button>
                                                                </a>
                                                            </li>
                                                            <li class="">
                                                                <a>
                                                                    <button type="button" id="btn-addtoexisting" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#modal-addtoexisting" style="display: block; margin: auto;">Add to Existing OBDV <span class="fa fa-plus"></span></button>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                    </div>
                                                    <!-- START MODAL_Add to Existing OBDV -->
                                                    <div class="modal fade" id="modal-addtoexisting" role="dialog">
                                                        <div class="modal-dialog modal-md text-center">
                                                          <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #ff9600; color: white;">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Add Selected GL/s to an Existing GL-Bill</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-sm-12">
                                                                    <div class="panel-body">
                                                                        <h5 style="color: red;">Are you sure in adding selected Bill/s to an existing OBDV?</h5>
                                                                        <p>If yes, kindly enter first the OBDV Code below then click "Yes" button so that the selected Bill/s will be added to that existing OBDV and not as a separate OBDV.</p>
                                                                        <div class="row clearfix" style="text-align: left !important;">
                                                                            <div style="width: 98%; display: inline-block;">
                                                                                <div class="form-group form-float">
                                                                                    <label style="float: left; display: block; width: 100%;">Enter OBDV Code:</label><br>
                                                                                    <div class="form-line">
                                                                                        <input type="text" name="mdl_obdv_code" id="mdl_obdv_code" class="form-control" placeholder="Enter OBDV Code here..." required autofocus>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                <div style="width: 1%; display: inline-block;">
                                                                                <span style="color: red; font-size: 2em;">*</span>
                                                                            </div>
                                                                        </div>
                                                                        <p>If no, click "Cancel" button.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <ul class="pager" style="margin: auto;">
                                                                    <li>
                                                                        <a style="float: left;">
                                                                            <button class="btn btn-sm btn-warning btn-block waves-effect" type="button" data-dismiss="modal"> Cancel <i class="fa fa-remove"></i></button>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a style="float: right;">
                                                                            <button class="btn btn-sm btn-primary btn-block waves-effect" id="btn-addtoexisting" name="btn-addtoexisting" type="submit"> Yes <i class="fa fa-check"></i></button>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- END MODAL_Add to Existing OBDV -->
                                                </div>
                                            </div><hr>
                                            <label>
                                                <span style="color: red;">NOTE #3:</span> Rows with <span class="fa fa-check-square" style="color: green;"></span> and green font-color are "ALREADY VOUCHED & TRACKED", therefore those rows can't be selected for tracking anymore. Please be guided.
                                            </label>
                                            <table class="table table-bordered table-striped table-hover track_bills dataTable text-left">
                                                <thead>
                                                    <tr>
                                                        <th colspan="13" style="text-align: left; padding-top: 0px !important; padding-bottom: 0px !important;">
                                                            <label><input type="checkbox" id="slct_all_chkbox" class="slct_all_chkbox"> Select/Deselect All</label>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th>No.</th>
                                                        <th>Billing Code</th>
                                                        <th>Billing Date</th>
                                                        <th>Service Provider</th>
                                                        <th>Amount</th>
                                                        <th>No. of GLs</th>
                                                        <th>Date Received</th>
                                                        <th>Received By</th>
                                                        <th>Tracked By</th>
                                                        <th>Period Covered</th>
                                                        <th>Date Tracked</th>
                                                        <th>OBs & DV Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql_track_gls = mysqli_query($conn, "SELECT * FROM tbl_track_gl");
                                                        $i=0; $bill_ttl=0;
                                                        if ($sql_track_gls->num_rows > 0){
                                                            while($row_track_gls = mysqli_fetch_assoc($sql_track_gls)) {
                                                                $billing_code = $row_track_gls['billing_code'];
                                                                $billing_date = date_format(new DateTime($row_track_gls['billing_date']), "M. d, Y");
                                                                $sp_id = $row_track_gls['sp_id'];
                                                                $date_received = date_format(new DateTime($row_track_gls['date_received']), "M. d, Y");
                                                                $received_by = $row_track_gls['received_by'];
                                                                $tracked_by = $row_track_gls['tracked_by'];
                                                                $period_from = date_format(new DateTime($row_track_gls['period_from']), "M. d, Y");
                                                                $period_to = date_format(new DateTime($row_track_gls['period_to']), "M. d, Y");
                                                                $date_tracked = date_format(new DateTime($row_track_gls['date_tracked']), "M. d, Y");

                                                                $sql_vchd_bill = mysqli_query($conn, "SELECT * FROM tbl_vouched_bills WHERE billing_code2='$billing_code' ");
                                                                $row_vchd_bill = mysqli_fetch_assoc($sql_vchd_bill);                                                                       
                                                                $obdv_code = $row_vchd_bill['obs_dv_code2']; $bl_code = $row_vchd_bill['billing_code2'];
                                                                if ($bl_code == $billing_code) {
                                                                    ?>
                                                                    <tr style="color: green;">
                                                                        <td><span class="fa fa-check-square" style="color: green;"></span></td>
                                                                        <td><?php echo $i+1; $i++; ?></td>
                                                                        <td><?php echo $billing_code; ?></td>
                                                                        <td><?php echo $billing_date; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_tck_sp = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga WHERE id='$sp_id' ");
                                                                                $row_tck_sp = mysqli_fetch_assoc($sql_tck_sp);
                                                                                echo $row_tck_sp['sp_name'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_bl_ttl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$billing_code' ");
                                                                                    if ($sql_bl_ttl->num_rows > 0) {
                                                                                        $bill_ttl = 0;
                                                                                        while($row_bl_ttl = mysqli_fetch_assoc($sql_bl_ttl)) {
                                                                                            $bill_ttl = $bill_ttl + $row_bl_ttl['amount_in_figures'];
                                                                                        }
                                                                                    } else {
                                                                                        $bill_ttl = 0;
                                                                                    }
                                                                                echo number_format($bill_ttl,2);
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $sql_bl_ttl->num_rows; ?></td>
                                                                        <td><?php echo $date_received; ?></td>
                                                                        <td><?php echo $received_by; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_tck_by = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$tracked_by' ");
                                                                                $row_tck_by = mysqli_fetch_assoc($sql_tck_by);
                                                                                echo $row_tck_by['fname'].' '.substr($row_tck_by['mname'],0,1).'. '.$row_tck_by['lname'].' '.$row_tck_by['nameext'];
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $period_from.' to '.$period_to; ?></td>
                                                                        <td><?php echo $date_tracked; ?></td>
                                                                        <td><?php echo $obdv_code; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" class="chkbox" id="chkbox" name="checkbox[]" value="<?php echo $billing_code; ?>">
                                                                        </td>
                                                                        <td><?php echo $i+1; $i++; ?></td>
                                                                        <td><?php echo $billing_code; ?></td>
                                                                        <td><?php echo $billing_date; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_tck_sp = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga WHERE id='$sp_id' ");
                                                                                $row_tck_sp = mysqli_fetch_assoc($sql_tck_sp);
                                                                                echo $row_tck_sp['sp_name'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_bl_ttl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$billing_code' ");
                                                                                    if ($sql_bl_ttl->num_rows > 0) {
                                                                                        $bill_ttl = 0;
                                                                                        while($row_bl_ttl = mysqli_fetch_assoc($sql_bl_ttl)) {
                                                                                            $bill_ttl = $bill_ttl + $row_bl_ttl['amount_in_figures'];
                                                                                        }
                                                                                    } else {
                                                                                        $bill_ttl = 0;
                                                                                    }
                                                                                echo number_format($bill_ttl,2);
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $sql_bl_ttl->num_rows; ?></td>
                                                                        <td><?php echo $date_received; ?></td>
                                                                        <td><?php echo $received_by; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_tck_by = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$tracked_by' ");
                                                                                $row_tck_by = mysqli_fetch_assoc($sql_tck_by);
                                                                                echo $row_tck_by['fname'].' '.substr($row_tck_by['mname'],0,1).'. '.$row_tck_by['lname'].' '.$row_tck_by['nameext'];
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $period_from.' to '.$period_to; ?></td>
                                                                        <td><?php echo $date_tracked; ?></td>
                                                                        <td>N/A</td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                        <th colspan="1"></th>
                                                        <th colspan="1" style="text-align: right;">CURRENT<span style="color: #94BFF5;">.</span>PAGE'S<span style="color: #94BFF5;">.</span>TOTAL<span style="color: #94BFF5;">.</span>>>></th>
                                                        <th colspan="1"></th>
                                                        <th colspan="1"></th>
                                                        <th colspan="6"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Track Billings -->
                                <!-- START Tracked Billings -->
                                <div id="tracked_billings" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <table class="table table-bordered table-striped table-hover tracked_bills dataTable text-left">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th style="width: 135px !important;">Billing Code</th>
                                                    <th>Billing Date</th>
                                                    <th>Service Provider</th>
                                                    <th>Amount</th>
                                                    <th>Date Received</th>
                                                    <th>Received By</th>
                                                    <th>Tracked By</th>
                                                    <th style="width: 120px !important;">Period Covered</th>
                                                    <th>Date Tracked</th>
                                                    <th style="width: 126px !important;">OBDV Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql_tracked_gls = mysqli_query($conn, "SELECT * FROM tbl_track_gl");
                                                    $i=0; $bill_ttl=0;
                                                    if ($sql_tracked_gls->num_rows > 0){
                                                        while($row_tracked_gls = mysqli_fetch_assoc($sql_tracked_gls)) {
                                                            $billing_code = $row_tracked_gls['billing_code'];
                                                            $billing_date = date_format(new DateTime($row_tracked_gls['billing_date']), "M. d, Y");
                                                            $sp_id = $row_tracked_gls['sp_id'];
                                                            $date_received = date_format(new DateTime($row_tracked_gls['date_received']), "M. d, Y");
                                                            $received_by = $row_tracked_gls['received_by'];
                                                            $tracked_by = $row_tracked_gls['tracked_by'];
                                                            $period_from = date_format(new DateTime($row_tracked_gls['period_from']), "M. d, Y");
                                                            $period_to = date_format(new DateTime($row_tracked_gls['period_to']), "M. d, Y");
                                                            $date_tracked = date_format(new DateTime($row_tracked_gls['date_tracked']), "M. d, Y");

                                                            $sql_vchd_bill = mysqli_query($conn, "SELECT * FROM tbl_vouched_bills WHERE billing_code2='$billing_code' ");
                                                            $row_vchd_bill = mysqli_fetch_assoc($sql_vchd_bill);                                                                       
                                                            $obdv_code = $row_vchd_bill['obs_dv_code2']; $bl_code = $row_vchd_bill['billing_code2'];
                                                            if ($bl_code == $billing_code) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1; $i++; ?></td>
                                                                    <td><?php echo $billing_code; ?></td>
                                                                    <td><?php echo $billing_date; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_tck_sp = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga WHERE id='$sp_id' ");
                                                                            $row_tck_sp = mysqli_fetch_assoc($sql_tck_sp);
                                                                            echo $row_tck_sp['sp_name'];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_bl_ttl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$billing_code' ");
                                                                                if ($sql_bl_ttl->num_rows > 0) {
                                                                                    $bill_ttl = 0;
                                                                                    while($row_bl_ttl = mysqli_fetch_assoc($sql_bl_ttl)) {
                                                                                        $bill_ttl = $bill_ttl + $row_bl_ttl['amount_in_figures'];
                                                                                    }
                                                                                } else {
                                                                                    $bill_ttl = 0;
                                                                                }
                                                                            echo number_format($bill_ttl,2);
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $date_received; ?></td>
                                                                    <td><?php echo $received_by; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_tck_by = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$tracked_by' ");
                                                                            $row_tck_by = mysqli_fetch_assoc($sql_tck_by);
                                                                            echo $row_tck_by['fname'].' '.substr($row_tck_by['mname'],0,1).'. '.$row_tck_by['lname'].' '.$row_tck_by['nameext'];
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $period_from.' to '.$period_to; ?></td>
                                                                    <td><?php echo $date_tracked; ?></td>
                                                                        <td><?php echo $obdv_code; ?></td>
                                                                    <td>
                                                                        <button class="btn btn-xs btn-danger waves-effect btn_exclude" name="exclude_modal" type="button" data-toggle="modal" title="Exclude this Bill from OBDV" data-target="#exclude_modal" data-billing_code2="<?php echo $billing_code;?>" data-obdv_code2="<?php echo $obdv_code;?>">
                                                                            <span class="fa fa-remove" style="color: white;"></span>
                                                                        </button>
                                                                        <button class="btn btn-xs btn-primary waves-effect btn_edit_obdvcode" name="edit_obdvcode_modal" type="button" data-toggle="modal" title="Edit Assigned OBDV Code" data-target="#edit_obdvcode_modal" data-billing_code="<?php echo $billing_code;?>" data-obdv_code="<?php echo $obdv_code;?>" data-obdv_code_edit="<?php echo $obdv_code;?>">
                                                                            <span class="fa fa-edit" style="color: white;"></span>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1" style="text-align: right;">CURRENT<span style="color: #94BFF5;">.</span>PAGE'S<span style="color: #94BFF5;">.</span>TOTAL<span style="color: #94BFF5;">.</span>>>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="7"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- Exclude Modal -->
                                        <div class="modal fade" id="exclude_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="fa fa-remove" style="color: red;"></span> Are you sure you want to exclude this GLBill from its OBDV?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $_SESSION['gl_id'] = $_SESSION['gl_code'] = $_SESSION['billing_code'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['gl_id'] = mysqli_real_escape_string($conn, test_input($_POST['gl_id']));
                                                            $_SESSION['gl_code'] = mysqli_real_escape_string($conn, test_input($_POST['gl_code']));
                                                            $_SESSION['billing_code'] = mysqli_real_escape_string($conn, test_input($_POST['billing_code']));
                                                            if (isset($_POST['btn_exclude_bill_from_obdv'])) {
                                                                header("location: exclude_bill_from_obdv.php");
                                                            }
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group form-float">
                                                                            <label>GLBill Code<span style="color: #1f91f3;"> (Read Only / Not editable)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_billing_code22" name="billing_code_edit22" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group form-float">
                                                                            <label>OBDV Code <span style="color: #1f91f3;"> (Read Only / Not editable)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_obdv_code22" name="obdv_code_edit22" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-block btn-danger waves-effect" data-dismiss="modal"name="btn_no">Cancel <span class="glyphicon glyphicon-remove"></span></button>
                                                            </div>
                                                            <div class="btn-group">
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="btn_exclude_bill_from_obdv">Yes <span class="glyphicon glyphicon-ok"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <!-- END Exclude Modal -->
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit_obdvcode_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="fa fa-edit" style="color: #1f91f3;"></span> Are you sure you want to edit this Bill's OBDV Code?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $_SESSION['billing_code_edit'] = $_SESSION['obdv_code_edit'] = $_SESSION['obdv_code_edited'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['billing_code_edit'] = mysqli_real_escape_string($conn, test_input($_POST['billing_code_edit']));
                                                            $_SESSION['obdv_code_edit'] = mysqli_real_escape_string($conn, test_input($_POST['obdv_code_edit']));
                                                            $_SESSION['obdv_code_edited'] = mysqli_real_escape_string($conn, test_input($_POST['obdv_code_edited']));
                                                            if (isset($_POST['btn_edit_obdvcode'])) {
                                                                header("location: edit_obdvcode.php");
                                                            }
                                                        }
                                                        function test_input($data) {
                                                          $data = trim($data);
                                                          $data = stripslashes($data);
                                                          $data = htmlspecialchars($data);
                                                          return $data;
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group form-float">
                                                                            <label>Billing Code<span style="color: #1f91f3;"> (Read Only / Not editable)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_billing_code2" name="billing_code_edit" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>OBDV Code <span style="color: red;">(edit code below)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="hidden" class="form-control" id="modal_obdv_code2" name="obdv_code_edit" readonly>
                                                                                <input type="text" class="form-control" id="modal_obdv_code_edit" name="obdv_code_edited" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="btn-group">
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="btn_edit_obdvcode">Save Changes <span class="glyphicon glyphicon-save"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div> 
                                        <!-- END Edit Modal -->
                                    </div>
                                </div>
                                <!-- END Tracked Billings -->
                                <!-- START Billings still for OBs DV -->
                                <div id="for_obsdv_billings" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <table class="table table-bordered table-striped table-hover untracked_bills dataTable text-left">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th style="width: 135px !important;">Billing Code</th>
                                                    <th>Billing Date</th>
                                                    <th>Service Provider</th>
                                                    <th>Amount</th>
                                                    <th>Date Received</th>
                                                    <th>Received By</th>
                                                    <th>Tracked By</th>
                                                    <th style="width: 120px !important;">Period Covered</th>
                                                    <th>Date Tracked</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql_untracked_gls = mysqli_query($conn, "SELECT * FROM tbl_track_gl");
                                                    $i=0; $bill_ttl=0;
                                                    if ($sql_untracked_gls->num_rows > 0){
                                                        while($row_untracked_gls = mysqli_fetch_assoc($sql_untracked_gls)) {
                                                            $billing_code = $row_untracked_gls['billing_code'];
                                                            $billing_date = date_format(new DateTime($row_untracked_gls['billing_date']), "M. d, Y");
                                                            $sp_id = $row_untracked_gls['sp_id'];
                                                            $date_received = date_format(new DateTime($row_untracked_gls['date_received']), "M. d, Y");
                                                            $received_by = $row_untracked_gls['received_by'];
                                                            $tracked_by = $row_untracked_gls['tracked_by'];
                                                            $period_from = date_format(new DateTime($row_untracked_gls['period_from']), "M. d, Y");
                                                            $period_to = date_format(new DateTime($row_untracked_gls['period_to']), "M. d, Y");
                                                            $date_tracked = date_format(new DateTime($row_untracked_gls['date_tracked']), "M. d, Y");

                                                            $sql_vchd_bill = mysqli_query($conn, "SELECT * FROM tbl_vouched_bills WHERE billing_code2='$billing_code' ");
                                                            $row_vchd_bill = mysqli_fetch_assoc($sql_vchd_bill);                                                                       
                                                            $obdv_code = $row_vchd_bill['obs_dv_code2']; $bl_code = $row_vchd_bill['billing_code2'];
                                                            if ($bl_code == $billing_code) {
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1; $i++; ?></td>
                                                                    <td><?php echo $billing_code; ?></td>
                                                                    <td><?php echo $billing_date; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_tck_sp = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga WHERE id='$sp_id' ");
                                                                            $row_tck_sp = mysqli_fetch_assoc($sql_tck_sp);
                                                                            echo $row_tck_sp['sp_name'];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_bl_ttl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$billing_code' ");
                                                                                if ($sql_bl_ttl->num_rows > 0) {
                                                                                    $bill_ttl = 0;
                                                                                    while($row_bl_ttl = mysqli_fetch_assoc($sql_bl_ttl)) {
                                                                                        $bill_ttl = $bill_ttl + $row_bl_ttl['amount_in_figures'];
                                                                                    }
                                                                                } else {
                                                                                    $bill_ttl = 0;
                                                                                }
                                                                            echo number_format($bill_ttl,2);
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $date_received; ?></td>
                                                                    <td><?php echo $received_by; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_tck_by = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$tracked_by' ");
                                                                            $row_tck_by = mysqli_fetch_assoc($sql_tck_by);
                                                                            echo $row_tck_by['fname'].' '.substr($row_tck_by['mname'],0,1).'. '.$row_tck_by['lname'].' '.$row_tck_by['nameext'];
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $period_from.' to '.$period_to; ?></td>
                                                                    <td><?php echo $date_tracked; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1" style="text-align: right;">CURRENT<span style="color: #94BFF5;">.</span>PAGE'S<span style="color: #94BFF5;">.</span>TOTAL<span style="color: #94BFF5;">.</span>>>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="5"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- END Billings still for OBs DV -->
                            </div> <!--End of tab-content-->
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
    <script src="plugins/jquery-datatable/sum.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    
    <script>
        $(document).ready(function() {

            $("table.tracked_bills tbody").on("click", ".btn_exclude", function(){
                var billing_code2 = $(this).data('billing_code2');
                $("#modal_billing_code22").val(billing_code2);
                console.log(billing_code2);

                var obdv_code2 = $(this).data('obdv_code2');
                $("#modal_obdv_code22").val(obdv_code2);
                console.log(obdv_code2);
            });

            $("table.tracked_bills tbody").on("click", ".btn_edit_obdvcode", function(){
                var billing_code = $(this).data('billing_code');
                $("#modal_billing_code2").val(billing_code);
                console.log(billing_code);

                var obdv_code = $(this).data('obdv_code');
                $("#modal_obdv_code2").val(obdv_code);
                console.log(obdv_code);

                var obdv_code_edit = $(this).data('obdv_code_edit');
                $("#modal_obdv_code_edit").val(obdv_code_edit);
                console.log(obdv_code_edit);
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('.slct_all_chkbox').click(function() {
            if ($(this).is(':checked')) {
                $('input:checkbox').prop('checked', true);
            } else {
                $('input:checkbox').prop('checked', false);
            }
        });

        $('#submit-new').click(function() {
            var obdv_code = 'N/A';
                $("#mdl_obdv_code").val(obdv_code);
                console.log(obdv_code);
        });

        $('#btn-addtoexisting').click(function() {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            var obs_dv_date = today;
                $("#obs_dv_date").val(obs_dv_date);
                console.log(obs_dv_date);
            var prep_by = 'N/A';
                $("#prep_by").val(prep_by);
                console.log(prep_by);
        });

        $('.result').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
            ],
            paging: false
        });

        var table_track_bills = $('.track_bills').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [-1],
                ['All'],
            ],
            orderCellsTop: true,
            fixedHeader: true,
            //orderCellsTop: true,
            //fixedHeader: true,
            initComplete: function () {
                var api = this.api();
     
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters_track_bills th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters_track_bills th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
     
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();
     
                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
            footerCallback: function (row, data, start, end, display) {
                var api_ttl_amt = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total over all pages
                total = api_ttl_amt
                    .column(5)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal2 = api_ttl_amt
                    .column(5, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                total_gl = api_ttl_amt
                    .column(6, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(3).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(5).footer()).html(pageTotal2.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(6).footer()).html(total_gl.toLocaleString('en'));
            }
        });
        var table_tracked_bills = $('.tracked_bills').DataTable({
            //dom: 'Bfrtip',
            //responsive: true,
            searching: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All'],
            ],
            //orderCellsTop: true,
            //fixedHeader: true,
            initComplete: function () {
                var api = this.api();
     
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters_tracked_bills th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters_tracked_bills th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
     
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();
     
                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
            footerCallback: function (row, data, start, end, display) {
                var api_ttl_amt = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total over all pages
                total = api_ttl_amt
                    .column(4)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal2 = api_ttl_amt
                    .column(4, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(2).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(4).footer()).html(pageTotal2.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
        var table_untracked_bills = $('.untracked_bills').DataTable({
            //dom: 'Bfrtip',
            //responsive: true,
            searching: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All'],
            ],
            //orderCellsTop: true,
            //fixedHeader: true,
            initComplete: function () {
                var api = this.api();
     
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters_untracked_bills th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters_untracked_bills th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
     
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();
     
                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
            footerCallback: function (row, data, start, end, display) {
                var api_ttl_amt = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total over all pages
                total = api_ttl_amt
                    .column(4)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal2 = api_ttl_amt
                    .column(4, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(2).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(4).footer()).html(pageTotal2.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
    </script>

</body>
</html>