<?php 

	include_once("model/PhuHuynh/mdoanhnghiep.php");

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
		public function search_KHDN($search_query){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> search_KHDN($search_query);
			return $table;
		}

        public function select_KHDN(){
			$p = new mKhachHangDoanhNghiep();
			$table = $p -> select_KHDN();
			return $table;
		}

        public function select_doanhnghiep_byid_xa($idPhuHuynh){
            $p= new mKhachHangDoanhNghiep();
            $table = $p->select_doanhnghiep_id($idPhuHuynh);
            //  var_dump($table);
            return $table;
        }
        
       
      
        #update doanh nghiệp
        // 
        // CẬP NHẬT KHÁCH HÀNG KHÔNG USERNAME
        // 
		public function update_DN($idPhuHuynh, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$ngaySinh,$diaChi ,$tmpimg = '', $typeimg = '', $sizeimg = '') {
            $p = new mKhachHangDoanhNghiep();
            $user_data = $p->getUserDataById($idPhuHuynh); 
            $upload_success = false;
        
            if (!$user_data || !is_array($user_data)) {
                return -3; // Error: User not found or unexpected data type
            }
        
            $hinhAnhCu = isset($user_data['hinhAnh']) ? $user_data['hinhAnh'] : '';
        
            // Check image upload
            if ($tmpimg && $typeimg != '') {
                $type_array = explode('/', $typeimg);
                $image_type = $type_array[0];
        
                if ($image_type == "image" && $sizeimg <= 5 * 1024 * 1024) { // Changed to 5MB limit
                    $upload_path = "admin/assets/uploads/images/" . basename($hinhAnh);
                    if (move_uploaded_file($tmpimg, $upload_path)) {
                        $hinhAnh = $hinhAnh; // Use the new uploaded image
                        $upload_success = true;
                    } else {
                        return -1; // Error when uploading image
                    }
                } else {
                    return -2; // Invalid image
                }
            }
        
            // If no new image is uploaded, keep the old one
            if (!$upload_success) {
                $hinhAnh = $hinhAnhCu; // Keep the old image if no new upload
            }
        
            // Update the user data
            $update = $p->update_KHDN($idPhuHuynh, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$ngaySinh,$diaChi);
        
            return $update; // Return the update result
        }
        
        

        #update doanh nghiệp có username
        public function update_DN1($idPhuHuynh,$username){
            $p = new mKhachHangDoanhNghiep();
            $update = $p -> update_KHDN1($idPhuHuynh,$username);
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
        public function add_DN($email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh,$diaChi, $username){
            $p = new mKhachHangDoanhNghiep();
            $insert = $p->add_KHDN($email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh,$diaChi ,$username);
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
        function delete_khachhangdoanhnghiep($idPhuHuynh) {
            $p = new mKhachHangDoanhNghiep();
            $table = $p->del_KHDN($idPhuHuynh);
            if ($table) {
                return 1; // Xóa thành công
            } else {
                return 0; // Xóa không thành công
            }
        }
	}

 ?>