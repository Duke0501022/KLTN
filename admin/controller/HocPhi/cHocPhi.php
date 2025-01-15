<?php 
include_once("model/HocPhi/mHocPhi.php");
class cHocPhi{
    public function count_hocphi(){
        $info = new mHocPhi();
        $res = $info->count_hocphi();
        return $res;
    }
    public function getallHocPhi(){
        $info = new mHocPhi();
        $res = $info->select_hocphi();
        return $res;
    }
    public function search_hocphi($search_query){
        $info = new mHocPhi();
        $res = $info->search_hocphi($search_query);
        return $res;
    }
    public function getalllophoc(){
        $info = new mHocPhi();
        $res = $info->select_lophoc();
        return $res;
    }
    public function getallhosotre(){
        $info = new mHocPhi();
        $res = $info->select_hosotre();
        return $res;
    }
    public function getHocPhiById($idHocPhi){
        $info = new mHocPhi();
        $res = $info->select_hocphi_id($idHocPhi);
        return $res;
    }

    public function add_hocphi($idHoSo,$soTien,$hocKy,$namHoc,$moTa,$check_tt){
        $info = new mHocPhi();
        $res = $info->add_hocphi($idHoSo,$soTien,$hocKy,$namHoc,$moTa,$check_tt);
        return $res;
    }
    public function update_hocphi($idHocPhi,$idHoSo,$soTien,$hocKy,$namHoc,$moTa){
        $info = new mHocPhi();
        $res = $info->update_hocphi($idHocPhi,$idHoSo,$soTien,$hocKy,$namHoc,$moTa);
        return $res;
    }
    public function del_hocphi($idHocPhi){
        $info = new mHocPhi();
        $res = $info->del_hocphi($idHocPhi);
        return $res;
    }
}