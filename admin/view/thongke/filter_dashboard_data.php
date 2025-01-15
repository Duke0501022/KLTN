<?php
include_once("model/LSTV/mLSTV.php");

$lstv = new mLSTV();
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

// Kiểm tra giá trị của $start_date và $end_date
if (!$start_date || !$end_date) {
    echo json_encode(['error' => 'Invalid date range']);
    exit;
}

$data1 = $lstv->count_datlich($start_date, $end_date);
$data2 = $lstv->count_dtdatlich($start_date, $end_date);

$dates1 = [];
$counts = [];
$total_appointments = 0;
foreach ($data1 as $row) {
    $dates1[] = $row['date'];
    $counts[] = $row['count'];
    $total_appointments += $row['count'];
}

$dates2 = [];
$totals = [];
$total_revenue = 0;
foreach ($data2 as $row) {
    $dates2[] = $row['create_at'];
    $totals[] = $row['total'];
    $total_revenue += $row['total'];
}

echo json_encode([
    'dates1' => $dates1,
    'counts' => $counts,
    'dates2' => $dates2,
    'totals' => $totals,
    'total_revenue' => $total_revenue,
    'total_appointments' => $total_appointments
]);