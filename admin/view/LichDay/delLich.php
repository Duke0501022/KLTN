<?php

include_once("Controller/LichDay/cLichDay.php");

$menu = new cLichDay();

$idGiaoVien = $_GET['idGiaoVien'];
$idLichGD = $_GET['idLichGD'];
$idPhongHoc = $_GET['idPhongHoc'];
$idTietHoc = $_GET['idTietHoc'];

$kq = $menu->DeletedLichbyid($idLichGD, $idGiaoVien,$idPhongHoc,$idTietHoc);
if ($kq == 1) {
    echo '<script>alert("xóa lịch dạy thành công")</script>';
    echo "<script>window.location.href='?qlgd'</script>";
    exit();
} else {
    echo '<script>alert("xóa lịch dạy  thành công")</script>';
    echo "<script>window.location.href='?qlgd'</script>";
    exit();
}