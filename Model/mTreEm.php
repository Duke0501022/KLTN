<?php

include_once("Model/Connect.php");

class mHoSoTreEM
{
    //--------------THỐNG KÊ
    //
    #thống kê số lượng trẻ em
    public function count_te()
    {

        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT count(*) FROM hosotreem";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            //
            return $table;
        } else {
            return false;
        }
    }
    //
    public function select_treem()
    {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Lấy username từ session
            $idPhuHuynh = isset($_SESSION['idPhuHuynh']) ? $_SESSION['idPhuHuynh'] : '';

            if ($idPhuHuynh) {
                $string = "SELECT * FROM hosotreem WHERE idPhuHuynh = '" . $idPhuHuynh . "'";
            } else {
                return false; // Không có idPhuHuynh trong session, trả về false
            }

            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }


    #thêm thông tin trẻ em
    public function add_treem($hoTenTE, $ngaySinh, $thaiKy, $tinhTrang, $hinhAnh,$gioiTinh)
    {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Lấy username từ session của phụ huynh đã đăng nhập
            $idPhuHuynh = $_SESSION['idPhuHuynh'];

            // Nếu username tồn tại trong session
            if ($idPhuHuynh != "") {
                $string = "INSERT INTO hosotreem(hoTenTE, ngaySinh, thaiKy, tinhTrang, hinhAnh,gioiTinh, idPhuHuynh) 
                       VALUES ('" . $hoTenTE . "','" . $ngaySinh . "','" . $thaiKy . "','" . $tinhTrang . "','" . $hinhAnh . "','" . $gioiTinh . "','" . $idPhuHuynh . "')";
            } else {
                // Trường hợp này sẽ không xảy ra vì idPhuHuynh luôn phải tồn tại khi phụ huynh đăng nhập
                return false;
            }

            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    #Hiển thị trẻ em theo id
    public function select_treem_id($idHoSo)
    {

        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM hosotreem
						WHERE idHoSo ='" . $idHoSo . "'";
            // echo $string;
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            // var_dump($table);
            return $table;
        } else {
            return false;
        }
    }
    public function update_treem1($idHoSo,$hoTenTE, $ngaySinh, $thaiKy, $tinhTrang,$hinhAnh,$gioiTinh){
			
        $p= new  clsketnoi();
        if($p->ketnoiDB($conn)){
            // if($username !=""){
                $string ="update hosotreem";
                $string .= " set  hoTenTE ='".$hoTenTE."', hinhAnh='".$hinhAnh."', tinhTrang='".$tinhTrang."',ngaySinh='".$ngaySinh."', thaiKy='".$thaiKy."', gioiTinh='".$gioiTinh."'";
                $string .= " Where idHoSo='".$idHoSo."'";
            
            $table =mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            // var_dump($table);
            return $table;

        }else {
            return false;
        }
    }
    #XÓA TRẺ EM
    function del_HSTE($idHoSo)
    {

        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "Delete FROM hosotreem where idHoSo ='" . $idHoSo . "'";
            // echo $string;
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            // var_dump($table);
            return $table;
        } else {
            return false;
        }
    }
}