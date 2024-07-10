<?php 
session_start();
$_SESSION['cl_qn'];
$_SESSION['cl_qn2'] = $_SESSION['cl_qn'];
include 'config.php';
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  false) {
    header("Location: index.php");
}
$sql_tbl_staffs = mysqli_query($conn,"SELECT * FROM tbl_staffs WHERE staffid='".$_SESSION['staffid']."' ");
$row1 = mysqli_fetch_assoc($sql_tbl_staffs);
    $sql_tbl_clientqueue = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
    $row = mysqli_fetch_assoc($sql_tbl_clientqueue);
    date_default_timezone_set('Asia/Manila');
      $monthdatenow = date('m.d');
      $yearnow = date('Y');

      $bn_birthmonthdate = date_format(new DateTime($row['bn_bday']), "m.d");
      $bn_birthyear = date_format(new DateTime($row['bn_bday']), "Y");

      $cl_birthmonthdate = date_format(new DateTime($row['cl_bday']), "m.d");
      $cl_birthyear = date_format(new DateTime($row['cl_bday']), "Y");

      $beneage = $clientage = "";

$sql_tbl_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_addl_entry WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
    $row_tbl_addl_entry = mysqli_fetch_assoc($sql_tbl_addl_entry);
    $amt = $row_tbl_addl_entry['amount_in_figures'];

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
        <title>Print GL</title>
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
                    <img src="images/updated-logo/dswd.png" class="header-logos-dswd-logo2" style="width: 230px;">
                    <img src="images/updated-logo/aics.png" class="header-logos-aics-logo2" style="margin-left: 270px; width: 50px;">
                    <img src="images/updated-logo/bagong_pilipinas.png" class="header-logos-bp-logo" style="margin-left: 350px; width: 65px;">
                </div>
                <p style="font-style: italic; font-size: 12px; font-family: Times New Roman; font-weight: bold; margin-top: 3px;">DSWD-PMB-GF-015 | REV 02 | 08 JAN 2024</p>
                <br><br>
                <p style="font-size: 15px; text-align: left; margin: 0px;"><u><b>GL No: <?php echo $row_tbl_addl_entry['gl_code'];?></b></u></p>
                <br>
                <p style="font-size: 15px; text-align: left; margin: 0px;">Date: <?php echo date_format(new DateTime($row['date_added']), "M. d, Y");?></p>
                <br>
                <p style="font-size: 15px; margin: 0px;"><b>Addressee: <?php echo strtoupper($row_tbl_addl_entry['sp']);?></b></p>
                <p style="font-size: 13px; margin: 0px;"><b>Position:</b> N/A</p>
                <p style="font-size: 13px; margin: 0px;"><b>Address:</b> <?php echo $row_tbl_addl_entry['sp_address'];?></p>
                <br><br>
                <p style="font-size: 15px;"><b>Dear Ma'am/Sir,</b></p><br>
                <p style="font-size: 15px;">
                    This has reference to the request for the <span><b><u><?php echo $row_tbl_addl_entry['assistance_type'];?></u></b></span> assistance of herein client, <span><u><b> <?php echo strtoupper($row['cl_fname'])." "; if (empty($row['cl_mname'])) { echo ""; } else { echo strtoupper(substr($row['cl_mname'],0,1)).". "; } echo strtoupper($row['cl_lname']); if ($row['cl_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['cl_nameext']; }?></b></u></span>, from <span><u><b><?php echo $row['cl_purok'].', Brgy. '.$row['cl_brgy'].', '.$row['cl_mun'].', '.$row['cl_prov'].', '.$row['cl_region']; ?></b></u></span> for his/her <span><b><u><?php if ($row['bn_reltoclient'] == 'Self') { echo strtoupper($row['bn_reltoclient']).'.'; } else { echo strtoupper($row['bn_reltoclient']).', ' ;}?></u></b></span><span><u><b> <?php if ($row['bn_reltoclient'] == 'Self') { echo ''; } else { echo strtoupper($row['bn_fname'])." "; if (empty($row['bn_mname'])) { echo ""; } else { echo strtoupper(substr($row['bn_mname'],0,1)).". "; } echo strtoupper($row['bn_lname']); if ($row['bn_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['bn_nameext'] ;} ;}?></b></u></span>.
                </p><br>
                <p style="font-size: 15px;">
                   The Department of Social Welfare and Development has assessed and validated the said request for assistance through the Crisis Intervention Unit/Section. Thus, the Department is using this letter to guarantee the payment of the bill in the amount of <span><b><u><?php echo $row_tbl_addl_entry['amount_in_words'];?></u></b></span>, Php <span><b><u><?php echo number_format($row_tbl_addl_entry['amount_in_figures'],2);?></u></b></span>.
                </p><br>
                <p style="font-size: 15px;">
                    To facilitate the payment, please submit to the Crisis Intervention Unit/Section, through <b><u>AICS BILLING</u></b> the following documents for the preparation of the <b><u>Disbursement Voucher</u></b> within one week after service has been completed:
                </p><br>
                <p style="font-size: 15px; text-indent: 70px;">Ø  Guarantee Letter (GL) from the DSWD with your company's "received" stamp or signature over the printed name of the authorized representative;</p>
                <p style="font-size: 15px; text-indent: 70px;">Ø  Statement of Accounts (SOA) or Billing Statement or Sales Invoice with corresponding operative technique or charge slip addressed to DSWD.</p><br>
                <p style="font-size: 15px;">Please be informed that said payment will be directly deposited to your company's bank account. Should there be any query, you may call us at <b>(085) 303-8620</b>.</p><br>
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

                    $validity = date_create($row['date_added']);
                    date_add($validity, date_interval_create_from_date_string("3 days"));
                ?>
                <p style="font-size: 14px;"><b>Valid Until:<u><?php echo date_format($validity, "M. d, Y"); ?></u></b> </p>
                <p style="font-size: 14px;"><b>*</b><i>Validity period includes the time of receipt of the guarantee letter by the service provider.</i></p>
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

    </body>
</html>