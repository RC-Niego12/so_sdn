<?php
    // Start the session
    session_start();
    $_SESSION['cl_qn2'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql_tbl_staffs = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $row1 = mysqli_fetch_assoc($sql_tbl_staffs);

    $sql_tbl_save_clientbene = mysqli_query($conn,"SELECT * FROM tbl_save_clientbene WHERE id_tbl_save_clientbene='".$_SESSION['cl_qn2']."' ");
        $row = mysqli_fetch_assoc($sql_tbl_save_clientbene);

    $sql_tbl_save_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_save_addl_entry WHERE id_tbl_save_addl_entry='".$_SESSION['cl_qn2']."' ");
        $row_tbl_addl_entry = mysqli_fetch_assoc($sql_tbl_save_addl_entry);

        //swo name
    $swo_staffid = $row_tbl_addl_entry['swo_staffid'];
        $sql_swo = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$swo_staffid' ");
        $row_swo = mysqli_fetch_assoc($sql_swo);

    $attachments_exp = explode(',', $row_tbl_addl_entry['other_attachments']);
    $attachments_arrval = array_values($attachments_exp);

    $attachments2_exp = explode(',', $row_tbl_addl_entry['other_attachments2']);
    $attachments2_arrval = array_values($attachments2_exp);

    $material_assistance_exp = explode(',', $row_tbl_addl_entry['material_assistance']);
    $material_assistance_arrval = array_values($material_assistance_exp);

    $psycho_support_exp = explode(',', $row_tbl_addl_entry['psycho_support']);
    $psycho_support_arrval = array_values($psycho_support_exp);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>View File Copies - PCV</title>
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
                <a class="navbar-brand" href="#" title="Accomplished Forms - Admin Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Administrator Level</a>
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
                    $roww = mysqli_fetch_assoc($sql); $USER=$roww['fname'];
                ?>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $roww['fname'].' '.substr($roww['mname'],0,1).'. '.$roww['lname'].' '.$roww['nameext']; ?></div>
                    <div class="email"><?php echo $roww['uname']; ?></div>
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
                        <a href="manage_db.php">
                            <span class="fa fa-arrow-left"></span>
                            <span>Go Back to Database</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="viewFormsPCV.php">
                            <span class="fa fa-eye"></span>
                            <span>View Forms (File Copies)</span>
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
                                    <a href="#gis" data-toggle="tab">
                                        <span class="fa fa-file-text" style="color: darkblue;"></span> GIS
                                    </a>
                                </li>
                                <li>
                                    <a href="#pcv" data-toggle="tab">
                                        <span class="fa fa-money" style="color: darkblue;"></span> PCV
                                    </a>
                                </li>
                                <li>
                                    <a href="#coe" data-toggle="tab">
                                        <span class="fa fa-file-text" style="color: darkblue;"></span> COE
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; margin: -1px;">

                                <!-- pcv -->
                                <div id="pcv" class="tab-pane fade in">
                                    <button onclick="print_filecopy_pcv()" class="btn btn-primary bg-darkblue waves-effect" name="print_filecopy_pcv" style="position: fixed; top: 145px; z-index: 1;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <page size="A4flex" layout="orientation" class="page2">
                                        <p style="font-style: italic; text-align: right;">Appendix 48</p>
                                        <div style="width: 100%; height: 90px; position: relative;">
                                            <div style="width: 556px; height: 100%; border: solid black 1px; padding: 5px; position: absolute;">
                                                <p style="font-size: 20px; text-align: center; font-weight: bold;">PETTY CASH VOUCHER</p>
                                                <p style="font-size: 17px; font-weight: bold;">Entity Name: _____________________________________________</p>
                                                <p style="font-size: 17px; font-weight: bold;">Fund Cluster: ____________________________________________</p>
                                            </div>
                                            <div style="width: 240px; height: 100%; border: solid black 1px; padding: 5px; position: absolute; left: 556px;">
                                                <p style="font-size: 16px; font-weight: bold;">No.: <u><?php echo $row_tbl_addl_entry['transaction_code']; ?></u></p><br>
                                                <p style="font-size: 17px; font-weight: bold;">Date: <u><?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?></u></p>
                                            </div>
                                        </div>
                                        <div style="width: 100%; height: 60px; position: relative;">
                                            <div style="width: 556px; height: 100%; border: solid black 1px; padding: 5px; position: absolute;">
                                                <p style="font-size: 17px;"><b>Payee/Office:</b>
                                                    <u>
                                                        <?php
                                                              echo strtoupper($row['cl_fname'])." ";
                                                              if (empty($row['cl_mname'])) {
                                                                    echo "";
                                                              } else {
                                                                    echo strtoupper(substr($row['cl_mname'],0,1)).". ";
                                                              }
                                                              echo strtoupper($row['cl_lname']);
                                                              if ($row['cl_nameext'] == "N/A") {
                                                                    echo "";
                                                              } else {
                                                                    echo ", ".$row['cl_nameext'];
                                                              }
                                                        ?>
                                                    </u>
                                                </p>
                                                <p style="font-size: 17px;"><b>Address:</b> <u><?php echo $row['cl_purok'].', '.$row['cl_brgy'].', '.$row['cl_mun'].', '.$row['cl_prov'].' '.$row['cl_district'];?></u></p>
                                            </div>
                                            <div style="width: 240px; height: 100%; border: solid black 1px; padding: 5px; position: absolute; left: 556px;">
                                                <p style="font-size: 17px;"><b>Responsibility Center Code:</b></p>
                                                <p style="font-size: 15px;">___________________________</p>
                                            </div>
                                        </div>
                                        <div style="width: 100%; height: 36px; position: relative;">
                                            <div style="width: 398px; height: 100%; border: solid black 1px; padding: 5px; position: absolute;">
                                                <p style="font-size: 17px; font-weight: bold; font-style: italic;">I. To be filled-out upon request</p>
                                            </div>
                                            <div style="width: 398px; height: 100%; border: solid black 1px; padding: 5px; position: absolute; left: 398px;">
                                                <p style="font-size: 17px; font-weight: bold; font-style: italic;">II. To be filled-out upon liquidation</p>
                                            </div>
                                        </div>
                                        <div style="width: 100%; position: relative;">
                                            <div class="text-center" style="width: 399px; position: absolute;">
                                                <div style="position: absolute; width: 220px; height: 30px; padding: 5px; border: solid black 1px; border-bottom: solid black 1px;">
                                                    <p style="font-size: 17px; font-weight: bold;">Particulars</p>
                                                </div>
                                                <div style="position: absolute; width: 178px; height: 30px; padding: 5px; border: solid black 1px; left: 220px;">
                                                    <p style="font-size: 17px; font-weight: bold;">Amount</p>
                                                </div>
                                                <div style="position: absolute; top: 30px; width: 220px; height: 141px; padding: 5px; border: solid black 1px;">
                                                    <br><br>
                                                    <p style="font-size: 17px;"><?php echo $row_tbl_addl_entry['assistance_type'];?> Assistance</p>
                                                </div>
                                                <div style="position: absolute; top: 30px; width: 178px; height: 141px; padding: 5px; border: solid black 1px; left: 220px;">
                                                    <br><br>
                                                    <p style="font-size: 17px;">&#8369;<?php echo number_format($row_tbl_addl_entry['amount_in_figures'],2);?></p>
                                                </div>
                                            </div>
                                            <div style="width: 398px; padding: 5px; position: absolute; left: 398px; border: solid black 1px;">
                                                <br>
                                                <p style="font-size: 15px;"><b>Total Amount Granted:</b> __________________________</p><br>
                                                <p style="font-size: 15px;"><b>Total Amount Paid per</b></p>
                                                <p style="font-size: 15px;"><b>OR/Invoice No.</b> ____________ ____________________</p><br>
                                                <p style="font-size: 15px;"><b>Amount Refunded/</b></p>
                                                <p style="font-size: 15px; display: inline;"><b>(Reimbursed) </b>__________________________________</p>
                                            </div>
                                        </div>
                                        <!-- 1ST ROW FOR SIGNATURE -->
                                        <div style="width: 100%; position: relative; top: 171px; font-size: 15px;">
                                            <!-- A. -->
                                            <div style="width: 399px;border: solid black 1px; position: absolute;">
                                                <div style="text-align: center; float: left; padding: 3px; width: 30px; height: 30px; display: inline-block; border: solid black 1px;">
                                                    <span><b>A.</b></span>
                                                </div>
                                                <p style="font-size: 15px; display: inline-block; padding: 5px;"> <i>Requested by:</i></p>
                                                <br><br>
                                                <p style="text-align: center;"><u><b>
                                                    <?php
                                                      echo strtoupper($row_swo['fname'])." "; 
                                                      if (empty($row_swo['mname'])) {
                                                            echo "";
                                                      } else {
                                                            echo strtoupper(substr($row_swo['mname'],0,1)).". ";
                                                      }
                                                      echo strtoupper($row_swo['lname']);
                                                      if ($row_swo['nameext'] == "N/A" || $row_swo['nameext'] == "") {
                                                            echo "";
                                                      } else {
                                                            echo ", ".$row_swo['nameext'];
                                                      }
                                                    ?> 
                                                </b></u></p>
                                                <p style="text-align: center;">Signature over Printed Name</p>
                                                <p style="text-align: center;">Name of Requestor</p>
                                                <div style="text-align: center; float: left; padding: 3px; width: 30px; height: 30px; display: inline-block;">
                                                    <span style="font-size: 15px;"><b></b></span>
                                                </div>
                                                <br><br>
                                                <p style="font-size: 15px; display: inline-block; padding: 5px;"> <i>Approved by:</i></p>
                                                <br><br>
                                                <?php
                                                    $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'PCV Approving Authority' ");
                                                    $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                                                ?>
                                                <p style="text-align: center; margin: 0px;"><b><u><?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; } ?></u></b>
                                                </p>
                                                <p style="text-align: center;">Signature over Printed Name</p>
                                                <p style="text-align: center;">Name of Approving Authority</p>
                                                <br>
                                            </div>
                                            <!-- C. -->
                                            <div style="width: 398px; padding-bottom: 10px; position: absolute; left: 398px; border: solid black 1px;">
                                                <div style="text-align: center; float: left; padding: 3px; width: 30px; height: 30px; display: inline-block; border: solid black 1px;">
                                                    <span><b>C.</b></span>
                                                </div><br><br>
                                                <div style="margin-left: 80px; float: left; width: 50px; height: 30px; border: solid black 1px;"></div>
                                                <p style="display: inline-block; font-size: 15px; padding: 5px 0 0 5px;"><i>Received Refund</i></p><br><br>
                                                <div style="margin-left: 80px; float: left; width: 50px; height: 30px; border: solid black 1px;"></div>
                                                <p style="display: inline-block; font-size: 15px; padding: 5px 0 0 5px;"><i>Reimbursement Paid</i></p>
                                                <br><br><br><br><br>
                                                <p style="text-align: center;"><b>_________________________________________</b></p>
                                                <p style="text-align: center;">Signature over Printed Name</p>
                                                <p style="text-align: center;">Petty Cash Custodian</p><br>
                                            </div>
                                        </div>
                                        <!-- 2ND ROW FOR SIGNATURE -->
                                        <div style="width: 100%; position: relative; top: 472px; font-size: 15px;">
                                            <!-- B. -->
                                            <div style="width: 399px;border: solid black 1px; position: absolute;">
                                                <div style="text-align: center; float: left; padding: 3px; width: 30px; height: 30px; display: inline-block; border: solid black 1px;">
                                                    <span><b>B.</b></span>
                                                </div>
                                                <p style="font-size: 15px; display: inline-block; padding: 5px;"> <i>Paid by:</i></p>
                                                <br><br>
                                                <p style="text-align: center;"><u><b>
                                                    <?php
                                                        $sql_custodian_pcv = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'Petty Cash Custodian' ");
                                                        $row_custodian_pcv = mysqli_fetch_assoc($sql_custodian_pcv);

                                                        echo strtoupper($row_custodian_pcv['fname'])." "; if (empty($row_custodian_pcv['mname'])) { echo ""; } else { echo strtoupper(substr($row_custodian_pcv['mname'],0,1)).". "; } echo strtoupper($row_custodian_pcv['lname']); if ($row_custodian_pcv['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_custodian_pcv['nameext']; } if (empty($row_custodian_pcv['suffix'])) {echo ''; } else { echo ', '.$row_custodian_pcv['suffix']; }
                                                    ?>
                                                </b></p>
                                                </b></u></p>
                                                <p style="text-align: center;">Signature over Printed Name</p>
                                                <p style="text-align: center;">Petty Cash Custodian</p>
                                                <div style="text-align: center; float: left; padding: 3px; width: 30px; height: 30px; display: inline-block;">
                                                    <span style="font-size: 15px;"><b></b></span>
                                                </div>
                                                <br><br>
                                                <p style="font-size: 15px; display: inline-block; padding: 5px;"> <i>Cash Received by:</i></p>
                                                <br>
                                                <p style="text-align: center; margin: 0px; background-color: yellow; padding-top: 21px;"><b><u>
                                                    <?php
                                                          echo strtoupper($row['cl_fname'])." ";
                                                          if (empty($row['cl_mname'])) {
                                                                echo "";
                                                          } else {
                                                                echo strtoupper(substr($row['cl_mname'],0,1)).". ";
                                                          }
                                                          echo strtoupper($row['cl_lname']);
                                                          if ($row['cl_nameext'] == "N/A") {
                                                                echo "";
                                                          } else {
                                                                echo ", ".$row['cl_nameext'];
                                                          }
                                                    ?>
                                                </u></b>
                                                </p>
                                                <p style="text-align: center;">Signature over Printed Name</p>
                                                <p style="text-align: center;">Payee</p>
                                                <p style="text-align: center;"><b>Date: <u><?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?></u></b></p><br>
                                            </div>
                                            <!-- D. -->
                                            <div style="width: 398px; padding-bottom: 10px; position: absolute; left: 398px; border: solid black 1px;">
                                                <div style="text-align: center; float: left; padding: 3px; width: 30px; height: 30px; display: inline-block; border: solid black 1px;">
                                                    <span><b>D.</b></span>
                                                </div><br><br>
                                                <div style="margin-left: 80px; float: left; width: 50px; height: 30px; border: solid black 1px;"></div>
                                                <p style="display: inline-block; font-size: 15px; padding: 5px 0 0 5px;"><i>Liquidation Submitted</i></p><br><br>
                                                <div style="margin-left: 80px; float: left; width: 50px; height: 30px; border: solid black 1px;"></div>
                                                <p style="display: inline-block; font-size: 15px; padding: 5px 0 0 5px;"><i>Reimbursement Received by:</i></p>
                                                <br><br><br><br><br>
                                                <p style="text-align: center;"><b>_________________________________________</b></p>
                                                <p style="text-align: center;">Signature over Printed Name</p>
                                                <p style="text-align: center;">Payee</p>
                                                <p style="text-align: center;"><b>Date: ____________________________________</b></p><br>
                                            </div>
                                        </div>
                                    </page>
                                </div>
                                <!-- end of pcv -->

                                <!-- coe pcv -->
                                <div id="coe" class="tab-pane fade in">
                                    <button onclick="print_filecopy_coe_pcv()" class="btn btn-primary bg-darkblue waves-effect" name="print_filecopy_coe_pcv" style="position: fixed; top: 145px; z-index: 1;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <page size="A4flex" layout="orientation" class="page2">
                                        <div class="header-logos">
                                            <img src="images/updated-logo/dswd.png" class="header-logos-dswd-logo2">
                                            <img src="images/updated-logo/aics.png" class="header-logos-aics-logo2">
                                            <img src="images/updated-logo/bagong_pilipinas.png" class="header-logos-bp-logo">
                                            <div class="header-logos-cis-logo">
                                                    <p style="font-size: 16px; font-weight: bold;">CRISIS INTERVENTION SECTION</p>
                                                    <!--    
                                                    <p style="font-size: 11px;">PROTECTIVE SERVICES DIVISION</p>
                                                    -->
                                                    <p style="font-size: 16px; font-weight: bold;">FIELD OFFICE CARAGA</p>
                                                    <p style="font-size: 12px;">DSWD-PMB-GF-011 | REV 02 | 08 JAN 2024</p>
                                            </div>
                                        </div><br>
                                        <h4 style="text-align: center; margin: 0px;">CERTIFICATE OF ELIGIBILITY</h4>
                                        <p style="text-align: center; margin: 0px; font-size: 14px;">(Outright Cash)</p>
                                        <div class="qn-pcn-row">
                                            <div class="div-qn">
                                                <p class="div-qn-p">QN:</p>
                                                <div class="qn text-center">
                                                    <?php echo $row['cl_qn'];?>
                                                </div>
                                            </div>
                                            <div class="div-pcn">
                                                <p class="div-qn-p">PCN:</p>
                                                <div class="pcn text-center">
                                                    <?php
                                                        if (!empty($row['cl_pcn'])) {
                                                            echo $row['cl_pcn'];
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="div_glcode_date" style="display: inline-block; float: right;">
                                                <div class="div-date" style="width: auto !important;">
                                                    <p class="div-qn-p">Date:</p>
                                                    <div class="date text-center">
                                                        <?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="client-statusAdmission-row">
                                                <div class="status">
                                                    <div class="status-new">
                                                        <?php
                                                            $cl_status=$row['cl_status'];
                                                            if ($cl_status=='New') {
                                                                ?>
                                                        <p class="p-check">&#x2713;</p>
                                                                <?php
                                                            } else {

                                                            }
                                                        ?>
                                                        <p class="status-p">New</p>
                                                        
                                                    </div>
                                                    <div class="status-returning">
                                                        <?php
                                                            $cl_status=$row['cl_status'];
                                                            if ($cl_status=='Returning') {
                                                                ?>
                                                        <p class="status-p" style="left: 2px;">&#x2713;</p>
                                                                <?php
                                                            } else {

                                                            }
                                                        ?>
                                                        <p class="status-p">Returning</p>
                                                        
                                                    </div>
                                                    <div class="admission-on-site">
                                                        <?php
                                                            $cl_status=$row['cl_status'];
                                                            if (($cl_status=='New')||($cl_status=='Returning')) {
                                                                ?>
                                                        <p class="status-p-onsite">&#x2713;</p>
                                                        <p class="status-p status-p2">On-Site</p>
                                                                <?php
                                                            } else { ?>
                                                            <p class="status-p status-p2">On-Site</p>
                                                            <?php }
                                                        ?>
                                                    </div>
                                                    <div class="admission-walk-in">
                                                        <?php
                                                            if ($row_tbl_addl_entry['admission_mode'] == "Walk-in") {
                                                                ?>
                                                            <p class="status-p-onsite">&#x2713;</p>
                                                                <?php
                                                            } else { }
                                                        ?>
                                                        <p class="status-p status-p2">Walk-in</p>
                                                    </div>
                                                    <div class="admission-referral">
                                                        <?php
                                                            if ($row_tbl_addl_entry['admission_mode'] == "Referral") {
                                                                ?>
                                                            <p class="status-p-onsite">&#x2713;</p>
                                                                <?php
                                                            } else { }
                                                        ?>
                                                        <p class="status-p">Referral</p>
                                                    </div>
                                                    <div class="admission-off-site">
                                                        <p class="status-p status-p3">Off-Site</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row-input">
                                            <div class="text" style="width: 37mm; display: inline-block;">
                                                <p style="margin: 0px; font-size: 12px;">This is to certify that, </p>
                                            </div>
                                            <div class="cl_full_name" style="width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b> <?php echo strtoupper($row['cl_fname'])." "; if (empty($row['cl_mname'])) { echo ""; } else { echo strtoupper($row['cl_mname'])." "; } echo strtoupper($row['cl_lname']); if ($row['cl_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['cl_nameext']; }?></b></p>
                                            </div>
                                            <p style="margin: 0px; font-size: 15px; display: inline-block;">, </p>
                                            <div class="sex" style="display: inline-block; position: relative; width: 45mm; margin-left: 15px;">
                                                <div class="sex-m" style="display: inline-block; width: 15px; height: 15px; border: solid black 1px;">
                                                    <?php
                                                        $cl_sex=$row['cl_sex'];
                                                        if ($cl_sex=='M') {
                                                            ?>
                                                    <p class="p-check">&#x2713;</p>
                                                            <?php
                                                        } else {

                                                        }
                                                    ?>
                                                    <p class="status-p" style="font-size: 12px; font-weight: 100;">Male</p>
                                                </div>
                                                <div class="sex-f" style="display: inline-block; width: 15px; height: 15px; border: solid black 1px; position: absolute; left: 75px;">
                                                    <?php
                                                        $cl_sex=$row['cl_sex'];
                                                        if ($cl_sex=='F') {
                                                            ?>
                                                    <p class="p-check" style="left: 2px;">&#x2713;</p>
                                                            <?php
                                                        } else {

                                                        }
                                                    ?>
                                                    <p class="status-p" style="font-size: 12px; font-weight: 100;">Female</p>
                                                    
                                                </div>
                                            </div>
                                            <div class="age" style="display: inline-block; width: 18.6mm; border-bottom: solid black 1px; text-align: center;">
                                                <p style="font-size: 12px;">
                                                    <?php echo $row['cl_age']; ?> y/o
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row-label">
                                            <div style="display: inline-block; width: 37mm; margin-top: 4px; text-align: center;"></div>
                                            <div style="display: inline-block; width: 100mm; margin-top: 4px; text-align: center;">
                                                <p style="font-size: 12px;">Buong Pangalan <i>(First Name, Middle Name, Last Name)</i></p>
                                            </div>
                                            <div style="display: inline-block; width: 45mm; margin-top: 4px; text-align: center;   margin-left: 15px;">
                                                <p style="font-size: 12px;">Kasarian <i>(Sex)</i></p>
                                            </div>
                                            <div style="display: inline-block; width: 20.6mm; margin-top: 4px; text-align: center;">
                                                <p style="font-size: 12px;">Edad <i>(Age)</i></p>
                                            </div>
                                        </div>
                                        <div class="row-input" style="margin-top: 3px;">
                                            <div class="text" style="width: 45mm; display: inline-block;">
                                                <p style="margin: 0px; font-size: 12px;">and presently residing at </p>
                                            </div>
                                            <div class="cl_address" style="width: 163.4mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b> <?php echo strtoupper($row['cl_purok'].", Brgy. ".$row['cl_brgy'].", ".$row['cl_mun'].", ".$row['cl_prov'].' '.$row['cl_district']); ?></b></p>
                                            </div>
                                        </div>
                                        <div class="row-label">
                                            <div style="display: inline-block; width: 45mm; margin-top: 4px; text-align: center;"></div>
                                            <div style="display: inline-block; width: 163.4mm; margin-top: 4px; text-align: center;">
                                                <p style="font-size: 12px;">Kumpletong Tirahan <i>(Complete Address)</i></p>
                                            </div>
                                        </div>
                                        <p style="font-size: 12px;">has been found eligible for assistance after the assessment and validation conducted, for his/herself or through the representation of his/her 
                                        </p>
                                        <div class="row-input" style="margin-top: 3px;">
                                            <div class="" style="width: 108mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php
                                                        if ($row['bn_reltoclient'] == 'Self') { echo strtoupper($row['bn_reltoclient']); } else { echo strtoupper($row['bn_reltoclient']); }
                                                    ?>
                                                </b></p>
                                            </div>
                                            <p style="margin: 0px; font-size: 15px; display: inline-block;">, </p>
                                            <div class="" style="width: 98mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php 
                                                        if ($row['bn_reltoclient'] == 'Self') { echo 'N/A'; } else { echo strtoupper($row['bn_fname'])." "; if (empty($row['bn_mname'])) { echo ''; } else { echo strtoupper($row['bn_mname'])." "; } echo strtoupper($row['bn_lname']); if ($row['bn_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['bn_nameext'] ;} ;}
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div>
                                        <div class="row-label">
                                            <div style="display: inline-block; width: 108mm; text-align: center; margin-top: 4px;">
                                                <p style="font-size: 12px;">Relasyon ng Kinatawan sa Benepisyaryo <i style="font-size: 8px;">(Relationship of the Representative with Beneficiary)</i></p>
                                            </div>
                                            <div style="display: inline-block; width: 100mm; text-align: center; margin-top: 4px;">
                                                <p style="font-size: 12px;">Buong Pangalan ng Benepisyaryo <i style="font-size: 12px;">(Complete Name of Beneficiary)</i></p>
                                            </div>
                                        </div><br>
                                        <p style="background-color: silver; font-size: 13px; text-align: center; width: 100%; border: solid black 1px; padding: 2px 0px;"><b>
                                            Records of the case such as the following are confidentially filed at the Crisis Intervention Division (CID)
                                        </b></p>
                                        <div class="coe_attachments" style="width: 100%; height: auto; border: solid black 1px; padding: 5px 0px;">
                                            <div class="coe_at1" style="width: 45mm;">
                                                <ul>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <p class="p-check">&#x2713;</p>
                                                            <p class="list_coe_attachments_p">General Intake Sheet</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['cl_id'] == "DSWD 4Ps ID") {
                                                                        echo '';
                                                                    } else {
                                                                        ?>  
                                                                            <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            <p class="list_coe_attachments_p">Valid ID Presented</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div style="border-bottom: solid black 1px; width: 100%; height: 20px;">
                                                            <p class="list_coe_attachments_p" style="margin-left: 0px;">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['cl_id'] == "DSWD 4Ps ID") {
                                                                        echo '';
                                                                    } else {
                                                                        echo $row_tbl_addl_entry['cl_id'];
                                                                    }
                                                                ?>
                                                            </p>
                                                            
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                if ($row_tbl_addl_entry['cl_id'] == "DSWD 4Ps ID") {
                                                                    ?>  
                                                                        <p class="p-check">&#x2713;</p>
                                                                    <?php
                                                                } else {
                                                                    echo '';
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">DSWD 4Ps ID</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Justification'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Justification</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="coe_at2" style="width: 55mm;">
                                                <ul>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Medical Certificate/Abstract'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Medical Certificate/Abstract</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Prescriptions'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Prescriptions</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Statement of Account'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Statement of Account</p>
                                                            
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Treatment Protocol'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Treatment Protocol</p>
                                                            
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Quotation'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Quotation</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="coe_at3" style="width: 43mm;">
                                                <ul>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Discharge Summary'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Discharge Summary</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Laboratory Request'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Laboratory Request</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Charge Slip'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Charge Slip</p>
                                                            
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Funeral Contract'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Funeral Contract</p>
                                                            
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Death Certificate'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Death Certificate</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="coe_at4" style="width: 64mm;overflow-wrap: break-word;">
                                                <ul>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Death Summary'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Death Summary</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Referral Letter'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Referral Letter</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count = count($attachments_arrval)-1;
                                                                //Loop through each array index
                                                                for($i = 0; $i <= $count; $i++) {
                                                                    //Assign the value of the array key to a variable
                                                                    $value = $attachments_arrval[$i];
                                                                    //Check if result string contains diam-mm
                                                                    if ($value == 'Social Case Study Report'){
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                }
                                                            ?>
                                                            <p class="list_coe_attachments_p">Social Case Study Report</p>
                                                            
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_coe_attachments">
                                                            <?php
                                                                $count2 = count($attachments2_arrval)-1;
                                                                if ($count2 > 0){
                                                                    ?>
                                                                    <p class="p-check">&#x2713;</p>
                                                                    <?php
                                                                } else {}
                                                            ?>
                                                            <p class="list_coe_attachments_p" style="width: 55mm; line-height: 1;">Others:
                                                                <span style="font-size: 11px; text-decoration: underline;">
                                                                    <?php
                                                                        $count = count($attachments2_arrval)-1;
                                                                        //Loop through each array index
                                                                        for($i = 0; $i <= $count; $i++) {
                                                                            //Assign the value of the array key to a variable
                                                                            $value = $attachments2_arrval[$i];
                                                                            if (($count > 0) && (!empty($value)) ){
                                                                                echo $value.', ';
                                                                            } else {}
                                                                        }
                                                                        if (!empty($row_tbl_addl_entry['other_addl_attachments'])) {
                                                                            echo $row_tbl_addl_entry['other_addl_attachments'].', ';
                                                                        } else {}
                                                                        if ($row_tbl_addl_entry['bn_id']!='N/A') {
                                                                            echo "Bene's ".$row_tbl_addl_entry['bn_id'];
                                                                        } else {}
                                                                    ?>
                                                                </span>
                                                            </p>
                                                            
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><br>
                                        <div class="row-input" style="margin-top: 3px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;">
                                                The Client is hereby recommended to receive 
                                            </p>
                                            <div class="" style="width: 50mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['assistance_type'];
                                                    ?>
                                                </b></p>
                                            </div>
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;"> Assistance for </p>
                                            <div class="" style="width: 72mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['purpose'].' ('.$row_tbl_addl_entry['remarks_pcv'].')';
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div>
                                        <div class="row-input" style="margin-top: 5px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;">
                                                in the amount of 
                                            </p>
                                            <div class="" style="width: 80mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['amount_in_words'];
                                                    ?>
                                                </b></p>
                                            </div>
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;"> , </p>
                                            <div class="" style="width: 25mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b> Php 
                                                    <?php
                                                        echo number_format($row_tbl_addl_entry['amount_in_figures'],2);
                                                    ?>
                                                </b></p>
                                            </div>
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;"> CHARGEABLE AGAINST: PSP </p>
                                            <div class="" style="width: 32mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['fund_source'];
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-4 text-center">
                                                <p style="font-size: 13px;">CONFORME:</p><br>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px; background-color: yellow; padding-top: 15px;">
                                                    <?php
                                                          echo strtoupper($row['cl_fname'])." ";
                                                          if (empty($row['cl_mname'])) {
                                                                echo "";
                                                          } else {
                                                                echo strtoupper(substr($row['cl_mname'],0,1)).". ";
                                                          }
                                                          echo strtoupper($row['cl_lname']);
                                                          if ($row['cl_nameext'] == "N/A") {
                                                                echo "";
                                                          } else {
                                                                echo ", ".$row['cl_nameext'];
                                                          }
                                                    ?> 
                                                </p>
                                                <p style="font-size: 13px;">Client</p>
                                                <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <p style="font-size: 13px;">PREPARED BY:</p><br><br>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                                                    <?php
                                                      echo strtoupper($row_swo['fname'])." "; 
                                                      if (empty($row_swo['mname'])) {
                                                            echo "";
                                                      } else {
                                                            echo strtoupper(substr($row_swo['mname'],0,1)).". ";
                                                      }
                                                      echo strtoupper($row_swo['lname']);
                                                      if ($row_swo['nameext'] == "N/A" || $row_swo['nameext'] == "") {
                                                            echo "";
                                                      } else {
                                                            echo ", ".$row_swo['nameext'];
                                                      }
                                                    ?> 
                                                </p>
                                                <p style="font-size: 13px;">Social Worker</p>
                                                <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <p style="font-size: 13px;">APPROVED BY:</p><br><br>
                                                <?php
                                                    $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'PCV Approving Authority' ");
                                                    $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                                                ?>
                                                <p style="text-align: center; margin: 0px;"><b><u><?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; } ?></u></b>
                                                </p>
                                                <p style="font-size: 12px;">Approving Authority</p>
                                                <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                                            </div>
                                        </div><br><br>
                                        <div class="acknowledge_receipt text-center">
                                            <h5>Acknowledgement Receipt</h5>
                                        </div>
                                        <div>
                                            <div class="div_glcode_date" style="display: inline-block; float: right; margin-top: 10px;">
                                                <div class="div-date" style="width: auto !important;">
                                                    <p class="div-qn-p">Date:</p>
                                                    <div class="date text-center">
                                                        <?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br><br>
                                        <div style="position: relative;">
                                            <div class="fin_assistance">
                                                <p class="status-p-onsite">&#x2713;</p>
                                                <p class="p-fin_assi" style="display: inline-block;">Financial Assistance</p>
                                                <div class="" style="width: 95mm; display: inline-block; border-bottom: solid black 1px; position: absolute; left: 150px;">
                                                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                        <?php
                                                            echo $row_tbl_addl_entry['amount_in_words'];
                                                        ?>
                                                    </b></p>
                                                </div>
                                                <p style="margin: 0px; font-size: 12px; display: inline-block;"> , </p>
                                                <div class="" style="width: 30mm; display: inline-block; border-bottom: solid black 1px; position: absolute; left: 520px;">
                                                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b> Php 
                                                        <?php
                                                            echo number_format($row_tbl_addl_entry['amount_in_figures'],2);
                                                        ?>
                                                    </b></p>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="assistance-col-pcv-coe">
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "MEDICAL") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Medical Assistance</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "BURIAL") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Funeral Assistance</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if (($row_tbl_addl_entry['assistance_type'] == "CASH") && ($row_tbl_addl_entry['assistance_purpose'] == "EMERGENCY CASH TRANSFER")) {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Emergency Cash Transfer</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col-pcv-coe">
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "TRANSPORTATION") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Transportation Assistance</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "EDUCATIONAL") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Educational Assistance</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col-pcv-coe">
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "FOOD") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Food Assistance</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if (($row_tbl_addl_entry['assistance_type'] == "CASH") && ($row_tbl_addl_entry['assistance_purpose'] == "CASH RELIEF ASSISTANCE")) {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Cash Relief Assistance</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-4 text-center">
                                                <p style="font-size: 13px;">Tinanggap ni:</p><br>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px; background-color: yellow; padding-top: 15px;">
                                                    <?php
                                                          echo strtoupper($row['cl_fname'])." ";
                                                          if (empty($row['cl_mname'])) {
                                                                echo "";
                                                          } else {
                                                                echo strtoupper(substr($row['cl_mname'],0,1)).". ";
                                                          }
                                                          echo strtoupper($row['cl_lname']);
                                                          if ($row['cl_nameext'] == "N/A") {
                                                                echo "";
                                                          } else {
                                                                echo ", ".$row['cl_nameext'];
                                                          }
                                                    ?> 
                                                </p>
                                                <p style="font-size: 13px;">Client</p>
                                                <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <p style="font-size: 13px;">Binayaran ni:</p><br><br>
                                                <!--<p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                                                    <?php
                                                      //echo strtoupper($row1['fname'])." "; 
                                                      //if (empty($row1['mname'])) {
                                                      //      echo "";
                                                      //} else {
                                                      //      echo strtoupper(substr($row1['mname'],0,1)).". ";
                                                      //}
                                                      //echo strtoupper($row1['lname']);
                                                      //if ($row1['nameext'] == "N/A" || $row1['nameext'] == "") {
                                                      //T      echo "";
                                                      //} else {
                                                      //      echo ", ".$row1['nameext'];
                                                      //}
                                                    ?> 
                                                </p>-->
                                                <?php
                                                    $sql_binayaran_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'Petty Cash Custodian' ");
                                                    $row_binayaran_gis = mysqli_fetch_assoc($sql_binayaran_gis);
                                                ?>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                                                    <?php echo strtoupper($row_binayaran_gis['fname'])." "; if (empty($row_binayaran_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_binayaran_gis['mname'],0,1)).". "; } echo strtoupper($row_binayaran_gis['lname']); if ($row_binayaran_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_binayaran_gis['nameext']; } if (empty($row_binayaran_gis['suffix'])) {echo ''; } else { echo ', '.$row_binayaran_gis['suffix']; }
                                                    ?>
                                                </b></p>
                                                <p style="font-size: 13px;"><!--Social Worker-->RDO / SDO</p>
                                                <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <p style="font-size: 13px;">Sinaksihan ni:</p><br><br>
                                                <?php
                                                    $sql_witness_pcv = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'Petty Cash Witness' ");
                                                    $row_witness_pcv = mysqli_fetch_assoc($sql_witness_pcv);
                                                ?>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                                                    <?php echo strtoupper($row_witness_pcv['fname'])." "; if (empty($row_witness_pcv['mname'])) { echo ""; } else { echo strtoupper(substr($row_witness_pcv['mname'],0,1)).". "; } echo strtoupper($row_witness_pcv['lname']); if ($row_witness_pcv['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_witness_pcv['nameext']; } if (empty($row_witness_pcv['suffix'])) {echo ''; } else { echo ', '.$row_witness_pcv['suffix']; }
                                                    ?>
                                                </b></p>
                                                <p style="font-size: 12px;">SWO / ADMIN</p>
                                                <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                                            </div>
                                        </div><br>
                                            <p class="eo163seriesof2022">*E.O. 163 Series of 2022</p>
                                            <div class="container-footer-updt container-fluid">
                                                <p>Page 1 of 1</p>
                                                <p style="border-top: solid black 1px;">DSWD Field Office Caraga, R. Palma Street, Butuan City, Philippines 8600</p>
                                                <p>Website: http://caraga.dswd.gov.ph Tel Nos.: (085) 303-8620</p>
                                                <img class="footer_logo" src="images/updated-logo/footer_logo.png">
                                            </div>
                                    </page>
                                </div>
                                <!-- end of coe -->
                                
                                <!-- gis -->
                                <div id="gis" class="tab-pane fade in active">
                                    <button onclick="print_filecopy_gis()" class="btn btn-primary bg-darkblue waves-effect" name="print_filecopy_gis" style="position: fixed; top: 145px; z-index: 1;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <div class="">
                                        <page size="A4flex" layout="orientation" class="page2">
                                            <div class="header-logos">
                                                <img src="images/updated-logo/dswd.png" class="header-logos-dswd-logo2">
                                                <img src="images/updated-logo/aics.png" class="header-logos-aics-logo2">
                                                <img src="images/updated-logo/bagong_pilipinas.png" class="header-logos-bp-logo">
                                                <div class="header-logos-cis-logo">
                                                        <p style="font-size: 16px; font-weight: bold;">CRISIS INTERVENTION SECTION</p>
                                                        <!--    
                                                        <p style="font-size: 11px;">PROTECTIVE SERVICES DIVISION</p>
                                                        -->
                                                        <p style="font-size: 16px; font-weight: bold;">FIELD OFFICE CARAGA</p>
                                                        <p style="font-size: 12px;">DSWD-PMB-GF-011 | REV 02 | 08 JAN 2024</p>
                                                </div>
                                            </div>
                                            <div class="title-gis">
                                                <h3 class="text-center">GENERAL INTAKE SHEET</h3>
                                                <div class="below-gis text-center">
                                                    <p>MAARING MAGPATULONG SUMAGOT SA DSWD PERSONNEL </p>
                                                </div>
                                            </div>
                                            <div class="qn-pcn-row">
                                                <div class="div-qn">
                                                    <p class="div-qn-p">QN:</p>
                                                    <div class="qn text-center">
                                                        <?php echo $row['cl_qn'];?>
                                                    </div>
                                                </div>
                                                <div class="div-pcn">
                                                    <p class="div-qn-p">PCN:</p>
                                                    <div class="pcn text-center">
                                                        <?php
                                                            if (!empty($row['cl_pcn'])) {
                                                                echo $row['cl_pcn'];
                                                            } else {
                                                                echo "N/A";
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="div-time-start">
                                                    <p class="div-qn-p">Time Start:</p>
                                                    <div class="time-start text-center">
                                                        <?php echo date_format(new DateTime($row['time_start']), "h:i A");?>
                                                    </div>
                                                </div>
                                                <div class="div-date">
                                                    <p class="div-qn-p">Date:</p>
                                                    <div class="date text-center">
                                                        <?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="client-statusAdmission-row">
                                                <div class="status">
                                                    <div class="status-new">
                                                        <?php
                                                            $cl_status=$row['cl_status'];
                                                            if ($cl_status=='New') {
                                                                ?>
                                                        <p class="p-check">&#x2713;</p>
                                                                <?php
                                                            } else {

                                                            }
                                                        ?>
                                                        <p class="status-p">New</p>
                                                        
                                                    </div>
                                                    <div class="status-returning">
                                                        <?php
                                                            $cl_status=$row['cl_status'];
                                                            if ($cl_status=='Returning') {
                                                                ?>
                                                        <p class="status-p" style="left: 2px;">&#x2713;</p>
                                                                <?php
                                                            } else {

                                                            }
                                                        ?>
                                                        <p class="status-p">Returning</p>
                                                        
                                                    </div>
                                                    <div class="admission-on-site">
                                                        <?php
                                                            $cl_status=$row['cl_status'];
                                                            if (($cl_status=='New')||($cl_status=='Returning')) {
                                                                ?>
                                                        <p class="status-p-onsite">&#x2713;</p>
                                                        <p class="status-p status-p2">On-Site</p>
                                                                <?php
                                                            } else { ?>
                                                            <p class="status-p status-p2">On-Site</p>
                                                            <?php }
                                                        ?>
                                                    </div>
                                                    <div class="admission-walk-in">
                                                        <?php
                                                            if ($row_tbl_addl_entry['admission_mode'] == "Walk-in") {
                                                                ?>
                                                            <p class="status-p-onsite">&#x2713;</p>
                                                                <?php
                                                            } else { }
                                                        ?>
                                                        <p class="status-p status-p2">Walk-in</p>
                                                    </div>
                                                    <div class="admission-referral">
                                                        <?php
                                                            if ($row_tbl_addl_entry['admission_mode'] == "Referral") {
                                                                ?>
                                                            <p class="status-p-onsite">&#x2713;</p>
                                                                <?php
                                                            } else { }
                                                        ?>
                                                        <p class="status-p">Referral</p>
                                                    </div>
                                                    <div class="admission-off-site">
                                                        <p class="status-p status-p3">Off-Site</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-client2 container-fluid">
                                                <div class="part1-title">
                                                    <p>Part I: To be filled out by Client</p>
                                                </div>
                                                <div class="info-client-title">
                                                    <p>IMPORMASYON NG KINATAWAN <i>(Client's Identifying Information)</i></p>
                                                </div>
                                                <div class="row-input">
                                                    <div class="name-row-input-divs1 text-center">
                                                          <?php echo $row['cl_lname'];?>
                                                    </div>
                                                    <div class="name-row-input-divs1 text-center">
                                                          <?php echo $row['cl_fname'];?>
                                                    </div>
                                                    <div class="name-row-input-divs1 text-center">
                                                          <?php if (empty($row['cl_mname'])) {echo "N/A";} else { echo $row['cl_mname'];}?>
                                                    </div>
                                                    <div class="name-row-input-divs2 text-center">
                                                          <?php echo $row['cl_nameext'];?>
                                                    </div>
                                                </div>
                                                <div class="row-label text-center">
                                                    <div class="name-row-label-divs1">
                                                          <p class="row-label-p">Apelyido <i class="row-label-i">(Last Name)</i></p>
                                                    </div>
                                                    <div class="name-row-label-divs1">
                                                          <p class="row-label-p">Unang Pangalan <i class="row-label-i">(First Name)</i></p>
                                                    </div>
                                                    <div class="name-row-label-divs1">
                                                          <p class="row-label-p">Gitnang Pangalan <i class="row-label-i">(Middle Name)</i></p>
                                                    </div>
                                                    <div class="name-row-label-divs2">
                                                          <p class="row-label-p">Ext. <i class="row-label-i">(Sr,Jr,I,II)</i></p>
                                                    </div>
                                                </div>
                                                <div class="row-input">
                                                    <div class="address-row-input-div1 text-center">
                                                          <?php echo $row['cl_purok'];?>
                                                    </div>
                                                    <div class="address-row-input-div text-center">
                                                          <?php echo $row['cl_brgy'];?>
                                                    </div>
                                                    <div class="address-row-input-div text-center">
                                                          <?php echo $row['cl_mun'];?>
                                                    </div>
                                                    <div class="address-row-input-div text-center">
                                                          <?php echo $row['cl_prov'].' '.$row['cl_district'];?>
                                                    </div>
                                                    <div class="address-row-input-div2 text-center">
                                                          <?php echo $row['cl_region'];?>
                                                    </div>
                                                </div>
                                                <div class="row-label text-center">
                                                    <div class="address-row-label-div1">
                                                          <p class="row-label-p">House No./Street/Purok <i class="row-label-i">(Ex. 123 Sun)</i></p>
                                                    </div>
                                                    <div class="address-row-label-div">
                                                          <p class="row-label-p">Barangay <i class="row-label-i">(Ex. Batasan)</i></p>
                                                    </div>
                                                    <div class="address-row-label-div">
                                                          <p class="row-label-p">City/Municipality <i class="row-label-i">(Ex. Quezon City)</i></p>
                                                    </div>
                                                    <div class="address-row-label-div">
                                                          <p class="row-label-p">Province/District <i class="row-label-i">(Ex. Dist. III)</i></p>
                                                    </div>
                                                    <div class="address-row-label-div2">
                                                          <p class="row-label-p">Region <i class="row-label-i">(Ex. NCR)</i></p>
                                                    </div>
                                                </div>
                                                <div class="row-input">
                                                    <div class="otherinfo-row-input-div1">
                                                      <?php
                                                    if (empty($row['cl_contact_num'])) {
                                                          echo "N/A";
                                                    } else {
                                                          echo $row['cl_contact_num'];
                                                    }
                                                      ?>
                                                    </div>
                                                    <div class="otherinfo-row-input-div2">
                                                          <?php echo date_format(new DateTime($row['cl_bday']), "M. d, Y");?>
                                                    </div>
                                                    <div class="otherinfo-row-input-div3">
                                                          <?php echo $row['cl_age'];?>
                                                    </div>
                                                    <div class="otherinfo-row-input-div4">
                                                          <?php echo $row['cl_sex'];?>
                                                    </div>
                                                    <div class="otherinfo-row-input-div7">
                                                          <?php echo $row['cl_cstatus'];?>
                                                    </div>
                                                    <div class="otherinfo-row-input-div5">
                                                          <?php echo $row['cl_occupation'];?>
                                                    </div>
                                                    <div class="otherinfo-row-input-div6">
                                                          <?php echo $row['cl_salary'];?>
                                                    </div>
                                                </div>
                                                <div class="row-label">
                                                    <div class="otherinfo-row-label-div1" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Numero ng Telepono <i class="row-label-i">(Mobile No.)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div2" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Kapanganakan <i class="row-label-i">(Birthdate)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div3" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Edad <i class="row-label-i">(Age)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div4" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Kasarian <i class="row-label-i">(Gender)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Civil Status</p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                                          <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                                    </div>
                                                </div>
                                                <div class="row-input" style="margin-top: -15px;">
                                                    <div class="rel-timeend-row-input-div1 text-center">
                                                          <?php echo $row['cl_reltobene'];?>
                                                    </div>
                                                    <div class="rel-timeend-row-input-divs">
                                                          
                                                    </div>
                                                    <div class="rel-timeend-row-input-divs">
                                                          
                                                    </div>
                                                </div>
                                                <div class="row-label">
                                                      <div class="rel-timeend-row-label-divs">
                                                            <p class="row-label-p">Relasyon sa Benepisyaryo <i class="row-label-i">(Relationship to the Beneficiary)</i></p>
                                                      </div>
                                                      <div class="rel-timeend-row-label-divs">
                                                      </div> 
                                                      <div class="rel-timeend-row-label-divs">
                                                      <div class="div-time-end">
                                                            <p class="timeend-p">Time End:</p>
                                                      <div class="time-end2 text-center">
                                                            <?php echo date_format(new DateTime($row_tbl_addl_entry['time_end2']), "h:i A");?>
                                                      </div>
                                                </div>
                                            </div>
                                            </div><br>
                                            <div class="container-bene2 container-fluid">
                                                <div class="info-bene-title">
                                                    <p>IMPORMASYON NG BENEPISYARYO <i>(Beneficiary's Identifying Information)</i></p>
                                                </div>
                                                      <?php
                                                            if ($row['bn_reltoclient'] == "Self") {
                                                            ?>
                                                              <div class="row-input">
                                                                    <div class="name-row-input-divs1 text-center">
                                                                          <?php echo "Same";?>
                                                                    </div>
                                                                    <div class="name-row-input-divs1 text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="name-row-input-divs1 text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="name-row-input-divs2 text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                              </div>
                                                              <div class="row-label text-center">
                                                                    <div class="name-row-label-divs1">
                                                                          <p class="row-label-p">Apelyido <i class="row-label-i">(Last Name)</i></p>
                                                                    </div>
                                                                    <div class="name-row-label-divs1">
                                                                          <p class="row-label-p">Unang Pangalan <i class="row-label-i">(First Name)</i></p>
                                                                    </div>
                                                                    <div class="name-row-label-divs1">
                                                                          <p class="row-label-p">Gitnang Pangalan <i class="row-label-i">(Middle Name)</i></p>
                                                                    </div>
                                                                    <div class="name-row-label-divs2">
                                                                          <p class="row-label-p">Ext. <i class="row-label-i">(Sr,Jr,I,II)</i></p>
                                                                    </div>
                                                              </div>
                                                              <div class="row-input">
                                                                    <div class="address-row-input-div1 text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="address-row-input-div text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="address-row-input-div text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="address-row-input-div text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="address-row-input-div2 text-center">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                              </div>
                                                              <div class="row-label text-center">
                                                                    <div class="address-row-label-div1">
                                                                          <p class="row-label-p">House No./Street/Purok <i class="row-label-i">(Ex. 123 Sun)</i></p>
                                                                    </div>
                                                                    <div class="address-row-label-div">
                                                                          <p class="row-label-p">Barangay <i class="row-label-i">(Ex. Batasan)</i></p>
                                                                    </div>
                                                                    <div class="address-row-label-div">
                                                                          <p class="row-label-p">City/Municipality <i class="row-label-i">(Ex. Quezon City)</i></p>
                                                                    </div>
                                                                    <div class="address-row-label-div">
                                                                          <p class="row-label-p">Province/District <i class="row-label-i">(Ex. Dist. III)</i></p>
                                                                    </div>
                                                                    <div class="address-row-label-div2">
                                                                          <p class="row-label-p">Region <i class="row-label-i">(Ex. NCR)</i></p>
                                                                    </div>
                                                              </div>
                                                              <div class="row-input">
                                                                    <div class="otherinfo-row-input-div1">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="otherinfo-row-input-div2">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="otherinfo-row-input-div3">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="otherinfo-row-input-div4">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="otherinfo-row-input-div7">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="otherinfo-row-input-div5">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                                    <div class="otherinfo-row-input-div6">
                                                                          <?php echo "--";?>
                                                                    </div>
                                                              </div>
                                                              <div class="row-label text-center">
                                                                    <div class="otherinfo-row-label-div1" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Numero ng Telepono <i class="row-label-i">(Mobile No.)</i></p>
                                                                    </div>
                                                                    <div class="otherinfo-row-label-div2" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Kapanganakan <i class="row-label-i">(Birthdate)</i></p>
                                                                    </div>
                                                                    <div class="otherinfo-row-label-div3" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Edad <i class="row-label-i">(Age)</i></p>
                                                                    </div>
                                                                    <div class="otherinfo-row-label-div4" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Kasarian <i class="row-label-i">(Gender)</i></p>
                                                                    </div>
                                                                    <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Civil Status</p>
                                                                    </div>
                                                                    <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                                                    </div>
                                                                    <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                                                          <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                                                    </div>
                                                              </div>
                                                          <?php
                                                          }
                                                          else {
                                                          ?>
                                                          <div class="row-input text-center">
                                                              <div class="name-row-input-divs1">
                                                                  <p><?php echo $row['bn_lname'];?></p>
                                                              </div>
                                                              <div class="name-row-input-divs1">
                                                                  <p><?php echo $row['bn_fname'];?></p>
                                                              </div>
                                                              <div class="name-row-input-divs1">
                                                                  <?php if (empty($row['bn_mname'])) {echo "N/A";} else { echo $row['bn_mname'];}?>
                                                              </div>
                                                              <div class="name-row-input-divs2">
                                                                  <p><?php echo $row['bn_nameext'];?></p>
                                                              </div>
                                                          </div>
                                                          <div class="row-label text-center">
                                                              <div class="name-row-label-divs1">
                                                                  <p class="row-label-p">Apelyido <i class="row-label-i">(Last Name)</i></p>
                                                              </div>
                                                              <div class="name-row-label-divs1">
                                                                  <p class="row-label-p">Unang Pangalan <i class="row-label-i">(First Name)</i></p>
                                                              </div>
                                                              <div class="name-row-label-divs1">
                                                                  <p class="row-label-p">Gitnang Pangalan <i class="row-label-i">(Middle Name)</i></p>
                                                              </div>
                                                              <div class="name-row-label-divs2">
                                                                  <p class="row-label-p">Ext. <i class="row-label-i">(Sr,Jr,I,II)</i></p>
                                                              </div>
                                                          </div>
                                                          <div class="row-input">
                                                              <div class="address-row-input-div1 text-center">
                                                                  <?php echo $row['bn_purok'];?>
                                                              </div>
                                                              <div class="address-row-input-div text-center">
                                                                  <?php echo $row['bn_brgy'];?>
                                                              </div>
                                                              <div class="address-row-input-div text-center">
                                                                  <?php echo $row['bn_mun'];?>
                                                              </div>
                                                              <div class="address-row-input-div text-center">
                                                                  <?php echo $row['bn_prov'].' '.$row['bn_district'];?>
                                                              </div>
                                                              <div class="address-row-input-div2 text-center">
                                                                  <?php echo $row['bn_region'];?>
                                                              </div>
                                                          </div>
                                                          <div class="row-label text-center">
                                                              <div class="address-row-label-div1">
                                                                  <p class="row-label-p">House No./Street/Purok <i class="row-label-i">(Ex. 123 Sun)</i></p>
                                                              </div>
                                                              <div class="address-row-label-div">
                                                                  <p class="row-label-p">Barangay <i class="row-label-i">(Ex. Batasan)</i></p>
                                                              </div>
                                                              <div class="address-row-label-div">
                                                                  <p class="row-label-p">City/Municipality <i class="row-label-i">(Ex. Quezon City)</i></p>
                                                              </div>
                                                              <div class="address-row-label-div">
                                                                  <p class="row-label-p">Province/District <i class="row-label-i">(Ex. Dist. III)</i></p>
                                                              </div>
                                                              <div class="address-row-label-div2">
                                                                  <p class="row-label-p">Region <i class="row-label-i">(Ex. NCR)</i></p>
                                                              </div>
                                                          </div>
                                                          <div class="row-input">
                                                              <div class="otherinfo-row-input-div1">
                                                                  <?php
                                                                      if (empty($row['bn_contact_num'])) {
                                                                          echo "N/A";
                                                                      } else {
                                                                          echo $row['bn_contact_num'];
                                                                      }
                                                                  ?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div2">
                                                                  <?php echo date_format(new DateTime($row['bn_bday']), "M. d, Y");?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div3">
                                                                  <?php echo $row['bn_age'];?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div4">
                                                                  <?php echo $row['bn_sex'];?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div5">
                                                                  <?php echo $row['bn_occupation'];?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div6">
                                                                  <?php echo $row['bn_salary'];?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div7">
                                                                  <?php echo $row['bn_cstatus'];?>
                                                              </div>
                                                          </div>
                                                          <div class="row-label text-center">
                                                              <div class="otherinfo-row-label-div1" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Numero ng Telepono <i class="row-label-i">(Mobile No.)</i></p>
                                                              </div>
                                                              <div class="otherinfo-row-label-div2" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Kapanganakan <i class="row-label-i">(Birthdate)</i></p>
                                                              </div>
                                                              <div class="otherinfo-row-label-div3" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Edad <i class="row-label-i">(Age)</i></p>
                                                              </div>
                                                              <div class="otherinfo-row-label-div4" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Kasarian <i class="row-label-i">(Gender)</i></p>
                                                              </div>
                                                              <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Civil Status</p>
                                                              </div>
                                                              <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                                              </div>
                                                              <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                                                  <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                                              </div>
                                                          <?php  
                                                          }
                                                      ?>
                                            </div>
                                            </div><br>
                                            <div class="container-famcomposition container-fluid">
                                                <div class="info-famcomposition-title">
                                                    <p>KOMPOSISYON NG PAMILYA <i>(Family Composition)</i></p>
                                                </div>
                                                <div class="famcomposition-header">
                                                    <div class="famcomposition text-center">
                                                        <p>Buong Pangalan <br><i>(Complete Name)</i></p>
                                                    </div>
                                                    <div class="famcomposition text-center">
                                                        <p>Relasyon sa Benepisyaryo <br><i>(Relationship to the Beneficiary)</i></p>
                                                    </div>
                                                    <div class="famcomposition2 text-center">
                                                        <p>Kapanganakan <br><i>(Birthday)</i></p>
                                                    </div>
                                                    <div class="famcomposition2 text-center">
                                                        <p>Edad <br><i>(Age)</i></p>
                                                    </div>
                                                    <div class="famcomposition text-center">
                                                        <p>Trabaho <br><i>(Occupation)</i></p>
                                                    </div>
                                                    <div class="famcomposition text-center">
                                                        <p>Buwanang Kita <br><i>(Monthly Salary)</i></p>
                                                    </div>
                                                </div>
                                                <?php
                                                    $sql2 = mysqli_query($conn,"SELECT * FROM tbl_save_famComposition WHERE id_tbl_save_famComposition='".$_SESSION['cl_qn2']."' ");
                                                    if ($sql2->num_rows > 0) {
                                                        while($row2 = mysqli_fetch_array($sql2)){
                                                            ?>
                                                            <div class="famcomposition-input-row">
                                                                <div class="famcomposition-input text-center">
                                                                    <?php echo $row2['fname']." ".substr($row2['mname'],0,1).". ".$row2['lname']; if ($row2['nameext'] == "N/A") {
                                                                        echo ""; } else {echo ", ".$row2['nameext'];}
                                                                    ?>
                                                                </div>
                                                                <div class="famcomposition-input text-center">
                                                                    <?php echo $row2['reltobene'];?>
                                                                </div>
                                                                <div class="famcomposition2-input text-center">
                                                                    <?php echo date_format(new DateTime($row2['bday']), "M. d, Y");?>
                                                                </div>
                                                                <div class="famcomposition2-input text-center">
                                                                    <?php echo $row2['age'];?>
                                                                </div>
                                                                <div class="famcomposition-input text-center">
                                                                    <?php echo $row2['occupation'];?>
                                                                </div>
                                                                <div class="famcomposition-input text-center">
                                                                    <?php echo $row2['salary'];?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="famcomposition-input-row">
                                                            <div class="famcomposition-input text-center">
                                                                <?php echo "N/A"?>
                                                            </div>
                                                            <div class="famcomposition-input text-center">
                                                                <?php echo "N/A"?>
                                                            </div>
                                                            <div class="famcomposition2-input text-center">
                                                                <?php echo "N/A"?>
                                                            </div>
                                                            <div class="famcomposition2-input text-center">
                                                                <?php echo "N/A"?>
                                                            </div>
                                                            <div class="famcomposition-input text-center">
                                                                <?php echo "N/A"?>
                                                            </div>
                                                            <div class="famcomposition-input text-center">
                                                                <?php echo "N/A"?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="container-huwag container-fluid">
                                                <div class="huwag-susulatan-title2">
                                                    <p>Part II: To be Filled out by DSWD Personnel</i></p>
                                                </div>
                                                <div class="table2">
                                                    <div class="bene-category">
                                                        <p class="text-center">Client Category</p>
                                                    </div>
                                                    <div class="sw-assessment">
                                                        <p class="text-center">Social Worker's Assessment</p>
                                                    </div>
                                                    <div class="bene-category2">
                                                        <div class="target-sector">
                                                            <p>Target Sector:</p>
                                                            <ul>
                                                                <li>
                                                                    <div class="list-sector">
                                                                        <?php
                                                                            $cl_category=$row['cl_category'];
                                                                            if ($cl_category=="FHONA") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sector-p">FHONA</p>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                        <?php
                                                                            if ($cl_category=="WEDC") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sector-p">WEDC</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                            <?php
                                                                                  if ($cl_category=="CHILD") {
                                                                                        ?>
                                                                                              <p class="p-check2">&#x2713;</p>
                                                                                        <?php
                                                                                  } else {

                                                                                  }
                                                                            ?>
                                                                            <p class="list-sector-p">CHILD</p>
                                                                            
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                            <?php
                                                                                  if ($cl_category=="CNSP") {
                                                                                        ?>
                                                                                              <p class="p-check2">&#x2713;</p>
                                                                                        <?php
                                                                                  } else {

                                                                                  }
                                                                            ?>
                                                                            <p class="list-sector-p">CNSP</p>
                                                                            
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                        <?php
                                                                            if ($cl_category=="YNSP") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sector-p">YNSP</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                        <?php
                                                                            if ($cl_category=="PWD") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sector-p">PWD</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                        <?php
                                                                            if ($cl_category=="SC") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sector-p">SC</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sector">
                                                                        <?php
                                                                            if ($cl_category=="PLHIV") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sector-p">PLHIV</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="sub-category">
                                                            <p>Specify Sub-Category:</p>
                                                            <ul><li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            $cl_subcategory=$row['cl_subcategory']; $cl_subcategory2=$row['cl_subcategory2'];
                                                                            if ($cl_subcategory=="Solo Parents") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="Solo Parents") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">Solo Parents</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="Indigenous People") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                    <p class="list-sub-category-p">Indigenous People: <u><?php echo $row['cl_ipAffiliation']; ?></u></p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="Indigenous People") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                    <p class="list-sub-category-p">Indigenous People: <u><?php echo $row['cl_ipAffiliation']; ?></u></p>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                    <p class="list-sub-category-p">Indigenous People</p>
                                                                                <?php                                               
                                                                            }
                                                                        ?>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="Recovering Person who used drugs") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="Recovering Person who used drugs") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">Recovering Person who used drugs</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="4Ps DSWD Beneficiary") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="4Ps DSWD Beneficiary") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">4Ps DSWD Beneficiary</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="Street Dwellers") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="Street Dwellers") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">Street Dwellers</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="Psychosocial/Mental/Learning Disability") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="Psychosocial/Mental/Learning Disability") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">Psychosocial/Mental/Learning Disability</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="Stateless Person/Asylum Seekers/Refugees") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="Stateless Person/Asylum Seekers/Refugees") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">Stateless Person/Asylum Seekers/Refugees</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if ($cl_subcategory=="KIA/WIA") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($cl_subcategory2=="KIA/WIA") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else {

                                                                            }
                                                                        ?>
                                                                        <p class="list-sub-category-p">KIA/WIA</p>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="list-sub-category">
                                                                        <?php
                                                                            if (($cl_subcategory!="Solo Parents")&&($cl_subcategory!="Indigenous People")&&($cl_subcategory!="Recovering Person who used drugs")&&($cl_subcategory!="4Ps DSWD Beneficiary")&&($cl_subcategory!="Street Dwellers")&&($cl_subcategory!="Psychosocial/Mental/Learning Disability")&&($cl_subcategory!="Stateless Person/Asylum Seekers/Refugees")&&($cl_subcategory!="N/A")) {
                                                                                ?>
                                                                                   <p class="p-check2">&#x2713;</p>
                                                                                   <p class="list-sub-category-p">Others: <u><?php echo $cl_subcategory;?></u></p>
                                                                                <?php
                                                                            } else if (($cl_subcategory2!="Solo Parents")&&($cl_subcategory2!="Indigenous People")&&($cl_subcategory2!="Recovering Person who used drugs")&&($cl_subcategory2!="4Ps DSWD Beneficiary")&&($cl_subcategory2!="Street Dwellers")&&($cl_subcategory2!="Psychosocial/Mental/Learning Disability")&&($cl_subcategory2!="Stateless Person/Asylum Seekers/Refugees")&&($cl_subcategory2!="KIA/WIA")&&($cl_subcategory2!="N/A")) {
                                                                                ?>
                                                                                     <p class="p-check2">&#x2713;</p>
                                                                                   <p class="list-sub-category-p">Others: <u><?php echo "/".$cl_subcategory2."/";?></u></p>
                                                                                <?php
                                                                            } else if (($cl_subcategory=='N/A')||($cl_subcategory2=='N/A')) { ?>
                                                                                                    <p class="list-sub-category-p">Others</p>
                                                                                                    <?php
                                                                                              } else { ?>
                                                                                <p class="list-sub-category-p">Others</p>
                                                                                <?php
                                                                            };
                                                                        ?>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="sw-assessment2">
                                                        <p style="font-size: 12px; line-height: 1; display: inline-flex; overflow-wrap: anywhere;"><?php echo $row_tbl_addl_entry['assessment'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-assistance container-fluid">
                                                <div class="assistance-col">
                                                    <p>Financial Assistance:</p>
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "MEDICAL") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Medical</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    if ($row_tbl_addl_entry['assistance_type'] == "FUNERAL") {
                                                                        ?>
                                                                        <p class="p-check">&#x2713;</p>
                                                                        <?php
                                                                    } else {}
                                                                ?>
                                                                <p class="list-sub-category-p">Funeral</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Transportation</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Educational</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col" style="left: 110px; top: 37px;">
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Food Assistance</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p" style="width: 197px;">Cash Relief Assistance</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p" style="width: 197px;">Emergency Cash Transfer-AICS</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col" style="left: 300px;">
                                                    <p>Material Assistance:</p>
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    $count = count($material_assistance_arrval)-1;
                                                                    //Loop through each array index
                                                                    for($i = 0; $i <= $count; $i++) {
                                                                        //Assign the value of the array key to a variable
                                                                        $value = $material_assistance_arrval[$i];
                                                                        //Check if result string contains diam-mm
                                                                        if ($value == 'Family Food Packs'){
                                                                            ?>
                                                                            <p class="p-check">&#x2713;</p>
                                                                            <?php
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                ?>
                                                                <p class="list-sub-category-p">Family Food Packs</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    $count = count($material_assistance_arrval)-1;
                                                                    //Loop through each array index
                                                                    for($i = 0; $i <= $count; $i++) {
                                                                        //Assign the value of the array key to a variable
                                                                        $value = $material_assistance_arrval[$i];
                                                                        //Check if result string contains diam-mm
                                                                        if ($value == 'Other Food Items'){
                                                                            ?>
                                                                            <p class="p-check">&#x2713;</p>
                                                                            <?php
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                ?>
                                                                <p class="list-sub-category-p">Other Food Items</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    $count = count($material_assistance_arrval)-1;
                                                                    //Loop through each array index
                                                                    for($i = 0; $i <= $count; $i++) {
                                                                        //Assign the value of the array key to a variable
                                                                        $value = $material_assistance_arrval[$i];
                                                                        //Check if result string contains diam-mm
                                                                        if ($value == 'Hygiene & Sleeping Kits'){
                                                                            ?>
                                                                            <p class="p-check">&#x2713;</p>
                                                                            <?php
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                ?>
                                                                <p class="list-sub-category-p">Hygiene & Sleeping Kits</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    $count = count($material_assistance_arrval)-1;
                                                                    //Loop through each array index
                                                                    for($i = 0; $i <= $count; $i++) {
                                                                        //Assign the value of the array key to a variable
                                                                        $value = $material_assistance_arrval[$i];
                                                                        //Check if result string contains diam-mm
                                                                        if ($value == 'Assistive Device & Technologies'){
                                                                            ?>
                                                                            <p class="p-check">&#x2713;</p>
                                                                            <?php
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                ?>
                                                                <p class="list-sub-category-p">Assistive Device & Technologies</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col" style="left: 485px;"> 
                                                    <p>Psychosocial Support:</p>
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    $count = count($psycho_support_arrval)-1;
                                                                    //Loop through each array index
                                                                    for($i = 0; $i <= $count; $i++) {
                                                                        //Assign the value of the array key to a variable
                                                                        $value = $psycho_support_arrval[$i];
                                                                        //Check if result string contains diam-mm
                                                                        if ($value == 'Psychological First Aid (PAF)'){
                                                                            ?>
                                                                            <p class="p-check">&#x2713;</p>
                                                                            <?php
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                ?>
                                                                <p class="list-sub-category-p">Psychological First Aid</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <?php
                                                                    $count = count($psycho_support_arrval)-1;
                                                                    //Loop through each array index
                                                                    for($i = 0; $i <= $count; $i++) {
                                                                        //Assign the value of the array key to a variable
                                                                        $value = $psycho_support_arrval[$i];
                                                                        //Check if result string contains diam-mm
                                                                        if ($value == 'Social Work Counseling'){
                                                                            ?>
                                                                            <p class="p-check">&#x2713;</p>
                                                                            <?php
                                                                        } else {
                                                                            
                                                                        }
                                                                    }
                                                                ?>
                                                                <p class="list-sub-category-p">Social Work Counseling</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col" style="left: 659px; width: 136px;">
                                                    <p>Referral:</p>
                                                    <p style="font-size: 9px; overflow-wrap: anywhere;"><u>
                                                        <?php echo $row_tbl_addl_entry['referral'];?>
                                                    </u></p>
                                                </div>

                                            </div>
                                            <div class="container-provided container-fluid">
                                                <div class="provided-col1 text-center">
                                                    <p>Assistance Provided</p>
                                                </div>
                                                <div class="provided-col2 text-center">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="provided-col3 text-center">
                                                    <p>Fund Source</p>
                                                </div>
                                            </div>
                                            <div class="container-provided input1 container-fluid">
                                                <div class="provided-col1">
                                                    <p style="margin-top: -2px;">1) <?php echo $row_tbl_addl_entry['assistance_type'];?> Assistance</p>
                                                </div>
                                                <div class="provided-col2">
                                                    <p style="margin-top: -2px;" class="text-center">&#8369;<?php echo number_format($row_tbl_addl_entry['amount_in_figures'],2);?></p>
                                                </div>
                                                <div class="provided-col3">
                                                    <p style="margin-top: -2px;" class="text-center"><?php echo $row_tbl_addl_entry['fund_source'];?></p>
                                                </div>
                                            </div>
                                            <div class="container-provided input2 container-fluid">
                                                <div class="provided-col1">
                                                    <p style="margin-top: -2px;">2) <?php echo $row_tbl_addl_entry['material_assistance'];?></p>
                                                </div>
                                                <div class="provided-col2">
                                                    <p></p>
                                                </div>
                                                <div class="provided-col3">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="container-provided input3 container-fluid">
                                                <div class="provided-col1">
                                                    <p style="margin-top: -2px;">3) <?php echo $row_tbl_addl_entry['psycho_support'];?></p>
                                                </div>
                                                <div class="provided-col2">
                                                    <p></p>
                                                </div>
                                                <div class="provided-col3">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="container-signatory container-fluid">
                                                <div class="client-sig text-center">
                                                    <p class="iDeclare">"We are committed to protect and respect the privacy of our clients and beneficiaries and we will only collect, record, store, process and use personal information in accordance with Republic Act No. 10173 or the Data Privacy Act of 2012. By signing this form you are giving your consent to the DSWD and hereby agree to the terms and conditions set herein and with the applicable Data Privacy Policy of the Department."</p>
                                                    <p style="margin-top: 9px; background-color: yellow; padding-top: 15px;"><u><b>
                                                                <?php
                                                                      echo strtoupper($row['cl_fname'])." "; 
                                                                      if (empty($row['cl_mname'])) {
                                                                            echo "";
                                                                      } else {
                                                                            echo strtoupper(substr($row['cl_mname'],0,1)).". ";
                                                                      }
                                                                      echo strtoupper($row['cl_lname']);
                                                                      if ($row['cl_nameext'] == "N/A") {
                                                                            echo "";
                                                                      } else {
                                                                            echo ", ".$row['cl_nameext'];
                                                                }?> 
                                                    </b></u></p>
                                                    <p>Buong Pangalan at Pirma</p>
                                                    <i>(Signature over Printed Name)</i>
                                                </div>
                                                <div class="client-tmark">
                                                    <div class="thumbmark"></div>
                                                </div>
                                                <div class="interviewedby text-center">
                                                    <br><br><p>Interviewed by:</p><br><br>
                                                    <p><u><b>
                                                            <?php
                                                              echo strtoupper($row_swo['fname'])." "; 
                                                              if (empty($row_swo['mname'])) {
                                                                    echo "";
                                                              } else {
                                                                    echo strtoupper(substr($row_swo['mname'],0,1)).". ";
                                                              }
                                                              echo strtoupper($row_swo['lname']);
                                                              if ($row_swo['nameext'] == "N/A" || $row_swo['nameext'] == "") {
                                                                    echo "";
                                                              } else {
                                                                    echo ", ".$row_swo['nameext'];
                                                              }
                                                            ?> 
                                                    </b></u></p>
                                                    <p>Social Worker</p>
                                                    <i>(Signature over Printed Name)</i>
                                                </div>
                                                <div class="approvedby text-center">
                                                    <br><br><p>Reviewed and Approved by:</p><br><br>
                                                    <?php
                                                        $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'SDN SWAD Team Leader' ");
                                                        $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                                                    ?>
                                                    <p style="margin: 0px;"><b><u><?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; } ?></u></b></p>
                                                    <p>Approving Authority</p>
                                                    <i>(Signature over Printed Name)</i>
                                                </div>
                                            </div>
                                            <div class="container-footer-updt container-fluid">
                                                <p>Page 1 of 1</p>
                                                <p style="border-top: solid black 1px;">DSWD Field Office Caraga, R. Palma Street, Butuan City, Philippines 8600</p>
                                                <p>Website: http://caraga.dswd.gov.ph Tel Nos.: (085) 303-8620</p>
                                                <img class="footer_logo" src="images/updated-logo/footer_logo.png">
                                            </div>
                                        </page>
                                    </div>
                                </div>
                                <!-- end of gis -->
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
        function print_filecopy_gis() {
          window.open("print_filecopy_gis.php");
        }
        function print_filecopy_pcv() {
          window.open("print_filecopy_pcv.php");
        }
        function print_filecopy_coe_pcv() {
          window.open("print_filecopy_coe_pcv.php");
        }
    </script>


</body>
</html>