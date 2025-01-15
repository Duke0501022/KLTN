<?php

include_once("model/TietHoc/mTietHoc.php");
class cTH
{
    function getAllTH()
    {
        $p = new mTH();
        $tbl = $p->SelectAllTH();
        return  $tbl;
    } 
}
?>