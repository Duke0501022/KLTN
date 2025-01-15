<?php
    include_once("model/Luong/mLuong.php");

    class cLuong{
    	//--------------THỐNG KÊ
		//
		#THỐNG KÊ SỐ LƯỢNG nhân viên phân phối
		public function count_luong(){
            $p = new mLuong();
            $table = $p->count_luong();
            return $table;
        }
		//
		//------------------------------------------
        #Hien thi thong tin thanh vien
        public function select_luong(){
            $p = new mLuong();
            $table = $p->select_luong();
            return $table;
        }
        #Hien thi thong tin thanh vien theo MaKHTV
         public function select_luong_id($idLuong){
            $p=new mLuong();
            $table=$p->select_luong_id($idLuong);
            return $table;
         }
        #thêm nhân viên phân phối
        public function add_luong($idChuyenVien, $month, $year, $paid_date,$total_days,$luongcoban,$bonus,$status,$tax,$total_pay,$diducion){
            $p = new mLuong();
            $insert = $p->add_luong($idChuyenVien, $month, $year, $paid_date,$total_days,$luongcoban,$bonus,$status,$tax,$total_pay,$diducion);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
           
        }
		// #kiem tra user
		// public function check_user($username){
        //     $p= new mNVPP();
        //     $table = $p -> checkuser($username);
		// 	return $table;
		// }


		#Cap nhap thong tin nhan vien
		public function  update_luong($idLuong,$idChuyenVien, $month, $year, $paid_date,$total_days,$luongcoban,$bonus,$status,$tax,$total_pay,$diducion){
			$p=new mLuong();
			$update=$p-> update_luong($idLuong,$idChuyenVien, $month, $year, $paid_date,$total_days,$luongcoban,$bonus,$status,$tax,$total_pay,$diducion);
			//var_dump($update);
			if($update){
				return 1;// update thành công
			}else{
				return 0;// update không thành công
			}
				
		}

        #THÊM USERNAME CHO NHÂN VIÊN PHÂN PHỐI CHƯA CÓ TÀI KHOẢN TRÊN BẢNG NHÂN VIÊN PHÂN PHỐI
      




        #xoa nhan vien
        function del_luong($idLuong){
			$p = new mLuong();;
			$table  = $p -> del_luong($idLuong);
			//var_dump($table);
			return $table;
		}
    }
?>