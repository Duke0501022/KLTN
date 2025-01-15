<?php 

	include_once("model/LinhVuc/mLinhVuc.php");

	class cLinhVuc{
        
        public function get_LinhVuc(){
            $p = new mLinhVuc();
            $table = $p -> select_linhvuc();
            return $table;
        }
        public function count_linhvuc(){
            $p = new mLinhVuc();
            $table = $p -> count_linhvuc();
            return $table;
        }
        public function get_tenLinhVuc($tenLinhVuc,$idUnit){
            $p = new mLinhVuc();
            $table = $p -> select_tenLinhVuc($tenLinhVuc,$idUnit);
            return $table;
        }
        public function get_tieude_ten($idLinhVuc){
            $p = new mLinhVuc();
            $table = $p -> select_linhvuc_id($idLinhVuc);
            return $table;
        }
       public function getunit(){
            $p = new mLinhVuc();
            $table = $p -> select_unit();
            return $table;
        }
        public function update_linhvuc($idLinhVuc,$tenLinhVuc,$idUnit) {
            $p = new mLinhVuc();
            $table = $p->update_linhvuc($idLinhVuc,$tenLinhVuc,$idUnit);
                return $table;
            }
        
    
        
        public function add_linhvuc($tenLinhVuc,$idUnit){
            $p = new  mLinhVuc();
            $insert = $p->add_linhvuc($tenLinhVuc,$idUnit);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }
      
        function del_LinhVuc($idLinhVuc) {
            $p = new  mLinhVuc();
            $table = $p->del_LinhVuc($idLinhVuc);
            if ($table) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa không thành công
            }
        }
	}

 ?>