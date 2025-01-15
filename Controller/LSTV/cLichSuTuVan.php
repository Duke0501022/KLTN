<?php 
include_once("Model/LSTV/mLichSuTuVan.php");

class cLSTV {
    public function get_lichsu($check = null) {
        $info = new mLSTV();
        $res = $info->select_lichsu($check);
        return $res;
    }
    public function getAppointmentById($id_datlich) {
        $info = new mLSTV();
        $res = $info->selectAppointmentById($id_datlich);
        return $res;
    }
    public function count_lichsu($check = null) {
        $info = new mLSTV();
        $res = $info->count_lichsu( $check);
        return $res;
    }
    public function get_deldatlich($idDatLich) {
        $info = new mLSTV();
        $res = $info->del_lichtuvan($idDatLich);
        return $res;
    }
    public function cancelUnpaidAppointments() {
        $info = new mLSTV();
        $res = $info->cancelUnpaidAppointments();
        return $res;
    }
    public function getLichTVbyIDPH($idPhuHuynh, $username, $check = null,$pay = null) {
        $info = new mLSTV();
        $res = $info->SelectLichTVbyIDPH($idPhuHuynh, $username, $check,$pay);
        return $res;
    }
    public function getHSTVbyIDPH($idPhuHuynh, $username) {
        $info = new mLSTV();
        $res = $info->SelectHSTVbyIDPH($idPhuHuynh, $username);
        return $res;
    }
    public function search_hoso($idPhuHuynh, $username,$search_query) {
        $info = new mLSTV();
        $res = $info->search_hoso($idPhuHuynh, $username,$search_query);
        return $res;
    }
}
?>