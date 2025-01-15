<?php

include_once("model/QTV/mQTV.php");
class cQTV
{
   
    public function count_qtgv(){
        $p = new mQTV();
        $table = $p->count_qtgv();
        return $table;
    }
    public function count_qtcv(){
        $p = new mQTV();
        $table = $p->count_qtcv();
        return $table;
    }
    public function get_qtgv(){
        $p = new mQTV();
        $table = $p->select_qtgv();
        return $table;
    }
    public function get_qtcv(){
        $p = new mQTV();
        $table = $p->select_qtcv();
        return $table;
    }

    public function search_qtgiaovien($search_query){
        $p = new mQTV();
        $table = $p->search_qtgiaovien($search_query);
        return $table;
    }
    public function search_qtchuyenvien($search_query){
        $p = new mQTV();
        $table = $p->search_qtchuyenvien($search_query);
        return $table;
    }

     public function select_qtgv_id($idQTGV){
        $p=new mQTV();
        $table=$p->select_qtgv_id($idQTGV);
        return $table;
     }
     public function select_qtcv_id($idQTCV){
        $p=new mQTV();
        $table=$p->select_qtcv_id($idQTCV);
        return $table;
     }
    #thêm nhân viên phân phối
    public function add_QTGV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$username){
        $p = new mQTV();
        $insert = $p->add_QTGV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$username);
        // var_dump($insert);
        if($insert){
            return 1;// thêm thành công
        }else {
            return 0;//thêm không thành công
        }
       
       
    }
    public function add_QTCV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$username){
        $p = new mQTV();
        $insert = $p->add_QTCV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$username);
        // var_dump($insert);
        if($insert){
            return 1;// thêm thành công
        }else {
            return 0;//thêm không thành công
        }
       
       
    }
    

    #Cap nhap thong tin nhan vien
    public function update_QTGV($idQTGV, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $tmpimg = '', $typeimg = '', $sizeimg = '') {
        $p = new mQTV();
        $user_data = $p->getUserDataByIdQTGV($idQTGV); 
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
        $update = $p->update_QTGVs($idQTGV, $hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh);
    
        return $update; // Return the update result
    }
    public function update_QTCV($idQTCV, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh, $tmpimg = '', $typeimg = '', $sizeimg = '') {
        $p = new mQTV();
        $user_data = $p->getUserDataByIdQTCV($idQTCV); 
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
        $update = $p->update_QTCVs($idQTCV, $hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh);
    
        return $update; // Return the update result
    }

    function del_QTCV($idQTCV){
        $p = new mQTV();
        $table  = $p -> del_QTCV($idQTCV);
        //var_dump($table);
        return $table;
    }
    function del_QTGV($idQTGV){
        $p = new mQTV();
        $table  = $p -> del_QTGV($idQTGV);
        //var_dump($table);
        return $table;
    }
}
?>