<?php
include_once("Model/ChuyenVien/mChuyenVien.php");
class cCV
{
    function getCV()
    {
        $p = new ChuyenVienModel();
        $tbl = $p->select_nhanvien();
        return  $tbl;
    }

   
}
