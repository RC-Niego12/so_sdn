<?php
	session_start();
    $_SESSION['cl_qn2'];
	include 'config.php';

    $bn_purok = $_SESSION['bn_purok'];
	$bn_brgy = $_SESSION['bn_brgy_name'];
	$bn_brgy_code = $_SESSION['bn_brgy_code'];
	$bn_mun = $_SESSION['bn_mc_name'];
	$bn_mun_code = $_SESSION['bn_mc_code'];
	$bn_prov = $_SESSION['bn_pd_name'];
	$bn_prov_code = $_SESSION['bn_pd_code'];
	$bn_district = $_SESSION['bn_dist']; 
	$bn_region = $_SESSION['bn_reg_name'];
	$bn_region_code = $_SESSION['bn_reg_code'];
    
    //insert staff
	$sql = "UPDATE tbl_save_clientbene SET bn_purok='$bn_purok', bn_brgy='$bn_brgy', bn_brgy_code='$bn_brgy_code', bn_mun='$bn_mun', bn_mun_code='$bn_mun_code', bn_prov='$bn_prov', bn_prov_code='$bn_prov_code', bn_district='$bn_district', bn_region='$bn_region', bn_region_code='$bn_region_code' WHERE id_tbl_save_clientbene ='".$_SESSION['cl_qn2']."' ";
        if ($conn->query($sql) === TRUE) {
		    echo "Bene Address updated successfully!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	$conn->close();
	header("location: modify_cl_bn_sw.php");
?>