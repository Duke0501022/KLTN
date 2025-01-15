<?php
include_once("Controller/Datlich/CDatlich.php");
if (isset($_GET['id_khoa'])) {
$mTuVan = new cDatlich();
$listcv = $mTuVan->select_lich($id_khoa);
$id_khoa = $_GET['id_khoa'];
}

if (isset($listcv)) {
  print_r($listcv);  // Kiểm tra dữ liệu trả về
}
?>


