<?php

include_once("controller/LSTV/cLSTV.php");

$menu = new cLSTV();


$idDatLich = $_GET['id_datlich'];

$kq = $menu->get_deldatlich($idDatLich);
if ($kq == 1) {
    echo '<script>alert("Xóa lịch tư vấn thành công")</script>';
    echo "<script>window.location.href='?qltv'</script>";
    exit();
} else {
    echo '<script>alert("Xóa lịch tư vấn thành công")</script>';
    echo "<script>window.location.href='?qltv'</script>";
    exit();
}