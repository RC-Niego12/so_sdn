<?php
    // Start the session
    session_start();
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
    <title>Manage Tables</title>
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
                <a class="navbar-brand" href="#" title="Manage Tables - Admin Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Administrator Level</a>
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
                         //   ?>
                            <img src="images/user.png"  style="margin-top: -20px;" width="60" height="60" alt="User" title="Default Photo" /><br>
                            <?php
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
                        <a href="home_admin.php">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_db.php">
                            <span class="fa fa-cogs"></span>
                            <span>Manage Database</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="manage_sw_table.php">
                            <span class="fa fa-cogs"></span>
                            <span>Manage Tables</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_signatories.php">
                            <span class="fa fa-cogs"></span>
                            <span>Manage Signatories</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_SPs.php">
                            <span class="fa fa-cogs"></span>
                            <span>Manage Service Providers</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_assistance.php">
                            <span class="fa fa-cogs"></span>
                            <span>Manage Assistance</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_funds.php">
                            <span class="fa fa-cogs"></span>
                            <span>Manage Funds</span>
                        </a>
                    </li>
                    <li>
                        <a href="download_db.php">
                            <span class="fa fa-download"></span>
                            <span>Download DB for Online Encoding</span>
                        </a>
                    </li>
                    <li>
                        <a href="import_csv_files.php">
                            <span class="fa fa-upload"></span>
                            <span>Import CSV Files</span>
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
                                    <a href="#manage_sw_table" data-toggle="tab">
                                        <span class="fa fa-cogs" style="color: darkblue;"></span> Manage Tables
                                    </a>
                                </li>
                                <li>
                                    <a href="#todays_swopertable" data-toggle="tab">
                                        <span class="fa fa-user" style="color: lightgreen;"></span> Active Tables Today
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- today's swo per table -->
                                <div id="todays_swopertable" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: hidden; font-size: 1em; width: 50%;">
                                        <table class="table table-bordered table-striped table-hover clientq dataTable text-left">
                                            <thead class="bg-darkblue" style="color: white;">
                                                <tr>
                                                    <th>Table No.</th>
                                                    <th>Name of SWO</th>
                                                    <th>Clients Served Today</th>
                                                    <th>With Social Case Study Report/s (above 10,000.00 php)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $swo_id = "";
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
                                                                    date_default_timezone_set('Asia/Manila');
                                                                    $date_now = date('M. d, Y');
                                                                    $start_date_now = date_format(new DateTime($date_now), "Y-m-d 00:00:01");
                                                                    $end_date_now = date_format(new DateTime($date_now), "Y-m-d 23:59:59");
                                                                    $sql2 = mysqli_query($conn, "SELECT * FROM tbl_save_addl_entry WHERE swo_staffid='$swo_id' AND time_end2>='$start_date_now' AND time_end2<='$end_date_now'");
                                                                    //echo $start_date_now.' - '.$end_date_now;
                                                                    echo $sql2->num_rows;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    date_default_timezone_set('Asia/Manila');
                                                                    $date_now = date('M. d, Y');
                                                                    $start_date_now = date_format(new DateTime($date_now), "Y-m-d 00:00:01");
                                                                    $end_date_now = date_format(new DateTime($date_now), "Y-m-d 23:59:59");
                                                                    $sql2 = mysqli_query($conn, "SELECT * FROM tbl_save_addl_entry WHERE swo_staffid='$swo_id' AND amount_in_figures>10000 AND time_end2>='$start_date_now' AND time_end2<='$end_date_now'");
                                                                    //echo $start_date_now.' - '.$end_date_now;
                                                                    echo $sql2->num_rows;
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

                                <!-- manage_sw_table -->
                                <div id="manage_sw_table" class="tab-pane fade in active">
                                    <?php
                                        $staffid = $last_id = $table_num = "";
                                        if (isset($_POST['add_table'])) {
                                            $sql = mysqli_query($conn, "SELECT * FROM tbl_sw_table");
                                            if ($result = $sql) {
                                                // Return the number of rows in result set
                                                $rowcount = mysqli_num_rows($result);
                                                $table_num = $rowcount+1;
                                                $insert_sql = "INSERT INTO tbl_sw_table (table_num, staffid2) VALUES ('$table_num', '$staffid')";
                                                if ($conn->query($insert_sql) === TRUE) {
                                                    echo "New table added successfully";
                                                } else {
                                                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                                                }
                                            }
                                        }

                                        if (isset($_POST['remove_table'])) {
                                            $sql = mysqli_query($conn, "SELECT * FROM tbl_sw_table");
                                            if ($result = $sql) {
                                                // Return the number of rows in result set
                                                $rowcount = mysqli_num_rows($result);
                                                $remove_sql = "DELETE FROM tbl_sw_table WHERE table_num = '".$rowcount."'";
                                                if ($conn->query($remove_sql) === TRUE) {
                                                    echo "A table is removed successfully";
                                                } else {
                                                    echo "Error: " . $remove_sql . "<br>" . $conn->error;
                                                }
                                            }
                                        }
                                    ?>
                                    <h5>Number of Tables Available:<span>
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
                                    </span>
                                    </h5>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                        <h5 style="display: inline-block;">Add Table:</h5>
                                        <button class="btn btn-xs btn-primary waves-effect" name="add_table" type="submit" style="display: inline-block;">
                                            <span class="fa fa-plus"></span>
                                        </button><br>
                                        <h5 style="display: inline-block;">Remove Table:</h5>
                                        <button class="btn btn-xs btn-danger waves-effect" name="remove_table" type="submit" style="display: inline-block;">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </form>
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
    <script src="js/pages/tables/jquery-datatable.js"></script>
    
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('.clientq').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
            ],
            paging: false
        });
    </script>

</body>
</html>