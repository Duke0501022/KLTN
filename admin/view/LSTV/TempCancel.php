<?php
include_once("controller/LSTV/cLSTV.php");

$p = new cLSTV();

$idDatLich = $_GET['id_datlich'];

$kq = $p->DeleteTemporaryLich($idDatLich);

if ($kq == true) {
    echo '<script>alert("Xóa lịch tư vấn thành công")</script>';
} else {
    echo '<script>alert("Xóa lịch tư vấn không thành công")</script>';
}
echo "<script>window.location.href='?lichtuvan'</script>";
exit();
?>