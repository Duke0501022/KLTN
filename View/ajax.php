<?php
session_start();
include_once(__DIR__ . '/../Model/mTuVanChuyenGia.php');
require '../vendor/autoload.php';
use Pusher\Pusher;

header('Content-Type: application/json');
$response = ['success' => false];

try {
    // Initialize Pusher
    $options = ['cluster' => 'ap1', 'useTLS' => true];
    $pusher = new Pusher(
        '03dc77ca859c49e35e41',
        '5f7dc7d158c95e25a5e2',
        '1873489',
        $options
    );

    if (isset($_POST['action']) && $_POST['action'] === 'send_message') {
        $message = trim($_POST['message'] ?? '');
        $sender_id = $_POST['sender_id'];
        $receiver_id = $_POST['receiver_id'];

        $tuvan = new mTuVanChuyenGia();
        $result = $tuvan->insert_tuvanchuyengia($sender_id, $receiver_id, $message);

        if ($result) {
            // Send to Pusher
            $data = [
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'message' => $message,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $pusher->trigger('chat-channel-host', 'new-message', $data);
            
            $response['success'] = true;
        }

    } elseif (isset($_GET['action']) && $_GET['action'] === 'get_messages') {
        $sender_id = $_GET['sender_id'];
        $receiver_id = $_GET['receiver_id'];

        $tuvan = new mTuVanChuyenGia();
        $messages = $tuvan->get_messages($sender_id, $receiver_id);

        $response['success'] = true;
        $response['messages'] = $messages;
    }

} catch (Exception $e) {
    error_log("Chat Error: " . $e->getMessage());
    $response['error'] = 'An error occurred';
}

echo json_encode($response);