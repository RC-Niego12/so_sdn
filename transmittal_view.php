<?php
    // Start the session
    session_start();
    date_default_timezone_set('Asia/Manila'); $datenow = date('d-m-Y');

    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    $trml_codee = $_SESSION['trml_code2']; $trml_date = $_SESSION['trml_date2']; $prep_by = $_SESSION['prep_by2'];
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
    <title><?php echo $trml_codee; ?></title>
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
                <a class="navbar-brand" href="#" title="Track Billings - Billings Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Billings Level</a>
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
                        <a href="transmittal_obsdv.php">
                            <span class="fa fa-arrow-circle-left"></span>
                            <span>Back</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="transmittal_view.php">
                            <span class="fa fa-eye"></span>
                            <span>View Transmittal</span>
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
                                    <a href="#transmittal_view" data-toggle="tab">
                                        <span class="fa fa-arrow-circle-o-right" style="color: #337ab7;"></span> <?php echo $trml_codee; ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <div id="transmittal_view" class="tab-pane fade in active">
                                    <button onclick="print_view_transmittal()" class="btn btn-primary waves-effect" name="print_view_transmittal" style="position: fixed; top: 145px;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <div class="">
                                        <page size="A4flex" layout="orientation" class="page2">
                                            <div class="header-logos">
                                                <img src="images/DSWD-logo.png" class="header-logos-dswd-logo">
                                                <img src="images/dswd-caraga-logo.png" class="header-logos-dswdcaraga-logo">
                                                <img src="images/dswd-aics-logo.png" class="header-logos-aics-logo">
                                                <!--
                                                <div class="header-logos-cis-logo">
                                                        <p>CRISIS INTERVENTION SECTION</p>
                                                        <p style="font-size: 11px;">PROTECTIVE SERVICES DIVISION</p>
                                                        <p>FIELD OFFICE CARAGA</p>
                                                        <p style="font-size: 9px;">DSWD-PMB-GF-014 | REV 01 /30 SEPT 2022</p>
                                                </div>
                                                -->
                                            </div>
                                            <p style="font-size: 9px; font-family: Times New Roman; font-weight: bold;">DSWD-PMB-GF-015 | REV 01 /30 SEPT 2022</p>
                                            <br><br>
                                            <table class="trml_header text-left">
                                                <tr style="font-weight: bold;">
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;">FOR:</td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">
                                                        <?php
                                                            $sql_for_rd = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'Regional Director' ");
                                                            $row_for_rd = mysqli_fetch_assoc($sql_for_rd);
                                                            echo strtoupper($row_for_rd['fname'])." "; if (empty($row_for_rd['mname'])) { echo ""; } else { echo strtoupper(substr($row_for_rd['mname'],0,1)).". "; } echo strtoupper($row_for_rd['lname']); if ($row_for_rd['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_for_rd['nameext']; } if (empty($row_for_rd['suffix'])) {echo ''; } else { echo ', '.$row_for_rd['suffix']; }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">Regional Director</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">DSWD Field Office Caraga</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;"></td>
                                                </tr>
                                                <tr style="font-weight: bold;">
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;">THRU:</td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">
                                                        <?php
                                                            $sql_thru = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'AO-III/Records Officer-II' ");
                                                            $row_thru= mysqli_fetch_assoc($sql_thru);
                                                            echo strtoupper($row_thru['fname'])." "; if (empty($row_thru['mname'])) { echo ""; } else { echo strtoupper(substr($row_thru['mname'],0,1)).". "; } echo strtoupper($row_thru['lname']); if ($row_thru['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_thru['nameext']; } if (empty($row_thru['suffix'])) {echo ''; } else { echo ', '.$row_thru['suffix']; }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">AO-III/Records Officer-II</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">DSWD Field Office Caraga</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;"></td>
                                                </tr>
                                                <tr style="font-weight: bold;">
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;">FROM:</td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">
                                                        <?php
                                                            $sql_from = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'SDN SWAD Team Leader' ");
                                                            $row_from= mysqli_fetch_assoc($sql_from);
                                                            echo strtoupper($row_from['fname'])." "; if (empty($row_from['mname'])) { echo ""; } else { echo strtoupper(substr($row_from['mname'],0,1)).". "; } echo strtoupper($row_from['lname']); if ($row_from['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_from['nameext']; } if (empty($row_from['suffix'])) {echo ''; } else { echo ', '.$row_from['suffix']; }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">SWAD Team Leader</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">
                                                        <?php
                                                            echo $row_sysname['office']." - ".$row_sysname['office_full_name'];
                                                        ?>   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;"></td>
                                                </tr>
                                                <tr style="font-weight: bold;">
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;">SUBJECT:</td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">Transmittal of Reportorial Documents</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;"></td>
                                                </tr>
                                                <tr style="font-weight: bold;">
                                                    <td style="text-align: left; width: 70px; padding: 2px !important; border-bottom: solid black 1px !important;">DATE:</td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important; border-bottom: solid black 1px !important;">
                                                        <?php
                                                            echo date_format(new DateTime($trml_date), "M. d, Y");
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                                                    <td colspan="4" style="text-align: left; padding: 2px !important;">Submitting herewith the following documents, to wit:</td>
                                                </tr>
                                                <tr style="font-weight: bold; text-decoration: underline;">
                                                    <td colspan="5" style="text-align: left; padding: 2px !important;">> Vouchers (c/o Sir Charlie)</td>
                                                </tr>
                                            </table>
                                            <table class="tracked_obdv text-left" style="width: 100% !important;">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Service Provider</th>
                                                        <th>Period Covered</th>
                                                        <th>Amount</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql_obdv = mysqli_query($conn, "SELECT * FROM tbl_obs_dv_transmitted INNER JOIN tbl_obs_dv_transmittal ON tbl_obs_dv_transmitted.transmittal_code2 = tbl_obs_dv_transmittal.transmittal_code INNER JOIN tbl_obs_dv ON tbl_obs_dv_transmitted.obdv_code2 = tbl_obs_dv.obs_dv_code WHERE transmittal_code2='$trml_codee' ");
                                                        $q=0;
                                                        if ($sql_obdv->num_rows > 0){
                                                            while($row_obdv = mysqli_fetch_assoc($sql_obdv)) {
                                                                $ns = $row_obdv['num_series'];
                                                                $obdv_code = $row_obdv['obs_dv_code'];
                                                                $bill_code = $row_obdv['billing_code'];
                                                                $prep_date = $row_obdv['obs_dv_date'];                                                                   
                                                                $trml_obdv_code = $row_obdv['obdv_code2'];
                                                                ?>
                                                                <tr>
                                                                    <td style="padding: 1px !important;"><?php echo $q+1; $q++; ?></td>
                                                                    <?php
                                                                        $bl_code_exp = explode(',', $bill_code);
                                                                        $bl_code_arrval = array_values($bl_code_exp);
                                                                        $count = count($bl_code_arrval)-2;
                                                                        $count2 = $count+1;
                                                                        //Loop through each array index
                                                                        for($i = 0; $i <= $count; $i++) {
                                                                            $i2 = $i+1;
                                                                            //Assign the value of the array key to a variable
                                                                            $bl_code = $bl_code_arrval[$i];
                                                                        }
                                                                        $sql_sp = mysqli_query($conn, "SELECT * FROM tbl_track_gl WHERE billing_code='$bl_code' ");
                                                                        $row_sp = mysqli_fetch_assoc($sql_sp);
                                                                        $sp_id = $row_sp['sp_id'];
                                                                        $sql_tck_sp = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga WHERE id='$sp_id' ");
                                                                        $row_tck_sp = mysqli_fetch_assoc($sql_tck_sp);
                                                                    ?>
                                                                    <td style="padding: 1px !important;"><?php echo $row_tck_sp['sp_name']; ?></td>
                                                                    <td style="padding: 1px !important; text-align: left;">
                                                                        <?php
                                                                            $bill_ttlp = 0;
                                                                            //Loop through each array index
                                                                            for($iip = 0; $iip <= $count; $iip++) {
                                                                                $iip2 = $iip+1;
                                                                                //Assign the value of the array key to a variable
                                                                                $bl_codee = $bl_code_arrval[$iip];
                                                                                //echo $bl_codee;
                                                                                $sql_bl_ttlp = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$bl_codee' ORDER BY time_start2 ASC LIMIT 1");
                                                                                    $row_bl_ttlp = mysqli_fetch_assoc($sql_bl_ttlp);
                                                                                    $t1 = $row_bl_ttlp['time_end2'];
                                                                                $sql_bl_ttlpp = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$bl_codee' ORDER BY time_start2 DESC LIMIT 1");
                                                                                    $row_bl_ttlpp = mysqli_fetch_assoc($sql_bl_ttlpp);
                                                                                    $t2 = $row_bl_ttlpp['time_end2'];
                                                                                    if (date_format(new DateTime($t1), "M. d, Y")==date_format(new DateTime($t2), "M. d, Y")) {
                                                                                        echo date_format(new DateTime($t1), "M. d, Y").' | ';
                                                                                    } else {
                                                                                        echo date_format(new DateTime($t1), "M. d, Y").' - '.date_format(new DateTime($t2), "M. d, Y").' | ';
                                                                                    }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="padding: 1px !important;">
                                                                        <?php
                                                                            $bill_ttl = 0;
                                                                            //Loop through each array index
                                                                            for($ii = 0; $ii <= $count; $ii++) {
                                                                                $ii2 = $ii+1;
                                                                                //Assign the value of the array key to a variable
                                                                                $bl_codee = $bl_code_arrval[$ii];
                                                                                //echo $bl_codee;
                                                                                $sql_bl_ttl = mysqli_query($conn, "SELECT * FROM tbl_tracked_gls INNER JOIN tbl_save_addl_entry ON tbl_tracked_gls.gl_id = tbl_save_addl_entry.id_tbl_save_addl_entry WHERE billing_code='$bl_codee' ");
                                                                                    if ($sql_bl_ttl->num_rows > 0) {
                                                                                        while($row_bl_ttl = mysqli_fetch_assoc($sql_bl_ttl)) {
                                                                                            $bill_ttl += $row_bl_ttl['amount_in_figures'];
                                                                                        }
                                                                                    }
                                                                            }
                                                                            echo number_format($bill_ttl,2);
                                                                        ?>
                                                                    </td>
                                                                    <td style="padding: 1px !important;">complete attachments</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                        <th colspan="1"></th>
                                                        <th colspan="1"></th>
                                                    </tr>
                                                </tfoot>
                                            </table><br><br>
                                            <table class="trml_prep text-left" style="width: 100% !important;">
                                                <tr style="font-weight: bold;">
                                                    <td style="text-align: left; width: 40% !important; padding: 2px !important;">PREPARED BY:</td>
                                                    <td style="text-align: left; width: 20% !important; padding: 2px !important;"></td>
                                                    <td style="text-align: left; width: 40% !important; padding: 2px !important;">RECEIVED BY:</td>
                                                </tr>
                                                <tr>
                                                    <td style=" padding: 20px !important;"></td>
                                                    <td style=" padding: 20px !important;"></td>
                                                    <td style=" padding: 20px !important;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important; border-bottom: solid black 0.5px !important;">Name: <b><?php echo strtoupper($prep_by); ?></b></td>
                                                    <td></td>
                                                    <td style="text-align: left; padding: 2px !important; border-bottom: solid black 0.5px !important;">Name:</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; width: 70px; padding: 2px !important; border-bottom: solid black 0.5px !important;">Designation:</td>
                                                    <td></td>
                                                    <td style="text-align: left; padding: 2px !important; border-bottom: solid black 0.5px !important;">Designation:</td>
                                                </tr>
                                            </table>
                                            <div class="container-footer container-fluid">
                                                <img src="images/dswd-footer-logo.png">
                                            </div>
                                        </page>
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
        function print_view_transmittal() {
          window.open("print_view_transmittal2.php");
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        var table_tracked_obdv = $('.tracked_obdv').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            searching: false,
            buttons: [
                //'excelHtml5'
            ],
            paging: false,
            //orderCellsTop: true,
            //fixedHeader: true,
            footerCallback: function (row, data, start, end, display) {
                var api_ttl_amt = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
     
                // Total over all pages
                total = api_ttl_amt
                    .column(3)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(3).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
    </script>

</body>
</html>