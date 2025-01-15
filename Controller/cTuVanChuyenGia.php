<?php
// include_once("Model/mTuVanChuyenGia.php");
include_once(__DIR__ . '/../Model/mTuVanChuyenGia.php');

class cTuVanChuyenGia
{
    public function getTestCG()
    {
        $model = new mTuVanChuyenGia();
        return $model->getTestCG();
    }

    public function select_ChuyenGia($idChuyenVien)
    {
        $model = new mTuVanChuyenGia();
        return $model->select_ChuyenGia($idChuyenVien);
    }
    
    public function insert_tuvanchuyengia($sender_id, $receiver_id, $message)
    {
        $model = new mTuVanChuyenGia();
        return $model->insert_tuvanchuyengia($sender_id, $receiver_id, $message);
    }

    public function get_messages($sender_id, $receiver_id)
    {
        $model = new mTuVanChuyenGia();
        return $model->get_messages($sender_id, $receiver_id);
    }
}

?>
