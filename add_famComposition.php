<?php
    // Start the session
    session_start();
    $_SESSION['qn'];
    include 'config.php';

    $sql_sysname = mysqli_query($conn,"SELECT * FROM tbl_system_name WHERE system_id = 1 ");
    $row_sysname = mysqli_fetch_assoc($sql_sysname);
    $sys_acronym = $row_sysname['system_acronym']; $sysname = $row_sysname['system_name'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $roww = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Family Composition</title>
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
                <a class="navbar-brand" href="home_verifier.php" title="Homepage" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Verifier Level</a>
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
                    $sql = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$roww['staffid']."'");
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $row['fname'].' '.substr($row['mname'],0,1).'. '.$row['lname'].' '.$row['nameext']; ?>
                    </div>
                    <div class="email"><?php echo $row['uname']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <span class="glyphicon glyphicon-log-out"><a href="logout.php" style="color: darkblue;"></span> Sign Out</a></span>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li>
                        <a href="home_verifier.php">
                            <span class="glyphicon glyphicon-home"></span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="search_clientV.php">
                            <span class="glyphicon glyphicon-search"></span>
                            <span>Search Clients</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="add_famComposition.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span>Add Family Composition</span>
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
        <?php
            //famMember session
            $_SESSION['lname1'] = $_SESSION['fname1'] = $_SESSION['mname1'] = $_SESSION['nameext1'] = $_SESSION['reltobene1'] = $_SESSION['bday1'] = $_SESSION['age1'] = $_SESSION['occupation1'] = $_SESSION['salary1'] = "";
            $_SESSION['lname2'] = $_SESSION['fname2'] = $_SESSION['mname2'] = $_SESSION['nameext2'] = $_SESSION['reltobene2'] = $_SESSION['bday2'] = $_SESSION['age2'] = $_SESSION['occupation2'] = $_SESSION['salary2'] = "";
            $_SESSION['lname3'] = $_SESSION['fname3'] = $_SESSION['mname3'] = $_SESSION['nameext3'] = $_SESSION['reltobene3'] = $_SESSION['bday3'] = $_SESSION['age3'] = $_SESSION['occupation3'] = $_SESSION['salary3'] = "";
            $_SESSION['lname4'] = $_SESSION['fname4'] = $_SESSION['mname4'] = $_SESSION['nameext4'] = $_SESSION['reltobene4'] = $_SESSION['bday4'] = $_SESSION['age4'] = $_SESSION['occupation4'] = $_SESSION['salary4'] = "";
            $_SESSION['lname5'] = $_SESSION['fname5'] = $_SESSION['mname5'] = $_SESSION['nameext5'] = $_SESSION['reltobene5'] = $_SESSION['bday5'] = $_SESSION['age5'] = $_SESSION['occupation5'] = $_SESSION['salary5'] = "";
            $_SESSION['lname6'] = $_SESSION['fname6'] = $_SESSION['mname6'] = $_SESSION['nameext6'] = $_SESSION['reltobene6'] = $_SESSION['bday6'] = $_SESSION['age6'] = $_SESSION['occupation6'] = $_SESSION['salary6'] = "";
            $_SESSION['lname7'] = $_SESSION['fname7'] = $_SESSION['mname7'] = $_SESSION['nameext7'] = $_SESSION['reltobene7'] = $_SESSION['bday7'] = $_SESSION['age7'] = $_SESSION['occupation7'] = $_SESSION['salary7'] = "";
            $_SESSION['table_num'] = $_SESSION['assistance_type'] = $_SESSION['remarks'] = "";
            
            //famMember error
            $lname1Err = $fname1Err = $mname1Err = $nameext1Err = $reltobene1Err = $bday1Err = $age1Err = $occupation1Err = $salary1Err = "";
            $lname2Err = $fname2Err = $mname2Err = $nameext2Err = $reltobene2Err = $bday2Err = $age2Err = $occupation2Err = $salary2Err = "";
            $lname3Err = $fname3Err = $mname3Err = $nameext3Err = $reltobene3Err = $bday3Err = $age3Err = $occupation3Err = $salary3Err = "";
            $lname4Err = $fname4Err = $mname4Err = $nameext4Err = $reltobene4Err = $bday4Err = $age4Err = $occupation4Err = $salary4Err = "";
            $lname5Err = $fname5Err = $mname5Err = $nameext5Err = $reltobene5Err = $bday5Err = $age5Err = $occupation5Err = $salary5Err = "";
            $lname6Err = $fname6Err = $mname6Err = $nameext6Err = $reltobene6Err = $bday6Err = $age6Err = $occupation6Err = $salary6Err = "";
            $lname7Err = $fname7Err = $mname7Err = $nameext7Err = $reltobene7Err = $bday7Err = $age7Err = $occupation7Err = $salary7Err = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION['lname1'] = mysqli_real_escape_string($conn, test_input($_POST['lname1']));
                $_SESSION['fname1'] = mysqli_real_escape_string($conn, test_input($_POST['fname1']));
                $_SESSION['mname1'] = mysqli_real_escape_string($conn, test_input($_POST['mname1']));
                $_SESSION['nameext1'] = mysqli_real_escape_string($conn, test_input($_POST['nameext1']));
                $_SESSION['reltobene1'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene1']));
                $_SESSION['bday1'] = mysqli_real_escape_string($conn, test_input($_POST['bday1']));
                $_SESSION['age1'] = mysqli_real_escape_string($conn, test_input($_POST['age1']));
                $_SESSION['occupation1'] = mysqli_real_escape_string($conn, test_input($_POST['occupation1']));
                $_SESSION['salary1'] = mysqli_real_escape_string($conn, test_input($_POST['salary1']));

                $_SESSION['lname2'] = mysqli_real_escape_string($conn, test_input($_POST['lname2']));
                $_SESSION['fname2'] = mysqli_real_escape_string($conn, test_input($_POST['fname2']));
                $_SESSION['mname2'] = mysqli_real_escape_string($conn, test_input($_POST['mname2']));
                $_SESSION['nameext2'] = mysqli_real_escape_string($conn, test_input($_POST['nameext2']));
                $_SESSION['reltobene2'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene2']));
                $_SESSION['bday2'] = mysqli_real_escape_string($conn, test_input($_POST['bday2']));
                $_SESSION['age2'] = mysqli_real_escape_string($conn, test_input($_POST['age2']));
                $_SESSION['occupation2'] = mysqli_real_escape_string($conn, test_input($_POST['occupation2']));
                $_SESSION['salary2'] = mysqli_real_escape_string($conn, test_input($_POST['salary2']));

                $_SESSION['lname3'] = mysqli_real_escape_string($conn, test_input($_POST['lname3']));
                $_SESSION['fname3'] = mysqli_real_escape_string($conn, test_input($_POST['fname3']));
                $_SESSION['mname3'] = mysqli_real_escape_string($conn, test_input($_POST['mname3']));
                $_SESSION['nameext3'] = mysqli_real_escape_string($conn, test_input($_POST['nameext3']));
                $_SESSION['reltobene3'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene3']));
                $_SESSION['bday3'] = mysqli_real_escape_string($conn, test_input($_POST['bday3']));
                $_SESSION['age3'] = mysqli_real_escape_string($conn, test_input($_POST['age3']));
                $_SESSION['occupation3'] = mysqli_real_escape_string($conn, test_input($_POST['occupation3']));
                $_SESSION['salary3'] = mysqli_real_escape_string($conn, test_input($_POST['salary3']));

                $_SESSION['lname4'] = mysqli_real_escape_string($conn, test_input($_POST['lname4']));
                $_SESSION['fname4'] = mysqli_real_escape_string($conn, test_input($_POST['fname4']));
                $_SESSION['mname4'] = mysqli_real_escape_string($conn, test_input($_POST['mname4']));
                $_SESSION['nameext4'] = mysqli_real_escape_string($conn, test_input($_POST['nameext4']));
                $_SESSION['reltobene4'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene4']));
                $_SESSION['bday4'] = mysqli_real_escape_string($conn, test_input($_POST['bday4']));
                $_SESSION['age4'] = mysqli_real_escape_string($conn, test_input($_POST['age4']));
                $_SESSION['occupation4'] = mysqli_real_escape_string($conn, test_input($_POST['occupation4']));
                $_SESSION['salary4'] = mysqli_real_escape_string($conn, test_input($_POST['salary4']));

                $_SESSION['lname5'] = mysqli_real_escape_string($conn, test_input($_POST['lname5']));
                $_SESSION['fname5'] = mysqli_real_escape_string($conn, test_input($_POST['fname5']));
                $_SESSION['mname5'] = mysqli_real_escape_string($conn, test_input($_POST['mname5']));
                $_SESSION['nameext5'] = mysqli_real_escape_string($conn, test_input($_POST['nameext5']));
                $_SESSION['reltobene5'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene5']));
                $_SESSION['bday5'] = mysqli_real_escape_string($conn, test_input($_POST['bday5']));
                $_SESSION['age5'] = mysqli_real_escape_string($conn, test_input($_POST['age5']));
                $_SESSION['occupation5'] = mysqli_real_escape_string($conn, test_input($_POST['occupation5']));
                $_SESSION['salary5'] = mysqli_real_escape_string($conn, test_input($_POST['salary5']));
                
                $_SESSION['lname6'] = mysqli_real_escape_string($conn, test_input($_POST['lname6']));
                $_SESSION['fname6'] = mysqli_real_escape_string($conn, test_input($_POST['fname6']));
                $_SESSION['mname6'] = mysqli_real_escape_string($conn, test_input($_POST['mname6']));
                $_SESSION['nameext6'] = mysqli_real_escape_string($conn, test_input($_POST['nameext6']));
                $_SESSION['reltobene6'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene6']));
                $_SESSION['bday6'] = mysqli_real_escape_string($conn, test_input($_POST['bday6']));
                $_SESSION['age6'] = mysqli_real_escape_string($conn, test_input($_POST['age6']));
                $_SESSION['occupation6'] = mysqli_real_escape_string($conn, test_input($_POST['occupation6']));
                $_SESSION['salary6'] = mysqli_real_escape_string($conn, test_input($_POST['salary6']));
                
                $_SESSION['lname7'] = mysqli_real_escape_string($conn, test_input($_POST['lname7']));
                $_SESSION['fname7'] = mysqli_real_escape_string($conn, test_input($_POST['fname7']));
                $_SESSION['mname7'] = mysqli_real_escape_string($conn, test_input($_POST['mname7']));
                $_SESSION['nameext7'] = mysqli_real_escape_string($conn, test_input($_POST['nameext7']));
                $_SESSION['reltobene7'] = mysqli_real_escape_string($conn, test_input($_POST['reltobene7']));
                $_SESSION['bday7'] = mysqli_real_escape_string($conn, test_input($_POST['bday7']));
                $_SESSION['age7'] = mysqli_real_escape_string($conn, test_input($_POST['age7']));
                $_SESSION['occupation7'] = mysqli_real_escape_string($conn, test_input($_POST['occupation7']));
                $_SESSION['salary7'] = mysqli_real_escape_string($conn, test_input($_POST['salary7']));
                
                $_SESSION['table_num'] = mysqli_real_escape_string($conn, test_input($_POST['table_num']));
                $_SESSION['assistance_type'] = mysqli_real_escape_string($conn, test_input($_POST['assistance_type']));
                $_SESSION['remarks'] = mysqli_real_escape_string($conn, test_input($_POST['remarks']));
                
                header("location: insert_famComposition.php");
            }
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
        ?>
    <div class="container-fluid" style="margin-top: -30px;">
    <div class="row clearfix">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right" style="bottom: 1; right: 0;">
                <div class="card col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="tab-content text-center" style="margin-top: 10px; overflow-y: auto; margin: -1px;">
                                <!-- add client -->
                                <div class="container-fluid" style="opacity: 0.9;">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h2 class="text-center" style="color: darkblue;">GENERAL INTAKE SHEET</h2>
                                            <i><b>Note:</b> (<span style="color: red;">*</span>) sign denotes a required field!</i><hr>
                                        </div>
                                    </div>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                        <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-align: left;">III: BENEFICIARY'S FAMILY COMPOSITION</h4>
                                        <div class="row">
                                            <div id="div-table" class="col-sm-12">
                                                <p style="text-align: left; font-size: 14px; font-weight: bold;">Does the beneficiary have other family member/s?</p>
                                                <ul>
                                                    <li><p style="text-align: left; font-size: 14px;">If YES, please enter a maximum of 7 members only.</p></li>
                                                    <li><p style="text-align: left; font-size: 14px;">If NO, please click all Delete (X) buttons.</p></li>
                                                </ul>
                                                </p>
                                                <table style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Last Name</th>
                                                            <th>First Name</th>
                                                            <th>Middle Name</th>
                                                            <th>Name Ext.</th>
                                                            <th>Relationship to Beneficiary</th>
                                                            <th>Birthdate</th>
                                                            <th>Age</th>
                                                            <th>Occupation</th>
                                                            <th>Monthly Salary</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        <tr id="tbodyrow1" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname1" placeholder="1) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname1" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname1" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext1">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene1" name="reltobene1">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday1" name="bday1" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age1" name="age1" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation1" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary1">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow1" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="tbodyrow2" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname2" placeholder="2) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname2" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname2" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext2">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene2" name="reltobene2">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday2" name="bday2" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age2" name="age2" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation2" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary2">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow2" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="tbodyrow3" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname3" placeholder="3) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname3" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname3" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext3">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene3" name="reltobene3">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday3" name="bday3" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age3" name="age3" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation3" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary3">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow3" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="tbodyrow4" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname4" placeholder="4) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname4" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname4" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext4">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene4" name="reltobene4">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday4" name="bday4" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age4" name="age4" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation4" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary4">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow4" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="tbodyrow5" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname5" placeholder="5) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname5" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname5" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext5">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene5" name="reltobene5">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday5" name="bday5" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age5" name="age5" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation5" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary5">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow5" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="tbodyrow6" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname6" placeholder="6) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname6" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname6" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext6">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene6" name="reltobene6">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday6" name="bday6" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age6" name="age6" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation6" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary6">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow6" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr id="tbodyrow7" style="width: 100%;">
                                                            <td>
                                                                <input type="text" class="form-control" name="lname7" placeholder="7) Last Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="fname7" placeholder="First Name" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="mname7" placeholder="Middle Name">
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="nameext7">
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
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" id="reltobene7" name="reltobene7">
                                                                    <!-- Direct Family -->
                                                                    <option>Husband</option>
                                                                    <option>Wife</option>
                                                                    <option>Father</option>
                                                                    <option>Mother</option>
                                                                    <option>Son</option>
                                                                    <option>Daughter</option>
                                                                    <option>Brother</option>
                                                                    <option>Sister</option>
                                                                    <option>Uncle</option>
                                                                    <option>Aunt</option>
                                                                    <option>Nephew</option>
                                                                    <option>Niece</option>
                                                                    <option>Grandfather</option>
                                                                    <option>Grandmother</option>
                                                                    <option>Grandson</option>
                                                                    <option>Granddaughter</option>
                                                                    <option>1st Cousin</option>
                                                                    <option>2nd Cousin</option>
                                                                    <option>3rd Cousin</option>
                                                                    <!-- In-Laws -->
                                                                    <option>Father-in-Law</option>
                                                                    <option>Mother-in-Law</option>
                                                                    <option>Son-in-Law</option>
                                                                    <option>Daughter-in-Law</option>
                                                                    <option>Brother-in-Law</option>
                                                                    <option>Sister-in-Law</option>
                                                                    <option>Uncle-in-Law</option>
                                                                    <option>Aunt-in-Law</option>
                                                                    <option>Nephew-in-Law</option>
                                                                    <option>Niece-in-Law</option>
                                                                    <option>Grandfather-in-Law</option>
                                                                    <option>Grandmother-in-Law</option>
                                                                    <option>Grandson-in-Law</option>
                                                                    <option>Granddaughter-in-Law</option>
                                                                    <option>1st Cousin-in-Law</option>
                                                                    <option>2nd Cousin-in-Law</option>
                                                                    <option>3rd Cousin-in-Law</option>
                                                                    <!-- Common-Laws -->
                                                                    <option>Common-Law Husband</option>
                                                                    <option>Common-Law Wife</option>
                                                                    <option>Common-Law Father</option>
                                                                    <option>Common-Law Mother</option>
                                                                    <option>Common-Law Brother</option>
                                                                    <option>Common-Law Sister</option>
                                                                    <option>Common-Law Uncle</option>
                                                                    <option>Common-Law Aunt</option>
                                                                    <option>Common-Law Nephew</option>
                                                                    <option>Common-Law Niece</option>
                                                                    <option>Common-Law Grandfather</option>
                                                                    <option>Common-Law Grandmother</option>
                                                                    <option>Common-Law Grandson</option>
                                                                    <option>Common-Law Granddaughter</option>
                                                                    <option>Common-Law 1st Cousin</option>
                                                                    <option>Common-Law 2nd Cousin</option>
                                                                    <option>Common-Law 3rd Cousin</option>
                                                                    <!-- Steps -->
                                                                    <option>Step Father</option>
                                                                    <option>Step Mother</option>
                                                                    <option>Step Son</option>
                                                                    <option>Step Daughter</option>
                                                                    <option>Step Brother</option>
                                                                    <option>Step Sister</option>
                                                                    <option>Step Uncle</option>
                                                                    <option>Step Aunt</option>
                                                                    <option>Step Nephew</option>
                                                                    <option>Step Niece</option>
                                                                    <option>Step Grandfather</option>
                                                                    <option>Step Grandmother</option>
                                                                    <option>Step Grandson</option>
                                                                    <option>Step Granddaughter</option>
                                                                    <!-- Others -->
                                                                    <option>Other Relative</option>
                                                                    <option>Friend</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="bday7" name="bday7" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="number" maxlength="2" class="form-control" id="age7" name="age7" placeholder="Click here to show Age" required autofocus>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="occupation7" placeholder="Occupation" required autofocus>
                                                            </td>
                                                            <td>
                                                                <select class="form-control addform-control" name="salary7">
                                                                    <option>N/A</option>
                                                                    <option>P5,000 and below</option>
                                                                    <option>P5,001 - P10,000</option>
                                                                    <option>P10,001 - P15,000</option>
                                                                    <option>P15,001 - P20,000</option>
                                                                    <option>P20,001 - P25,000</option>
                                                                    <option>P25,001 - P30,000</option>
                                                                    <option>P30,001 - P35,000</option>
                                                                    <option>P35,001 - P40,000</option>
                                                                    <option>P40,001 - P45,000</option>
                                                                    <option>P45,001 - P50,000</option>
                                                                    <option>P50,001 - P60,000</option>
                                                                    <option>P60,001 - P70,000</option>
                                                                    <option>P70,001 - P80,000</option>
                                                                    <option>P80,001 - P90,000</option>
                                                                    <option>P90,001 - P100,000</option>
                                                                    <option>P100,001 and above</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button id="removeRow7" class="btn btn-block btn-xs bg-red waves-effect" type="button" style="width: auto; top: 0px; margin: auto;">
                                                                    <span class="glyphicon glyphicon-remove" style="color: white;"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table><br>
                                                    <h4 style="margin: auto; padding: 10px 0; color: darkblue; text-align: left;">IV: CLIENT'S TABLE ASSIGNMENT</h4>
                                                    <!-- Assign client to SW -->
                                                    <div class="row clearfix">
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                            <div class="form-group form-float" style="text-align: left;">
                                                                <div class="form-line">
                                                                    <label>Assign client to:</label>
                                                                    <select class="form-control" id="table_num" name="table_num">
                                                                        <?php
                                                                            $sql = mysqli_query($conn, "SELECT * FROM tbl_sw_table INNER JOIN tbl_staffs ON tbl_sw_table.staffid2 = tbl_staffs.staffid");
                                                                            if ($sql->num_rows > 0) {
                                                                                while($row = mysqli_fetch_array($sql)){
                                                                                    $table_num = $row['table_num']; 
                                                                                    $table_swo = $row['lname'].', '.$row['fname'].' '.$row['nameext'].' '.$row['mname'];
                                                                                    ?>
                                                                                    <option value="<?php echo $table_num; ?>">Table <?php echo $table_num.' - '.$table_swo; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                            <div class="form-group form-float" style="text-align: left;">
                                                                <div class="form-line">
                                                                    <label>Client seeks assistance for:</label>
                                                                    <select class="form-control" id="assistance_type" name="assistance_type">
                                                                        <?php
                                                                            $sql = mysqli_query($conn, "SELECT * FROM tbl_assistance");
                                                                            if ($sql->num_rows > 0) {
                                                                                while($row = mysqli_fetch_array($sql)){
                                                                                    $assistance_type = $row['assistance_type'];
                                                                                    $assistance_purpose = $row['assistance_purpose'];
                                                                                    ?>
                                                                                    <option><?php echo $assistance_type.' - '.$assistance_purpose; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                                            <div class="form-group form-float" style="text-align: left;">
                                                                <div class="form-line">
                                                                    <label>Kindly Type Your Remarks Below: (Exclude SCs/PWDs for Priority Remarks.)<span style="color: red; font-size: 14px;">*</span></label>
                                                                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Ex. Priority - Pregnant - For Case Study" required autofocus>
                                                                </div>
                                                            </div>
                                                            <div style="text-align: left; font-size: 14px; margin-top: -25px;">
                                                                <p style="font-weight: bold;">Examples (Just Copy & Paste or Type Appropriate Remarks):</p>
                                                                <p>N/A</p>
                                                                <p>For Case Study</p>
                                                                <p>Priority - Pregnant</p>
                                                                <p>Priority - Lactating Woman</p>
                                                                <p>Priority - Carrying a Child</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                    <ul class="pager" style="margin: 0px auto 10px;">
                                                        <li class=""><a href="insert_famComposition.php" style="color: white;"><button class="btn btn-block btn-primary waves-effect" type="submit">Submit <span class="fa fa-paper-plane"></button></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <script>
        $(document).ready(function(){

            var d = new Date();
            console.log("new date: "+d);
            var year_now = d.getFullYear();
            var month_now = d.getMonth()+1;
            var date_now = d.getDate();
            console.log("date now: "+date_now);
            //month_now
            if (month_now < 10) {
                month_now = "0"+month_now;
                console.log("month_now: "+month_now);
            } else if (month_now >= 10) {
                month_now = month_now;
                console.log("month_now: "+month_now);
            }
            //date_now
            if (date_now < 10) {
                date_now = "0"+date_now;
                console.log("date_now: "+date_now);
            } else if (date_now >= 10) {
                date_now = date_now;
                console.log("date_now: "+date_now);
            }
            var d2 = year_now+"."+month_now+date_now;


            $("#age1").click(function() {
                var b = new Date($("#bday1").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age1").val(age);   
            });

            $("#age2").click(function() {
                var b = new Date($("#bday2").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age2").val(age);               
            });

            $("#age3").click(function() {
                var b = new Date($("#bday3").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age3").val(age);                
            });

            $("#age4").click(function() {
                var b = new Date($("#bday4").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age4").val(age);                 
            });

            $("#age5").click(function() {
                var b = new Date($("#bday5").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age5").val(age);               
            });

            $("#age6").click(function() {
                var b = new Date($("#bday6").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age6").val(age);               
            });

            $("#age7").click(function() {
                var b = new Date($("#bday7").val());
                console.log("birth date: "+b);
                var year_bday = b.getFullYear();
                var month_bday = b.getMonth()+1;
                var date_bday = b.getDate();
                console.log("date bday: "+date_bday);
                    //month_bday
                    if (month_bday < 10) {
                        month_bday = "0"+month_bday;
                        console.log("month_bday: "+month_bday);
                    } else if (month_bday >= 10) {
                        month_bday = month_bday;
                        console.log("month_bday: "+month_bday);
                    }
                    //date_bday
                    if (date_bday < 10) {
                        date_bday = "0"+date_bday;
                        console.log("date_bday: "+date_bday);
                    } else if (date_bday >= 10) {
                        date_bday = date_bday;
                        console.log("date_bday: "+date_bday);
                    }
                    var b2 = year_bday+"."+month_bday+date_bday;

                var age = Math.trunc(d2-b2); 
                console.log("Age: "+age);        
                $("#age7").val(age);                
            });

            $("#btn-yes").click(function(){
                $("#div-table").show();
                $("#rowquestion").hide();
            });
            $("#removeRow1").click(function(){
                $("#tbodyrow1").remove();
            });
            $("#removeRow2").click(function(){
                $("#tbodyrow2").remove();
            });
            $("#removeRow3").click(function(){
                $("#tbodyrow3").remove();
            });
            $("#removeRow4").click(function(){
                $("#tbodyrow4").remove();
            });
            $("#removeRow5").click(function(){
                $("#tbodyrow5").remove();
            });
            $("#removeRow6").click(function(){
                $("#tbodyrow6").remove();
            });
            $("#removeRow7").click(function(){
                $("#tbodyrow7").remove();
            });
        });
    </script>

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
</body>
</html>