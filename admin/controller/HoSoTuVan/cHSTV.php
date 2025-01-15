<?php 

	include_once("model/HoSoTuVan/mHoSoTuVan.php");

	class cHSTV{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG KHÁCH HÀNG DOANH NGHIỆP
        public function count_hoso(){
            $p = new mHSTV();
            $table = $p -> count_hoso();
            return $table;
        }
        //
        //------------------------------------------
        #xem doanh nghiệp
		public function select_hoso_id($id_datlich){
			$p = new mHSTV();
			$table = $p -> select_hoso_id($id_datlich);
			return $table;
		}
		public function select_hosotuvan($idHoSo) {
			$p = new mHSTV();
			$table = $p -> select_hosotuvan($idHoSo) ;
			return $table;
		}
		public function get_hoso(){
            $p = new mHSTV();
            return $p->select_hoso();
        }
        
        public function search_hoso($search_query) {
            $p = new mHSTV();
            return $p->search_hoso($search_query);
        }

        public function del_lichtuvan($idRecord){
			$p = new mHSTV();
			$table = $p -> del_lichtuvan($idRecord);
			return $table;
		}
        public function update_status($id_datlich, $check){
			$p = new mHSTV();
			$table = $p -> update_status($id_datlich, $check);
			return $table;
		}

        public function insert_hoso($datetime_create, $loiDan, $chuanDoan, $id_datlich){
            $p= new mHSTV();
            $table = $p->insert_hoso($datetime_create, $loiDan, $chuanDoan, $id_datlich);
            //  var_dump($table);
            return $table;
        }
        public function update_hoso($idHoSo, $loiDan, $chuanDoan){
            $p= new mHSTV();
            $table = $p->update_hoso($idHoSo, $loiDan, $chuanDoan);
            //  var_dump($table);
            return $table;
        }
        
       
      
       
        

      
	}

 ?>