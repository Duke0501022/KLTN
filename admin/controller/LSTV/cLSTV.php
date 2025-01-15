<?php 
include_once("model/LSTV/mLSTV.php");

class cLSTV {
    public function get_lichsu($check = null) {
        $info = new mLSTV();
        $res = $info->select_lichsu($check);
        return $res;
    }
    public function count_lichsu($check = null) {
        $info = new mLSTV();
        $res = $info->count_lichsu( $check);
        return $res;
    }
    public function getScheduleDetails($idCauHoi) {
        $info = new mLSTV();
        $res = $info->getScheduleDetails($idCauHoi);
        return $res;
    }
    public function get_deldatlich($idDatLich) {
        $info = new mLSTV();
        $res = $info->del_lichtuvan($idDatLich);
        return $res;
    }
    public function getLichByDate($ngayTao,$wait) {
        $info = new mLSTV();
        $res = $info->SelectLichByDate($ngayTao,$wait);
        return $res;
    }
    public function get_LSTV_byIDCV($ngayTao, $idChuyenVien, $username,$wait) {
        $info = new mLSTV();
        $res = $info->select_LSTV_byIDCV($ngayTao, $idChuyenVien, $username,$wait);
        return $res;
    }
    public function get_lichwait($wait) {
        $info = new mLSTV();
        $res = $info->select_lichwait($wait);
        return $res;
    }
    public function AcceptLich($idDatLich) {
        $info = new mLSTV();
        $res = $info->AcceptLich($idDatLich);
        return $res;
    }
    public function getAllLichWait($wait) {
        $info = new mLSTV();
        $res = $info->SelectAllLichWait($wait);
        return $res;
    }
    public function DeleteTemporaryLich1($idDatLich) {
        $info = new mLSTV();
        $res = $info->DeleteTemporaryLich1($idDatLich);
        return $res;
    }
    public function DeleteTemporaryLich($idDatLich) {
        $info = new mLSTV();
        $res = $info->DeleteTemporaryLich($idDatLich);
        return $res;
    }
   
}
?>