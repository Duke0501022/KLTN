<?php
    include_once("model/ChuyenVien/mChuyenVien.php");

    class cNVPP{
    	//--------------THỐNG KÊ
		//
		#THỐNG KÊ SỐ LƯỢNG nhân viên phân phối
		public function count_nhanvien(){
            $p = new mCV();
            $table = $p->count_nhanvien();
            return $table;
        }
		//
		//------------------------------------------
        #Hien thi thong tin thanh vien
        public function select_NVPP(){
            $p = new mCV();
            $table = $p->select_nhanvien();
            return $table;
        }
        #Hien thi thong tin thanh vien theo MaKHTV
         public function select_nhanvien_byid($idChuyenVien){
            $p=new mCV();
            $table=$p->select_NVPP_id($idChuyenVien);
            return $table;
         }
         public function search_chuyenvien($search_query){
            $p=new mCV();
            $table=$p->search_chuyenvien($search_query);
            return $table;
         }
        #thêm nhân viên phân phối
        public function add_NVPP($hoTen, $soDienThoai, $email, $hinhAnh,$moTa,$gioiTinh,$ngaySinh,$diaChi,$username){
            $p = new mCV();
            $insert = $p->add_NVPP($hoTen, $soDienThoai, $email, $hinhAnh,$moTa,$gioiTinh,$ngaySinh,$diaChi,$username);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
           
        }
		


		#Cap nhap thong tin nhan vien
		public function update_CV($idChuyenVien, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$moTa,$diaChi, $tmpimg = '', $typeimg = '', $sizeimg = '',$ngaySinh) {
            $p = new mCV();
            $user_data = $p->getUserDataByIds($idChuyenVien); 
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
            $update = $p->update_NVPPS($idChuyenVien, $hoTen, $soDienThoai, $email, $hinhAnh,$moTa,$gioiTinh,$ngaySinh,$diaChi);
        
            return $update; // Return the update result
        }



        #xoa nhan vien
        function del_NVPP($idChuyenVien){
			$p = new mCV();
			$table  = $p -> del_NVPP($idChuyenVien);
			//var_dump($table);
			return $table;
		}
    }
?>