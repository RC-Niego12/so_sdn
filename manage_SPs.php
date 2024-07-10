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
    <title>Manage Service Providers</title>
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
                <a class="navbar-brand" href="#" title="Manage SPs - Admin Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Administrator Level</a>
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
                    <li>
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
                    <li class="active">
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
                                    <a href="#manage_sp" data-toggle="tab">
                                        <span class="fa fa-cogs" style="color: darkblue;"></span> Manage Service Providers
                                    </a>
                                </li>
                                <li>
                                    <a href="#add_sp" data-toggle="tab">
                                        <span class="fa fa-plus" style="color: darkblue;"></span> Add New Service Provider
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- manage_signatories -->
                                <div id="manage_sp" class="tab-pane fade in active">
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
                                                    <th>Action</th>
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
                                                            <td>
                                                                <button class="btn btn-xs btn-primary waves-effect btn_edit_details" name="edit_details_modal" type="button" data-toggle="modal" title="Edit Details" data-target="#edit_details_modal" data-sp_id="<?php echo $row['id'];?>" data-sp_name="<?php echo $row['sp_name'];?>" data-sp_type="<?php echo $row['sp_type'];?>" data-sp_district="<?php echo $row['sp_pd_address'];?>" data-sp_address="<?php echo $row['sp_address'];?>" data-sp_contact_person="<?php echo $row['contact_person'];?>" data-sp_contact_num="<?php echo $row['contact_num'];?>" data-sp_status="<?php echo $row['status'];?>">
                                                                    <span class="glyphicon glyphicon-edit" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {

                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_details_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit SP Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $_SESSION['modal_sp_id'] = $_SESSION['modal_sp_name'] = $_SESSION['modal_sp_type'] = $_SESSION['modal_sp_district'] = $_SESSION['modal_sp_address'] = $_SESSION['modal_sp_contact_person'] = $_SESSION['modal_sp_contact_num'] = $_SESSION['modal_sp_status'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['modal_sp_id'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_id']));
                                                            $_SESSION['modal_sp_name'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_name']));
                                                            $_SESSION['modal_sp_type'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_type']));
                                                            $_SESSION['modal_sp_district'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_district']));
                                                            $_SESSION['modal_sp_address'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_address']));
                                                            $_SESSION['modal_sp_contact_person'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_contact_person']));
                                                            $_SESSION['modal_sp_contact_num'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_contact_num']));
                                                            $_SESSION['modal_sp_status'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sp_status']));
                                                            if (isset($_POST['edit_details'])) {
                                                                header("location: update_sp.php");
                                                            }
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <input type="hidden" class="form-control" id="modal_sp_id" name="modal_sp_id">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <!-- SP Name -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Full Name of Service Provider:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_sp_name" name="modal_sp_name" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- SP Type -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>SP Type:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" name="modal_sp_type">
                                                                                    <option id="modal_sp_type"></option>
                                                                                    <option>Ambulatory Surgery</option>
                                                                                    <option>Blood Bank</option>
                                                                                    <option>Pharmacy</option>
                                                                                    <option>Hospital</option>
                                                                                    <option>Clinic/Laboratory</option>
                                                                                    <option>Clinic/Ambulatory Surgery</option>
                                                                                    <option>Dialysis Center</option>
                                                                                    <option>Funeral Home</option>
                                                                                    <option>Implant Distributor</option>
                                                                                    <option>Medical Distributor</option>
                                                                                    <option>Medical Distributor/Importer</option>
                                                                                    <option>Medical Distributor/Pharmacy</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- District -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>District:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_sp_district" name="modal_sp_district">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Address -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Full Address:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_sp_address" name="modal_sp_address">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Contact Person -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Contact Person:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_sp_contact_person" name="modal_sp_contact_person">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Contact Number -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>Contact Number:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_sp_contact_num" name="modal_sp_contact_num">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Status -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float" style="text-align: left;">
                                                                            <label>MOA Status:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="modal_sp_status" name="modal_sp_status">
                                                                                    <option>New</option>
                                                                                    <option>Renewed</option>
                                                                                    <option>Inactive</option>
                                                                                </select>
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
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="edit_details"> Submit <span class="glyphicon glyphicon-send"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <!-- end manage_signatories -->
                                <!-- add_signatories -->
                                <div id="add_sp" class="tab-pane fade in">
                                    <?php
                                        $_SESSION['sp_id'] = $_SESSION['sp_name'] = $_SESSION['sp_type'] = $_SESSION['sp_pd_address'] = $_SESSION['sp_address'] = $_SESSION['sp_contact_person'] = $_SESSION['sp_contact_num'] = $_SESSION['status'] = "";
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            if (isset($_POST['add_newSP'])) {
                                                $_SESSION['sp_id'] = mysqli_real_escape_string($conn, test_input($_POST['sp_id']));
                                                $_SESSION['sp_name'] = mysqli_real_escape_string($conn, test_input($_POST['sp_name']));
                                                $_SESSION['sp_type'] = mysqli_real_escape_string($conn, test_input($_POST['sp_type']));
                                                $_SESSION['sp_pd_address'] = mysqli_real_escape_string($conn, test_input($_POST['sp_pd_address']));
                                                $_SESSION['sp_address'] = mysqli_real_escape_string($conn, test_input($_POST['sp_address']));
                                                $_SESSION['sp_contact_person'] = mysqli_real_escape_string($conn, test_input($_POST['sp_contact_person']));
                                                $_SESSION['sp_contact_num'] = mysqli_real_escape_string($conn, test_input($_POST['sp_contact_num']));
                                                $_SESSION['status'] = mysqli_real_escape_string($conn, test_input($_POST['status']));
                                                header("location: insert_newSP.php");
                                            }
                                        }
                                        function test_input($data) {
                                          $data = trim($data);
                                          $data = stripslashes($data);
                                          $data = htmlspecialchars($data);
                                          return $data;
                                        }
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                        <div class="">
                                            <div class="col-sm-5">
                                                <div class="panel-group">
                                                    <div class="panel panel-primary-dswd">
                                                        <div class="panel-heading panel-title"> 
                                                            <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Enter SP Details Below:</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- SP Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Full Name of Service Provider:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="sp_name" name="sp_name" placeholder="Enter full name of SP here..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- SP Type -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>SP Type:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="sp_type" name="sp_type">
                                                                                <option>Ambulatory Surgery</option>
                                                                                <option>Blood Bank</option>
                                                                                <option>Pharmacy</option>
                                                                                <option>Hospital</option>
                                                                                <option>Clinic/Laboratory</option>
                                                                                <option>Clinic/Ambulatory Surgery</option>
                                                                                <option>Dialysis Center</option>
                                                                                <option>Funeral Home</option>
                                                                                <option>Implant Distributor</option>
                                                                                <option>Medical Distributor</option>
                                                                                <option>Medical Distributor/Importer</option>
                                                                                <option>Medical Distributor/Pharmacy</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- District -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>District:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="sp_pd_address" name="sp_pd_address" placeholder="Enter district here where SP is located...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Address -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Full Address:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="sp_address" name="sp_address" placeholder="Enter full address of SP here...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Contact Person -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Contact Person:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="sp_contact_person" name="sp_contact_person" placeholder="Enter Contact Person here...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Contact Number -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Contact Number:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="sp_contact_num" name="sp_contact_num" placeholder="Enter Contact Number here...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Status -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>MOA Status:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="status" name="status">
                                                                                <option>New</option>
                                                                                <option>Renewed</option>
                                                                                <option>Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                           <div class="panel-footer">
                                                                <ul class="pager">
                                                                    <li class="previous"><a href="home_admin.php" style="color: white;"><button class="btn btn-block btn-danger waves-effect" type="button">Cancel <span class="fa fa-remove"></span></button></a></li>
                                                                    <li class="next"><a style="color: white;"><button class="btn btn-block btn-primary waves-effect" name="add_newSP" type="submit">Submit <span class="fa fa-paper-plane"></span></button></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> 
                                <!-- end of add_signatories --> 
                            </div>
                            <!--End of tab-content-->
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
            $(".btn_edit_details").click(function(){
                var sp_id = $(this).data('sp_id');
                    $("#modal_sp_id").val(sp_id);
                    console.log(sp_id);
                var sp_name = $(this).data('sp_name');
                    $("#modal_sp_name").val(sp_name);
                    console.log(sp_name);
                var sp_type = $(this).data('sp_type');
                    $("#modal_sp_type").html(sp_type);
                    console.log(sp_type);
                var sp_district = $(this).data('sp_district');
                    $("#modal_sp_district").val(sp_district);
                    console.log(sp_district);
                var sp_address = $(this).data('sp_address');
                    $("#modal_sp_address").val(sp_address);
                    console.log(sp_address);
                var sp_contact_person = $(this).data('sp_contact_person');
                    $("#modal_sp_contact_person").val(sp_contact_person);
                    console.log(sp_contact_person);
                var sp_contact_num = $(this).data('sp_contact_num');
                    $("#modal_sp_contact_num").val(sp_contact_num);
                    console.log(sp_contact_num);
                var sp_status = $(this).data('sp_status');
                    $("#modal_sp_status").val(sp_status);
                    console.log(sp_status);
            });
        });
    </script>

</body>
</html>