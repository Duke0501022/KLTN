<?php
include_once("model/connect.php");

class mLichSu
{
    public function select_ketqua(){
        $p = new ketnoi();
        if ($p->moketnoi($conn)) {
            $string = "SELECT ketqua.*, phuhuynh.hoTenPH AS hoTenPH, phuhuynh.hinhAnh,phuhuynh.email, unit.tenUnit, linhvuc.tenLinhVuc, ketqualinhvuc.diemLinhVuc
                       FROM ketqua
                       JOIN phuhuynh ON phuhuynh.idPhuHuynh = ketqua.idPhuHuynh
                       LEFT JOIN unit ON unit.idUnit = ketqua.idUnit
                       LEFT JOIN ketqualinhvuc ON ketqualinhvuc.idKetQua = ketqua.idKetQua
                       LEFT JOIN linhvuc ON linhvuc.idLinhVuc = ketqualinhvuc.idLinhVuc
                       ORDER BY ketqua.ngayTao DESC";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            return $table;
        } else {
            return false;
        }
    }
    public function select_ketqua_idPhuHuynh($idPhuHuynh){
            
        $p= new ketnoi();
        if($p->moketnoi($conn)){
            $string = "SELECT * FROM ketqua WHERE idPhuHuynh = '$idPhuHuynh'";
            // echo $string;
            $table= mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            // var_dump($table);
            return $table;
        }else {
            return false;
        }
    }
   


    
  
    
}
