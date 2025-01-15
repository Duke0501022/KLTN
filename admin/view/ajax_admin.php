<?php
session_start();
include_once(__DIR__ . '/../model/mTuVanKH.php');
require_once __DIR__ . '/../../vendor/autoload.php';

use Pusher\Pusher;

header('Content-Type: application/json');

try {
    if (isset($_POST['action']) && $_POST['action'] === 'send_message') {
        $message = $_POST['message'] ?? '';
        $sender_id = $_POST['sender_id'];
        $receiver_id = $_POST['receiver_id'];
        $image_url = null;

        // Handle image upload if present
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            
            if (in_array($file['type'], $allowed_types)) {
                $upload_dir = '../../uploads/chat/';
                
                // Create directory if it doesn't exist
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Generate unique filename
                $filename = uniqid() . '_' . basename($file['name']);
                $upload_path = $upload_dir . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                    $image_url = 'uploads/chat/' . $filename;
                }
            }
        }


        if (isset($_SESSION['idChuyenVien'])) {
            $idChuyenVien = $_SESSION['idChuyenVien'];
            $tuvan = new mTuVanKH();

            // Insert chat message with optional image
            $insert_chat = $tuvan->insert_tuvanchuyengia($sender_id, $receiver_id, $message, $image_url);

            if ($insert_chat) {
                // Pusher configuration
                $options = [
                    'cluster' => 'ap1',
                    'useTLS' => true
                ];
                $pusher = new Pusher(
                    '03dc77ca859c49e35e41',
                    '5f7dc7d158c95e25a5e2',
                    '1873489',
                    $options
                );

                // Send event to Pusher
                $data = [
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'message' => $message,
                    'image_url' => $image_url,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $pusher->trigger('chat-channel', 'new-message', $data);

                $response['success'] = true;
                $response['image_url'] = $image_url;
            } else {
                error_log("Failed to insert message");
                $response['error'] = 'Could not insert message';
            }
        } else {
            error_log("Session variables not set correctly");
            $response['error'] = 'Session variables not set correctly';
        }
    } elseif (isset($_GET['action']) && $_GET['action'] === 'get_messages') {
        $sender_id = $_GET['sender_id'];
        $receiver_id = $_GET['receiver_id'];

        $tuvan = new mTuVanKH();
        $messages = $tuvan->get_messages($sender_id, $receiver_id);

        if ($messages !== false) {
            $response['success'] = true;
            $response['messages'] = $messages;
        } else {
            error_log("Failed to retrieve messages");
            $response['error'] = 'Could not retrieve messages';
        }
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
?>