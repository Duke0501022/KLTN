<?php
require_once('../Model/Connect.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["order_id"])) {
    $order_id = $_POST["order_id"];
    $result = $conn->query("SELECT payment_status FROM tb_payments WHERE order_id = {$order_id}");
    if ($result) {
        $payment = $result->fetch_object();
        if ($payment) {
            echo json_encode(['payment_status' => $payment->payment_status]);
        } else {
            echo json_encode(['payment_status' => 'Unpaid']);
        }
    } else {
        echo json_encode(['payment_status' => 'Unpaid']);
    }
}
?>