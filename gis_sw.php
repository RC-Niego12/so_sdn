<?php
    // Start the session
    session_start();
    $_SESSION['cl_qn2']; $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    $sql_staff = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' AND uname='".$_SESSION['uname']."' AND pword='".$_SESSION['pword']."' ");
    $roww = mysqli_fetch_assoc($sql_staff);
    if ((!isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==false)) {
        header("Location: index.php");
    }

    $sql = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
    $row = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Initial GIS</title>
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
                <a class="navbar-brand" href="#" title="Initial GIS - SW Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Social Worker Level</a>
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
                    <li>
                        <a href="home_sw.php">
                            <span class="glyphicon glyphicon-home"></span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="gis_sw.php">
                            <span class="fa fa-pencil-square-o"></span>
                            <span>General Intake Sheet</span>
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
                                    <a href="#intake_sheet" data-toggle="tab">
                                        <span class="fa fa-pencil-square-o" style="color: darkblue;"></span> General Intake Sheet
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <?php
                                    if (isset($_POST['proceed_to_data_entry'])) {
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $_SESSION['cl_qn3'] = mysqli_real_escape_string($conn, $_POST['cl_qn']);
                                            $queue_status = "On-going";
                                            $up_sql = mysqli_query($conn, "UPDATE tbl_clientqueue SET queue_status = '$queue_status' WHERE cl_qn = '".$_SESSION['cl_qn3']."' ");
                                            $result = mysqli_query($conn, $up_sql);
                                                if ($result) {
                                                    echo "Client's queueing status updated successfully!";
                                                } else {
                                                    echo "Error: " . $up_sql . "<br>" . $conn->error;
                                                }
                                            header("location: addl_entry_sw.php");
                                        }
                                    }
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                    <input type="text" name="cl_qn" value="<?php echo $_SESSION['cl_qn2'];?>" style="display: none;">
                                    <button class="btn btn-primary bg-darkblue waves-effect" name="proceed_to_data_entry" type="submit" style="position: fixed; top: 145px; z-index: 1;">
                                        Proceed to Data Entry
                                    </button>
                                </form>
                                <!-- intake sheet -->
                                <div id="intake_sheet" class="tab-pane fade in active">
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
                                                        <p class="status-p status-p2">Walk-in</p>
                                                    </div>
                                                    <div class="admission-referral">
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
                                                              <div class="otherinfo-row-input-div7">
                                                                  <?php echo $row['bn_cstatus'];?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div5">
                                                                  <?php echo $row['bn_occupation'];?>
                                                              </div>
                                                              <div class="otherinfo-row-input-div6">
                                                                  <?php echo $row['bn_salary'];?>
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
                                                    $sql2 = mysqli_query($conn,"SELECT * FROM tbl_famcomposition WHERE qn='".$_SESSION['cl_qn2']."' ");
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
                                                                            if (($cl_subcategory!="Solo Parents")&&($cl_subcategory!="Indigenous People")&&($cl_subcategory!="Recovering Person who used drugs")&&($cl_subcategory!="4Ps DSWD Beneficiary")&&($cl_subcategory!="Street Dwellers")&&($cl_subcategory!="Psychosocial/Mental/Learning Disability")&&($cl_subcategory!="Stateless Person/Asylum Seekers/Refugees")&&($cl_subcategory!="KIA/WIA")&&($cl_subcategory!="N/A")) {
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
                                                        <p style="font-size: 12px; line-height: 1; display: inline-flex; overflow-wrap: anywhere;">Assessment:</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-assistance container-fluid">
                                                <div class="assistance-col">
                                                    <p>Financial Assistance:</p>
                                                    <ul>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Medical</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
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
                                                                <p class="list-sub-category-p">Family Food Packs</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Other Food Items</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Hygiene & Sleeping Kits</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
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
                                                                <p class="list-sub-category-p">Psychological First Aid</p>
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-sub-category">
                                                                <p class="list-sub-category-p">Social Work Counseling</p>
                                                                
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="assistance-col" style="left: 659px; width: 136px;">
                                                    <p>Referral:</p>
                                                    <p style="font-size: 9px; overflow-wrap: anywhere;"><u>
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
                                                    <p style="margin-top: -2px;">1) </p>
                                                </div>
                                                <div class="provided-col2">
                                                    <p style="margin-top: -2px;" class="text-center"></p>
                                                </div>
                                                <div class="provided-col3">
                                                    <p style="margin-top: -2px;" class="text-center"></p>
                                                </div>
                                            </div>
                                            <div class="container-provided input2 container-fluid">
                                                <div class="provided-col1">
                                                    <p style="margin-top: -2px;">2) </p>
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
                                                    <p style="margin-top: -2px;">3) </p>
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
                                                              echo strtoupper($roww['fname'])." "; 
                                                              if (empty($roww['mname'])) {
                                                                    echo "";
                                                              } else {
                                                                    echo strtoupper(substr($roww['mname'],0,1)).". ";
                                                              }
                                                              echo strtoupper($roww['lname']);
                                                              if ($roww['nameext'] == "N/A" || $roww['nameext'] == "") {
                                                                    echo "";
                                                              } else {
                                                                    echo ", ".$roww['nameext'];
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
                                </div><!-- end of intake sheet -->
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
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>
</html>