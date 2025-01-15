<?php
include_once(__DIR__ . '/../model/mTuVanKH.php');


class cTuVanPhuHuynh
{
    public function getTestPH()
    {
        $model = new mTuVanKH();
        return $model->getTestPH();
    }

    public function select_PhuHuynh($idPhuHuynh)
    {
        $model = new mTuVanKH();
        return $model->select_PhuHuynh($idPhuHuynh);
    }

    public function insert_tuvanchuyengia($sender_id, $receiver_id, $message, $image_url)
    {
        $model = new mTuVanKH();
        return $model->insert_tuvanchuyengia($sender_id, $receiver_id, $message, $image_url);
    }

    public function get_messages($sender_id, $receiver_id)
    {
        $model = new mTuVanKH();
        return $model->get_messages($sender_id, $receiver_id);
    }

    public function get_new_messages($sender_id, $receiver_id)
    {
        $model = new mTuVanKH();
        return $model->get_new_messages($sender_id, $receiver_id);
    }

    public function mark_read($sender_id, $receiver_id)
    {
        $model = new mTuVanKH();
        return $model->mark_read($sender_id, $receiver_id);
    }
}
