<?php
require_once(__DIR__ . "/../../Model/Connect.php");

class mLSTV1 {
    public function selectAppointmentById($id_datlich, $idPhuHuynh) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Sử dụng prepared statements để bảo vệ chống SQL Injection
            $stmt = $conn->prepare("
                SELECT datlich.*, 
                       phuhuynh.hoTenPH AS hoTenPH, 
                       phuhuynh.diaChi AS diaChi, 
                       phuhuynh.ngaySinh AS ngaySinh, 
                       phuhuynh.gioiTinh AS gioiTinh, 
                       phuhuynh.hinhAnh AS hinhAnh, 
                       hosotreem.hoTenTE AS hotenTE, 
                       hosotreem.ngaySinh AS ngaySinhTE
                FROM datlich
                INNER JOIN phuhuynh ON phuhuynh.idPhuHuynh = datlich.idPhuHuynh
                INNER JOIN chuyenvien ON chuyenvien.idChuyenVien = datlich.idChuyenVien
                LEFT JOIN hosotreem ON phuhuynh.idPhuHuynh = hosotreem.idPhuHuynh
                WHERE datlich.id_datlich = ? AND datlich.idPhuHuynh = ?
            ");
    
            $stmt->bind_param("ii", $id_datlich, $idPhuHuynh);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result) {
                $row = $result->fetch_assoc();
                var_dump($row); // Kiểm tra dữ liệu trả về
                $stmt->close();
                $p->dongketnoi($conn);
                return $row;
            } else {
                error_log("Query failed: " . $conn->error);
                echo "Query failed: " . $conn->error;
            }
        
            return null;
        }
}
}
?>