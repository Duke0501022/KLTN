<?php
include_once("model/LopHoc/mLopHoc.php");

class cLopHoc {
    public function count_lop(){
        $p = new mLop();
        return $p->count_lop();
    }

    public function get_lop(){
        $p = new mLop();
        return $p->select_lop();
    }
    public function search_KHDN($search_query){
        $p = new mLop();
        return $p->search_KHDN($search_query);
    }
    public function search_treem($search_query,$idGiaoVien,$username){
        $p = new mLop();
        return $p->search_treem($search_query, $idGiaoVien , $username );
    }

    public function get_lop_lay(){
        $p = new mLop();
        return $p->select_lop_lay();
    }
    public function get_lop_by_giaovien($idGiaoVien,$username){
        $p = new mLop();
        return $p->select_lop_idGiaoVien($idGiaoVien,$username);
    }
    
    public function get_lop_id($idLopHoc){
        $p = new mLop();
        return $p->select_lop_id($idLopHoc);
    }

    public function get_gv(){
        $p = new mLop();
        return $p->select_giaovien();
    }
    public function update_tinh_trang($idHoSo, $tinhTrang){
        $p = new mLop();
        return $p->update_tinh_trang($idHoSo, $tinhTrang);
    }

    public function get_phuhuynh(){
        $p = new mLop();
        return $p->select_phuhuynh();
    }

    public function get_treem(){
        $p = new mLop();
        return $p->select_treem();
    }

    public function add_lop($tenLop){
        $p = new mLop();
        $insert = $p->add_lop($tenLop);
        return $insert ? 1 : 0;
    }

    public function add_chitietlophoc($idLopHoc, $idHoSos, $idPhuHuynhs,$idGiaoViens) {
        $p = new mLop();
        $insert = $p->add_chitietlophoc($idLopHoc, $idHoSos, $idPhuHuynhs,$idGiaoViens);
        return $insert ? 1 : 0;
    }

    public function update_lop($idLopHoc, $idHoSo, $idGiaoVien, $tenLop){
        $p = new mLop();
        $update = $p->update_lop($idLopHoc, $idHoSo, $idGiaoVien, $tenLop);
        return $update ? 1 : 0;
    }

    public function del_lop($idLopHoc){
        $p = new mLop();
        $delete = $p->del_lop($idLopHoc);
        return $delete ? 1 : 0;
    }
}
?>
