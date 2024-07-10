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
    <title>Import CSV Files</title>
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

        label {
            border-bottom: solid white 1px;
            padding: 5px;
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
                <a class="navbar-brand" href="#" title="Manage Tables - Admin Level" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Administrator Level</a>
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
                    <li class="active">
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
                                    <a href="#manage_sw_table" data-toggle="tab">
                                        <span class="fa fa-upload" style="color: darkblue;"></span> Import CSV Files
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <!-- manage_sw_table -->
                                <div id="manage_sw_table" class="tab-pane fade in active">
                                    <div style="text-align: left; padding: 10px; background-color: #dedede; border-radius: 20px;">
                                        <h4 style="color: red; text-decoration: underline;">IMPORTANT REMINDERS:</h4>
                                        <h5 style="color: red;">To successfully import the downloaded CSV file from the "SO SDN System (MC-CRH)" which contains the data of their served clients, kindly follow the following steps below.</h5>
                                        <label>STEP 1) Open the downloaded csv file from the "SO SDN System (MC-CRH)" first and the "2 other csv files" located in the directory of the system namely the : "tbl_save_clientbene_mccrh.csv" and "tbl_save_addl_entry_mccrh.csv". These 2 CSV files in the directory should be completely empty before proceeding to the next step.</label><br>
                                        <label>STEP 2) In the "MC-CRH csv file", click the "Column A" and drag the cursor until "Column BQ", press "Ctrl+C" to copy the highlighted values, go to the "tbl_save_clientbene_mccrh.csv" file, click the first cell of the very first row and press "Ctrl+V" to paste the copied values.</label><br>
                                        <label>STEP 3) From "Column A" to "Column BQ", the values should be from "id_tbl_save_clientbene" until "time_end", then proceed to "Step 4". If not, please empty that file and follow "Step 2" again.</label><br>
                                        <label>STEP 4) Same with "Step 2" but this time, click the "Column BR" and drag the cursor until "Column CU", press "Ctrl+C", go to the "tbl_save_addl_entry_mccrh.csv" file, click the first cell of the very first row and press "Ctrl+V".</label><br>
                                        <label>STEP 5) From "Column A" to "Column AD", the values should be from "id_tbl_save_addl_entry" until "time_end2", then proceed to "Step 6". If not, please empty that file and follow "Step 4" again.</label><br>
                                        <label>STEP 6) In the "tbl_save_clientbene_mccrh.csv" and "tbl_save_addl_entry_mccrh.csv" files, we should "RE-FORMAT" the columns with date values "first from dd/mm/yyyy" to "yyyy-mm-dd" format for compatibility purposes. Failure to do this would result to dates being imported in the system as "0000-00-00" only, which would also result to "tracking troubles" and "inaccuracy" on generated reports.</label><br>
                                        <label>STEP 7) First, in the "tbl_save_clientbene_mccrh.csv", press and hold "Ctrl" then click Columns "V"(cl_bday), "AY"(bn_bday), "BN"(date_start), "BP"(date_end). After selecting all 4 columns, go to "Number" format in the "Home" tab, click the "dropdown menu" button beside the word "General", select "More Number Formats...", click "Date" under "Category:" and finally select the one with "2012-03-14" or "yyyy-mm-dd" format and click "OK" to proceed.</label><br>
                                        <label>STEP 8) Next, in the "tbl_save_addl_entry_mccrh.csv", press and hold "Ctrl" then click Columns "AA"(date_start2) and "AC"(date_end2). After selecting all 2 columns, go to "Number" format in the "Home" tab, click the "dropdown menu" button beside the word "General", select "More Number Formats...", click "Date" under "Category:" and finally select the one with "2012-03-14" or "yyyy-mm-dd" format and click "OK" to proceed.</label><br>
                                        <label>STEP 9) In your browser, click the shortcut to your "phpMyAdmin's Database", right-click and select "Open link in new the tab" both the tbl_save_clientbene and tbl_save_addl_entry tables. In both newly-opened pages, look for the double right-arrow-heads (>>) and click it to view the last entry. Under the id_tbl_save_clientbene and id_tbl_save_addl_entry, determine the last entered "id" (ex. 3470) and the succeeding IDs to be assigned on the data that you will be importing later.</label><br>
                                        <label>STEP 10) Now, go to the tbl_save_clientbene_mccrh.csv and under id_tbl_save_clientbene, change the first ID by typing the first succeeding ID (ex. 3471) that you determined previously in the "phpMyAdmin's Database". After that, you can now select and delete the whole first row so that it won't be included during import. Don't forget to save the file by pressing "Ctrl+S".</label><br>
                                        <label>STEP 11) Do the same in the tbl_save_addl_entry.csv file.</label><br>
                                        <label>STEP 12) Click the "Import" button below.</label><br>
                                        <label>STEP 13) After importing, review the generated data in the table below.</label><br>
                                        <?php
                                            if (isset($_POST['import_csv_files'])) {
                                                header("location: import_csv_files_to_tables.php");
                                            }
                                        ?>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <h5 style="display: inline-block;">Import CSV Files from MC-CRH to SWAD-SDN2's SO SDN System:</h5>
                                            <button class="btn btn-xs btn-primary waves-effect" name="import_csv_files" type="submit" style="display: inline-block;">
                                                <span class="fa fa-upload"></span> Import
                                            </button>
                                        </form>
                                    </div><hr>
                                    <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                        <h4 style="color: red; text-decoration: underline;">IMPORTED DATA FROM MC-CRH:</h4>
                                        <table class="table table-bordered table-striped table-hover clientq search_clients dataTable text-left">
                                            <thead style="color: white;">
                                                <tr id="systembaseddb_tr2">
                                                    <th class="th_nseries">No._Series</th>
                                                    <!-- 6 CLIENT -->
                                                    <th>Client's_Full_Name</th>
                                                    <th class="th_age">Age</th>
                                                    <th class="th_cstatus">Civil Status</th>
                                                    <th class="th_sex">Sex</th>
                                                    <th class="th_address">Client's_Full_Address</th>
                                                    <th class="th_category">Client_Category</th>
                                                    <!-- 5 BENE -->
                                                    <th>Bene's_Full_Name</th>
                                                    <th class="th_age">Age</th>
                                                    <th class="th_cstatus">Civil Status</th>
                                                    <th class="th_sex">Sex</th>
                                                    <th class="th_category">Bene_Category</th>
                                                    <!-- 12 others -->
                                                    <th class="th_rel">Relationship_Cl-to-Bn</th>
                                                    <th>Assistance_Given</th>
                                                    <th>Amount</th>
                                                    <th>Release_Mode</th>
                                                    <th>Date_Issued</th>
                                                    <th>Service_Provider</th>
                                                    <th>Transaction_Code</th>
                                                    <th>Interviewer/Social_Work_Officer</th>
                                                    <th>Cancellation</th>
                                                    <th>Remarks</th>
                                                    <th>Date_Cancelled</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM tbl_save_clientbene_mccrh INNER JOIN tbl_save_addl_entry_mccrh ON tbl_save_clientbene_mccrh.id_tbl_save_clientbene = tbl_save_addl_entry_mccrh.id_tbl_save_addl_entry");
                                                if ($sql->num_rows > 0){
                                                    $ttl_amt_fig = 0;
                                                    while($row = mysqli_fetch_assoc($sql)) {

                                                        $id1 = $row['id_tbl_save_clientbene'];
                                                            //cl name
                                                        $cl_lname = $row['cl_lname']; $cl_fname = $row['cl_fname']; $cl_mname = ''; $cl_nameext = '';
                                                        if ($row['cl_mname']='N/A') {
                                                            $cl_mname = '';
                                                        } else {
                                                            $cl_mname = $row['cl_mname'];
                                                        }

                                                        if ($row['cl_nameext']='N/A') {
                                                            $cl_nameext = '';
                                                        } else {
                                                            $cl_nameext = $row['cl_nameext'].' ';
                                                        }
                                                            //cl age-cstatus-sex
                                                        $cl_age = $row['cl_age']; $cl_cstatus = $row['cl_cstatus']; $cl_sex = $row['cl_sex'];
                                                            //cl address
                                                        $cl_purok = $row['cl_purok']; $cl_brgy = $row['cl_brgy']; $cl_mun = $row['cl_mun']; $cl_prov = $row['cl_prov']; $cl_district = ''; $cl_region = $row['cl_region'];
                                                        if (empty($row['cl_district'])) {
                                                            $cl_district = '';
                                                        } else {
                                                            $cl_district = $row['cl_district'].', ';
                                                        }
                                                            //cl category
                                                        $cl_category = $row['cl_category'];
                                                            //bn name
                                                        $bn_lname = $row['bn_lname']; $bn_fname = $row['bn_fname']; $bn_mname = ''; $bn_nameext = '';
                                                        if ($row['bn_mname']='N/A') {
                                                            $bn_mname = '';
                                                        } else {
                                                            $bn_mname = $row['bn_mname'];
                                                        }

                                                        if ($row['bn_nameext']='N/A') {
                                                            $bn_nameext = '';
                                                        } else {
                                                            $bn_nameext = $row['bn_nameext'].' ';
                                                        }
                                                            //bn age-category
                                                        $bn_age = $row['bn_age']; $bn_cstatus = $row['bn_cstatus']; $bn_category = $row['bn_category']; $bn_sex = $row['bn_sex'];
                                                        $cl_reltobene = $row['cl_reltobene']; $assistance_type = $row['assistance_type']; $amount_fig = $row['amount_in_figures'];  $release_mode = $row['release_mode']; $purpose = $row['purpose'];
                                                            //time end-date issued
                                                        $date_issued = date_format(new DateTime($row['date_end']), "M. d, Y");
                                                            //swo name
                                                        $swo_staffid = $row['swo_staffid'];
                                                            $sql_swo = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$swo_staffid' ");
                                                            $row_swo = mysqli_fetch_assoc($sql_swo);
                                                            //sp
                                                        $sp = $row['sp']; $tran_code = $row['transaction_code'];

                                                        $cancellation = $row['cancellation']; $date_cancelled = date_format(new DateTime($row['date_cancelled']), "M. d, Y"); $remarks = $row['remarks'];
                                                        $ttl_amt_fig = $ttl_amt_fig + $amount_fig;
                                                        ?>
                                                            <tr 
                                                                <?php
                                                                    if ($cancellation=='YES') {
                                                                        ?> style="background-color: red; color: white;" <?php
                                                                    } else {}
                                                                ?>
                                                            >
                                                                <td><?php echo $id1; ?></td>
                                                                <!--1 cl name-->
                                                                <td><?php echo $cl_lname.', '.$cl_fname.' '.$cl_nameext.''.$cl_mname; ?></td>
                                                                <!--5 cl details-->
                                                                <td><?php echo $cl_age; ?></td>
                                                                <td><?php echo $cl_cstatus; ?></td>
                                                                <td><?php echo $cl_sex; ?></td>
                                                                <td><?php echo $cl_purok.', '.$cl_brgy.', '.$cl_mun.', '.$cl_prov.' '.$cl_district.''.$cl_region; ?></td>
                                                                <td><?php echo $cl_category; ?></td>
                                                                <!--1 bn name-->
                                                                <td><?php echo $bn_lname.', '.$bn_fname.' '.$bn_nameext.''.$bn_mname; ?></td>
                                                                <!--4 bn age-other subcategory-->
                                                                <td><?php echo $bn_age; ?></td>
                                                                <td><?php echo $bn_cstatus; ?></td>
                                                                <td><?php echo $bn_sex; ?></td>
                                                                <td><?php echo $bn_category; ?></td>
                                                                <!--other details-->
                                                                <td><?php echo $cl_reltobene; ?></td>
                                                                <td><?php echo $assistance_type.'-'.$purpose; ?></td>
                                                                <td><?php echo number_format($amount_fig,2); ?></td>
                                                                <td><?php echo $release_mode; ?></td>
                                                                <td><?php echo $date_issued; ?></td>
                                                                <td><?php echo $sp; ?></td>
                                                                <td><?php echo $tran_code; ?></td>
                                                                <td>
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
                                                                </td>
                                                                <td><?php echo $cancellation; ?></td>
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
                                            <tfoot>
                                                <tr>
                                                    <th colspan="14" style="text-align: right;">CURRENT PAGE'S TOTAL AMOUNT >>></th>
                                                    <th></th>
                                                    <th colspan="2" style="text-align: right;">OVERALL TOTAL AMOUNT >>></th>
                                                    <th></th>
                                                    <th colspan="5"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script>
        $(document).ready(function() {
            // SYSTEM-BASED DB Setup - add a text input to each footer cell
            $('.clientq thead tr#systembaseddb_tr2')
                .clone(true)
                .addClass('filters_clientq')
                .appendTo('.clientq thead');
         
            var table_clientq = $('.clientq').DataTable({
                //dom: 'Bfrtip',
                //responsive: true,
                buttons: [
                    'excelHtml5'
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All'],
                ],
                //orderCellsTop: true,
                //fixedHeader: true,
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
                footerCallback: function (row, data, start, end, display) {
                    var api_ttl_amt = this.api();
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
         
                    // Total over all pages
                    total = api_ttl_amt
                        .column(14)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
         
                    // Total over this page
                    pageTotal = api_ttl_amt
                        .column(14, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
         
                    // Update footer
                    //$(api_ttl_amt.column(45).footer()).html(parseFloat(pageTotal.toFixed(2)) + 'current total<br>(' + total.toFixed(2) + ' total)');
                    $(api_ttl_amt.column(14).footer()).html(pageTotal.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                    $(api_ttl_amt.column(17).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                }
            });

            var table = $('.clientq').DataTable();
            $('.clientq tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                $("#cl_qn2").val(data[0]);
                console.log(data[0]);
                $("#release_mode").val(data[15]);
                console.log(data[15]);
            });
        });
    </script>

</body>
</html>