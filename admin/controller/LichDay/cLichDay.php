<?php

include_once("model/LichDay/mLichDay.php");
class cLichDay
{
    function getLatestMenu()
    {
        $p = new mLichDay();
        $tbl = $p->SelectLatestMenu();
        return  $tbl;
    }

    function getAlltMenu()
    {
        $p = new mLichDay();
        $tbl = $p->SelectAllMenu();
        return  $tbl;
    }
    function UpdateStatus($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $check_lich)
    {
        $p = new mLichDay();
        $tbl = $p->UpdateStatus($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc, $check_lich);
        return  $tbl;
    }

    
    function   getAllMenuDetailMenu()

    {
        $p = new mLichDay();
        $tbl = $p->SelectAllMenuDetailMenu();
        return  $tbl;
    }
    function InsertMenuDetails($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc,$idLopHoc)
    {
        $p = new mLichDay();
        $tbl = $p->InsertMenuDetails($idLichGD, $idGiaoVien, $idPhongHoc, $idTietHoc,$idLopHoc);
        if ($tbl) {
            return 1;
        } else {
            return 0;
        }
    }

    function InsertMenu($ngayTao)
    {
        $p = new mLichDay();
        $tbl = $p->InsertMenu($ngayTao);
        return  $tbl;
    }

    function getMenuByDate($ngayTao)
    {

        $p = new mLichDay();
        $tbl = $p->SelectMenuByDate($ngayTao);
        return  $tbl;
    }
    function getClassesByTeacherId($teacherId)
    {

        $p = new mLichDay();
        $tbl = $p->getClassesByTeacherId($teacherId);
        return  $tbl;
    }

    function getMenuByDatebyIDGV($ngayTao, $idGiaoVien, $username)
    {

        $p = new mLichDay();
        $tbl = $p->SelectMenuByDatebyIDGV($ngayTao, $idGiaoVien, $username);
        return  $tbl;
    }

    function getOneMenuByDate($ngayTao)
    {

        $p = new mLichDay();
        $tbl = $p->SelectOneMenuByDate($ngayTao);
        return  $tbl;
    }
    function hasRoomConflict($roomId, $date, $timeSlotId)
    {

        $p = new mLichDay();
        $tbl = $p->hasRoomConflict($roomId, $date, $timeSlotId);
        return  $tbl;
    }
    function hasTeacherConflict($teacherId, $date, $timeSlotId)
    {

        $p = new mLichDay();
        $tbl = $p->hasTeacherConflict($teacherId, $date, $timeSlotId);
        return  $tbl;
    }
    function hasClassConflict($classId, $date, $timeSlotId)
    {

        $p = new mLichDay();
        $tbl = $p->hasClassConflict($classId, $date, $timeSlotId);
        return  $tbl;
    }

    function  DeletedLichbyid($idLichGD, $idGiaoVien,$idPhongHoc,$idTietHoc)
    {

        $p = new mLichDay();
        $tbl = $p->DeletedLichbyid($idLichGD, $idGiaoVien,$idPhongHoc,$idTietHoc);
        return  $tbl;
    }
}
