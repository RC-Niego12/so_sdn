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
    <title>Manage Funds</title>
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
                <a class="navbar-brand" href="#" title="Manage Assistance - Admin Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Administrator Level</a>
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
                    <li class="active">
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
                                    <a href="#manage_funds" data-toggle="tab">
                                        <span class="fa fa-cogs" style="color: darkblue;"></span> Manage Funds
                                    </a>
                                </li>
                                <li>
                                    <a href="#add_fund" data-toggle="tab">
                                        <span class="fa fa-plus" style="color: darkblue;"></span> Add Fund Source
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- manage_funds -->
                                <div id="manage_funds" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: hidden; font-size: 1em; width: 100%;">
                                        <table class="table table-bordered table-striped table-hover tbl_funds dataTable text-left">
                                            <thead class="bg-darkblue" style="color: white;">
                                                <tr id="tbl_funds_thead_tr">
                                                    <th>No.</th>
                                                    <th>SAA#</th>
                                                    <th>Fund Code</th>
                                                    <th>Source</th>
                                                    <th>Proponent</th>
                                                    <th>Allocation</th>
                                                    <th>Disbursed</th>
                                                    <th>Remaining Balance</th>
                                                    <th>Clients Served</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql_fund = mysqli_query($conn, "SELECT * FROM tbl_funds");
                                                if ($sql_fund->num_rows > 0){
                                                    while($row_fund = mysqli_fetch_assoc($sql_fund)) {
                                                        if ($row_fund['fund_status'] == "Depleted") {
                                                        ?>
                                                        <tr style="background-color: red; color: white;">
                                                        <?php
                                                        } else if ($row_fund['fund_status'] == "Available") {
                                                        ?>
                                                        <tr style="background-color: lightgreen;">
                                                        <?php
                                                        }
                                                        ?>
                                                            <td style="color: black !important;">
                                                                <input type="text" value="<?php echo($row_fund['fund_id']);?>" style="width: 30px; text-align: center; border: none;" readonly>
                                                            </td>
                                                            <td>SAA# <?php echo $row_fund['fund_saa']; ?></td>
                                                            <td><?php echo $row_fund['fund_code']; ?></td>
                                                            <td><?php echo $row_fund['fund_source']; ?></td>
                                                            <td><?php echo $row_fund['fund_proponent']; ?></td>
                                                            <td><?php echo number_format($row_fund['fund_allocation'],2); ?></td>
                                                            <td>
                                                                <?php
                                                                    $rw_fnd_cod = $row_fund['fund_code'];
                                                                    $sql_fnd_dsbrd = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE fund_source='$rw_fnd_cod' AND cancellation!='YES' ");
                                                                    $ttl_amt_dsbrd = 0;
                                                                    if ($sql_fnd_dsbrd->num_rows > 0){
                                                                        while($row_fnd_dsbrd = mysqli_fetch_assoc($sql_fnd_dsbrd)) {
                                                                            $ttl_amt_dsbrd = $ttl_amt_dsbrd + $row_fnd_dsbrd['amount_in_figures'];
                                                                        }
                                                                    } echo number_format($ttl_amt_dsbrd,2);
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $rem_bal = 0;
                                                                    $rem_bal = $row_fund['fund_allocation'] - $ttl_amt_dsbrd;
                                                                    echo number_format($rem_bal,2);
                                                                ?>
                                                            </td>
                                                            <td><?php echo $sql_fnd_dsbrd->num_rows; ?></td>
                                                            <td><?php echo $row_fund['fund_status']; ?></td>
                                                            <td><?php echo $row_fund['fund_remarks']; ?></td>
                                                            <td>
                                                                <button class="btn btn-xs btn-primary waves-effect btn_edit_fund" name="edit_fund_modal" type="button" data-toggle="modal" title="Edit Fund Details" data-target="#edit_fund_modal" data-fund_id="<?php echo $row_fund['fund_id'];?>" data-fund_saa="<?php echo $row_fund['fund_saa'];?>" data-fund_code="<?php echo $row_fund['fund_code'];?>" data-fund_source="<?php echo $row_fund['fund_source'];?>" data-fund_proponent="<?php echo $row_fund['fund_proponent'];?>" data-fund_allocation="<?php echo $row_fund['fund_allocation'];?>" data-fund_status="<?php echo $row_fund['fund_status'];?>" data-fund_remarks="<?php echo $row_fund['fund_remarks'];?>">
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
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5" style="text-align: right;">TOTAL >>></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th colspan="3"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_fund_modal" role="dialog">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit Fund Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        //do not shit

                                                        $_SESSION['modal_fund_id'] = $_SESSION['modal_fund_code'] = $_SESSION['modal_fund_proponent'] = "";
                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            $_SESSION['modal_fund_id'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_id']));
                                                            $_SESSION['modal_fund_saa'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_saa']));
                                                            $_SESSION['modal_fund_code'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_code']));
                                                            $_SESSION['modal_fund_source'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_source']));
                                                            $_SESSION['modal_fund_proponent'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_proponent']));
                                                            $_SESSION['modal_fund_allocation'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_allocation']));
                                                            $_SESSION['modal_fund_status'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_status']));
                                                            $_SESSION['modal_fund_remarks'] = mysqli_real_escape_string($conn, test_input($_POST['modal_fund_remarks']));
                                                            if (isset($_POST['edit_fund'])) {
                                                                header("location: update_fund.php");
                                                            }
                                                        }
                                                    ?>
                                                    <form method="POST" action="">
                                                        <input type="hidden" class="form-control" id="modal_fund_id" name="modal_fund_id">
                                                        <div class="col-sm-12">
                                                            <div class="panel-body">
                                                                <!-- SAA# -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Fund SAA#:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_fund_saa" name="modal_fund_saa" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Code -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group form-float">
                                                                            <label>Fund Code (Can't Edit/Read Only):</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_fund_code" name="modal_fund_code" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--
                                                                        <div class="col-xs-1">
                                                                            <span style="color: red; font-size: 2em;">*</span>
                                                                        </div>
                                                                    -->
                                                                </div>
                                                                <!-- Source -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Fund Source:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_fund_source" name="modal_fund_source" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Proponent -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Fund Proponent:</label>
                                                                            <div class="form-line">
                                                                                <input type="text" class="form-control" id="modal_fund_proponent" name="modal_fund_proponent" required autofocus>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Allocation -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Fund Allocation:</label>
                                                                            <div class="form-line">
                                                                                <input type="number" step="any" class="form-control" id="modal_fund_allocation" name="modal_fund_allocation" required autofocus>
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
                                                                        <div class="form-group form-float">
                                                                            <label>Fund Status:</label>
                                                                            <div class="form-line">
                                                                                <select class="form-control" id="modal_fund_status" name="modal_fund_status">
                                                                                    <option>Available</option>
                                                                                    <option>Depleted</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-1">
                                                                        <span style="color: red; font-size: 2em;">*</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Remarks -->
                                                                <div class="row clearfix">
                                                                    <div class="col-xs-11">
                                                                        <div class="form-group form-float">
                                                                            <label>Remarks:</label>
                                                                            <div class="form-line">
                                                                                <textarea type="text" rows="5" class="form-control" id="modal_fund_remarks" name="modal_fund_remarks" required autofocus></textarea>
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
                                                                <button type="submit" class="btn btn-block btn-primary waves-effect" name="edit_fund"> Submit <span class="glyphicon glyphicon-send"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <!-- end manage_funds -->
                                <!-- add_fund -->
                                <div id="add_fund" class="tab-pane fade in">
                                    <?php
                                        $_SESSION['fund_code'] = $_SESSION['fund_proponent'] = "";
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            if (isset($_POST['add_fund'])) {
                                                $_SESSION['fund_saa'] = mysqli_real_escape_string($conn, test_input($_POST['fund_saa']));
                                                $_SESSION['fund_code'] = mysqli_real_escape_string($conn, test_input($_POST['fund_code']));
                                                $_SESSION['fund_source'] = mysqli_real_escape_string($conn, test_input($_POST['fund_source']));
                                                $_SESSION['fund_proponent'] = mysqli_real_escape_string($conn, test_input($_POST['fund_proponent']));
                                                $_SESSION['fund_allocation'] = mysqli_real_escape_string($conn, test_input($_POST['fund_allocation']));
                                                $_SESSION['fund_status'] = mysqli_real_escape_string($conn, test_input($_POST['fund_status']));
                                                $_SESSION['fund_remarks'] = mysqli_real_escape_string($conn, test_input($_POST['fund_remarks']));
                                                header("location: insert_newFund.php");
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
                                                            <h4 class="text-center" style="margin: auto; padding: 10px 0; color: white;">Enter Fund Details Below:</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- Fund SAA# -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Fund SAA#:</label>
                                                                        <div class="form-line">
                                                                            <input type="number" class="form-control" id="fund_saa" name="fund_saa" placeholder="ex. 15" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Fund Code -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Fund Code:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="fund_code" name="fund_code" placeholder="ex. CI-SDN2, CI-Gov-SDN, CI-Tingog-SDN2" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Source -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Fund Source:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="fund_source" name="fund_source" placeholder="ex. Sen. Juan dela Cruz, Cong. Juan dela Cruz, Cong. Juan dela Cruz (PL)" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Proponent -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Fund Proponent:</label>
                                                                        <div class="form-line">
                                                                            <input type="text" class="form-control" id="fund_proponent" name="fund_proponent" placeholder="ex. Cong. Juan dela Cruz, Cong. Juan dela Cruz (PL), Mayor Juan dela Cruz" required autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Allocation -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Fund Allocation:</label>
                                                                        <div class="form-line">
                                                                            <input type="number" step="any" class="form-control" id="fund_allocation" name="fund_allocation" placeholder="ex. 2000000" required autofocus>
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
                                                                    <div class="form-group form-float">
                                                                        <label>Fund Status:</label>
                                                                        <div class="form-line">
                                                                            <select class="form-control" id="fund_status" name="fund_status">
                                                                                <option>Available</option>
                                                                                <option>Depleted</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1">
                                                                    <span style="color: red; font-size: 2em;">*</span>
                                                                </div>
                                                            </div>
                                                            <!-- Remarks -->
                                                            <div class="row clearfix">
                                                                <div class="col-xs-11">
                                                                    <div class="form-group form-float">
                                                                        <label>Fund Remarks:</label>
                                                                        <div class="form-line">
                                                                            <textarea type="text" rows="5" class="form-control" id="fund_remarks" name="fund_remarks" placeholder="ex. c/o Sample Center / Cong. Dela Cruz | Feb. 2, 2024-confirmed additional 2M fund" required autofocus></textarea>
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
                                                                    <li class="next"><a style="color: white;"><button class="btn btn-block btn-primary waves-effect" name="add_fund" type="submit">Submit <span class="fa fa-paper-plane"></span></button></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> 
                                <!-- end of add_assistance --> 
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
        var tbl_funds = $('.tbl_funds').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [-1],
                ['All'],
            ],
            initComplete: function () {
                var api = this.api();
     
                // For each column
                api
                    .columns()
                    .eq(0)
            },
            footerCallback: function (row, data, start, end, display) {
                var api_ttl_amt = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total allocation
                allocation = api_ttl_amt
                    .column(5, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Total dsbrd
                dsbrd = api_ttl_amt
                    .column(6, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Total rem. bal.
                rem_bal = api_ttl_amt
                    .column(7, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
         
                // Total served clients
                srvd_cl = api_ttl_amt
                    .column(8, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Update footer
                //$(api_ttl_amt.column(45).footer()).html(parseFloat(pageTotal.toFixed(2)) + 'current total<br>(' + total.toFixed(2) + ' total)');
                $(api_ttl_amt.column(5).footer()).html(allocation.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(6).footer()).html(dsbrd.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(7).footer()).html(rem_bal.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(8).footer()).html(srvd_cl.toLocaleString('en'));
            }
        });
            $(".btn_edit_fund").click(function(){
                var fund_id = $(this).data('fund_id');
                    $("#modal_fund_id").val(fund_id);
                    console.log(fund_id);
                var fund_saa = $(this).data('fund_saa');
                    $("#modal_fund_saa").val(fund_saa);
                    console.log(fund_saa);
                var fund_code = $(this).data('fund_code');
                    $("#modal_fund_code").val(fund_code);
                    console.log(fund_code);
                var fund_source = $(this).data('fund_source');
                    $("#modal_fund_source").val(fund_source);
                    console.log(fund_source);
                var fund_proponent = $(this).data('fund_proponent');
                    $("#modal_fund_proponent").val(fund_proponent);
                    console.log(fund_proponent);
                var fund_allocation = $(this).data('fund_allocation');
                    $("#modal_fund_allocation").val(fund_allocation);
                    console.log(fund_allocation);
                var fund_status = $(this).data('fund_status');
                    $("#modal_fund_status").val(fund_status);
                    console.log(fund_status);
                var fund_remarks = $(this).data('fund_remarks');
                    $("#modal_fund_remarks").val(fund_remarks);
                    console.log(fund_remarks);
            });
        });
    </script>

</body>
</html>