<?php
include_once("model/connect.php");

class mLichDay
{
    function SelectLatestMenu()
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT * FROM lichgiangday 
                       JOIN chitietgiangday ON lichgiangday.idLichGD = chitietgiangday.idLichGD
                       JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                       ORDER BY lichgiangday.NgayTao DESC LIMIT 1";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            $list_users = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_users[] = $row;
                }
                return $list_users;
            }
            return false;
        } else {
            return false;
        }
    }
    public function count_schedules_by_date($start_date, $end_date) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT lichgiangday.ngayTao, giaovien.hoTen, COUNT(chitietgiangday.idLichGD) as total 
                       FROM lichgiangday 
                       JOIN chitietgiangday ON lichgiangday.idLichGD = chitietgiangday.idLichGD 
                       JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                       WHERE lichgiangday.ngayTao BETWEEN '$start_date' AND '$end_date'
                       GROUP BY lichgiangday.ngayTao, giaovien.hoTen";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
    
            $result = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $result[] = $row;
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function SelectAllMenuDetailMenu()
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT * FROM lichgiangday 
                       JOIN chitietgiangday ON lichgiangday.idLichGD = chitietgiangday.idLichGD";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            $list_users = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_users[] = $row;
                }
                return $list_users;
            }
            return false;
        } else {
            return false;
        }
    }

    function SelectAllMenu()
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT * FROM lichgiangday";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            $list_users = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_users[] = $row;
                }
                return $list_users;
            }
            return false;
        } else {
            return false;
        }
    }

    function SelectMenuByDate($ngayTao)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT * FROM lichgiangday 
                       JOIN chitietgiangday ON chitietgiangday.idLichGD = lichgiangday.idLichGD
                       JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien 
                       JOIN phonghoc on chitietgiangday.idPhongHoc = phonghoc.idPhongHoc
                       JOIN tiethoc on chitietgiangday.idTietHoc = tiethoc.idTietHoc
                       JOIN lophoc on chitietgiangday.idLopHoc = lophoc.idLopHoc
                       WHERE lichgiangday.ngayTao = '$ngayTao'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            $list_users = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_users[] = $row;
                }
                return $list_users;
            }
            return false;
        } else {
            return false;
        }
    }

    function SelectMenuByDatebyIDGV($ngayTao, $idGiaoVien, $username) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            if ($idGiaoVien) {
                $string = "SELECT lichgiangday.*, chitietgiangday.*, giaovien.*, phonghoc.*, tiethoc.*,lophoc.*
                           FROM lichgiangday
                           JOIN chitietgiangday ON chitietgiangday.idLichGD = lichgiangday.idLichGD
                           JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                           JOIN phonghoc ON chitietgiangday.idPhongHoc = phonghoc.idPhongHoc
                           JOIN tiethoc ON chitietgiangday.idTietHoc = tiethoc.idTietHoc
                           JOIN lophoc ON chitietgiangday.idLopHoc = lophoc.idLopHoc
                           WHERE lichgiangday.ngayTao = '$ngayTao' AND giaovien.idGiaoVien = '$idGiaoVien'";
            } elseif ($username) {
                $string = "SELECT lichgiangday.*, chitietgiangday.*, giaovien.*, phonghoc.*, tiethoc.*,lophoc.*
                           FROM lichgiangday
                           JOIN chitietgiangday ON chitietgiangday.idLichGD = lichgiangday.idLichGD
                           JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                           JOIN phonghoc ON chitietgiangday.idPhongHoc = phonghoc.idPhongHoc
                           JOIN tiethoc ON chitietgiangday.idTietHoc = tiethoc.idTietHoc
                           JOIN lophoc ON chitietgiangday.idLopHoc = lophoc.idLopHoc
                           WHERE lichgiangday.ngayTao = '$ngayTao' AND giaovien.username = '$username'";
            } else {
                // Nếu không có idGiaoVien và username, lấy tất cả lịch dạy cho ngày đó
                $string = "SELECT lichgiangday.*, chitietgiangday.*, giaovien.*, phonghoc.*, tiethoc.*,lophoc.*
                           FROM lichgiangday
                           JOIN chitietgiangday ON chitietgiangday.idLichGD = lichgiangday.idLichGD
                           JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                           JOIN phonghoc ON chitietgiangday.idPhongHoc = phonghoc.idPhongHoc
                           JOIN tiethoc ON chitietgiangday.idTietHoc = tiethoc.idTietHoc
                           JOIN lophoc ON chitietgiangday.idLopHoc = lophoc.idLopHoc
                           WHERE lichgiangday.ngayTao = '$ngayTao'";
            }
            
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            
            $list_users = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_users[] = $row;
                }
                return $list_users;
            }
            return false;
        } else {
            return false;
        }
    }
    public function getClassesByTeacherId($teacherId) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT  *
                       FROM chitietlophoc ctl 
                       JOIN lophoc cl ON ctl.idLopHoc = cl.idLopHoc 
                       WHERE ctl.idGiaoVien = '$teacherId'";
                       
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
    
            $list_classes = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_classes[] = $row;
                }
                return $list_classes;
            }
            return false;
        } else {
            return false;
        }
    }

    function SelectOneMenuByDate($ngayTao)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT * FROM lichgiangday WHERE ngayTao = '$ngayTao'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            if (mysqli_num_rows($table) > 0) {
                $list_users = mysqli_fetch_assoc($table);
                return $list_users;
            }
            return false;
        } else {
            return false;
        }
    }

    
    public function InsertMenuDetails($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $idLopHoc)
    {
        $p = new ketnoi();
        $connect = $p->moketnoi($conn);
    
        if ($connect) {
            $stmt = $connect->prepare("INSERT INTO chitietgiangday (idLichGD, idGiaoVien, idPhongHoc, idTietHoc, idLopHoc) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($connect->error));
            }
    
            $stmt->bind_param("iiiii", $idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $idLopHoc);
            $insertResult = $stmt->execute();
            if ($insertResult === false) {
                die('Execute failed: ' . htmlspecialchars($stmt->error));
            }
    
            $stmt->close();
            $p->dongketnoi($connect);
            return $insertResult;
        } else {
            die('Connection failed: ' . htmlspecialchars($conn->error));
        }
    }
    
    function InsertMenuForThreeMonths($startDate, $weekday, $idGiaoVien, $idPhongHoc, $idTietHoc, $idLopHoc) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            // Calculate the end date, 3 months from the start date
            $endDate = date('Y-m-d', strtotime('+3 months', strtotime($startDate)));
    
            // Initialize the starting date for the loop
            $currentDate = $startDate;
            
            // Find the first occurrence of the desired weekday after or on the start date
            while (date('N', strtotime($currentDate)) != $weekday) {
                $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
            }
    
            // Insert the schedule for each occurrence of the weekday until the end date
            while (strtotime($currentDate) <= strtotime($endDate)) {
                // First, insert a new record into `lichgiangday`
                $insertMenuString = "INSERT INTO lichgiangday (ngayTao) VALUES ('$currentDate')";
                $insertMenuResult = mysqli_query($conn, $insertMenuString);
                if (!$insertMenuResult) {
                    die('Error inserting into lichgiangday: ' . mysqli_error($conn));
                }
    
                // Get the last inserted id for lichgiangday to use as idLichGD in chitietgiangday
                $idLichGD = mysqli_insert_id($conn);
    
                // Then, insert the related details into `chitietgiangday`
                $insertDetailString = "INSERT INTO chitietgiangday (idLichGD, idGiaoVien, idPhongHoc, idTietHoc, idLopHoc) VALUES 
                                       ($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $idLopHoc)";
                $insertDetailResult = mysqli_query($conn, $insertDetailString);
                if (!$insertDetailResult) {
                    die('Error inserting into chitietgiangday: ' . mysqli_error($conn));
                }
    
                // Move to the next occurrence of the specified weekday (add 7 days)
                $currentDate = date('Y-m-d', strtotime('+7 days', strtotime($currentDate)));
            }
    
            $p->dongketnoi($conn);
            return true;
        } else {
            return false;
        }
    }
    
    function InsertMenu($ngayTao)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "INSERT INTO lichgiangday (ngayTao) VALUES ('$ngayTao')";
            $kq = mysqli_query($conn, $string);
            if (!$kq) {
                die('Error: ' . mysqli_error($conn));
            }
            $p->dongketnoi($conn);
            return $kq;
        } else {
            return false;
        }
    }
    public function hasTeacherConflict($teacherId, $date, $timeSlotId)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $query = "SELECT * FROM lichgiangday 
                      JOIN chitietgiangday ON lichgiangday.idLichGD = chitietgiangday.idLichGD
                      WHERE lichgiangday.ngayTao = '$date' 
                      AND chitietgiangday.idGiaoVien = '$teacherId'
                      AND chitietgiangday.idTietHoc = '$timeSlotId'";
            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return mysqli_num_rows($result) > 0;
        }
        return true; // Giả định có xung đột nếu kết nối thất bại
    }

    // Kiểm tra xung đột lịch cho phòng học
    public function hasRoomConflict($roomId, $date, $timeSlotId)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $query = "SELECT * FROM lichgiangday 
                      JOIN chitietgiangday ON lichgiangday.idLichGD = chitietgiangday.idLichGD
                      WHERE lichgiangday.ngayTao = '$date' 
                      AND chitietgiangday.idPhongHoc = '$roomId'
                      AND chitietgiangday.idTietHoc = '$timeSlotId'";
            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return mysqli_num_rows($result) > 0;
        }
        return true; // Giả định có xung đột nếu kết nối thất bại
    }
    public function hasClassConflict($classId, $date, $timeSlotId)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $query = "SELECT * FROM lichgiangday 
                      JOIN chitietgiangday ON lichgiangday.idLichGD = chitietgiangday.idLichGD
                      WHERE lichgiangday.ngayTao = '$date' 
                      AND chitietgiangday.idLopHoc = '$classId'
                      AND chitietgiangday.idTietHoc = '$timeSlotId'";
            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return mysqli_num_rows($result) > 0;
        }
        return true; // Giả định có xung đột nếu kết nối thất bại
    }

    function DeletedLichbyid($idLichGD, $idGiaoVien,$idPhongHoc,$idTietHoc)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "DELETE FROM chitietgiangday WHERE idLichGD = $idLichGD AND idGiaoVien = $idGiaoVien AND idPhongHoc = $idPhongHoc AND idTietHoc = $idTietHoc ";
            $kq = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $kq;
        } else {
            return false;
        }
    }
    function UpdateStatus($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $check_lich)
{
    $p = new ketnoi();
    if ($p->moketnoi($conn)) {
        $string = "UPDATE chitietgiangday SET check_lich = $check_lich WHERE idLichGD = $idLichGD AND idGiaoVien = $idGiaoVien AND idPhongHoc = $idPhongHoc AND idTietHoc = $idTietHoc";
        $kq = mysqli_query($conn, $string);
        $p->dongketnoi($conn);
        return $kq;
    } else {
        return false;
    }
}
}
?>
