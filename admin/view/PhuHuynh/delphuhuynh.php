<?php
include("controller/PhuHuynh/cdoanhnghiep.php");
include_once("controller/TaiKhoan/ctaikhoan.php");

if (isset($_REQUEST['idPhuHuynh']) && isset($_REQUEST['username'])) {
    $idPhuHuynh = $_REQUEST['idPhuHuynh'];
    $username = $_REQUEST['username'];
    $p = new cKHDN();
    $tk = new ctaikhoan();
    $delete = $p->delete_khachhangdoanhnghiep($idPhuHuynh);
    if ($delete == 1) { // Corrected here
        $delete = $tk->delete_taikhoan($username);
        if ($delete == 1) { // Corrected here
            echo "<script>alert('Xóa thành công');</script>";
            echo "<script>window.location.href='?qlkhdn'</script>";
        } else {
            echo "<script>alert('Xóa không thành công');</script>";
            echo "<script>window.location.href='?qlkhdn'</script>";
        }
    }
}
?>