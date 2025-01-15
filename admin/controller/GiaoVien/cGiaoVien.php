<?php

include_once("model/GiaoVien/mGiaoVien.php");
class cGV
{
    function getAllGV()
    {
        $p = new mGV();
        $tbl = $p->SelectAllGV();
        return  $tbl;
    } 
    public function count_GV(){
        $p = new mGV();
        $table = $p->count_GV();
        return $table;
    }
    public function search_giaovien($search_query){
        $p = new mGV();
        $table = $p->search_giaovien($search_query);
        return $table;
    }

     public function select_GV_byid($idGiaoVien){
        $p=new mGV();
        $table=$p->select_GV_id($idGiaoVien);
        return $table;
     }
    #thêm nhân viên phân phối
    public function add_GV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$ngaySinh,$diaChi,$username){
        $p = new mGV();
        $insert = $p->add_GV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$ngaySinh,$diaChi,$username);
        // var_dump($insert);
        if($insert){
            return 1;// thêm thành công
        }else {
            return 0;//thêm không thành công
        }
       
       
    }
    

    #Cap nhap thong tin nhan vien
    public function update_GV($idGiaoVien, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$diaChi, $tmpimg = '', $typeimg = '', $sizeimg = '',$ngaySinh) {
        $p = new mGV();
        $user_data = $p->getUserDataByIds($idGiaoVien); 
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
        $update = $p->update_GSV($idGiaoVien, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$ngaySinh,$diaChi);
    
        return $update; // Return the update result
    }

    function del_GV($idGiaoVien){
        $p = new mGV();
        $table  = $p -> del_GV($idGiaoVien);
        //var_dump($table);
        return $table;
    }
}
?>