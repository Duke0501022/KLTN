<?php
include_once(__DIR__ . '/connect.php');

class mTuVanKH
{   
    public function select_PhuHuynh($idPhuHuynh)
    {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn); // Thêm $conn vào đây
        if ($conn) { // Kiểm tra kết nối
            $string = "SELECT * FROM phuhuynh  WHERE  idPhuHuynh = '".$idPhuHuynh."'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    public function getTestPH()
    {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn); // Thêm $conn vào đây
        if ($conn) { // Kiểm tra kết nối
            $string = "SELECT * FROM phuhuynh";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    public function insert_tuvanchuyengia($sender_id, $receiver_id, $message, $image_url = null) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        
        if ($conn) {
            $message = mysqli_real_escape_string($conn, $message);
            $image_url = $image_url ? mysqli_real_escape_string($conn, $image_url) : null;
            
            $sql = "INSERT INTO messages (sender_id, receiver_id, message, image_url, created_at) 
                    VALUES ('$sender_id', '$receiver_id', '$message', " . 
                    ($image_url ? "'$image_url'" : "NULL") . ", NOW())";
            
            error_log("SQL Query: " . $sql); // Debug log
            
            $result = mysqli_query($conn, $sql);
            
            if (!$result) {
                error_log("MySQL Error: " . mysqli_error($conn)); // Debug log
            }
            
            $p->dongketnoi($conn);
            return $result;
        }
        return false;
    }

    public function get_messages($sender_id, $receiver_id) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        
        if ($conn) {
            $sql = "SELECT * FROM messages 
                    WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id')
                    OR (sender_id = '$receiver_id' AND receiver_id = '$sender_id')
                    ORDER BY created_at ASC";
            $result = mysqli_query($conn, $sql);
            
            if (!$result) {
                throw new mysqli_sql_exception(mysqli_error($conn));
            }
            
            $messages = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $messages[] = $row;
            }
            
            $p->dongketnoi($conn);
            return $messages;
        }
        return false;
    }

    public function get_new_messages($sender_id, $receiver_id) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        
        if ($conn) {
            $sql = "SELECT * FROM messages 
                    WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id' 
                    AND is_read = 0 ORDER BY created_at ASC";
            $result = mysqli_query($conn, $sql);
            
            if (!$result) {
                throw new mysqli_sql_exception(mysqli_error($conn));
            }
            
            $messages = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $messages[] = $row;
            }
            
            $p->dongketnoi($conn);
            return $messages;
        }
        return false;
    }
    public function get_latest_message($sender_id, $receiver_id) {
        try {
            $p = new ketnoi();
            $conn = $p->moketnoi($conn);
            
            $sql = "SELECT * FROM messages 
                    WHERE (sender_id = ? AND receiver_id = ?) 
                    OR (sender_id = ? AND receiver_id = ?)
                    ORDER BY created_at DESC LIMIT 1";
            
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new mysqli_sql_exception(mysqli_error($conn));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            $message = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            $p->dongketnoi($conn);
            
            return $message;
        } catch (Exception $e) {
            error_log("Error getting latest message: " . $e->getMessage());
            return false;
        }
    }

    public function mark_read($sender_id, $receiver_id) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        
        if ($conn) {
            $sql = "UPDATE messages SET is_read = 1 
                    WHERE sender_id = '$receiver_id' AND receiver_id = '$sender_id' 
                    AND is_read = 0";
            $result = mysqli_query($conn, $sql);
            
            if (!$result) {
                throw new mysqli_sql_exception(mysqli_error($conn));
            }
            
            $p->dongketnoi($conn);
            return $result;
        }
        return false;
    }
}
?>