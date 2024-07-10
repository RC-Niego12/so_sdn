<?php
    // Start the session
    session_start();
    date_default_timezone_set('Asia/Manila');

    if ((empty($_SESSION['start_date']))&&(empty($_SESSION['end_date']))) {
        $_SESSION['start_date'] = ""; $_SESSION['end_date'] = "";
    } else {
        $_SESSION['start_date']; $_SESSION['end_date'];
    }
    if ((empty($_SESSION['start_date2']))&&(empty($_SESSION['end_date2']))) {
        $_SESSION['start_date2'] = ""; $_SESSION['end_date2'] = "";
    } else {
        $_SESSION['start_date2']; $_SESSION['end_date2'];
    }
    if ((empty($_SESSION['sp']))&&(empty($_SESSION['sp_address']))) {
        $_SESSION['sp'] = ""; $_SESSION['sp_address'] = "";
    } else {
        $_SESSION['sp']; $_SESSION['sp_address'];
    }
    if ((empty($_SESSION['sp_id']))) {
        $_SESSION['sp_id'] = "";
    } else {
        $_SESSION['sp_id'];
    }

    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

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
    <title>Track GLs (Step 1)</title>
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
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

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
                <a class="navbar-brand" href="#" title="Track GLs - Billings Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Billings Level</a>
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
                    <li class="active">
                        <a href="track_GLs.php">
                            <span class="fa fa-file"></span>
                            <span>Track GLs (Step 1)</span>
                        </a>
                    </li>
                    <li>
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
                                    <a href="#track_gls" data-toggle="tab">
                                        <span class="fa fa-file" style="color: #337ab7;"></span> Track Billed GLs
                                    </a>
                                </li>
                                <li>
                                    <a href="#tracked_gls" data-toggle="tab">
                                        <span class="fa fa-file" style="color: lightgreen;"></span> Tracked Billed GLs
                                    </a>
                                </li>
                                <li>
                                    <a href="#track_unbilled_gls" data-toggle="tab">
                                        <span class="fa fa-file"></span> Unbilled GLs
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- set_base_details -->
                                <div id="track_gls" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <div class="">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                                    <div class="panel-heading panel-title bg-darkblue"> 
                                                        <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Select Period Covered</h5>
                                                    </div><br>
                                                    <div class="clearfix">
                                                        <?php
                                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                if (isset($_POST['getDates'])) {
                                                                    $_SESSION['start_date'] = mysqli_real_escape_string($conn, $_POST['start_date']);
                                                                    $_SESSION['end_date'] = mysqli_real_escape_string($conn, $_POST['end_date']);
                                                                    $_SESSION['sp_id'] = mysqli_real_escape_string($conn, $_POST['sp_id']);
                                                                    $_SESSION['sp'] = mysqli_real_escape_string($conn, $_POST['sp']);
                                                                    $_SESSION['sp_address'] = mysqli_real_escape_string($conn, $_POST['sp_address']);
                                                                    header("location: track_GLs.php");
                                                                }

                                                                if (isset($_POST['refreshDates'])) {
                                                                    $_SESSION['start_date'] = "";
                                                                    $_SESSION['end_date'] = "";
                                                                    $_SESSION['sp_id'] = "";
                                                                    $_SESSION['sp'] = "";
                                                                    $_SESSION['sp_address'] = "";
                                                                    header("location: track_GLs.php");
                                                                }
                                                            }
                                                            function test_input($data) {
                                                              $data = trim($data);
                                                              $data = stripslashes($data);
                                                              $data = htmlspecialchars($data);
                                                              return $data;
                                                            }
                                                        ?>
                                                        <div style="width: 98%; display: inline-block;">
                                                            <div class="form-group form-float">
                                                                <label style="float: left;">Start Date:</label>
                                                                <div class="form-line">
                                                                    <input type="date" class="form-control" id="start_date" value="<?php echo $_SESSION['start_date']; ?>" name="start_date" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div style="width: 1%; display: inline-block;">
                                                            <span style="color: red; font-size: 2em;">*</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                        <div style="width: 98%; display: inline-block;">
                                                            <div class="form-group form-float">
                                                                <label style="float: left;">End Date:</label>
                                                                <div class="form-line">
                                                                    <input type="date" class="form-control" id="end_date" value="<?php echo $_SESSION['end_date']; ?>" name="end_date" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div style="width: 1%; display: inline-block;">
                                                            <span style="color: red; font-size: 2em;">*</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                        <div style="width: 98%; display: inline-block;">
                                                            <div class="form-group form-float">
                                                                <label style="float: left; display: block; width: 100%;">Service Provider:</label><br>
                                                                <div style="width: 10%!important; display: inline-block;" class="form-line">
                                                                    <input type="text" class="form-control" id="sp_id" value="<?php echo $_SESSION['sp_id']; ?>" name="sp_id" required autofocus>
                                                                </div>
                                                                <div style="width: 88%!important; display: inline-block;" class="form-line">
                                                                    <input type="text" class="form-control" id="sp" value="<?php echo $_SESSION['sp']; ?>" name="sp" required autofocus>
                                                                </div>
                                                                    <input type="hidden" class="form-control" id="sp_address" value="<?php echo $_SESSION['sp_address']; ?>" name="sp_address" required autofocus>
                                                            </div>
                                                        </div>
                                                            <div style="width: 1%; display: inline-block;">
                                                            <span style="color: red; font-size: 2em;">*</span>
                                                        </div>
                                                    </div>
                                                    <ul class="pager" style="margin: 10px -20px;">
                                                        <li class="">
                                                            <a style="color: white;">
                                                                <button class="btn btn-primary btn-xs btn-block waves-effect" name="getDates" type="submit">Confirm <span class="fa fa-check"></button>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a>
                                                                <button class="btn btn-xs btn-block waves-effect" name="refreshDates" type="submit">Clear Entries <span class="fa fa-refresh"></button>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8 col-xl-8">
                                                    <!-- SP -->
                                                    <div class="clearfix">
                                                        <label>Search SP Name & click on its row.</label><br>
                                                        <label>NOTE: Selected data will then appear in Service Provider input box.</label>
                                                        <div class="table-responsive" style="overflow-x: scroll; font-size: 1em; max-height: 300px;">
                                                            <table class="table table-bordered table-striped table-hover sp dataTable text-left" style="font-size: 12px;">
                                                                <thead class="bg-darkblue" style="color: white;">
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>SP Name</th>
                                                                        <th>SP Type</th>
                                                                        <th>SP Address</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $sp_sql = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga");
                                                                    if ($sp_sql->num_rows > 0){
                                                                        while($sp_row = mysqli_fetch_assoc($sp_sql)) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $sp_row['id']; ?></td>
                                                                                <td><?php echo $sp_row['sp_name']; ?></td>
                                                                                <td><?php echo $sp_row['sp_type']; ?></td>
                                                                                <td><?php echo $sp_row['sp_address'].' ('.$sp_row['sp_pd_address'].')'; ?></td>
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
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="border-top: solid gray 2px; border-bottom: solid gray 2px;">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <?php
                                                $sp_id = $_SESSION['sp_id']; $sp = $_SESSION['sp']; $sp_address = $_SESSION['sp_address'];
                                                $start_date = date_format(new DateTime($_SESSION['start_date']), "Y-m-d 00:00:01");
                                                $end_date = date_format(new DateTime($_SESSION['end_date']), "Y-m-d 23:59:59");
                                                $start_date2 = date_format(new DateTime($_SESSION['start_date']), "M. d, Y");
                                                $end_date2 = date_format(new DateTime($_SESSION['end_date']), "M. d, Y");
                                                $datenow = date('Y-m-d');

                                                if (isset($_POST['submit-new'])) {
                                                    if (!empty($_POST['checkbox'])) {
                                                        //checked checkboxes
                                                        $checkbox = $_POST['checkbox'];
                                                        foreach($checkbox as $chk1_checkbox) {  
                                                            $chk_checkbox .= $chk1_checkbox.',';
                                                       }
                                                        $_SESSION['checkbox'] = $chk_checkbox;
                                                        $_SESSION['start_date3'] = mysqli_real_escape_string($conn, $_POST['start_date']);
                                                        $_SESSION['end_date3'] = mysqli_real_escape_string($conn, $_POST['end_date']);
                                                        $_SESSION['datenow'] = mysqli_real_escape_string($conn, $_POST['datenow']);
                                                        $_SESSION['sp_id'] = mysqli_real_escape_string($conn, $_POST['sp_id']);
                                                        header("Location: track_GLs2.php");
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
                                                        $_SESSION['gl_bill_code'] = mysqli_real_escape_string($conn, $_POST['gl_bill_code']);
                                                        header("Location: add_gl_toexisting_glbill.php");
                                                    } else {    
                                                        echo '<script>alert("ERROR! You have not checked a box. Please try again.")</script>';
                                                    }
                                                }
                                            ?>
                                                <input type="hidden" name="start_date" value="<?php echo $_SESSION['start_date'];?>" required autofocus>
                                                <input type="hidden" name="end_date" value="<?php echo $_SESSION['end_date'];?>" required autofocus>
                                                <input type="hidden" name="datenow" value="<?php echo $datenow;?>" required autofocus>
                                                <input type="hidden" name="sp_id" value="<?php echo $sp_id;?>" required autofocus>
                                                <table class="table table-bordered table-striped table-hover result dataTable text-left">
                                                    <h4 style="text-align: center;">Saved Transactions (GLs) for the Period of <?php echo $start_date2.' - '.$end_date2; ?></h4>
                                                    <label>
                                                        <span style="color: red;">NOTE:</span> Rows with <span class="fa fa-check-square" style="color: green;"></span> and green font-color are "ALREADY BILLED AND TRACKED", therefore those rows can't be selected for tracking anymore. Please be guided.
                                                    </label>
                                                    <thead>
                                                        <tr>
                                                            <th colspan="11" style="text-align: left; padding-top: 0px !important; padding-bottom: 0px !important;">
                                                                <label><input type="checkbox" id="slct_all_chkbox" class="slct_all_chkbox"> Select/Deselect All</label>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Billed?</th>
                                                            <th>ID</th>
                                                            <th>GL Code</th>
                                                            <th>GL Date</th>
                                                            <th>Client</th>
                                                            <th>Beneficiary</th>
                                                            <th>Amount</th>
                                                            <th>Assistance-Purpose</th>
                                                            <th>Service Provider</th>
                                                            <th>Branch Served</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if ((empty($_SESSION['start_date'])) && (empty($_SESSION['end_date']))) {

                                                            } else {
                                                               // echo 'DATES: '.$start_date.' '.$end_date;
                                                            ?>
                                                            <!-- TABLE 1 -->
                                                            <?php
                                                                $sql_result = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE sp='$sp' AND release_mode='Guarantee Letter' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                if ($sql_result->num_rows > 0){
                                                                    while($row_result = mysqli_fetch_assoc($sql_result)) {
                                                                        $id_tbl_sv_clbn_addl_entry = $row_result['id_tbl_save_clientbene'];
                                                                        $transaction_date = date_format(new DateTime($row_result['time_start']), "M. d, Y");
                                                                        $bn_name = $row_result['bn_lname'].', '.$row_result['bn_fname'].' '.$row_result['bn_nameext'].' '.$row_result['bn_mname'];
                                                                        $amount_fig = $row_result['amount_in_figures'];
                                                                        $sql_bld_gl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls WHERE gl_id='$id_tbl_sv_clbn_addl_entry' ");
                                                                        $row_bld_gl = mysqli_fetch_assoc($sql_bld_gl);                                                                       
                                                                        $gl_id = $row_bld_gl['gl_id']; $bl_code = $row_bld_gl['billing_code'];
                                                                        if ($gl_id == $id_tbl_sv_clbn_addl_entry) {
                                                                            ?>
                                                                            <tr style="color: green;">
                                                                                <td><span class="fa fa-check-square" style="color: green;"></span></td>
                                                                                <td><?php echo $row_result['id_tbl_save_clientbene']; ?></td>
                                                                                <td><?php echo $row_result['transaction_code']; ?></td>
                                                                                <td><?php echo $transaction_date; ?></td>
                                                                                <td>
                                                                                    <?php
                                                                                      echo strtoupper($row_result['cl_fname'])." "; 
                                                                                      if (empty($row_result['cl_mname'])) {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo strtoupper(substr($row_result['cl_mname'],0,1)).". ";
                                                                                      }
                                                                                      echo strtoupper($row_result['cl_lname']);
                                                                                      if ($row_result['cl_nameext'] == "N/A") {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo ", ".$row_result['cl_nameext'];
                                                                                      };
                                                                                    ?>   
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                      echo strtoupper($row_result['bn_fname'])." "; 
                                                                                      if (empty($row_result['bn_mname'])) {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo strtoupper(substr($row_result['bn_mname'],0,1)).". ";
                                                                                      }
                                                                                      echo strtoupper($row_result['bn_lname']);
                                                                                      if ($row_result['bn_nameext'] == "N/A") {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo ", ".$row_result['bn_nameext'];
                                                                                      };
                                                                                    ?>   
                                                                                </td>
                                                                                <td><?php echo number_format($amount_fig,2); ?></td>
                                                                                <td><?php echo $row_result['assistance_type'].'-'.$row_result['purpose']; ?></td>
                                                                                <td><?php echo $row_result['sp']; ?></td>
                                                                                <td><?php echo $row_result['branch_served']; ?></td>
                                                                                <td><?php echo $bl_code; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <tr>
                                                                                <td><input type="checkbox" class="chkbox" id="chkbox" name="checkbox[]" value="<?php echo $row_result['id_tbl_save_clientbene']; ?>"></td>
                                                                                <td><?php echo $row_result['id_tbl_save_clientbene']; ?></td>
                                                                                <td><?php echo $row_result['transaction_code']; ?></td>
                                                                                <td><?php echo $transaction_date; ?></td>
                                                                                <td>
                                                                                    <?php
                                                                                      echo strtoupper($row_result['cl_fname'])." "; 
                                                                                      if (empty($row_result['cl_mname'])) {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo strtoupper(substr($row_result['cl_mname'],0,1)).". ";
                                                                                      }
                                                                                      echo strtoupper($row_result['cl_lname']);
                                                                                      if ($row_result['cl_nameext'] == "N/A") {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo ", ".$row_result['cl_nameext'];
                                                                                      };
                                                                                    ?>   
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                      echo strtoupper($row_result['bn_fname'])." "; 
                                                                                      if (empty($row_result['bn_mname'])) {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo strtoupper(substr($row_result['bn_mname'],0,1)).". ";
                                                                                      }
                                                                                      echo strtoupper($row_result['bn_lname']);
                                                                                      if ($row_result['bn_nameext'] == "N/A") {
                                                                                            echo "";
                                                                                      } else {
                                                                                            echo ", ".$row_result['bn_nameext'];
                                                                                      };
                                                                                    ?>   
                                                                                </td>
                                                                                <td><?php echo number_format($amount_fig,2); ?></td>
                                                                                <td><?php echo $row_result['assistance_type'].'-'.$row_result['purpose']; ?></td>
                                                                                <td><?php echo $row_result['sp']; ?></td>
                                                                                <td><?php echo $row_result['branch_served']; ?></td>
                                                                                <td><?php echo $row_result['remarks']; ?></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }  
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <div class="clearfix">
                                                    <div style="width: 100%;">
                                                        <ul class="pager" style="margin: 10px -20px;">
                                                            <li class="">
                                                                <a>
                                                                    <button class="submit-new btn btn-primary waves-effect" style="display: block; margin: auto;" name="submit-new" id="submit-new" type="submit">Submit as New GL-Bill <span class="fa fa-paper-plane"></span></button>
                                                                </a>
                                                            </li>
                                                            <li class="">
                                                                <a>
                                                                    <button id="btn-addtoexisting" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#modal-addtoexisting" style="display: block; margin: auto;" type="button">Add to Existing GL-Bill <span class="fa fa-plus"></span></button>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- Add to Existing GL-Bill -->
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
                                                                        <h5 style="color: red;">Are you sure in adding selected GL/s to an existing GL-Bill?</h5>
                                                                        <p>If yes, kindly enter first the GL-Bill Code below then click "Yes" button so that the selected GL/s will be added to that existing GL-Bill and not as a separate GL-Bill.</p>
                                                                        <div class="row clearfix" style="text-align: left !important;">
                                                                            <div style="width: 98%; display: inline-block;">
                                                                                <div class="form-group form-float">
                                                                                    <label style="float: left; display: block; width: 100%;">Enter GL-Bill Code:</label><br>
                                                                                    <div class="form-line">
                                                                                        <input type="text" name="gl_bill_code" id="gl_bill_code" class="form-control" placeholder="Enter GL-Bill Code here...">
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
                                                                            <button class="btn btn-sm btn-primary btn-block waves-effect" name="btn-addtoexisting" type="submit"> Yes <i class="fa fa-check"></i></button>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2 -->
                                <div id="tracked_gls" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <table class="table table-bordered table-striped table-hover tracked_gls dataTable text-left">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Billing<span style="color: #94BFF5;">.</span>Code</th>
                                                    <th>Billing<span style="color: #94BFF5;">.</span>Date</th>
                                                    <th>Period<span style="color: #94BFF5;">.</span>Covered</th>
                                                    <th>Date<span style="color: #94BFF5;">.</span>Served</th>
                                                    <th>Client</th>
                                                    <th>Beneficiary</th>
                                                    <th>Service<span style="color: #94BFF5;">.</span>Provider</th>
                                                    <th>Assistance<span style="color: #94BFF5;">.</span>Given-Purpose</th>
                                                    <th>GL<span style="color: #94BFF5;">.</span>ID#</th>
                                                    <th>GL<span style="color: #94BFF5;">.</span>Code</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql_bl_ttl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry INNER JOIN tbl_save_clientbene ON tbl_tracked_gls.gl_id = tbl_save_clientbene.id_tbl_save_clientbene INNER JOIN tbl_track_gl ON tbl_tracked_gls.billing_code = tbl_track_gl.billing_code");
                                                        $ii=""; $i=0; $bill_ttl=0;
                                                        if ($sql_bl_ttl->num_rows > 0) {
                                                            while($row_bl_ttl = mysqli_fetch_assoc($sql_bl_ttl)) {
                                                                $gl_id = $row_bl_ttl['gl_id'];
                                                                $billing_code = $row_bl_ttl['billing_code'];
                                                                $billing_date = date_format(new DateTime($row_bl_ttl['billing_date']), "M. d, Y");
                                                                $date_received = date_format(new DateTime($row_bl_ttl['date_received']), "M. d, Y");
                                                                $received_by = $row_bl_ttl['received_by'];
                                                                $tracked_by = $row_bl_ttl['tracked_by'];
                                                                $period_from = date_format(new DateTime($row_bl_ttl['period_from']), "M. d, Y");
                                                                $period_to = date_format(new DateTime($row_bl_ttl['period_to']), "M. d, Y");
                                                                $date_tracked = date_format(new DateTime($row_bl_ttl['date_tracked']), "M. d, Y");

                                                                $sp = $row_bl_ttl['sp'];
                                                                $assi_purpse = $row_bl_ttl['assistance_type'].'-'.$row_bl_ttl['purpose'];
                                                                $gl_code = $row_bl_ttl['transaction_code'];
                                                                $bill_ttl = $row_bl_ttl['amount_in_figures'];
                                                                $date_served = date_format(new DateTime($row_bl_ttl['time_end2']), "M. d, Y");
                                                                ?>
                                                                <td><?php echo $i+1; $i++; ?></td>
                                                                <td style="width: 100px !important;"><?php echo $billing_code; ?></td>
                                                                <td><?php echo $billing_date; ?></td>
                                                                <td><?php echo $period_from.' to '.$period_to; ?></td>

                                                                <td><?php echo $date_served; ?></td>
                                                                <td>
                                                                    <?php
                                                                      echo strtoupper($row_bl_ttl['cl_fname'])." "; 
                                                                      if (empty($row_bl_ttl['cl_mname'])) {
                                                                            echo "";
                                                                      } else {
                                                                            echo strtoupper(substr($row_bl_ttl['cl_mname'],0,1)).". ";
                                                                      }
                                                                      echo strtoupper($row_bl_ttl['cl_lname']);
                                                                      if ($row_bl_ttl['cl_nameext'] == "N/A") {
                                                                            echo "";
                                                                      } else {
                                                                            echo ", ".$row_bl_ttl['cl_nameext'];
                                                                      };
                                                                    ?>   
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                      echo strtoupper($row_bl_ttl['bn_fname'])." "; 
                                                                      if (empty($row_bl_ttl['bn_mname'])) {
                                                                            echo "";
                                                                      } else {
                                                                            echo strtoupper(substr($row_bl_ttl['bn_mname'],0,1)).". ";
                                                                      }
                                                                      echo strtoupper($row_bl_ttl['bn_lname']);
                                                                      if ($row_bl_ttl['bn_nameext'] == "N/A") {
                                                                            echo "";
                                                                      } else {
                                                                            echo ", ".$row_bl_ttl['bn_nameext'];
                                                                      };
                                                                    ?>   
                                                                </td>
                                                                <td><?php echo $sp; ?></td>
                                                                <td><?php echo $assi_purpse; ?></td>
                                                                <td><?php echo $gl_id; ?></td>
                                                                <td><?php echo $gl_code; ?></td>
                                                                <td><?php echo number_format($bill_ttl,2); ?></td>
                                                                <td>
                                                                    <button class="btn btn-xs btn-danger waves-effect btn_exclude" name="exclude_modal" type="button" data-toggle="modal" title="Exclude this GL from Bill" data-target="#exclude_modal" data-gl_id="<?php echo $gl_id;?>" data-gl_code="<?php echo $gl_code;?>" data-billing_code="<?php echo $billing_code;?>">
                                                                        <span class="fa fa-remove" style="color: white;"></span>
                                                                    </button>
                                                                    <button class="btn btn-xs btn-primary waves-effect btn_edit_blcode" name="edit_blcode_modal" type="button" data-toggle="modal" title="Edit Assigned Billing Code" data-target="#edit_blcode_modal" data-gl_id_edit="<?php echo $gl_id;?>" data-gl_code_edit="<?php echo $gl_code;?>" data-billing_code_edit="<?php echo $billing_code;?>">
                                                                        <span class="fa fa-edit" style="color: white;"></span>
                                                                </td>
                                                            </tr>
                                                            <?php   
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="9" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1" style="text-align: right;">CURRENT<span style="color: #94BFF5;">.</span>PAGE'S<span style="color: #94BFF5;">.</span>TOTAL<span style="color: #94BFF5;">.</span>>>></th>
                                                    <th colspan="2"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit_blcode_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="fa fa-edit" style="color: #1f91f3;"></span> Are you sure you want to edit this GL's Billing Code?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $_SESSION['gl_id_edit'] = $_SESSION['gl_code_edit'] = $_SESSION['billing_code_edit'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['gl_id_edit'] = mysqli_real_escape_string($conn, test_input($_POST['gl_id_edit']));
                                                            $_SESSION['gl_code_edit'] = mysqli_real_escape_string($conn, test_input($_POST['gl_code_edit']));
                                                            $_SESSION['billing_code_edit'] = mysqli_real_escape_string($conn, test_input($_POST['billing_code_edit']));
                                                            if (isset($_POST['edit_blcode'])) {
                                                                header("location: edit_blcode.php");
                                                            }
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group form-float">
                                                                            <label>GL ID#<span style="color: #1f91f3;"> (Read Only / Not editable)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_gl_id_edit" name="gl_id_edit" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group form-float">
                                                                            <label>GL Code<span style="color: #1f91f3;"> (Read Only / Not editable)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_gl_code_edit" name="gl_code_edit" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Billing Code <span style="color: red;">(edit code below)</span>:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_billing_code_edit" name="billing_code_edit" required autofocus>
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
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="edit_blcode">Save Changes <span class="glyphicon glyphicon-save"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div> 
                                        <!-- END Edit Modal -->
                                        <!-- Exclude Modal -->
                                        <div class="modal fade" id="exclude_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="fa fa-remove" style="color: red;"></span> Are you sure you want to exclude this GL from this bill?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $_SESSION['gl_id'] = $_SESSION['gl_code'] = $_SESSION['billing_code'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['gl_id'] = mysqli_real_escape_string($conn, test_input($_POST['gl_id']));
                                                            $_SESSION['gl_code'] = mysqli_real_escape_string($conn, test_input($_POST['gl_code']));
                                                            $_SESSION['billing_code'] = mysqli_real_escape_string($conn, test_input($_POST['billing_code']));
                                                            if (isset($_POST['exclude_gl'])) {
                                                                header("location: exclude_gl_from_bill.php");
                                                            }
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>GL ID#:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_gl_id" name="gl_id" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>GL Code:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_gl_code" name="gl_code" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Billing Code:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_billing_code" name="billing_code" required autofocus>
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
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="exclude_gl"> Submit <span class="glyphicon glyphicon-send"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <!-- END Exclude Modal -->
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div id="track_unbilled_gls" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <table class="table table-bordered table-striped table-hover unbilled_gls dataTable text-left">
                                            <thead>
                                                <tr>
                                                    <th>GL ID#</th>
                                                    <th>Date Served</th>
                                                    <th>Client</th>
                                                    <th>Beneficiary</th>
                                                    <th>Service Provider</th>
                                                    <th>Assistance Given</th>
                                                    <th>Purpose</th>
                                                    <th>GL Code</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql_unbilled = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE release_mode='Guarantee Letter' AND cancellation!='YES' ");
                                                    $ii=""; $i=0; $unbilled_ttl=0;
                                                    if ($sql_unbilled->num_rows > 0) {
                                                        while($row_unbilled = mysqli_fetch_assoc($sql_unbilled)) {
                                                            $gl_id = $row_unbilled['id_tbl_save_clientbene']; $sp = $row_unbilled['sp'];
                                                            $assi = $row_unbilled['assistance_type'];
                                                            $purpse = $row_unbilled['purpose'];
                                                            $gl_code = $row_unbilled['transaction_code'];
                                                            $bill_ttl = $row_unbilled['amount_in_figures'];
                                                            $date_served = date_format(new DateTime($row_unbilled['time_end2']), "M. d, Y");

                                                            $sql_bld_gl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls WHERE gl_id='$gl_id' ");
                                                            $row_bld_gl = mysqli_fetch_assoc($sql_bld_gl);                                                                       
                                                            $gl_id2 = $row_bld_gl['gl_id'];

                                                            if ($gl_id == $gl_id2) {

                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $gl_id; ?></td>
                                                                    <td><?php echo $date_served; ?></td>
                                                                    <td>
                                                                        <?php
                                                                          echo strtoupper($row_unbilled['cl_fname'])." "; 
                                                                          if (empty($row_unbilled['cl_mname'])) {
                                                                                echo "";
                                                                          } else {
                                                                                echo strtoupper(substr($row_unbilled['cl_mname'],0,1)).". ";
                                                                          }
                                                                          echo strtoupper($row_unbilled['cl_lname']);
                                                                          if ($row_unbilled['cl_nameext'] == "N/A") {
                                                                                echo "";
                                                                          } else {
                                                                                echo ", ".$row_unbilled['cl_nameext'];
                                                                          };
                                                                        ?>   
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                          echo strtoupper($row_unbilled['bn_fname'])." "; 
                                                                          if (empty($row_unbilled['bn_mname'])) {
                                                                                echo "";
                                                                          } else {
                                                                                echo strtoupper(substr($row_unbilled['bn_mname'],0,1)).". ";
                                                                          }
                                                                          echo strtoupper($row_unbilled['bn_lname']);
                                                                          if ($row_unbilled['bn_nameext'] == "N/A") {
                                                                                echo "";
                                                                          } else {
                                                                                echo ", ".$row_unbilled['bn_nameext'];
                                                                          };
                                                                        ?>   
                                                                    </td>
                                                                    <td><?php echo $sp; ?></td>
                                                                    <td><?php echo $assi; ?></td>
                                                                    <td><?php echo $purpse; ?></td>
                                                                    <td><?php echo $gl_code; ?></td>
                                                                    <td><?php echo number_format($bill_ttl,2); ?></td>
                                                                </tr>
                                                                <?php
                                                            } 
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1" style="text-align: right;">CURRENT<span style="color: #94BFF5;">.</span>PAGE'S<span style="color: #94BFF5;">.</span>TOTAL<span style="color: #94BFF5;">.</span>>>></th>
                                                    <th colspan="1"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
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
            $('[data-toggle="tooltip"]').tooltip();

            /*$(".btn_exclude").click(function(){
                var gl_id = $('tracked_gls').data('gl_id');
                    $("#modal_gl_id").val(gl_id);
                    console.log(gl_id);
                var gl_code = $(this).data('gl_code');
                    $("#modal_gl_code").val(gl_code);
                    console.log(gl_code);
                var billing_code = $(this).data('billing_code');
                    $("#modal_billing_code").val(billing_code);
                    console.log(billing_code);
            });*/

            $("table.tracked_gls tbody").on("click", ".btn_exclude", function(){
                var gl_id = $(this).data('gl_id');
                    $("#modal_gl_id").val(gl_id);
                    console.log(gl_id);
                var gl_code = $(this).data('gl_code');
                    $("#modal_gl_code").val(gl_code);
                    console.log(gl_code);
                var billing_code = $(this).data('billing_code');
                    $("#modal_billing_code").val(billing_code);
                    console.log(billing_code);
            });

            $("table.tracked_gls tbody").on("click", ".btn_edit_blcode", function(){
                var gl_id_edit = $(this).data('gl_id_edit');
                    $("#modal_gl_id_edit").val(gl_id_edit);
                    console.log(gl_id_edit);
                var gl_code_edit = $(this).data('gl_code_edit');
                    $("#modal_gl_code_edit").val(gl_code_edit);
                    console.log(gl_code_edit);
                var billing_code_edit = $(this).data('billing_code_edit');
                    $("#modal_billing_code_edit").val(billing_code_edit);
                    console.log(billing_code_edit);
            });
        });

        $('.slct_all_chkbox').click(function() {
            if ($(this).is(':checked')) {
                $('input:checkbox').prop('checked', true);
            } else {
                $('input:checkbox').prop('checked', false);
            }
        });

        $('.submit-new').click(function() {
            var gl_bill_code = 'N/A';
                $("#gl_bill_code").val(gl_bill_code);
                console.log(gl_bill_code);
        });

        $('.sp').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
            ],
            paging: false
        });

        var table_sp = $('.sp').DataTable();
        $('.sp tbody').on('click', 'tr', function() {
            var data = table_sp.row(this).data();
            $("#sp_address").val(data[3]);
            console.log(data[3]);
            $("#sp").val(data[1]);
            console.log(data[1]);
            $("#sp_id").val(data[0]);
            console.log(data[0]);
        });  

        $('.result').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
            ],
            paging: false
        });

        var table_result = $('.sp').DataTable();
        $('.result tbody').on('click', 'tr', function() {
            var data = table_result.row(this).data();
            $("#").val(data[3]);
            console.log(data[3]);
            $("#").val(data[1]);
            console.log(data[1]);
        });
        var table_tracked_gls = $('.tracked_gls').DataTable({
            //dom: 'Bfrtip',
            //responsive: true,
            searching: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [10, 5, 25, 50, 100, -1],
                [10, 5, 25, 50, 100, 'All'],
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
                        var cell = $('.filters_tracked_gls th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters_tracked_gls th').eq($(api.column(colIdx).header()).index())
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
                    .column(11)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal2 = api_ttl_amt
                    .column(11, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(9).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(11).footer()).html(pageTotal2.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
        var table_unbilled_gls = $('.unbilled_gls').DataTable({
            //dom: 'Bfrtip',
            //responsive: true,
            searching: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [10, 5, 25, 50, 100, -1],
                [10, 5, 25, 50, 100, 'All'],
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
                        var cell = $('.filters_unbilled_gls th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters_unbilled_gls th').eq($(api.column(colIdx).header()).index())
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
                    .column(8)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal2 = api_ttl_amt
                    .column(8, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(6).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(8).footer()).html(pageTotal2.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
    </script>

</body>
</html>