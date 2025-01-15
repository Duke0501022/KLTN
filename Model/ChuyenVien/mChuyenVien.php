<?php
include_once("Model/Connect.php");
class ChuyenVienModel {
    public function select_nhanvien() {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM chuyenvien";
            $result = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            $specialists = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $specialists[] = $row;
            }
            return $specialists;
        } else {
            return false;
        }
    }

    public function select_NVPP_id($idChuyenVien) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM chuyenvien WHERE idChuyenVien ='" . $idChuyenVien . "'";
            $result = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }
}
?>