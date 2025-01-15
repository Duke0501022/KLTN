<?php
include_once("model/connect.php");
class thongBaoModel {
    public function select_thongbao($username) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $query = "SELECT * FROM thongbao WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            // Nên fetch data trước khi đóng kết nối
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $p->dongketnoi($conn);
            return $data;
        } else {
            return false;
        }
    }

   public function createNotification($username, $noiDung, $thoiGian) {
    $p = new ketnoi();
    if ($p->moketnoi($conn)) {
        $username = mysqli_real_escape_string($conn, $username);
        $noiDung = mysqli_real_escape_string($conn, $noiDung);
        $thoiGian = mysqli_real_escape_string($conn, $thoiGian);
        
        $query = "INSERT INTO thongbao (noiDung, thoiGian, username) 
                 VALUES ('$noiDung', '$thoiGian', '$username')";
        $result = mysqli_query($conn, $query);
        
        // Add error checking
        if (!$result) {
            // Log the error
            error_log("Notification creation failed: " . mysqli_error($conn));
            return false;
        }
        
        $p->dongketnoi($conn);
        return $result;
    } else {
        return false;
    }
}

    public function getAllCustomers() {
        // Sửa lại tên class từ moketnoi thành ketnoi
        $p = new ketnoi();
        // Sửa lại tên method từ ketnoiDB thành moketnoi
        if ($p->moketnoi($conn)) {
            $query = "SELECT username FROM taikhoan1 WHERE Role = 2";
            $result = mysqli_query($conn, $query);
            // Fetch data trước khi đóng kết nối
            $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $p->dongketnoi($conn);
            return $customers;
        } else {
            return false;
        }
    }
}
?>