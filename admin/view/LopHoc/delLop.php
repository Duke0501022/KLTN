<?php
include("controller/LopHoc/cLopHoc.php");


if (isset($_REQUEST['idLopHoc'])) {
    $idLopHoc = $_REQUEST['idLopHoc'];
    $p = new cLopHoc();
   
    $delete = $p->del_lop($idLopHoc);
        if ($delete == 1) { // Corrected here
            echo "<script>alert('Xóa thành công');</script>";
            echo "<script>window.location.href='?qllop'</script>";
        } else {
            echo "<script>alert('Xóa không thành công');</script>";
            echo "<script>window.location.href='?qllop'</script>";
        }
    
}
?>