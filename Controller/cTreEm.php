<?php

include_once("Model/mTreEm.php");

class cHoSoTreEm
{
    // Hàm thống kê số lượng trẻ em
    public function count_te()
    {
        $p = new mHoSoTreEM();
        $table = $p->count_te();
        return $table;
    }

    // Hàm lấy danh sách trẻ em theo idPhuHuynh
    public function select_treem()
    {
        $p = new mHoSoTreEM();
        $table = $p->select_treem(); // Lọc theo idPhuHuynh được thực hiện trong model
        return $table;
    }

    // Hàm lấy thông tin trẻ em theo ID
    public function select_treem_byid($idHoSo)
    {
        $p = new mHoSoTreEM();
        $table = $p->select_treem_id($idHoSo);
        return $table;
    }

    // Hàm thêm hồ sơ trẻ em
    public function add_TE($hoTenTE, $ngaySinh, $thaiKy, $tinhTrang, $hinhAnh,$gioiTinh)
    {
        $p = new mHoSoTreEM();
        $insert = $p->add_treem($hoTenTE, $ngaySinh, $thaiKy, $tinhTrang,$hinhAnh,$gioiTinh);
        if ($insert) {
            return 1; // Thêm thành công
        } else {
            return 0; // Thêm không thành công
        }
    }
    public function update_TE($idHoSo,$hoTenTE, $ngaySinh, $thaiKy, $tinhTrang,$hinhAnh,$gioiTinh,$tmpimg = '', $typeimg = '', $sizeimg = ''){
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
        $p = new mHoSoTreEM();
        $update = $p -> update_treem1($idHoSo,$hoTenTE, $ngaySinh, $thaiKy, $tinhTrang,$hinhAnh,$gioiTinh);
        // var_dump($update);
        if($update){
            return 1; //cập nhật thành công
        }else{
            return 0; //cập nhật không thành công
        }
    }

    // Hàm xóa hồ sơ trẻ em
    public function delete_HSTE($idHoSo)
    {
        $p = new mHoSoTreEM();
        $table = $p->del_HSTE($idHoSo);
        if ($table) {
            return 1; // Xóa thành công
        } else {
            return 0; // Xóa không thành công
        }
    }
}