<?php
include_once("Model/Connect.php");

class mLichHoc
{
    function SelectMenuByDatebyIDGV($ngayTao, $idHoSo) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            if ($idHoSo) {
                $string = "SELECT lichgiangday.*, chitietgiangday.*, giaovien.*, phonghoc.*, tiethoc.*,lophoc.*,chitietlophoc.* 
                           FROM lichgiangday
                           JOIN chitietgiangday ON chitietgiangday.idLichGD = lichgiangday.idLichGD
                           JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                           JOIN phonghoc ON chitietgiangday.idPhongHoc = phonghoc.idPhongHoc
                           JOIN tiethoc ON chitietgiangday.idTietHoc = tiethoc.idTietHoc
                           JOIN lophoc ON chitietgiangday.idLopHoc = lophoc.idLopHoc
                           JOIN chitietlophoc ON chitietlophoc.idLopHoc = lophoc.idLopHoc
                           WHERE lichgiangday.ngayTao = '$ngayTao' AND chitietlophoc.idHoSo = '$idHoSo'";
            
            } else {
                // Nếu không có idGiaoVien và username, lấy tất cả lịch dạy cho ngày đó
                $string = "SELECT lichgiangday.*, chitietgiangday.*, giaovien.*, phonghoc.*, tiethoc.*,lophoc.*,chitietlophoc.* 
                           FROM lichgiangday
                           JOIN chitietgiangday ON chitietgiangday.idLichGD = lichgiangday.idLichGD
                           JOIN giaovien ON chitietgiangday.idGiaoVien = giaovien.idGiaoVien
                           JOIN phonghoc ON chitietgiangday.idPhongHoc = phonghoc.idPhongHoc
                           JOIN tiethoc ON chitietgiangday.idTietHoc = tiethoc.idTietHoc
                           JOIN lophoc ON chitietgiangday.idLopHoc = lophoc.idLopHoc
                           JOIN chitietlophoc ON chitietlophoc.idLopHoc = lophoc.idLopHoc
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
   
    function getIdHoSoByPhuHuynh($idPhuHuynh)
    {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT idHoSo, hotenTE FROM hosotreem WHERE idPhuHuynh = '$idPhuHuynh'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
    
            $list_hoSo = array();
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_hoSo[] = $row;
                }
                return $list_hoSo;
            }
            return false;
        } else {
            return false;
        }
    }
   
}
?>
