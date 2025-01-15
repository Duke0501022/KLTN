<?php 
include_once("model/mInfor.php");
class cInfo{
    public function select_info($username, $role){
        $info = new mInfo();
        // Thực hiện lựa chọn thông tin dựa trên vai trò
        switch ($role) {
            case '3':
                $res = $info->select_info($username,$role);
                break;
            case '4':
                $res = $info->select_info($username,$role);
                break;
            case '1':
                $res = $info->select_info($username,$role);
                break;
            case '5':
                $res = $info->select_info($username,$role);
                break;
            case '6':
                $res = $info->select_info($username,$role);
                break;    
            default:
                $res = false; // Trả về false nếu vai trò không hợp lệ
                break;
        }
        return $res;
    }

    public function update_info($username, $hoTen, $gioiTinh, $soDienThoai, $hinhAnh, $email){
        $info = new mInfo();
        $res = $info->update_info($username, $hoTen, $gioiTinh, $soDienThoai, $hinhAnh, $email);
        return $res;
    }
 
}

?>