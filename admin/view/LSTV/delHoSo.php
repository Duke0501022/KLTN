<?php

include_once("Controller/HoSoTuVan/cHSTV.php");

$menu = new cHSTV();


$idRecord = $_GET['idRecord'];

$kq = $menu->del_lichtuvan($idRecord);
if ($kq == 1) {
    echo '<script>alert("Xóa lịch tư vấn thành công")</script>';
    echo "<script>window.location.href='?qltv'</script>";
    exit();
} else {
    echo '<script>alert("Xóa lịch tư vấn thành công")</script>';
    echo "<script>window.location.href='?qltv'</script>";
    exit();
}