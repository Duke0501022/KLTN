<?php

include_once("Model/LichHoc/mLichHoc.php");
class cLichHoc
{


    function getMenuByDatebyIDGV($ngayTao, $idHoSo)
    {

        $p = new mLichHoc();
        $tbl = $p->SelectMenuByDatebyIDGV($ngayTao, $idHoSo);
        return  $tbl;
    }
    function getIdHoSoByPhuHuynh($idPhuHuynh)
    {

        $p = new mLichHoc();
        $tbl = $p->getIdHoSoByPhuHuynh($idPhuHuynh);
        return  $tbl;
    }


}
