<?php 
include_once("Model/mInfo.php");
class cInfo{
    public function select_info($username){
        $info = new mInfo();
        $res = $info->select_info($username);
        return $res;
    }

    public function update_info($username, $hoTen, $gioiTinh, $soDienThoai, $hinhAnh, $email){
        $info = new mInfo();
        $res = $info->update_info($username, $hoTen, $gioiTinh, $soDienThoai, $hinhAnh, $email);
        return $res;
    }

 
    public function update_info2($username, $hoTen, $gioiTinh, $soDienThoai, $email, $ngaySinh, $diaChi, $hinhAnh) {
        $p = new mInfo();
        
        // Always get the existing user info first
        $result = $p->select_info($username); 
        $oldData = mysqli_fetch_assoc($result);
        
        // If no new image uploaded, keep the old image
        if ($hinhAnh === NULL || empty($hinhAnh)) {
            $hinhAnh = $oldData['hinhAnh'];
        }
    
        $update = $p->update_info2($username, $hoTen, $gioiTinh, $soDienThoai, $email, $ngaySinh, $diaChi, $hinhAnh);
        
        return $update;
    }
    
}

?>