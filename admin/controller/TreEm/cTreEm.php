<?php 

	include_once("model/TreEm/mTreEm.php");

	class cHoSoTreEm{
        //--------------THỐNG KÊ
        //
        #thong ke so luong tre em
        public function count_dn(){
            $p = new mHoSoTreEM();
            $table = $p -> count_te();
            return $table;
        }
       
		public function select_treem(){
			$p = new mHoSoTreEM();
			$table = $p -> select_treem();
			return $table;
		}
		public function update_treem_id($idHoSo,$tinhTrang,$noiDungKetQua){
			$p = new mHoSoTreEM();
			$table = $p -> update_treem_id($idHoSo,$tinhTrang,$noiDungKetQua);
			return $table;
		}

        public function get_phuhuynh(){
			$p = new mHoSoTreEM();
			$table = $p -> select_ph();
			return $table;
		}
        public function select_treem_byid_xa($idHoSo){
            $p= new mHoSoTreEM();
            $table = $p->select_treem_id($idHoSo);
            return $table;
        }
        
       
        #thêm doanh nghiệp
        public function add_TE($hoTen, $ngaySinh, $tinhTrang,$idPhuHuynh){
            $p = new mHoSoTreEM();
            $insert = $p->add_treem($hoTen, $ngaySinh, $tinhTrang,$idPhuHuynh);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }
        public function search_treem($search_query){
            $p = new mHoSoTreEM();
            $table = $p->search_treem($search_query);
            return $table;
        }
       
        #xóa khách hàng doanh nghiệp
        function delete_HSTE($idHoSo) {
            $p = new mHoSoTreEM();
            $table = $p->del_HSTE($idHoSo);
            if ($table) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa không thành công
            }
        }
	}

 ?>