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
    $roww = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Search Clients</title>
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
                <a class="navbar-brand" href="#" title="Search Clients" style="color: white;"><?php echo $sysname.' ('.$sys_acronym.')'; ?>: Verifier Level</a>
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
                        <span class="glyphicon glyphicon-log-out"><a href="logout.php"></span> Sign Out</a></span>
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
                    <li class="active">
                        <a href="search_clientV.php">
                            <span class="glyphicon glyphicon-search"></span>
                            <span>Search Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="add_clientV.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span>Add Client</span>
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
                                            <div class="table-responsive col-sm-12" style="overflow-x: scroll; font-size: 1em;">
                                                <table class="table table-bordered table-striped table-hover clientq search_clients dataTable text-left">
                                                    <thead style="color: white;">
                                                        <tr id="systembaseddb_tr2">
                                                            <th class="th_nseries">No._Series</th>
                                                            <!-- 6 CLIENT -->
                                                            <th>Client's_LName</th>
                                                            <th>Client's_FName</th>
                                                            <th>Client's_MName</th>
                                                            <th>Client's_NameExt</th>
                                                            <th class="th_age">Age</th>
                                                            <th class="th_cstatus">Civil Status</th>
                                                            <th class="th_sex">Sex</th>
                                                            <th>Prk/St/Blk Lt</th>
                                                            <th>Brgy.</th>
                                                            <th>City/Mun</th>
                                                            <th>Province</th>
                                                            <th>Region</th>
                                                            <th class="th_category">Client_Category</th>
                                                            <!-- 5 BENE -->
                                                            <th>Bene's_LName</th>
                                                            <th>Bene's_FName</th>
                                                            <th>Bene's_MName</th>
                                                            <th>Bene's_NameExt</th>
                                                            <th class="th_age">Age</th>
                                                            <th class="th_cstatus">Civil Status</th>
                                                            <th class="th_sex">Sex</th>
                                                            <th class="th_category">Bene_Category</th>
                                                            <!-- 12 others -->
                                                            <th class="th_rel">Relationship_Cl-to-Bn</th>
                                                            <th>Assistance</th>
                                                            <th>Purpose</th>
                                                            <th>Amount</th>
                                                            <th>Assessment</th>
                                                            <th>Release_Mode</th>
                                                            <th>Date_Issued</th>
                                                            <th>Service_Provider</th>
                                                            <th>Transaction_Code</th>
                                                            <th>SWO_LName</th>
                                                            <th>SWO_FName</th>
                                                            <th>SWO_MName</th>
                                                            <th>SWO_NameExt</th>
                                                            <th>Cancellation</th>
                                                            <th>Remarks</th>
                                                            <th>Date_Cancelled</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="25" style="text-align: right;">CURRENT PAGE'S TOTAL AMOUNT >>></th>
                                                            <th></th>
                                                            <th colspan="2" style="text-align: right;">OVERALL TOTAL AMOUNT >>></th>
                                                            <th></th>
                                                            <th colspan="9"></th>
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
    <script src="plugins/jquery-datatable/dataTables.fixedHeader.min.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script>
        $(document).ready(function() {
            // SYSTEM-BASED DB Setup - add a text input to each footer cell
            $('.clientq thead tr#systembaseddb_tr2')
                .clone(true)
                .addClass('filters_clientq')
                .appendTo('.clientq thead');
         
            var table = $('.clientq').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                responsive: true,
                pagination: true,
                orderCellsTop: true,
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, 'All'],
                ],
                buttons: [
                    'excelHtml5'
                ],
                ajax: {
                    url: "data_manage_db.php",
                    type: "POST"
                },
                columns: [
                    { data: 'id_tbl_save_clientbene'},
                    { data: 'cl_lname'},
                    { data: 'cl_fname'},
                    { data: 'cl_mname'},
                    { data: 'cl_nameext'},
                    { data: 'cl_age'},
                    { data: 'cl_cstatus'},
                    { data: 'cl_sex'},
                    { data: 'cl_purok'},
                    { data: 'cl_brgy'},
                    { data: 'cl_mun'},
                    { data: 'cl_prov'},
                    { data: 'cl_region'},
                    { data: 'cl_category'},
                    { data: 'bn_lname'},
                    { data: 'bn_fname'},
                    { data: 'bn_mname'},
                    { data: 'bn_nameext'},
                    { data: 'bn_age'},
                    { data: 'bn_cstatus'},
                    { data: 'bn_sex'},
                    { data: 'bn_category'},
                    { data: 'cl_reltobene'},
                    { data: 'assistance_type'},
                    { data: 'purpose'},
                    { data: 'amt_fig'},
                    { data: 'assessment'},
                    { data: 'release_mode'},
                    { data: 'date_issued'},
                    { data: 'sp'},
                    { data: 'transaction_code'},
                    { data: 'lname'},
                    { data: 'fname'},
                    { data: 'mname'},
                    { data: 'nameext'},
                    { data: 'cancellation'},
                    { data: 'remarks'},
                    { data: 'date_cancelledd'}
                ],
                rowCallback: function(row, data) {
                    // Example condition: Color rows where age > 50
                    if (data.cancellation == 'YES') {
                        $(row).css('background-color', 'red');
                        $(row).css('color', 'white');
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    // Example condition: Add input field to "salary" column where age > 50
                    if (data.assessment) {
                        $('td', row).eq(26).html('<input type="text" value="' + data.assessment + '">');
                    }
                },
                initComplete: function () {
                    var api = this.api();

                    // For each column
                    api.columns().every(function (colIdx) {
                        var column = this;
                        var header = $('.filters_clientq th').eq(column.index());
                        var title = $(header).text();

                        // Replace content with input field
                        $(header).html('<input type="search" placeholder="' + title + '" />');

                        // Bind events for search
                        $('input', header)
                            .off('keyup change')
                            .on('input', function () { // Using 'input' event for real-time input changes
                                var value = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(value, true, false).draw();
                            });
                    });
                },
                footerCallback: function (row, data, start, end, display) {
                    var api_ttl_amt = this.api();
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
         
                    // Total over this page
                    pageTotal = api_ttl_amt
                        .column(25, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
         
                    // Update footer
                    //$(api_ttl_amt.column(45).footer()).html(parseFloat(pageTotal.toFixed(2)) + 'current total<br>(' + total.toFixed(2) + ' total)');
                    $(api_ttl_amt.column(25).footer()).html(pageTotal.toLocaleString('en', {style: 'currency', currency: 'PHP'}));
                }
            });

            $('.clientq tbody').on('click', 'tr', function() {
                var data = $('.clientq').DataTable().row(this).data();
                $("#cl_qn2").val(data.id_tbl_save_clientbene);
                console.log(data.id_tbl_save_clientbene);
                $("#release_mode").val(data.release_mode);
                console.log(data.release_mode);
            });
            
            $("#btn_canceltrans").click(function(){
                $("#canceltrans_modal").modal();
                var clqn = $("#cl_qn2").val();
                    $("#modal_clqn").val(clqn);
            });
        });
    </script>

</body>
</html>