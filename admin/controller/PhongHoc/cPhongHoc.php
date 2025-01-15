<?php

include_once("model/PhongHoc/mPhongHoc.php");
class cPH
{
    function getAllPH()
    {
        $p = new mPH();
        $tbl = $p->SelectAllPH();
        return  $tbl;
    } 
}
?>