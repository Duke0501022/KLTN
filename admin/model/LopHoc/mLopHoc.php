<?php
include_once("model/connect.php");

class mLop{
    //--------------THỐNG KÊ
    #THỐNG KÊ SỐ LƯỢNG LỚP
    public function count_lop(){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if($conn){
            $string = "SELECT count(*) FROM lophoc";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    

    public function select_lop_lay(){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if($conn){
            $string = "SELECT * FROM lophoc";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    public function search_KHDN($search_query) {
        // Kết nối đến database
        $p = new ketnoi();
        if($p -> moketnoi($conn)){
            $string =  "SELECT giaovien.* , lophoc.* , hosotreem.*  FROM chitietlophoc
            JOIN giaovien ON giaovien.idGiaoVien = chitietlophoc.idGiaoVien
            JOIN lophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
            JOIN hosotreem ON hosotreem.idHoSo = chitietlophoc.idHoSo
            WHERE 
            hoTen LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
            OR tenLop LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
            ";
            $table = mysqli_query($conn,$string);
            $p -> dongketnoi($conn);
            //
            return $table;
        }else{
            return false;
        }
    }
    public function search_treem($search_query, $idGiaoVien = null, $username = null) {
        // Kết nối đến database
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            // Prepare the search pattern
            $search_pattern = '%' . $search_query . '%';
            
            // Base SQL query
            $string = "SELECT giaovien.*, lophoc.*, hosotreem.*
                       FROM chitietlophoc
                       JOIN giaovien ON giaovien.idGiaoVien = chitietlophoc.idGiaoVien
                       JOIN lophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
                       JOIN hosotreem ON hosotreem.idHoSo = chitietlophoc.idHoSo
                       WHERE (hosotreem.tinhTrang LIKE ?
                           OR hosotreem.noiDungKetQua LIKE ?
                           OR hosotreem.hoTenTE LIKE ?)";
            
            // Append additional conditions based on parameters
            if ($idGiaoVien !== null) {
                $string .= " AND giaovien.idGiaoVien = ?";
            } elseif ($username !== null) {
                $string .= " AND giaovien.username = ?";
            }
            
            // Prepare the statement
            if ($stmt = $conn->prepare($string)) {
                if ($idGiaoVien !== null) {
                    // 's' for $search_pattern (string), 's' for second pattern, 's' for third pattern, 'i' for $idGiaoVien (integer)
                    $stmt->bind_param("sssi", $search_pattern, $search_pattern, $search_pattern, $idGiaoVien);
                } elseif ($username !== null) {
                    // 's' for $search_pattern (string), 's' for second pattern, 's' for third pattern, 's' for $username (string)
                    $stmt->bind_param("ssss", $search_pattern, $search_pattern, $search_pattern, $username);
                } else {
                    // Only three string parameters
                    $stmt->bind_param("sss", $search_pattern, $search_pattern, $search_pattern);
                }
    
                // Execute the statement
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Close the statement and connection
                $stmt->close();
                $p->dongketnoi($conn);
    
                return $result;
            } else {
                // Handle query preparation error
                $p->dongketnoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
    #Hiển thị thông tin lớp
    public function select_lop() {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            $string = "SELECT lophoc.*, 
                              giaovien.hoTen AS hoTen, 
                              hosotreem.*
                             
                       FROM lophoc
                       JOIN chitietlophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
                       LEFT JOIN hosotreem ON chitietlophoc.idHoSo = hosotreem.idHoSo
                       LEFT JOIN giaovien ON chitietlophoc.idGiaoVien = giaovien.idGiaoVien";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    public function select_lop_id($idLopHoc) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            // Chỉnh sửa câu lệnh SQL để nối bảng chính xác
            $string = "SELECT lophoc.*, hosotreem.hoTenTE AS hoTenTE, giaovien.hoTen AS hoTen
                       FROM lophoc
                       LEFT JOIN chitietlophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
                       LEFT JOIN hosotreem ON chitietlophoc.idHoSo = hosotreem.idHoSo
                       LEFT JOIN giaovien ON chitietlophoc.idGiaoVien = giaovien.idGiaoVien
                       WHERE lophoc.idLopHoc = $idLopHoc";
            $table = mysqli_query($conn, $string);
            if (!$table) {
                echo "Error: " . mysqli_error($conn);
            }
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    
    
    public function select_lop_idGiaoVien($idGiaoVien, $username) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            if ($idGiaoVien) {
                $string = "SELECT lophoc.*, giaovien.hoTen AS hoTen, hosotreem.*
                           FROM lophoc
                           JOIN chitietlophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
                           LEFT JOIN hosotreem ON chitietlophoc.idHoSo = hosotreem.idHoSo
                           LEFT JOIN giaovien ON chitietlophoc.idGiaoVien = giaovien.idGiaoVien
                           WHERE giaovien.idGiaoVien = ?";
            } elseif ($username) {
                $string = "SELECT lophoc.*, giaovien.hoTen AS hoTen,  hosotreem.*
                           FROM lophoc
                           JOIN chitietlophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
                           LEFT JOIN hosotreem ON chitietlophoc.idHoSo = hosotreem.idHoSo
                           LEFT JOIN giaovien ON chitietlophoc.idGiaoVien = giaovien.idGiaoVien
                           WHERE giaovien.username = ?";
            } else {
                // Nếu không có idGiaoVien và username, lấy tất cả lịch dạy cho ngày đó
                $string = "SELECT lophoc.*, giaovien.hoTen AS hoTen,  hosotreem.*
                           FROM lophoc
                           JOIN chitietlophoc ON lophoc.idLopHoc = chitietlophoc.idLopHoc
                           LEFT JOIN hosotreem ON chitietlophoc.idHoSo = hosotreem.idHoSo
                           LEFT JOIN giaovien ON chitietlophoc.idGiaoVien = giaovien.idGiaoVien";
            }

            $stmt = $conn->prepare($string);
            if ($idGiaoVien) {
                $stmt->bind_param("i", $idGiaoVien);
            } elseif ($username) {
                $stmt->bind_param("s", $username);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $p->dongketnoi($conn);

            return $result;
        } else {
            return false;
        }
    }

    public function select_giaovien(){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if($conn){
            $string = "SELECT * FROM giaovien";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    public function select_phuhuynh(){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if($conn){
            $string = "SELECT * FROM phuhuynh";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    public function select_treem(){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if($conn){
            $string = "SELECT * FROM hosotreem";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    public function add_lop($tenLop) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            $sql = "INSERT INTO lophoc (tenLop) VALUES ('$tenLop')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $idLopHoc = mysqli_insert_id($conn);
                $p->dongketnoi($conn);
                return $idLopHoc;
            } else {
                $p->dongketnoi($conn);
                return false;
            }
        }
        return false;
    }

    
	public function add_chitietlophoc($idLopHoc, $idHoSos,$idGiaoViens) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            mysqli_begin_transaction($conn);
            try {
                // Thêm học sinh vào chitietlophoc
                $stmt = $conn->prepare("INSERT INTO chitietlophoc (idLopHoc, idHoSo) VALUES (?, ?)");
                foreach ($idHoSos as $idHoSo) {
                    $stmt->bind_param('ii', $idLopHoc, $idHoSo);
                    if (!$stmt->execute()) {
                        throw new Exception("Error inserting HoSo: " . $stmt->error);
                    }
                }
                // Thêm phụ huynh vào chitietlophoc
                
                $stmt = $conn->prepare("INSERT INTO chitietlophoc (idLopHoc, idHoSo) VALUES (?, ?)");
                foreach ($idGiaoViens as $idGiaoVien) {
                    $stmt->bind_param('ii', $idLopHoc, $idGiaoVien);
                    if (!$stmt->execute()) {
                        throw new Exception("Error inserting HoSo: " . $stmt->error);
                    }
                }
                mysqli_commit($conn);
                $stmt->close();
                $p->dongketnoi($conn);
                return true;
            } catch (Exception $e) {
                mysqli_rollback($conn);
                $p->dongketnoi($conn);
                error_log($e->getMessage()); // Log the error message
                return false;
            }
        }
        return false;
    }

    #Cập nhật lớp học
    public function update_lop($idLopHoc, $idHoSo, $idGiaoVien, $tenLop) {
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
    
        if ($conn) {
            // First, update the class name in the `lophoc` table
            $sql_update_lophoc = "UPDATE lophoc SET tenLop = ? WHERE idLopHoc = ?";
            $stmt_update_lophoc = mysqli_prepare($conn, $sql_update_lophoc);
            mysqli_stmt_bind_param($stmt_update_lophoc, 'si', $tenLop, $idLopHoc);
            mysqli_stmt_execute($stmt_update_lophoc);
    
            // Then, update the teacher and students in `chitietlophoc`
            // Remove existing students and re-add them with updated info
            $sql_delete = "DELETE FROM chitietlophoc WHERE idLopHoc = ?";
            $stmt_delete = mysqli_prepare($conn, $sql_delete);
            mysqli_stmt_bind_param($stmt_delete, 'i', $idLopHoc);
            mysqli_stmt_execute($stmt_delete);
    
            // Re-insert the updated list of students
            $sql_insert_chitiet = "INSERT INTO chitietlophoc (idLopHoc, idHoSo, idGiaoVien) VALUES (?, ?, ?)";
            $stmt_insert_chitiet = mysqli_prepare($conn, $sql_insert_chitiet);
    
            foreach ($idHoSo as $studentId) {
                mysqli_stmt_bind_param($stmt_insert_chitiet, 'iii', $idLopHoc, $studentId, $idGiaoVien);
                if (!mysqli_stmt_execute($stmt_insert_chitiet)) {
                    echo "<script>alert('Lỗi cập nhật chi tiết lớp học: " . mysqli_error($conn) . "');</script>";
                    return false;
                }
            }
    
            $p->dongketnoi($conn);
            return true;
        } else {
            return false;
        }
    }

    #Xoá lớp
    public function del_lop($idLopHoc){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            $string = "DELETE FROM chitietlophoc WHERE idLopHoc='$idLopHoc'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
   
    public function update_tinh_trang($idHoSo, $tinhTrang){
        $p = new ketnoi();
        $conn = $p->moketnoi($conn);
        if ($conn) {
            $string = "UPDATE hosotreem SET tinhTrang = $tinhTrang WHERE idHoSo = $idHoSo'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
}
?>
