<?php
include("controller/TreEm/cTreEm.php");

// Kiểm tra sự tồn tại của idHoSo
if (isset($_REQUEST['idHoSo'])) {
    $idHoSo = $_REQUEST['idHoSo']; // Lấy idHoSo từ yêu cầu
    $p = new cHoSoTreEm(); // Khởi tạo đối tượng controller

    // Xóa hồ sơ trẻ em
    $delete = $p->delete_HSTE($idHoSo);

    if ($delete == 1) { // Xóa hồ sơ trẻ em thành công
        echo "<script>alert('Xóa thành công');</script>";
        echo "<script>window.location.href='?qlte'</script>";
    } else { // Xóa hồ sơ trẻ em không thành công
        echo "<script>alert('Xóa không thành công');</script>";
        echo "<script>window.location.href='?qlte'</script>";
    }
} else {
    // Nếu không có idHoSo trong yêu cầu
    echo "<script>alert('Yêu cầu không hợp lệ');</script>";
    echo "<script>window.location.href='?qlte'</script>";
}
?>