<?php
    // Start the session
    session_start();
    $_SESSION['cl_qn2']; $_SESSION['date_added'];
    include 'config.php';
    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql_tbl_staffs = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $row1 = mysqli_fetch_assoc($sql_tbl_staffs);
    
    $sql_tbl_save_clientbene = mysqli_query($conn,"SELECT * FROM tbl_save_clientbene WHERE cl_qn='".$_SESSION['cl_qn2']."' AND time_end='".$_SESSION['date_added']."' ");
        $row = mysqli_fetch_assoc($sql_tbl_save_clientbene);

    $sql_tbl_save_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_save_addl_entry WHERE cl_qn='".$_SESSION['cl_qn2']."' AND time_end2='".$_SESSION['date_added']."' ");
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
        <title>Print - PCV</title>
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
                    <p style="font-size: 15px;"><b>Payee/Office:</b>
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
                    <p style="font-size: 15px;"><b>Address:</b> <u><?php echo $row['cl_purok'].', '.$row['cl_brgy'].', '.$row['cl_mun'].', '.$row['cl_prov'].' '.$row['cl_district'];?></u></p>
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
                    <br><br>
                    <p class="pcv_payee"><b><u>
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
                    <p style="text-align: center; padding-top: 21px;"><b>_________________________________________</b></p>
                    <p style="text-align: center;">Signature over Printed Name</p>
                    <p style="text-align: center;">Payee</p>
                    <p style="text-align: center;"><b>Date: ____________________________________</b></p><br>
                </div>
            </div>
        </page>

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

    </body>
</html>