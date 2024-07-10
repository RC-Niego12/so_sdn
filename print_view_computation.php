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
        <title>Print Computation</title>
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
                <div class="row">
                    <div class="col-xs-12 computation">
                        <h4 style="margin: auto; padding: 10px 0; text-align: center;">COMPUTATION</h4>
                        <table class="table table-bordered table-striped table-hover dataTable text-left">
                            <thead>
                                <tr>
                                    <th style="background-color: #2E5090 !important;">Description</th>
                                    <th style="background-color: #2E5090 !important;">Unit Price</th>
                                    <th style="background-color: #2E5090 !important;">Quantity</th>
                                    <th style="background-color: #2E5090 !important;">Total Cost/Price</th>
                                </tr>
                            </thead>
                            <tbody style="border-bottom: solid 5px #ddd;">
                                <?php
                                    $sql_comp = mysqli_query($conn,"SELECT * FROM tbl_computation WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
                                    if ($sql_comp->num_rows > 0) {
                                        while($row_comp = mysqli_fetch_array($sql_comp)){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row_comp['description'];?>
                                                </td>
                                                <td>
                                                    &#8369;<?php echo number_format($row_comp['uprice'],2);?>
                                                </td>
                                                <td>
                                                    <?php echo $row_comp['qty'];?>
                                                </td>
                                                <td>
                                                    &#8369;<?php echo number_format($row_comp['tprice'],2);?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                    $sql_comp2 = mysqli_query($conn,"SELECT * FROM tbl_computation2 WHERE cl_qn='".$_SESSION['cl_qn2']."' ");
                                    if ($sql_comp2->num_rows > 0) {
                                        while($row_comp2 = mysqli_fetch_array($sql_comp2)){
                                            ?>
                                            <tr>
                                                <td style="border: none !important;"></td>
                                                <td style="border: none !important;"><i>*nothing follows*</i></td>
                                                <td style="text-align: right; font-weight: bold; border: none !important;">Sub-Total</td>
                                                <td>&#8369;<?php echo number_format($row_comp2['stotal'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td style="border: none !important;"></td>
                                                <td style="border: none !important;"></td>
                                                <td style="text-align: right; font-weight: bold; border: none !important;">Discount</td>
                                                <td>&#8369;<?php echo number_format($row_comp2['dcnt'],2);?></td>
                                            </tr>
                                            <tr>
                                                <td style="border: none !important;"></td>
                                                <td style="border: none !important;"></td>
                                                <td style="text-align: right; border: none !important; font-size: 15px; font-weight: bold;">Total Amount</td>
                                                <td style="font-size: 15px; font-weight: bold;">&#8369;<?php echo number_format($row_comp2['totalamt'],2);?></td>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tfoot>
                        </table><br><br>
                        <div class="">
                            <div style="width: 80mm; display: inline-block;" class="text-center">
                                <p style="font-size: 13px;">PREPARED BY:</p><br><br>
                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                                    <?php
                                      echo strtoupper($row1['fname'])." "; 
                                      if (empty($row1['mname'])) {
                                            echo "";
                                      } else {
                                            echo strtoupper(substr($row1['mname'],0,1)).". ";
                                      }
                                      echo strtoupper($row1['lname']);
                                      if ($row1['nameext'] == "N/A" || $row1['nameext'] == "") {
                                            echo "";
                                      } else {
                                            echo ", ".$row1['nameext'];
                                      }
                                    ?> 
                                </p>
                                <p style="font-size: 13px;">Social Worker</p>
                                <p style="font-size: 12px;">Licence Number: <?php echo $row1['lic_no']; ?></p>
                                <p style="font-size: 11px;">(Signature over Printed Name)</p>
                            </div>
                            <div style="width: 48mm; display: inline-block;" class=""></div>
                            <div style="width: 80mm; display: inline-block;" class="text-center">
                                <p style="font-size: 13px;">APPROVED BY:</p><br><br>
                                <?php
                                    $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'SDN SWAD Team Leader' ");
                                    $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                                ?>
                                <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                                    <?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; }
                                    ?>
                                </b></p>
                                <p style="font-size: 13px;"><?php echo $row_approv_gis['designation']; ?></p>
                                <p style="font-size: 12px;">Approving Authority</p>
                                <p style="font-size: 11px;">(Signature over Printed Name)</p>
                            </div>
                        </div>
                    </div><br>
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