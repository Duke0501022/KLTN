<?php
include_once("model/connect.php");

class mLSTV {
        public function count_lichsu($check = null) {
            $p = new ketnoi();
            if ($p->moketnoi($conn)) {
                $string = "SELECT COUNT(*) as total FROM datlich";
                if ($check !== null) {
                    $string .= " WHERE datlich.check = $check";
                }
                $result = mysqli_query($conn, $string);
                $row = mysqli_fetch_assoc($result);
                $p->dongketnoi($conn);
                return (int)$row['total'];
            } else {
                return 0;
            }
        }
        public function count_hoso() {
            $p = new ketnoi();
            if ($p->moketnoi($conn)) {
                $string = "SELECT COUNT(*) as total FROM hosotuvan";
                $result = mysqli_query($conn, $string);
                $row = mysqli_fetch_assoc($result);
                $p->dongketnoi($conn);
                return (int)$row['total'];
            } else {
                return 0;
            }
        }
        public function count_datlich($start_date = null, $end_date = null) {
            $p = new ketnoi();
            if ($p->moketnoi($conn)) {
                $string = "SELECT DATE(date) as date, COUNT(*) as count FROM datlich";
                if ($start_date && $end_date) {
                    $string .= " WHERE DATE(date) BETWEEN '" . mysqli_real_escape_string($conn, $start_date) . "' 
                                AND '" . mysqli_real_escape_string($conn, $end_date) . "'";
                }
                $string .= " GROUP BY DATE(date)";
                $result = mysqli_query($conn, $string);
                $data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                $p->dongketnoi($conn);
                return $data;
            }
            return [];
        }
        
        public function count_dtdatlich($start_date = null, $end_date = null) {
            $p = new ketnoi();
            if ($p->moketnoi($conn)) {
                $string = "SELECT DATE(create_at) as create_at, SUM(total) as total 
                           FROM tb_orders WHERE payment_status = 'Paid'";
                if ($start_date && $end_date) {
                    $string .= " AND DATE(create_at) BETWEEN '" . mysqli_real_escape_string($conn, $start_date) . "' 
                                AND '" . mysqli_real_escape_string($conn, $end_date) . "'";
                }
                $string .= " GROUP BY DATE(create_at)";
                $result = mysqli_query($conn, $string);
                $data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                $p->dongketnoi($conn);
                return $data;
            }
            return [];
        }

    public function select_lichsu($check = null) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $query = "SELECT *, 
            chuyenvien.hoTen as fullNameChuyenVien, 
            phuhuynh.hoTenPH as fullNamePhuHuynh,
            phuhuynh.email as emailPhuHuynh, 
            phuhuynh.gioiTinh as genderPhuHuynh, 
            phuhuynh.soDienThoai as phuHuynhPhone,
            datlich.date as appointmentDate,
            phuhuynh.hinhAnh as phuHuynhImage
            FROM phuhuynh
            INNER JOIN datlich ON phuhuynh.idPhuHuynh = datlich.idPhuHuynh 
            INNER JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien";
            
            if ($check !== null) {
                $query .= " WHERE datlich.check = $check";
            }

            $query .= " ORDER BY datlich.date ASC";

            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            return $result;
        } else {
            return false;
        }
    }
    public function del_lichtuvan($idDatLich) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $idDatLich = mysqli_real_escape_string($conn, $idDatLich); // Sanitize input
            $query = "DELETE FROM datlich WHERE id_datlich='$idDatLich'";
            
            $result = mysqli_query($conn, $query);
            if ($result) {
                $p->dongketnoi($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return "Error: " . $error;
            }
        } else {
            return false;
        }
    }
    function SelectLichByDate($ngayTao,$wait)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
           $string = "SELECT datlich.*, chuyenvien.*, phuhuynh.hoTenPh as hoTenPH ,phuhuynh.soDienThoai as sdtPH 
                        FROM datlich
                        JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
                        JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
                        WHERE datlich.date = '$ngayTao' and  status = $wait
                         ORDER BY datlich.hour ASC";
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
    function select_LSTV_byIDCV($ngayTao, $idChuyenVien, $username,$wait) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            if ($idChuyenVien) {
                $string= "SELECT datlich.*, chuyenvien.*, phuhuynh.hoTenPh as hoTenPH , phuhuynh.soDienThoai as sdtPH 
                FROM datlich 
                LEFT JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien 
                LEFT JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh 
                WHERE datlich.date = '$ngayTao' AND chuyenvien.idChuyenVien = '$idChuyenVien'  AND (datlich.status = 1 OR datlich.status = 3)
                ORDER BY datlich.hour ASC";
            } elseif ($username) {
                $string = "SELECT datlich.*, chuyenvien.*, phuhuynh.hoTenPh as hoTenPH ,phuhuynh.soDienThoai as sdtPH 
                        FROM datlich
                        LEFT JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
                        LEFT JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
                        WHERE datlich.date = '$ngayTao' AND chuyenvien.username = '$username' and  AND (datlich.status = 1 OR datlich.status = 3)
                         ORDER BY datlich.hour ASC";
            } else {
                // Nếu không có idChuyenVien và username, lấy tất cả lịch tư vấn cho ngày đó
                $string = "SELECT datlich.*, chuyenvien.*, phuhuynh.hoTenPh as hoTenPH ,phuhuynh.soDienThoai as sdtPH 
                        FROM datlich
                        JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
                        JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
                        WHERE datlich.date = '$ngayTao' and  AND (datlich.status = 1 OR datlich.status = 3)
                        ORDER BY datlich.hour ASC";
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
   
    public function select_lichwait($wait){
         
        $p=new ketnoi();
        if($p->moketnoi($conn)){
            $string="SELECT  datlich.*, chuyenvien.* , phuhuynh.*
            FROM datlich
            JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
            JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
            Where status = $wait  ORDER BY id_datlich ASC";
            $table=mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            return $table;
        }else {
            return false;
        }
    }
    public function getScheduleDetails($idCauHoi) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $idCauHoi = mysqli_real_escape_string($conn, $idCauHoi); // Sanitize input
            $query = "SELECT phuhuynh.email, datlich.date, phuhuynh.hoTenPH 
                      FROM datlich
                      JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh 
                      WHERE datlich.id_datlich = '$idCauHoi'";
            $result = mysqli_query($conn, $query);
            $p->dongketnoi($conn);
            if ($result && mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function count_datlich_tt(){
         
        $p=new ketnoi();
        if($p->moketnoi($conn)){
            $string="SELECT COUNT(*)  FROM datlich";
            $table=mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            return $table;
        }else {
            return false;
        }
    }
    function AcceptLich($idDatLich)
    {
        $p = new ketnoi();
       if ($p->moketnoi($conn)){
        $update = '';
        foreach ($idDatLich as $id) {
            $update .= "DELETE FROM datlich WHERE id_datlich = $id; ";
        }

        $kq = mysqli_multi_query($conn, $update);
        $p->dongketnoi($conn);
        return $kq;
    }
}
    function SelectAllLichWait($wait)
    {
        $p = new  ketnoi();
        $connect = $p->moketnoi($conn);
        $tbl ="SELECT * FROM datlich
        JOIN chuyenvien ON datlich.idChuyenVien = chuyenvien.idChuyenVien
        JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
        Where status = $wait  ORDER BY id_datlich ASC";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }
    function DeleteTemporaryLich($idDatLich)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)){
            $idDatLich = mysqli_real_escape_string($conn, $idDatLich); // Sanitize input
            $update = "UPDATE datlich SET `status` = 3 WHERE id_datlich = '$idDatLich'";
            $kq = mysqli_query($conn, $update); // Use mysqli_query instead of mysqli_multi_query
            $p->dongketnoi($conn);
            return $kq;
        }
        return false;
    }
    
    function DeleteTemporaryLich1($idDatLich)
    {
        $p = new ketnoi();
        if ($p->moketnoi($conn)){
            $idDatLich = mysqli_real_escape_string($conn, $idDatLich); // Sanitize input
            $update = "UPDATE datlich SET `status` = 1 WHERE id_datlich = '$idDatLich'";
            $kq = mysqli_query($conn, $update); // Use mysqli_query instead of mysqli_multi_query
            if ($kq) {
                // Kiểm tra xem có bản ghi nào được cập nhật không
                if (mysqli_affected_rows($conn) > 0) {
                    $p->dongketnoi($conn);
                    return true;
                } else {
                    $p->dongketnoi($conn);
                    return false; // Không có bản ghi nào được cập nhật
                }
            } else {
                // In ra lỗi nếu câu lệnh SQL không thực thi thành công
                echo "Error: " . mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
        }
        return false;
    }
}

?>