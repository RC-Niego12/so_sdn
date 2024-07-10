<?php
    // Start the session
    session_start();
    $_SESSION['start_date3']; $_SESSION['end_date3']; $_SESSION['datenow']; $_SESSION['sp_id'];
    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword']; $_SESSION['checkbox'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];
    $cis_office = $row_sysname['cis_office'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $row = mysqli_fetch_assoc($sql);

    $checkbox_exp = explode(',', $_SESSION['checkbox']);
    $checkbox_arrval = array_values($checkbox_exp);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Track GLs (Step 2)</title>
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
                        <a href="track_GLs2.php">
                            <span class="fa fa-file"></span>
                            <span>Track GLs (Step 2)</span>
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
                                    <a href="#set_base_details" data-toggle="tab">
                                        <span class="fa fa-file"></span> Selected GLs
                                    </a>
                                </li>
                                <li>
                                    <a href="#2" data-toggle="tab">
                                        <span class="fa fa-file" style="color: lightgreen;"></span> #2
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- set_base_details -->
                                <div id="set_base_details" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="border-top: solid gray 2px; border-bottom: solid gray 2px;">
                                            <?php
                                                if (isset($_POST['submit'])) {
                                                    /**
                                                    $_SESSION['billing_code'] = mysqli_real_escape_string($conn, $_POST['billing_code']);
                                                    $_SESSION['billing_date'] = mysqli_real_escape_string($conn, $_POST['billing_date']);
                                                    $_SESSION['sp_id'] = mysqli_real_escape_string($conn, $_POST['sp_id']);
                                                    $_SESSION['date_received'] = mysqli_real_escape_string($conn, $_POST['date_received']);
                                                    $_SESSION['received_by'] = mysqli_real_escape_string($conn, $_POST['received_by']);
                                                    $_SESSION['period_from'] = mysqli_real_escape_string($conn, $_POST['period_from']);
                                                    $_SESSION['period_to'] = mysqli_real_escape_string($conn, $_POST['period_to']);
                                                    header("Location: insert_tracked_GLs.php");
                                                    **/

                                                    $_SESSION['billing_date'] = mysqli_real_escape_string($conn, $_POST['billing_date']);
                                                    $_SESSION['sp_id'] = mysqli_real_escape_string($conn, $_POST['sp_id']);
                                                    $_SESSION['date_received'] = mysqli_real_escape_string($conn, $_POST['date_received']);
                                                    $_SESSION['received_by'] = mysqli_real_escape_string($conn, $_POST['received_by']);
                                                    $_SESSION['period_from'] = mysqli_real_escape_string($conn, $_POST['period_from']);
                                                    $_SESSION['period_to'] = mysqli_real_escape_string($conn, $_POST['period_to']);
                                                    header("Location: insert_tracked_GLs.php");

                                                }
                                            ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                <table class="table table-bordered table-striped table-hover result dataTable text-left">
                                                    <?php
                                                        $start_date = date_format(new DateTime($_SESSION['start_date3']), "M. d, Y");
                                                        $end_date = date_format(new DateTime($_SESSION['end_date3']), "M. d, Y");
                                                    ?>
                                                    <h4 style="text-align: center;">Selected Transactions (GLs) for the Period of <?php echo $start_date.' - '.$end_date; ?></h4>
                                                    <?php //echo 'Checkbox Array: '.$_SESSION['checkbox']; ?>
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>ID</th>
                                                            <th>Client</th>
                                                            <th>Beneficiary</th>
                                                            <th>GL Date</th>
                                                            <th>GL Code</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody><br>
                                                        <?php
                                                            $count = count($checkbox_arrval)-2; $count2 = $count+1;
                                                            //echo 'Count: '.$count2.'<br>';
                                                            //Loop through each array index
                                                            for($i = 0; $i <= $count; $i++) {
                                                                $i2 = $i+1;
                                                                //Assign the value of the array key to a variable
                                                                $value = $checkbox_arrval[$i];
                                                                //echo 'Value '.$i2.': '.$value.'; ';
                                                                //Check if result string contains diam-mm
                                                                $sql_result = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE id_tbl_save_clientbene='$value' AND id_tbl_save_addl_entry='$value' ");
                                                                $row_result = mysqli_fetch_assoc($sql_result);
                                                                    $transaction_date = date_format(new DateTime($row_result['time_start']), "M. d, Y");
                                                                    $bn_name = $row_result['bn_lname'].', '.$row_result['bn_fname'].' '.$row_result['bn_nameext'].' '.$row_result['bn_mname'];
                                                                    $amount_fig = $row_result['amount_in_figures'];
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $i+1; ?></td>
                                                                        <td><?php echo $row_result['id_tbl_save_clientbene']; ?></td>
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
                                                                        <td><?php echo $transaction_date; ?></td>
                                                                        <td><?php echo $row_result['transaction_code']; ?></td>
                                                                        <td><?php echo number_format($amount_fig,2); ?></td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="6" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div class="row clearfix">
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                        <div class="form-group form-float" style="text-align: left;">
                                                            <div class="form-line">
                                                                <input class="form-control" type="hidden" name="period_from" value="<?php echo $_SESSION['start_date3'];?>" required autofocus>
                                                                <input class="form-control" type="hidden" name="period_to" value="<?php echo $_SESSION['end_date3'];?>" required autofocus>
                                                                <input class="form-control" type="hidden" name="sp_id" value="<?php echo $_SESSION['sp_id'];?>" required autofocus>
                                                                <label>Billing Date (<span style="color: red;">Note: Change date if necessary</span>): <span style="color: red; font-size: 14px;">*</span></label>
                                                                <input class="form-control" type="date" name="billing_date" value="<?php echo $_SESSION['datenow'];?>" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                        <div class="form-group form-float" style="text-align: left;">
                                                            <div class="form-line">
                                                                <label>Date Received (<span style="color: red;">Note: Change date if necessary</span>): <span style="color: red; font-size: 14px;">*</span></label>
                                                                <input class="form-control" type="date" name="date_received" value="<?php echo $_SESSION['datenow'];?>" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                        <div class="form-group form-float" style="text-align: left;">
                                                            <div class="form-line">
                                                                <label>Received by: <span style="color: red; font-size: 14px;">*</span></label>
                                                                <input class="form-control" type="text" name="received_by" placeholder="Enter name of concerned staff here (ex. FName LName)..." required autofocus>
                                                				<!--<input type="date" name="datenow" value="<?php //echo $_SESSION['datenow'];?>" required autofocus>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--BILLING CODE START
                                                <div class="row clearfix">
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                        <div class="form-group form-float" style="text-align: left;">
                                                            <div class="form-line">
                                                                <label>Billing Code (<span style="color: red;">Note: This code is Automated. Write this code on the bill</span>): <span style="color: red; font-size: 14px;">*</span></label>
                                                                <?php
                                                                /**
                                                                    $ynow = date_format(new DateTime($_SESSION['datenow']), "Y");
                                                                    $mnow = date_format(new DateTime($_SESSION['datenow']), "m");
                                                                    //$datenow = 02-12-2023;
                                                                    $sql_billingcode = mysqli_query($conn,"SELECT * FROM tbl_track_gl WHERE YEAR(date_tracked)='$ynow' AND MONTH(date_tracked)=$mnow;");
                                                                    if ($sql_billingcode->num_rows > 0){
                                                                        $bill_count = $sql_billingcode->num_rows;
                                                                        $bill_count2 = $bill_count+1;
                                                                        if (strlen($bill_count2)==1) {
                                                                            $bill_count2 = "000".$bill_count2;
                                                                        } else if (strlen($bill_count2)==2) {
                                                                            $bill_count2 = "00".$bill_count2;
                                                                        } else if (strlen($bill_count2)==3) {
                                                                            $bill_count2 = "0".$bill_count2;
                                                                        } else {$bill_count2;}
                                                                        $bill_mo = date_format(new DateTime($_SESSION['start_date']), "m");
                                                                        $bill_y = date_format(new DateTime($_SESSION['start_date']), "Y");
                                                                        $billing_code = $cis_office."-GLBill-".$bill_y."-".$bill_mo."-".$bill_count2;
                                                                    } else {
                                                                        $bill_count = 0;
                                                                        $bill_count2 = $bill_count+1;
                                                                        if (strlen($bill_count2)==1) {
                                                                            $bill_count2 = "000".$bill_count2;
                                                                        } else if (strlen($bill_count2)==2) {
                                                                            $bill_count2 = "00".$bill_count2;
                                                                        } else if (strlen($bill_count2)==3) {
                                                                            $bill_count2 = "0".$bill_count2;
                                                                        } else {$bill_count2;}
                                                                        $bill_mo = date_format(new DateTime($_SESSION['start_date']), "m");
                                                                        $bill_y = date_format(new DateTime($_SESSION['start_date']), "Y");
                                                                        $billing_code = $cis_office."-GLBill-".$bill_y."-".$bill_mo."-".$bill_count2;
                                                                    }
                                                                **/
                                                                ?>
                                                                <input type="text" class="form-control" id="billing_code" name="billing_code" value="<?php echo $billing_code;?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                                                </div>
                                                BILLING CODE END-->

                                                <div class="clearfix">
                                                    <div style="width: 100%;">
                                                        <button type="submit" name="submit" class="btn btn-primary waves-effect" style="display: block; margin: auto;">Submit <span class="fa fa-paper-plane"></span></button>
                                                    </div>
                                                </div><br>
                                            </form>
                                        </div>
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

        var table_result = $('.result').DataTable({
            paging: false, searching: false,
            footerCallback: function (row, data, start, end, display) {
                var api_ttl_amt = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total over all pages
                total = api_ttl_amt
                    .column(6)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                $(api_ttl_amt.column(6).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
    </script>

</body>
</html>