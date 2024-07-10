<?php
    // Start the session
    session_start();
    $_SESSION['qn'];
    $_SESSION['cl_mc_name']; $_SESSION['cl_mc_code']; $_SESSION['cl_pd_name']; $_SESSION['cl_pd_code']; $_SESSION['cl_dist']; $_SESSION['cl_reg_name']; $_SESSION['cl_reg_code'];
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
    <link href="plugins/bootstrap/css/bootstrap.css.map" rel="stylesheet">

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
                        <span class="glyphicon glyphicon-log-out"><a href="logout.php" style="color: darkblue;"></span> Sign Out</a></span>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        <a href="edit_clientV1.php">
                            <span class="fa fa-edit"></span>
                            <span>Edit Client Address</span>
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
            //client session
            $_SESSION['cl_brgy_name'] = $_SESSION['cl_brgy_code'] = $_SESSION['cl_purok'] = "";

            if (isset($_POST['btn_submit_loc'])) {

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $_SESSION['cl_brgy_name'] = mysqli_real_escape_string($conn, test_input($_POST['cl_brgy_name']));
                    $_SESSION['cl_brgy_code'] = mysqli_real_escape_string($conn, test_input($_POST['cl_brgy_code']));
                    $_SESSION['cl_purok'] = mysqli_real_escape_string($conn, test_input($_POST['cl_purok']));
                    header("location: update_client_address.php");
                }
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
                                            <div class="row">
                                                <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-align: left;">I: CLIENT'S IDENTIFYING INFORMATION: Search Brgy. Address</h4>
                                                <div class="col-sm-8 table-responsive">
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                        <div class="table-responsive">
                                                            <h4><u>Selected City/Municipal Address: </u></h4>
                                                            <table class="table table-bordered table-striped table-hover dataTable text-left" style="overflow-x: scroll;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Mun/City</th>
                                                                        <th>Prov/Dist</th>
                                                                        <th>District</th>
                                                                        <th>Region</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><?php echo $_SESSION['cl_mc_name'].'/'.$_SESSION['cl_mc_code']; ?></td>
                                                                        <td><?php echo $_SESSION['cl_pd_name'].'/'.$_SESSION['cl_pd_code']; ?></td>
                                                                        <td><?php echo $_SESSION['cl_dist']; ?></td>
                                                                        <td><?php echo $_SESSION['cl_reg_name'].'/'.$_SESSION['cl_reg_code']; ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <h4><u>Kindly Search for Brgy. Address Below: </u></h4>
                                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable text-left" style="overflow-x: scroll;">
                                                                <thead class="bg-darkblue" style="color: white;">
                                                                    <tr>
                                                                        <th>Index</th>
                                                                        <th>Barangay</th>
                                                                        <th>Barangay Code</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                        $loc_sql = mysqli_query($conn, "SELECT * FROM tbl_ph_brgy WHERE mun_city_name='".$_SESSION['cl_mc_name']."' AND mun_city_code='".$_SESSION['cl_mc_code']."' ");
                                                                        if ($loc_sql->num_rows > 0){
                                                                            while($loc_row = mysqli_fetch_assoc($loc_sql)) {
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo $loc_row['id'];?></td>
                                                                                        <td><?php echo $loc_row['brgy_name'];?></td>
                                                                                        <td><?php echo $loc_row['brgy_code'];?></td>
                                                                                    </tr>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="panel-heading panel-title bg-darkblue"> 
                                                        <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Selected Brgy. Address</h5>
                                                    </div>
                                                    <div class="panel-body">
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                            <!-- Client Brgy. Address -->
                                                            <div class="row clearfix">
                                                                <div class="form-group form-float">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> Barangay:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="cl_brgy_name" name="cl_brgy_name" value="<?php echo $row_clq['cl_brgy'];?>" required autofocus>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div class="form-group form-float">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> Barangay Code:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="cl_brgy_code" name="cl_brgy_code" value="<?php echo $row_clq['cl_brgy_code'];?>" required autofocus>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div class="form-group form-float">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> Enter House No./St./Purok/etc.:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" name="cl_purok" value="<?php echo $row_clq['cl_purok'];?>" required autofocus>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <ul class="pager" style="margin: auto;">
                                                                    <li class="">
                                                                        <a href="edit_clientV1.php">
                                                                            <button class="btn btn-block waves-effect" type="button"><span class="fa fa-arrow-left"> Back</button>
                                                                        </a>
                                                                    </li>
                                                                    <li class="">
                                                                        <a style="color: white;">
                                                                            <button class="btn btn-primary btn-block waves-effect" name="btn_submit_loc" type="submit">Save Changes <span class="fa fa-save"></button>
                                                                        </a>
                                                                    </li>
                                                                </ul>
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
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    </script>

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
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('.js-basic-example').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            paging: true
        });
        var table = $('.js-basic-example').DataTable();
        $('.js-basic-example tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("#cl_brgy_name").val(data[1]);
            console.log(data[1]);
            $("#cl_brgy_code").val(data[2]);
            console.log(data[2]);
        });
    </script>
</body>
</html>