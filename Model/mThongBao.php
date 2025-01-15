<?php
include_once("../Model/Connect.php");

class thongBaoModel {
    public function select_thongbao($username) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "SELECT * FROM thongbao WHERE username = '$username' AND is_read = FALSE";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die('Query Error: ' . mysqli_error($conn));
            }
            $p->dongketnoi($conn);
            return $result;
        } else {
            die('Database Connection Error');
        }
    }

    public function createNotification($username, $noiDung, $thoiGian) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "INSERT INTO thongbao (noiDung, thoiGian, username) VALUES ('$noiDung', '$thoiGian', '$username')";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die('Query Error: ' . mysqli_error($conn));
            }
            $p->dongketnoi($conn);
            return $result;
        } else {
            die('Database Connection Error');
        }
    }
    public function mark_as_read($username) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "UPDATE thongbao SET is_read = TRUE WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die('Query Error: ' . mysqli_error($conn));
            }
            $p->dongketnoi($conn);
            return $result;
        } else {
            die('Database Connection Error');
        }
    }
 
public function select_all_thongbao($username) {
    $p = new clsketnoi();
    if ($p->ketnoiDB($conn)) {
        $query = "SELECT * FROM thongbao WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die('Query Error: ' . mysqli_error($conn));
        }
        $p->dongketnoi($conn);
        return $result;
    } else {
        die('Database Connection Error');
    }
}
    public function getAllCustomers() {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query = "SELECT username FROM taikhoan1 WHERE Role = 2";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die('Query Error: ' . mysqli_error($conn));
            }
            $p->dongketnoi($conn);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            die('Database Connection Error');
        }
    }
}
?>