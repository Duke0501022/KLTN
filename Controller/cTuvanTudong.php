<?php

include_once("Model/mTuvanTudong.php");

class cTuvanTudong
{

    public function convert_vi_to_en($str)
    {
        $unicode = array(
            'a'=>'á|à|ạ|ả|ã|â|ấ|ầ|ậ|ẩ|ẫ|ă|ắ|ằ|ặ|ẳ|ẵ',
            'e'=>'é|è|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ',
            'i'=>'í|ì|ị|ỉ|ĩ',
            'o'=>'ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ|ơ|ớ|ờ|ợ|ở|ỡ',
            'u'=>'ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ự|ử|ữ',
            'y'=>'ý|ỳ|ỵ|ỷ|ỹ',
            'd'=>'đ',
            'A'=>'Á|À|Ạ|Ả|Ã|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ|Ă|Ắ|Ằ|Ặ|Ẳ|Ẵ',
            'E'=>'É|È|Ẹ|Ẻ|Ẽ|Ê|Ế|Ề|Ệ|Ể|Ễ',
            'I'=>'Í|Ì|Ị|Ỉ|Ĩ',
            'O'=>'Ó|Ò|Ọ|Ỏ|Õ|Ô|Ố|Ồ|Ộ|Ổ|Ỗ|Ơ|Ớ|Ờ|Ợ|Ở|Ỡ',
            'U'=>'Ú|Ù|Ụ|Ủ|Ũ|Ư|Ứ|Ừ|Ự|Ử|Ữ',
            'Y'=>'Ý|Ỳ|Ỵ|Ỷ|Ỹ',
            'D'=>'Đ'
        );
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    // public function select_tuvan($query)
    // {
    //     $model = new mTuvanTudong();
    //     $table = $model->select_tuvan($query);
    //     return $table;
    // }
    public function select_tuvan($query)
    {
        // Chuẩn hóa văn bản đầu vào
        $model = new mTuvanTudong();
        $query_normalized = strtolower($this->convert_vi_to_en($query));
        $table = $model->select_tuvan($query_normalized);
        return $table;
    }

    public function select_message($username)
    {
        $model = new mTuvanTudong();
        $table = $model->select_message($username);
        return $table;
    }

    public function insert_message($txt, $added_on, $user ,$username = null)
    {
        $model = new mTuvanTudong();
        $insert = $model->insert_message($txt, $added_on, $user ,$username);
        if ($insert) {
            return 1; // Thêm thành công
        } else {
            return 0; // Thêm không thành công
        }
    }
    
}
