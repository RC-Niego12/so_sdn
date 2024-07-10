<?php
    // Start the session
    session_start();
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
    <title>Home - Billings</title>
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
                <a class="navbar-brand" href="#" title="Home - Billings Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Billings Level</a>
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
                    <li class="active">
                        <a href="home_billings.php">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="track_GLs.php">
                            <span class="fa fa-file"></span>
                            <span>Track GLs</span>
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
                                    <a href="#1" data-toggle="tab">
                                        <span class="fa fa-file"></span> #1
                                    </a>
                                </li>
                                <li>
                                    <a href="#2" data-toggle="tab">
                                        <span class="fa fa-file" style="color: lightgreen;"></span> #2
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- 1 -->
                                <div id="1" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <div class="">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                                    <div class="panel-heading panel-title bg-darkblue"> 
                                                        <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Select Range of Date</h5>
                                                    </div><br>
                                                    <div class="clearfix">
                                                        <?php
                                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                $_SESSION['start_date'] = $_SESSION['end_date'] = "";
                                                                if (isset($_POST['getDates'])) {
                                                                    $_SESSION['start_date'] = mysqli_real_escape_string($conn, $_POST['start_date']);
                                                                    $_SESSION['end_date'] = mysqli_real_escape_string($conn, $_POST['end_date']);
                                                                    header("location: home_billings.php");
                                                                }

                                                                if (isset($_POST['refreshDates'])) {
                                                                    $_SESSION['start_date'] = "";
                                                                    $_SESSION['end_date'] = "";
                                                                    header("location: home_billings.php");
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
                                        </div><hr>
                                        <table class="table table-bordered table-striped table-hover statsreport1 dataTable text-left">
                                            <thead>
                                                <tr>
                                                    <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                                    <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="border: none;">DEPARTMENT_OF_SOCIAL_WELFARE_AND_DEVELOPMENT</td>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;">FIELD OFFICE CARAGA - REGION XIII</td>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;">CRISIS INTERVENTION UNIT</td>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;">Province of Surigao del Norte-II</td>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                </tr>
                                                <?php
                                                    $start_date = date_format(new DateTime($_SESSION['start_date']), "Y-m-d 00:00:01");
                                                    $end_date = date_format(new DateTime($_SESSION['end_date']), "Y-m-d 23:59:59");
                                                    $start_date2 = date_format(new DateTime($_SESSION['start_date']), "M. d, Y");
                                                    $end_date2 = date_format(new DateTime($_SESSION['end_date']), "M. d, Y");

                                                    if ((empty($_SESSION['start_date'])) && (empty($_SESSION['end_date']))) {

                                                    } else {
                                                       // echo 'DATES: '.$start_date.' '.$end_date;
                                                    ?>
                                                    <tr>
                                                        <td style="border: none;">For the Period of <?php echo $start_date2.' - '.$end_date2; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <!-- TABLE 1 -->
                                                    <tr>
                                                        <td style="border: none; text-align: left;">Table 1: Summary of Assistance Provided with Cost, Client Category and Age Group</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #336666; color: white;">Client_Category</td>
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <td style="background-color: lightgreen;">Cost</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                <!-- TABLE 1: FHONA -->
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Family_Head_and_Other_Needy_Adult_(FHONA)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_fhona_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_fhona_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_fhona = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_fhona_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='FHONA' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_fhona_amt = 0;
                                                                while($row_fhona_amt = mysqli_fetch_assoc($sql_fhona_amt)) {
                                                                    $ttl_fhona_amt = $ttl_fhona_amt + $row_fhona_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_fhona_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 to 29</td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_m_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_m_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_f_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_f_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_18to29_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='FHONA' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_fhona_18to29_amt = 0;
                                                                while($row_fhona_18to29_amt = mysqli_fetch_assoc($sql_fhona_18to29_amt)) {
                                                                    $ttl_fhona_18to29_amt = $ttl_fhona_18to29_amt + $row_fhona_18to29_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_fhona_18to29_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>30 to 44</td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_m_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_m_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_f_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_f_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_30to44_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='FHONA' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_fhona_30to44_amt = 0;
                                                                while($row_fhona_30to44_amt = mysqli_fetch_assoc($sql_fhona_30to44_amt)) {
                                                                    $ttl_fhona_30to44_amt = $ttl_fhona_30to44_amt + $row_fhona_30to44_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_fhona_30to44_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>45 to 59</td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_m_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_m_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_f_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_f_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='FHONA' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_fhona_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_fhona_45to59_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='FHONA' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_fhona_45to59_amt = 0;
                                                                while($row_fhona_45to59_amt = mysqli_fetch_assoc($sql_fhona_45to59_amt)) {
                                                                    $ttl_fhona_45to59_amt = $ttl_fhona_45to59_amt + $row_fhona_45to59_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_fhona_45to59_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 1: WEDC -->
                                                    <?php ?>
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Men/Women in Especially Difficult Circumstances (WEDC)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_wedc_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_wedc_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_wedc = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_wedc_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='WEDC' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_wedc_amt = 0;
                                                                while($row_wedc_amt = mysqli_fetch_assoc($sql_wedc_amt)) {
                                                                    $ttl_wedc_amt = $ttl_wedc_amt + $row_wedc_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_wedc_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 to 29</td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_m_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_m_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_f_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_f_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_18to29_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='WEDC' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_wedc_18to29_amt = 0;
                                                                while($row_wedc_18to29_amt = mysqli_fetch_assoc($sql_wedc_18to29_amt)) {
                                                                    $ttl_wedc_18to29_amt = $ttl_wedc_18to29_amt + $row_wedc_18to29_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_wedc_18to29_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>30 to 44</td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_m_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_m_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_f_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_f_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_30to44_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='WEDC' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_wedc_30to44_amt = 0;
                                                                while($row_wedc_30to44_amt = mysqli_fetch_assoc($sql_wedc_30to44_amt)) {
                                                                    $ttl_wedc_30to44_amt = $ttl_wedc_30to44_amt + $row_wedc_30to44_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_wedc_30to44_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>45 to 59</td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_m_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_m_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_f_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_f_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='WEDC' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_wedc_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_wedc_45to59_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='WEDC' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_wedc_45to59_amt = 0;
                                                                while($row_wedc_45to59_amt = mysqli_fetch_assoc($sql_wedc_45to59_amt)) {
                                                                    $ttl_wedc_45to59_amt = $ttl_wedc_45to59_amt + $row_wedc_45to59_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_wedc_45to59_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 1: CNSP -->
                                                    <?php ?>
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Children in Need of Special Protection (CNSP)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_cnsp_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_cnsp_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_cnsp = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_cnsp_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='CNSP' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_cnsp_amt = 0;
                                                                while($row_cnsp_amt = mysqli_fetch_assoc($sql_cnsp_amt)) {
                                                                    $ttl_cnsp_amt = $ttl_cnsp_amt + $row_cnsp_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_cnsp_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0 to 13</td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_0to13_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='CNSP' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_cnsp_0to13_amt = 0;
                                                                while($row_cnsp_0to13_amt = mysqli_fetch_assoc($sql_cnsp_0to13_amt)) {
                                                                    $ttl_cnsp_0to13_amt = $ttl_cnsp_0to13_amt + $row_cnsp_0to13_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_cnsp_0to13_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>14 to 17</td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='CNSP' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cnsp_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cnsp_14to17_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='CNSP' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_cnsp_14to17_amt = 0;
                                                                while($row_cnsp_14to17_amt = mysqli_fetch_assoc($sql_cnsp_14to17_amt)) {
                                                                    $ttl_cnsp_14to17_amt = $ttl_cnsp_14to17_amt + $row_cnsp_14to17_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_cnsp_14to17_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 1: YNSP -->
                                                    <?php ?>
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Youth in Need of Special Protection (YNSP)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_ynsp_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='YNSP' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_ynsp_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_ynsp_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='YNSP' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_ynsp_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_ynsp = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='YNSP' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_ynsp->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_ynsp_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='YNSP' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_ynsp_amt = 0;
                                                                while($row_ynsp_amt = mysqli_fetch_assoc($sql_ynsp_amt)) {
                                                                    $ttl_ynsp_amt = $ttl_ynsp_amt + $row_ynsp_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_ynsp_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 to 30</td>
                                                        <td>
                                                            <?php
                                                                $sql_ynsp_m_18to30 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='YNSP' AND cl_sex='M' AND cl_age>=18 AND cl_age<=30 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_ynsp_m_18to30->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_ynsp_f_18to30 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='YNSP' AND cl_sex='F' AND cl_age>=18 AND cl_age<=30 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_ynsp_f_18to30->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_ynsp_18to30 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='YNSP' AND cl_age>=18 AND cl_age<=30 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_ynsp_18to30->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_ynsp_18to30_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='YNSP' AND cl_age>=18 AND cl_age<=30 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_ynsp_18to30_amt = 0;
                                                                while($row_ynsp_18to30_amt = mysqli_fetch_assoc($sql_ynsp_18to30_amt)) {
                                                                    $ttl_ynsp_18to30_amt = $ttl_ynsp_18to30_amt + $row_ynsp_18to30_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_ynsp_18to30_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 1: SC -->
                                                    <?php ?>
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Senior Citizen (SC)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_sc_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_sc_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_sc = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_sc_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='SC' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_sc_amt = 0;
                                                                while($row_sc_amt = mysqli_fetch_assoc($sql_sc_amt)) {
                                                                    $ttl_sc_amt = $ttl_sc_amt + $row_sc_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_sc_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>60 to 70</td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_m_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_m_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_f_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_f_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_60to70_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='SC' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_sc_60to70_amt = 0;
                                                                while($row_sc_60to70_amt = mysqli_fetch_assoc($sql_sc_60to70_amt)) {
                                                                    $ttl_sc_60to70_amt = $ttl_sc_60to70_amt + $row_sc_60to70_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_sc_60to70_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>71 to 79</td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_m_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_m_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_f_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_f_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_71to79_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='SC' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_sc_71to79_amt = 0;
                                                                while($row_sc_71to79_amt = mysqli_fetch_assoc($sql_sc_71to79_amt)) {
                                                                    $ttl_sc_71to79_amt = $ttl_sc_71to79_amt + $row_sc_71to79_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_sc_71to79_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>80 and above</td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_m_80andAbove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_m_80andAbove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_f_80andAbove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_f_80andAbove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_80andAbove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='SC' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_sc_80andAbove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_sc_80andAbove_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='SC' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_sc_80andAbove_amt = 0;
                                                                while($row_sc_80andAbove_amt = mysqli_fetch_assoc($sql_sc_80andAbove_amt)) {
                                                                    $ttl_sc_80andAbove_amt = $ttl_sc_80andAbove_amt + $row_sc_80andAbove_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_sc_80andAbove_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 1: PWD -->
                                                    <?php ?>
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Persons With Disability (PWD)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_pwd_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_pwd_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_pwd = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_pwd_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_amt = 0;
                                                                while($row_pwd_amt = mysqli_fetch_assoc($sql_pwd_amt)) {
                                                                    $ttl_pwd_amt = $ttl_pwd_amt + $row_pwd_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0 to 13</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_0to13_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_0to13_amt = 0;
                                                                while($row_pwd_0to13_amt = mysqli_fetch_assoc($sql_pwd_0to13_amt)) {
                                                                    $ttl_pwd_0to13_amt = $ttl_pwd_0to13_amt + $row_pwd_0to13_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_0to13_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>14 to 17</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_14to17_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_14to17_amt = 0;
                                                                while($row_pwd_14to17_amt = mysqli_fetch_assoc($sql_pwd_14to17_amt)) {
                                                                    $ttl_pwd_14to17_amt = $ttl_pwd_14to17_amt + $row_pwd_14to17_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_14to17_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 to 29</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_18to29_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_18to29_amt = 0;
                                                                while($row_pwd_18to29_amt = mysqli_fetch_assoc($sql_pwd_18to29_amt)) {
                                                                    $ttl_pwd_18to29_amt = $ttl_pwd_18to29_amt + $row_pwd_18to29_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_18to29_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>30 to 44</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_30to44_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_30to44_amt = 0;
                                                                while($row_pwd_30to44_amt = mysqli_fetch_assoc($sql_pwd_30to44_amt)) {
                                                                    $ttl_pwd_30to44_amt = $ttl_pwd_30to44_amt + $row_pwd_30to44_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_30to44_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>45 to 59</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_45to59_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_45to59_amt = 0;
                                                                while($row_pwd_45to59_amt = mysqli_fetch_assoc($sql_pwd_45to59_amt)) {
                                                                    $ttl_pwd_45to59_amt = $ttl_pwd_45to59_amt + $row_pwd_45to59_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_45to59_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>60 to 70</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_60to70_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_60to70_amt = 0;
                                                                while($row_pwd_60to70_amt = mysqli_fetch_assoc($sql_pwd_60to70_amt)) {
                                                                    $ttl_pwd_60to70_amt = $ttl_pwd_60to70_amt + $row_pwd_60to70_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_60to70_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>71 to 79</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_71to79_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_71to79_amt = 0;
                                                                while($row_pwd_71to79_amt = mysqli_fetch_assoc($sql_pwd_71to79_amt)) {
                                                                    $ttl_pwd_71to79_amt = $ttl_pwd_71to79_amt + $row_pwd_71to79_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_71to79_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>80 and above</td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PWD' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_pwd_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_pwd_80andabove_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PWD' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_pwd_80andabove_amt = 0;
                                                                while($row_pwd_80andabove_amt = mysqli_fetch_assoc($sql_pwd_80andabove_amt)) {
                                                                    $ttl_pwd_80andabove_amt = $ttl_pwd_80andabove_amt + $row_pwd_80andabove_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_pwd_80andabove_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 1: PLHIV -->
                                                    <?php ?>
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: #80df38;">Persons Living with HIV-AIDS (PLHIV)</td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_plhiv_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_plhiv_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_plhiv = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: #80df38;">
                                                            <?php
                                                                $sql_plhiv_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_amt = 0;
                                                                while($row_plhiv_amt = mysqli_fetch_assoc($sql_plhiv_amt)) {
                                                                    $ttl_plhiv_amt = $ttl_plhiv_amt + $row_plhiv_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0 to 13</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_0to13_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_0to13_amt = 0;
                                                                while($row_plhiv_0to13_amt = mysqli_fetch_assoc($sql_plhiv_0to13_amt)) {
                                                                    $ttl_plhiv_0to13_amt = $ttl_plhiv_0to13_amt + $row_plhiv_0to13_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_0to13_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>14 to 17</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_14to17_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_14to17_amt = 0;
                                                                while($row_plhiv_14to17_amt = mysqli_fetch_assoc($sql_plhiv_14to17_amt)) {
                                                                    $ttl_plhiv_14to17_amt = $ttl_plhiv_14to17_amt + $row_plhiv_14to17_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_14to17_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 to 29</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_18to29_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_18to29_amt = 0;
                                                                while($row_plhiv_18to29_amt = mysqli_fetch_assoc($sql_plhiv_18to29_amt)) {
                                                                    $ttl_plhiv_18to29_amt = $ttl_plhiv_18to29_amt + $row_plhiv_18to29_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_18to29_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>30 to 44</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_30to44_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_30to44_amt = 0;
                                                                while($row_plhiv_30to44_amt = mysqli_fetch_assoc($sql_plhiv_30to44_amt)) {
                                                                    $ttl_plhiv_30to44_amt = $ttl_plhiv_30to44_amt + $row_plhiv_30to44_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_30to44_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>45 to 59</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_45to59_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_45to59_amt = 0;
                                                                while($row_plhiv_45to59_amt = mysqli_fetch_assoc($sql_plhiv_45to59_amt)) {
                                                                    $ttl_plhiv_45to59_amt = $ttl_plhiv_45to59_amt + $row_plhiv_45to59_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_45to59_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>60 to 70</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_60to70_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_60to70_amt = 0;
                                                                while($row_plhiv_60to70_amt = mysqli_fetch_assoc($sql_plhiv_60to70_amt)) {
                                                                    $ttl_plhiv_60to70_amt = $ttl_plhiv_60to70_amt + $row_plhiv_60to70_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_60to70_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>71 to 79</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_m_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_m_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_f_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_f_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_71to79_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_71to79_amt = 0;
                                                                while($row_plhiv_71to79_amt = mysqli_fetch_assoc($sql_plhiv_71to79_amt)) {
                                                                    $ttl_plhiv_71to79_amt = $ttl_plhiv_71to79_amt + $row_plhiv_71to79_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_71to79_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>80 and above</td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_category='PLHIV' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_plhiv_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_plhiv_80andabove_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_category='PLHIV' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_plhiv_80andabove_amt = 0;
                                                                while($row_plhiv_80andabove_amt = mysqli_fetch_assoc($sql_plhiv_80andabove_amt)) {
                                                                    $ttl_plhiv_80andabove_amt = $ttl_plhiv_80andabove_amt + $row_plhiv_80andabove_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_plhiv_80andabove_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <!-- TABLE 1: GRAND TOTAL -->
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: yellow;">GRAND TOTAL</td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene WHERE time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_amt = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_amt = 0;
                                                                while($row_amt = mysqli_fetch_assoc($sql_amt)) {
                                                                    $ttl_amt = $ttl_amt + $row_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 2 -->
                                                    <tr>
                                                        <td style="background-color: white; border: none; text-align: left;">Table 2: Clients Served with Cost</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #336666; color: white;">Assistance Provided</td>
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <td style="background-color: lightgreen;">Cost</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Educational Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_educ_assistance_amt = 0;
                                                                while($row_educ_assistance_amt = mysqli_fetch_assoc($sql_educ_assistance)) {
                                                                    $ttl_educ_assistance_amt = $ttl_educ_assistance_amt + $row_educ_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_educ_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Medical Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_med_assistance_amt = 0;
                                                                while($row_med_assistance_amt = mysqli_fetch_assoc($sql_med_assistance)) {
                                                                    $ttl_med_assistance_amt = $ttl_med_assistance_amt + $row_med_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_med_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transportation Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_trans_assistance_amt = 0;
                                                                while($row_trans_assistance_amt = mysqli_fetch_assoc($sql_trans_assistance)) {
                                                                    $ttl_trans_assistance_amt = $ttl_trans_assistance_amt + $row_trans_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_trans_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Burial Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_burial_assistance_amt = 0;
                                                                while($row_burial_assistance_amt = mysqli_fetch_assoc($sql_burial_assistance)) {
                                                                    $ttl_burial_assistance_amt = $ttl_burial_assistance_amt + $row_burial_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_burial_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Food Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_food_assistance_amt = 0;
                                                                while($row_food_assistance_amt = mysqli_fetch_assoc($sql_food_assistance)) {
                                                                    $ttl_food_assistance_amt = $ttl_food_assistance_amt + $row_food_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_food_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Non-Food Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_nonfood_assistance_amt = 0;
                                                                while($row_nonfood_assistance_amt = mysqli_fetch_assoc($sql_nonfood_assistance)) {
                                                                    $ttl_nonfood_assistance_amt = $ttl_nonfood_assistance_amt + $row_nonfood_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_nonfood_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other Cash Assistance</td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $ttl_cash_assistance_amt = 0;
                                                                while($row_cash_assistance_amt = mysqli_fetch_assoc($sql_cash_assistance)) {
                                                                    $ttl_cash_assistance_amt = $ttl_cash_assistance_amt + $row_cash_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_cash_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Psychosocial</td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_m = 0;
                                                                while($row_psychosocial_m = mysqli_fetch_assoc($sql_psychosocial_m)) {
                                                                    $psycho_support_m = $row_psychosocial_m['psycho_support'];
                                                                    if (!empty($psycho_support_m)) {
                                                                        $ttl_psycho_support_m = $ttl_psycho_support_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_m = $ttl_psycho_support_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_f = 0;
                                                                while($row_psychosocial_f = mysqli_fetch_assoc($sql_psychosocial_f)) {
                                                                    $psycho_support_f = $row_psychosocial_f['psycho_support'];
                                                                    if (!empty($psycho_support_f)) {
                                                                        $ttl_psycho_support_f = $ttl_psycho_support_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_f = $ttl_psycho_support_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support = 0; $ttl_psycho_support_amt = 0;
                                                                while($row_psychosocial = mysqli_fetch_assoc($sql_psychosocial)) {
                                                                    $psycho_support = $row_psychosocial['psycho_support'];
                                                                    if (!empty($psycho_support)) {
                                                                        $ttl_psycho_support = $ttl_psycho_support + 1;
                                                                        $ttl_psycho_support_amt = $ttl_psycho_support_amt + $row_psychosocial['amount_in_figures'];
                                                                    } else {
                                                                        $ttl_psycho_support = $ttl_psycho_support + 0;
                                                                        $ttl_psycho_support_amt = $ttl_psycho_support_amt + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support;
                                                            ?>
                                                        </td>
                                                        <td><?php echo "&#8369;".number_format($ttl_psycho_support_amt,2); ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Referral</td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_m = 0;
                                                                while($row_referral_m = mysqli_fetch_assoc($sql_referral_m)) {
                                                                    $referral_m = $row_referral_m['referral'];
                                                                    if ((empty($referral_m))||($referral_m=='N/A')||($referral_m=='n/a')) {
                                                                        $ttl_referral_m = $ttl_referral_m + 0;
                                                                    } else {
                                                                        $ttl_referral_m = $ttl_referral_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_f = 0;
                                                                while($row_referral_f = mysqli_fetch_assoc($sql_referral_f)) {
                                                                    $referral_f = $row_referral_f['referral'];
                                                                    if ((empty($referral_f))||($referral_f=='N/A')||($referral_f=='n/a')) {
                                                                        $ttl_referral_f = $ttl_referral_f + 0;
                                                                    } else {
                                                                        $ttl_referral_f = $ttl_referral_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral = 0; $ttl_referral_amt = 0;
                                                                while($row_referral = mysqli_fetch_assoc($sql_referral)) {
                                                                    $referral = $row_referral['referral'];
                                                                    if ((empty($referral))||($referral=='N/A')||($referral=='n/a')) {
                                                                        $ttl_referral = $ttl_referral + 0;
                                                                        $ttl_referral_amt = $ttl_referral_amt + 0;
                                                                    } else {
                                                                        $ttl_referral = $ttl_referral + 1;
                                                                        $ttl_referral_amt = $ttl_referral_amt + $row_referral['amount_in_figures'];
                                                                    }
                                                                }
                                                                echo $ttl_referral;
                                                            ?>
                                                        </td>
                                                        <td><?php echo "&#8369;".number_format($ttl_referral_amt,2); ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <!-- TABLE 2: GRAND TOTAL -->
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: yellow;">GRAND TOTAL (except Psychosocial & Referral)</td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_assistance_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_assistance_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_assistance = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_assistance->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $ttl_assistance_amt = 0;
                                                                while($row_assistance_amt = mysqli_fetch_assoc($sql_assistance)) {
                                                                    $ttl_assistance_amt = $ttl_assistance_amt + $row_assistance_amt['amount_in_figures'];
                                                                }
                                                                echo "&#8369;".number_format($ttl_assistance_amt,2);
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 3 -->
                                                    <tr>
                                                        <td style="background-color: white; border: none; text-align: left;">Table 3: Clients Served per Client Category</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #336666; color: white;">Client Category</td>
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Family Head and Other Needy Adult (FHONA)</td>
                                                        <td><?php echo $sql_fhona_m->num_rows; ?></td>
                                                        <td><?php echo $sql_fhona_f->num_rows; ?></td>
                                                        <td><?php echo $sql_fhona->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Men/Women in Especially Difficult Circumstances (WEDC)</td>
                                                        <td><?php echo $sql_wedc_m->num_rows; ?></td>
                                                        <td><?php echo $sql_wedc_f->num_rows; ?></td>
                                                        <td><?php echo $sql_wedc->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Children in Need of Special Protection (CNSP)</td>
                                                        <td><?php echo $sql_cnsp_m->num_rows; ?></td>
                                                        <td><?php echo $sql_cnsp_f->num_rows; ?></td>
                                                        <td><?php echo $sql_cnsp->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Youth in Need of Special Protection (YNSP)</td>
                                                        <td><?php echo $sql_ynsp_m->num_rows; ?></td>
                                                        <td><?php echo $sql_ynsp_f->num_rows; ?></td>
                                                        <td><?php echo $sql_ynsp->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Senior Citizen (SC)</td>
                                                        <td><?php echo $sql_sc_m->num_rows; ?></td>
                                                        <td><?php echo $sql_sc_f->num_rows; ?></td>
                                                        <td><?php echo $sql_sc->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Persons With Disability (PWD)</td>
                                                        <td><?php echo $sql_pwd_m->num_rows; ?></td>
                                                        <td><?php echo $sql_pwd_f->num_rows; ?></td>
                                                        <td><?php echo $sql_pwd->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Persons Living with HIV-AIDS (PLHIV)</td>
                                                        <td><?php echo $sql_plhiv_m->num_rows; ?></td>
                                                        <td><?php echo $sql_plhiv_f->num_rows; ?></td>
                                                        <td><?php echo $sql_plhiv->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <!-- TABLE 3: GRAND TOTAL -->
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: yellow;">GRAND TOTAL</td>
                                                        <td style="background-color: yellow;"><?php echo $sql_m->num_rows; ?></td>
                                                        <td style="background-color: yellow;"><?php echo $sql_f->num_rows; ?></td>
                                                        <td style="background-color: yellow;"><?php echo $sql->num_rows; ?></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 4 -->
                                                    <tr>
                                                        <td style="background-color: white; border: none; text-align: left;">Table 4: Clients Served per Age Group</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #336666; color: white;">TYPE OF ASSISTANCE</td>
                                                        <td style="background-color: #336666; color: white;">0_to_13</td>
                                                        <td style="background-color: #336666; color: white;">0_to_13</td>
                                                        <td style="background-color: #336666; color: white;">0_to_13</td>

                                                        <td style="background-color: #336666; color: white;">14_to_17</td>
                                                        <td style="background-color: #336666; color: white;">14_to_17</td>
                                                        <td style="background-color: #336666; color: white;">14_to_17</td>

                                                        <td style="background-color: #336666; color: white;">18_to_29</td>
                                                        <td style="background-color: #336666; color: white;">18_to_29</td>
                                                        <td style="background-color: #336666; color: white;">18_to_29</td>

                                                        <td style="background-color: #336666; color: white;">30_to_44</td>
                                                        <td style="background-color: #336666; color: white;">30_to_44</td>
                                                        <td style="background-color: #336666; color: white;">30_to_44</td>

                                                        <td style="background-color: #336666; color: white;">45_to_59</td>
                                                        <td style="background-color: #336666; color: white;">45_to_59</td>
                                                        <td style="background-color: #336666; color: white;">45_to_59</td>

                                                        <td style="background-color: #336666; color: white;">60_to_70</td>
                                                        <td style="background-color: #336666; color: white;">60_to_70</td>
                                                        <td style="background-color: #336666; color: white;">60_to_70</td>

                                                        <td style="background-color: #336666; color: white;">71_to_79</td>
                                                        <td style="background-color: #336666; color: white;">71_to_79</td>
                                                        <td style="background-color: #336666; color: white;">71_to_79</td>

                                                        <td style="background-color: #336666; color: white;">80_and_above</td>
                                                        <td style="background-color: #336666; color: white;">80_and_above</td>
                                                        <td style="background-color: #336666; color: white;">80_and_above</td>

                                                        <td style="background-color: #336666; color: white;">Grand_Total</td>
                                                    </tr>
                                                    <tr>
                                                        <!-- 0 to 13 -->
                                                        <td></td>
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 14 to 17 -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 18 to 29 -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 30 to 44 -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 45 to 59 -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 60 to 70 -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 71 to 79 -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- 80 and above -->
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <!-- Grand Total -->
                                                        <td style="background-color: aliceblue;">Total</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Educational Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_educ_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='EDUCATIONAL' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_educ_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_educ_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Medical Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_med_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='MEDICAL' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_med_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_med_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transportation Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_trans_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='TRANSPORTATION' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_trans_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_trans_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Burial Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_burial_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='BURIAL' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_burial_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_burial_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Food Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_food_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='FOOD' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_food_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_food_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Non-Food Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_nonfood_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='NON-FOOD' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_nonfood_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_nonfood_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other Cash Assistance</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_cash_assistance_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE assistance_type='CASH' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_cash_assistance_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_cash_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Psychosocial</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_0to13_m = 0;
                                                                while($row_psychosocial_0to13_m = mysqli_fetch_assoc($sql_psychosocial_0to13_m)) {
                                                                    $psycho_support_0to13_m = $row_psychosocial_0to13_m['psycho_support'];
                                                                    if (!empty($psycho_support_0to13_m)) {
                                                                        $ttl_psycho_support_0to13_m = $ttl_psycho_support_0to13_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_0to13_m = $ttl_psycho_support_0to13_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_0to13_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_0to13_f = 0;
                                                                while($row_psychosocial_0to13_f = mysqli_fetch_assoc($sql_psychosocial_0to13_f)) {
                                                                    $psycho_support_0to13_f = $row_psychosocial_0to13_f['psycho_support'];
                                                                    if (!empty($psycho_support_0to13_f)) {
                                                                        $ttl_psycho_support_0to13_f = $ttl_psycho_support_0to13_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_0to13_f = $ttl_psycho_support_0to13_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_0to13_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_0to13 = 0;
                                                                while($row_psychosocial_0to13 = mysqli_fetch_assoc($sql_psychosocial_0to13)) {
                                                                    $psycho_support_0to13 = $row_psychosocial_0to13['psycho_support'];
                                                                    if (!empty($psycho_support_0to13)) {
                                                                        $ttl_psycho_support_0to13 = $ttl_psycho_support_0to13 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_0to13 = $ttl_psycho_support_0to13 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_0to13;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_14to17_m = 0;
                                                                while($row_psychosocial_14to17_m = mysqli_fetch_assoc($sql_psychosocial_14to17_m)) {
                                                                    $psycho_support_14to17_m = $row_psychosocial_14to17_m['psycho_support'];
                                                                    if (!empty($psycho_support_14to17_m)) {
                                                                        $ttl_psycho_support_14to17_m = $ttl_psycho_support_14to17_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_14to17_m = $ttl_psycho_support_14to17_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_14to17_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_14to17_f = 0;
                                                                while($row_psychosocial_14to17_f = mysqli_fetch_assoc($sql_psychosocial_14to17_f)) {
                                                                    $psycho_support_14to17_f = $row_psychosocial_14to17_f['psycho_support'];
                                                                    if (!empty($psycho_support_14to17_f)) {
                                                                        $ttl_psycho_support_14to17_f = $ttl_psycho_support_14to17_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_14to17_f = $ttl_psycho_support_14to17_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_14to17_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_14to17 = 0;
                                                                while($row_psychosocial_14to17 = mysqli_fetch_assoc($sql_psychosocial_14to17)) {
                                                                    $psycho_support_14to17 = $row_psychosocial_14to17['psycho_support'];
                                                                    if (!empty($psycho_support_14to17)) {
                                                                        $ttl_psycho_support_14to17 = $ttl_psycho_support_14to17 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_14to17 = $ttl_psycho_support_14to17 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_14to17;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_18to29_m = 0;
                                                                while($row_psychosocial_18to29_m = mysqli_fetch_assoc($sql_psychosocial_18to29_m)) {
                                                                    $psycho_support_18to29_m = $row_psychosocial_18to29_m['psycho_support'];
                                                                    if (!empty($psycho_support_18to29_m)) {
                                                                        $ttl_psycho_support_18to29_m = $ttl_psycho_support_18to29_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_18to29_m = $ttl_psycho_support_18to29_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_18to29_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_18to29_f = 0;
                                                                while($row_psychosocial_18to29_f = mysqli_fetch_assoc($sql_psychosocial_18to29_f)) {
                                                                    $psycho_support_18to29_f = $row_psychosocial_18to29_f['psycho_support'];
                                                                    if (!empty($psycho_support_18to29_f)) {
                                                                        $ttl_psycho_support_18to29_f = $ttl_psycho_support_18to29_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_18to29_f = $ttl_psycho_support_18to29_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_18to29_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_18to29 = 0;
                                                                while($row_psychosocial_18to29 = mysqli_fetch_assoc($sql_psychosocial_18to29)) {
                                                                    $psycho_support_18to29 = $row_psychosocial_18to29['psycho_support'];
                                                                    if (!empty($psycho_support_18to29)) {
                                                                        $ttl_psycho_support_18to29 = $ttl_psycho_support_18to29 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_18to29 = $ttl_psycho_support_18to29 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_18to29;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_30to44_m = 0;
                                                                while($row_psychosocial_30to44_m = mysqli_fetch_assoc($sql_psychosocial_30to44_m)) {
                                                                    $psycho_support_30to44_m = $row_psychosocial_30to44_m['psycho_support'];
                                                                    if (!empty($psycho_support_30to44_m)) {
                                                                        $ttl_psycho_support_30to44_m = $ttl_psycho_support_30to44_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_30to44_m = $ttl_psycho_support_30to44_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_30to44_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_30to44_f = 0;
                                                                while($row_psychosocial_30to44_f = mysqli_fetch_assoc($sql_psychosocial_30to44_f)) {
                                                                    $psycho_support_30to44_f = $row_psychosocial_30to44_f['psycho_support'];
                                                                    if (!empty($psycho_support_30to44_f)) {
                                                                        $ttl_psycho_support_30to44_f = $ttl_psycho_support_30to44_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_30to44_f = $ttl_psycho_support_30to44_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_30to44_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_30to44 = 0;
                                                                while($row_psychosocial_30to44 = mysqli_fetch_assoc($sql_psychosocial_30to44)) {
                                                                    $psycho_support_30to44 = $row_psychosocial_30to44['psycho_support'];
                                                                    if (!empty($psycho_support_30to44)) {
                                                                        $ttl_psycho_support_30to44 = $ttl_psycho_support_30to44 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_30to44 = $ttl_psycho_support_30to44 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_30to44;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_45to59_m = 0;
                                                                while($row_psychosocial_45to59_m = mysqli_fetch_assoc($sql_psychosocial_45to59_m)) {
                                                                    $psycho_support_45to59_m = $row_psychosocial_45to59_m['psycho_support'];
                                                                    if (!empty($psycho_support_45to59_m)) {
                                                                        $ttl_psycho_support_45to59_m = $ttl_psycho_support_45to59_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_45to59_m = $ttl_psycho_support_45to59_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_45to59_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_45to59_f = 0;
                                                                while($row_psychosocial_45to59_f = mysqli_fetch_assoc($sql_psychosocial_45to59_f)) {
                                                                    $psycho_support_45to59_f = $row_psychosocial_45to59_f['psycho_support'];
                                                                    if (!empty($psycho_support_45to59_f)) {
                                                                        $ttl_psycho_support_45to59_f = $ttl_psycho_support_45to59_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_45to59_f = $ttl_psycho_support_45to59_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_45to59_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_45to59 = 0;
                                                                while($row_psychosocial_45to59 = mysqli_fetch_assoc($sql_psychosocial_45to59)) {
                                                                    $psycho_support_45to59 = $row_psychosocial_45to59['psycho_support'];
                                                                    if (!empty($psycho_support_45to59)) {
                                                                        $ttl_psycho_support_45to59 = $ttl_psycho_support_45to59 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_45to59 = $ttl_psycho_support_45to59 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_45to59;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_60to70_m = 0;
                                                                while($row_psychosocial_60to70_m = mysqli_fetch_assoc($sql_psychosocial_60to70_m)) {
                                                                    $psycho_support_60to70_m = $row_psychosocial_60to70_m['psycho_support'];
                                                                    if (!empty($psycho_support_60to70_m)) {
                                                                        $ttl_psycho_support_60to70_m = $ttl_psycho_support_60to70_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_60to70_m = $ttl_psycho_support_60to70_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_60to70_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_60to70_f = 0;
                                                                while($row_psychosocial_60to70_f = mysqli_fetch_assoc($sql_psychosocial_60to70_f)) {
                                                                    $psycho_support_60to70_f = $row_psychosocial_60to70_f['psycho_support'];
                                                                    if (!empty($psycho_support_60to70_f)) {
                                                                        $ttl_psycho_support_60to70_f = $ttl_psycho_support_60to70_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_60to70_f = $ttl_psycho_support_60to70_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_60to70_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_60to70 = 0;
                                                                while($row_psychosocial_60to70 = mysqli_fetch_assoc($sql_psychosocial_60to70)) {
                                                                    $psycho_support_60to70 = $row_psychosocial_60to70['psycho_support'];
                                                                    if (!empty($psycho_support_60to70)) {
                                                                        $ttl_psycho_support_60to70 = $ttl_psycho_support_60to70 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_60to70 = $ttl_psycho_support_60to70 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_60to70;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_71to79_m = 0;
                                                                while($row_psychosocial_71to79_m = mysqli_fetch_assoc($sql_psychosocial_71to79_m)) {
                                                                    $psycho_support_71to79_m = $row_psychosocial_71to79_m['psycho_support'];
                                                                    if (!empty($psycho_support_71to79_m)) {
                                                                        $ttl_psycho_support_71to79_m = $ttl_psycho_support_71to79_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_71to79_m = $ttl_psycho_support_71to79_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_71to79_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_71to79_f = 0;
                                                                while($row_psychosocial_71to79_f = mysqli_fetch_assoc($sql_psychosocial_71to79_f)) {
                                                                    $psycho_support_71to79_f = $row_psychosocial_71to79_f['psycho_support'];
                                                                    if (!empty($psycho_support_71to79_f)) {
                                                                        $ttl_psycho_support_71to79_f = $ttl_psycho_support_71to79_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_71to79_f = $ttl_psycho_support_71to79_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_71to79_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_71to79 = 0;
                                                                while($row_psychosocial_71to79 = mysqli_fetch_assoc($sql_psychosocial_71to79)) {
                                                                    $psycho_support_71to79 = $row_psychosocial_71to79['psycho_support'];
                                                                    if (!empty($psycho_support_71to79)) {
                                                                        $ttl_psycho_support_71to79 = $ttl_psycho_support_71to79 + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_71to79 = $ttl_psycho_support_71to79 + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_71to79;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_80andabove_m = 0;
                                                                while($row_psychosocial_80andabove_m = mysqli_fetch_assoc($sql_psychosocial_80andabove_m)) {
                                                                    $psycho_support_80andabove_m = $row_psychosocial_80andabove_m['psycho_support'];
                                                                    if (!empty($psycho_support_80andabove_m)) {
                                                                        $ttl_psycho_support_80andabove_m = $ttl_psycho_support_80andabove_m + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_80andabove_m = $ttl_psycho_support_80andabove_m + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_80andabove_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_80andabove_f = 0;
                                                                while($row_psychosocial_80andabove_f = mysqli_fetch_assoc($sql_psychosocial_80andabove_f)) {
                                                                    $psycho_support_80andabove_f = $row_psychosocial_80andabove_f['psycho_support'];
                                                                    if (!empty($psycho_support_80andabove_f)) {
                                                                        $ttl_psycho_support_80andabove_f = $ttl_psycho_support_80andabove_f + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_80andabove_f = $ttl_psycho_support_80andabove_f + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_80andabove_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_psychosocial_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_psycho_support_80andabove = 0;
                                                                while($row_psychosocial_80andabove = mysqli_fetch_assoc($sql_psychosocial_80andabove)) {
                                                                    $psycho_support_80andabove = $row_psychosocial_80andabove['psycho_support'];
                                                                    if (!empty($psycho_support_80andabove)) {
                                                                        $ttl_psycho_support_80andabove = $ttl_psycho_support_80andabove + 1;
                                                                    } else {
                                                                        $ttl_psycho_support_80andabove = $ttl_psycho_support_80andabove + 0;
                                                                    }
                                                                }
                                                                echo $ttl_psycho_support_80andabove;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $ttl_psycho_support; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Referral</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_0to13_m = 0;
                                                                while($row_referral_0to13_m = mysqli_fetch_assoc($sql_referral_0to13_m)) {
                                                                    $referral_0to13_m = $row_referral_0to13_m['referral'];
                                                                    if ((empty($referral_0to13_m))||($referral_0to13_m=='N/A')||($referral_0to13_m=='n/a')) {
                                                                        $ttl_referral_0to13_m = $ttl_referral_0to13_m + 0;
                                                                    } else {
                                                                        $ttl_referral_0to13_m = $ttl_referral_0to13_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_0to13_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_0to13_f = 0;
                                                                while($row_referral_0to13_f = mysqli_fetch_assoc($sql_referral_0to13_f)) {
                                                                    $referral_0to13_f = $row_referral_0to13_f['referral'];
                                                                    if ((empty($referral_0to13_f))||($referral_0to13_f=='N/A')||($referral_0to13_f=='n/a')) {
                                                                        $ttl_referral_0to13_f = $ttl_referral_0to13_f + 0;
                                                                    } else {
                                                                        $ttl_referral_0to13_f = $ttl_referral_0to13_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_0to13_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_0to13 = 0;
                                                                while($row_referral_0to13 = mysqli_fetch_assoc($sql_referral_0to13)) {
                                                                    $referral_0to13 = $row_referral_0to13['referral'];
                                                                    if ((empty($referral_0to13))||($referral_0to13=='N/A')||($referral_0to13=='n/a')) {
                                                                        $ttl_referral_0to13 = $ttl_referral_0to13 + 0;
                                                                    } else {
                                                                        $ttl_referral_0to13 = $ttl_referral_0to13 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_0to13;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_14to17_m = 0;
                                                                while($row_referral_14to17_m = mysqli_fetch_assoc($sql_referral_14to17_m)) {
                                                                    $referral_14to17_m = $row_referral_14to17_m['referral'];
                                                                    if ((empty($referral_14to17_m))||($referral_14to17_m=='N/A')||($referral_14to17_m=='n/a')) {
                                                                        $ttl_referral_14to17_m = $ttl_referral_14to17_m + 0;
                                                                    } else {
                                                                        $ttl_referral_14to17_m = $ttl_referral_14to17_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_14to17_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_14to17_f = 0;
                                                                while($row_referral_14to17_f = mysqli_fetch_assoc($sql_referral_14to17_f)) {
                                                                    $referral_14to17_f = $row_referral_14to17_f['referral'];
                                                                    if ((empty($referral_14to17_f))||($referral_14to17_f=='N/A')||($referral_14to17_f=='n/a')) {
                                                                        $ttl_referral_14to17_f = $ttl_referral_14to17_f + 0;
                                                                    } else {
                                                                        $ttl_referral_14to17_f = $ttl_referral_14to17_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_14to17_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_14to17 = 0;
                                                                while($row_referral_14to17 = mysqli_fetch_assoc($sql_referral_14to17)) {
                                                                    $referral_14to17 = $row_referral_14to17['referral'];
                                                                    if ((empty($referral_14to17))||($referral_14to17=='N/A')||($referral_14to17=='n/a')) {
                                                                        $ttl_referral_14to17 = $ttl_referral_14to17 + 0;
                                                                    } else {
                                                                        $ttl_referral_14to17 = $ttl_referral_14to17 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_14to17;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_18to29_m = 0;
                                                                while($row_referral_18to29_m = mysqli_fetch_assoc($sql_referral_18to29_m)) {
                                                                    $referral_18to29_m = $row_referral_18to29_m['referral'];
                                                                    if ((empty($referral_18to29_m))||($referral_18to29_m=='N/A')||($referral_18to29_m=='n/a')) {
                                                                        $ttl_referral_18to29_m = $ttl_referral_18to29_m + 0;
                                                                    } else {
                                                                        $ttl_referral_18to29_m = $ttl_referral_18to29_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_18to29_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_18to29_f = 0;
                                                                while($row_referral_18to29_f = mysqli_fetch_assoc($sql_referral_18to29_f)) {
                                                                    $referral_18to29_f = $row_referral_18to29_f['referral'];
                                                                    if ((empty($referral_18to29_f))||($referral_18to29_f=='N/A')||($referral_18to29_f=='n/a')) {
                                                                        $ttl_referral_18to29_f = $ttl_referral_18to29_f + 0;
                                                                    } else {
                                                                        $ttl_referral_18to29_f = $ttl_referral_18to29_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_18to29_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_18to29 = 0;
                                                                while($row_referral_18to29 = mysqli_fetch_assoc($sql_referral_18to29)) {
                                                                    $referral_18to29 = $row_referral_18to29['referral'];
                                                                    if ((empty($referral_18to29))||($referral_18to29=='N/A')||($referral_18to29=='n/a')) {
                                                                        $ttl_referral_18to29 = $ttl_referral_18to29 + 0;
                                                                    } else {
                                                                        $ttl_referral_18to29 = $ttl_referral_18to29 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_18to29;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_30to44_m = 0;
                                                                while($row_referral_30to44_m = mysqli_fetch_assoc($sql_referral_30to44_m)) {
                                                                    $referral_30to44_m = $row_referral_30to44_m['referral'];
                                                                    if ((empty($referral_30to44_m))||($referral_30to44_m=='N/A')||($referral_30to44_m=='n/a')) {
                                                                        $ttl_referral_30to44_m = $ttl_referral_30to44_m + 0;
                                                                    } else {
                                                                        $ttl_referral_30to44_m = $ttl_referral_30to44_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_30to44_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_30to44_f = 0;
                                                                while($row_referral_30to44_f = mysqli_fetch_assoc($sql_referral_30to44_f)) {
                                                                    $referral_30to44_f = $row_referral_30to44_f['referral'];
                                                                    if ((empty($referral_30to44_f))||($referral_30to44_f=='N/A')||($referral_30to44_f=='n/a')) {
                                                                        $ttl_referral_30to44_f = $ttl_referral_30to44_f + 0;
                                                                    } else {
                                                                        $ttl_referral_30to44_f = $ttl_referral_30to44_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_30to44_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_30to44 = 0;
                                                                while($row_referral_30to44 = mysqli_fetch_assoc($sql_referral_30to44)) {
                                                                    $referral_30to44 = $row_referral_30to44['referral'];
                                                                    if ((empty($referral_30to44))||($referral_30to44=='N/A')||($referral_30to44=='n/a')) {
                                                                        $ttl_referral_30to44 = $ttl_referral_30to44 + 0;
                                                                    } else {
                                                                        $ttl_referral_30to44 = $ttl_referral_30to44 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_30to44;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_45to59_m = 0;
                                                                while($row_referral_45to59_m = mysqli_fetch_assoc($sql_referral_45to59_m)) {
                                                                    $referral_45to59_m = $row_referral_45to59_m['referral'];
                                                                    if ((empty($referral_45to59_m))||($referral_45to59_m=='N/A')||($referral_45to59_m=='n/a')) {
                                                                        $ttl_referral_45to59_m = $ttl_referral_45to59_m + 0;
                                                                    } else {
                                                                        $ttl_referral_45to59_m = $ttl_referral_45to59_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_45to59_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_45to59_f = 0;
                                                                while($row_referral_45to59_f = mysqli_fetch_assoc($sql_referral_45to59_f)) {
                                                                    $referral_45to59_f = $row_referral_45to59_f['referral'];
                                                                    if ((empty($referral_45to59_f))||($referral_45to59_f=='N/A')||($referral_45to59_f=='n/a')) {
                                                                        $ttl_referral_45to59_f = $ttl_referral_45to59_f + 0;
                                                                    } else {
                                                                        $ttl_referral_45to59_f = $ttl_referral_45to59_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_45to59_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_45to59 = 0;
                                                                while($row_referral_45to59 = mysqli_fetch_assoc($sql_referral_45to59)) {
                                                                    $referral_45to59 = $row_referral_45to59['referral'];
                                                                    if ((empty($referral_45to59))||($referral_45to59=='N/A')||($referral_45to59=='n/a')) {
                                                                        $ttl_referral_45to59 = $ttl_referral_45to59 + 0;
                                                                    } else {
                                                                        $ttl_referral_45to59 = $ttl_referral_45to59 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_45to59;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_60to70_m = 0;
                                                                while($row_referral_60to70_m = mysqli_fetch_assoc($sql_referral_60to70_m)) {
                                                                    $referral_60to70_m = $row_referral_60to70_m['referral'];
                                                                    if ((empty($referral_60to70_m))||($referral_60to70_m=='N/A')||($referral_60to70_m=='n/a')) {
                                                                        $ttl_referral_60to70_m = $ttl_referral_60to70_m + 0;
                                                                    } else {
                                                                        $ttl_referral_60to70_m = $ttl_referral_60to70_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_60to70_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_60to70_f = 0;
                                                                while($row_referral_60to70_f = mysqli_fetch_assoc($sql_referral_60to70_f)) {
                                                                    $referral_60to70_f = $row_referral_60to70_f['referral'];
                                                                    if ((empty($referral_60to70_f))||($referral_60to70_f=='N/A')||($referral_60to70_f=='n/a')) {
                                                                        $ttl_referral_60to70_f = $ttl_referral_60to70_f + 0;
                                                                    } else {
                                                                        $ttl_referral_60to70_f = $ttl_referral_60to70_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_60to70_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_60to70 = 0;
                                                                while($row_referral_60to70 = mysqli_fetch_assoc($sql_referral_60to70)) {
                                                                    $referral_60to70 = $row_referral_60to70['referral'];
                                                                    if ((empty($referral_60to70))||($referral_60to70=='N/A')||($referral_60to70=='n/a')) {
                                                                        $ttl_referral_60to70 = $ttl_referral_60to70 + 0;
                                                                    } else {
                                                                        $ttl_referral_60to70 = $ttl_referral_60to70 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_60to70;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_71to79_m = 0;
                                                                while($row_referral_71to79_m = mysqli_fetch_assoc($sql_referral_71to79_m)) {
                                                                    $referral_71to79_m = $row_referral_71to79_m['referral'];
                                                                    if ((empty($referral_71to79_m))||($referral_71to79_m=='N/A')||($referral_71to79_m=='n/a')) {
                                                                        $ttl_referral_71to79_m = $ttl_referral_71to79_m + 0;
                                                                    } else {
                                                                        $ttl_referral_71to79_m = $ttl_referral_71to79_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_71to79_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_71to79_f = 0;
                                                                while($row_referral_71to79_f = mysqli_fetch_assoc($sql_referral_71to79_f)) {
                                                                    $referral_71to79_f = $row_referral_71to79_f['referral'];
                                                                    if ((empty($referral_71to79_f))||($referral_71to79_f=='N/A')||($referral_71to79_f=='n/a')) {
                                                                        $ttl_referral_71to79_f = $ttl_referral_71to79_f + 0;
                                                                    } else {
                                                                        $ttl_referral_71to79_f = $ttl_referral_71to79_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_71to79_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_71to79 = 0;
                                                                while($row_referral_71to79 = mysqli_fetch_assoc($sql_referral_71to79)) {
                                                                    $referral_71to79 = $row_referral_71to79['referral'];
                                                                    if ((empty($referral_71to79))||($referral_71to79=='N/A')||($referral_71to79=='n/a')) {
                                                                        $ttl_referral_71to79 = $ttl_referral_71to79 + 0;
                                                                    } else {
                                                                        $ttl_referral_71to79 = $ttl_referral_71to79 + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_71to79;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_referral_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND  cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_80andabove_m = 0;
                                                                while($row_referral_80andabove_m = mysqli_fetch_assoc($sql_referral_80andabove_m)) {
                                                                    $referral_80andabove_m = $row_referral_80andabove_m['referral'];
                                                                    if ((empty($referral_80andabove_m))||($referral_80andabove_m=='N/A')||($referral_80andabove_m=='n/a')) {
                                                                        $ttl_referral_80andabove_m = $ttl_referral_80andabove_m + 0;
                                                                    } else {
                                                                        $ttl_referral_80andabove_m = $ttl_referral_80andabove_m + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_80andabove_m;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND  cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_80andabove_f = 0;
                                                                while($row_referral_80andabove_f = mysqli_fetch_assoc($sql_referral_80andabove_f)) {
                                                                    $referral_80andabove_f = $row_referral_80andabove_f['referral'];
                                                                    if ((empty($referral_80andabove_f))||($referral_80andabove_f=='N/A')||($referral_80andabove_f=='n/a')) {
                                                                        $ttl_referral_80andabove_f = $ttl_referral_80andabove_f + 0;
                                                                    } else {
                                                                        $ttl_referral_80andabove_f = $ttl_referral_80andabove_f + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_80andabove_f;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                $ttl_referral_80andabove = 0;
                                                                while($row_referral_80andabove = mysqli_fetch_assoc($sql_referral_80andabove)) {
                                                                    $referral_80andabove = $row_referral_80andabove['referral'];
                                                                    if ((empty($referral_80andabove))||($referral_80andabove=='N/A')||($referral_80andabove=='n/a')) {
                                                                        $ttl_referral_80andabove = $ttl_referral_80andabove + 0;
                                                                    } else {
                                                                        $ttl_referral_80andabove = $ttl_referral_80andabove + 1;
                                                                    }
                                                                }
                                                                echo $ttl_referral_80andabove;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $ttl_referral; ?></td>
                                                    </tr>
                                                    <!-- TABLE 5: GRAND TOTAL -->
                                                    <tr style="background-color: yellow; font-weight: bold;">
                                                        <td>GRAND TOTAL (except Psychosocial & Referral)</td>
                                                        <!-- 0 to 13 -->
                                                        <td>
                                                            <?php
                                                                $sql_0to13_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_0to13_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_0to13_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_0to13_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_0to13 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=0 AND cl_age<=13 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_0to13->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 14 to 17 -->
                                                        <td>
                                                            <?php
                                                                $sql_14to17_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_14to17_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_14to17_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_14to17_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_14to17 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=14 AND cl_age<=17 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_14to17->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 18 to 29 -->
                                                        <td>
                                                            <?php
                                                                $sql_18to29_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_18to29_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_18to29_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_18to29_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_18to29 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=18 AND cl_age<=29 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_18to29->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 30 to 44 -->
                                                        <td>
                                                            <?php
                                                                $sql_30to44_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_30to44_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_30to44_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_30to44_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_30to44 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=30 AND cl_age<=44 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_30to44->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 45 to 59 -->
                                                        <td>
                                                            <?php
                                                                $sql_45to59_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_45to59_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_45to59_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_45to59_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_45to59 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=45 AND cl_age<=59 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_45to59->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 60 to 70 -->
                                                        <td>
                                                            <?php
                                                                $sql_60to70_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_60to70_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_60to70_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_60to70_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_60to70 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=60 AND cl_age<=70 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_60to70->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 71 to 79 -->
                                                        <td>
                                                            <?php
                                                                $sql_71to79_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_71to79_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_71to79_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_71to79_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_71to79 = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=71 AND cl_age<=79 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_71to79->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- 80 and above -->
                                                        <td>
                                                            <?php
                                                                $sql_80andabove_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_80andabove_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_80andabove_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_80andabove_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_80andabove = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_age>=80 AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_80andabove->num_rows;
                                                            ?>
                                                        </td>
                                                        <!-- Grand Total -->
                                                        <td><?php echo $sql_assistance->num_rows; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>

                                                    <!-- TABLE 5 -->
                                                    <tr>
                                                        <td style="background-color: white; border: none; text-align: left;">Table 5: Clients Served per Mode of Admission</td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #336666; color: white;">Clients Served per Mode of Admission</td>
                                                        <td style="background-color: aliceblue;">Male</td>
                                                        <td style="background-color: aliceblue;">Female</td>
                                                        <td style="background-color: aliceblue;">Total</td>
                                                        <td style="background-color: white;"></td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Walk-in</td>
                                                        <td>
                                                            <?php
                                                                $sql_walkin_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND admission_mode='Walk-in' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_walkin_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_walkin_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND admission_mode='Walk-in' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_walkin_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_walkin = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE admission_mode='Walk-in' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_walkin->num_rows;
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Referral</td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND admission_mode='Referral' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_referral_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND admission_mode='Referral' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_referral_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sql_referral = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE admission_mode='Referral' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_referral->num_rows;
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <!-- TABLE 5: GRAND TOTAL -->
                                                    <tr style="font-weight: bold;">
                                                        <td style="background-color: yellow;">GRAND TOTAL</td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_admission_mode_m = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='M' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_admission_mode_m->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_admission_mode_f = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE cl_sex='F' AND time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_admission_mode_f->num_rows;
                                                            ?>
                                                        </td>
                                                        <td style="background-color: yellow;">
                                                            <?php
                                                                $sql_admission_mode = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE time_end>='$start_date' AND time_end<='$end_date' AND cancellation!='YES' ");
                                                                echo $sql_admission_mode->num_rows;
                                                            ?>
                                                        </td>
                                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- 2 -->
                                <div id="2" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        
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

        $('.statsreport1').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            paging: false,
            buttons: [
                'excelHtml5'
            ],
            ordering: false,
            fixedHeader: true,
        });

        $('.statsreport2').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            paging: false,
            buttons: [
                'excelHtml5'
            ],
            ordering: false,
            fixedHeader: true,
        });    
    </script>

</body>
</html>