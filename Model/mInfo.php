<?php
include_once("Model/Connect.php");

class mInfo
{

    public function select_info($username)
    {

        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM phuhuynh where username = '$username'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }


    public function update_info($username, $hoTen, $gioiTinh, $soDienThoai, $hinhAnh, $email)
    {

        $p = new clsketnoi();
			if($p->ketnoiDB($conn)){
				// if($username !=""){
					$string ="update phuhuynh";
					$string .= " set email='".$email."', hinhAnh='".$hinhAnh."', hoTenPH='".$hoTen."', soDienThoai='".$soDienThoai."', gioiTinh='".$gioiTinh."'";
					$string .= " Where useranme ='".$username."'";
				// }else {
					// $string ="update khachhang";
					// $string .= " set MaKH='".$MaKH."', TenKH='".$TenKH."', Diachi='".$DiaChi."', SDT='".$SDT."', Email='".$Email."', GioiTinh='".$GioiTinh."', TenDoanhNghiep='".$TenDoanhNghiep."', GioiThieu='".$GioiThieu."', MaXa='".$MaXa."'";
					// $string .= " Where MaKH='".$MaKH."'";
				// }
				// echo $string;
				// echo $username;
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;

			}else {
				return false;
			}
    }

    // Viết hàm sửa thông tin gồm họ tên, giới tính, số điện thoại, hình ảnh (có upload hình ảnh lên), email
    public function update_info2($username, $hoTen, $gioiTinh, $soDienThoai, $email, $ngaySinh, $diaChi, $hinhAnh) {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "UPDATE phuhuynh SET hoTenPH = '$hoTen', gioiTinh = '$gioiTinh', soDienThoai = '$soDienThoai', email = '$email', ngaySinh = '$ngaySinh', diaChi = '$diaChi', hinhAnh = '$hinhAnh' WHERE username = '$username'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }

    
}
