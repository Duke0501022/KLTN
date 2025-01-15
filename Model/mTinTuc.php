<?php
// include_once("Model/Connect.php");
include_once(__DIR__ . '/Connect.php');


class mTinTuc{
    public function selectALL($wait) {
        $p = new clsketnoi();
        if($p->ketnoiDB($conn)){
            $string = "SELECT t.*, d.tenDanhMuc FROM tintuc t LEFT JOIN danhmuctintuc d ON t.idDanhMuc = d.idDanhMuc where status = $wait ORDER BY t.idTinTuc DESC";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        }
        else{
            return false;
        }
    }
    
    public function getTinTuc($idTinTuc){
        $p = new clsketnoi();
        if($p->ketnoiDB($conn)){
            $string = "SELECT t.*, d.tenDanhMuc  FROM tintuc t LEFT JOIN danhmuctintuc d ON t.idDanhMuc = d.idDanhMuc WHERE t.idTinTuc = '$idTinTuc'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        }
        else{
            return false;
        }
    }
    
    public function getAllDanhMuc(){
        $p = new clsketnoi();
        if($p->ketnoiDB($conn)){
            $string = "SELECT * FROM danhmuctintuc";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        }
        else{
            return false;
        }
    }

    public function getTinTucTheoDanhMuc($idDanhMuc){
        $p = new clsketnoi();
        if($p->ketnoiDB($conn)){
            $string = "SELECT t.*, d.tenDanhMuc FROM tintuc t LEFT JOIN danhmuctintuc d ON t.idDanhMuc = d.idDanhMuc WHERE t.idDanhMuc = '$idDanhMuc' ORDER BY t.idTinTuc DESC";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        }
        else{
            return false;
        }
    }
}

?>