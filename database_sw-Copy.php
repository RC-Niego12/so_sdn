<?php
    // Start the session
    session_start();
    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname='".$_SESSION['uname']."' AND pword='".$_SESSION['pword']."' ");
    $roww = mysqli_fetch_assoc($sql);
    if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==false)) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Database</title>
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
                <a class="navbar-brand" href="#" title="Homepage - SW Level" style="color: white;">DSWD AICS System (SWAD-SDN2): Social Worker Level</a>
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
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs INNER JOIN tbl_sw_table ON tbl_staffs.staffid=tbl_sw_table.staffid2 WHERE staffid='".$roww['staffid']."'");
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row['fname'].' '.substr($row['mname'],0,1).'. '.$row['lname'].' '.$row['nameext']; ?></div>
                    <div class="email"><?php echo $row['uname'].' | Table '.$row['table_num']; ?></div>
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
                        <a href="database_sw.php">
                            <span class="glyphicon glyphicon-file"></span>
                            <span>Database</span>
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
                <div class="copyright" style="color: darkblue;">
                    &copy;2023 <a href="#" style="color: darkblue;">DSWD AICS System (SWAD-SDN2)</a>
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
                                    <a href="#all_clients_served_systembased" data-toggle="tab">
                                        <span class="fa fa-group"></span> All Served Clients (System-based)
                                    </a>
                                </li>
                                <!--
                                <li>
                                    <a href="#all_clients_served_manual" data-toggle="tab">
                                        <span class="fa fa-group"></span> All Served Clients (Manual)
                                    </a>
                                </li>
                                -->
                            </ul>
                            <div class="tab-content text-center" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- all clients served systembased -->
                                <div id="all_clients_served_systembased" class="tab-pane fade in active">
                                    <div class="">
                                        <?php
                                            $_SESSION['cl_qn2'] = $_SESSION['modal_clqn'] = $_SESSION['cancel_option'] = $_SESSION['cancel_remarks'] = $error = "";
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                if (isset($_POST['view_forms'])) {
                                                    $_SESSION['cl_qn2'] = mysqli_real_escape_string($conn, test_input($_POST['cl_qn2']));
                                                    $_SESSION['release_mode'] = mysqli_real_escape_string($conn, test_input($_POST['release_mode']));
                                                    if ($_SESSION['release_mode']=="Guarantee Letter") {
                                                        header("location: viewFormsGL_sw.php");
                                                    } else if ($_SESSION['release_mode']=="Petty Cash Voucher") {
                                                        header("location: viewFormsPCV_sw.php");
                                                    } else if ($_SESSION['release_mode']=="Cash Voucher") {
                                                        header("location: viewFormsCV_sw.php");
                                                    }
                                                }
                                            }
                                            function test_input($data) {
                                              $data = trim($data);
                                              $data = stripslashes($data);
                                              $data = htmlspecialchars($data);
                                              return $data;
                                            }
                                            ?>
                                        <form action="" method="POST">
                                            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                                <div class="panel-heading panel-title bg-darkblue"> 
                                                    <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Selected Row ID Number.:</h5>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-xs-10">
                                                        <div class="form-group form-float">
                                                            <label style="float: left;">Please click desired row below to get Row ID Number.</label>
                                                            <div class="form-line">
                                                                <input type="number" class="form-control text-center" id="cl_qn2" name="cl_qn2" required autofocus>
                                                                <input type="hidden" class="form-control text-center" id="release_mode" name="release_mode" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-1">
                                                        <span style="color: red; font-size: 2em;">*</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8 col-xl-8">
                                                <ul class="pager" style="float: left; margin: 10px -20px;">
                                                    <li class="">
                                                        <a href="database_sw.php">
                                                            <button class="btn btn-xs btn-block waves-effect" type="button">Refresh <span class="fa fa-refresh"></button>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a style="color: white;">
                                                            <button type="submit" name="view_forms" class="btn btn-primary btn-xs btn-block bg-darkblue waves-effect">View Forms <span class="fa fa-eye"></button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                        <label style="float: left;">NOTE: CLICK BUTTON BELOW TO DOWNLOAD LIST IN EXCEL FILE.</label>
                                        <table class="table table-bordered table-striped table-hover clientq search_clients dataTable text-left">
                                            <thead style="color: white;">
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4" style="background-color: green;">CLIENT'S NAME</th>
                                                    <th colspan="4" style="background-color: green;">CLIENT'S AGE/CIVIL STATUS/DATE OF BIRTH/SEX</th>
                                                    <th colspan="6" style="background-color: green;">CLIENT'S ADDRESS</th>
                                                    <th colspan="3" style="background-color: green;">CLIENT'S 4Ps/NHTS DETAILS</th>
                                                    <th colspan="4" style="background-color: green;">CLIENT'S CATEGORY/IP AFFILIATION</th>
                                                    <th colspan="4" style="background-color: #FFBF00;">BENE'S NAME</th>
                                                    <th colspan="3" style="background-color: #FFBF00;">BENE'S AGE/CIVIL STATUS/DATE OF BIRTH</th>
                                                    <th colspan="4" style="background-color: #FFBF00;">BENE'S CATEGORY/SEX</th>
                                                    <th colspan="4" style="background-color: #FFBF00;">BENE'S 4Ps/NHTS DETAILS/IP AFFILIATION</th>
                                                    <th colspan="6" style="background-color: #FFBF00;">BENE'S ADDRESS</th>
                                                    <th colspan="32" style="background-color: #1f91f3;">OTHER DETAILS</th>
                                                </tr>
                                                <tr id="systembaseddb_tr2">
                                                    <th>No._Series</th>
                                                    <!--cl name-->
                                                    <th>Last_Name</th>
                                                    <th>First_Name</th>
                                                    <th>Middle_Name</th>
                                                    <th>Name_Ext.</th>
                                                    <!--cl age-sex-->
                                                    <th>Age</th>
                                                    <th>Civil Status</th>
                                                    <th>Date of Birth</th>
                                                    <th>Sex</th>
                                                    <!--cl address-->
                                                    <th>Purok/St./House_No.</th>
                                                    <th>Barangay</th>
                                                    <th>City/Municipality</th>
                                                    <th>District</th>
                                                    <th>Province</th>
                                                    <th>Region</th>
                                                    <!--cl 4Ps-IPAffiliation-->
                                                    <th>4Ps Member</th>
                                                    <th>4Ps ID No.</th>
                                                    <th>NHTS-PR Identification</th>
                                                    <th>Category</th>
                                                    <th>Subcategory</th>
                                                    <th>Other Subcategory</th>
                                                    <th>IP Affiliation</th>
                                                    <!--bn name-->
                                                    <th>Last_Name</th>
                                                    <th>First_Name</th>
                                                    <th>Middle_Name</th>
                                                    <th>Name_Ext.</th>
                                                    <!--bn age-other subcategory-->
                                                    <th>Age</th>
                                                    <th>Civil Status</th>
                                                    <th>Date of Birth</th>
                                                    <th>Category</th>
                                                    <th>Sex</th>
                                                    <th>Subcategory</th>
                                                    <th>Other Subcategory</th>
                                                    <!--bn 4Ps-IPAffiliation-->
                                                    <th>4Ps Member</th>
                                                    <th>4Ps ID No.</th>
                                                    <th>NHTS-PR Identification</th>
                                                    <th>IP Affiliation</th>
                                                    <!--bn address-->
                                                    <th>Purok/St./House_No.</th>
                                                    <th>Barangay</th>
                                                    <th>City/Municipality</th>
                                                    <th>District</th>
                                                    <th>Province</th>
                                                    <th>Region</th>
                                                    <!--bn relationship-date cancelled-->
                                                    <th>Relationship_of_Cl->Bn</th>
                                                    <th>Assistance</th>
                                                    <th>Amount</th>
                                                    <th>Release_Mode</th>
                                                    <th>Admission_Mode</th>
                                                    <th>Source_of_Fund</th>
                                                    <th>Diagnosis</th>
                                                    <th>Purpose</th>
                                                    <th>Date_Issued</th>
                                                    <th>Interviewer/Social_Work_Officer</th>
                                                    <th>Service_Provider</th>
                                                    <th>Transaction_Code</th>
                                                    <th>DV_Date</th>
                                                    <th>DV_No.</th>
                                                    <th>Charging</th>
                                                    <th>Bill_Receipt_Date</th>
                                                    <th>Transmittal_Date</th>
                                                    <th>Transmittal_Receipt_Date</th>
                                                    <th>Date_Submitted_to_PSD</th>
                                                    <th>Date_Received_from_PSD</th>
                                                    <th>PCV_No.</th>
                                                    <th>CV_No.</th>
                                                    <th>Counseling/Advise_Giving</th>
                                                    <th>Referred_to_other_Agencies</th>
                                                    <th>Provided_w/_Hot_Meals</th>
                                                    <th>Provided_w/_FFPs</th>
                                                    <th>Cancellation</th>
                                                    <th>Branch</th>
                                                    <th>Client_ID_Presented</th>
                                                    <th>Time_In</th>
                                                    <th>Remarks</th>
                                                    <th>Date_Cancelled</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry");
                                                if ($sql->num_rows > 0){
                                                    while($row = mysqli_fetch_assoc($sql)) {

                                                        $id = $row['id_tbl_save_clientbene'];
                                                        //cl name
                                                        $cl_lname = $row['cl_lname']; $cl_fname = $row['cl_fname']; $cl_mname = $row['cl_mname']; $cl_nameext = $row['cl_nameext'];
                                                        //cl age-sex
                                                        $cl_age = $row['cl_age']; $cl_cstatus = $row['cl_cstatus']; $cl_bday = date_format(new DateTime($row['cl_bday']), "m/d/Y"); $cl_sex = $row['cl_sex'];
                                                        //cl address
                                                        $cl_purok = $row['cl_purok']; $cl_brgy = $row['cl_brgy'].'/'.$row['cl_brgy_code']; $cl_mun = $row['cl_mun'].'/'.$row['cl_mun_code']; $cl_prov = $row['cl_prov'].'/'.$row['cl_prov_code']; $cl_district = $row['cl_district']; $cl_region = $row['cl_region'].'/'.$row['cl_region_code'];
                                                        //cl 4Ps-IPAffiliation
                                                        $cl_4Pschoice = $row['cl_4Pschoice']; $cl_4Psnum = $row['cl_4Psnum']; $cl_category = $row['cl_category']; $cl_subcategory = $row['cl_subcategory']; $cl_subcategory2 = $row['cl_subcategory2']; $cl_ipAffiliation = $row['cl_ipAffiliation'];
                                                        //bn name
                                                        $bn_lname = $row['bn_lname']; $bn_fname = $row['bn_fname']; $bn_mname = $row['bn_mname']; $bn_nameext = $row['bn_nameext'];
                                                        //bn age-other subcategory
                                                        $bn_age = $row['bn_age']; $bn_cstatus = $row['bn_cstatus']; $bn_bday = date_format(new DateTime($row['bn_bday']), "m/d/Y"); $bn_category = $row['bn_category']; $bn_sex = $row['bn_sex']; $bn_subcategory = $row['bn_subcategory']; $bn_subcategory2 = $row['bn_subcategory2'];
                                                        //bn 4Ps-IPAffiliation
                                                        $bn_4Pschoice = $row['bn_4Pschoice']; $bn_4Psnum = $row['bn_4Psnum']; $bn_ipAffiliation = $row['bn_ipAffiliation'];
                                                        //bn address
                                                        $bn_purok = $row['bn_purok']; $bn_brgy = $row['bn_brgy'].'/'.$row['bn_brgy_code']; $bn_mun = $row['bn_mun'].'/'.$row['bn_mun_code']; $bn_prov = $row['bn_prov'].'/'.$row['bn_prov_code']; $bn_district = $row['bn_district']; $bn_region = $row['bn_region'].'/'.$row['bn_region_code'];
                                                        //relationship-date cancelled
                                                        $cl_id = $row['cl_id']; $cl_reltobene = $row['cl_reltobene']; $assistance_type = $row['assistance_type']; $amount_fig = number_format($row['amount_in_figures'], 2); $release_mode = $row['release_mode']; $admission_mode = $row['admission_mode']; $fund_source = $row['fund_source'];  $diagnosis = $row['diagnosis']; $purpose = $row['purpose'];
                                                            //time start
                                                        $time_start = date_format(new DateTime($row['time_start']), "h:i A");
                                                            //time end-date issued
                                                        $date_issued = date_format(new DateTime($row['time_end']), "M. d, Y");
                                                            //swo name
                                                        $swo_staffid = $row['swo_staffid'];
                                                            $sql_swo = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$swo_staffid' ");
                                                            $row_swo = mysqli_fetch_assoc($sql_swo);
                                                            $swo = $row_swo['lname'].', '.$row_swo['fname'].' '.$row_swo['mname'].' '.$row_swo['nameext'];
                                                            //sp
                                                        $sp = $row['sp']; $tran_code = $row['transaction_code'];
                                                            //counseling-FFPs
                                                        $psycho_support = $row['psycho_support']; $referral = $row['referral']; $material_assistance = $row['material_assistance'];

                                                        $material_assistance_exp = explode(',', $material_assistance);
                                                        $material_assistance_arrval = array_values($material_assistance_exp);

                                                        $cancellation = $row['cancellation']; $date_cancelled = date_format(new DateTime($row['date_cancelled']), "M. d, Y"); $remarks = $row['remarks'];
                                                        ?>
                                                            <tr 
                                                                <?php
                                                                    if ($cancellation=='YES') {
                                                                        ?> style="background-color: red; color: white;" <?php
                                                                    } else {}
                                                                ?>
                                                            >
                                                                <td><?php echo $id; ?></td>
                                                                <!--cl name-->
                                                                <td><?php echo $cl_lname; ?></td>
                                                                <td><?php echo $cl_fname; ?></td>
                                                                <td><?php echo $cl_mname; ?></td>
                                                                <td><?php echo $cl_nameext; ?></td>
                                                                <!--cl age-sex-->
                                                                <td><?php echo $cl_age; ?></td>
                                                                <td><?php echo $cl_cstatus; ?></td>
                                                                <td><?php echo $cl_bday; ?></th>
                                                                <td><?php echo $cl_sex; ?></td>
                                                                <!--cl address-->
                                                                <td><?php echo $cl_purok; ?></td>
                                                                <td><?php echo $cl_brgy; ?></td>
                                                                <td><?php echo $cl_mun; ?></td>
                                                                <td><?php echo $cl_district; ?></td> 
                                                                <td><?php echo $cl_prov; ?></td>
                                                                <td><?php echo $cl_region; ?></td>
                                                                <!--cl 4Ps-IPAffiliation-->
                                                                <td><?php echo $cl_4Pschoice; ?></td>
                                                                <td><?php echo $cl_4Psnum; ?></td>
                                                                <td>N/A</td>
                                                                <td><?php echo $cl_category; ?></td>
                                                                <td><?php echo $cl_subcategory; ?></td>
                                                                <td><?php echo $cl_subcategory2; ?></td>
                                                                <td><?php echo $cl_ipAffiliation; ?></td>
                                                                <!--bn name-->
                                                                <td><?php echo $bn_lname; ?></td>
                                                                <td><?php echo $bn_fname; ?></td>
                                                                <td><?php echo $bn_mname; ?></td>
                                                                <td><?php echo $bn_nameext; ?></td>
                                                                <!--bn age-other subcategory-->
                                                                <td><?php echo $bn_age; ?></td>
                                                                <td><?php echo $bn_cstatus; ?></td>
                                                                <td><?php echo $bn_bday; ?></td>
                                                                <td><?php echo $bn_category; ?></td>
                                                                <td><?php echo $bn_sex; ?></td>
                                                                <td><?php echo $bn_subcategory; ?></td>
                                                                <td><?php echo $bn_subcategory2; ?></td>
                                                                <!--bn 4Ps-IPAffiliation-->
                                                                <td><?php echo $bn_4Pschoice; ?></td>
                                                                <td><?php echo $bn_4Psnum; ?></td>
                                                                <td>N/A</td>
                                                                <td><?php echo $bn_ipAffiliation; ?></td>
                                                                <!--bn address-->
                                                                <td><?php echo $bn_purok; ?></td>
                                                                <td><?php echo $bn_brgy; ?></td>
                                                                <td><?php echo $bn_mun; ?></td>
                                                                <td><?php echo $bn_district; ?></td>
                                                                <td><?php echo $bn_prov; ?></td>
                                                                <td><?php echo $bn_region; ?></td>
                                                                <!--relationship-date cancelled-->
                                                                <td><?php echo $cl_reltobene; ?></td>
                                                                <td><?php echo $assistance_type; ?></td>
                                                                <td><?php echo $amount_fig; ?></td>
                                                                <td><?php echo $release_mode; ?></td>
                                                                <td><?php echo $admission_mode; ?></td>
                                                                <td><?php echo $fund_source; ?></td>
                                                                <td><?php echo $diagnosis; ?></td>
                                                                <td><?php echo $purpose; ?></td>
                                                                <td><?php echo $date_issued; ?></td>
                                                                <td><?php echo $swo; ?></td>
                                                                <td><?php echo $sp; ?></td>
                                                                <td><?php echo $tran_code; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <?php
                                                                        if (!empty($psycho_support)) {
                                                                            ?> <p>YES</p> <?php
                                                                        } else {
                                                                            ?> <p>NO</p> <?php
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if ((!empty($referral)||($referral=='N/A')||($referral=='n/a'))) {
                                                                            ?> <p>YES</p> <?php
                                                                        } else {
                                                                            ?> <p>NO</p> <?php
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>NO</td>
                                                                <td>
                                                                    <?php
                                                                        $count = count($material_assistance_arrval)-1;
                                                                        //Loop through each array index
                                                                        for($i = 0; $i <= $count; $i++) {
                                                                            //Assign the value of the array key to a variable
                                                                            $value = $material_assistance_arrval[$i];
                                                                            //Check if result string contains diam-mm
                                                                            if ($value == 'Family Food Packs'){
                                                                                ?> <p>YES</p> <?php
                                                                            } else {}
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $cancellation; ?></td>
                                                                <td>SWAD-SDN2</td>
                                                                <td><?php echo $cl_id; ?></td>
                                                                <td><?php echo $time_start; ?></td>
                                                                <td><?php echo $remarks; ?></td>
                                                                <td>
                                                                    <?php if ($row['date_cancelled']!='0000-00-00') {
                                                                        echo $date_cancelled;
                                                                        } else { } 
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
                                <!-- all clients served manual
                                <div id="all_clients_served_manual" class="tab-pane fade in">
                                    <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;"><br>
                                        <label style="float: left;">NOTE: CLICK BUTTON BELOW TO DOWNLOAD LIST IN EXCEL FILE.</label>
                                        <table class="table table-bordered table-striped table-hover clientq2 search_clients dataTable text-left">
                                            <thead style="color: white;">
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4" style="background-color: green;">CLIENT'S NAME</th>
                                                    <th colspan="2" style="background-color: green;">CLIENT'S AGE/CAT.</th>
                                                    <th colspan="6" style="background-color: green;">CLIENT'S ADDRESS</th>
                                                    <th colspan="4" style="background-color: #FFBF00;;">BENE'S NAME</th>
                                                    <th colspan="2" style="background-color: #FFBF00;;">BENE'S AGE/CAT.</th>
                                                    <th colspan="6" style="background-color: #FFBF00;;">BENE'S ADDRESS</th>
                                                    <th colspan="13" style="background-color: #1f91f3;">OTHER DETAILS</th>
                                                </tr>
                                                <tr id="manualdb_tr2">
                                                    <th>Case_Number</th>
                                                    <th>Last_Name</th>
                                                    <th>First_Name</th>
                                                    <th>Middle_Name</th>
                                                    <th>Name_Ext.</th>
                                                    <th>Client's_Age</th>
                                                    <th>Client_Cat.</th>
                                                    <th>Purok/St./House_No.</th>
                                                    <th>Barangay</th>
                                                    <th>City/Municipality</th>
                                                    <th>Province</th>
                                                    <th>District</th>
                                                    <th>Region</th>
                                                    <th>Last_Name</th>
                                                    <th>First_Name</th>
                                                    <th>Middle_Name</th>
                                                    <th>Name_Ext.</th>
                                                    <th>Bene's_Age</th>
                                                    <th>Bene_Cat.</th>
                                                    <th>Purok/St./House_No.</th>
                                                    <th>Barangay</th>
                                                    <th>City/Municipality</th>
                                                    <th>Province</th>
                                                    <th>District</th>
                                                    <th>Region</th>
                                                    <th>Relationship</th>
                                                    <th>Assistance</th>
                                                    <th>Purpose</th>
                                                    <th>Amount</th>
                                                    <th>Service_Provider</th>
                                                    <th>Admission_Mode</th>
                                                    <th>Source_of_Fund</th>
                                                    <th>Date_Issued</th>
                                                    <th>Transaction_Code</th>
                                                    <th>Interviewer/Social_Work_Officer</th>
                                                    <th>Cancellation</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql2 = mysqli_query($conn, "SELECT * FROM tbl_manual_db2023 ORDER BY case_number");
                                                if ($sql2->num_rows > 0){
                                                    while($row2 = mysqli_fetch_assoc($sql2)) {
                                                        //case number
                                                        $case_num2 = $row2['case_number'];
                                                        //cl name
                                                        $cl_lname2 = $row2['cl_lname']; $cl_fname2 = $row2['cl_fname']; $cl_mname2 = $row2['cl_mname']; $cl_nameext2 = $row2['cl_nameext'];
                                                        //cl age & category
                                                        $cl_age2 = $row2['cl_age']; $cl_category2 = $row2['cl_category'];
                                                        //cl address
                                                        $cl_purok2 = $row2['cl_purok']; $cl_brgy2 = $row2['cl_brgy']; $cl_mun2 = $row2['cl_mun']; $cl_prov2 = $row2['cl_prov']; $cl_district2 = $row2['cl_district']; $cl_region2 = $row2['cl_region'];
                                                        //bn name
                                                        $bn_lname2 = $row2['bn_lname']; $bn_fname2 = $row2['bn_fname']; $bn_mname2 = $row2['bn_mname']; $bn_nameext2 = $row2['bn_nameext'];
                                                        //bn age & category
                                                        $bn_age2 = $row2['bn_age']; $bn_category2 = $row2['bn_category'];
                                                        //bn address
                                                        $bn_purok2 = $row2['bn_purok']; $bn_brgy2 = $row2['bn_brgy']; $bn_mun2 = $row2['bn_mun']; $bn_prov2 = $row2['bn_prov']; $bn_district2 = $row2['bn_district']; $bn_region2 = $row2['bn_region'];
                                                        //other details
                                                        $relationship2 = $row2['relationship'];$assistance_type2 = $row2['assistance_type']; $purpose2 = $row2['purpose']; $amount_fig2 = $row2['assistance_amt'];
                                                        $sp2 = $row2['sp']; $admission_mode2 = $row2['admission_mode']; $fund_source2 = $row2['fund_source'];
                                                        $date_issued2 = $row2['date_issued'];
                                                        $tran_code2 = $row2['transaction_code'];  $cancellation2 = $row2['cancellation']; $remarks2 = $row2['remarks'];
                                                        $swo2 = $row2['swo'];
                                                        ?>
                                                            <tr 
                                                                <?php
                                                                    if ($cancellation2=='YES') {
                                                                        ?> style="background-color: red; color: white;" <?php
                                                                    } else {}
                                                                ?>
                                                            >
                                                                <td><?php echo $case_num2; ?></td>
                                                                <td><?php echo $cl_lname2; ?></td>
                                                                <td><?php echo $cl_fname2; ?></td>
                                                                <td><?php echo $cl_mname2; ?></td>
                                                                <td><?php echo $cl_nameext2; ?></td>
                                                                <td><?php echo $cl_age2; ?></td>
                                                                <td><?php echo $cl_category2; ?></td>
                                                                <td><?php echo $cl_purok2; ?></td>
                                                                <td><?php echo $cl_brgy2; ?></td>
                                                                <td><?php echo $cl_mun2; ?></td>
                                                                <td><?php echo $cl_prov2; ?></td>
                                                                <td><?php echo $cl_district2; ?></td>
                                                                <td><?php echo $cl_region2; ?></td>
                                                                <td><?php echo $bn_lname2; ?></td>
                                                                <td><?php echo $bn_fname2; ?></td>
                                                                <td><?php echo $bn_mname2; ?></td>
                                                                <td><?php echo $bn_nameext2; ?></td>
                                                                <td><?php echo $bn_age2; ?></td>
                                                                <td><?php echo $bn_category2; ?></td>
                                                                <td><?php echo $bn_purok2; ?></td>
                                                                <td><?php echo $bn_brgy2; ?></td>
                                                                <td><?php echo $bn_mun2; ?></td>
                                                                <td><?php echo $bn_prov2; ?></td>
                                                                <td><?php echo $bn_district2; ?></td>
                                                                <td><?php echo $bn_region2; ?></td>
                                                                <td><?php echo $relationship2; ?></td>
                                                                <td><?php echo $assistance_type2; ?></td>
                                                                <td><?php echo $purpose2; ?></td>
                                                                <td><?php echo $amount_fig2; ?></td>
                                                                <td><?php echo $sp2; ?></td>
                                                                <td><?php echo $admission_mode2; ?></td>
                                                                <td><?php echo $fund_source2; ?></td>
                                                                <td><?php echo $date_issued2; ?></td>
                                                                <td><?php echo $tran_code2; ?></td>
                                                                <td><?php echo $swo2; ?></td>
                                                                <td><?php echo $cancellation2; ?></td>
                                                                <td><?php echo $remarks2; ?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                } else {

                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>    
                                </div> -->
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
            // SYSTEM-BASED DB Setup - add a text input to each footer cell
            $('.clientq thead tr#systembaseddb_tr2')
                .clone(true)
                .addClass('filters_clientq')
                .appendTo('.clientq thead');
         
            var table_clientq = $('.clientq').DataTable({
                responsive: true,
                buttons: [
                    'excelHtml5'
                ],
                search: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All'],
                ],
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function () {
                    var api = this.api();
         
                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters_clientq th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
         
                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters_clientq th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
         
                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();
         
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });

            // MANUAL DB Setup - add a text input to each footer cell
            $('.clientq2 thead tr#manualdb_tr2')
                .clone(true)
                .addClass('filters')
                .appendTo('.clientq2 thead');
         
            var table = $('.clientq2').DataTable({
                responsive: true,
                buttons: [
                    'excelHtml5'
                ],
                search: true,
                pagination: true,
                pageLength: 10,
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function () {
                    var api = this.api();
         
                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
         
                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
         
                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();
         
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });

            var table = $('.clientq').DataTable();
            $('.clientq tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                $("#cl_qn2").val(data[0]);
                console.log(data[0]);
                $("#release_mode").val(data[46]);
                console.log(data[46]);
            });
        });
    </script>

</body>
</html>