<?php
// include_once("Model/Connect.php");
include_once(__DIR__ . '/Connect.php');


class mTuVanChuyenGia
{
    function getTestCG()
    {
        $p = new clsketnoi();
        $conn = null;
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT idChuyenVien, hinhAnh, hoTen, moTa, 
                      CASE 
                          WHEN statuss = 'online' AND TIMESTAMPDIFF(MINUTE, last_activity, NOW()) < 2 THEN 'Online'
                          ELSE 'Offline'
                      END AS status
                      FROM chuyenvien";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    public function select_ChuyenGia($idChuyenVien)
    {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn); // Thêm $conn vào đây
        if ($conn) { // Kiểm tra kết nối
            $string = "SELECT * FROM chuyenvien WHERE  idChuyenVien = '$idChuyenVien'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    public function insert_tuvanchuyengia($sender_id, $receiver_id, $message, $image_url = null) {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn);
        
        if ($conn) {
            // Clean the message text
            $message = mysqli_real_escape_string($conn, $message);
            
            // If image_url is provided, clean it. Otherwise it stays null
            $image_url = $image_url ? mysqli_real_escape_string($conn, $image_url) : null;
            
            // Build SQL query - will include image_url only if provided
            $sql = "INSERT INTO messages (sender_id, receiver_id, message, image_url, created_at) 
                    VALUES ('$sender_id', '$receiver_id', '$message', " . 
                    ($image_url ? "'$image_url'" : "NULL") . ", NOW())";
            
            $result = mysqli_query($conn, $sql);
            
            $p->dongketnoi($conn);
            return $result;
        }
        return false;
    }

    public function get_messages($sender_id, $receiver_id) {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn);
        
        if ($conn) {
            $sql = "SELECT * FROM messages 
                    WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id')
                    OR (sender_id = '$receiver_id' AND receiver_id = '$sender_id')
                    ORDER BY created_at ASC";
                    
            $result = mysqli_query($conn, $sql);
            $messages = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $messages[] = $row;
            }
            
            $p->dongketnoi($conn);
            return $messages;
        }
        return [];
    }
    public function get_new_messages($sender_id, $receiver_id) {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn);
        
                if ($conn) {
                    $sql = "SELECT sender_id, receiver_id, message, image_url, created_at FROM messages WHERE 
                    (sender_id = ? AND receiver_id = ?) OR 
                    (sender_id = ? AND receiver_id = ?)
                    ORDER BY created_at ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $messages = [];
            while ($row = $result->fetch_assoc()) {
                if ($row['image_url']) {
                    $row['image_url'] = '/admin/uploads/chat/' . basename($row['image_url']);
                }
                $messages[] = $row;
            }
            return $messages;
        }
            }

}
