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
        <title>Print File Copy - COE(PCV)</title>
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
            <h4 style="text-align: center; margin: 0px;">CERTIFICATE OF ELIGIBILITY</h4>
            <p style="text-align: center; margin: 0px; font-size: 14px;">(Outright Cash)</p>
            <div class="qn-pcn-row">
                <div class="div-qn">
                    <p class="div-qn-p">QN:</p>
                    <div class="qn text-center">
                        <?php echo $row['cl_qn'];?>
                    </div>
                </div>
                <div class="div-pcn">
                    <p class="div-qn-p">PCN:</p>
                    <div class="pcn text-center">
                        <?php
                            if (!empty($row['cl_pcn'])) {
                                echo $row['cl_pcn'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                    </div>
                </div>
                <div class="div_glcode_date" style="display: inline-block; float: right;">
                    <div class="div-date" style="width: auto !important;">
                        <p class="div-qn-p">Date:</p>
                        <div class="date text-center">
                            <?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?>
                        </div>
                    </div>
                </div>
                <div class="client-statusAdmission-row">
                    <div class="status">
                        <div class="status-new">
                            <?php
                                $cl_status=$row['cl_status'];
                                if ($cl_status=='New') {
                                    ?>
                            <p class="p-check">&#x2713;</p>
                                    <?php
                                } else {

                                }
                            ?>
                            <p class="status-p">New</p>
                            
                        </div>
                        <div class="status-returning">
                            <?php
                                $cl_status=$row['cl_status'];
                                if ($cl_status=='Returning') {
                                    ?>
                            <p class="status-p" style="left: 2px;">&#x2713;</p>
                                    <?php
                                } else {

                                }
                            ?>
                            <p class="status-p">Returning</p>
                            
                        </div>
                        <div class="admission-on-site">
                            <?php
                                $cl_status=$row['cl_status'];
                                if (($cl_status=='New')||($cl_status=='Returning')) {
                                    ?>
                            <p class="status-p-onsite">&#x2713;</p>
                            <p class="status-p status-p2">On-Site</p>
                                    <?php
                                } else { ?>
                                <p class="status-p status-p2">On-Site</p>
                                <?php }
                            ?>
                        </div>
                        <div class="admission-walk-in">
                            <?php
                                if ($row_tbl_addl_entry['admission_mode'] == "Walk-in") {
                                    ?>
                                <p class="status-p-onsite">&#x2713;</p>
                                    <?php
                                } else { }
                            ?>
                            <p class="status-p status-p2">Walk-in</p>
                        </div>
                        <div class="admission-referral">
                            <?php
                                if ($row_tbl_addl_entry['admission_mode'] == "Referral") {
                                    ?>
                                <p class="status-p-onsite">&#x2713;</p>
                                    <?php
                                } else { }
                            ?>
                            <p class="status-p">Referral</p>
                        </div>
                        <div class="admission-off-site">
                            <p class="status-p status-p3">Off-Site</p>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="row-input">
                <div class="text" style="width: 37mm; display: inline-block;">
                    <p style="margin: 0px; font-size: 12px;">This is to certify that, </p>
                </div>
                <div class="cl_full_name" style="width: 100mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b> <?php echo strtoupper($row['cl_fname'])." "; if (empty($row['cl_mname'])) { echo ""; } else { echo strtoupper($row['cl_mname'])." "; } echo strtoupper($row['cl_lname']); if ($row['cl_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['cl_nameext']; }?></b></p>
                </div>
                <p style="margin: 0px; font-size: 15px; display: inline-block;">, </p>
                <div class="sex" style="display: inline-block; position: relative; width: 45mm; margin-left: 15px;">
                    <div class="sex-m" style="display: inline-block; width: 15px; height: 15px; border: solid black 1px;">
                        <?php
                            $cl_sex=$row['cl_sex'];
                            if ($cl_sex=='M') {
                                ?>
                        <p class="p-check">&#x2713;</p>
                                <?php
                            } else {

                            }
                        ?>
                        <p class="status-p" style="font-size: 12px; font-weight: 100;">Male</p>
                    </div>
                    <div class="sex-f" style="display: inline-block; width: 15px; height: 15px; border: solid black 1px; position: absolute; left: 75px;">
                        <?php
                            $cl_sex=$row['cl_sex'];
                            if ($cl_sex=='F') {
                                ?>
                        <p class="p-check" style="left: 2px;">&#x2713;</p>
                                <?php
                            } else {

                            }
                        ?>
                        <p class="status-p" style="font-size: 12px; font-weight: 100;">Female</p>
                        
                    </div>
                </div>
                <div class="age" style="display: inline-block; width: 18.6mm; border-bottom: solid black 1px; text-align: center;">
                    <p style="font-size: 12px;">
                        <?php echo $row['cl_age']; ?> y/o
                    </p>
                </div>
            </div>
            <div class="row-label">
                <div style="display: inline-block; width: 37mm; margin-top: 4px; text-align: center;"></div>
                <div style="display: inline-block; width: 100mm; margin-top: 4px; text-align: center;">
                    <p style="font-size: 12px;">Buong Pangalan <i>(First Name, Middle Name, Last Name)</i></p>
                </div>
                <div style="display: inline-block; width: 45mm; margin-top: 4px; text-align: center;   margin-left: 15px;">
                    <p style="font-size: 12px;">Kasarian <i>(Sex)</i></p>
                </div>
                <div style="display: inline-block; width: 20.6mm; margin-top: 4px; text-align: center;">
                    <p style="font-size: 12px;">Edad <i>(Age)</i></p>
                </div>
            </div>
            <div class="row-input" style="margin-top: 3px;">
                <div class="text" style="width: 45mm; display: inline-block;">
                    <p style="margin: 0px; font-size: 12px;">and presently residing at </p>
                </div>
                <div class="cl_address" style="width: 163.4mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b> <?php echo strtoupper($row['cl_purok'].", Brgy. ".$row['cl_brgy'].", ".$row['cl_mun'].", ".$row['cl_prov'].' '.$row['cl_district']); ?></b></p>
                </div>
            </div>
            <div class="row-label">
                <div style="display: inline-block; width: 45mm; margin-top: 4px; text-align: center;"></div>
                <div style="display: inline-block; width: 163.4mm; margin-top: 4px; text-align: center;">
                    <p style="font-size: 12px;">Kumpletong Tirahan <i>(Complete Address)</i></p>
                </div>
            </div>
            <p style="font-size: 12px;">has been found eligible for assistance after the assessment and validation conducted, for his/herself or through the representation of his/her 
            </p>
            <div class="row-input" style="margin-top: 3px;">
                <div class="" style="width: 108mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                        <?php
                            if ($row['bn_reltoclient'] == 'Self') { echo strtoupper($row['bn_reltoclient']); } else { echo strtoupper($row['bn_reltoclient']); }
                        ?>
                    </b></p>
                </div>
                <p style="margin: 0px; font-size: 15px; display: inline-block;">, </p>
                <div class="" style="width: 98mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                        <?php 
                            if ($row['bn_reltoclient'] == 'Self') { echo 'N/A'; } else { echo strtoupper($row['bn_fname'])." "; if (empty($row['bn_mname'])) { echo ''; } else { echo strtoupper($row['bn_mname'])." "; } echo strtoupper($row['bn_lname']); if ($row['bn_nameext'] == "N/A") { echo ""; } else { echo ", ".$row['bn_nameext'] ;} ;}
                        ?>
                    </b></p>
                </div>
            </div>
            <div class="row-label">
                <div style="display: inline-block; width: 108mm; text-align: center; margin-top: 4px;">
                    <p style="font-size: 12px;">Relasyon ng Kinatawan sa Benepisyaryo <i style="font-size: 8px;">(Relationship of the Representative with Beneficiary)</i></p>
                </div>
                <div style="display: inline-block; width: 100mm; text-align: center; margin-top: 4px;">
                    <p style="font-size: 12px;">Buong Pangalan ng Benepisyaryo <i style="font-size: 12px;">(Complete Name of Beneficiary)</i></p>
                </div>
            </div><br>
            <p class="b4records"><b>
                Records of the case such as the following are confidentially filed at the Crisis Intervention Division (CID)
            </b></p>
            <div class="coe_attachments" style="width: 100%; height: auto; border: solid black 1px; padding: 5px 0px;">
                <div class="coe_at1" style="width: 45mm;">
                    <ul>
                        <li>
                            <div class="list_coe_attachments">
                                <p class="p-check">&#x2713;</p>
                                <p class="list_coe_attachments_p">General Intake Sheet</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                    <?php
                                        if ($row_tbl_addl_entry['cl_id'] == "DSWD 4Ps ID") {
                                            echo '';
                                        } else {
                                            ?>  
                                                <p class="p-check">&#x2713;</p>
                                            <?php
                                        }
                                    ?>
                                <p class="list_coe_attachments_p">Valid ID Presented</p>
                            </div>
                        </li>
                        <li>
                            <div style="border-bottom: solid black 1px; width: 100%; height: 20px;">
                                <p class="list_coe_attachments_p" style="margin-left: 0px;">
                                    <?php
                                        if ($row_tbl_addl_entry['cl_id'] == "DSWD 4Ps ID") {
                                            echo '';
                                        } else {
                                            echo $row_tbl_addl_entry['cl_id'];
                                        }
                                    ?>
                                </p>
                                
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    if ($row_tbl_addl_entry['cl_id'] == "DSWD 4Ps ID") {
                                        ?>  
                                            <p class="p-check">&#x2713;</p>
                                        <?php
                                    } else {
                                        echo '';
                                    }
                                ?>
                                <p class="list_coe_attachments_p">DSWD 4Ps ID</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Justification'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Justification</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="coe_at2" style="width: 55mm;">
                    <ul>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Medical Certificate/Abstract'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Medical Certificate/Abstract</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Prescriptions'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Prescriptions</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Statement of Account'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Statement of Account</p>
                                
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Treatment Protocol'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Treatment Protocol</p>
                                
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Quotation'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Quotation</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="coe_at3" style="width: 43mm;">
                    <ul>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Discharge Summary'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Discharge Summary</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Laboratory Request'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Laboratory Request</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Charge Slip'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Charge Slip</p>
                                
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Funeral Contract'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Funeral Contract</p>
                                
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Death Certificate'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Death Certificate</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="coe_at4" style="width: 64mm;overflow-wrap: break-word;">
                    <ul>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Death Summary'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Death Summary</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Referral Letter'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Referral Letter</p>
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count = count($attachments_arrval)-1;
                                    //Loop through each array index
                                    for($i = 0; $i <= $count; $i++) {
                                        //Assign the value of the array key to a variable
                                        $value = $attachments_arrval[$i];
                                        //Check if result string contains diam-mm
                                        if ($value == 'Social Case Study Report'){
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                ?>
                                <p class="list_coe_attachments_p">Social Case Study Report</p>
                                
                            </div>
                        </li>
                        <li>
                            <div class="list_coe_attachments">
                                <?php
                                    $count2 = count($attachments2_arrval)-1;
                                    if ($count2 > 0){
                                        ?>
                                        <p class="p-check">&#x2713;</p>
                                        <?php
                                    } else {}
                                ?>
                                <p class="list_coe_attachments_p" style="width: 55mm; line-height: 1;">Others:
                                    <span style="font-size: 11px; text-decoration: underline;">
                                        <?php
                                            $count = count($attachments2_arrval)-1;
                                            //Loop through each array index
                                            for($i = 0; $i <= $count; $i++) {
                                                //Assign the value of the array key to a variable
                                                $value = $attachments2_arrval[$i];
                                                if (($count > 0) && (!empty($value)) ){
                                                    echo $value.', ';
                                                } else {}
                                            }
                                            if (!empty($row_tbl_addl_entry['other_addl_attachments'])) {
                                                echo $row_tbl_addl_entry['other_addl_attachments'].', ';
                                            } else {}
                                            if ($row_tbl_addl_entry['bn_id']!='N/A') {
                                                echo "Bene's ".$row_tbl_addl_entry['bn_id'];
                                            } else {}
                                        ?>
                                    </span>
                                </p>
                                
                            </div>
                        </li>
                    </ul>
                </div>
            </div><br>
            <div class="row-input" style="margin-top: 3px;">
                <p style="margin: 0px; font-size: 12px; display: inline-block;">
                    The Client is hereby recommended to receive 
                </p>
                <div class="" style="width: 50mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                        <?php
                            echo $row_tbl_addl_entry['assistance_type'];
                        ?>
                    </b></p>
                </div>
                <p style="margin: 0px; font-size: 12px; display: inline-block;"> Assistance for </p>
                <div class="" style="width: 72mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                        <?php
                            echo $row_tbl_addl_entry['purpose'].' ('.$row_tbl_addl_entry['remarks_pcv'].')';
                        ?>
                    </b></p>
                </div>
            </div>
            <div class="row-input" style="margin-top: 5px;">
                <p style="margin: 0px; font-size: 12px; display: inline-block;">
                    in the amount of 
                </p>
                <div class="" style="width: 80mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                        <?php
                            echo $row_tbl_addl_entry['amount_in_words'];
                        ?>
                    </b></p>
                </div>
                <p style="margin: 0px; font-size: 12px; display: inline-block;"> , </p>
                <div class="" style="width: 25mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b> Php 
                        <?php
                            echo number_format($row_tbl_addl_entry['amount_in_figures'],2);
                        ?>
                    </b></p>
                </div>
                <p style="margin: 0px; font-size: 12px; display: inline-block;"> CHARGEABLE AGAINST: PSP </p>
                <div class="" style="width: 32mm; display: inline-block; border-bottom: solid black 1px;">
                    <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                        <?php
                            echo $row_tbl_addl_entry['fund_source'];
                        ?>
                    </b></p>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <p style="font-size: 13px;">CONFORME:</p><br>
                    <p class="print_view_coe_pcv2">
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
                    <p style="font-size: 13px;">Client</p>
                    <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                </div>
                <div class="col-sm-4 text-center">
                    <p style="font-size: 13px;">PREPARED BY:</p><br><br>
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
                    <p style="font-size: 13px;">Social Worker</p>
                    <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                </div>
                <div class="col-sm-4 text-center">
                    <p style="font-size: 13px;">APPROVED BY:</p><br><br>
                    <?php
                        $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'PCV Approving Authority' ");
                        $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                    ?>
                    <p style="text-align: center; margin: 0px;"><b><u><?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; } ?></u></b>
                    </p>
                    <p style="font-size: 12px;">Approving Authority</p>
                    <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                </div>
            </div><br><br>
            <div class="acknowledge_receipt text-center">
                <h5>Acknowledgement Receipt</h5>
            </div>
            <div>
                <div class="div_glcode_date" style="display: inline-block; float: right; margin-top: 10px;">
                    <div class="div-date" style="width: auto !important;">
                        <p class="div-qn-p">Date:</p>
                        <div class="date text-center">
                            <?php echo date_format(new DateTime($row['time_start']), "M. d, Y");?>
                        </div>
                    </div>
                </div>
            </div><br><br><br>
            <div style="position: relative;">
                <div class="fin_assistance">
                    <p class="status-p-onsite">&#x2713;</p>
                    <p class="p-fin_assi" style="display: inline-block;">Financial Assistance</p>
                    <div class="" style="width: 95mm; display: inline-block; border-bottom: solid black 1px; position: absolute; left: 150px;">
                        <p style="margin: 0px; font-size: 12px; text-align: center;"><b>
                            <?php
                                echo $row_tbl_addl_entry['amount_in_words'];
                            ?>
                        </b></p>
                    </div>
                    <p style="margin: 0px; font-size: 12px; display: inline-block;"> , </p>
                    <div class="" style="width: 30mm; display: inline-block; border-bottom: solid black 1px; position: absolute; left: 520px;">
                        <p style="margin: 0px; font-size: 12px; text-align: center;"><b> Php 
                            <?php
                                echo number_format($row_tbl_addl_entry['amount_in_figures'],2);
                            ?>
                        </b></p>
                    </div>
                </div>
            </div><br><br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="assistance-col-pcv-coe">
                        <ul>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if ($row_tbl_addl_entry['assistance_type'] == "MEDICAL") {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Medical Assistance</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if ($row_tbl_addl_entry['assistance_type'] == "BURIAL") {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Funeral Assistance</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if (($row_tbl_addl_entry['assistance_type'] == "CASH") && ($row_tbl_addl_entry['purpose'] == "EMERGENCY CASH TRANSFER")) {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Emergency Cash Transfer</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="assistance-col-pcv-coe">
                        <ul>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if ($row_tbl_addl_entry['assistance_type'] == "TRANSPORTATION") {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Transportation Assistance</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if ($row_tbl_addl_entry['assistance_type'] == "EDUCATIONAL") {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Educational Assistance</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="assistance-col-pcv-coe">
                        <ul>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if ($row_tbl_addl_entry['assistance_type'] == "FOOD") {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Food Assistance</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if (($row_tbl_addl_entry['assistance_type'] == "CASH") && ($row_tbl_addl_entry['purpose'] == "CASH RELIEF ASSISTANCE")) {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Cash Relief Assistance</p>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <p style="font-size: 13px;">Tinanggap ni:</p><br>
                    <p class="print_view_coe_pcv2">
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
                    <p style="font-size: 13px;">Client</p>
                    <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                </div>
                <div class="col-sm-4 text-center">
                    <p style="font-size: 13px;">Binayaran ni:</p><br><br>
                    <!--<p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;">
                        <?php
                          //echo strtoupper($row1['fname'])." "; 
                          //if (empty($row1['mname'])) {
                          //      echo "";
                          //} else {
                          //      echo strtoupper(substr($row1['mname'],0,1)).". ";
                          //}
                          //echo strtoupper($row1['lname']);
                          //if ($row1['nameext'] == "N/A" || $row1['nameext'] == "") {
                          //T      echo "";
                          //} else {
                          //      echo ", ".$row1['nameext'];
                          //}
                        ?> 
                    </p>-->
                    <?php
                        $sql_binayaran_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'Petty Cash Custodian' ");
                        $row_binayaran_gis = mysqli_fetch_assoc($sql_binayaran_gis);
                    ?>
                    <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                        <?php echo strtoupper($row_binayaran_gis['fname'])." "; if (empty($row_binayaran_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_binayaran_gis['mname'],0,1)).". "; } echo strtoupper($row_binayaran_gis['lname']); if ($row_binayaran_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_binayaran_gis['nameext']; } if (empty($row_binayaran_gis['suffix'])) {echo ''; } else { echo ', '.$row_binayaran_gis['suffix']; }
                        ?>
                    </b></p>
                    <p style="font-size: 13px;"><!--Social Worker-->RDO / SDO</p>
                    <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                </div>
                <div class="col-sm-4 text-center">
                    <p style="font-size: 13px;">Sinaksihan ni:</p><br><br>
                    <?php
                        $sql_witness_pcv = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'Petty Cash Witness' ");
                        $row_witness_pcv = mysqli_fetch_assoc($sql_witness_pcv);
                    ?>
                    <p style="font-size: 13px; width: 100%; font-weight: bold; border-bottom: solid black 1px;"><b>
                        <?php echo strtoupper($row_witness_pcv['fname'])." "; if (empty($row_witness_pcv['mname'])) { echo ""; } else { echo strtoupper(substr($row_witness_pcv['mname'],0,1)).". "; } echo strtoupper($row_witness_pcv['lname']); if ($row_witness_pcv['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_witness_pcv['nameext']; } if (empty($row_witness_pcv['suffix'])) {echo ''; } else { echo ', '.$row_witness_pcv['suffix']; }
                        ?>
                    </b></p>
                    <p style="font-size: 12px;">SWO / ADMIN</p>
                    <p style="font-size: 11px; font-style: italic;">(Signature over Printed Name)</p>
                </div>
            </div>
                <p class="eo163seriesof2022">*E.O. 163 Series of 2022</p>
                <div class="container-footer-updt container-fluid">
                    <p>Page 1 of 1</p>
                    <p style="border-top: solid black 1px;">DSWD Field Office Caraga, R. Palma Street, Butuan City, Philippines 8600</p>
                    <p>Website: http://caraga.dswd.gov.ph Tel Nos.: (085) 303-8620</p>
                    <img class="footer_logo" src="images/updated-logo/footer_logo.png">
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