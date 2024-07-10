<?php
    // Start the session
    session_start();
    $_SESSION['cl_qn2'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname='".$_SESSION['uname']."' AND pword='".$_SESSION['pword']."' ");
    $row1 = mysqli_fetch_assoc($sql);

    if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==false)) {
        header("Location: index.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
        $roww = mysqli_fetch_assoc($sql);

    $sql_clq = mysqli_query($conn,"SELECT * FROM tbl_save_clientbene WHERE id_tbl_save_clientbene ='".$_SESSION['cl_qn2']."' ");
    $row_clq = mysqli_fetch_assoc($sql_clq);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit City/Mun. Address</title>
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
                <a class="navbar-brand" href="#" title="Accomplished Forms - SW Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Social Worker Level</a>
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
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs INNER JOIN tbl_sw_table ON tbl_staffs.staffid=tbl_sw_table.staffid2 WHERE staffid='".$row1['staffid']."'");
                    $row2 = mysqli_fetch_assoc($sql); $USER=$row2['fname'];
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
                        if ($row2['sex']=="M") {
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row2['fname'].' '.substr($row2['mname'],0,1).'. '.$row2['lname'].' '.$row2['nameext']; ?></div>
                    <div class="email"><?php echo $row2['uname'].' | Table '.$row2['table_num']; ?></div>
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
                        <a href="edit_clientV1_sw.php">
                            <span class="fa fa-edit"></span>
                            <span>Edit Bene's City/Mun. Address</span>
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
            $_SESSION['bn_mc_name'] = $_SESSION['bn_mc_code'] = $_SESSION['bn_pd_name'] = $_SESSION['bn_pd_code'] = $_SESSION['bn_dist'] = $_SESSION['bn_reg_name'] = $_SESSION['bn_reg_code'] = "";

            if (isset($_POST['btn_submit_loc'])) {

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $_SESSION['bn_mc_name'] = mysqli_real_escape_string($conn, test_input($_POST['bn_mc_name']));
                    $_SESSION['bn_mc_code'] = mysqli_real_escape_string($conn, test_input($_POST['bn_mc_code']));
                    $_SESSION['bn_pd_name'] = mysqli_real_escape_string($conn, test_input($_POST['bn_pd_name']));
                    $_SESSION['bn_pd_code'] = mysqli_real_escape_string($conn, test_input($_POST['bn_pd_code']));
                    $_SESSION['bn_dist'] = mysqli_real_escape_string($conn, test_input($_POST['bn_dist']));
                    $_SESSION['bn_reg_name'] = mysqli_real_escape_string($conn, test_input($_POST['bn_reg_name']));
                    $_SESSION['bn_reg_code'] = mysqli_real_escape_string($conn, test_input($_POST['bn_reg_code']));
                            header("location: edit_beneV2_sw.php");
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
                                                <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-align: left;">II: BENE'S IDENTIFYING INFORMATION: Search Address</h4>
                                                <div style="width: 100%;">
                                                    <div class="panel-heading panel-title bg-darkblue"> 
                                                        <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Selected Address</h5>
                                                    </div>
                                                    <div class="row panel-body">
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                            <!-- Bene Mun. Address -->
                                                            <div class="clearfix col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                <div class="form-group form-float">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> Municipality/City:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="bn_mc_name" name="bn_mc_name" value="<?php echo $row_clq['bn_mun'];?>" required autofocus>
                                                                        <input type="hidden" class="form-control" id="bn_mc_code" name="bn_mc_code" value="<?php echo $row_clq['bn_mun_code'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Bene Prov. Address -->
                                                            <div class="clearfix col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                <div class="form-group form-float">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> Province/District:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="bn_pd_name" name="bn_pd_name" value="<?php echo $row_clq['bn_prov'];?>" required autofocus>
                                                                        <input type="hidden" class="form-control" id="bn_pd_code" name="bn_pd_code" value="<?php echo $row_clq['bn_prov_code'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Bene District -->
                                                            <div class="clearfix col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                <div class="form-group form-float" style="text-align: left;">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> District:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="bn_dist" name="bn_dist" value="<?php echo $row_clq['bn_district'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Bene Region Address -->
                                                            <div class="clearfix col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                                                <div class="form-group form-float">
                                                                    <label><span style="color: red; font-size: 2em;">*</span> Region:</label>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="bn_reg_name" name="bn_reg_name" value="<?php echo $row_clq['bn_region'];?>" required autofocus>
                                                                        <input type="hidden" class="form-control" id="bn_reg_code" name="bn_reg_code" value="<?php echo $row_clq['bn_region_code'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <ul class="pager" style="margin: -30px auto 0px;">
                                                                <li class="">
                                                                    <a href="modify_cl_bn_sw.php">
                                                                        <button class="btn btn-block waves-effect" type="button"><span class="fa fa-arrow-left"> Back to GIS</button>
                                                                    </a>
                                                                </li>
                                                                <li class="">
                                                                    <a style="color: white;">
                                                                        <button class="btn btn-primary btn-block waves-effect" name="btn_submit_loc" type="submit">Next <span class="fa fa-arrow-right"></button>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div><hr>
                                                <div class="table-responsive" style="overflow-x: scroll; font-size: 1em; width: 100%;">
                                                    <h4><u>Kindly Search for City/Municipal Address Below: </u></h4>
                                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable text-left">
                                                        <thead class="bg-darkblue" style="color: white;">
                                                            <tr>
                                                                <th>Index</th>
                                                                <th>City/Municipality</th>
                                                                <th>City/Mun-Code</th>
                                                                <th>Province/District</th>
                                                                <th>Prov/Dist-Code</th>
                                                                <th>District</th>
                                                                <th>Region</th>
                                                                <th>Reg-Code</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $loc_sql = mysqli_query($conn, "SELECT * FROM tbl_ph_mun_city");
                                                                if ($loc_sql->num_rows > 0){
                                                                    while($loc_row = mysqli_fetch_assoc($loc_sql)) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $loc_row['id'];?></td>
                                                                                <td>
                                                                                    <?php echo $loc_row['mun_city_name'];?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $loc_row['mun_city_code'];?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $loc_row['prov_dist_name'];?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $loc_row['prov_dist_code'];?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $loc_row['dist'];?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $loc_row['reg_name'];?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $loc_row['reg_code'];?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
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
        $('.js-basic-example tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            $("#bn_mc_name").val(data[1]);
            console.log(data[1]);
            $("#bn_mc_code").val(data[2]);
            console.log(data[2]);
            $("#bn_pd_name").val(data[3]);
            console.log(data[3]);
            $("#bn_pd_code").val(data[4]);
            console.log(data[4]);
            $("#bn_dist").val(data[5]);
            console.log(data[5]);
            $("#bn_reg_name").val(data[6]);
            console.log(data[6]);
            $("#bn_reg_code").val(data[7]);
            console.log(data[7]);
        });
    </script>
</script>
</body>
</html>