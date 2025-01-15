<?php 

	include_once("model/LoaiBaiViet/mTinTuc.php");

	class cloaibaiviet{
        
        public function select_tintuc(){
            $p = new mloaibaiviet();
            $table = $p -> select_tintuc();
            return $table;
        }
        public function count_tt(){
            $p = new mloaibaiviet();
            $table = $p -> count_tt();
            return $table;
        }
        public function get_tieude_ten($tieuDe){
            $p = new mloaibaiviet();
            $table = $p -> select_tieude_ten($tieuDe);
            return $table;
        }
       public function get_danhmuc(){
            $p = new mloaibaiviet();
            $table = $p -> select_danhmuc();
            return $table;
        }
        public function  select_tintuc_id($idTinTuc){
            $p= new  mloaibaiviet();
            $table = $p-> select_tintuc_id($idTinTuc);
            //  var_dump($table);
            return $table;
        }
        public function  select_tintucwait($wait){
            $p= new  mloaibaiviet();
            $table = $p-> select_tintucwait($wait);
            //  var_dump($table);
            return $table;
        }
        function AcceptDish($idTinTuc)
    {
        $p = new mloaibaiviet();
        $update = $p->AcceptDish($idTinTuc);
        return $update;
    }
    function getAllDishWait($wait)
    {
        $p = new mloaibaiviet();
        $tbl = $p->SelectAllDishWait($wait);
        return  $tbl;
    }
        
     
    public function update_tintuc($idTinTuc, $tieuDe, $noiDung, $hinhAnh, $danhMuc) {
        $p = new mloaibaiviet();
        $user_data = $p->select_tintuc_id($idTinTuc);
            if (!$user_data || mysqli_num_rows($user_data) == 0) {
                return -3; // Không tìm thấy tin tức
            }
            
           
            // Thực hiện cập nhật
            return $p->update_tintuc($idTinTuc,$tieuDe,$noiDung,$hinhAnh,$danhMuc);
        }
    
    
        
        public function add_tintuc($tieuDe,$noiDung,$hinhAnh,$danhMuc){
            $p = new  mloaibaiviet();
            $insert = $p->add_tintuc($tieuDe,$noiDung,$hinhAnh,$danhMuc);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }
      
        function del_tintuc($idTinTuc) {
            $p = new  mloaibaiviet();
            $table = $p->del_tintuc($idTinTuc);
            if ($table) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa không thành công
            }
        }
	}

 ?>