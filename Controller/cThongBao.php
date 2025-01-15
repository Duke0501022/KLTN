<?php
include_once("Model/mThongBao.php");
class cThongBao
{
    public function select_thongbao($username)
    {
        $p = new thongBaoModel();
        $table = $p->select_thongbao($username);
        return $table;
    }

    public function createNotification($username, $noiDung,$thoiGian)
    {
        $p = new thongBaoModel();
        $table = $p->createNotification($username, $noiDung,$thoiGian);
        return $table;
    }

    public function getAllCustomers()
    {
        $model = new thongBaoModel();
        return $model->getAllCustomers();
    }

}
