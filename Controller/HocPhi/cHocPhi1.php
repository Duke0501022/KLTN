<?php 
include_once("../Model/HocPhi/mHocPhi1.php");
class cHP1{
    public function kiemTraHocPhi($idHocPhi){
        $info = new mHP1();
        $res = $info->kiemTraHocPhi($idHocPhi);
        return $res;
    }
    public function getallHocPhi(){
        $info = new mHP1();
        $res = $info->selectallHocPhi();
        return $res;
    }
    public function getHocPhiById($idHocPhi){
        $info = new mHP1();
        $res = $info->selectHocPhi($idHocPhi);
        return $res;
    }

   
    public function xuLyKetQuaThanhToan($idHocPhi, $soTien, $trangThai){
        $info = new mHP1();
        $res = $info->xuLyKetQuaThanhToan($idHocPhi, $soTien, $trangThai);
        return $res;
    }
}