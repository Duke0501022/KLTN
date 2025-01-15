<?php
include_once("Model/GiaoVien/mGiaoVien.php");
class cGVien
{
    function getGV()
    {
        $p = new mGiaoVien();
        $tbl = $p->select_giaovien();
        return  $tbl;
    }

   
}
