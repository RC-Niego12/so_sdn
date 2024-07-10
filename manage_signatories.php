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
    <title>Manage Signatories</title>
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
                <a class="navbar-brand" href="#" title="Manage Signatories - Admin Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Administrator Level</a>
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
                    <li class="active">
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
                                    <a href="#manage_signatories" data-toggle="tab">
                                        <span class="fa fa-cogs" style="color: darkblue;"></span> Manage Signatories
                                    </a>
                                </li>
                                <li>
                                    <a href="#add_signatories" data-toggle="tab">
                                        <span class="fa fa-plus" style="color: darkblue;"></span> Add Signatories
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- manage_signatories -->
                                <div id="manage_signatories" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: hidden; font-size: 1em; width: 50%;">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable text-left">
                                            <thead class="bg-darkblue" style="color: white;">
                                                <tr>
                                                    <th>Index</th>
                                                    <th>Name of Signatories</th>
                                                    <th>Designation</th>
                                                    <th>Amount Range</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM tbl_signatories");
                                                if ($sql->num_rows > 0){
                                                    while($row = mysqli_fetch_assoc($sql)) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" value="<?php echo($row['sig_id']);?>" style="width: 30px; text-align: center; border: none;" readonly>
                                                            <td>
                                                                <?php
                                                                  echo strtoupper($row['fname'])." "; 
                                                                  if (empty($row['mname'])) {
                                                                        echo "";
                                                                  } else {
                                                                        echo strtoupper(substr($row['mname'],0,1)).". ";
                                                                  }
                                                                  echo strtoupper($row['lname']);
                                                                  if ($row['nameext'] == "N/A") {
                                                                        echo "";
                                                                  } else {
                                                                        echo ", ".$row['nameext'];
                                                                  }
                                                                  if (empty($row['suffix'])) {
                                                                        echo "";
                                                                  } else {
                                                                        echo ", ".$row['suffix'];
                                                                  }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $row['designation'];?></td>
                                                            <td>&#8369;<?php echo number_format($row['amt_from']);?> - &#8369;<?php echo number_format($row['amt_to']);?></td>
                                                            <td>
                                                                <button class="btn btn-xs btn-primary waves-effect btn_edit_signatory" name="edit_signatory_modal" type="button" data-toggle="modal" title="Edit Signatory" data-target="#edit_signatory_modal" data-index="<?php echo $row['sig_id'];?>" data-lname="<?php echo $row['lname'];?>" data-fname="<?php echo $row['fname'];?>" data-mname="<?php echo $row['mname'];?>" data-nameext="<?php echo $row['nameext'];?>" data-suffix="<?php echo $row['suffix'];?>" data-designation="<?php echo $row['designation'];?>" data-amt_from="<?php echo $row['amt_from'];?>" data-amt_to="<?php echo $row['amt_to'];?>">
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
                                        <div class="modal fade" id="edit_signatory_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit Signatory Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $_SESSION['modal_sig_id'] = $_SESSION['modal_fname'] = $_SESSION['modal_mname'] = $_SESSION['modal_lname'] = $_SESSION['modal_nameext'] = $_SESSION['modal_suffix'] = $_SESSION['modal_designation'] = $_SESSION['modal_amt_from'] = $_SESSION['modal_amt_to'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['modal_sig_id'] = mysqli_real_escape_string($conn, test_input($_POST['modal_sig_id']));
                                                            $_SESSION['modal_fname'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fname']));
                                                            $_SESSION['modal_mname'] = mysqli_real_escape_string($conn, test_input($_POST['modal_mname']));
                                                            $_SESSION['modal_lname'] = mysqli_real_escape_string($conn, test_input($_POST['modal_lname']));
                                                            $_SESSION['modal_nameext'] = mysqli_real_escape_string($conn, test_input($_POST['modal_nameext']));
                                                            $_SESSION['modal_suffix'] = mysqli_real_escape_string($conn, test_input($_POST['modal_suffix']));
                                                            $_SESSION['modal_designation'] = mysqli_real_escape_string($conn, test_input($_POST['modal_designation']));
                                                            $_SESSION['modal_amt_from'] = mysqli_real_escape_string($conn, test_input($_POST['modal_amt_from']));
                                                            $_SESSION['modal_amt_to'] = mysqli_real_escape_string($conn, test_input($_POST['modal_amt_to']));
                                                            if (isset($_POST['edit_signatory'])) {
                                                                header("location: update_signatory.php");
                                                            }
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <input type="hidden" class="form-control" id="modal_index" name="modal_sig_id">
                                                        <div class="col-sm-12">
                                                            
                                                        <div class="panel-body">
                                                            <!-- Client Last Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Last Name:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="modal_lname" name="modal_lname" placeholder="Last Name" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Client First Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>First Name:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="modal_fname" name="modal_fname" placeholder="First Name" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Client Middle Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-float">
                                                                        <label>Middle Initial:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="modal_mname" name="modal_mname" placeholder="Middle Name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>-->
                                                            </div>
                                                            <!-- Client Name Ext. -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Name Extension:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="modal_nameext" name="modal_nameext">
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>-->
                                                            </div>
                                                            <!-- Suffix -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Name Suffix:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="modal_suffix" name="modal_suffix" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>-->
                                                            </div>
                                                            <!-- Designation. -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Designation:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="modal_designation" name="modal_designation">
                                                                                <option>SDN SWAD Team Leader</option>
                                                                                <option>Chief, Protective Services Division</option>
                                                                                <option>Assistant-Regional Director for Operations</option>
                                                                                <option>Regional Director</option>
                                                                                <option>Petty Cash Custodian</option>
                                                                                <option>Petty Cash Witness</option>
                                                                                <option>PCV Approving Authority</option>
                                                                                <option>AO-III/Records Officer-II</option>
                                                                            </select>
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
                                                                        <label>Amount Range From:</label>
                                                                        <div class="form-line">
                                                                            <input type="number" class="form-control" id="modal_amt_from" name="modal_amt_from" required autofocus>
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
                                                                        <label>Amount Range To:</label>
                                                                        <div class="form-line">
                                                                            <input type="number" class="form-control" id="modal_amt_to" name="modal_amt_to" required autofocus>
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
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="edit_signatory"> Submit <span class="glyphicon glyphicon-send"></span></button>
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
                                <div id="add_signatories" class="tab-pane fade in">
                                    <?php
                                        $_SESSION['fname'] = $_SESSION['mname'] = $_SESSION['lname'] = $_SESSION['nameext'] = $_SESSION['suffix'] = $_SESSION['designation'] = $_SESSION['amt_from'] = $_SESSION['amt_to'] = "";
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            if (isset($_POST['add_signatory'])) {
                                                $_SESSION['fname'] = mysqli_real_escape_string($conn, test_input($_POST['fname']));
                                                $_SESSION['mname'] = mysqli_real_escape_string($conn, test_input($_POST['mname']));
                                                $_SESSION['lname'] = mysqli_real_escape_string($conn, test_input($_POST['lname']));
                                                $_SESSION['nameext'] = mysqli_real_escape_string($conn, test_input($_POST['nameext']));
                                                $_SESSION['suffix'] = mysqli_real_escape_string($conn, test_input($_POST['suffix']));
                                                $_SESSION['designation'] = mysqli_real_escape_string($conn, test_input($_POST['designation']));
                                                $_SESSION['amt_from'] = mysqli_real_escape_string($conn, test_input($_POST['amt_from']));
                                                $_SESSION['amt_to'] = mysqli_real_escape_string($conn, test_input($_POST['amt_to']));
                                                header("location: insert_newSignatory.php");
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
                                            <div class="col-sm-4">
                                                <div class="panel-group">
                                                    <div class="panel panel-primary-dswd">
                                                        <div class="panel-heading panel-title"> 
                                                            <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Complete Name</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- Client Last Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Client First Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" name="fname" placeholder="First Name" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Client Middle Name -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" name="mname" placeholder="Middle Name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>-->
                                                            </div>
                                                            <!-- Client Name Ext. -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Name Extension:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="nameext" name="nameext">
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
                                                            <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Suffix & Designation</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- suffix -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-12">
                                                                    <div class="form-group form-float">
                                                                        <label>Name Suffix:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" name="suffix" placeholder="ex. RSW, MSSW, SWO-I, SWO-II, etc.">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>-->
                                                            </div>
                                                            <!-- Designation. -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float" style="text-align: left;">
                                                                        <label>Designation:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="designation" name="designation">
                                                                                <option>SDN SWAD Team Leader</option>
                                                                                <option>Chief, Protective Services Division</option>
                                                                                <option>Assistant-Regional Director for Operations</option>
                                                                                <option>Regional Director</option>
                                                                                <option>Petty Cash Custodian</option>
                                                                                <option>Petty Cash Witness</option>
                                                                                <option>PCV Approving Authority</option>
                                                                                <option>AO-III/Records Officer-II</option>
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
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="panel-group">
                                                    <div class="panel panel-primary-dswd">
                                                        <div class="panel-heading panel-title"> 
                                                            <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Amount Range</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>From:</label>
                                                                        <div class="form-line">
                                                                            <input type="number" class="form-control" name="amt_from" placeholder="ex. 1, 50001, 75001, 100001" required autofocus>
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
                                                                        <label>To:</label>
                                                                        <div class="form-line">
                                                                            <input type="number" class="form-control" name="amt_to" placeholder="ex. 50000, 75000, 100000, 150000" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               <div class="panel-footer">
                                                    <ul class="pager">
                                                        <li class="previous"><a href="home_admin.php" style="color: white;"><button class="btn btn-block btn-danger waves-effect" type="button">Cancel <span class="fa fa-remove"></span></button></a></li>
                                                        <li class="next"><a style="color: white;"><button class="btn btn-block btn-primary waves-effect" name="add_signatory" type="submit">Submit <span class="fa fa-paper-plane"></span></button></a></li>
                                                    </ul
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
    <script src="js/pages/tables/jquery-datatable.js"></script>
    
    <script>
        $(document).ready(function() {
            $(".btn_edit_signatory").click(function(){
                var index = $(this).data('index');
                    $("#modal_index").val(index);
                    console.log(index);
                var lname = $(this).data('lname');
                    $("#modal_lname").val(lname);
                    console.log(lname);
                var fname = $(this).data('fname');
                    $("#modal_fname").val(fname);
                    console.log(fname);
                var mname = $(this).data('mname');
                    $("#modal_mname").val(mname);
                    console.log(mname);
                var nameext = $(this).data('nameext');
                    $("#modal_nameext").val(nameext);
                    console.log(nameext);
                var suffix = $(this).data('suffix');
                    $("#modal_suffix").val(suffix);
                    console.log(suffix);
                var designation = $(this).data('designation');
                    $("#modal_designation").val(designation);
                    console.log(designation);
                var amt_from = $(this).data('amt_from');
                    $("#modal_amt_from").val(amt_from);
                    console.log(amt_from);
                var amt_to = $(this).data('amt_to');
                    $("#modal_amt_to").val(amt_to);
                    console.log(amt_to);
            });
        });
    </script>

</body>
</html>