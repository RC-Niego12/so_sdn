<?php
// Start the session
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

    $sql_tbl_save_addl_entry = mysqli_query($conn,"SELECT * FROM tbl_save_addl_entry WHERE id_tbl_save_addl_entry='".$_SESSION['cl_qn2']."' ");
        $row_tbl_addl_entry = mysqli_fetch_assoc($sql_tbl_save_addl_entry);

        //swo name
    $swo_staffid = $row_tbl_addl_entry['swo_staffid'];
        $sql_swo = mysqli_query($conn, "SELECT * FROM tbl_staffs WHERE staffid='$swo_staffid' ");
        $row_swo = mysqli_fetch_assoc($sql_swo);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Print File Copy - Pagpamatuod</title>
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
            <br><br><h3 style="text-align: center; margin: 0px;">PAGPAMATUOD</h3><br><br>
            <p style="font-size: 15px;">
                Ako si <span><u><b> <?php echo strtoupper($row['cl_fname'])." "; if (empty($row['cl_mname'])) { echo ""; } else { echo strtoupper(substr($row['cl_mname'],0,1)).". "; } echo strtoupper($row['cl_lname']); if ($row['cl_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['cl_nameext']; }?></b></u></span>, usa ka kliyente sa AICS nga programa; mangayo ug <span><b><u><?php echo $row_tbl_addl_entry['assistance_type'].' ASSISTANCE';?></u></b></span> para sa 
                <?php
                    if ($row['bn_reltoclient'] == 'Self') {
                        ?>
                            akoang tambal.
                        <?php
                    } else {
                        ?>
                        tambal sa akoang <span><b><u><?php echo strtoupper($row['bn_reltoclient']); ?></u></b></span> nga si, <span><b><u>
                        <?php
                        echo strtoupper($row['bn_fname'])." ";
                        if (empty($row['bn_mname'])) {
                            echo "";
                        } else {
                            echo strtoupper(substr($row['bn_mname'],0,1)).". ";
                        }
                        echo strtoupper($row['bn_lname']);
                        if ($row['bn_nameext'] == "N/A") {
                            echo "";
                        } else {
                            echo ", ".$row['bn_nameext'];
                        }
                    }
                ?>  </u></b></span>
            </p><br><br>
            <p style="font-size: 15px;">
                Kabahin niini, ako mutugot nga:
            </p><br>
            <div>
                <p style="font-size: 15px; width: 109mm; display: inline-block;">
                    (
                        <?php
                            if ($row_tbl_addl_entry['canvassed_by']=='Client') {
                                ?>&#x2713;<?php
                            } else {}
                        ?>
                     ) Ako ang mag canvass sa tambal sa parmasya nga akong mapili.
                </p>
                <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                </p>
            </div><br>
            <div>
                <p style="font-size: 15px; width: 109mm; display: inline-block;">
                    (
                        <?php
                            if ($row_tbl_addl_entry['canvassed_by']=='Social Worker') {
                                ?>&#x2713;<?php
                            } else {}
                        ?>
                         ) Ako nagatugot nga ang DSWD Staff nga maoy mag canvass sa parmasya nga akong mapili.
                </p>
                <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                </p>
            </div><br><br>
            <p style="font-size: 15px;">
                Ang maong tambal na akong gikinahanglan makuha sa mga sumusunod nga parmasya dinhi sa probinsiya nan Surigao del Norte:
            </p><br>
            <div>
                <?php
                    $sql_sp1 = mysqli_query($conn,"SELECT * FROM tbl_sp_caraga WHERE sp_type='Pharmacy' AND sp_pd_address='SDN1' ");
                    if ($sql_sp1->num_rows > 0){
                        while($row_sp1 = mysqli_fetch_assoc($sql_sp1)) {
                            ?>
                                <p style="font-weight: bold; font-size: 15px; width: 109mm; display: inline-block;">
                                    ( <?php
                                    if ($row_sp1['sp_name'] == $row_tbl_addl_entry['sp']) {
                                        ?>&#x2713;<?php
                                    } else {}
                                    ?> ) 
                                    <?php echo $row_sp1['sp_name'];?>   
                                </p>
                                <p style="font-size: 15px; width: 100mm; display: inline-block;"></p>
                                <p style="font-size: 15px; width: 104mm; display: inline-block; margin-left: 5mm;"><?php echo $row_sp1['sp_address'];?></p>
                                <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                                </p><br><br>
                            <?php
                        }
                    }
                    
                    $sql_sp = mysqli_query($conn,"SELECT * FROM tbl_sp_caraga WHERE sp_type='Pharmacy' AND sp_pd_address='SDN2' ");
                    if ($sql_sp->num_rows > 0){
                        while($row_sp = mysqli_fetch_assoc($sql_sp)) {
                            ?>
                                <p style="font-weight: bold; font-size: 15px; width: 109mm; display: inline-block;">
                                    ( <?php
                                    if ($row_sp['sp_name'] == $row_tbl_addl_entry['sp']) {
                                        ?>&#x2713;<?php
                                    } else {}
                                    ?> ) 
                                    <?php echo $row_sp['sp_name'];?>   
                                </p>
                                <p style="font-size: 15px; width: 100mm; display: inline-block;"></p>
                                <p style="font-size: 15px; width: 104mm; display: inline-block; margin-left: 5mm;"><?php echo $row_sp['sp_address'];?></p>
                                <p style="font-size: 15px; width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                                </p><br><br>
                            <?php
                        }
                    }
                ?>
            </div>
            <p style="font-size: 15px;">
                Ako wala naimpluwensya ni bisan kinsa sa pagpili niining parmasya.
            </p><br>
            <p style="font-size: 15px;">
                Daghang Salamat.
            </p><br><br><br><br>
            <div class="">
                <div style="width: 80mm; display: inline-block;" class="text-center">
                    <p class="print_view_pagpamatuod">
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
                    </p>
                    <p style="font-size: 13px;">Pangalan  ug Pirma sa Kliyente</p>
                </div>
                <div style="width: 48mm; display: inline-block;" class=""></div>
                <div style="width: 80mm; display: inline-block;" class="text-center">
                    <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
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
                    </p>
                    <p style="font-size: 13px;">Pangalan  ug Pirma sa Saksi (SWO)</p>
                </div>
            </div><br><br>
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