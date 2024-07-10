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
    
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname = '".$_SESSION['uname']."' AND pword = '".$_SESSION['pword']."' ");
    $roww = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Home: Verifier</title>
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
                <a class="navbar-brand" href="#" title="Homepage - Verifier Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Verifier Level</a>
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
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs  WHERE staffid='".$roww['staffid']."'");
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
                        <?php
                            $verifier = $row['fname'].' '.substr($row['mname'],0,1).'. '.$row['lname'].' '.$row['nameext'];
                            echo $verifier;
                        ?>
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
                        <a href="home_verifier.php">
                            <span class="glyphicon glyphicon-home"></span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="search_clientV.php">
                            <span class="glyphicon glyphicon-search"></span>
                            <span>Search Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="add_clientV.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span>Add Client</span>
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
                        <?php
                            date_default_timezone_set('Asia/Manila');
                            $date_today = date("Y-m-d 00:00:00");
                            //echo $date_today;
                            $sql_count_prev_clq = mysqli_query($conn, "SELECT * FROM tbl_clientqueue WHERE date_added < '$date_today'");
                            //echo $sql_count_prev_clq->num_rows;
                            if ($sql_count_prev_clq->num_rows > 0){
                                ?>
                                <ul class="nav nav-tabs" style="font-size: 15px;">
                                    <li class="active">
                                        <a href="#empty_queue" data-toggle="tab">
                                            <span class="fa fa-circle" style="color: red;"></span> Empty Previous Queue
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content text-center" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                    <!-- empty queue -->
                                    <div id="empty_queue" class="tab-pane fade in active">
                                        <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                            <div style="text-align: left; padding: 10px; background-color: silver; border-radius: 20px;">
                                                <h4 style="color: red;">IMPORTANT REMINDERS:</h4>
                                                <label>1) Before adding your first client of the day, make sure that the Clients' Queue below is empty (showing 0 result/s).</label><br>
                                                <label>2) If the Clients' Queue below shows 1 or more entries, then you need to empty it first.</label><br>
                                                <label>3) To empty it, kindly click the "Empty Previous Queue" button below.</label><br>
                                                <label>4) After that process, it will display your homepage again with the Clients' Queue below being empty.</label><br>
                                                <label>5) You can now then proceed to Searching and Adding Clients to the queue.</label><br>
                                                <label>6) If it happens that you already added a client without emptying the previous Clients' Queue first, you can either opt to empty the queue immediately and re-enter that previous client's details to the system or keep the queueing as it is and just put a note indicating the correct queueing number for our social workers' reference. The SWOs can then correct the Queueing No. after they have printed all forms.</label>
                                                <button style="margin: auto; display: block;" type="button" class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#btn_empty_queue"><span class="fa fa-circle"></span> Empty Previous Queue</button>
                                            </div><br>
                                            <!-- Modal -->
                                            <div class="modal fade" id="btn_empty_queue" role="dialog" style="text-align: left !important;">
                                                <div class="modal-dialog modal-sm text-center">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title">Empty Previous Queue</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <h5 style="color: red;">Are you sure in emptying the previous queue?</h5>
                                                                <p>This will delete all data of clients previously encoded to the queuing system.</p>
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
                                                                <a href="empty_queue.php" style="float: right;">
                                                                    <button class="btn btn-sm btn-primary btn-block waves-effect" type="button"> Yes <i class="fa fa-check"></i></button>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-striped table-hover clientq-emp dataTable text-left">
                                                <thead class="bg-darkblue" style="color: white;">
                                                    <tr>
                                                        <th>Queueing No.</th>
                                                        <th>Client Status</th>
                                                        <th>Name of Client</th>
                                                        <th>Client Category</th>
                                                        <th>Name of Bene</th>
                                                        <th>Bene Category</th>
                                                        <th>Date/Time of Verification</th>
                                                        <th>Table Assigned</th>
                                                        <th>Seeks Assistance for</th>
                                                        <th>Remarks</th>
                                                        <th>Encoded by</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $cl = mysqli_query($conn, "SELECT * FROM tbl_clientqueue INNER JOIN tbl_assign_table ON tbl_clientqueue.cl_qn = tbl_assign_table.cl_qnn");
                                                    if ($cl->num_rows > 0){
                                                        while($row = mysqli_fetch_assoc($cl)) {
                                                            $cl_qn = $row['cl_qn']; $cl_status = $row['cl_status'];
                                                            $cl_name = $row['cl_lname'].', '.$row['cl_fname'].' '.$row['cl_mname'];
                                                            $cl_category = $row['cl_category'];
                                                            $bn_name = $row['bn_lname'].', '.$row['bn_fname'].' '.$row['bn_mname'];
                                                            $bn_category = $row['bn_category']; $table_num = $row['table_num'];
                                                            $assistance_type = $row['assistance_type']; $remarks = $row['remarks'];
                                                            $verifiedby = $row['verifier']; $queue_status = $row['queue_status'];
                                                            $date_added = date_format(new DateTime($row['date_added']), "M. d, Y");
                                                            $date_added2 = date_format(new DateTime($row['date_added']), "M. d, Y h:i A");
                                                            date_default_timezone_set('Asia/Manila');
                                                            $date_today = date('M. d, Y');
                                                            if ($date_added != $date_today) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $cl_qn; ?></td>
                                                                    <td><?php echo $cl_status; ?></td>
                                                                    <td><?php echo $cl_name; ?></td>
                                                                    <td><?php echo $cl_category; ?></td>
                                                                    <td><?php echo $bn_name; ?></td>
                                                                    <td><?php echo $bn_category; ?></td>
                                                                    <td><?php echo $date_added2; ?></td>
                                                                    <td><?php echo $table_num; ?></td>
                                                                    <td><?php echo $assistance_type; ?></td>
                                                                    <td><?php echo $remarks; ?></td>
                                                                    <td><?php echo $verifiedby; ?></td>
                                                                    <td><?php echo $queue_status; ?></td>
                                                                </tr>
                                                                <?php
                                                            } else {

                                                            }
                                                        }
                                                    } else {

                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!--End of tab-content-->
                                <?php
                            } else {
                                ?>
                                <ul class="nav nav-tabs" style="font-size: 15px;">
                                    <li class="active">
                                        <a href="#todays_clients" data-toggle="tab">
                                            <span class="fa fa-group" style="color: lightgreen;"></span> Today's Clients
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#ttl_clients_encoded" data-toggle="tab">
                                            <span class="fa fa-edit" style="color: lightgreen;"></span> Total Clients Encoded
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
                                            $_SESSION['qn'] = "";
                                            if (isset($_POST['viewGIS'])) {
                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                    $_SESSION['qn'] = mysqli_real_escape_string($conn, $_POST['cl_qn2']);
                                                    header("location: viewGIS.php");
                                                }
                                            }else if (isset($_POST['deleteGIS'])) {
                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                    $qn = mysqli_real_escape_string($conn, $_POST['cl_qn2']);
													echo '<script>confirm("You are about to delete a row in this table! Click OK to continue.")</script>'; 
                                                    $sql_dlt_clq = mysqli_query($conn, "DELETE FROM tbl_clientqueue WHERE cl_qn='$qn' ");
                                                    $sql_asg_tbl = mysqli_query($conn, "DELETE FROM tbl_assign_table WHERE cl_qn='$qn' ");
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
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8 col-xl-8">
                                                <ul class="pager" style="float: left; margin: 10px -20px;">
                                                    <li class="">
                                                        <a href="home_verifier.php">
                                                            <button class="btn btn-xs btn-block waves-effect" type="button"><span class="fa fa-refresh"></span> Refresh</button>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a style="color: white;">
                                                            <button class="btn btn-primary btn-xs btn-block waves-effect" name="viewGIS" type="submit">View GIS <span class="fa fa-eye"></button>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a style="color: white;">
                                                            <button class="btn btn-danger btn-xs btn-block waves-effect" type="button" class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#modal_dlt_gis">Delete <span class="fa fa-remove"></button>
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="modal_dlt_gis" role="dialog">
                                                            <div class="modal-dialog modal-sm text-center">
                                                              <div class="modal-content">
                                                                <div class="modal-header" style="background-color: red; color: white;">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title">Delete Client Entry in Queue</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-sm-12">
                                                                        <div class="panel-body">
                                                                            <h5 style="color: red;">Are you sure in deleting this client entry in the queue?</h5>
                                                                            <p>This will delete all data of this client previously encoded to the queuing system.</p>
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
                                                                                <button class="btn btn-sm btn-primary btn-block waves-effect" name="deleteGIS" type="submit"> Yes <i class="fa fa-check"></i></button>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                        <div class="tbl_dl_queue table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                            <table class="table table-bordered table-striped table-hover clientq dataTable text-left">
                                                <thead class="bg-darkblue" style="color: white;">
                                                    <tr>
                                                        <th>Queueing No.</th>
                                                        <th>Client Status</th>
                                                        <th>Name of Client</th>
                                                        <th>Client Category</th>
                                                        <th>Name of Bene</th>
                                                        <th>Bene Category</th>
                                                        <th>Date</th>
                                                        <th>Time Started</th>
                                                        <th>Table Assigned</th>
                                                        <th>Seeks Assistance for</th>
                                                        <th>Remarks</th>
                                                        <th>Encoded by</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $cl = mysqli_query($conn, "SELECT * FROM tbl_clientqueue INNER JOIN tbl_assign_table ON tbl_clientqueue.cl_qn = tbl_assign_table.cl_qnn ORDER BY cl_qn DESC");
                                                    if ($cl->num_rows > 0){
                                                        while($row = mysqli_fetch_assoc($cl)) {
                                                            $cl_qn = $row['cl_qn']; $cl_status = $row['cl_status'];
                                                            $cl_name = $row['cl_lname'].', '.$row['cl_fname'].' '.$row['cl_mname'];
                                                            $cl_category = $row['cl_category'];
                                                            $bn_name = $row['bn_lname'].', '.$row['bn_fname'].' '.$row['bn_mname'];
                                                            $bn_category = $row['bn_category']; $table_num = $row['table_num'];
                                                            $assistance_type = $row['assistance_type']; $remarks = $row['remarks'];
                                                            $verifiedby = $row['verifier']; $queue_status = $row['queue_status'];
                                                            $time_added = date_format(new DateTime($row['date_added']), "h:i A");
                                                            $date_added = date_format(new DateTime($row['date_added']), "M. d, Y");
                                                            date_default_timezone_set('Asia/Manila');
                                                            $date_today = date('M. d, Y');
                                                            if ($date_added == $date_today) {
                                                                if ($queue_status == "SERVED") {
                                                                    ?>
                                                                    <tr style="background-color: lightgreen;">
                                                                    <?php
                                                                } else if ($queue_status == "On-going") {
                                                                    ?>
                                                                    <tr style="background-color: orange;">
                                                                    <?php
                                                                } else if ($queue_status == "Pending") {
                                                                    ?>
                                                                    <tr style="background-color: navajowhite;">
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                        <td><?php echo $cl_qn; ?></td>
                                                                        <td><?php echo $cl_status; ?></td>
                                                                        <td><?php echo $cl_name; ?></td>
                                                                        <td><?php echo $cl_category; ?></td>
                                                                        <td><?php echo $bn_name; ?></td>
                                                                        <td><?php echo $bn_category; ?></td>
                                                                        <td><?php echo $date_added; ?></td>
                                                                        <td><?php echo $time_added; ?></td>
                                                                        <td><?php echo $table_num; ?></td>
                                                                        <td><?php echo $assistance_type; ?></td>
                                                                        <td><?php echo $remarks; ?></td>
                                                                        <td><?php echo $verifiedby; ?></td>
                                                                        <td><?php echo $queue_status; ?></td>
                                                                    </tr>
                                                                    <?php
                                                            } else {

                                                            }
                                                        }
                                                    } else {

                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Total Clients Encoded -->
                                    <div id="ttl_clients_encoded" class="tab-pane fade in">
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
                                                                    header("location: home_verifier.php");
                                                                }

                                                                if (isset($_POST['refreshDates'])) {
                                                                    $_SESSION['start_date1'] = $_SESSION['start_date2'] = $_SESSION['start_date3'] = $_SESSION['start_date4'] = $_SESSION['start_date5'] = "";
                                                                    header("location: home_verifier.php");
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
                                                                    $sql_ttl_cl_served1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                    if ($sql_ttl_cl_served1->num_rows > 0){
                                                                        while($row_ttl_cl_served1 = mysqli_fetch_assoc($sql_ttl_cl_served1)) {
                                                                            $date_issued1 = date_format(new DateTime($row_ttl_cl_served1['time_end2']), "m/d/Y l");
                                                                        }
                                                                        ?>
                                                                        <td><?php echo $date_issued1; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_med1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                                echo $sql_med1->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_food1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                                echo $sql_food1->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_trans1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                                echo $sql_trans1->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_burial1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                                echo $sql_burial1->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_educ1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                                echo $sql_educ1->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_cash1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
                                                                                echo $sql_cash1->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_all1 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date1' AND time_end2<='$end_date1' AND verifier='$verifier' ");
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
                                                                    $sql_ttl_cl_served2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                    if ($sql_ttl_cl_served2->num_rows > 0){
                                                                        while($row_ttl_cl_served2 = mysqli_fetch_assoc($sql_ttl_cl_served2)) {
                                                                            $date_issued2 = date_format(new DateTime($row_ttl_cl_served2['time_end2']), "m/d/Y l");
                                                                        }
                                                                        ?>
                                                                        <td><?php echo $date_issued2; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_med2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                                echo $sql_med2->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_food2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                                echo $sql_food2->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_trans2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                                echo $sql_trans2->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_burial2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                                echo $sql_burial2->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_educ2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                                echo $sql_educ2->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_cash2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
                                                                                echo $sql_cash2->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_all2 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date2' AND time_end2<='$end_date2' AND verifier='$verifier' ");
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
                                                                    $sql_ttl_cl_served3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                    if ($sql_ttl_cl_served3->num_rows > 0){
                                                                        while($row_ttl_cl_served3 = mysqli_fetch_assoc($sql_ttl_cl_served3)) {
                                                                            $date_issued3 = date_format(new DateTime($row_ttl_cl_served3['time_end2']), "m/d/Y l");
                                                                        }
                                                                        ?>
                                                                        <td><?php echo $date_issued3; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_med3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                                echo $sql_med3->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_food3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                                echo $sql_food3->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_trans3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                                echo $sql_trans3->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_burial3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                                echo $sql_burial3->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_educ3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                                echo $sql_educ3->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_cash3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
                                                                                echo $sql_cash3->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_all3 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date3' AND time_end2<='$end_date3' AND verifier='$verifier' ");
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
                                                                    $sql_ttl_cl_served4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                    if ($sql_ttl_cl_served4->num_rows > 0){
                                                                        while($row_ttl_cl_served4 = mysqli_fetch_assoc($sql_ttl_cl_served4)) {
                                                                            $date_issued4 = date_format(new DateTime($row_ttl_cl_served4['time_end2']), "m/d/Y l");
                                                                        }
                                                                        ?>
                                                                        <td><?php echo $date_issued4; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_med4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                                echo $sql_med4->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_food4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                                echo $sql_food4->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_trans4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                                echo $sql_trans4->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_burial4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                                echo $sql_burial4->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_educ4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                                echo $sql_educ4->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_cash4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
                                                                                echo $sql_cash4->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_all4 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date4' AND time_end2<='$end_date4' AND verifier='$verifier' ");
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
                                                                    $sql_ttl_cl_served5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                    if ($sql_ttl_cl_served5->num_rows > 0){
                                                                        while($row_ttl_cl_served5 = mysqli_fetch_assoc($sql_ttl_cl_served5)) {
                                                                            $date_issued5 = date_format(new DateTime($row_ttl_cl_served5['time_end2']), "m/d/Y l");
                                                                        }
                                                                        ?>
                                                                        <td><?php echo $date_issued5; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_med5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                                echo $sql_med5->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_food5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                                echo $sql_food5->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_trans5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                                echo $sql_trans5->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_burial5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                                echo $sql_burial5->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_educ5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                                echo $sql_educ5->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_cash5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
                                                                                echo $sql_cash5->num_rows;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $sql_all5 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cancellation!='YES' AND time_end2>='$start_date5' AND time_end2<='$end_date5' AND verifier='$verifier' ");
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
                                <?php
                            }
                        ?>
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
        });
        $('.clientq-emp').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'excelHtml5'
            ],
            paging: false
        });
        $('.clientq').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            ordering: false,
            buttons: [
                'excelHtml5'
            ],
            paging: false
        });
        var table = $('.clientq').DataTable();
        $('.clientq tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            $("#cl_qn2").val(data[0]);
            console.log(data[0]);
        });
    </script>

</body>
</html>