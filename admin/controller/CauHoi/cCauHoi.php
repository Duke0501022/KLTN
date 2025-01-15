<?php 

	include_once("model/CauHoi/mCauHoi.php");

	class cCauHoi{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG CAU HOI
        public function count_cauhoi(){
            $p = new mCauHoi();
            $table = $p -> count_cauhoi();
            return $table;
        }
        //
        //------------------------------------------
        #xem câu hỏi
		public function select_cauhoi(){
			$p = new mCauHoi();
			$table = $p -> select_cauhoi();
			return $table;
		}#Hiển thị  câu hỏi theo id
        public function select_cauhoi_id($idcauHoi){
            $p= new mCauHoi();
            $table = $p->select_cauhoi_id($idcauHoi);
            //  var_dump($table);
            return $table;
        }
        public function select_unit(){
			$p = new mCauHoi();
			$table = $p -> select_unit();
			return $table;
		}
        public function select_linhvuc(){
			$p = new mCauHoi();
			$table = $p -> select_linhvuc();
			return $table;
		}
        public function get_cauhoi_ten($cauHoi){
			$p = new mCauHoi();
			$table = $p -> select_cauhoi_ten($cauHoi);
			return $table;
		}
        public function select_cauhoiwait($wait){
			$p = new mCauHoi();
			$table = $p -> select_cauhoiwait($wait);
			return $table;
		}
        public function AcceptCauHoi($idCauHoi){
			$p = new mCauHoi();
			$table = $p -> AcceptCauHoi($idCauHoi);
			return $table;
		}
        function getAllCHWait($wait)
        {
            $p = new mCauHoi();
            $tbl = $p->SelectAllCHWait($wait);
            return  $tbl;
        }
      
        #update câu hỏi
    
        public function update_cauhoi1($idcauHoi, $cauHoi, $cau1, $cau2, $cau3, $hinhAnh, $idUnit, $idLinhVuc) {
            $p = new mCauHoi();
            
            // Kiểm tra câu hỏi tồn tại
            $user_data = $p->select_cauhoi_id($idcauHoi);
            if (!$user_data || mysqli_num_rows($user_data) == 0) {
                return -3; // Không tìm thấy câu hỏi
            }
            
           
            // Thực hiện cập nhật
            return $p->update_cauhoi($idcauHoi, $cauHoi, $cau1, $cau2, $cau3, $hinhAnh, $idUnit, $idLinhVuc);
        }
        #thêm câu hỏi
        public function add_cauhoi($cauHoi,$cau1,$cau2,$cau3,$hinhAnh,$idUnit,$idLinhVuc){
            $p = new mCauHoi();
            $insert = $p->add_cauhoi($cauHoi,$cau1,$cau2,$cau3,$hinhAnh,$idUnit,$idLinhVuc);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }
       
        #xóa khách hàng doanh nghiệp
        function del_cauhoi($idcauHoi){
			$p = new mCauHoi();
			$table  = $p -> del_cauhoi($idcauHoi);
// 			var_dump($table);
			// return $table;
            if($table){
                return 1; //Xóa thành công
            }else {
                return 0;// Xóa không thành công
            }
		}
        function del_cauhoiwait($idcauHoi){
            $p = new mCauHoi();
            $result = $p->del_cauhoiwait($idcauHoi);
            if($result){
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa không thành công
            }
        }
	}

 ?>