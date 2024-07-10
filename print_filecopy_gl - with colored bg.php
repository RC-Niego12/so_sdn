<?php 
    session_start();
    $_SESSION['cl_qn2'];
    include 'config.php';
    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
        header("Location: index.php");
    }
    $sql_tbl_staffs = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
    $row1 = mysqli_fetch_assoc($sql_tbl_staffs);

    $sql_tbl_save_clientbene = mysqli_query($conn,"SELECT * FROM tbl_save_clientbene WHERE id_tbl_save_clientbene='".$_SESSION['cl_qn2']."' ");
        $row = mysqli_fetch_assoc($sql_tbl_save_clientbene);
        date_default_timezone_set('Asia/Manila');
        $monthdatenow = date('m.d');
        $yearnow = date('Y');

        $bn_birthmonthdate = date_format(new DateTime($row['bn_bday']), "m.d");
        $bn_birthyear = date_format(new DateTime($row['bn_bday']), "Y");

        $cl_birthmonthdate = date_format(new DateTime($row['cl_bday']), "m.d");
        $cl_birthyear = date_format(new DateTime($row['cl_bday']), "Y");

        $beneage = $clientage = "";

    $sql_tbl_save_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_save_addl_entry WHERE id_tbl_save_addl_entry='".$_SESSION['cl_qn2']."' ");
        $row_tbl_addl_entry = mysqli_fetch_assoc($sql_tbl_save_addl_entry);
        $amt = $row_tbl_addl_entry['amount_in_figures'];

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
        <title>Print File Copy - GL</title>
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
                <p style="font-size: 15px; text-align: right; margin: 0px;"><u><b>GL No: <?php echo $row_tbl_addl_entry['transaction_code'];?></b></u></p>
                <br><br>
                <p style="font-size: 15px; text-align: left; margin: 0px;">Date: <?php echo date_format(new DateTime($row['time_end']), "M. d, Y");?></p>
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
                    $sql_signatory = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE amt_from<='".$amt."' AND amt_to >= '".$amt."' ");
                    $row_signatory = mysqli_fetch_assoc($sql_signatory);
                ?>
                <p style="font-size: 15px; margin: 0px;"><b><u><?php echo strtoupper($row_signatory['fname'])." "; if (empty($row_signatory['mname'])) { echo ""; } else { echo strtoupper(substr($row_signatory['mname'],0,1)).". "; } echo strtoupper($row_signatory['lname']); if ($row_signatory['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_signatory['nameext']; } if (empty($row_signatory['suffix'])) {echo ''; } else { echo ', '.$row_signatory['suffix']; } ?></u></b></p>
                <p style="font-size: 14px; margin: 0px;">Approving Authority</p>
                <p style="font-size: 12px; margin: 0px;"><b>Position:</b> <?php echo $row_signatory['designation'];?></p>
                <p style="font-size: 12px; margin: 0px;"><b>Office:</b> Crisis Intervention Section</p><br><br><br>
                <?php

                    $validity = date_create($row['time_end']);
                    date_add($validity, date_interval_create_from_date_string("3 days"));
                ?>
                <p style="font-size: 14px;"><b>Valid Until:</b> <?php echo date_format($validity, "M. d, Y"); ?></p>
                <p style="font-size: 14px;"><b>*</b><i>Validity period includes the time of receipt of the guarantee letter by the service provider.</i></p>
                
                <div class="container-footer container-fluid">
                    <img src="images/dswd-footer-logo.png">
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

    </body>
</html>