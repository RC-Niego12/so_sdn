<?php
session_start();
include 'config.php';

// Verify session
if (!isset($_SESSION['staffid'])) {
    die(json_encode(array("error" => "Session staffid not set")));
}

// Read parameters sent from DataTables
$limit = isset($_POST['length']) ? intval($_POST['length']) : 10;
$offset = isset($_POST['start']) ? intval($_POST['start']) : 0;
$search_value = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
$order_column_index = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'DESC';

// Define the columns mapping
$columns = array('cl_qn', 'cl_status', 'cl_lname', 'cl_fname', 'cl_mname', 'cl_nameext', 'cl_category',
    'bn_lname', 'bn_fname', 'bn_mname', 'bn_nameext', 'bn_category', 'date_addedd', 'assistance_type',
    'remarks', 'verifier', 'queue_status');

// Total records count without filtering
$total_records_query = " SELECT COUNT(*) AS total FROM tbl_assign_table INNER JOIN tbl_clientqueue
    ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn INNER JOIN tbl_sw_table ON
    tbl_assign_table.table_num = tbl_sw_table.table_num ";
$total_records_result = $conn->query($total_records_query);
$total_records = $total_records_result ? $total_records_result->fetch_assoc()['total'] : 0;

// Base query
$sql = " SELECT * FROM tbl_assign_table INNER JOIN tbl_clientqueue
    ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn INNER JOIN tbl_sw_table ON
    tbl_assign_table.table_num = tbl_sw_table.table_num WHERE staffid2 = '".$_SESSION['staffid']."' ";

$search_query = '';
if (!empty($search_value)) {
    $search_query .= " AND (cl_qn LIKE '%$search_value%'
    )
    ";
} else {}

// Individual column searches
for ($i = 0; $i < count($columns); $i++) {
    if (isset($_POST['columns'][$i]['search']['value']) && $_POST['columns'][$i]['search']['value'] != '') {
        $search_query .= " AND " . $columns[$i] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
    }
}

// Ordering query
$order_query = " ORDER BY " . $columns[$order_column_index] . " " . $conn->real_escape_string($order_dir);

// Filtered records count
$filtered_records_result = $conn->query("SELECT COUNT(*) AS total FROM tbl_assign_table INNER JOIN tbl_clientqueue
    ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn INNER JOIN tbl_sw_table ON
    tbl_assign_table.table_num = tbl_sw_table.table_num WHERE staffid2 = '".$_SESSION['staffid']."'" . $search_query);
if ($filtered_records_result) {
    $filtered_records = $filtered_records_result->fetch_assoc()['total'];
} else {
    $filtered_records = 0;
}

// Data query with limit and offset
$data_query = "SELECT * FROM tbl_assign_table INNER JOIN tbl_clientqueue
    ON tbl_assign_table.cl_qnn = tbl_clientqueue.cl_qn INNER JOIN tbl_sw_table ON
    tbl_assign_table.table_num = tbl_sw_table.table_num  WHERE staffid2 = '".$_SESSION['staffid']."'
    " . $search_query . $order_query . " LIMIT " . intval($limit) . " OFFSET " . intval($offset);
$data_result = $conn->query($data_query);

$data = array();
if ($data_result && $data_result->num_rows > 0) {
    while ($row = $data_result->fetch_assoc()) {
        
        $row['date_addedd'] = date('h:i A', strtotime($row['date_added']));
        $data[] = $row;
    }
}

// Prepare response
$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $total_records,
    "recordsFiltered" => $filtered_records,
    "data" => $data
);

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>