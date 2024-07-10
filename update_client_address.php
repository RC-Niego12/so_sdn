<?php
	session_start();
	$_SESSION['qn'];
	include 'config.php';
	$sql_clq = mysqli_query($conn,"SELECT * FROM tbl_clientqueue WHERE cl_qn='".$_SESSION['qn']."' ");
    $row_clq = mysqli_fetch_assoc($sql_clq);

	$cl_purok = $_SESSION['cl_purok'];
	$cl_brgy = $_SESSION['cl_brgy_name'];
	$cl_brgy_code = $_SESSION['cl_brgy_code'];
	$cl_mun = $_SESSION['cl_mc_name'];
	$cl_mun_code = $_SESSION['cl_mc_code'];
	$cl_prov = $_SESSION['cl_pd_name'];
	$cl_prov_code = $_SESSION['cl_pd_code'];
	$cl_district = $_SESSION['cl_dist']; 
	$cl_region = $_SESSION['cl_reg_name'];
	$cl_region_code = $_SESSION['cl_reg_code'];
    
    //update client address
    if ($row_clq['cl_reltobene'] == "Self") {
		$sql = "UPDATE tbl_clientqueue SET cl_purok='$cl_purok', cl_brgy='$cl_brgy', cl_brgy_code='$cl_brgy_code', cl_mun='$cl_mun', cl_mun_code='$cl_mun_code', cl_prov='$cl_prov', cl_prov_code='$cl_prov_code', cl_district='$cl_district', cl_region='$cl_region', cl_region_code='$cl_region_code', bn_purok='$cl_purok', bn_brgy='$cl_brgy', bn_brgy_code='$cl_brgy_code', bn_mun='$cl_mun', bn_mun_code='$cl_mun_code', bn_prov='$cl_prov', bn_prov_code='$cl_prov_code', bn_district='$cl_district', bn_region='$cl_region', bn_region_code='$cl_region_code' WHERE cl_qn='".$_SESSION['qn']."' ";
        if ($conn->query($sql) === TRUE) {
		    echo "Client/Bene Address updated successfully!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
    } else {
		$sql = "UPDATE tbl_clientqueue SET cl_purok='$cl_purok', cl_brgy='$cl_brgy', cl_brgy_code='$cl_brgy_code', cl_mun='$cl_mun', cl_mun_code='$cl_mun_code', cl_prov='$cl_prov', cl_prov_code='$cl_prov_code', cl_district='$cl_district', cl_region='$cl_region', cl_region_code='$cl_region_code' WHERE cl_qn='".$_SESSION['qn']."' ";
        if ($conn->query($sql) === TRUE) {
		    echo "Client Address updated successfully!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}
	$conn->close();
    header("location: viewGIS.php");
	?>