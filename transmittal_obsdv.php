<?php
    // Start the session
    session_start();
    date_default_timezone_set('Asia/Manila'); $datenow = date('d-m-Y');

    $_SESSION['staffid']; $_SESSION['uname']; $_SESSION['pword'];
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
    <title>Transmittal</title>
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
                        <a href="home_billings.php">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="track_GLs.php">
                            <span class="fa fa-file"></span>
                            <span>Track GLs (Step 1)</span>
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
                    <li class="active">
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
                                    <a href="#transmittal" data-toggle="tab">
                                        <span class="fa fa-arrow-circle-o-right"></span> Transmittals
                                    </a>
                                </li>
                                <li>
                                    <a href="#transmitted_obdv" data-toggle="tab">
                                        <span class="fa fa-arrow-circle-o-right" style="color: lightgreen;"></span> Transmitted Vouchers
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" style="margin-top: 0px; overflow-y: auto; margin: -1px;">
                                <div id="transmittal" class="tab-pane fade in active">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <?php
                                            $_SESSION['trml_code2'] = $_SESSION['trml_date2'] = $_SESSION['prep_by2'] = "";
                                            if (isset($_POST['view'])) {
                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                    $_SESSION['trml_code2'] = mysqli_real_escape_string($conn, $_POST['trml_code']);
                                                    $_SESSION['trml_date2'] = mysqli_real_escape_string($conn, $_POST['trml_date']);
                                                    $_SESSION['prep_by2'] = mysqli_real_escape_string($conn, $_POST['prep_by']);
                                                }
                                                //header("location: print_view_transmittal2.php");
                                                header("location: transmittal_view.php");
                                            }
                                        ?>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-4">
                                                <div class="panel-heading panel-title bg-darkblue"> 
                                                    <h5 class="text-center" style="margin: auto; padding: 5px 0; color: white;">Selected Transmittal Code:</h5>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-xs-11">
                                                        <div class="form-group form-float">
                                                            <label style="float: left;">Please click desired row below to get Transmittal Code.</label>
                                                            <div class="form-line">
                                                                <input type="text" class="form-control text-center" id="trml_code" name="trml_code" required autofocus>
                                                                <input type="hidden" class="form-control text-center" id="trml_date" name="trml_date" required autofocus>
                                                                <input type="hidden" class="form-control text-center" id="prep_by" name="prep_by" required autofocus>
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
                                                        <a style="color: white;">
                                                            <button class="btn btn-primary btn-xs btn-block waves-effect" name="view" type="submit">View Transmittal <span class="fa fa-eye"></button>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="transmittal_obsdv.php">
                                                            <button class="btn btn-xs btn-block waves-effect" type="button"><span class="fa fa-refresh"></span> Refresh</button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                        <table class="table table-bordered table-striped table-hover transmittal dataTable text-left">
                                            <thead>
                                                <tr> 
                                                    <th>No.</th>
                                                    <th>Transmittal Code</th>
                                                    <th>Transmittal Date</th>
                                                    <th>Prepared By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql_trml = mysqli_query($conn, "SELECT * FROM tbl_obs_dv_transmittal");
                                                    if ($sql_trml->num_rows > 0){
                                                        while($row_trml = mysqli_fetch_assoc($sql_trml)) {
                                                            $ns = $row_trml['num_ser'];
                                                            $trml_code = $row_trml['transmittal_code'];
                                                            $trml_date = date_format(new DateTime($row_trml['transmittal_date']), "M. d, Y");;
                                                            $prep_by = $row_trml['prep_by'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $ns; ?></td>
                                                                <td>
                                                                    <?php echo $trml_code; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $trml_date; ?> 
                                                                </td>
                                                                <td>
                                                                    <?php echo $prep_by; ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="transmitted_obdv" class="tab-pane fade in">
                                    <div class="table-responsive" style="overflow-x: scroll; font-size: 1em;">
                                        <table class="table table-bordered table-striped table-hover tracked_obdv dataTable text-left" style="width: 100% !important;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th style="width: 126px !important;">OBs & DV Code</th>
                                                    <th style="width: 135px !important;">Included Billing/s</th>
                                                    <th>Service Provider</th>
                                                    <th>Amount</th>
                                                    <th>Prepared By</th>
                                                    <th>Transmittal Date</th>
                                                    <th>Transmittal Code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql_obdv = mysqli_query($conn, "SELECT * FROM tbl_obs_dv");
                                                    $ii=0;
                                                    if ($sql_obdv->num_rows > 0){
                                                        while($row_obdv = mysqli_fetch_assoc($sql_obdv)) {
                                                            $ns = $row_obdv['num_series'];
                                                            $obdv_code = $row_obdv['obs_dv_code'];
                                                            $bill_code = $row_obdv['billing_code'];
                                                            $prep_date = $row_obdv['obs_dv_date'];

                                                            $sql_trml_obdv = mysqli_query($conn, "SELECT * FROM tbl_obs_dv_transmitted WHERE obdv_code2='$obdv_code' ");
                                                            $row_trml_obdv = mysqli_fetch_assoc($sql_trml_obdv);                                                                       
                                                            $trml_obdv_code = $row_trml_obdv['obdv_code2'];   
                                                            $trml_prep_by = $row_trml_obdv['prep_by2'];                                                                 
                                                            $trml_date = $row_trml_obdv['transmittal_date2'];                                                                
                                                            $trml_code = $row_trml_obdv['transmittal_code2'];
                                                            if ($obdv_code == $trml_obdv_code) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $ii+1; $ii++; ?></td>
                                                                    <td><?php echo $obdv_code; ?></td>
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
                                                                    <td><?php echo $count2.': '.$bill_code; ?></td>
                                                                    <td><?php echo $row_tck_sp['sp_name']; ?></td>
                                                                    <td>
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
                                                                    <td><?php echo $trml_prep_by; ?></td>
                                                                    <td><?php echo date_format(new DateTime($trml_date), "M. d, Y"); ?></td>
                                                                    <td><?php echo $trml_code; ?></td>
                                                                </tr>
                                                                <?php
                                                            } else {}
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" style="text-align: right;">TOTAL AMOUNT >>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1" style="text-align: right;">CURRENT<span style="color: #94BFF5;">.</span>PAGE'S<span style="color: #94BFF5;">.</span>TOTAL<span style="color: #94BFF5;">.</span>>>></th>
                                                    <th colspan="1"></th>
                                                    <th colspan="3"></th>
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
            $('[data-toggle="tooltip"]').tooltip();
        });

        var table_trml = $('.transmittal').DataTable({
            //dom: 'Bfrtip',
            //responsive: true,
            searching: true,
            buttons: [
                'excelHtml5'
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ]
        });
        $('.transmittal tbody').on('click', 'tr', function() {
            var data_trml_code = table_trml.row(this).data();
            $("#trml_code").val(data_trml_code[1]);
            console.log(data_trml_code[1]);

            var data_trml_date = table_trml.row(this).data();
            $("#trml_date").val(data_trml_date[2]);
            console.log(data_trml_date[2]);

            var data_prep_by = table_trml.row(this).data();
            $("#prep_by").val(data_prep_by[3]);
            console.log(data_prep_by[3]);
        });

        var table_tracked_obdv = $('.tracked_obdv').DataTable({
            //dom: 'Bfrtip',
            //responsive: true,
            searching: true,
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
                        var cell = $('.filters_tracked_obdv th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters_tracked_obdv th').eq($(api.column(colIdx).header()).index())
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
                    .column(4)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal2 = api_ttl_amt
                    .column(4, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api_ttl_amt.column(2).footer()).html(total.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                $(api_ttl_amt.column(4).footer()).html(pageTotal2.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
            }
        });
    </script>

</body>
</html>