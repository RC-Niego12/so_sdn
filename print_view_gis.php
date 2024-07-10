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
        <title>Print GIS</title>
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
                </div>
                <div class="title-gis">
                    <h3 class="text-center">GENERAL INTAKE SHEET</h3>
                    <div class="below-gis text-center">
                        <p>MAARING MAGPATULONG SUMAGOT SA DSWD PERSONNEL </p>
                    </div>
                </div>
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
                    <div class="div-time-start">
                        <p class="div-qn-p">Time Start:</p>
                        <div class="time-start text-center">
                            <?php echo date_format(new DateTime($row['date_added']), "h:i A");?>
                        </div>
                    </div>
                    <div class="div-date">
                        <p class="div-qn-p">Date:</p>
                        <div class="date text-center">
                            <?php echo date_format(new DateTime($row['date_added']), "M. d, Y");?>
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
        <div class="container-client2 container-fluid">
            <div class="part1-title">
                <p>Part I: To be filled out by Client</p>
            </div>
            <div class="info-client-title">
                <p>IMPORMASYON NG KINATAWAN <i>(Client's Identifying Information)</i></p>
            </div>
            <div class="row-input">
                <div class="name-row-input-divs1 text-center">
                      <?php echo $row['cl_lname'];?>
                </div>
                <div class="name-row-input-divs1 text-center">
                      <?php echo $row['cl_fname'];?>
                </div>
                <div class="name-row-input-divs1 text-center">
                      <?php if (empty($row['cl_mname'])) {echo "N/A";} else { echo $row['cl_mname'];}?>
                </div>
                <div class="name-row-input-divs2 text-center">
                      <?php echo $row['cl_nameext'];?>
                </div>
            </div>
            <div class="row-label text-center">
                <div class="name-row-label-divs1">
                      <p class="row-label-p">Apelyido <i class="row-label-i">(Last Name)</i></p>
                </div>
                <div class="name-row-label-divs1">
                      <p class="row-label-p">Unang Pangalan <i class="row-label-i">(First Name)</i></p>
                </div>
                <div class="name-row-label-divs1">
                      <p class="row-label-p">Gitnang Pangalan <i class="row-label-i">(Middle Name)</i></p>
                </div>
                <div class="name-row-label-divs2">
                      <p class="row-label-p">Ext. <i class="row-label-i">(Sr,Jr,I,II)</i></p>
                </div>
            </div>
            <div class="row-input">
                <div class="address-row-input-div1 text-center">
                      <?php echo $row['cl_purok'];?>
                </div>
                <div class="address-row-input-div text-center">
                      <?php echo $row['cl_brgy'];?>
                </div>
                <div class="address-row-input-div text-center">
                      <?php echo $row['cl_mun'];?>
                </div>
                <div class="address-row-input-div text-center">
                      <?php echo $row['cl_prov'].' '.$row['cl_district'];?>
                </div>
                <div class="address-row-input-div2 text-center">
                      <?php echo $row['cl_region'];?>
                </div>
            </div>
            <div class="row-label text-center">
                <div class="address-row-label-div1">
                      <p class="row-label-p">House No./Street/Purok <i class="row-label-i">(Ex. 123 Sun)</i></p>
                </div>
                <div class="address-row-label-div">
                      <p class="row-label-p">Barangay <i class="row-label-i">(Ex. Batasan)</i></p>
                </div>
                <div class="address-row-label-div">
                      <p class="row-label-p">City/Municipality <i class="row-label-i">(Ex. Quezon City)</i></p>
                </div>
                <div class="address-row-label-div">
                      <p class="row-label-p">Province/District <i class="row-label-i">(Ex. Dist. III)</i></p>
                </div>
                <div class="address-row-label-div2">
                      <p class="row-label-p">Region <i class="row-label-i">(Ex. NCR)</i></p>
                </div>
            </div>
            <div class="row-input">
                <div class="otherinfo-row-input-div1">
                  <?php
                if (empty($row['cl_contact_num'])) {
                      echo "N/A";
                } else {
                      echo $row['cl_contact_num'];
                }
                  ?>
                </div>
                <div class="otherinfo-row-input-div2">
                      <?php echo date_format(new DateTime($row['cl_bday']), "M. d, Y");?>
                </div>
                <div class="otherinfo-row-input-div3">
                      <?php echo $row['cl_age'];?>
                </div>
                <div class="otherinfo-row-input-div4">
                      <?php echo $row['cl_sex'];?>
                </div>
                <div class="otherinfo-row-input-div7">
                      <?php echo $row['cl_cstatus'];?>
                </div>
                <div class="otherinfo-row-input-div5">
                      <?php echo $row['cl_occupation'];?>
                </div>
                <div class="otherinfo-row-input-div6">
                      <?php echo $row['cl_salary'];?>
                </div>
            </div>
            <div class="row-label">
                <div class="otherinfo-row-label-div1" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Numero ng Telepono <i class="row-label-i">(Mobile No.)</i></p>
                </div>
                <div class="otherinfo-row-label-div2" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Kapanganakan <i class="row-label-i">(Birthdate)</i></p>
                </div>
                <div class="otherinfo-row-label-div3" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Edad <i class="row-label-i">(Age)</i></p>
                </div>
                <div class="otherinfo-row-label-div4" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Kasarian <i class="row-label-i">(Gender)</i></p>
                </div>
                <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Civil Status</p>
                </div>
                <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                </div>
                <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                      <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                </div>
            </div>
            <div class="row-input" style="margin-top: -15px;">
                <div class="rel-timeend-row-input-div1 text-center">
                      <?php echo $row['cl_reltobene'];?>
                </div>
                <div class="rel-timeend-row-input-divs">
                      
                </div>
                <div class="rel-timeend-row-input-divs">
                      
                </div>
            </div>
            <div class="row-label">
                  <div class="rel-timeend-row-label-divs">
                        <p class="row-label-p">Relasyon sa Benepisyaryo <i class="row-label-i">(Relationship to the Beneficiary)</i></p>
                  </div>
                  <div class="rel-timeend-row-label-divs">
                  </div> 
                  <div class="rel-timeend-row-label-divs">
                  <div class="div-time-end">
                        <p class="timeend-p">Time End:</p>
                  <div class="time-end2 text-center">
                        <?php echo date_format(new DateTime($row_tbl_addl_entry['date_added']), "h:i A");?>
                  </div>
            </div>
        </div>
        </div><br>
        <div class="container-bene2 container-fluid">
            <div class="info-bene-title">
                <p>IMPORMASYON NG BENEPISYARYO <i>(Beneficiary's Identifying Information)</i></p>
            </div>
                  <?php
                        if ($row['bn_reltoclient'] == "Self") {
                        ?>
                          <div class="row-input">
                                <div class="name-row-input-divs1 text-center">
                                      <?php echo "Same";?>
                                </div>
                                <div class="name-row-input-divs1 text-center">
                                      <?php echo "--";?>
                                </div>
                                <div class="name-row-input-divs1 text-center">
                                      <?php echo "--";?>
                                </div>
                                <div class="name-row-input-divs2 text-center">
                                      <?php echo "--";?>
                                </div>
                          </div>
                          <div class="row-label text-center">
                                <div class="name-row-label-divs1">
                                      <p class="row-label-p">Apelyido <i class="row-label-i">(Last Name)</i></p>
                                </div>
                                <div class="name-row-label-divs1">
                                      <p class="row-label-p">Unang Pangalan <i class="row-label-i">(First Name)</i></p>
                                </div>
                                <div class="name-row-label-divs1">
                                      <p class="row-label-p">Gitnang Pangalan <i class="row-label-i">(Middle Name)</i></p>
                                </div>
                                <div class="name-row-label-divs2">
                                      <p class="row-label-p">Ext. <i class="row-label-i">(Sr,Jr,I,II)</i></p>
                                </div>
                          </div>
                          <div class="row-input">
                                <div class="address-row-input-div1 text-center">
                                      <?php echo "--";?>
                                </div>
                                <div class="address-row-input-div text-center">
                                      <?php echo "--";?>
                                </div>
                                <div class="address-row-input-div text-center">
                                      <?php echo "--";?>
                                </div>
                                <div class="address-row-input-div text-center">
                                      <?php echo "--";?>
                                </div>
                                <div class="address-row-input-div2 text-center">
                                      <?php echo "--";?>
                                </div>
                          </div>
                          <div class="row-label text-center">
                                <div class="address-row-label-div1">
                                      <p class="row-label-p">House No./Street/Purok <i class="row-label-i">(Ex. 123 Sun)</i></p>
                                </div>
                                <div class="address-row-label-div">
                                      <p class="row-label-p">Barangay <i class="row-label-i">(Ex. Batasan)</i></p>
                                </div>
                                <div class="address-row-label-div">
                                      <p class="row-label-p">City/Municipality <i class="row-label-i">(Ex. Quezon City)</i></p>
                                </div>
                                <div class="address-row-label-div">
                                      <p class="row-label-p">Province/District <i class="row-label-i">(Ex. Dist. III)</i></p>
                                </div>
                                <div class="address-row-label-div2">
                                      <p class="row-label-p">Region <i class="row-label-i">(Ex. NCR)</i></p>
                                </div>
                          </div>
                          <div class="row-input">
                                <div class="otherinfo-row-input-div1">
                                      <?php echo "--";?>
                                </div>
                                <div class="otherinfo-row-input-div2">
                                      <?php echo "--";?>
                                </div>
                                <div class="otherinfo-row-input-div3">
                                      <?php echo "--";?>
                                </div>
                                <div class="otherinfo-row-input-div4">
                                      <?php echo "--";?>
                                </div>
                                <div class="otherinfo-row-input-div7">
                                      <?php echo "--";?>
                                </div>
                                <div class="otherinfo-row-input-div5">
                                      <?php echo "--";?>
                                </div>
                                <div class="otherinfo-row-input-div6">
                                      <?php echo "--";?>
                                </div>
                          </div>
                          <div class="row-label text-center">
                                <div class="otherinfo-row-label-div1" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Numero ng Telepono <i class="row-label-i">(Mobile No.)</i></p>
                                </div>
                                <div class="otherinfo-row-label-div2" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Kapanganakan <i class="row-label-i">(Birthdate)</i></p>
                                </div>
                                <div class="otherinfo-row-label-div3" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Edad <i class="row-label-i">(Age)</i></p>
                                </div>
                                <div class="otherinfo-row-label-div4" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Kasarian <i class="row-label-i">(Gender)</i></p>
                                </div>
                                <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Civil Status</p>
                                </div>
                                <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                                </div>
                                <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                                      <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                                </div>
                          </div>
                      <?php
                      }
                      else {
                      ?>
                      <div class="row-input text-center">
                          <div class="name-row-input-divs1">
                              <p><?php echo $row['bn_lname'];?></p>
                          </div>
                          <div class="name-row-input-divs1">
                              <p><?php echo $row['bn_fname'];?></p>
                          </div>
                          <div class="name-row-input-divs1">
                              <?php if (empty($row['bn_mname'])) {echo "N/A";} else { echo $row['bn_mname'];}?>
                          </div>
                          <div class="name-row-input-divs2">
                              <p><?php echo $row['bn_nameext'];?></p>
                          </div>
                      </div>
                      <div class="row-label text-center">
                          <div class="name-row-label-divs1">
                              <p class="row-label-p">Apelyido <i class="row-label-i">(Last Name)</i></p>
                          </div>
                          <div class="name-row-label-divs1">
                              <p class="row-label-p">Unang Pangalan <i class="row-label-i">(First Name)</i></p>
                          </div>
                          <div class="name-row-label-divs1">
                              <p class="row-label-p">Gitnang Pangalan <i class="row-label-i">(Middle Name)</i></p>
                          </div>
                          <div class="name-row-label-divs2">
                              <p class="row-label-p">Ext. <i class="row-label-i">(Sr,Jr,I,II)</i></p>
                          </div>
                      </div>
                      <div class="row-input">
                          <div class="address-row-input-div1 text-center">
                              <?php echo $row['bn_purok'];?>
                          </div>
                          <div class="address-row-input-div text-center">
                              <?php echo $row['bn_brgy'];?>
                          </div>
                          <div class="address-row-input-div text-center">
                              <?php echo $row['bn_mun'];?>
                          </div>
                          <div class="address-row-input-div text-center">
                              <?php echo $row['bn_prov'].' '.$row['bn_district'];?>
                          </div>
                          <div class="address-row-input-div2 text-center">
                              <?php echo $row['bn_region'];?>
                          </div>
                      </div>
                      <div class="row-label text-center">
                          <div class="address-row-label-div1">
                              <p class="row-label-p">House No./Street/Purok <i class="row-label-i">(Ex. 123 Sun)</i></p>
                          </div>
                          <div class="address-row-label-div">
                              <p class="row-label-p">Barangay <i class="row-label-i">(Ex. Batasan)</i></p>
                          </div>
                          <div class="address-row-label-div">
                              <p class="row-label-p">City/Municipality <i class="row-label-i">(Ex. Quezon City)</i></p>
                          </div>
                          <div class="address-row-label-div">
                              <p class="row-label-p">Province/District <i class="row-label-i">(Ex. Dist. III)</i></p>
                          </div>
                          <div class="address-row-label-div2">
                              <p class="row-label-p">Region <i class="row-label-i">(Ex. NCR)</i></p>
                          </div>
                      </div>
                      <div class="row-input">
                          <div class="otherinfo-row-input-div1">
                              <?php
                                  if (empty($row['bn_contact_num'])) {
                                      echo "N/A";
                                  } else {
                                      echo $row['bn_contact_num'];
                                  }
                              ?>
                          </div>
                          <div class="otherinfo-row-input-div2">
                              <?php echo date_format(new DateTime($row['bn_bday']), "M. d, Y");?>
                          </div>
                          <div class="otherinfo-row-input-div3">
                              <?php echo $row['bn_age'];?>
                          </div>
                          <div class="otherinfo-row-input-div4">
                              <?php echo $row['bn_sex'];?>
                          </div>
                          <div class="otherinfo-row-input-div7">
                              <?php echo $row['bn_cstatus'];?>
                          </div>
                          <div class="otherinfo-row-input-div5">
                              <?php echo $row['bn_occupation'];?>
                          </div>
                          <div class="otherinfo-row-input-div6">
                              <?php echo $row['bn_salary'];?>
                          </div>
                      </div>
                      <div class="row-label text-center">
                          <div class="otherinfo-row-label-div1" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Numero ng Telepono <i class="row-label-i">(Mobile No.)</i></p>
                          </div>
                          <div class="otherinfo-row-label-div2" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Kapanganakan <i class="row-label-i">(Birthdate)</i></p>
                          </div>
                          <div class="otherinfo-row-label-div3" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Edad <i class="row-label-i">(Age)</i></p>
                          </div>
                          <div class="otherinfo-row-label-div4" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Kasarian <i class="row-label-i">(Gender)</i></p>
                          </div>
                          <div class="otherinfo-row-label-div7" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Civil Status</p>
                          </div>
                          <div class="otherinfo-row-label-div5" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Trabaho <i class="row-label-i">(Occupation)</i></p>
                          </div>
                          <div class="otherinfo-row-label-div6" style=" height: 20px; padding: 0px;">
                              <p class="row-label-p">Buwanang Kita <i class="row-label-i">(Monthly Salary)</i></p>
                          </div>
                      <?php  
                      }
                  ?>
        </div><br>
                <div class="container-famcomposition container-fluid">
                    <div class="info-famcomposition-title">
                        <p>KOMPOSISYON NG PAMILYA <i>(Family Composition)</i></p>
                    </div>
                    <div class="famcomposition-header">
                        <div class="famcomposition text-center">
                            <p>Buong Pangalan <br><i>(Complete Name)</i></p>
                        </div>
                        <div class="famcomposition text-center">
                            <p>Relasyon sa Benepisyaryo <br><i>(Relationship to the Beneficiary)</i></p>
                        </div>
                        <div class="famcomposition2 text-center">
                            <p>Kapanganakan <br><i>(Birthday)</i></p>
                        </div>
                        <div class="famcomposition2 text-center">
                            <p>Edad <br><i>(Age)</i></p>
                        </div>
                        <div class="famcomposition text-center">
                            <p>Trabaho <br><i>(Occupation)</i></p>
                        </div>
                        <div class="famcomposition text-center">
                            <p>Buwanang Kita <br><i>(Monthly Salary)</i></p>
                        </div>
                    </div>
                    <?php
                        $sql2 = mysqli_query($conn,"SELECT * FROM tbl_famcomposition WHERE qn='".$_SESSION['cl_qn']."' ");
                        if ($sql2->num_rows > 0) {
                            while($row2 = mysqli_fetch_array($sql2)){
                                ?>
                                <div class="famcomposition-input-row">
                                    <div class="famcomposition-input text-center">
                                        <?php echo $row2['fname']." ".substr($row2['mname'],0,1).". ".$row2['lname']; if ($row2['nameext'] == "N/A") {
                                            echo ""; } else {echo ", ".$row2['nameext'];}
                                        ?>
                                    </div>
                                    <div class="famcomposition-input text-center">
                                        <?php echo $row2['reltobene'];?>
                                    </div>
                                    <div class="famcomposition2-input text-center">
                                        <?php echo date_format(new DateTime($row2['bday']), "M. d, Y");?>
                                    </div>
                                    <div class="famcomposition2-input text-center">
                                        <?php echo $row2['age'];?>
                                    </div>
                                    <div class="famcomposition-input text-center">
                                        <?php echo $row2['occupation'];?>
                                    </div>
                                    <div class="famcomposition-input text-center">
                                        <?php echo $row2['salary'];?>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="famcomposition-input-row">
                                <div class="famcomposition-input text-center">
                                    <?php echo "N/A"?>
                                </div>
                                <div class="famcomposition-input text-center">
                                    <?php echo "N/A"?>
                                </div>
                                <div class="famcomposition2-input text-center">
                                    <?php echo "N/A"?>
                                </div>
                                <div class="famcomposition2-input text-center">
                                    <?php echo "N/A"?>
                                </div>
                                <div class="famcomposition-input text-center">
                                    <?php echo "N/A"?>
                                </div>
                                <div class="famcomposition-input text-center">
                                    <?php echo "N/A"?>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="container-huwag container-fluid">
                    <div class="huwag-susulatan-title2">
                        <p>Part II: To be Filled out by DSWD Personnel</i></p>
                    </div>
                    <div class="table2">
                        <div class="bene-category">
                            <p class="text-center">Client Category</p>
                        </div>
                        <div class="sw-assessment">
                            <p class="text-center">Social Worker's Assessment</p>
                        </div>
                        <div class="bene-category2">
                            <div class="target-sector">
                                <p>Target Sector:</p>
                                <ul>
                                    <li>
                                        <div class="list-sector">
                                            <?php
                                                $cl_category=$row['cl_category'];
                                                if ($cl_category=="FHONA") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sector-p">FHONA</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                            <?php
                                                if ($cl_category=="WEDC") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sector-p">WEDC</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                                <?php
                                                      if ($cl_category=="CHILD") {
                                                            ?>
                                                                  <p class="p-check2">&#x2713;</p>
                                                            <?php
                                                      } else {

                                                      }
                                                ?>
                                                <p class="list-sector-p">CHILD</p>
                                                
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                                <?php
                                                      if ($cl_category=="CNSP") {
                                                            ?>
                                                                  <p class="p-check2">&#x2713;</p>
                                                            <?php
                                                      } else {

                                                      }
                                                ?>
                                                <p class="list-sector-p">CNSP</p>
                                                
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                            <?php
                                                if ($cl_category=="YNSP") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sector-p">YNSP</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                            <?php
                                                if ($cl_category=="PWD") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sector-p">PWD</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                            <?php
                                                if ($cl_category=="SC") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sector-p">SC</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sector">
                                            <?php
                                                if ($cl_category=="PLHIV") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sector-p">PLHIV</p>
                                            
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sub-category">
                                <p>Specify Sub-Category:</p>
                                <ul><li>
                                        <div class="list-sub-category">
                                            <?php
                                                $cl_subcategory=$row['cl_subcategory']; $cl_subcategory2=$row['cl_subcategory2'];
                                                if ($cl_subcategory=="Solo Parents") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="Solo Parents") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">Solo Parents</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="Indigenous People") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                        <p class="list-sub-category-p">Indigenous People: <u><?php echo $row['cl_ipAffiliation']; ?></u></p>
                                                    <?php
                                                } else if ($cl_subcategory2=="Indigenous People") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                        <p class="list-sub-category-p">Indigenous People: <u><?php echo $row['cl_ipAffiliation']; ?></u></p>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <p class="list-sub-category-p">Indigenous People</p>
                                                    <?php                                               
                                                }
                                            ?>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="Recovering Person who used drugs") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="Recovering Person who used drugs") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">Recovering Person who used drugs</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="4Ps DSWD Beneficiary") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="4Ps DSWD Beneficiary") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">4Ps DSWD Beneficiary</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="Street Dwellers") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="Street Dwellers") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">Street Dwellers</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="Psychosocial/Mental/Learning Disability") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="Psychosocial/Mental/Learning Disability") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">Psychosocial/Mental/Learning Disability</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="Stateless Person/Asylum Seekers/Refugees") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="Stateless Person/Asylum Seekers/Refugees") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">Stateless Person/Asylum Seekers/Refugees</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if ($cl_subcategory=="KIA/WIA") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else if ($cl_subcategory2=="KIA/WIA") {
                                                    ?>
                                                        <p class="p-check2">&#x2713;</p>
                                                    <?php
                                                } else {

                                                }
                                            ?>
                                            <p class="list-sub-category-p">KIA/WIA</p>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-sub-category">
                                            <?php
                                                if (($cl_subcategory!="Solo Parents")&&($cl_subcategory!="Indigenous People")&&($cl_subcategory!="Recovering Person who used drugs")&&($cl_subcategory!="4Ps DSWD Beneficiary")&&($cl_subcategory!="Street Dwellers")&&($cl_subcategory!="Psychosocial/Mental/Learning Disability")&&($cl_subcategory!="Stateless Person/Asylum Seekers/Refugees")&&($cl_subcategory!="N/A")) {
                                                    ?>
                                                       <p class="p-check2">&#x2713;</p>
                                                       <p class="list-sub-category-p">Others: <u><?php echo $cl_subcategory;?></u></p>
                                                    <?php
                                                } else if (($cl_subcategory2!="Solo Parents")&&($cl_subcategory2!="Indigenous People")&&($cl_subcategory2!="Recovering Person who used drugs")&&($cl_subcategory2!="4Ps DSWD Beneficiary")&&($cl_subcategory2!="Street Dwellers")&&($cl_subcategory2!="Psychosocial/Mental/Learning Disability")&&($cl_subcategory2!="Stateless Person/Asylum Seekers/Refugees")&&($cl_subcategory2!="KIA/WIA")&&($cl_subcategory2!="N/A")) {
                                                    ?>
                                                         <p class="p-check2">&#x2713;</p>
                                                       <p class="list-sub-category-p">Others: <u><?php echo "/".$cl_subcategory2."/";?></u></p>
                                                    <?php
                                                } else if (($cl_subcategory=='N/A')||($cl_subcategory2=='N/A')) { ?>
                                                                        <p class="list-sub-category-p">Others</p>
                                                                        <?php
                                                                  } else { ?>
                                                    <p class="list-sub-category-p">Others</p>
                                                    <?php
                                                };
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sw-assessment2">
                            <p style="font-size: 12px; line-height: 1; display: inline-flex; overflow-wrap: anywhere;"><?php echo $row_tbl_addl_entry['assessment'];?></p>
                        </div>
                    </div>
                </div>
                <div class="container-assistance container-fluid">
                    <div class="assistance-col">
                        <p>Financial Assistance:</p>
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
                                    <p class="list-sub-category-p">Medical</p>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        if ($row_tbl_addl_entry['assistance_type'] == "FUNERAL") {
                                            ?>
                                            <p class="p-check">&#x2713;</p>
                                            <?php
                                        } else {}
                                    ?>
                                    <p class="list-sub-category-p">Funeral</p>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <p class="list-sub-category-p">Transportation</p>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <p class="list-sub-category-p">Educational</p>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="assistance-col" style="left: 110px; top: 37px;">
                        <ul>
                            <li>
                                <div class="list-sub-category">
                                    <p class="list-sub-category-p">Food Assistance</p>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <p class="list-sub-category-p" style="width: 197px;">Cash Relief Assistance</p>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <p class="list-sub-category-p" style="width: 197px;">Emergency Cash Transfer-AICS</p>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="assistance-col" style="left: 300px;">
                        <p>Material Assistance:</p>
                        <ul>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        $count = count($material_assistance_arrval)-1;
                                        //Loop through each array index
                                        for($i = 0; $i <= $count; $i++) {
                                            //Assign the value of the array key to a variable
                                            $value = $material_assistance_arrval[$i];
                                            //Check if result string contains diam-mm
                                            if ($value == 'Family Food Packs'){
                                                ?>
                                                <p class="p-check">&#x2713;</p>
                                                <?php
                                            } else {
                                                
                                            }
                                        }
                                    ?>
                                    <p class="list-sub-category-p">Family Food Packs</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        $count = count($material_assistance_arrval)-1;
                                        //Loop through each array index
                                        for($i = 0; $i <= $count; $i++) {
                                            //Assign the value of the array key to a variable
                                            $value = $material_assistance_arrval[$i];
                                            //Check if result string contains diam-mm
                                            if ($value == 'Other Food Items'){
                                                ?>
                                                <p class="p-check">&#x2713;</p>
                                                <?php
                                            } else {
                                                
                                            }
                                        }
                                    ?>
                                    <p class="list-sub-category-p">Other Food Items</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        $count = count($material_assistance_arrval)-1;
                                        //Loop through each array index
                                        for($i = 0; $i <= $count; $i++) {
                                            //Assign the value of the array key to a variable
                                            $value = $material_assistance_arrval[$i];
                                            //Check if result string contains diam-mm
                                            if ($value == 'Hygiene & Sleeping Kits'){
                                                ?>
                                                <p class="p-check">&#x2713;</p>
                                                <?php
                                            } else {
                                                
                                            }
                                        }
                                    ?>
                                    <p class="list-sub-category-p">Hygiene & Sleeping Kits</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        $count = count($material_assistance_arrval)-1;
                                        //Loop through each array index
                                        for($i = 0; $i <= $count; $i++) {
                                            //Assign the value of the array key to a variable
                                            $value = $material_assistance_arrval[$i];
                                            //Check if result string contains diam-mm
                                            if ($value == 'Assistive Device & Technologies'){
                                                ?>
                                                <p class="p-check">&#x2713;</p>
                                                <?php
                                            } else {
                                                
                                            }
                                        }
                                    ?>
                                    <p class="list-sub-category-p">Assistive Device & Technologies</p>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="assistance-col" style="left: 485px;"> 
                        <p>Psychosocial Support:</p>
                        <ul>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        $count = count($psycho_support_arrval)-1;
                                        //Loop through each array index
                                        for($i = 0; $i <= $count; $i++) {
                                            //Assign the value of the array key to a variable
                                            $value = $psycho_support_arrval[$i];
                                            //Check if result string contains diam-mm
                                            if ($value == 'Psychological First Aid (PAF)'){
                                                ?>
                                                <p class="p-check">&#x2713;</p>
                                                <?php
                                            } else {
                                                
                                            }
                                        }
                                    ?>
                                    <p class="list-sub-category-p">Psychological First Aid</p>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="list-sub-category">
                                    <?php
                                        $count = count($psycho_support_arrval)-1;
                                        //Loop through each array index
                                        for($i = 0; $i <= $count; $i++) {
                                            //Assign the value of the array key to a variable
                                            $value = $psycho_support_arrval[$i];
                                            //Check if result string contains diam-mm
                                            if ($value == 'Social Work Counseling'){
                                                ?>
                                                <p class="p-check">&#x2713;</p>
                                                <?php
                                            } else {
                                                
                                            }
                                        }
                                    ?>
                                    <p class="list-sub-category-p">Social Work Counseling</p>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="assistance-col" style="left: 659px; width: 136px;">
                        <p>Referral:</p>
                        <p style="font-size: 9px; overflow-wrap: anywhere;"><u>
                            <?php echo $row_tbl_addl_entry['referral'];?>
                        </u></p>
                    </div>

                </div>
                <div class="container-provided container-fluid">
                    <div class="provided-col1 text-center">
                        <p>Assistance Provided</p>
                    </div>
                    <div class="provided-col2 text-center">
                        <p>Amount</p>
                    </div>
                    <div class="provided-col3 text-center">
                        <p>Fund Source</p>
                    </div>
                </div>
                <div class="container-provided input1 container-fluid">
                    <div class="provided-col1">
                        <p style="margin-top: -2px;">1) <?php echo $row_tbl_addl_entry['assistance_type'];?> Assistance</p>
                    </div>
                    <div class="provided-col2">
                        <p style="margin-top: -2px;" class="text-center">&#8369;<?php echo number_format($row_tbl_addl_entry['amount_in_figures'],2);?></p>
                    </div>
                    <div class="provided-col3">
                        <p style="margin-top: -2px;" class="text-center"><?php echo $row_tbl_addl_entry['fund_source'];?></p>
                    </div>
                </div>
                <div class="container-provided input2 container-fluid">
                    <div class="provided-col1">
                        <p style="margin-top: -2px;">2) <?php echo $row_tbl_addl_entry['material_assistance'];?></p>
                    </div>
                    <div class="provided-col2">
                        <p></p>
                    </div>
                    <div class="provided-col3">
                        <p></p>
                    </div>
                </div>
                <div class="container-provided input3 container-fluid">
                    <div class="provided-col1">
                        <p style="margin-top: -2px;">3) <?php echo $row_tbl_addl_entry['psycho_support'];?></p>
                    </div>
                    <div class="provided-col2">
                        <p></p>
                    </div>
                    <div class="provided-col3">
                        <p></p>
                    </div>
                </div>
                <div class="container-signatory container-fluid">
                    <div class="client-sig text-center">
                        <p class="iDeclare">"We are committed to protect and respect the privacy of our clients and beneficiaries and we will only collect, record, store, process and use personal information in accordance with Republic Act No. 10173 or the Data Privacy Act of 2012. By signing this form you are giving your consent to the DSWD and hereby agree to the terms and conditions set herein and with the applicable Data Privacy Policy of the Department."</p>
                        <p class="print_view_gis" style="margin-top: 9px; background-color: yellow; padding-top: 15px;"><u><b>
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
                                    }?> 
                        </b></u></p>
                        <p>Buong Pangalan at Pirma</p>
                        <i>(Signature over Printed Name)</i>
                    </div>
                    <div class="client-tmark">
                        <div class="thumbmark"></div>
                    </div>
                    <div class="interviewedby text-center">
                        <br><br><p>Interviewed by:</p><br><br>
                        <p><u><b>
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
                        </b></u></p>
                        <p>Social Worker</p>
                        <i>(Signature over Printed Name)</i>
                    </div>
                    <div class="approvedby text-center">
                        <br><br><p>Reviewed and Approved by:</p><br><br>
                        <?php
                            $sql_approv_gis = mysqli_query($conn,"SELECT * FROM tbl_signatories WHERE designation = 'SDN SWAD Team Leader' ");
                            $row_approv_gis = mysqli_fetch_assoc($sql_approv_gis);
                        ?>
                        <p style="margin: 0px;"><b><u><?php echo strtoupper($row_approv_gis['fname'])." "; if (empty($row_approv_gis['mname'])) { echo ""; } else { echo strtoupper(substr($row_approv_gis['mname'],0,1)).". "; } echo strtoupper($row_approv_gis['lname']); if ($row_approv_gis['nameext'] == "N/A") { echo ""; } else { echo ", ".$row_approv_gis['nameext']; } if (empty($row_approv_gis['suffix'])) {echo ''; } else { echo ', '.$row_approv_gis['suffix']; } ?></u></b></p>
                        <p>Approving Authority</p>
                        <i>(Signature over Printed Name)</i>
                    </div>
                </div>
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