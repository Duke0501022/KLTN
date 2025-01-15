<?php 
// include_once("Model/mTinTuc.php");
include_once(__DIR__ . '/../Model/mTinTuc.php');

class cTinTuc{
    
    public function selectALL($wait){
        $m_tintuc = new mTinTuc();
        $table = $m_tintuc->selectALL($wait);
        // include 'View/vTinTuc.php';
        return $table;
    }

    public function getTinTuc($idTinTuc){
        $m_tintuc = new mTinTuc();
        $table = $m_tintuc->getTinTuc($idTinTuc);
        return $table;
    }

    public function getAllDanhMuc(){
        $m_tintuc = new mTinTuc();
        $table = $m_tintuc->getAllDanhMuc();
        return $table;
    }
    
    public function getTinTucTheoDanhMuc($idDanhMuc){
        $m_tintuc = new mTinTuc();
        $table = $m_tintuc->getTinTucTheoDanhMuc($idDanhMuc);
        return $table;
    }
}

?>