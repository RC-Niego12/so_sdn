<?php
session_start();
include 'config.php';

// Read parameters sent from DataTables
$limit = isset($_POST['length']) ? intval($_POST['length']) : 10;
$offset = isset($_POST['start']) ? intval($_POST['start']) : 0;
$search_value = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
$order_column_index = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'DESC';

// Define the columns mapping
$columns = array('id_tbl_save_clientbene', 'cl_lname', 'cl_fname', 'cl_mname', 'cl_nameext', 'cl_age', 'cl_cstatus',
    'cl_sex', 'cl_purok', 'cl_brgy', 'cl_mun', 'cl_prov', 'cl_region', 'cl_category', 'bn_lname', 'bn_fname', 'bn_mname', 'bn_nameext',
    'bn_age', 'bn_cstatus', 'bn_sex', 'bn_category', 'cl_reltobene', 'assistance_type', 'purpose', 'amt_fig', 'assessment', 'release_mode', 'date_issued',
    'sp', 'transaction_code', 'lname', 'fname', 'mname', 'nameext', 'cancellation', 'remarks', 'date_cancelledd');

// Total records count without filtering
$total_records_result = $conn->query("SELECT COUNT(*) AS total FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry");
if ($total_records_result) {
    $total_records = $total_records_result->fetch_assoc()['total'];
} else {
    $total_records = 0;
}

// Base query
$sql = "SELECT * FROM tbl_save_clientbene 
        INNER JOIN tbl_save_addl_entry 
        ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry";

$search_query = '';
if (!empty($search_value)) {
    $search_query .= " WHERE (id_tbl_save_clientbene LIKE '%$search_value%'
    )";
} else {}

// Individual column searches
for ($i = 0; $i < count($columns); $i++) {
    if (isset($_POST['columns'][$i]['search']['value']) && $_POST['columns'][$i]['search']['value'] != '') {
        $search_query .= (empty($search_query) ? ' WHERE ' : ' AND ') . $columns[$i] . " LIKE '%" .
        $_POST['columns'][$i]['search']['value'] . "%'";
    }
}

// Ordering query
$order_query = " ORDER BY " . $columns[$order_column_index] . " " . $conn->real_escape_string($order_dir);

// Filtered records count
$filtered_records_result = $conn->query("SELECT COUNT(*) AS total FROM tbl_save_clientbene INNER JOIN tbl_save_addl_entry
    ON tbl_save_clientbene.id_tbl_save_clientbene = tbl_save_addl_entry.id_tbl_save_addl_entry" . $search_query);
if ($filtered_records_result) {
    $filtered_records = $filtered_records_result->fetch_assoc()['total'];
} else {
    $filtered_records = 0;
}

// Total amt count without filtering
$total_amt_result = $conn->query("SELECT SUM(amt_fig) AS total_amt FROM tbl_save_addl_entry");
if ($total_amt_result) {
    $total_amt = $total_amt_result->fetch_assoc()['total_amt'];
} else {
    $total_amt = 0;
}

// Data query with limit and offset
$data_query = "SELECT * FROM tbl_save_addl_entry INNER JOIN tbl_save_clientbene ON 
    tbl_save_addl_entry.id_tbl_save_addl_entry = tbl_save_clientbene.id_tbl_save_clientbene
    INNER JOIN tbl_staffs ON  tbl_save_addl_entry.swo_staffid = tbl_staffs.staffid
    " . $search_query . $order_query . " LIMIT " . intval($limit) . " OFFSET " . intval($offset);
$data_result = $conn->query($data_query);

$data = array();
if ($data_result && $data_result->num_rows > 0) {
    while ($row = $data_result->fetch_assoc()) {
        // Format amount
        $row['cl_lname'] = mysqli_real_escape_string($conn, $row['cl_lname']);
        // Format amount
        $row['amt_fig'] = $row['amount_in_figures'];

        // Format date issued
        $row['date_issued'] = date('M. d, Y', strtotime($row['time_end']));

        // Format date cancelled
        if ($row['date_cancelled'] != '0000-00-00') {
            $row['date_cancelledd'] = date('M. d, Y', strtotime($row['date_cancelled']));
        } else {
            $row['date_cancelledd'] = 'N/A';
        }

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