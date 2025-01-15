<?php

include_once("Model/Connect.php");

class mTuvanTudong
{
	
	// public function select_tuvan($query)
	// {
	// 	$conn;
	// 	$p = new clsketnoi();
	// 	if ($p->ketnoiDB($conn)) {
	// 		$escaped_query = mysqli_real_escape_string($conn, $query); // Tránh SQL injection
	// 		$string = "SELECT answer FROM chatbot WHERE query LIKE '%$escaped_query%'";
	// 		$table = mysqli_query($conn, $string);
	// 		$p->dongketnoi($conn);
	// 		return $table;
	// 	} else {
	// 		return false;
	// 	}
	// }
	public function select_tuvan($query)
    {
      
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $query_normalized = strtolower($this->convert_vi_to_en($query));
            $escaped_query = mysqli_real_escape_string($conn, $query_normalized); // Tránh SQL injection
            $string = "SELECT answer FROM chatbot WHERE LOWER(convert_vi_to_en(query)) LIKE '%$escaped_query%'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

	
	public function select_message($username)
	{
		
		$p = new clsketnoi();
		if ($p->ketnoiDB($conn)) {
			$string = "SELECT * FROM message where username = '$username'";
			$table = mysqli_query($conn, $string);
			$p->dongketnoi($conn);
			return $table;
		} else {
			return false;
		}
	}

	// Hàm chuyển đổi văn bản có dấu thành không dấu và chữ thường
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

	public function insert_message($txt, $added_on, $user,$username = null)
	{
		
		$p = new clsketnoi();
		if ($p->ketnoiDB($conn)) {
			$escaped_txt = mysqli_real_escape_string($conn, $txt); // Tránh SQL injection
			$escaped_user = mysqli_real_escape_string($conn, $user); // Tránh SQL injection
			if ($username !== null) {
				$username = mysqli_real_escape_string($conn, $username); // Tránh SQL injection
				$sql = "INSERT INTO message (noiDung, added_on, type ,username) VALUES ('$escaped_txt', '$added_on', '$escaped_user' ,'$username')";
			} else {
				$sql = "INSERT INTO message (noiDung, added_on, type, ) VALUES ('$escaped_txt', '$added_on', '$escaped_user')";
			}
			$result = mysqli_query($conn, $sql);
			$p->dongketnoi($conn);
			return $result;
		} else {
			return false;
		}
	}

	
}
