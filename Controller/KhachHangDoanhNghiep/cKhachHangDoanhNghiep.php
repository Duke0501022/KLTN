<?php 

	include_once("Model/KhachHangDoanhNghiep/mKhachHangDoanhNghiep.php");
	class cKHDN{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG KHÁCH HÀNG DOANH NGHIỆP
        public function count_dn(){
            $p = new mKhachHangDoanhNghiep();
            $table = $p -> count_dn();
            return $table;
        }
        //
        //------------------------------------------
        #xem doanh nghiệp
		public function select_KHDN(){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> select_KHDN();
			return $table;
		}
        public function select_KHDN_email($email){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> select_KHDN_email($email);
			return $table;
		}
        public function select_City(){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> select_City();
			return $table;
		}
        public function select_quanhuyen(){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> select_quanhuyen();
			return $table;
		}
        public function select_xa(){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> select_xa();
			return $table;
		}

        public function select_doanhnghiep_byid_xa($idPhuHuynh){
            $p= new mKhachHangDoanhNghiep();
            $table = $p->select_doanhnghiep_id($idPhuHuynh);
            //  var_dump($table);
            return $table;
        }

        public function select_KHDN_username($username){
            $p= new mKhachHangDoanhNghiep();
            $table = $p->check_username_in_all_tables($username);
            //  var_dump($table);
            return $table;
        }
        
        public function select_doanhnghiep_email($email){
            $p= new mKhachHangDoanhNghiep();
            $table = $p->select_doanhnghiep_email_id($email);
            //  var_dump($table);
            return $table;
        }
        
    
		public function update_DN($idPhuHuynh,$email,$hinhAnh,$hoTen,$ngaySinh,$soDienThoai,$gioiTinh,$tmpimg = '', $typeimg = '', $sizeimg = ''){
            $upload_success = false;
            if ($typeimg != '') {
                $type_array = explode('/',   $typeimg);
                $image_type = $type_array[0];
                if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
                    if (move_uploaded_file($tmpimg, "admin/assets/uploads/images/" . $hinhAnh)) {
                        $upload_success = true;
                    } else {
                        return -1;
                    }
                } else {
                    return -2;
                }
            }
            $p = new mKhachHangDoanhNghiep();
            $update = $p -> update_KHDN1($idPhuHuynh,$email,$hinhAnh,$hoTen,$ngaySinh,$soDienThoai,$gioiTinh);
            // var_dump($update);
            if($update){
                return 1; //cập nhật thành công
            }else{
                return 0; //cập nhật không thành công
            }
        }
        #update doanh nghiệp có username
        public function update_DN2($idPhuHuynh,$username){
            $p = new mKhachHangDoanhNghiep();
            $update = $p -> update_KHDN2($idPhuHuynh,$username);
            // var_dump($update);
            if($update){
                return 1; //cập nhật thành công
            }else{
                return 0; //cập nhật không thành công
            }
        }
        #update tài khoản
        public function update_taikhoan($username,$usernamecu,$password){
            $p=new mtaikhoan;
            $update=$p->updatetaikhoan($username,$usernamecu,$password);
            // var_dump ($update);
            if($update){
                return 1; //update thành công
            }else {
                return 0; //update thất bại
            }
        }
        #thêm doanh nghiệp
        public function add_KHDN($email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh, $username,$diaChi, $token = 1, $verifiedEmail = 1){
            $p = new mKhachHangDoanhNghiep();
            $insert = $p->add_KHDN($email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh, $username,$diaChi, $token = 1, $verifiedEmail = 1);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }
        #THÊM USERNAME CHO DOANH NGHIỆP CHƯA CÓ TÀI KHOẢN TRÊN BẢNG KHÁCH HÀNG
        public function UPDATE_KHDN_USERNAME($idPhuHuynh,$username){
            $p = new mKhachHangDoanhNghiep();
            $update = $p->update_khdn_username($idPhuHuynh,$username);
            // var_dump($update);
            if($update){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }





       
        #xóa khách hàng doanh nghiệp
        function delete_khachhangdoanhnghiep($idPhuHuynh){
			$p = new mKhachHangDoanhNghiep();
			$table  = $p -> del_KHDN($idPhuHuynh);
// 			var_dump($table);
			// return $table;
            if($table){
                return 1; //Xóa thành công
            }else {
                return 0;// Xóa không thành công
            }
		}
	}

 ?>