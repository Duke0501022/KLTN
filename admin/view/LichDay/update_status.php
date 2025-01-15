<?php
include_once("controller/LichDay/cLichDay.php");

$menu = new cLichDay();

$idLichGD = $_GET['idLichGD'];
$idGiaoVien = $_GET['idGiaoVien'];
$idPhongHoc = $_GET['idPhongHoc'];
$idTietHoc = $_GET['idTietHoc'];
$check_lich = $_GET['check_lich'];

$kq = $menu->UpdateStatus($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $check_lich);

if ($kq == true) {
    echo '<script>alert("Cập nhật trạng thái thành công")</script>';
} else {
    echo '<script>alert("Cập nhật trạng thái không thành công")</script>';
}
echo "<script>window.location.href='?qlgd'</script>";
exit();
?>