<?php
include_once("Model/mTracNghiem.php");
class cTracNghiem
{
    public function select_tracnghiem($idUnit)
    {
        $p = new mTracNghiem();
        $table = $p->select_tracnghiem($idUnit);
        return $table;
    }

    public function select_questions_by_unit($idUnit,$wait)
    {
        $p = new mTracNghiem();
        $table = $p->select_questions_by_unit($idUnit,$wait);
        return $table;
    }

    public function getTestUnits()
    {
        $model = new mTracNghiem();
        return $model->getTestUnits();
    }

    public function get_saveResult($noiDungKetQua, $ngayTao, $idTaiKhoan, $idUnit, $diemSo,  $idLinhVuc, $totalScoreByField)
    {
        $p = new mTracNghiem();
        $table = $p->luu_ketqua1($noiDungKetQua, $ngayTao, $idTaiKhoan, $idUnit, $diemSo,  $idLinhVuc, $totalScoreByField);
        return $table;
    }
}
