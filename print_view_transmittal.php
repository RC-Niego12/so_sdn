<?php 
    session_start();
    include 'config.php';

    $_SESSION['checkbox']; $_SESSION['obdv_code']; $_SESSION['prep_by'];
    $checked_obdv = $_SESSION['checkbox'];
    $trml_code = $_SESSION['trml_code'];
    $prep_by = $_SESSION['prep_by'];

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql_tbl_staffs = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $row1 = mysqli_fetch_assoc($sql_tbl_staffs);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Print Transmittal</title>
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
    </head>
    
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

    <body class="theme-darkblue">
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
	            </div><br>
                <table class="trml_header text-left">
                    <tr style="font-weight: bold;">
                        <td style="text-align: left; width: 70px; padding: 2px !important;">FOR:</td>
                        <td colspan="4" style="text-align: left; padding: 2px !important;">MARI-FLOR A. DOLLAGA-LIBANG</td>
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
                        <td colspan="4" style="text-align: left; padding: 2px !important;">MR. ROLLY L. QUIBAN</td>
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
                        <td colspan="4" style="text-align: left; padding: 2px !important;">THESA JOY B. MUSA, SWO-III</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                        <td colspan="4" style="text-align: left; padding: 2px !important;">SWAD Team Leader</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 70px; padding: 2px !important;"></td>
                        <td colspan="4" style="text-align: left; padding: 2px !important;">SDN - DSWD Satellite Office, Surigao City</td>
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
                        <?php
                            $sql_trml_dt = mysqli_query($conn, "SELECT * FROM tbl_obs_dv_transmittal WHERE transmittal_code='$trml_code' ");
                            $row_trml_dt = mysqli_fetch_assoc($sql_trml_dt); $tr_dt = $row_trml_dt['transmittal_date'];
                        ?>
                        <td colspan="4" style="text-align: left; padding: 2px !important; border-bottom: solid black 1px !important;">
                            <?php
                                echo date_format(new DateTime($tr_dt), "M. d, Y");
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
                        <td colspan="5" style="text-align: left; padding: 2px !important;">> Vouchers</td>
                    </tr>
                </table>
                <?php

                    $checkbox_exp = explode(',', $_SESSION['checkbox']);
                    $checkbox_arrval = array_values($checkbox_exp);
                    $count = count($checkbox_arrval)-2;
                    $count2 = $count+1;
                    //Loop through each array index
                    for($i = 0; $i <= $count; $i++) {
                        $i2 = $i+1;
                        //Assign the value of the array key to a variable
                        $obs_dv_code = $checkbox_arrval[$i];
                        //echo $obs_dv_code.'-'.$_SESSION['prep_by'].'<br>';
                        ?>
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
                                    $sql_obdv = mysqli_query($conn, "SELECT * FROM tbl_obs_dv INNER JOIN tbl_obs_dv_transmitted ON tbl_obs_dv.obs_dv_code = tbl_obs_dv_transmitted.obdv_code2 WHERE transmittal_code2='$trml_code' ");
                                    $q=0;
                                    if ($sql_obdv->num_rows > 0){
                                        while($row_obdv = mysqli_fetch_assoc($sql_obdv)) {
                                            $ns = $row_obdv['num_series'];
                                            $obdv_code = $row_obdv['obs_dv_code'];
                                            $bill_code = $row_obdv['billing_code'];
                                            $prep_date = $row_obdv['obs_dv_date'];                                                                  
                                            $trml_obdv_code = $row_obdv['obdv_code2'];                                                               
                                            $trml_date = $row_obdv['transmittal_date2'];                                                                
                                            $trml_code = $row_obdv['transmittal_code2'];
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
                                                <td style="padding: 1px !important;"><input type="text" value="complete attachments" style="border: none; width: 100%; text-align: center;"></td>
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
                        <?php
                    }
                ?>
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
	            <div class="container-footer-updt container-fluid">
	                <p>Page 1 of 1</p>
	                <p style="border-top: solid black 1px;">DSWD Field Office Caraga, R. Palma Street, Butuan City, Philippines 8600</p>
	                <p>Website: http://caraga.dswd.gov.ph Tel Nos.: (085) 303-8620</p>
	                <img class="footer_logo" src="images/updated-logo/footer_logo.png">
	            </div>
            </page>
        </div>   

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        
        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <!-- Validation Plugin Js -->
        <script src="plugins/jquery-validation/jquery.validate.js"></script>
        
        <!-- Custom Js -->
        <script src="js/admin.js"></script> 
        
        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        
        <script src="js/pages/examples/sign-in.js"></script>

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