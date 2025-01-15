<?php
// get_linhvuc.php

header('Content-Type: application/json'); // Add content type header
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/KLTN_PJ/admin/');
include_once(BASE_PATH ."model/connect.php");

if (isset($_GET['unit_id'])) { // Change to match frontend parameter name
    $idUnit = $_GET['unit_id'];
    
    $p = new ketnoi();
    if($p->moketnoi($conn)) {
        $query = "SELECT  lv.* 
                 FROM linhvuc lv
                 INNER JOIN unit u ON u.idUnit = lv.idUnit
                 WHERE u.idUnit = ?";
                 
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $idUnit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $linhvuc = array();
        while($row = $result->fetch_assoc()) {
            $linhvuc[] = $row;
        }
        
        echo json_encode($linhvuc);
        $p->dongketnoi($conn);
    } else {
        echo json_encode(['error' => 'Database connection failed']);
    }
} else {
    echo json_encode(['error' => 'No unit_id provided']);
}
?>