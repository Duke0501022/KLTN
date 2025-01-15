<?php
include_once("model/connect.php");

class mHSTV {
  
    public function select_hoso_id($id_datlich) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT hosotuvan.*, datlich.*, phuhuynh.hoTenPH, phuhuynh.gioiTinh  ,datlich.date as date
                       FROM hosotuvan
                       INNER JOIN datlich ON hosotuvan.id_datlich = datlich.id_datlich
                       INNER JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
                       WHERE hosotuvan.id_datlich ='" . $id_datlich . "'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return mysqli_fetch_assoc($table);
        } else {
            return false;
        }
    }
    public function select_hosotuvan($idHoSo) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT *
                       FROM hosotuvan
                       
                       WHERE hosotuvan.idHSTV ='" . $idHoSo . "'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return mysqli_fetch_assoc($table);
        } else {
            return false;
        }
    }
    public function select_hoso() {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT hosotuvan.*, datlich.*, phuhuynh.hoTenPH, phuhuynh.gioiTinh ,phuhuynh.hinhAnh as hinhAnh , datlich.date as date
                       FROM hosotuvan
                       INNER JOIN datlich ON hosotuvan.id_datlich = datlich.id_datlich
                       INNER JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table; // Return the mysqli_result object
        } else {
            return false;
        }
    }
    
    public function search_hoso($search_query) {
        $p = new ketnoi();
        if($p->moketnoi($conn)){
            $string =  "SELECT hosotuvan.*, datlich.*, phuhuynh.hoTenPH as hoTenPH, phuhuynh.gioiTinh as gioiTinh , phuhuynh.hinhAnh as hinhAnh 
                        FROM hosotuvan
                        INNER JOIN datlich ON hosotuvan.id_datlich = datlich.id_datlich
                        INNER JOIN phuhuynh ON datlich.idPhuHuynh = phuhuynh.idPhuHuynh
                        WHERE 
                        hoTenPH LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
                        OR loiDan LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
                        OR chuanDoan LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%'
                        OR (gioiTinh = " . ($search_query == 'Nam' ? 0 : ($search_query == 'Nữ' ? 1 : -1)) . ")";
            $table = mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            return $table; // Return the mysqli_result object
        } else {
            return false;
        }
    }
    public function update_status($id_datlich, $check) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $id_datlich = mysqli_real_escape_string($conn, $id_datlich);
            $check = mysqli_real_escape_string($conn, $check);
    
            $query = "UPDATE datlich SET `check` = '$check' WHERE id_datlich = '$id_datlich'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $p->dongketnoi($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
    public function count_hoso() {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $query = "SELECT COUNT(*) as total FROM hosotuvan";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $p->dongketnoi($conn);
                return $row['total'];
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
        } else {
            return false;
        }

    }
    public function del_lichtuvan($idRecord) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $idRecord = mysqli_real_escape_string($conn, $idRecord); // Sanitize input
            $query = "DELETE FROM hosotuvan WHERE idRecord='$idRecord'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $p->dongketnoi($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }

    public function insert_hoso($datetime_create, $loiDan, $chuanDoan, $id_datlich) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $datetime_create = mysqli_real_escape_string($conn, $datetime_create);
            $loiDan = mysqli_real_escape_string($conn, $loiDan);
            $chuanDoan = mysqli_real_escape_string($conn, $chuanDoan);
            $id_datlich = mysqli_real_escape_string($conn, $id_datlich);

            $query = "INSERT INTO hosotuvan (date_create, loiDan, chuanDoan, id_datlich) VALUES ('$datetime_create', '$loiDan', '$chuanDoan', '$id_datlich')";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $p->dongketnoi($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
        } else {
            return false;
        }
    }
    public function update_hoso($idHoSo, $loiDan, $chuanDoan) {
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $idHoSo = mysqli_real_escape_string($conn, $idHoSo);
            $loiDan = mysqli_real_escape_string($conn, $loiDan);
            $chuanDoan = mysqli_real_escape_string($conn, $chuanDoan);
    
            $query = "UPDATE hosotuvan 
                     SET loiDan = '$loiDan', 
                         chuanDoan = '$chuanDoan',
                         date_update = NOW()
                     WHERE idHSTV = '$idHoSo'";
    
            $result = mysqli_query($conn, $query);
            if ($result) {
                $p->dongketnoi($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                $p->dongketnoi($conn);
                return false;
            }
        }
        return false;
    }
}

?>