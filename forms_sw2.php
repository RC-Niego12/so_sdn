<?php
// Start the session
session_start();
    $_SESSION['cl_qn']; $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql_tbl_staffs = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname='".$_SESSION['uname']."' AND pword='".$_SESSION['pword']."' ");
    $row1 = mysqli_fetch_assoc($sql_tbl_staffs);

    $sql_tbl_clientqueue = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['cl_qn']."' ");
        $row = mysqli_fetch_assoc($sql_tbl_clientqueue);

    $sql_tbl_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_addl_entry WHERE cl_qn='".$_SESSION['cl_qn']."' ");
        $row_tbl_addl_entry = mysqli_fetch_assoc($sql_tbl_addl_entry);

    $attachments_exp = explode(',', $row_tbl_addl_entry['other_attachments']);
    $attachments_arrval = array_values($attachments_exp);

    $attachments2_exp = explode(',', $row_tbl_addl_entry['other_attachments2']);
    $attachments2_arrval = array_values($attachments2_exp);

    $material_assistance_exp = explode(',', $row_tbl_addl_entry['material_assistance']);
    $material_assistance_arrval = array_values($material_assistance_exp);

    $psycho_support_exp = explode(',', $row_tbl_addl_entry['psycho_support']);
    $psycho_support_arrval = array_values($psycho_support_exp);

    $swo_initial = substr($row1['fname'],0,1).''.substr($row1['mname'],0,1).''.substr($row1['lname'],0,1);
    $swo_staffid = $row1['staffid'];
    date_default_timezone_set('Asia/Manila');
    $monthnow = date('m');
    $yearnow = date('Y');
    $gl_code_prefix = $swo_initial.'-'.$yearnow.'-'.$monthnow.'-';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Print Forms - GL</title>
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
                <a class="navbar-brand" href="#" title="Forms for Printing - SW Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Social Worker Level</a>
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
                    $row_staff = mysqli_fetch_assoc($sql); $USER = $row_staff['fname'];
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
                        if ($row_staff['sex']=="M") {
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row_staff['fname'].' '.substr($row_staff['mname'],0,1).'. '.$row_staff['lname'].' '.$row_staff['nameext']; ?></div>
                    <div class="email"><?php echo $row_staff['uname'].' | Table '.$row_staff['table_num']; ?></div>
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
                        <a href="home_sw.php">
                            <span class="glyphicon glyphicon-home"></span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="forms_sw.php">
                            <span class="fa fa-print"></span>
                            <span>Forms for Printing</span>
                        </a>
                    </li>
                    <li>
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
                                    <a href="#gl" data-toggle="tab">
                                        <span class="fa fa-file-text" style="color: darkblue;"></span> GL
                                    </a>
                                </li>
                                <li>
                                    <a href="#coe" data-toggle="tab">
                                        <span class="fa fa-file-text" style="color: darkblue;"></span> COE
                                    </a>
                                </li>
                                <li>
                                    <a href="#computation" data-toggle="tab">
                                        <span class="fa fa-file-text" style="color: darkblue;"></span> Computation
                                    </a>
                                </li>
                                <li>
                                    <a href="#pagpamatuod" data-toggle="tab">
                                        <span class="fa fa-file-text" style="color: darkblue;"></span> Pagpamatuod
                                    </a>
                                </li>
                                <li>
                                    <a href="#save_transaction" data-toggle="tab">
                                        <span class="fa fa-save" style="color: darkblue;"></span> Save/Edit Transaction
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; margin: -1px;">
                                <!-- gis -->
                                <div id="gis" class="tab-pane fade in active">
                                    <button onclick="print_view_gis()" class="btn btn-primary bg-darkblue waves-effect" name="print_view_gis" style="position: fixed; top: 145px;">
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
                                                        <?php echo date_format(new DateTime($row['date_added']), "h:i A");?>
                                                    </div>
                                                </div>
                                                <div class="div-date">
                                                    <p class="div-qn-p">Date:</p>
                                                    <div class="date text-center">
                                                        <?php echo date_format(new DateTime($row['date_added']), "M. d, Y");?>
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
                                            <div class="container-bene container-fluid">
                                                <div class="info-bene-title">
                                                    <p>IMPORMASYON NG BENEPISYARYO <i>(Beneficiary's Identifying Information)</i></p>
                                                </div>
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
                                                    <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                                        <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                                        <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                                    </div>
                                                    <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                                        <p class="row-label-p">Civil Status</p>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="container-client container-fluid">
                                                <div class="info-client-title">
                                                    <p>IMPORMASYON NG KINATAWAN <i>(Representative's Identifying Information)</i></p>
                                                </div>
                                                    <?php
                                                          if ($row['cl_reltobene'] == "Self") {
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
                                                                      <div class="otherinfo-row-input-div5">
                                                                            <?php echo "--";?>
                                                                      </div>
                                                                      <div class="otherinfo-row-input-div6">
                                                                            <?php echo "--";?>
                                                                      </div>
                                                                      <div class="otherinfo-row-input-div7">
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
                                                                      <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                                                            <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                                                      </div>
                                                                      <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                                                            <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                                                      </div>
                                                                      <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                                                            <p class="row-label-p">Civil Status</p>
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
                                                                            <?php echo date_format(new DateTime($row_tbl_addl_entry['date_added']), "h:i A");?>
                                                                      </div>
                                                                </div>
                                                          </div>
                                                                </div>
                                                          <?php
                                                          } else {
                                                                ?>
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
                                                                      <div class="otherinfo-row-input-div5">
                                                                            <?php echo $row['cl_occupation'];?>
                                                                      </div>
                                                                      <div class="otherinfo-row-input-div6">
                                                                            <?php echo $row['cl_salary'];?>
                                                                      </div>
                                                                      <div class="otherinfo-row-input-div7">
                                                                            <?php echo $row['cl_cstatus'];?>
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
                                                                      <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                                                            <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                                                      </div>
                                                                      <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                                                            <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                                                      </div>
                                                                      <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                                                            <p class="row-label-p">Civil Status</p>
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
                                                                            <?php echo date_format(new DateTime($row_tbl_addl_entry['date_added']), "h:i A");?>
                                                                      </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="container-huwag container-fluid">
                                                <div class="huwag-susulatan-title">
                                                    <p>Huwag susulatan. Ang DSWD lamang and pwede gumamit. <i>(Do not write below, this part is for DSWD's use only)</i></p>
                                                </div>
                                                <div class="table">
                                                    <div class="bene-category">
                                                        <p class="text-center">Beneficiary Category</p>
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
                                                                            $bn_category=$row['bn_category'];
                                                                            if ($bn_category=="FHONA") {
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
                                                                            if ($bn_category=="WEDC") {
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
                                                                                  if ($bn_category=="CHILD") {
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
                                                                                  if ($bn_category=="CNSP") {
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
                                                                            if ($bn_category=="YNSP") {
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
                                                                            if ($bn_category=="PWD") {
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
                                                                            if ($bn_category=="SC") {
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
                                                                            if ($bn_category=="PLHIV") {
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
                                                                            $bn_subcategory=$row['bn_subcategory']; $bn_subcategory2=$row['bn_subcategory2'];
                                                                            if ($bn_subcategory=="Solo Parents") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="Solo Parents") {
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
                                                                            if ($bn_subcategory=="Indigenous People") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                    <p class="list-sub-category-p">Indigenous People: <u><?php echo $row['bn_ipAffiliation']; ?></u></p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="Indigenous People") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                    <p class="list-sub-category-p">Indigenous People: <u><?php echo $row['bn_ipAffiliation']; ?></u></p>
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
                                                                            if ($bn_subcategory=="Recovering Person who used drugs") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="Recovering Person who used drugs") {
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
                                                                            if ($bn_subcategory=="4Ps DSWD Beneficiary") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="4Ps DSWD Beneficiary") {
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
                                                                            if ($bn_subcategory=="Street Dwellers") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="Street Dwellers") {
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
                                                                            if ($bn_subcategory=="Psychosocial/Mental/Learning Disability") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="Psychosocial/Mental/Learning Disability") {
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
                                                                            if ($bn_subcategory=="Stateless Person/Asylum Seekers/Refugees") {
                                                                                ?>
                                                                                    <p class="p-check2">&#x2713;</p>
                                                                                <?php
                                                                            } else if ($bn_subcategory2=="Stateless Person/Asylum Seekers/Refugees") {
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
                                                                            if (($bn_subcategory!="Solo Parents")&&($bn_subcategory!="Indigenous People")&&($bn_subcategory!="Recovering Person who used drugs")&&($bn_subcategory!="4Ps DSWD Beneficiary")&&($bn_subcategory!="Street Dwellers")&&($bn_subcategory!="Psychosocial/Mental/Learning Disability")&&($bn_subcategory!="Stateless Person/Asylum Seekers/Refugees")&&($bn_subcategory!="N/A")) {
                                                                                ?>
                                                                                   <p class="p-check2">&#x2713;</p>
                                                                                   <p class="list-sub-category-p">Others: <u><?php echo $bn_subcategory;?></u></p>
                                                                                <?php
                                                                            } else if (($bn_subcategory2!="Solo Parents")&&($bn_subcategory2!="Indigenous People")&&($bn_subcategory2!="Recovering Person who used drugs")&&($bn_subcategory2!="4Ps DSWD Beneficiary")&&($bn_subcategory2!="Street Dwellers")&&($bn_subcategory2!="Psychosocial/Mental/Learning Disability")&&($bn_subcategory2!="Stateless Person/Asylum Seekers/Refugees")&&($bn_subcategory2!="N/A")) {
                                                                                ?>
                                                                                     <p class="p-check2">&#x2713;</p>
                                                                                   <p class="list-sub-category-p">Others: <u><?php echo "/".$bn_subcategory2."/";?></u></p>
                                                                                <?php
                                                                            } else if (($bn_subcategory=='N/A')||($bn_subcategory2=='N/A')) { ?>
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
                                                    $sql2 = mysqli_query($conn,"SELECT * FROM tbl_famcomposition WHERE qn='".$_SESSION['cl_qn']."' ");
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
                                                                <p class="list-sub-category-p">Education</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col" style="left: 110px; top: 45px;">
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Food Assistance</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p" style="width: 197px;">Cash Assistance for Other Support Services</p>
                                                                
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
                                                    <p class="iDeclare">"I declare under oath that I personally accomplished the GIS and all the information provided herewith are TRUE, CORRECT, VALID & COMPLETE pursuant to existing laws, rules and regulations of the Republic of the Philippines. I authorized the Agency Head to validate the contents stated herein. I also AGREE that any MISINTERPRETATION and Information/Act to DEFRAUD the government including attached documents shall cause the filling of appropriate case/s against me."</p>
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
                                                              echo strtoupper($row_staff['fname'])." "; 
                                                              if (empty($row_staff['mname'])) {
                                                                    echo "";
                                                              } else {
                                                                    echo strtoupper(substr($row_staff['mname'],0,1)).". ";
                                                              }
                                                              echo strtoupper($row_staff['lname']);
                                                              if ($row_staff['nameext'] == "N/A" || $row_staff['nameext'] == "") {
                                                                    echo "";
                                                              } else {
                                                                    echo ", ".$row_staff['nameext'];
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
                                            <div class="container-footer container-fluid">
                                                <img src="images/dswd-footer-logo.png">
                                            </div>
                                        </page>
                                    </div>
                                </div><!-- end of gis -->

                                <!-- gl -->
                                <div id="gl" class="tab-pane fade in">
                                    <button onclick="print_view_gl()" class="btn btn-primary bg-darkblue waves-effect" name="print_view_gl" style="position: fixed; top: 145px;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <page size="A4flex" layout="orientation" class="page2" <?php if (($amt>=0) && ($amt<=50000)) { ?> style="background-color: hotpink !important;" <?php } else if (($amt>=50001) && ($amt<=75000)) { ?> style="background-color: yellow !important;" <?php } else if (($amt>=75001) && ($amt<=100000)) { ?> style="background-color: lightskyblue !important;" <?php } else if (($amt>=100001) && ($amt<=150000)) { ?> style="background-color: lightgreen !important;" <?php } ?>>
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
                                        <p style="font-size: 15px; text-align: right; margin: 0px;"><u><b>GL No: <?php echo $row_tbl_addl_entry['gl_code'];?></b></u></p>
                                        <br><br>
                                        <p style="font-size: 15px; text-align: left; margin: 0px;">Date: <?php echo date_format(new DateTime($row['date_added']), "M. d, Y");?></p>
                                        <br>
                                        <p style="font-size: 15px; margin: 0px;"><b>Addressee: <?php echo strtoupper($row_tbl_addl_entry['sp']);?></b></p>
                                        <p style="font-size: 13px; margin: 0px;"><b>Position:</b> N/A</p>
                                        <p style="font-size: 13px; margin: 0px;"><b>Address:</b> <?php echo $row_tbl_addl_entry['sp_address'];?></p>
                                        <br><br>
                                        <p style="font-size: 15px;"><b>Dear Ma'am/Sir,</b></p><br>
                                        <p style="font-size: 15px;">
                                            This has reference to the request for the <span><b><u><?php echo $row_tbl_addl_entry['assistance_type'];?></u></b></span> assistance of herein client, <span><u><b> <?php echo strtoupper($row['cl_fname'])." "; if (empty($row['cl_mname'])) { echo ""; } else { echo strtoupper(substr($row['cl_mname'],0,1)).". "; } echo strtoupper($row['cl_lname']); if ($row['cl_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['cl_nameext']; }?></b></u></span> for his/her <span><b><u><?php if ($row['bn_reltoclient'] == 'Self') { echo strtoupper($row['bn_reltoclient']).'.'; } else { echo strtoupper($row['bn_reltoclient']).', ' ;}?></u></b></span><span><u><b> <?php if ($row['bn_reltoclient'] == 'Self') { echo ''; } else { echo strtoupper($row['bn_fname'])." "; if (empty($row['bn_mname'])) { echo ""; } else { echo strtoupper(substr($row['bn_mname'],0,1)).". "; } echo strtoupper($row['bn_lname']); if ($row['bn_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['bn_nameext'] ;} ;}?></b></u></span>.
                                        </p><br>
                                        <p style="font-size: 15px;">
                                           The Department of Social Welfare and Development has assessed and validated the said request for assistance through the Crisis Intervention Section. Thus, the Department is using this letter to guarantee the payment of the bill in the amount of <span><b><u><?php echo $row_tbl_addl_entry['amount_in_words'];?></u></b></span>, Php <span><b><u><?php echo number_format($row_tbl_addl_entry['amount_in_figures'],2);?></u></b></span>.
                                        </p><br>
                                        <p style="font-size: 15px;">
                                            To facilitate the payment, please submit to the Crisis Intervention Division, through <b><u>AICS BILLING</u></b>, the following documents for the preparation of the <b><u>Disbursement Voucher</u></b> within one week after service has been completed:
                                        </p><br>
                                        <p style="font-size: 15px; text-indent: 70px;">Ø  Guarantee Letter (GL) from the DSWD with your company's "received" stamp, and;</p>
                                        <p style="font-size: 15px; text-indent: 70px;">Ø  Statement of Accounts (SOA) or Billing Statement addressed to DSWD.</p><br>
                                        <p style="font-size: 15px;">Please be informed that said payment will be directly deposited to your company's bank acount. Should there be any query, you may call us at <b>(085) 303-8620</b>.</p><br>
                                        <p style="font-size: 15px;">For your consideration.</p><br>
                                        <p style="font-size: 15px;">Thank you.</p><br><br><br>
                                        <p style="font-size: 15px;">Very truly yours,</p><br><br>
                                        <?php
                                            $amt = $row_tbl_addl_entry['amount_in_figures'];
                                            $sql_signatory = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE amt_from<='".$amt."' AND amt_to >= '".$amt."' ");
                                            $row_signatory = mysqli_fetch_assoc($sql_signatory);
                                        ?>
                                        <p style="font-size: 15px; margin: 0px;"><b><u><?php echo strtoupper($row_signatory['fname'])." "; if (empty($row_signatory['mname'])) { echo ""; } else { echo strtoupper(substr($row_signatory['mname'],0,1)).". "; } echo strtoupper($row_signatory['lname']); if ($row_signatory['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_signatory['nameext']; } if (empty($row_signatory['suffix'])) {echo ''; } else { echo ', '.$row_signatory['suffix']; } ?></u></b></p>
                                        <p style="font-size: 14px; margin: 0px;">Approving Authority</p>
                                        <p style="font-size: 12px; margin: 0px;"><b>Position:</b> <?php echo $row_signatory['designation'];?></p>
                                        <p style="font-size: 12px; margin: 0px;"><b>Office:</b> Crisis Intervention Section</p><br><br><br>
                                        <?php
                                            date_format(new DateTime($row['date_added']), "M. d, Y") ;
                                            $mo_valid = date_format(new DateTime($row['date_added']), "M.");
                                            $date_valid = date_format(new DateTime($row['date_added']), "d") + 3;
                                            $yr_valid = date_format(new DateTime($row['date_added']), "Y");
                                        ?>
                                        <p style="font-size: 14px;"><b>Valid Until:</b> <?php echo $mo_valid.' '.$date_valid.', '.$yr_valid; ?></p>
                                        <p style="font-size: 14px;"><b>*</b><i>Validity period includes the time of receipt of the guarantee letter by the service provider.</i></p>
                                        <div class="container-footer container-fluid">
                                            <img src="images/dswd-footer-logo.png">
                                        </div>
                                    </page>
                                </div><!-- end of gl -->

                                <!-- coe -->
                                <div id="coe" class="tab-pane fade in">
                                    <button onclick="print_view_coe_gl()" class="btn btn-primary bg-darkblue waves-effect" name="print_view_coe_gl" style="position: fixed; top: 145px;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <page size="A4flex" layout="orientation" class="page2">
                                        <div class="header-logos">
                                            <img src="images/DSWD-logo.png" class="header-logos-dswd-logo">
                                            <img src="images/dswd-caraga-logo.png" class="header-logos-dswdcaraga-logo">
                                            <img src="images/dswd-aics-logo.png" class="header-logos-aics-logo2">
                                            <div class="header-logos-cis-logo">
                                                <p>CRISIS INTERVENTION SECTION</p>
                                                <p style="font-size: 11px;">PROTECTIVE SERVICES DIVISION</p>
                                                <p>FIELD OFFICE CARAGA</p>
                                                <p style="font-size: 9px;">DSWD-PMB-GF-014 | REV 01 /30 SEPT 2022</p>
                                            </div><br>
                                        </div><br>
                                        <h4 style="text-align: center; margin: 0px;">CERTIFICATE OF ELIGIBILITY</h4>
                                        <P style="text-align: center; margin: 0px; font-size: 14px;">(Guarantee Letter)</P>
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
                                                <div class="div_glcode">
                                                    <p class="div-qn-p">GL Code:</p>
                                                    <div class="date text-center">
                                                        <?php echo $row_tbl_addl_entry['gl_code'];?>
                                                    </div>
                                                </div>
                                                <div class="div-date" style="width: auto !important;">
                                                    <p class="div-qn-p">Date:</p>
                                                    <div class="date text-center">
                                                        <?php echo date_format(new DateTime($row['date_added']), "M. d, Y");?>
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
                                                <p style="font-size: 12px;">Relasyon ng Benepisyaryo sa Kinatawan <i style="font-size: 8px;">(Relationship of the Beneficiary with Representative)</i></p>
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
                                                        echo $row_tbl_addl_entry['purpose'];
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div>
                                        <div class="row-input" style="margin-top: 5px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;">
                                                in the amount of 
                                            </p>
                                            <div class="" style="width: 132mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['amount_in_words'];
                                                    ?>
                                                </b></p>
                                            </div>
                                            <p style="margin: 0px; font-size: 12px; display: inline-block;"> , </p>
                                            <div class="" style="width: 50mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px; text-align: center;"><b> Php 
                                                    <?php
                                                        echo number_format($row_tbl_addl_entry['amount_in_figures'],2);
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div><br>
                                        <div class="row-input" style="margin-top: 5px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block; width: 40mm;">
                                                Chargeable against: 
                                            </p>
                                            <div class="" style="width: 168mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['fund_source'];
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div>
                                        <div class="row-input" style="margin-top: 5px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block; width: 40mm;">
                                                Cliente Category: 
                                            </p>
                                            <div class="" style="width: 168mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px;"><b>
                                                    <?php
                                                        echo $row['cl_category'];
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div>
                                        <div class="row-input" style="margin-top: 5px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block; width: 40mm;">
                                                Payable to: 
                                            </p>
                                            <div class="" style="width: 168mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['sp'];
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div>
                                        <div class="row-input" style="margin-top: 5px;">
                                            <p style="margin: 0px; font-size: 12px; display: inline-block; width: 40mm;">
                                                Mode of Admission:
                                            </p>
                                            <div class="" style="width: 168mm; display: inline-block; border-bottom: solid black 1px;">
                                                <p style="margin: 0px; font-size: 12px;"><b>
                                                    <?php
                                                        echo $row_tbl_addl_entry['admission_mode'];
                                                    ?>
                                                </b></p>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-sm-5 text-center">
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
                                                <p style="font-size: 13px;">Beneficiary/Representative</p>
                                                <p style="font-size: 12px;">Requesting Party</p>
                                                <p style="font-size: 11px;">(Signature over Printed Name)</p>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-5 text-center">
                                                <p style="font-size: 13px;">PREPARED BY:</p><br><br>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                                                    <?php
                                                      echo strtoupper($row1['fname'])." "; 
                                                      if (empty($row1['mname'])) {
                                                            echo "";
                                                      } else {
                                                            echo strtoupper(substr($row1['mname'],0,1)).". ";
                                                      }
                                                      echo strtoupper($row1['lname']);
                                                      if ($row1['nameext'] == "N/A" || $row1['nameext'] == "") {
                                                            echo "";
                                                      } else {
                                                            echo ", ".$row1['nameext'];
                                                      }
                                                    ?> 
                                                </p>
                                                <p style="font-size: 13px;">Social Worker</p>
                                                <p style="font-size: 12px;">Licence Number: <?php echo $row1['lic_no']; ?></p>
                                                <p style="font-size: 11px;">(Signature over Printed Name)</p>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6 text-center">
                                                <p style="font-size: 13px;">APPROVED BY:</p><br><br>
                                                <!--<?php
                                                    //$sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'SDN SWAD Team Leader' ");
                                                    //$row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                                                ?>
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                                                    <?php 
                                                        //echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; }
                                                    ?>
                                                </b></p>-->
                                                <!--<p style="font-size: 13px;">
                                                    <?php //echo $row_approv_gis['designation']; ?>      
                                                </p>-->
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                                                    <?php echo strtoupper($row_signatory['fname'])." "; if (empty($row_signatory['mname'])) { echo ""; } else { echo strtoupper(substr($row_signatory['mname'],0,1)).". "; } echo strtoupper($row_signatory['lname']); if ($row_signatory['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_signatory['nameext']; } if (empty($row_signatory['suffix'])) {echo ''; } else { echo ', '.$row_signatory['suffix']; }
                                                    ?>
                                                </b></p>
                                                <p style="font-size: 13px;"><?php echo $row_signatory['designation'];?></p>
                                                <p style="font-size: 12px;">Approving Authority</p>
                                                <p style="font-size: 11px;">(Signature over Printed Name)</p>
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>
                                        <div class="container-footer container-fluid">
                                            <img src="images/dswd-footer-logo.png">
                                        </div>
                                    </page>
                                </div><!-- end of coe -->

                                <!-- computation -->
                                <div id="computation" class="tab-pane fade in">
                                    <button onclick="print_view_computation()" class="btn btn-primary bg-darkblue waves-effect" name="print_view_computation" style="position: fixed; top: 145px;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <page size="A4flex" layout="orientation" class="page2">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 style="margin: auto; padding: 10px 0; text-align: center;">COMPUTATION</h4>
                                                <table class="table table-bordered table-striped table-hover dataTable text-left">
                                                    <thead>
                                                        <tr>
                                                            <th style="background-color: #2E5090 !important;">No.</th>
                                                            <th style="background-color: #2E5090 !important;">Description</th>
                                                            <th style="background-color: #2E5090 !important;">Unit Price</th>
                                                            <th style="background-color: #2E5090 !important;">Quantity</th>
                                                            <th style="background-color: #2E5090 !important;">Total Cost/Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border-bottom: solid 5px #ddd;">
                                                        <?php
                                                            $sql_comp = mysqli_query($conn,"SELECT * FROM tbl_computation WHERE cl_qn='".$_SESSION['cl_qn']."' ");
                                                            if ($sql_comp->num_rows > 0) {
                                                                $x = 1;
                                                                while(($row_comp = mysqli_fetch_array($sql_comp)) && ($x <= 20)){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $x; $x++; ?></td>
                                                                        <td>
                                                                            <?php echo $row_comp['description'];?>
                                                                        </td>
                                                                        <td>
                                                                            &#8369;<?php echo number_format($row_comp['uprice'],2);?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row_comp['qty'];?>
                                                                        </td>
                                                                        <td>
                                                                            &#8369;<?php echo number_format($row_comp['tprice'],2);?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <?php
                                                            $sql_comp2 = mysqli_query($conn,"SELECT * FROM tbl_computation2 WHERE cl_qn='".$_SESSION['cl_qn']."' ");
                                                            if ($sql_comp2->num_rows > 0) {
                                                                while($row_comp2 = mysqli_fetch_array($sql_comp2)){
                                                                    ?>
                                                                    <tr>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="border: none !important;"><i>*nothing follows*</i></td>
                                                                        <td style="text-align: right; font-weight: bold; border: none !important;">Sub-Total</td>
                                                                        <td>&#8369;<?php echo number_format($row_comp2['stotal'],2);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="text-align: right; font-weight: bold; border: none !important;">Discount</td>
                                                                        <td>&#8369;<?php echo number_format($row_comp2['dcnt'],2);?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="border: none !important;"></td>
                                                                        <td style="text-align: right; border: none !important; font-size: 15px; font-weight: bold;">Total Amount</td>
                                                                        <td style="font-size: 15px; font-weight: bold;">&#8369;<?php echo number_format($row_comp2['totalamt'],2);?></td>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tfoot>
                                                </table><br><br>
                                                <div class="">
                                                    <div style="width: 80mm; display: inline-block;" class="text-center">
                                                        <p style="font-size: 13px;">PREPARED BY:</p><br><br>
                                                        <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                                                            <?php
                                                              echo strtoupper($row1['fname'])." "; 
                                                              if (empty($row1['mname'])) {
                                                                    echo "";
                                                              } else {
                                                                    echo strtoupper(substr($row1['mname'],0,1)).". ";
                                                              }
                                                              echo strtoupper($row1['lname']);
                                                              if ($row1['nameext'] == "N/A" || $row1['nameext'] == "") {
                                                                    echo "";
                                                              } else {
                                                                    echo ", ".$row1['nameext'];
                                                              }
                                                            ?> 
                                                        </p>
                                                        <p style="font-size: 13px;">Social Worker</p>
                                                        <p style="font-size: 12px;">Licence Number: <?php echo $row1['lic_no']; ?></p>
                                                        <p style="font-size: 11px;">(Signature over Printed Name)</p>
                                                    </div>
                                                    <div style="width: 48mm; display: inline-block;" class=""></div>
                                                    <div style="width: 80mm; display: inline-block;" class="text-center">
                                                        <p style="font-size: 13px;">APPROVED BY:</p><br><br>
                                                        <?php
                                                            $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'SDN SWAD Team Leader' ");
                                                            $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                                                        ?>
                                                        <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                                                            <?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; }
                                                            ?>
                                                        </b></p>
                                                        <p style="font-size: 13px;"><?php echo $row_approv_gis['designation']; ?></p>
                                                        <p style="font-size: 12px;">Approving Authority</p>
                                                        <p style="font-size: 11px;">(Signature over Printed Name)</p>
                                                    </div>
                                                </div>
                                            </div><br>
                                        </div>
                                    </page>
                                </div><!-- end of computation-->

                                <!-- pagpamatuod -->
                                <div id="pagpamatuod" class="tab-pane fade in">
                                    <button onclick="print_view_pagpamatuod()" class="btn btn-primary bg-darkblue waves-effect" name="print_view_pagpamatuod" style="position: fixed; top: 145px;">
                                        Print <span class="fa fa-print"></span>
                                    </button>
                                    <page size="A4flex" layout="orientation" class="page2">
                                        <br><br><h3 style="text-align: center; margin: 0px;">PAGPAMATUOD</h3><br><br>
                                        <p style="font-size: 15px;">
                                            Ako si <span><u><b> <?php echo strtoupper($row['cl_fname'])." "; if (empty($row['cl_mname'])) { echo ""; } else { echo strtoupper(substr($row['cl_mname'],0,1)).". "; } echo strtoupper($row['cl_lname']); if ($row['cl_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['cl_nameext']; }?></b></u></span>, usa ka kliyente sa AICS nga programa, mangayo ug <span><b><u><?php echo $row_tbl_addl_entry['assistance_type'].' ASSISTANCE';?></u></b></span> para sa 
                                            <?php
                                                if ($row['bn_reltoclient'] == 'Self') {
                                                    ?>
                                                        akoang tambal.
                                                    <?php
                                                } else {
                                                    ?>
                                                    tambal sa akoang <span><b><u><?php echo strtoupper($row['bn_reltoclient']); ?></u></b></span> nga si, <span><b><u>
                                                    <?php
                                                    echo strtoupper($row['bn_fname'])." ";
                                                    if (empty($row['bn_mname'])) {
                                                        echo "";
                                                    } else {
                                                        echo strtoupper(substr($row['bn_mname'],0,1)).". ";
                                                    }
                                                    echo strtoupper($row['bn_lname']);
                                                    if ($row['bn_nameext'] == "N/A") {
                                                        echo "";
                                                    } else {
                                                        echo ", ".$row['bn_nameext'];
                                                    }
                                                }
                                            ?>.</u></b></span>
                                        </p><br><br>
                                        <p style="font-size: 15px;">
                                            Kabahin niini, ako mutugot nga:
                                        </p><br>
                                        <div>
                                            <p style="font-size: 15px; width: 109mm; display: inline-block;">
                                                (
                                                    <?php
                                                        if ($row_tbl_addl_entry['canvassed_by']=='Client') {
                                                            ?>&#x2713;<?php
                                                        } else {}
                                                    ?>
                                                 ) Ako ang mag canvass sa tambal sa parmasya nga akong mapili.
                                            </p>
                                            <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                                            </p>
                                        </div><br>
                                        <div>
                                            <p style="font-size: 15px; width: 109mm; display: inline-block;">
                                                (
                                                    <?php
                                                        if ($row_tbl_addl_entry['canvassed_by']=='Social Worker') {
                                                            ?>&#x2713;<?php
                                                        } else {}
                                                    ?>
                                                     ) Ako nagatugot nga ang DSWD Staff nga maoy mag canvass sa parmasya nga akong mapili.
                                            </p>
                                            <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                                            </p>
                                        </div><br><br>
                                        <p style="font-size: 15px;">
                                            Ang maong tambal na akong gikinahanglan makuha sa mga musunod nga parmasya dinhi sa syudad sa Surigao City:
                                        </p><br>
                                        <div>
                                            <?php
                                                $sql_sp = mysqli_query($conn,"SELECT * FROM tbl_sp_caraga WHERE sp_type='Pharmacy' AND sp_pd_address='SDN2' ");
                                                if ($sql_sp->num_rows > 0){
                                                    while($row_sp = mysqli_fetch_assoc($sql_sp)) {
                                                        ?>
                                                            <p style="font-weight: bold; font-size: 15px; width: 109mm; display: inline-block;">
                                                                ( <?php
                                                                if ($row_sp['sp_name'] == $row_tbl_addl_entry['sp']) {
                                                                    ?>&#x2713;<?php
                                                                } else {}
                                                                ?> ) 
                                                                <?php echo $row_sp['sp_name'];?>   
                                                            </p>
                                                            <p style="font-size: 15px; width: 100mm; display: inline-block;"></p>
                                                            <p style="font-size: 15px; width: 104mm; display: inline-block; margin-left: 5mm;"><?php echo $row_sp['sp_address'];?></p>
                                                            <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                                                            </p><br><br>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <p style="font-size: 15px;">
                                            Ako wala naimpluwensya ni bisan kinsa sa pagpili niining parmasya.
                                        </p><br>
                                        <p style="font-size: 15px;">
                                            Daghang Salamat.
                                        </p><br><br><br><br>
                                        <div class="">
                                            <div style="width: 80mm; display: inline-block;" class="text-center">
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
                                                <p style="font-size: 13px;">Pangalan  ug Pirma sa Kliyente</p>
                                            </div>
                                            <div style="width: 48mm; display: inline-block;" class=""></div>
                                            <div style="width: 80mm; display: inline-block;" class="text-center">
                                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                                                    <?php
                                                      echo strtoupper($row1['fname'])." "; 
                                                      if (empty($row1['mname'])) {
                                                            echo "";
                                                      } else {
                                                            echo strtoupper(substr($row1['mname'],0,1)).". ";
                                                      }
                                                      echo strtoupper($row1['lname']);
                                                      if ($row1['nameext'] == "N/A" || $row1['nameext'] == "") {
                                                            echo "";
                                                      } else {
                                                            echo ", ".$row1['nameext'];
                                                      }
                                                    ?> 
                                                </p>
                                                <p style="font-size: 13px;">Pangalan  ug Pirma sa Saksi (SWO)</p>
                                            </div>
                                        </div><br><br>
                                    </page>
                                </div><!-- end of pamatood -->

                                <?php
                                    if (isset($_POST['save_transaction'])) {
                                        $_SESSION['swo_staffid'] = "";
                                        $_SESSION['swo_staffid'] = $row1['staffid'];
                                        header("location: save_transaction.php");
                                    }
                                ?>

                                <!-- save transaction -->
                                <div id="save_transaction" class="tab-pane fade in">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-decoration: underline;">SAVE TRANSACTION BEFORE EXITING</h4>
                                                <button type="submit" name="save_transaction" class="btn btn-success waves-effect" style="display: block;">
                                                    Save <span class="fa fa-save"></span>
                                                </button>
                                                <div class="row clearfix">
                                                    <div class="col-xs-4"> 
                                                        <h4 style="margin: auto; padding: 10px 0; text-align: left;">Transaction Code</h4>
                                                        <input type="text" class="form-control" name="transaction_code" value="<?php echo $row_tbl_addl_entry['gl_code'];?>" readonly>
                                                    </div>
                                                    <div class="col-xs-4"> 
                                                        <h4 style="margin: auto; padding: 10px 0; text-align: left;">Time Started</h4>
                                                        <input type="text" class="form-control" name="time_start" value="<?php echo $row['date_added'];?>" readonly>
                                                    </div>
                                                    <div class="col-xs-4"> 
                                                        <h4 style="margin: auto; padding: 10px 0; text-align: left;">Time Ended</h4>
                                                        <input type="text" class="form-control" name="time_end" value="<?php echo $row_tbl_addl_entry['date_added'];?>" readonly>
                                                    </div>
                                                </div><hr>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <h4 style="color: darkblue; text-decoration: underline;">EDIT/MODIFY ADDITIONAL DATA</h4>
                                                        <h4 style="margin: auto; padding: 10px 0; text-align: left; color: red;">*NOTE: In case there are incorrect entries of data, kindly edit/modify them here.</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-align: left;">I: Additional Data Entry</h4>
                                                        <?php
                                                            if (isset($_POST['edit_addl_entry'])) {
                                                                $_SESSION['other_attachments'] = $chk_other_attachments = "";
                                                                $_SESSION['other_attachments2'] = $chk_other_attachments2 = "";
                                                                $_SESSION['material_assistance'] = $chk_material_assistance = "";  
                                                                $_SESSION['psycho_support'] = $chk_psycho_support = "";

                                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                    $_SESSION['cl_qn'] = mysqli_real_escape_string($conn, $_POST['cl_qn']);
                                                                    $_SESSION['release_mode'] = mysqli_real_escape_string($conn, $_POST['release_mode']);
                                                                    $_SESSION['admission_mode'] = mysqli_real_escape_string($conn, $_POST['admission_mode']);
                                                                    $_SESSION['purpose'] = mysqli_real_escape_string($conn, $_POST['purpose']);
                                                                    $_SESSION['canvassed_by'] = mysqli_real_escape_string($conn, $_POST['canvassed_by']);
                                                                    $_SESSION['sp'] = mysqli_real_escape_string($conn, $_POST['sp']);
                                                                    $_SESSION['sp_address'] = mysqli_real_escape_string($conn, $_POST['sp_address']);
                                                                    $_SESSION['amount_in_figures'] = mysqli_real_escape_string($conn, $_POST['amount_in_figures']);
                                                                    $_SESSION['amount_in_words'] = mysqli_real_escape_string($conn, $_POST['amount_in_words']);
                                                                    $_SESSION['fund_source'] = mysqli_real_escape_string($conn, $_POST['fund_source']);
                                                                    $_SESSION['cl_id'] = mysqli_real_escape_string($conn, $_POST['cl_id']);
                                                                    $_SESSION['cl_id_others'] = mysqli_real_escape_string($conn, $_POST['cl_id_others']);
                                                                    $_SESSION['bn_id'] = mysqli_real_escape_string($conn, $_POST['bn_id']);
                                                                    $_SESSION['bn_id_others'] = mysqli_real_escape_string($conn, $_POST['bn_id_others']);

                                                                    //OTHER ATTACHMENTS
                                                                    $other_attachments = $_POST['other_attachments'];
                                                                    foreach($other_attachments as $chk1_other_attachments) {  
                                                                        $chk_other_attachments .= $chk1_other_attachments.',';
                                                                   }
                                                                    //echo $chk_other_attachments; 
                                                                    $_SESSION['other_attachments'] = $chk_other_attachments;
                                                                    //echo $_SESSION['other_attachments'];

                                                                    //OTHER ATTACHMENTS2
                                                                    $other_attachments2 = $_POST['other_attachments2'];
                                                                    foreach($other_attachments2 as $chk1_other_attachments2) {  
                                                                        $chk_other_attachments2 .= $chk1_other_attachments2.',';
                                                                   }
                                                                    //echo $chk_other_attachments; 
                                                                    $_SESSION['other_attachments2'] = $chk_other_attachments2;
                                                                    //echo $_SESSION['other_attachments'];

                                                                    //OTHER ADD'L. ATTACHMENTS
                                                                    $_SESSION['other_addl_attachments'] = mysqli_real_escape_string($conn, $_POST['other_addl_attachments']);

                                                                    //MATERIAL ASSISTANCE
                                                                    $material_assistance = $_POST['material_assistance'];
                                                                    foreach($material_assistance as $chk1_material_assistance) {  
                                                                        $chk_material_assistance .= $chk1_material_assistance.',';
                                                                    }
                                                                    //echo $chk_material_assistance; 
                                                                    $_SESSION['material_assistance'] = $chk_material_assistance;
                                                                    //echo $_SESSION['material_assistance'];

                                                                    //PSYCHOSOCIAL SUPPORT
                                                                    $psycho_support = $_POST['psycho_support'];
                                                                    foreach($psycho_support as $chk1_psycho_support) {  
                                                                        $chk_psycho_support .= $chk1_psycho_support.',';
                                                                    }
                                                                    //echo $chk_psycho_support; 
                                                                    $_SESSION['psycho_support'] = $chk_psycho_support;
                                                                    //echo $_SESSION['psycho_support'];

                                                                    $_SESSION['referral'] = mysqli_real_escape_string($conn, $_POST['referral']);
                                                                    $_SESSION['diagnosis'] = mysqli_real_escape_string($conn, $_POST['diagnosis']);
                                                                    $_SESSION['assessment'] = mysqli_real_escape_string($conn, $_POST['assessment']);
                                                                    $_SESSION['swo_staffid'] = mysqli_real_escape_string($conn, $_POST['swo_staffid']);
                                                                    $_SESSION['gl_code'] = mysqli_real_escape_string($conn, $_POST['gl_code']);


                                                                    $_SESSION['stotal'] = mysqli_real_escape_string($conn, $_POST['stotal']);
                                                                    $_SESSION['dcnt'] = mysqli_real_escape_string($conn, $_POST['dcnt']);
                                                                    $_SESSION['totalamt'] = mysqli_real_escape_string($conn, $_POST['totalamt']);

                                                                    
                                                                    $_SESSION['id1'] = mysqli_real_escape_string($conn, $_POST['id1']);
                                                                    $_SESSION['desc1'] = mysqli_real_escape_string($conn, $_POST['desc1']);
                                                                    $_SESSION['uprice1'] = mysqli_real_escape_string($conn, $_POST['uprice1']);
                                                                    $_SESSION['qty1'] = mysqli_real_escape_string($conn, $_POST['qty1']);
                                                                    $_SESSION['tprice1'] = mysqli_real_escape_string($conn, $_POST['tprice1']);

                                                                    $_SESSION['id2'] = mysqli_real_escape_string($conn, $_POST['id2']);
                                                                    $_SESSION['desc2'] = mysqli_real_escape_string($conn, $_POST['desc2']);
                                                                    $_SESSION['uprice2'] = mysqli_real_escape_string($conn, $_POST['uprice2']);
                                                                    $_SESSION['qty2'] = mysqli_real_escape_string($conn, $_POST['qty2']);
                                                                    $_SESSION['tprice2'] = mysqli_real_escape_string($conn, $_POST['tprice2']);

                                                                    $_SESSION['id3'] = mysqli_real_escape_string($conn, $_POST['id3']);
                                                                    $_SESSION['desc3'] = mysqli_real_escape_string($conn, $_POST['desc3']);
                                                                    $_SESSION['uprice3'] = mysqli_real_escape_string($conn, $_POST['uprice3']);
                                                                    $_SESSION['qty3'] = mysqli_real_escape_string($conn, $_POST['qty3']);
                                                                    $_SESSION['tprice3'] = mysqli_real_escape_string($conn, $_POST['tprice3']);

                                                                    $_SESSION['id4'] = mysqli_real_escape_string($conn, $_POST['id4']);
                                                                    $_SESSION['desc4'] = mysqli_real_escape_string($conn, $_POST['desc4']);
                                                                    $_SESSION['uprice4'] = mysqli_real_escape_string($conn, $_POST['uprice4']);
                                                                    $_SESSION['qty4'] = mysqli_real_escape_string($conn, $_POST['qty4']);
                                                                    $_SESSION['tprice4'] = mysqli_real_escape_string($conn, $_POST['tprice4']);
                                                                    
                                                                    $_SESSION['id5'] = mysqli_real_escape_string($conn, $_POST['id5']);
                                                                    $_SESSION['desc5'] = mysqli_real_escape_string($conn, $_POST['desc5']);
                                                                    $_SESSION['uprice5'] = mysqli_real_escape_string($conn, $_POST['uprice5']);
                                                                    $_SESSION['qty5'] = mysqli_real_escape_string($conn, $_POST['qty5']);
                                                                    $_SESSION['tprice5'] = mysqli_real_escape_string($conn, $_POST['tprice5']);
                                                                    
                                                                    $_SESSION['id6'] = mysqli_real_escape_string($conn, $_POST['id6']);
                                                                    $_SESSION['desc6'] = mysqli_real_escape_string($conn, $_POST['desc6']);
                                                                    $_SESSION['uprice6'] = mysqli_real_escape_string($conn, $_POST['uprice6']);
                                                                    $_SESSION['qty6'] = mysqli_real_escape_string($conn, $_POST['qty6']);
                                                                    $_SESSION['tprice6'] = mysqli_real_escape_string($conn, $_POST['tprice6']);
                                                                    
                                                                    $_SESSION['id7'] = mysqli_real_escape_string($conn, $_POST['id7']);
                                                                    $_SESSION['desc7'] = mysqli_real_escape_string($conn, $_POST['desc7']);
                                                                    $_SESSION['uprice7'] = mysqli_real_escape_string($conn, $_POST['uprice7']);
                                                                    $_SESSION['qty7'] = mysqli_real_escape_string($conn, $_POST['qty7']);
                                                                    $_SESSION['tprice7'] = mysqli_real_escape_string($conn, $_POST['tprice7']);
                                                                    
                                                                    $_SESSION['id8'] = mysqli_real_escape_string($conn, $_POST['id8']);
                                                                    $_SESSION['desc8'] = mysqli_real_escape_string($conn, $_POST['desc8']);
                                                                    $_SESSION['uprice8'] = mysqli_real_escape_string($conn, $_POST['uprice8']);
                                                                    $_SESSION['qty8'] = mysqli_real_escape_string($conn, $_POST['qty8']);
                                                                    $_SESSION['tprice8'] = mysqli_real_escape_string($conn, $_POST['tprice8']);
                                                                    
                                                                    $_SESSION['id9'] = mysqli_real_escape_string($conn, $_POST['id9']);
                                                                    $_SESSION['desc9'] = mysqli_real_escape_string($conn, $_POST['desc9']);
                                                                    $_SESSION['uprice9'] = mysqli_real_escape_string($conn, $_POST['uprice9']);
                                                                    $_SESSION['qty9'] = mysqli_real_escape_string($conn, $_POST['qty9']);
                                                                    $_SESSION['tprice9'] = mysqli_real_escape_string($conn, $_POST['tprice9']);
                                                                    
                                                                    $_SESSION['id10'] = mysqli_real_escape_string($conn, $_POST['id10']);
                                                                    $_SESSION['desc10'] = mysqli_real_escape_string($conn, $_POST['desc10']);
                                                                    $_SESSION['uprice10'] = mysqli_real_escape_string($conn, $_POST['uprice10']);
                                                                    $_SESSION['qty10'] = mysqli_real_escape_string($conn, $_POST['qty10']);
                                                                    $_SESSION['tprice10'] = mysqli_real_escape_string($conn, $_POST['tprice10']);
                                                                    
                                                                    $_SESSION['id11'] = mysqli_real_escape_string($conn, $_POST['id11']);
                                                                    $_SESSION['desc11'] = mysqli_real_escape_string($conn, $_POST['desc11']);
                                                                    $_SESSION['uprice11'] = mysqli_real_escape_string($conn, $_POST['uprice11']);
                                                                    $_SESSION['qty11'] = mysqli_real_escape_string($conn, $_POST['qty11']);
                                                                    $_SESSION['tprice11'] = mysqli_real_escape_string($conn, $_POST['tprice11']);
                                                                    
                                                                    $_SESSION['id12'] = mysqli_real_escape_string($conn, $_POST['id12']);
                                                                    $_SESSION['desc12'] = mysqli_real_escape_string($conn, $_POST['desc12']);
                                                                    $_SESSION['uprice12'] = mysqli_real_escape_string($conn, $_POST['uprice12']);
                                                                    $_SESSION['qty12'] = mysqli_real_escape_string($conn, $_POST['qty12']);
                                                                    $_SESSION['tprice12'] = mysqli_real_escape_string($conn, $_POST['tprice12']);
                                                                    
                                                                    $_SESSION['id13'] = mysqli_real_escape_string($conn, $_POST['id13']);
                                                                    $_SESSION['desc13'] = mysqli_real_escape_string($conn, $_POST['desc13']);
                                                                    $_SESSION['uprice13'] = mysqli_real_escape_string($conn, $_POST['uprice13']);
                                                                    $_SESSION['qty13'] = mysqli_real_escape_string($conn, $_POST['qty13']);
                                                                    $_SESSION['tprice13'] = mysqli_real_escape_string($conn, $_POST['tprice13']);
                                                                    
                                                                    $_SESSION['id14'] = mysqli_real_escape_string($conn, $_POST['id14']);
                                                                    $_SESSION['desc14'] = mysqli_real_escape_string($conn, $_POST['desc14']);
                                                                    $_SESSION['uprice14'] = mysqli_real_escape_string($conn, $_POST['uprice14']);
                                                                    $_SESSION['qty14'] = mysqli_real_escape_string($conn, $_POST['qty14']);
                                                                    $_SESSION['tprice14'] = mysqli_real_escape_string($conn, $_POST['tprice14']);
                                                                    
                                                                    $_SESSION['id15'] = mysqli_real_escape_string($conn, $_POST['id15']);
                                                                    $_SESSION['desc15'] = mysqli_real_escape_string($conn, $_POST['desc15']);
                                                                    $_SESSION['uprice15'] = mysqli_real_escape_string($conn, $_POST['uprice15']);
                                                                    $_SESSION['qty15'] = mysqli_real_escape_string($conn, $_POST['qty15']);
                                                                    $_SESSION['tprice15'] = mysqli_real_escape_string($conn, $_POST['tprice15']);
                                                                    
                                                                    $_SESSION['id16'] = mysqli_real_escape_string($conn, $_POST['id16']);
                                                                    $_SESSION['desc16'] = mysqli_real_escape_string($conn, $_POST['desc16']);
                                                                    $_SESSION['uprice16'] = mysqli_real_escape_string($conn, $_POST['uprice16']);
                                                                    $_SESSION['qty16'] = mysqli_real_escape_string($conn, $_POST['qty16']);
                                                                    $_SESSION['tprice16'] = mysqli_real_escape_string($conn, $_POST['tprice16']);
                                                                    
                                                                    $_SESSION['id17'] = mysqli_real_escape_string($conn, $_POST['id17']);
                                                                    $_SESSION['desc17'] = mysqli_real_escape_string($conn, $_POST['desc17']);
                                                                    $_SESSION['uprice17'] = mysqli_real_escape_string($conn, $_POST['uprice17']);
                                                                    $_SESSION['qty17'] = mysqli_real_escape_string($conn, $_POST['qty17']);
                                                                    $_SESSION['tprice17'] = mysqli_real_escape_string($conn, $_POST['tprice17']);
                                                                    
                                                                    $_SESSION['id18'] = mysqli_real_escape_string($conn, $_POST['id18']);
                                                                    $_SESSION['desc18'] = mysqli_real_escape_string($conn, $_POST['desc18']);
                                                                    $_SESSION['uprice18'] = mysqli_real_escape_string($conn, $_POST['uprice18']);
                                                                    $_SESSION['qty18'] = mysqli_real_escape_string($conn, $_POST['qty18']);
                                                                    $_SESSION['tprice18'] = mysqli_real_escape_string($conn, $_POST['tprice18']);
                                                                    
                                                                    $_SESSION['id19'] = mysqli_real_escape_string($conn, $_POST['id19']);
                                                                    $_SESSION['desc19'] = mysqli_real_escape_string($conn, $_POST['desc19']);
                                                                    $_SESSION['uprice19'] = mysqli_real_escape_string($conn, $_POST['uprice19']);
                                                                    $_SESSION['qty19'] = mysqli_real_escape_string($conn, $_POST['qty19']);
                                                                    $_SESSION['tprice19'] = mysqli_real_escape_string($conn, $_POST['tprice19']);
                                                                    
                                                                    $_SESSION['id20'] = mysqli_real_escape_string($conn, $_POST['id20']);
                                                                    $_SESSION['desc20'] = mysqli_real_escape_string($conn, $_POST['desc20']);
                                                                    $_SESSION['uprice20'] = mysqli_real_escape_string($conn, $_POST['uprice20']);
                                                                    $_SESSION['qty20'] = mysqli_real_escape_string($conn, $_POST['qty20']);
                                                                    $_SESSION['tprice20'] = mysqli_real_escape_string($conn, $_POST['tprice20']);
                                                                    header("location: edit_addl_entry.php");
                                                                }
                                                            }
                                                        ?>
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-xs-5">
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <input type="text" name="cl_qn" value="<?php echo $_SESSION['cl_qn'];?>" style="display: none;">
                                                                                <label><i><b>Note:</b> (<span style="color: red;">*</span>) sign denotes a required field!</i></label><br>
                                                                                <!--<label>SESSION CLIENT ID: <?php echo $_SESSION['cl_qn3'];?></label><br>-->
                                                                                <label>1) Mode of Release:</label>
                                                                                <div class="form-line">
                                                                                    <select class="form-control" id="release_mode" name="release_mode">
                                                                                        <option><?php echo $row_tbl_addl_entry['release_mode'];?></option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <label>2) Mode of Admission: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                <div class="form-line">
                                                                                    <select class="form-control" id="admission_mode" name="admission_mode">
                                                                                        <option><?php echo $row_tbl_addl_entry['admission_mode'];?></option>
                                                                                        <option>Walk-in</option>
                                                                                        <option>Referral</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <label>3) Financial Assistance to be Given & Purpose: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                <div class="form-line">
                                                                                    <select class="form-control" id="purpose" name="purpose">
                                                                                        <option value="<?php echo $row_tbl_addl_entry['purpose'];?>">
                                                                                            <?php echo $row_tbl_addl_entry['assistance_type']." - ".$row_tbl_addl_entry['purpose'];?>
                                                                                        </option>
                                                                                        <?php
                                                                                            $sql_assistance = mysqli_query($conn, "SELECT * FROM tbl_assistance");
                                                                                            if ($sql_assistance->num_rows > 0) {
                                                                                                while($row_assistance = mysqli_fetch_array($sql_assistance)){
                                                                                                    $assistance_type = $row_assistance['assistance_type'];
                                                                                                    $assistance_purpose = $row_assistance['assistance_purpose'];
                                                                                                    if (($assistance_type == 'BURIAL') || ($assistance_type == 'MEDICAL')) {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $assistance_purpose; ?>"><?php echo $assistance_type.' - '.$assistance_purpose; ?></option>
                                                                                                        <?php
                                                                                                    } else {

                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix" id="div_canvassby">
                                                                        <div style="width: 5%; display: inline-block;"></div>
                                                                        <div style="width: 93%; display: inline-block;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <label>Medicines Canvassed by: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                <div class="form-line">
                                                                                    <select class="form-control" id="canvassed_by" name="canvassed_by" value="<?php echo $row_tbl_addl_entry['canvassed_by'];?>">
                                                                                        <option><?php echo $row_tbl_addl_entry['canvassed_by'];?></option>
                                                                                        <option>N/A</option>
                                                                                        <option>Client</option>
                                                                                        <option>Social Worker</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <label>4) Service Provider: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                <div class="form-line">
                                                                                    <input type="text" class="form-control" name="sp" id="sp" value="<?php echo $row_tbl_addl_entry['sp'];?>" required autofocus>
                                                                                    <input type="text" class="form-control" name="sp_address" id="sp_address" value="<?php echo $row_tbl_addl_entry['sp_address'];?>" required autofocus>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>5) Amount in Figures: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                    <input type="number" step="any" class="form-control" id="amt_figure" name="amount_in_figures" value="<?php echo $row_tbl_addl_entry['amount_in_figures'];?>" required autofocus>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>6) Amount in Words: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                    <input style="font-size: 12px !important;" type="text" class="form-control" id="amt_word" name="amount_in_words" value="<?php echo $row_tbl_addl_entry['amount_in_words'];?>" required autofocus>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>7) Fund Source: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                    <input type="text" class="form-control" name="fund_source" value="<?php echo $row_tbl_addl_entry['fund_source'];?>" required autofocus>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>8) Client Valid ID Presented: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                        <select class="form-control" id="cl_id" name="cl_id">
                                                                                        <option><?php echo $row_tbl_addl_entry['cl_id'];?></option>
                                                                                            <option>DSWD 4Ps ID</option>
                                                                                            <option>DSWD Cares Card</option>
                                                                                            <option>OSCA ID</option>
                                                                                            <option>PWD ID</option>
                                                                                            <option>Solo Parent ID</option>
                                                                                            <option>Voter's ID</option>
                                                                                            <option>Voter's Cert.</option>
                                                                                            <option>PhilSys ID</option>
                                                                                            <option>UMID ID</option>
                                                                                            <option>SSS ID</option>
                                                                                            <option>TIN ID</option>
                                                                                            <option>PhilHealth ID</option>
                                                                                            <option>Pag-ibig Loyalty Card</option>
                                                                                            <option>Passport</option>
                                                                                            <option>PRC ID/License</option>
                                                                                            <option>Driver's License</option>
                                                                                            <option>Firearms License</option>
                                                                                            <option>Postal ID</option>
                                                                                            <option>Brgy. ID</option>
                                                                                            <option>Brgy. Cert. w/ Pic.</option>
                                                                                            <option>Birth Cert. w/ Pic.</option>
                                                                                            <option>School ID</option>
                                                                                            <option>Gov't. Employee ID</option>
                                                                                            <option>Company Employee ID</option>
                                                                                            <option>NBI Clearance</option>
                                                                                            <option>Police Clearance</option>
                                                                                            <option>IBP ID (Lawyers)</option>
                                                                                            <option>Pic. w/ Signature</option>
                                                                                            <option>Others</option>
                                                                                        </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix" id="div_cl_id_others">
                                                                        <div style="width: 5%; display: inline-block;"></div>
                                                                        <div style="width: 93%; display: inline-block;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <input class="form-control" name="cl_id_others" type="text" placeholder="If Others: Please Specify Here">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>9) Beneficiary Valid ID Presented: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                    <select class="form-control" id="bn_id" name="bn_id">
                                                                                        <option><?php echo $row_tbl_addl_entry['bn_id'];?></option>
                                                                                        <option>N/A</option>
                                                                                        <option>DSWD 4Ps ID</option>
                                                                                        <option>DSWD Cares Card</option>
                                                                                        <option>OSCA ID</option>
                                                                                        <option>PWD ID</option>
                                                                                        <option>Solo Parent ID</option>
                                                                                        <option>Voter's ID</option>
                                                                                        <option>Voter's Cert.</option>
                                                                                        <option>PhilSys ID</option>
                                                                                        <option>UMID ID</option>
                                                                                        <option>SSS ID</option>
                                                                                        <option>TIN ID</option>
                                                                                        <option>PhilHealth ID</option>
                                                                                        <option>Pag-ibig Loyalty Card</option>
                                                                                        <option>Passport</option>
                                                                                        <option>PRC ID/License</option>
                                                                                        <option>Driver's License</option>
                                                                                        <option>Firearms License</option>
                                                                                        <option>Postal ID</option>
                                                                                        <option>Brgy. ID</option>
                                                                                        <option>Brgy. Cert. w/ Pic.</option>
                                                                                        <option>Birth Cert. w/ Pic.</option>
                                                                                        <option>School ID</option>
                                                                                        <option>Gov't. Employee ID</option>
                                                                                        <option>Company Employee ID</option>
                                                                                        <option>NBI Clearance</option>
                                                                                        <option>Police Clearance</option>
                                                                                        <option>IBP ID (Lawyers)</option>
                                                                                        <option>Pic. w/ Signature</option>
                                                                                        <option>Others</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix" id="div_bn_id_others">
                                                                        <div style="width: 5%; display: inline-block;"></div>
                                                                        <div style="width: 93%; display: inline-block;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <input class="form-control" name="bn_id_others" type="text" placeholder="If Others: Please Specify Here">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <label>10) Attachments: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                <div class="row">
                                                                                    <div style="width: 100%;">
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments1" name="other_attachments[]" value="Justification">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Justification'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments1").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Justification
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments2" name="other_attachments[]" value="Medical Certificate/Abstract">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Medical Certificate/Abstract'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments2").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Medical Certificate/Abstract
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments3" name="other_attachments[]" value="Prescriptions">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Prescriptions'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments3").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Prescriptions
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments4" name="other_attachments[]" value="Statement of Account">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Statement of Account'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments4").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Statement of Account
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments5" name="other_attachments[]" value="Treatment Protocol">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Treatment Protocol'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments5").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Treatment Protocol
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments6" name="other_attachments[]" value="Quotation">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Quotation'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments6").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Quotation
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments7" name="other_attachments[]" value="Discharge Summary">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Discharge Summary'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments7").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Discharge Summary
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments8" name="other_attachments[]" value="Laboratory Request">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Laboratory Request'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments8").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Laboratory Request
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments9" name="other_attachments[]" value="Charge Slip">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Charge Slip'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments9").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Charge Slip
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments10" name="other_attachments[]" value="Funeral Contract">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Funeral Contract'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments10").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Funeral Contract
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments11" name="other_attachments[]" value="Death Certificate">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Death Certificate'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments11").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Death Certificate
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments12" name="other_attachments[]" value="Death Summary">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Death Summary'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments12").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Death Summary
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments13" name="other_attachments[]" value="Referral Letter">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Referral Letter'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments13").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Referral Letter
                                                                                        </label>
                                                                                        <label class="checkbox">
                                                                                          <input type="checkbox" id="other_attachments14" name="other_attachments[]" value="Social Case Study Report">
                                                                                            <?php
                                                                                                $count = count($attachments_arrval)-1;
                                                                                                //Loop through each array index
                                                                                                for($i = 0; $i <= $count; $i++) {
                                                                                                    //Assign the value of the array key to a variable
                                                                                                    $value = $attachments_arrval[$i];
                                                                                                    //Check if result string contains diam-mm
                                                                                                    if ($value == 'Social Case Study Report'){
                                                                                                        ?>
                                                                                                            <script>
                                                                                                                document.getElementById("other_attachments14").checked = true;
                                                                                                            </script>
                                                                                                        <?php
                                                                                                        break;
                                                                                                    } else {}
                                                                                                }
                                                                                            ?>
                                                                                          Social Case Study Report
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div style="width: 5%; display: inline-block;"></div>
                                                                                    <div style="width: 93%; display: inline-block;">
                                                                                        <div class="form-group form-float">
                                                                                            <div class="form-line">
                                                                                                <label>Additional Attachments: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                                <div style="width: 100%;">
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_1" name="other_attachments2[]" value="Promissory Note">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Promissory Note'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_1").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                      Promissory Note
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_2" name="other_attachments2[]" value="Pamatood">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Pamatood'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_2").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                        Pamatood
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_3" name="other_attachments2[]" value="Authorization Letter">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Authorization Letter'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_3").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                      Authorization Letter
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_4" name="other_attachments2[]" value="Hospital Room Cert.">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Hospital Room Cert.'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_4").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                      Hospital Room Cert.
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_5" name="other_attachments2[]" value="Cert. of PhilHealth Non-Availment">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Cert. of PhilHealth Non-Availment'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_5").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                        Cert. of PhilHealth Non-Availment
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_6" name="other_attachments2[]" value="Cert. of Indigency">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Cert. of Indigency'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_6").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                        Cert. of Indigency
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_7" name="other_attachments2[]" value="Cert. of Oneness">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'ert. of Oneness'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_7").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                        Cert. of Oneness
                                                                                                    </label>
                                                                                                    <label class="checkbox">
                                                                                                      <input type="checkbox" id="other_attachments2_8" name="other_attachments2[]" value="Cert. of Marriage">
                                                                                                        <?php
                                                                                                            $count = count($attachments2_arrval)-1;
                                                                                                            //Loop through each array index
                                                                                                            for($i = 0; $i <= $count; $i++) {
                                                                                                                $value = $attachments2_arrval[$i];
                                                                                                                //Check if result string contains diam-mm
                                                                                                                if ($value == 'Cert. of Marriage'){
                                                                                                                    ?>
                                                                                                                        <script>
                                                                                                                            document.getElementById("other_attachments2_8").checked = true;
                                                                                                                        </script>
                                                                                                                    <?php
                                                                                                                    break;
                                                                                                                } else {}
                                                                                                            }
                                                                                                        ?>
                                                                                                        Cert. of Marriage
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div style="width: 100%;">
                                                                                                    <label>If Necessary:</label>
                                                                                                    <div class="form-line">
                                                                                                        <input class="form-control" type="text" name="other_addl_attachments" placeholder="Type other attachments here..." value="<?php echo $row_tbl_addl_entry['other_addl_attachments'];?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>11) Material Assistance to be Given (if applicable):</label>
                                                                                    <div class="row">
                                                                                        <div style="width: 49%; display: inline-block;">
                                                                                            <label class="checkbox">
                                                                                              <input type="checkbox" id="m_assistance1" name="material_assistance[]" value="Family Food Packs">
                                                                                                <?php
                                                                                                    $count = count($material_assistance_arrval)-1;
                                                                                                    //Loop through each array index
                                                                                                    for($i = 0; $i <= $count; $i++) {
                                                                                                        //Assign the value of the array key to a variable
                                                                                                        $value = $material_assistance_arrval[$i];
                                                                                                        //Check if result string contains diam-mm
                                                                                                        if ($value == 'Family Food Packs'){
                                                                                                            ?>
                                                                                                                <script>
                                                                                                                    document.getElementById("m_assistance1").checked = true;
                                                                                                                </script>
                                                                                                            <?php
                                                                                                            break;
                                                                                                        } else {}
                                                                                                    }
                                                                                                ?>
                                                                                              Family Food Packs
                                                                                            </label>
                                                                                            <label class="checkbox">
                                                                                              <input type="checkbox" id="m_assistance2" name="material_assistance[]" value="Other Food Items">
                                                                                                <?php
                                                                                                    $count = count($material_assistance_arrval)-1;
                                                                                                    //Loop through each array index
                                                                                                    for($i = 0; $i <= $count; $i++) {
                                                                                                        //Assign the value of the array key to a variable
                                                                                                        $value = $material_assistance_arrval[$i];
                                                                                                        //Check if result string contains diam-mm
                                                                                                        if ($value == 'Other Food Items'){
                                                                                                            ?>
                                                                                                                <script>
                                                                                                                    document.getElementById("m_assistance2").checked = true;
                                                                                                                </script>
                                                                                                            <?php
                                                                                                            break;
                                                                                                        } else {}
                                                                                                    }
                                                                                                ?>
                                                                                                Other Food Items
                                                                                            </label>
                                                                                        </div>
                                                                                        <div style="width: 49%; display: inline-block;">
                                                                                            <label class="checkbox">
                                                                                              <input type="checkbox" id="m_assistance3" name="material_assistance[]" value="Hygiene & Sleeping Kits">
                                                                                                <?php
                                                                                                    $count = count($material_assistance_arrval)-1;
                                                                                                    //Loop through each array index
                                                                                                    for($i = 0; $i <= $count; $i++) {
                                                                                                        //Assign the value of the array key to a variable
                                                                                                        $value = $material_assistance_arrval[$i];
                                                                                                        //Check if result string contains diam-mm
                                                                                                        if ($value == 'Hygiene & Sleeping Kits'){
                                                                                                            ?>
                                                                                                                <script>
                                                                                                                    document.getElementById("m_assistance3").checked = true;
                                                                                                                </script>
                                                                                                            <?php
                                                                                                            break;
                                                                                                        } else {}
                                                                                                    }
                                                                                                ?>
                                                                                                Hygiene & Sleeping Kits
                                                                                            </label>
                                                                                            <label class="checkbox">
                                                                                              <input type="checkbox" id="m_assistance4" name="material_assistance[]" value="Assistive Device & Technologies">
                                                                                                <?php
                                                                                                    $count = count($material_assistance_arrval)-1;
                                                                                                    //Loop through each array index
                                                                                                    for($i = 0; $i <= $count; $i++) {
                                                                                                        //Assign the value of the array key to a variable
                                                                                                        $value = $material_assistance_arrval[$i];
                                                                                                        //Check if result string contains diam-mm
                                                                                                        if ($value == 'Assistive Device & Technologies'){
                                                                                                            ?>
                                                                                                                <script>
                                                                                                                    document.getElementById("m_assistance4").checked = true;
                                                                                                                </script>
                                                                                                            <?php
                                                                                                            break;
                                                                                                        } else {}
                                                                                                    }
                                                                                                ?>
                                                                                                Assistive Device & Technologies
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>12) Psychosocial Support to be Given (if applicable):</label>
                                                                                    <div class="row">
                                                                                        <div style="width: 100%;">
                                                                                            <label class="checkbox">
                                                                                              <input type="checkbox" id="psy_sup1" name="psycho_support[]" value="Psychological First Aid (PAF)">
                                                                                                <?php
                                                                                                    $count = count($psycho_support_arrval)-1;
                                                                                                    //Loop through each array index
                                                                                                    for($i = 0; $i <= $count; $i++) {
                                                                                                        //Assign the value of the array key to a variable
                                                                                                        $value = $psycho_support_arrval[$i];
                                                                                                        //Check if result string contains diam-mm
                                                                                                        if ($value == 'Psychological First Aid (PAF)'){
                                                                                                            ?>
                                                                                                                <script>
                                                                                                                    document.getElementById("psy_sup1").checked = true;
                                                                                                                </script>
                                                                                                            <?php
                                                                                                            break;
                                                                                                        } else {}
                                                                                                    }
                                                                                                ?>
                                                                                                Psychological First Aid (PAF)
                                                                                            </label>
                                                                                        </div>
                                                                                        <div style="width: 100%;">
                                                                                            <label class="checkbox">
                                                                                              <input type="checkbox" id="psy_sup2" name="psycho_support[]" value="Social Work Counseling">
                                                                                                <?php
                                                                                                    $count = count($psycho_support_arrval)-1;
                                                                                                    //Loop through each array index
                                                                                                    for($i = 0; $i <= $count; $i++) {
                                                                                                        //Assign the value of the array key to a variable
                                                                                                        $value = $psycho_support_arrval[$i];
                                                                                                        //Check if result string contains diam-mm
                                                                                                        if ($value == 'Social Work Counseling'){
                                                                                                            ?>
                                                                                                                <script>
                                                                                                                    document.getElementById("psy_sup2").checked = true;
                                                                                                                </script>
                                                                                                            <?php
                                                                                                            break;
                                                                                                        } else {}
                                                                                                    }
                                                                                                ?>
                                                                                                Social Work Counseling
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>13) Referral (if applicable):</label>
                                                                                    <textarea class="form-control" rows="5" id="referral" name="referral" style="border: solid black 1px;"><?php echo $row_tbl_addl_entry['referral'];?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>14) Diagnosis: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                    <textarea class="form-control" rows="5" id="diagnosis" name="diagnosis" style="border: solid black 1px;" required autofocus><?php echo $row_tbl_addl_entry['diagnosis'];?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                    <label>15) Assessment: <span style="color: red; font-size: 1.5em;">*</span></label>
                                                                                    <textarea class="form-control" rows="10" id="assessment" name="assessment" style="border: solid black 1px;" required autofocus><?php echo $row_tbl_addl_entry['assessment'];?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <div class="form-group form-float" style="text-align: left;">
                                                                                <div class="form-line">
                                                                                <label>16) GL Code: <span style="color: red; font-size: 1.5em;">*</span></label><br>
                                                                                <?php
                                                                                    $last_glcode = "";
                                                                                    $sql_lastglcode = mysqli_query($conn,"SELECT * FROM tbl_save_addl_entry WHERE swo_staffid='$swo_staffid' AND release_mode='Guarantee Letter' ORDER BY id_tbl_save_addl_entry DESC LIMIT 1");
                                                                                    if ($sql_lastglcode->num_rows > 0){       
                                                                                        while($row_lastglcode = mysqli_fetch_assoc($sql_lastglcode)) {
                                                                                            $last_glcode = $row_lastglcode['transaction_code'];
                                                                                            ?>
                                                                                                <label>Previous GL Code: <?php echo $last_glcode; ?></label>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <br>
                                                                                <label>Current GL Code Prefix: <?php echo $gl_code_prefix; ?></label>
                                                                                    <input type="text" class="form-control" name="gl_code" value="<?php echo $row_tbl_addl_entry['gl_code'];?>" required autofocus>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix">
                                                                        <div style="width: 100%;">
                                                                            <button type="submit" name="edit_addl_entry" class="btn btn-primary waves-effect" style="display: block; margin: auto;"><span class="fa fa-save"> Save Changes</span></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-7">
                                                                    <label>Search SP Name & click on its row.</label><br>
                                                                    <label>NOTE: Selected data will then appear in #4 Service Provider.</label>
                                                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em; max-height: 300px;">
                                                                        <table class="table table-bordered table-striped table-hover sp dataTable text-left">
                                                                            <thead class="bg-darkblue" style="color: white;">
                                                                                <tr>
                                                                                    <th>ID</th>
                                                                                    <th>SP Name</th>
                                                                                    <th>SP Type</th>
                                                                                    <th>SP Address</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php
                                                                                $sp_sql = mysqli_query($conn, "SELECT * FROM tbl_sp_caraga");
                                                                                if ($sp_sql->num_rows > 0){
                                                                                    while($sp_row = mysqli_fetch_assoc($sp_sql)) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td><?php echo $sp_row['id']; ?></td>
                                                                                            <td><?php echo $sp_row['sp_name']; ?></td>
                                                                                            <td><?php echo $sp_row['sp_type']; ?></td>
                                                                                            <td><?php echo $sp_row['sp_address'].' ('.$sp_row['sp_pd_address'].')'; ?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }
                                                                                } else {

                                                                                }
                                                                            ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div><hr>
                                                                    <label>Computation (Except for Hospital & Funeral Bills)</label><br>
                                                                    <label>NOTE #1: Generated data will then appear in #5) Amount in Figures and #6) Amount in Words.</label><br>
                                                                    <label>NOTE #2: You can only edit values and can't add new row/s.</label>
                                                                    <div class="table-responsive" style="overflow-x: scroll;">
                                                                        <table class="table table-bordered table-striped table-hover dataTable text-left computation" style="width: 100%;">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="td_desc" style="width: 45%;">Description</th>
                                                                                    <th>Unit Price</th>
                                                                                    <th>Quantity</th>
                                                                                    <th>Total Price</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbody">
                                                                                <?php
                                                                                    //current code
                                                                                    $sql_comp = mysqli_query($conn,"SELECT * FROM tbl_computation WHERE cl_qn='".$_SESSION['cl_qn']."' ");
                                                                                    if ($sql_comp->num_rows > 0) {
                                                                                        $x = 1;
                                                                                        while(($row_comp = mysqli_fetch_array($sql_comp)) && ($x <= 20)){
                                                                                            ?>
                                                                                            <tr id="tbodyrow<?php echo $x; ?>">
                                                                                                <td>
                                                                                                    <input type="hidden" id="id<?php echo $x; ?>" name="id<?php echo $x; ?>" value="<?php echo $row_comp['id'];?>">
                                                                                                    <input type="text" class="form-control" id="desc<?php echo $x; ?>" name="desc<?php echo $x; ?>" placeholder="1) Enter Description here"  value="<?php echo $row_comp['description'];?>" required autofocus>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <input type="number" step="any" class="form-control" id="uprice<?php echo $x; ?>" name="uprice<?php echo $x; ?>" value="<?php echo $row_comp['uprice'];?>" required autofocus>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <input type="number" class="form-control" id="qty<?php echo $x; ?>" name="qty<?php echo $x; ?>" value="<?php echo $row_comp['qty'];?>" required autofocus>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <input type="number" class="form-control" id="tprice<?php echo $x; ?>" name="tprice<?php echo $x; $x++; ?>" value="<?php echo $row_comp['tprice'];?>" readonly>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    //to be developed to add more blank rows after the entried rows
                                                                                    $sql_comp_addl = mysqli_query($conn,"SELECT * FROM tbl_computation WHERE cl_qn='".$_SESSION['cl_qn']."' ");
                                                                                    if ($sql_comp_addl->num_rows < 20) {
                                                                                        $addl_rows = 20-$sql_comp_addl->num_rows;
                                                                                        $x_addl = $sql_comp_addl->num_rows + 1;
                                                                                        while($x_addl <= $addl_rows) {
                                                                                            ?>
                                                                                                <tr id="tbodyrow<?php echo $x_addl; ?>" style="width: 100%;">
                                                                                                    <td>
                                                                                                        <input type="text" class="form-control" id="desc<?php echo $x_addl; ?>" name="desc<?php echo $x_addl; ?>" placeholder="<?php echo $x_addl; ?>) Enter Description here">
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <input type="number" step="any" class="form-control" id="uprice<?php echo $x_addl; ?>" name="uprice<?php echo $x_addl; ?>">
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <input type="number" class="form-control" id="qty<?php echo $x_addl; ?>" name="qty<?php echo $x_addl; ?>">
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <input type="number" class="form-control" id="tprice<?php echo $x_addl; ?>" name="tprice<?php echo $x_addl; ?>" readonly>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <button id="removeRow<?php echo $x_addl; $x_addl++; ?>" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                                                            <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                                                        </button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php
                                                                                        }
                                                                                    } else {
                                                                                        echo "You've already reached the maximum # of Medical Supplies/Lab Procedures allowed!";
                                                                                    }

                                                                                    $sql_comp2 = mysqli_query($conn,"SELECT * FROM tbl_computation2 WHERE cl_qn='".$_SESSION['cl_qn']."' ");
                                                                                    $row_comp2 = mysqli_fetch_array($sql_comp2)
                                                                                ?>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td style="font-weight: bold; text-align: right;">Sub-Total:</td>
                                                                                    <td><input type="number" class="form-control" id="stotal" name="stotal" value="<?php echo $row_comp2['stotal'];?>" readonly></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td style="font-weight: bold; text-align: right;">Discount:</td>
                                                                                    <td><input type="number" step="any" class="form-control" id="dcnt" name="dcnt" value="<?php echo $row_comp2['dcnt'];?>" readonly></td>
                                                                                    <td>
                                                                                        <select id="dcnt_option" class="form-control dcnt_option" name="dcnt_option">
                                                                                            <option>No</option>
                                                                                            <option>Yes</option>
                                                                                        </select>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td style="font-weight: bold; text-align: right;">Total Amount:</td>
                                                                                    <td><input type="number" class="form-control" id="totalamt" value="<?php echo $row_comp2['totalamt'];?>" name="totalamt" readonly></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- end of save transaction -->

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
        function print_view_gis() {
          window.open("print_view_gis.php");
        }
        function print_view_gl() {
          window.open("print_view_gl.php");
        }
        function print_view_computation() {
          window.open("print_view_computation.php");
        }
        function print_view_coe_gl() {
          window.open("print_view_coe_gl.php");
        }
        function print_view_pagpamatuod() {
          window.open("print_view_pagpamatuod.php");
        }

        $(document).ready(function() {

            $("#div_canvassby").hide();
            $("#purpose").click(function() {
                if ($("#purpose").val() == 'MEDICINES') {
                    $("#div_canvassby").show();
                } else {
                    $("#div_canvassby").hide();
                }
            });
            
            $("#div_cl_id_others").hide();
            $("#div_bn_id_others").hide();

            $("#cl_id").click(function() {
                if ($("#cl_id").val() == 'Others') {
                    $("#div_cl_id_others").show();
                } else {
                    $("#div_cl_id_others").hide();
                }
            });
            $("#bn_id").click(function() {
                if ($("#bn_id").val() == 'Others') {
                    $("#div_bn_id_others").show();
                } else {
                    $("#div_bn_id_others").hide();
                }
            });

            $("#search_sp").hide();
            $("#btn_search_sp").click(function() {
                $("#search_sp").show();
            });
            $("#btn_remove").click(function() {
                $("#search_sp").hide();
            });

            $("#div_cl_reltobene_others").hide();
            $("#cl_reltobene").click(function() {
                if ($("#cl_reltobene").val() == 'Others') {
                    $("#div_cl_reltobene_others").show();
                } else {
                    $("#div_cl_reltobene_others").hide();
                }
            });
            $("#div_cl_subcategory_others").hide();
            $("#cl_subcategory").click(function() {
                if ($("#cl_subcategory").val() == 'Others') {
                    $("#div_cl_subcategory_others").show();
                } else {
                    $("#div_cl_subcategory_others").hide();
                }
            });
            $("#div_cl_subcategory2_others").hide();
            $("#cl_subcategory2").click(function() {
                if ($("#cl_subcategory2").val() == 'Others') {
                    $("#div_cl_subcategory2_others").show();
                } else {
                    $("#div_cl_subcategory2_others").hide();
                }
            });
            $("#div_bn_subcategory_others").hide();
            $("#bn_subcategory").click(function() {
                if ($("#bn_subcategory").val() == 'Others') {
                    $("#div_bn_subcategory_others").show();
                } else {
                    $("#div_bn_subcategory_others").hide();
                }
            });
            $("#div_bn_subcategory2_others").hide();
            $("#bn_subcategory2").click(function() {
                if ($("#bn_subcategory2").val() == 'Others') {
                    $("#div_bn_subcategory2_others").show();
                } else {
                    $("#div_bn_subcategory2_others").hide();
                }
            });
            $("#div_bn_reltoclient_others").hide();
            $("#bn_reltoclient").click(function() {
                if ($("#bn_reltoclient").val() == 'Others') {
                    $("#div_bn_reltoclient_others").show();
                } else {
                    $("#div_bn_reltoclient_others").hide();
                }
            });

            $('.sp').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                ],
                paging: false
            });

            var table = $('.sp').DataTable();
            $('.sp tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                $("#sp_address").val(data[3]);
                console.log(data[3]);
                $("#sp").val(   data[1]);
                console.log(data[1]);
            });

            var fig = ''; var splitbydot = ''; var arrlength = '';
            var whole_num = ''; var dec_num = '';  var split_whole_num = ''; var split_dec_num = '';
            var arrlength_wh = ''; var arrlength_dec = ''; var ones_place = ''; var ones_place_toword = '';
            var tens_place = ''; var tens_place_toword = '';
            var hunds_place = ''; var hunds_place_toword = '';
            var thous_place = ''; var thous_place_toword = '';
            var tenthous_place = ''; var tenthous_place_toword = '';
            var hundthous_place = ''; var hundthous_place_toword = ''; 
            var wnwd = '';
            var uprice = ''; var qty = ''; var tprice = '';
            var stotal = ''; var dcnt = ''; var dcnt_option = ''; var totalamt = '';
            var tp1 = ''; var tp2 = ''; var tp3 = ''; var tp4 = ''; var tp5 = ''; var tp6 = ''; var tp7 = ''; var tp8 = ''; var tp9 = ''; var tp10 = ''; var tp11 = ''; var tp12 = ''; var tp13 = ''; var tp14 = ''; var tp15 = ''; var tp16 = ''; var tp17 = ''; var tp18 = ''; var tp19 = ''; var tp20 = '';

            $("#totalamt").click(function(){
                
                uprice = $("#uprice1").val();
                qty = $("#qty1").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice1").val(tprice.toFixed(2));

                uprice = $("#uprice2").val();
                qty = $("#qty2").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice2").val(tprice.toFixed(2));

                uprice = $("#uprice3").val();
                qty = $("#qty3").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice3").val(tprice.toFixed(2));

                uprice = $("#uprice4").val();
                qty = $("#qty4").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice4").val(tprice.toFixed(2));

                uprice = $("#uprice5").val();
                qty = $("#qty5").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice5").val(tprice.toFixed(2));

                uprice = $("#uprice6").val();
                qty = $("#qty6").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice6").val(tprice.toFixed(2));

                uprice = $("#uprice7").val();
                qty = $("#qty7").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice7").val(tprice.toFixed(2));

                uprice = $("#uprice8").val();
                qty = $("#qty8").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice8").val(tprice.toFixed(2));

                uprice = $("#uprice9").val();
                qty = $("#qty9").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice9").val(tprice.toFixed(2));

                uprice = $("#uprice10").val();
                qty = $("#qty10").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice10").val(tprice.toFixed(2));

                uprice = $("#uprice11").val();
                qty = $("#qty11").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice11").val(tprice.toFixed(2));

                uprice = $("#uprice12").val();
                qty = $("#qty12").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice12").val(tprice.toFixed(2));

                uprice = $("#uprice13").val();
                qty = $("#qty13").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice13").val(tprice.toFixed(2));

                uprice = $("#uprice14").val();
                qty = $("#qty14").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice14").val(tprice.toFixed(2));

                uprice = $("#uprice15").val();
                qty = $("#qty15").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice15").val(tprice.toFixed(2));

                uprice = $("#uprice16").val();
                qty = $("#qty16").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice16").val(tprice.toFixed(2));

                uprice = $("#uprice17").val();
                qty = $("#qty17").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice17").val(tprice.toFixed(2));

                uprice = $("#uprice18").val();
                qty = $("#qty18").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice18").val(tprice.toFixed(2));

                uprice = $("#uprice19").val();
                qty = $("#qty19").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice19").val(tprice.toFixed(2));

                uprice = $("#uprice20").val();
                qty = $("#qty20").val();
                tprice = uprice * parseInt(Math.abs(qty));
                $("#tprice20").val(tprice.toFixed(2));

                if (!$("#tprice1").val()) {
                    tp1 = 0;
                } else {
                    tp1 = parseFloat($("#tprice1").val());
                }
                if (!$("#tprice2").val()) {
                    tp2 = 0;
                } else {
                    tp2 = parseFloat($("#tprice2").val());
                }
                if (!$("#tprice3").val()) {
                    tp3 = 0;
                } else {
                    tp3 = parseFloat($("#tprice3").val());
                }
                if (!$("#tprice4").val()) {
                    tp4 = 0;
                } else {
                    tp4 = parseFloat($("#tprice4").val());
                }
                if (!$("#tprice5").val()) {
                    tp5 = 0;
                } else {
                    tp5 = parseFloat($("#tprice5").val());
                }
                if (!$("#tprice6").val()) {
                    tp6 = 0;
                } else {
                    tp6 = parseFloat($("#tprice6").val());
                }
                if (!$("#tprice7").val()) {
                    tp7 = 0;
                } else {
                    tp7 = parseFloat($("#tprice7").val());
                }
                if (!$("#tprice8").val()) {
                    tp8 = 0;
                } else {
                    tp8 = parseFloat($("#tprice8").val());
                }
                if (!$("#tprice9").val()) {
                    tp9 = 0;
                } else {
                    tp9 = parseFloat($("#tprice9").val());
                }
                if (!$("#tprice10").val()) {
                    tp10 = 0;
                } else {
                    tp10 = parseFloat($("#tprice10").val());
                }
                if (!$("#tprice11").val()) {
                    tp11 = 0;
                } else {
                    tp11 = parseFloat($("#tprice11").val());
                }
                if (!$("#tprice12").val()) {
                    tp12 = 0;
                } else {
                    tp12 = parseFloat($("#tprice12").val());
                }
                if (!$("#tprice13").val()) {
                    tp13 = 0;
                } else {
                    tp13 = parseFloat($("#tprice13").val());
                }
                if (!$("#tprice14").val()) {
                    tp14 = 0;
                } else {
                    tp14 = parseFloat($("#tprice14").val());
                }
                if (!$("#tprice15").val()) {
                    tp15 = 0;
                } else {
                    tp15 = parseFloat($("#tprice15").val());
                }
                if (!$("#tprice16").val()) {
                    tp16 = 0;
                } else {
                    tp16 = parseFloat($("#tprice16").val());
                }
                if (!$("#tprice17").val()) {
                    tp17 = 0;
                } else {
                    tp17 = parseFloat($("#tprice17").val());
                }
                if (!$("#tprice18").val()) {
                    tp18 = 0;
                } else {
                    tp18 = parseFloat($("#tprice18").val());
                }
                if (!$("#tprice19").val()) {
                    tp19 = 0;
                } else {
                    tp19 = parseFloat($("#tprice19").val());
                }
                if (!$("#tprice20").val()) {
                    tp20 = 0;
                } else {
                    tp20 = parseFloat($("#tprice20").val());
                }
                stotal = tp1 + tp2 + tp3 + tp4 + tp5 + tp6 + tp7 + tp8 + tp9 + tp10 + tp11 + tp12 + tp13 + tp14 + tp15 + tp16 + tp17 + tp18 + tp19 + tp20;
                console.log(stotal);
                $("#stotal").val(stotal.toFixed(2));

                totalamt = parseFloat($("#stotal").val()) - dcnt;
                console.log(totalamt);
                $("#totalamt").val(totalamt.toFixed(2));
                $("#amt_figure").val(totalamt.toFixed(2));

                //amt in figures to words
                fig = $("#amt_figure").val();
                //$("#amt_word").val(fig);
                splitbydot = fig.split('.');
                arrlength = splitbydot.length;
                console.log(splitbydot);
                console.log("# Split by dot: "+splitbydot);
                console.log("Array Length: "+arrlength);
                console.log("Fig: "+fig);

                if (arrlength > 1) {
                    whole_num = splitbydot[0];
                    dec_num = splitbydot[1];
                    console.log("Whole #: "+whole_num);
                    console.log("Decimal #: "+dec_num);

                    split_whole_num = whole_num.split('');
                    console.log("Split Whole #: "+split_whole_num);
                    arrlength_wh = split_whole_num.length;
                    console.log("Array Length of Whole #: "+arrlength_wh);

                    split_dec_num = dec_num.split('');
                    console.log("Split Decimal #: "+split_dec_num);
                    arrlength_dec = split_dec_num.length;
                    console.log("Array Length of Decimal #: "+arrlength_dec);

                    if (arrlength_dec > 2) {
                        if (split_dec_num[2] >= 5) {
                            split_dec_num[1] = parseInt(split_dec_num[1]) + 1;
                            dec_num = "& "+split_dec_num[0]+split_dec_num[1]+"/100";
                        } else {
                            dec_num = "& "+split_dec_num[0]+split_dec_num[1]+"/100";
                        }
                    } else if ((dec_num == 0) || (dec_num == 00)) {
                        dec_num ="";
                    } else if (arrlength_dec == 1) {
                        dec_num = "& "+dec_num+"0/100";
                    } else {
                        dec_num = "& "+dec_num+"/100";
                    }

                    if (arrlength_wh > 6) {
                        alert("ERROR NOTICE: The amount you entered exceeds the maximum amount allowed which is up to 150,000 Pesos only! Please enter amount from 1 - 150,000.");
                        $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    } else if (arrlength_wh < 1) {
                        alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                        $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    } else if (arrlength_wh == 1) {
                        ones_place = split_whole_num[0];
                        console.log("Ones Place #:"+ones_place);
                        if (ones_place == 0) {
                            ones_place_toword = "ERROR NOTICE: Please enter amount from 1 - 150,000.";
                        } else if (ones_place == 1) {
                            ones_place_toword = "One";
                        } else if (ones_place == 2) {
                            ones_place_toword = "Two";
                        } else if (ones_place == 3) {
                            ones_place_toword = "Three";
                        } else if (ones_place == 4) {
                            ones_place_toword = "Four";
                        } else if (ones_place == 5) {
                            ones_place_toword = "Five";
                        } else if (ones_place == 6) {
                            ones_place_toword = "Six";
                        } else if (ones_place == 7) {
                            ones_place_toword = "Seven";
                        } else if (ones_place == 8) {
                            ones_place_toword = "Eight";
                        } else if (ones_place == 9) {
                            ones_place_toword = "Nine";
                        }
                        console.log(ones_place_toword);
                        if (ones_place_toword == "ERROR NOTICE: Please enter amount from 1 - 150,000.") {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val(ones_place_toword);
                        } else {
                        $("#amt_word").val(ones_place_toword+" Pesos "+dec_num);
                        }
                    }

                    else if (arrlength_wh == 2) {
                        ones_place = split_whole_num[1];
                        tens_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                         if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        console.log(tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 3) {
                        ones_place = split_whole_num[2];
                        tens_place = split_whole_num[1];
                        hunds_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        console.log(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 4) {
                        ones_place = split_whole_num[3];
                        tens_place = split_whole_num[2];
                        hunds_place = split_whole_num[1];
                        thous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        if (thous_place == 0) {
                            thous_place_toword = "";
                        } else if (thous_place == 1) {
                            thous_place_toword = "One Thousand";
                        } else if (thous_place == 2) {
                            thous_place_toword = "Two Thousand";
                        } else if (thous_place == 3) {
                            thous_place_toword = "Three Thousand";
                        } else if (thous_place == 4) {
                            thous_place_toword = "Four Thousand";
                        } else if (thous_place == 5) {
                            thous_place_toword = "Five Thousand";
                        } else if (thous_place == 6) {
                            thous_place_toword = "Six Thousand";
                        } else if (thous_place == 7) {
                            thous_place_toword = "Seven Thousand";
                        } else if (thous_place == 8) {
                            thous_place_toword = "Eight Thousand";
                        } else if (thous_place == 9) {
                            thous_place_toword = "Nine Thousand";
                        }
                        console.log(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 5) {
                        ones_place = split_whole_num[4];
                        tens_place = split_whole_num[3];
                        hunds_place = split_whole_num[2];
                        thous_place = split_whole_num[1];
                        tenthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }
                        console.log(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 6) {
                        ones_place = split_whole_num[5];
                        tens_place = split_whole_num[4];
                        hunds_place = split_whole_num[3];
                        thous_place = split_whole_num[2];
                        tenthous_place = split_whole_num[1];
                        hundthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        console.log(hundthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }

                        if (hundthous_place == 0) {
                            hundthous_place_toword = "";
                        } else if (hundthous_place == 1) {
                            hundthous_place_toword = "One Hundred";
                        } else if (hundthous_place == 2) {
                            hundthous_place_toword = "Two Hundred";
                        } else if (hundthous_place == 3) {
                            hundthous_place_toword = "Three Hundred";
                        } else if (hundthous_place == 4) {
                            hundthous_place_toword = "Four Hundred";
                        } else if (hundthous_place == 5) {
                            hundthous_place_toword = "Five Hundred";
                        } else if (hundthous_place == 6) {
                            hundthous_place_toword = "Six Hundred";
                        } else if (hundthous_place == 7) {
                            hundthous_place_toword = "Seven Hundred";
                        } else if (hundthous_place == 8) {
                            hundthous_place_toword = "Eight Hundred";
                        } else if (hundthous_place == 9) {
                            hundthous_place_toword = "Nine Hundred";
                        }   

                        console.log(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        console.log("Whole + Decimal: "+fig);
                        if (fig > 150000.00) {
                            alert("ERROR NOTICE: The amount you entered exceeds the maximum amount allowed which is only up to 150,000 Pesos! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                        } else {
                        $("#amt_word").val(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                        }
                    }

                } else {
                    whole_num = splitbydot[0];
                    console.log("Whole #: "+whole_num);
                    split_whole_num = whole_num.split('');
                    arrlength_wh = split_whole_num.length;
                    console.log("Split Whole #: "+split_whole_num);
                    console.log("Array Length of Whole #: "+arrlength_wh);
                    if (arrlength_wh > 6) {
                        alert("ERROR NOTICE: The amount you entered exceeds the maximum amount allowed which is up to 150,000 Pesos only! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    } else if (arrlength_wh < 1) {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    }
                    
                    else if (arrlength_wh == 1) {
                        ones_place = split_whole_num[0];
                        console.log("Ones Place #:"+ones_place);
                        if (ones_place == 0) {
                            ones_place_toword = "ERROR NOTICE: Please enter amount from 1 - 150,000.";
                        } else if (ones_place == 1) {
                            ones_place_toword = "One";
                        } else if (ones_place == 2) {
                            ones_place_toword = "Two";
                        } else if (ones_place == 3) {
                            ones_place_toword = "Three";
                        } else if (ones_place == 4) {
                            ones_place_toword = "Four";
                        } else if (ones_place == 5) {
                            ones_place_toword = "Five";
                        } else if (ones_place == 6) {
                            ones_place_toword = "Six";
                        } else if (ones_place == 7) {
                            ones_place_toword = "Seven";
                        } else if (ones_place == 8) {
                            ones_place_toword = "Eight";
                        } else if (ones_place == 9) {
                            ones_place_toword = "Nine";
                        }
                        console.log(ones_place_toword);
                        if (ones_place_toword == "ERROR NOTICE: Please enter amount from 1 - 150,000.") {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val(ones_place_toword);
                        } else {
                        $("#amt_word").val(ones_place_toword+" Pesos");
                        }
                    }

                    else if (arrlength_wh == 2) {
                        ones_place = split_whole_num[1];
                        tens_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                         if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        console.log(tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 3) {
                        ones_place = split_whole_num[2];
                        tens_place = split_whole_num[1];
                        hunds_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        console.log(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 4) {
                        ones_place = split_whole_num[3];
                        tens_place = split_whole_num[2];
                        hunds_place = split_whole_num[1];
                        thous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        if (thous_place == 0) {
                            thous_place_toword = "";
                        } else if (thous_place == 1) {
                            thous_place_toword = "One Thousand";
                        } else if (thous_place == 2) {
                            thous_place_toword = "Two Thousand";
                        } else if (thous_place == 3) {
                            thous_place_toword = "Three Thousand";
                        } else if (thous_place == 4) {
                            thous_place_toword = "Four Thousand";
                        } else if (thous_place == 5) {
                            thous_place_toword = "Five Thousand";
                        } else if (thous_place == 6) {
                            thous_place_toword = "Six Thousand";
                        } else if (thous_place == 7) {
                            thous_place_toword = "Seven Thousand";
                        } else if (thous_place == 8) {
                            thous_place_toword = "Eight Thousand";
                        } else if (thous_place == 9) {
                            thous_place_toword = "Nine Thousand";
                        }
                        console.log(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 5) {
                        ones_place = split_whole_num[4];
                        tens_place = split_whole_num[3];
                        hunds_place = split_whole_num[2];
                        thous_place = split_whole_num[1];
                        tenthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }
                        console.log(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 6) {
                        ones_place = split_whole_num[5];
                        tens_place = split_whole_num[4];
                        hunds_place = split_whole_num[3];
                        thous_place = split_whole_num[2];
                        tenthous_place = split_whole_num[1];
                        hundthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        console.log(hundthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }

                        if (hundthous_place == 0) {
                            hundthous_place_toword = "";
                        } else if (hundthous_place == 1) {
                            hundthous_place_toword = "One Hundred";
                        } else if (hundthous_place == 2) {
                            hundthous_place_toword = "Two Hundred";
                        } else if (hundthous_place == 3) {
                            hundthous_place_toword = "Three Hundred";
                        } else if (hundthous_place == 4) {
                            hundthous_place_toword = "Four Hundred";
                        } else if (hundthous_place == 5) {
                            hundthous_place_toword = "Five Hundred";
                        } else if (hundthous_place == 6) {
                            hundthous_place_toword = "Six Hundred";
                        } else if (hundthous_place == 7) {
                            hundthous_place_toword = "Seven Hundred";
                        } else if (hundthous_place == 8) {
                            hundthous_place_toword = "Eight Hundred";
                        } else if (hundthous_place == 9) {
                            hundthous_place_toword = "Nine Hundred";
                        }   

                        console.log(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        if (parseInt(fig) > 150000) {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                        } else {
                        $("#amt_word").val(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                        }
                    }
                }
            });

            $("#dcnt_option").click(function(){
                if ($("#dcnt_option").val() == 'No') {
                    dcnt = 0;
                    console.log(dcnt);
                    $("#dcnt").val(dcnt.toFixed(2));
                } else {
                    dcnt = parseFloat($("#stotal").val() * 0.20);
                    console.log(dcnt);
                    $("#dcnt").val(dcnt.toFixed(2));
                }
            });
            $("#amt_word").click(function(){
                fig = $("#amt_figure").val();
                //$("#amt_word").val(fig);
                splitbydot = fig.split('.');
                arrlength = splitbydot.length;
                console.log(splitbydot);
                console.log("# Split by dot: "+splitbydot);
                console.log("Array Length: "+arrlength);
                console.log("Fig: "+fig);

                if (arrlength > 1) {
                    whole_num = splitbydot[0];
                    dec_num = splitbydot[1];
                    console.log("Whole #: "+whole_num);
                    console.log("Decimal #: "+dec_num);

                    split_whole_num = whole_num.split('');
                    console.log("Split Whole #: "+split_whole_num);
                    arrlength_wh = split_whole_num.length;
                    console.log("Array Length of Whole #: "+arrlength_wh);

                    split_dec_num = dec_num.split('');
                    console.log("Split Decimal #: "+split_dec_num);
                    arrlength_dec = split_dec_num.length;
                    console.log("Array Length of Decimal #: "+arrlength_dec);

                    if (arrlength_dec > 2) {
                        if (split_dec_num[2] >= 5) {
                            split_dec_num[1] = parseInt(split_dec_num[1]) + 1;
                            dec_num = "& "+split_dec_num[0]+split_dec_num[1]+"/100";
                        } else {
                            dec_num = "& "+split_dec_num[0]+split_dec_num[1]+"/100";
                        }
                    } else if ((dec_num == 0) || (dec_num == 00)) {
                        dec_num ="";
                    } else if (arrlength_dec == 1) {
                        dec_num = "& "+dec_num+"0/100";
                    } else {
                        dec_num = "& "+dec_num+"/100";
                    }

                    if (arrlength_wh > 6) {
                        alert("ERROR NOTICE: The amount you entered exceeds the maximum amount allowed which is up to 150,000 Pesos only! Please enter amount from 1 - 150,000.");
                        $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    } else if (arrlength_wh < 1) {
                        alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                        $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    } else if (arrlength_wh == 1) {
                        ones_place = split_whole_num[0];
                        console.log("Ones Place #:"+ones_place);
                        if (ones_place == 0) {
                            ones_place_toword = "ERROR NOTICE: Please enter amount from 1 - 150,000.";
                        } else if (ones_place == 1) {
                            ones_place_toword = "One";
                        } else if (ones_place == 2) {
                            ones_place_toword = "Two";
                        } else if (ones_place == 3) {
                            ones_place_toword = "Three";
                        } else if (ones_place == 4) {
                            ones_place_toword = "Four";
                        } else if (ones_place == 5) {
                            ones_place_toword = "Five";
                        } else if (ones_place == 6) {
                            ones_place_toword = "Six";
                        } else if (ones_place == 7) {
                            ones_place_toword = "Seven";
                        } else if (ones_place == 8) {
                            ones_place_toword = "Eight";
                        } else if (ones_place == 9) {
                            ones_place_toword = "Nine";
                        }
                        console.log(ones_place_toword);
                        if (ones_place_toword == "ERROR NOTICE: Please enter amount from 1 - 150,000.") {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val(ones_place_toword);
                        } else {
                        $("#amt_word").val(ones_place_toword+" Pesos "+dec_num);
                        }
                    }

                    else if (arrlength_wh == 2) {
                        ones_place = split_whole_num[1];
                        tens_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                         if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        console.log(tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 3) {
                        ones_place = split_whole_num[2];
                        tens_place = split_whole_num[1];
                        hunds_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        console.log(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 4) {
                        ones_place = split_whole_num[3];
                        tens_place = split_whole_num[2];
                        hunds_place = split_whole_num[1];
                        thous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        if (thous_place == 0) {
                            thous_place_toword = "";
                        } else if (thous_place == 1) {
                            thous_place_toword = "One Thousand";
                        } else if (thous_place == 2) {
                            thous_place_toword = "Two Thousand";
                        } else if (thous_place == 3) {
                            thous_place_toword = "Three Thousand";
                        } else if (thous_place == 4) {
                            thous_place_toword = "Four Thousand";
                        } else if (thous_place == 5) {
                            thous_place_toword = "Five Thousand";
                        } else if (thous_place == 6) {
                            thous_place_toword = "Six Thousand";
                        } else if (thous_place == 7) {
                            thous_place_toword = "Seven Thousand";
                        } else if (thous_place == 8) {
                            thous_place_toword = "Eight Thousand";
                        } else if (thous_place == 9) {
                            thous_place_toword = "Nine Thousand";
                        }
                        console.log(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 5) {
                        ones_place = split_whole_num[4];
                        tens_place = split_whole_num[3];
                        hunds_place = split_whole_num[2];
                        thous_place = split_whole_num[1];
                        tenthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }
                        console.log(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                    }

                    else if (arrlength_wh == 6) {
                        ones_place = split_whole_num[5];
                        tens_place = split_whole_num[4];
                        hunds_place = split_whole_num[3];
                        thous_place = split_whole_num[2];
                        tenthous_place = split_whole_num[1];
                        hundthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        console.log(hundthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }

                        if (hundthous_place == 0) {
                            hundthous_place_toword = "";
                        } else if (hundthous_place == 1) {
                            hundthous_place_toword = "One Hundred";
                        } else if (hundthous_place == 2) {
                            hundthous_place_toword = "Two Hundred";
                        } else if (hundthous_place == 3) {
                            hundthous_place_toword = "Three Hundred";
                        } else if (hundthous_place == 4) {
                            hundthous_place_toword = "Four Hundred";
                        } else if (hundthous_place == 5) {
                            hundthous_place_toword = "Five Hundred";
                        } else if (hundthous_place == 6) {
                            hundthous_place_toword = "Six Hundred";
                        } else if (hundthous_place == 7) {
                            hundthous_place_toword = "Seven Hundred";
                        } else if (hundthous_place == 8) {
                            hundthous_place_toword = "Eight Hundred";
                        } else if (hundthous_place == 9) {
                            hundthous_place_toword = "Nine Hundred";
                        }   

                        console.log(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        console.log("Whole + Decimal: "+fig);
                        if (fig > 150000.00) {
                            alert("ERROR NOTICE: The amount you entered exceeds the maximum amount allowed which is only up to 150,000 Pesos! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                        } else {
                        $("#amt_word").val(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos "+dec_num);
                        }
                    }

                } else {
                    whole_num = splitbydot[0];
                    console.log("Whole #: "+whole_num);
                    split_whole_num = whole_num.split('');
                    arrlength_wh = split_whole_num.length;
                    console.log("Split Whole #: "+split_whole_num);
                    console.log("Array Length of Whole #: "+arrlength_wh);
                    if (arrlength_wh > 6) {
                        alert("ERROR NOTICE: The amount you entered exceeds the maximum amount allowed which is up to 150,000 Pesos only! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    } else if (arrlength_wh < 1) {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                    }
                    
                    else if (arrlength_wh == 1) {
                        ones_place = split_whole_num[0];
                        console.log("Ones Place #:"+ones_place);
                        if (ones_place == 0) {
                            ones_place_toword = "ERROR NOTICE: Please enter amount from 1 - 150,000.";
                        } else if (ones_place == 1) {
                            ones_place_toword = "One";
                        } else if (ones_place == 2) {
                            ones_place_toword = "Two";
                        } else if (ones_place == 3) {
                            ones_place_toword = "Three";
                        } else if (ones_place == 4) {
                            ones_place_toword = "Four";
                        } else if (ones_place == 5) {
                            ones_place_toword = "Five";
                        } else if (ones_place == 6) {
                            ones_place_toword = "Six";
                        } else if (ones_place == 7) {
                            ones_place_toword = "Seven";
                        } else if (ones_place == 8) {
                            ones_place_toword = "Eight";
                        } else if (ones_place == 9) {
                            ones_place_toword = "Nine";
                        }
                        console.log(ones_place_toword);
                        if (ones_place_toword == "ERROR NOTICE: Please enter amount from 1 - 150,000.") {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val(ones_place_toword);
                        } else {
                        $("#amt_word").val(ones_place_toword+" Pesos");
                        }
                    }

                    else if (arrlength_wh == 2) {
                        ones_place = split_whole_num[1];
                        tens_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                         if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        console.log(tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 3) {
                        ones_place = split_whole_num[2];
                        tens_place = split_whole_num[1];
                        hunds_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        console.log(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 4) {
                        ones_place = split_whole_num[3];
                        tens_place = split_whole_num[2];
                        hunds_place = split_whole_num[1];
                        thous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }
                        if (thous_place == 0) {
                            thous_place_toword = "";
                        } else if (thous_place == 1) {
                            thous_place_toword = "One Thousand";
                        } else if (thous_place == 2) {
                            thous_place_toword = "Two Thousand";
                        } else if (thous_place == 3) {
                            thous_place_toword = "Three Thousand";
                        } else if (thous_place == 4) {
                            thous_place_toword = "Four Thousand";
                        } else if (thous_place == 5) {
                            thous_place_toword = "Five Thousand";
                        } else if (thous_place == 6) {
                            thous_place_toword = "Six Thousand";
                        } else if (thous_place == 7) {
                            thous_place_toword = "Seven Thousand";
                        } else if (thous_place == 8) {
                            thous_place_toword = "Eight Thousand";
                        } else if (thous_place == 9) {
                            thous_place_toword = "Nine Thousand";
                        }
                        console.log(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(thous_place_toword+" "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 5) {
                        ones_place = split_whole_num[4];
                        tens_place = split_whole_num[3];
                        hunds_place = split_whole_num[2];
                        thous_place = split_whole_num[1];
                        tenthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }
                        console.log(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        $("#amt_word").val(tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                    }

                    else if (arrlength_wh == 6) {
                        ones_place = split_whole_num[5];
                        tens_place = split_whole_num[4];
                        hunds_place = split_whole_num[3];
                        thous_place = split_whole_num[2];
                        tenthous_place = split_whole_num[1];
                        hundthous_place = split_whole_num[0];
                        console.log(ones_place);
                        console.log(tens_place);
                        console.log(hunds_place);
                        console.log(thous_place);
                        console.log(tenthous_place);
                        console.log(hundthous_place);
                        if ((tens_place == 0) && (ones_place == 0)) {
                            tens_place_toword = ones_place_toword = "";
                        } else if ((tens_place == 0) && (ones_place == 1)) {
                            tens_place_toword = ""; ones_place_toword = "One";
                        } else if ((tens_place == 0) && (ones_place == 2)) {
                            tens_place_toword = ""; ones_place_toword = "Two";
                        } else if ((tens_place == 0) && (ones_place == 3)) {
                            tens_place_toword = ""; ones_place_toword = "Three";
                        } else if ((tens_place == 0) && (ones_place == 4)) {
                            tens_place_toword = ""; ones_place_toword = "Four";
                        } else if ((tens_place == 0) && (ones_place == 5)) {
                            tens_place_toword = ""; ones_place_toword = "Five";
                        } else if ((tens_place == 0) && (ones_place == 6)) {
                            tens_place_toword = ""; ones_place_toword = "Six";
                        } else if ((tens_place == 0) && (ones_place == 7)) {
                            tens_place_toword = ""; ones_place_toword = "Seven";
                        } else if ((tens_place == 0) && (ones_place == 8)) {
                            tens_place_toword = ""; ones_place_toword = "Eight";
                        } else if ((tens_place == 0) && (ones_place == 9)) {
                            tens_place_toword = ""; ones_place_toword = "Nine";
                        }
                        else if ((tens_place == 1) && (ones_place == 0)) {
                            tens_place_toword = "Ten"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 1)) {
                            tens_place_toword = "Eleven"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 2)) {
                            tens_place_toword = "Twelve"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 3)) {
                            tens_place_toword = "Thirteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 4)) {
                            tens_place_toword = "Fourteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 5)) {
                            tens_place_toword = "Fifteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 6)) {
                            tens_place_toword = "Sixteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 7)) {
                            tens_place_toword = "Seventeen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 8)) {
                            tens_place_toword = "Eighteen"; ones_place_toword = "";
                        } else if ((tens_place == 1) && (ones_place == 9)) {
                            tens_place_toword = "Nineteen"; ones_place_toword = "";
                        }
                        else if ((tens_place > 1) && (ones_place == 0)) {
                            ones_place_toword = "";
                        } else if ((tens_place > 1) && (ones_place == 1)) {
                            ones_place_toword = "One";
                        } else if ((tens_place > 1) && (ones_place == 2)) {
                            ones_place_toword = "Two";
                        } else if ((tens_place > 1) && (ones_place == 3)) {
                            ones_place_toword = "Three";
                        } else if ((tens_place > 1) && (ones_place == 4)) {
                            ones_place_toword = "Four";
                        } else if ((tens_place > 1) && (ones_place == 5)) {
                            ones_place_toword = "Five";
                        } else if ((tens_place > 1) && (ones_place == 6)) {
                            ones_place_toword = "Six";
                        } else if ((tens_place > 1) && (ones_place == 7)) {
                            ones_place_toword = "Seven";
                        } else if ((tens_place > 1) && (ones_place == 8)) {
                            ones_place_toword = "Eight";
                        } else if ((tens_place > 1) && (ones_place == 9)) {
                            ones_place_toword = "Nine";
                        }
                        if (tens_place == 2) {
                            tens_place_toword = "Twenty";
                        } else if (tens_place == 3) {
                            tens_place_toword = "Thirty";
                        } else if (tens_place == 4) {
                            tens_place_toword = "Forty";
                        } else if (tens_place == 5) {
                            tens_place_toword = "Fifty";
                        } else if (tens_place == 6) {
                            tens_place_toword = "Sixty";
                        } else if (tens_place == 7) {
                            tens_place_toword = "Seventy";
                        } else if (tens_place == 8) {
                            tens_place_toword = "Eighty";
                        } else if (tens_place == 9) {
                            tens_place_toword = "Ninety";
                        }
                        if (hunds_place == 0) {
                            hunds_place_toword = "";
                        } else if (hunds_place == 1) {
                            hunds_place_toword = "One Hundred";
                        } else if (hunds_place == 2) {
                            hunds_place_toword = "Two Hundred";
                        } else if (hunds_place == 3) {
                            hunds_place_toword = "Three Hundred";
                        } else if (hunds_place == 4) {
                            hunds_place_toword = "Four Hundred";
                        } else if (hunds_place == 5) {
                            hunds_place_toword = "Five Hundred";
                        } else if (hunds_place == 6) {
                            hunds_place_toword = "Six Hundred";
                        } else if (hunds_place == 7) {
                            hunds_place_toword = "Seven Hundred";
                        } else if (hunds_place == 8) {
                            hunds_place_toword = "Eight Hundred";
                        } else if (hunds_place == 9) {
                            hunds_place_toword = "Nine Hundred";
                        }

                        if ((tenthous_place == 0) && (thous_place == 0)) {
                            tenthous_place_toword = thous_place_toword = "";
                        } else if ((tenthous_place == 0) && (thous_place == 1)) {
                            tenthous_place_toword = ""; thous_place_toword = "One";
                        } else if ((tenthous_place == 0) && (thous_place == 2)) {
                            tenthous_place_toword = ""; thous_place_toword = "Two";
                        } else if ((tenthous_place == 0) && (thous_place == 3)) {
                            tenthous_place_toword = ""; thous_place_toword = "Three";
                        } else if ((tenthous_place == 0) && (thous_place == 4)) {
                            tenthous_place_toword = ""; thous_place_toword = "Four";
                        } else if ((tenthous_place == 0) && (thous_place == 5)) {
                            tenthous_place_toword = ""; thous_place_toword = "Five";
                        } else if ((tenthous_place == 0) && (othou_place == 6)) {
                            tenthous_place_toword = ""; thous_place_toword = "Six";
                        } else if ((tenthous_place == 0) && (thous_place == 7)) {
                            tenthous_place_toword = ""; thous_place_toword = "Seven";
                        } else if ((tenthous_place == 0) && (thous_place == 8)) {
                            tenthous_place_toword = ""; thous_place_toword = "Eight";
                        } else if ((tenthous_place == 0) && (thous_place == 9)) {
                            tenthous_place_toword = ""; thous_place_toword = "Nine";
                        }
                        else if ((tenthous_place == 1) && (thous_place == 0)) {
                            tenthous_place_toword = "Ten"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 1)) {
                            tenthous_place_toword = "Eleven"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 2)) {
                            tenthous_place_toword = "Twelve"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 3)) {
                            tenthous_place_toword = "Thirteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 4)) {
                            tenthous_place_toword = "Fourteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 5)) {
                            tenthous_place_toword = "Fifteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 6)) {
                            tenthous_place_toword = "Sixteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 7)) {
                            tenthous_place_toword = "Seventeen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 8)) {
                            tenthous_place_toword = "Eighteen"; thous_place_toword = "";
                        } else if ((tenthous_place == 1) && (thous_place == 9)) {
                            tenthous_place_toword = "Nineteen"; thous_place_toword = "";
                        }
                        else if ((tenthous_place > 1) && (thous_place == 0)) {
                            thous_place_toword = "";
                        } else if ((tenthous_place > 1) && (thous_place == 1)) {
                            thous_place_toword = "One";
                        } else if ((tenthous_place > 1) && (thous_place == 2)) {
                            thous_place_toword = "Two";
                        } else if ((tenthous_place > 1) && (thous_place == 3)) {
                            thous_place_toword = "Three";
                        } else if ((tenthous_place > 1) && (thous_place == 4)) {
                            thous_place_toword = "Four";
                        } else if ((tenthous_place > 1) && (thous_place == 5)) {
                            thous_place_toword = "Five";
                        } else if ((tenthous_place > 1) && (thous_place == 6)) {
                            thous_place_toword = "Six";
                        } else if ((tenthous_place > 1) && (thous_place == 7)) {
                            thous_place_toword = "Seven";
                        } else if ((tenthous_place > 1) && (thous_place == 8)) {
                            thous_place_toword = "Eight";
                        } else if ((tenthous_place > 1) && (thous_place == 9)) {
                            thous_place_toword = "Nine";
                        }
                        if (tenthous_place == 2) {
                            tenthous_place_toword = "Twenty";
                        } else if (tenthous_place == 3) {
                            tenthous_place_toword = "Thirty";
                        } else if (tenthous_place == 4) {
                            tenthous_place_toword = "Forty";
                        } else if (tenthous_place == 5) {
                            tenthous_place_toword = "Fifty";
                        } else if (tenthous_place == 6) {
                            tenthous_place_toword = "Sixty";
                        } else if (tenthous_place == 7) {
                            tenthous_place_toword = "Seventy";
                        } else if (tenthous_place == 8) {
                            tenthous_place_toword = "Eighty";
                        } else if (tenthous_place == 9) {
                            tenthous_place_toword = "Ninety";
                        }

                        if (hundthous_place == 0) {
                            hundthous_place_toword = "";
                        } else if (hundthous_place == 1) {
                            hundthous_place_toword = "One Hundred";
                        } else if (hundthous_place == 2) {
                            hundthous_place_toword = "Two Hundred";
                        } else if (hundthous_place == 3) {
                            hundthous_place_toword = "Three Hundred";
                        } else if (hundthous_place == 4) {
                            hundthous_place_toword = "Four Hundred";
                        } else if (hundthous_place == 5) {
                            hundthous_place_toword = "Five Hundred";
                        } else if (hundthous_place == 6) {
                            hundthous_place_toword = "Six Hundred";
                        } else if (hundthous_place == 7) {
                            hundthous_place_toword = "Seven Hundred";
                        } else if (hundthous_place == 8) {
                            hundthous_place_toword = "Eight Hundred";
                        } else if (hundthous_place == 9) {
                            hundthous_place_toword = "Nine Hundred";
                        }   

                        console.log(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword);
                        if (parseInt(fig) > 150000) {
                            alert("ERROR NOTICE: The amount you entered is below the minimum amount allowed which is only 1 Peso! Please enter amount from 1 - 150,000.");
                            $("#amt_word").val("ERROR NOTICE: Please enter amount from 1 - 150,000.");
                        } else {
                        $("#amt_word").val(hundthous_place_toword+" "+tenthous_place_toword+" "+thous_place_toword+" Thousand "+hunds_place_toword+" "+tens_place_toword+" "+ones_place_toword+" Pesos");
                        }
                    }
                }
            });
        });
    </script>


</body>
</html>