<?php
    // Start the session
    session_start();
    if ((empty($_SESSION['start_date1']))&&(empty($_SESSION['end_date1']))) {
        $_SESSION['start_date1'] = ""; $_SESSION['end_date1'] = "";
    } else {
        $_SESSION['start_date1']; $_SESSION['end_date1'];
    }

    if ((empty($_SESSION['start_date2']))&&(empty($_SESSION['end_date2']))) {
        $_SESSION['start_date2'] = ""; $_SESSION['end_date2'] = "";
    } else {
        $_SESSION['start_date2']; $_SESSION['end_date2'];
    }

    if ((empty($_SESSION['start_date3']))&&(empty($_SESSION['end_date3']))) {
        $_SESSION['start_date3'] = ""; $_SESSION['end_date3'] = "";
    } else {
        $_SESSION['start_date3']; $_SESSION['end_date3'];
    }

    if ((empty($_SESSION['start_date4']))&&(empty($_SESSION['end_date4']))) {
        $_SESSION['start_date4'] = ""; $_SESSION['end_date4'] = "";
    } else {
        $_SESSION['start_date4']; $_SESSION['end_date4'];
    }

    if ((empty($_SESSION['start_date5']))&&(empty($_SESSION['end_date5']))) {
        $_SESSION['start_date5'] = ""; $_SESSION['end_date5'] = "";
    } else {
        $_SESSION['start_date5']; $_SESSION['end_date5'];
    }

    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname='".$_SESSION['uname']."' AND pword='".$_SESSION['pword']."' ");
    $roww = mysqli_fetch_assoc($sql);
    if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==false)) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Home: Social Worker</title>
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
                <a class="navbar-brand" href="#" title="Homepage - SW Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Social Worker Level</a>
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
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs INNER JOIN tbl_sw_table ON tbl_staffs.staffid=tbl_sw_table.staffid2 WHERE staffid='".$roww['staffid']."'");
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row['fname'].' '.substr($row['mname'],0,1).'. '.$row['lname'].' '.$row['nameext']; ?></div>
                    <div class="email"><?php echo $row['uname'].' | Table '.$row['table_num']; ?></div>
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
                        <a href="home_sw.php">
                            <span class="glyphicon glyphicon-home"></span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="database_sw.php">
                            <span class="glyphicon glyphicon-file"></span>
                            <span>Database</span>
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
                                            <a href="#todays_clients" data-toggle="tab">
                                                <span class="fa fa-group" style="color: lightgreen;"></span> Today's Clients
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#ttl_clients_served" data-toggle="tab">
                                                <span class="fa fa-group" style="color: blue;"></span> Total Clients Served
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#todays_swopertable" data-toggle="tab">
                                                <span class="fa fa-circle" style="color: lightgreen;"></span> Active Tables Today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#current_sp" data-toggle="tab">
                                                <span class="fa fa-building" style="color: lightgreen;"></span> Current SPs
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content text-center" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                        <!-- today's clients -->
                                        <div id="todays_clients" class="tab-pane fade in active">
                                            <?php
                                                $_SESSION['cl_qn22'] = $_SESSION['cl_qn2'] = $served_warning = "";
                                                $table_sw_num = $row['table_num'];
                                                $cl_ongoing = mysqli_query($conn, "SELECT * FROM tbl_clientqueue INNER JOIN tbl_assign_table ON tbl_clientqueue.cl_qn = tbl_assign_table.cl_qnn WHERE tbl_clientqueue.queue_status='On-going' AND tbl_assign_table.table_num='$table_sw_num' " );

                                                if (isset($_POST['pending'])) {
                                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                        $_SESSION['cl_qn22'] = mysqli_real_escape_string($conn, $_POST['cl_qn2']);
                                                        header("location: pending_queue.php");
                                                    }
                                                }

                                                if (isset($_POST['proceed'])) {
                                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                        $_SESSION['cl_qn2'] = mysqli_real_escape_string($conn, $_POST['cl_qn2']);
                                                        $sql_slct_clq = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
                                                        $sql_slct_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_addl_entry WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
                                                        //select addl entry
                                                        if ($sql_slct_addl_entry->num_rows > 0) {
                                                            $row_slct_addl_entry = mysqli_fetch_assoc($sql_slct_addl_entry);
                                                        } else {
                                                            $row_slct_addl_entry="";
                                                        }
                                                        //select client queue
                                                        if ($sql_slct_clq->num_rows > 0) {
                                                            while($row_slct_clq = mysqli_fetch_assoc($sql_slct_clq)) {
                                                                if ($row_slct_clq['queue_status']=='SERVED') {
                                                                    $served_warning = "<b>WARNING:</b> Client has been already SERVED!<br> Please select another client in queue or ask the verifier to add the client again to avail another type of assistance.";
                                                                } else if (($sql_slct_addl_entry->num_rows > 0) && ($row_slct_addl_entry['release_mode']=="Guarantee Letter")) {
                                                                    $_SESSION['cl_qn'] = $_SESSION['cl_qn2'];
                                                                    if ($cl_ongoing->num_rows > 0) {
                                                                        echo '<script>';
                                                                            echo 'alert(" Cannot proceed if there are transactions still with <On-going> status!\nKindly change first its status to <Pending>!");';
                                                                        echo '</script>';
                                                                    } else {
                                                                        header("location: forms_sw.php");
                                                                    }
                                                                } else if (($sql_slct_addl_entry->num_rows > 0) && ($row_slct_addl_entry['release_mode']=="CASH")) {
                                                                    $_SESSION['cl_qn'] = $_SESSION['cl_qn2'];
                                                                    if ($cl_ongoing->num_rows > 0) {
                                                                        echo '<script>';
                                                                            echo 'alert(" Cannot proceed if there are transactions still with <On-going> status!\nKindly change first its status to <Pending>!");';
                                                                        echo '</script>';
                                                                    } else {
                                                                        header("location: forms_sw_pcv.php");
                                                                    }
                                                                } else {
                                                                    if ($cl_ongoing->num_rows > 0) {
                                                                        echo '<script>';
                                                                            echo 'alert("Cannot proceed if there are transactions still with <On-going> status!\nKindly change first its status to <Pending>!");';
                                                                        echo '</script>';
                                                                    } else {
                                                                        header("location: gis_sw.php");
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            header("location: gis_sw.php");
                                                        }
                                                    }
                                                }
                                            ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                                    <div class="panel-heading panel-title bg-darkblue"> 
                                                        <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Selected Queueing No.:</h5>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-xs-10">
                                                            <div class="form-group form-float">
                                                                <label style="float: left;">Please click desired row below to get Queueing #.</label>
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control text-center" id="cl_qn2" name="cl_qn2" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-1">
                                                            <span style="color: red; font-size: 2em;">*</span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        if (!empty($served_warning)) {
                                                            ?>
                                                                <div id="served_warning" style="background-color: orange; padding: 10px;">
                                                                    <button id="btn_close_served_warning" class="btn btn-xs btn-danger" type="button" style="float: right;"><span class="fa fa-remove"></span></button>
                                                                    <p style="font-size: 13px;"><?php echo $served_warning; ?></p>
                                                                </div>
                                                            <?php
                                                        } else {}
                                                    ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8 col-xl-8">
                                                    <ul class="pager" style="float: left; margin: 10px -20px;">
                                                        <li class="">
                                                            <a href="home_sw.php">
                                                                <button class="btn btn-xs btn-block waves-effect" type="button"><span class="fa fa-refresh"></span> Refresh</button>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a style="color: white;">
                                                                <button class="btn btn-primary btn-xs btn-block waves-effect" name="proceed" type="submit">Proceed <span class="fa fa-arrow-right"></span></button>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a style="color: white;">
                                                                <button class="btn btn-xs btn-block waves-effect" name="pending" type="submit" style="background-color: navajowhite; color: darkblue;">Pending <span class="fa fa-minus"></span></button>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                            <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                                <table class="table table-bordered table-striped table-hover clientq_today dataTable text-left">
                                                    <thead class="bg-darkblue" style="color: white;">
                                                        <tr style="font-size: 14px;">
                                                            <th colspan="7" style="background-color: green;">CLIENT DATA</th>
                                                            <th colspan="5" style="background-color: yellow;">BENEFICIARY DATA</th>
                                                            <th colspan="5" style="background-color: blue;">OTHER TRANSACTION DATA</th>
                                                        </tr>
                                                        <tr id="systembaseddb_tr2">
                                                            <th class="th_nseries">Q_No.</th>
                                                            <th class="th_cstatus">Cl_Frequency</th>
                                                            <th class="th_cstatus">Cl_Lname</th>
                                                            <th class="th_cstatus">Cl_Fname</th>
                                                            <th class="th_cstatus">Cl_Mname</th>
                                                            <th class="th_cstatus">Cl_NameExt</th>
                                                            <th class="th_cstatus">Cl_Category</th>
                                                            <th class="th_cstatus">Bn_Lname</th>
                                                            <th class="th_cstatus">Bn_Fname</th>
                                                            <th class="th_cstatus">Bn_Mname</th>
                                                            <th class="th_cstatus">Bn_NameExt</th>
                                                            <th class="th_cstatus">Bn_Category</th>
                                                            <th class="th_cstatus">Time_Started</th>
                                                            <th class="th_cstatus">Assistance_Needed</th>
                                                            <th class="th_cstatus">Remarks</th>
                                                            <th class="th_cstatus">Encoded_By</th>
                                                            <th class="th_cstatus">Cl_QStatus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if ($cl_ongoing->num_rows > 0) {
                                                                ?>
                                                                    <div id="unsaved_warning" style="position: absolute; width: 600px; height: auto; padding: 10px; z-index: 1; top: 0; left: 14px; background-color: navajowhite; border-radius: 20px;">
                                                                        <button id="btn_close_unsaved" class="btn btn-xs btn-danger" type="button" style="float: right;"><span class="fa fa-remove"></span></button>
                                                                        <h2>You have <?php echo $cl_ongoing->num_rows; ?> UNSAVED Transaction/s.</h2>
                                                                        <h5>Please save them properly or change its/their queuing status from "On-going" to "Pending" in the queue.</h5>
                                                                    </div>
                                                                <?php
                                                            } else {}
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Total Clients Served -->
                                        <div id="ttl_clients_served" class="tab-pane fade in">
                                            <div class="">
                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                                        <div class="panel-heading panel-title bg-darkblue"> 
                                                            <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">For Accomplishment Report</h5>
                                                        </div><br>
                                                        <div class="clearfix">
                                                            <?php
                                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                        $_SESSION['start_date1'] = $_SESSION['start_date2'] = $_SESSION['start_date3'] = $_SESSION['start_date4'] = $_SESSION['start_date5'] = "";
                                                                    if (isset($_POST['getDates'])) {
                                                                        $_SESSION['start_date1'] = mysqli_real_escape_string($conn, $_POST['start_date1']);
                                                                        $_SESSION['start_date2'] = mysqli_real_escape_string($conn, $_POST['start_date2']);
                                                                        $_SESSION['start_date3'] = mysqli_real_escape_string($conn, $_POST['start_date3']);
                                                                        $_SESSION['start_date4'] = mysqli_real_escape_string($conn, $_POST['start_date4']);
                                                                        $_SESSION['start_date5'] = mysqli_real_escape_string($conn, $_POST['start_date5']);
                                                                        header("location: home_sw.php");
                                                                    }

                                                                    if (isset($_POST['refreshDates'])) {
                                                                        $_SESSION['start_date1'] = $_SESSION['start_date2'] = $_SESSION['start_date3'] = $_SESSION['start_date4'] = $_SESSION['start_date5'] = "";
                                                                        header("location: home_sw.php");
                                                                    } 
                                                                }
                                                                function test_input($data) {
                                                                $data = trim($data);
                                                                $data = stripslashes($data);
                                                                $data = htmlspecialchars($data);
                                                                return $data;
                                                                }
                                                            ?>
                                                            <div style="width: 100%;">
                                                                <div class="form-group form-float">
                                                                    <label style="float: left;">Select Date/s:</label>
                                                                    <div class="form-line">
                                                                        <input type="date" class="form-control" id="start_date1" value="<?php echo $_SESSION['start_date1']; ?>" name="start_date1">
                                                                    </div>
                                                                    <div class="form-line">
                                                                        <input type="date" class="form-control" id="start_date2" value="<?php echo $_SESSION['start_date2']; ?>" name="start_date2">
                                                                    </div>
                                                                    <div class="form-line">
                                                                        <input type="date" class="form-control" id="start_date3" value="<?php echo $_SESSION['start_date3']; ?>" name="start_date3">
                                                                    </div>
                                                                    <div class="form-line">
                                                                        <input type="date" class="form-control" id="start_date4" value="<?php echo $_SESSION['start_date4']; ?>" name="start_date4">
                                                                    </div>
                                                                    <div class="form-line">
                                                                        <input type="date" class="form-control" id="start_date5" value="<?php echo $_SESSION['start_date5']; ?>" name="start_date5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8 col-xl-8">
                                                        <ul class="pager" style="float: left; margin: 10px -20px;">
                                                            <li class="">
                                                                <a style="color: white;">
                                                                    <button class="btn btn-primary btn-xs btn-block waves-effect" name="getDates" type="submit">Confirm <span class="fa fa-check"></button>
                                                                </a>
                                                            </li>
                                                            <li class="">
                                                                <a>
                                                                    <button class="btn btn-xs btn-block waves-effect" name="refreshDates" type="submit">Refresh <span class="fa fa-refresh"></button>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                                <table class="table table-bordered table-striped table-hover clientq-today dataTable text-left">
                                                    <thead class="bg-darkblue" style="color: white;">
                                                        <tr>
                                                            <th>DATE</th>
                                                            <th>MEDICAL</th>
                                                            <th>FOOD</th>
                                                            <th>TRANSPORTATION</th>
                                                            <th>BURIAL</th>
                                                            <th>EDUCATIONAL</th>
                                                            <th>CASH</th>
                                                            <th>TOTAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            //date1
                                                            if (!empty($_SESSION['start_date1'])) {
                                                                ?>
                                                                <tr class="row1">
                                                                    <?php
                                                                        $staffid = $roww['staffid'];
                                                                        $start_date_1 = date_format(new DateTime($_SESSION['start_date1']), "m/d/Y");
                                                                        //$start_date2 = date_format(new DateTime($_SESSION['start_date']), "Y-m-d");
                                                                        $start_date1 = date_format(new DateTime($_SESSION['start_date1']), "Y-m-d 00:00:01");
                                                                        $end_date1 = date_format(new DateTime($_SESSION['start_date1']), "Y-m-d 23:59:59");
                                                                        $sql_ttl_cl_served1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                        if ($sql_ttl_cl_served1->num_rows > 0){
                                                                            while($row_ttl_cl_served1 = mysqli_fetch_assoc($sql_ttl_cl_served1)) {
                                                                                $date_issued1 = date_format(new DateTime($row_ttl_cl_served1['time_end2']), "m/d/Y l");
                                                                            }
                                                                            ?>
                                                                            <td><?php echo $date_issued1; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_med1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_med1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_food1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_food1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_trans1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_trans1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_burial1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_burial1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_educ1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_educ1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_cash1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_cash1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_all1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_all1->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><?php echo $start_date_1; ?></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                            //date2
                                                            if (!empty($_SESSION['start_date2'])) {
                                                                ?>
                                                                <tr class="row2">
                                                                    <?php
                                                                        $start_date_2 = date_format(new DateTime($_SESSION['start_date2']), "m/d/Y");
                                                                        //$start_date2 = date_format(new DateTime($_SESSION['start_date']), "Y-m-d");
                                                                        $start_date2 = date_format(new DateTime($_SESSION['start_date2']), "Y-m-d 00:00:01");
                                                                        $end_date2 = date_format(new DateTime($_SESSION['start_date2']), "Y-m-d 23:59:59");
                                                                        $sql_ttl_cl_served2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                        if ($sql_ttl_cl_served2->num_rows > 0){
                                                                            while($row_ttl_cl_served2 = mysqli_fetch_assoc($sql_ttl_cl_served2)) {
                                                                                $date_issued2 = date_format(new DateTime($row_ttl_cl_served2['time_end2']), "m/d/Y l");
                                                                            }
                                                                            ?>
                                                                            <td><?php echo $date_issued2; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_med2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_med2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_food2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_food2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_trans2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_trans2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_burial2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_burial2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_educ2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_educ2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_cash2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_cash2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_all2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_all2->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><?php echo $start_date_2; ?></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                            //date3
                                                            if (!empty($_SESSION['start_date3'])) {
                                                                ?>
                                                                <tr class="row3">
                                                                    <?php
                                                                        $start_date_3 = date_format(new DateTime($_SESSION['start_date3']), "m/d/Y");
                                                                        //$start_date2 = date_format(new DateTime($_SESSION['start_date']), "Y-m-d");
                                                                        $start_date3 = date_format(new DateTime($_SESSION['start_date3']), "Y-m-d 00:00:01");
                                                                        $end_date3 = date_format(new DateTime($_SESSION['start_date3']), "Y-m-d 23:59:59");
                                                                        $sql_ttl_cl_served3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                        if ($sql_ttl_cl_served3->num_rows > 0){
                                                                            while($row_ttl_cl_served3 = mysqli_fetch_assoc($sql_ttl_cl_served3)) {
                                                                                $date_issued3 = date_format(new DateTime($row_ttl_cl_served3['time_end2']), "m/d/Y l");
                                                                            }
                                                                            ?>
                                                                            <td><?php echo $date_issued3; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_med3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_med3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_food3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_food3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_trans3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_trans3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_burial3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_burial3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_educ3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_educ3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_cash3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_cash3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_all3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_all3->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><?php echo $start_date_3; ?></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                            //date4
                                                            if (!empty($_SESSION['start_date4'])) {
                                                                ?>
                                                                <tr class="row4">
                                                                    <?php
                                                                        $start_date_4 = date_format(new DateTime($_SESSION['start_date4']), "m/d/Y");
                                                                        //$start_date2 = date_format(new DateTime($_SESSION['start_date']), "Y-m-d");
                                                                        $start_date4 = date_format(new DateTime($_SESSION['start_date4']), "Y-m-d 00:00:01");
                                                                        $end_date4 = date_format(new DateTime($_SESSION['start_date4']), "Y-m-d 23:59:59");
                                                                        $sql_ttl_cl_served4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                        if ($sql_ttl_cl_served4->num_rows > 0){
                                                                            while($row_ttl_cl_served4 = mysqli_fetch_assoc($sql_ttl_cl_served4)) {
                                                                                $date_issued4 = date_format(new DateTime($row_ttl_cl_served4['time_end2']), "m/d/Y l");
                                                                            }
                                                                            ?>
                                                                            <td><?php echo $date_issued4; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_med4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_med4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_food4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_food4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_trans4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_trans4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_burial4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_burial4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_educ4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_educ4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_cash4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_cash4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_all4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_all4->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><?php echo $start_date_4; ?></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                            //date5
                                                            if (!empty($_SESSION['start_date5'])) {
                                                                ?>
                                                                <tr class="row5">
                                                                    <?php
                                                                        $start_date_5 = date_format(new DateTime($_SESSION['start_date5']), "m/d/Y");
                                                                        //$start_date2 = date_format(new DateTime($_SESSION['start_date']), "Y-m-d");
                                                                        $start_date5 = date_format(new DateTime($_SESSION['start_date5']), "Y-m-d 00:00:01");
                                                                        $end_date5 = date_format(new DateTime($_SESSION['start_date5']), "Y-m-d 23:59:59");
                                                                        $sql_ttl_cl_served5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                        if ($sql_ttl_cl_served5->num_rows > 0){
                                                                            while($row_ttl_cl_served5 = mysqli_fetch_assoc($sql_ttl_cl_served5)) {
                                                                                $date_issued5 = date_format(new DateTime($row_ttl_cl_served5['time_end2']), "m/d/Y l");
                                                                            }
                                                                            ?>
                                                                            <td><?php echo $date_issued5; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_med5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_med5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_food5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_food5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_trans5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_trans5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_burial5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_burial5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_educ5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_educ5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_cash5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_cash5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sql_all5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND swo_staffid='$staffid' ");
                                                                                    echo $sql_all5->num_rows;
                                                                                ?>
                                                                            </td>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><?php echo $start_date_5; ?></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- today's swo per table -->
                                        <div id="todays_swopertable" class="tab-pane fade in">
                                            <div class="table-responsive" style="overflow-x: hidden; font-size: 1em; width: 100%;">
                                                <table class="table table-bordered table-striped table-hover clientq dataTable text-left">
                                                    <thead class="bg-darkblue" style="color: white;">
                                                        <tr>
                                                            <th>Table No.</th>
                                                            <th>Name of SWO</th>
                                                            <th>Total Clients in Queue</th>
                                                            <th>Pending</th>
                                                            <th>With Priority Remarks (except SC/PWD)</th>
                                                            <th>Priority SC / PWD</th>
                                                            <th>Served</th>
                                                            <th>With Social Case Study Report/s (above 10,000.00 php)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $swo_id = "";
                                                        date_default_timezone_set('Asia/Manila');
                                                        $date_now = date('M. d, Y');
                                                        $start_date_now = date_format(new DateTime($date_now), "Y-m-d 00:00:01");
                                                        $end_date_now = date_format(new DateTime($date_now), "Y-m-d 23:59:59");
                                                        $sql = mysqli_query($conn, "SELECT * FROM tbl_staffs INNER JOIN tbl_sw_table ON tbl_staffs.staffid = tbl_sw_table.staffid2");
                                                        if ($sql->num_rows > 0){
                                                            while($row = mysqli_fetch_assoc($sql)) {
                                                                $swo_id = $row['staffid'];
                                                                $table_num = $row['table_num']; $staffid = $row['staffid2'];
                                                                $swoname = $row['lname'].', '.$row['fname'].' '.$row['mname'];
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $table_num; ?></td>
                                                                    <td><?php echo $swoname;//.' / '.$swo_id; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_cl_in_q = mysqli_query($conn, "SELECT * FROM tbl_assign_table WHERE table_num='$table_num' ");
                                                                            //echo $start_date_now.' - '.$end_date_now;
                                                                            echo $sql_cl_in_q->num_rows;
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_wait = mysqli_query($conn, "SELECT * FROM tbl_assign_table INNER JOIN tbl_clientqueue ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn WHERE table_num='$table_num' AND queue_status!='SERVED' ");
                                                                            echo $sql_wait->num_rows;
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_priority = mysqli_query($conn, "SELECT * FROM tbl_assign_table WHERE remarks!='N/A' AND remarks!='n/a' AND remarks!='For Case Study' AND table_num='$table_num' ");
                                                                            echo $sql_priority->num_rows;
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_sc = mysqli_query($conn, "SELECT * FROM tbl_assign_table INNER JOIN tbl_clientqueue ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn WHERE cl_category='SC' AND table_num='$table_num' ");
                                                                            //echo $sql_sc->num_rows;
                                                                            $sql_pwd = mysqli_query($conn, "SELECT * FROM tbl_assign_table INNER JOIN tbl_clientqueue ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn WHERE cl_category='PWD' AND table_num='$table_num' ");
                                                                            //echo $sql_pwd->num_rows;
                                                                            echo $sql_sc->num_rows + $sql_pwd->num_rows;
                                                                        ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php
                                                                            $sql_cl_served = mysqli_query($conn, "SELECT * FROM tbl_save_addl_entry WHERE swo_staffid='$swo_id' AND time_end2>='$start_date_now' AND time_end2<='$end_date_now'");
                                                                            //echo $start_date_now.' - '.$end_date_now;
                                                                            echo $sql_cl_served->num_rows;
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $sql_scsr = mysqli_query($conn, "SELECT * FROM tbl_save_addl_entry WHERE swo_staffid='$swo_id' AND amount_in_figures>10000 AND time_end2>='$start_date_now' AND time_end2<='$end_date_now'");
                                                                            //echo $start_date_now.' - '.$end_date_now;
                                                                            echo $sql_scsr->num_rows;
                                                                        ?>
                                                                    </td>
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
                                        <!-- current_sp -->
                                        <div id="current_sp" class="tab-pane fade in">
                                            <div class="table-responsive" style="overflow-x: hidden; font-size: 1em; width:100%;">
                                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable text-left">
                                                    <thead class="bg-darkblue" style="color: white;">
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Name of SP</th>
                                                            <th>SP Type</th>
                                                            <th>District</th>
                                                            <th>Address</th>
                                                            <th>Contact Person</th>
                                                            <th>Contact Number</th>
                                                            <th>MOA Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $sql = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga");
                                                        if ($sql->num_rows > 0){
                                                            while($row = mysqli_fetch_assoc($sql)) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo($row['id']);?>
                                                                        <input type="hidden" value="<?php echo($row['id']);?>" style="width: 30px; text-align: center; border: none;" readonly>
                                                                    <td><?php echo $row['sp_name'];?></td>
                                                                    <td><?php echo $row['sp_type'];?></td>
                                                                    <td><?php echo $row['sp_pd_address'];?></td>
                                                                    <td><?php echo $row['sp_address'];?></td>
                                                                    <td><?php echo $row['contact_person'];?></td>
                                                                    <td><?php echo $row['contact_num'];?></td>
                                                                    <td><?php echo $row['status'];?></td>
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
                                    </div> <!--End of tab-content-->
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
            // SYSTEM-BASED DB Setup - add a text input to each footer cell
            $('.clientq_today thead tr#systembaseddb_tr2')
                .clone(true)
                .addClass('filters_clientq_today')
                .appendTo('.clientq_today thead');

            var table = $('.clientq_today').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                responsive: true,
                pagination: false,
                ordering: false,
                pageLength: 100,
                buttons: [
                    'excelHtml5'
                ],
                ajax: {
                    url: 'data_home_sw.php',
                    type: 'POST'
                },
                columns: [
                    { data: 'cl_qn' },
                    { data: 'cl_status' },
                    { data: 'cl_lname' },
                    { data: 'cl_fname' },
                    { data: 'cl_mname' },
                    { data: 'cl_nameext' },
                    { data: 'cl_category' },
                    { data: 'bn_lname' },
                    { data: 'bn_fname' },
                    { data: 'bn_mname' },
                    { data: 'bn_nameext' },
                    { data: 'bn_category' },
                    { data: 'date_addedd' },
                    { data: 'assistance_type' },
                    { data: 'remarks' },
                    { data: 'verifier' },
                    { data: 'queue_status' }
                ],
                    rowCallback: function(row, data) {
                        // condition on row bg-color
                        if (data.queue_status == 'SERVED') {
                            $(row).css('background-color', 'lightgreen');
                        } else if (data.queue_status == 'On-going') {
                            $(row).css('background-color', 'orange');
                        } else if (data.queue_status == 'Pending') {
                            $(row).css('background-color', 'navajowhite');
                        } else {}
                    },
                    initComplete: function () {
                        var api = this.api();

                        // For each column
                        api.columns().every(function (colIdx) {
                            var column = this;
                            var header = $('.filters_clientq_today th').eq(column.index());
                            var title = $(header).text();

                            // Replace content with input field
                            $(header).html('<input type="search" placeholder="' + title + '" />');

                            // Bind events for search
                            $('input', header)
                                .off('keyup change')
                                .on('input', function () { // Using 'input' event for real-time input changes
                                    var value = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(value, true, false).draw();
                                });
                        });
                    },
            });

            setInterval(function () {
                table.ajax.reload();
            }, 2000);

            $('#btn_close_served_warning').click(function() {
                $('#served_warning').hide(200);
            });
            $('#btn_close_unsaved').click(function() {
                $('#unsaved_warning').hide(200);
            });

            var table = $('.clientq_today').DataTable();
            $('.clientq_today tbody').on('click', 'tr', function() {
                var data = $('.clientq_today').DataTable().row(this).data();
                $("#cl_qn2").val(data.cl_qn);
                console.log(data.cl_qn);
            });    
        
        });
    </script>

</body>
</html>