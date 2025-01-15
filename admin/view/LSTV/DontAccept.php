<?php
include_once("controller/LSTV/cLSTV.php");

$p = new cLSTV();

$idDatLich = $_GET['id_datlich'];

$kq = $p->DeleteTemporaryLich1($idDatLich);

if ($kq == true) {
    echo '<script>alert("Khôi phục lịch tư vấn thành công")</script>';
} else {
    echo '<script>alert("Khôi phục lịch không thành công")</script>';
}
echo "<script>window.location.href='?duyetuvan'</script>";
exit();
?>