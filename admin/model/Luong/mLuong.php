<?php
    include_once("model/connect.php");

    class mLuong{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG KHÁCH HÀNG DOANH NGHIỆP
        public function count_luong(){
          
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT count(*) FROM luong";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        //
        //------------------------------------------
        #Hiển thị thông tin nhà cung cấp
        public function select_luong(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string = "SELECT l.*, cv.hoTen , cv.email, cv.ngaySinh ,cv.hinhAnh FROM luong l LEFT JOIN chuyenvien cv ON l.idChuyenVien = cv.idChuyenVien ORDER BY l.id_luong DESC";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        #Xem nhà cung cấp theo ID
        public function select_luong_id($idLuong){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM luong
						WHERE id_luong ='".$idLuong."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
        }
        #Thêm nhân viên phân phối
        public function add_luong($idChuyenVien, $month, $year, $paid_date,$total_days,$luongcoban,$bonus,$status,$tax,$total_pay,$diducion){
            
            $p = new ketnoi();
            if($p->moketnoi($conn)){
                $string = "INSERT INTO luong (idChuyenVien, month, year, paid_date,total_days,luongcoban,bonus,status,tax,total_pay,diducion)) VALUES ";
$string .= "('" . $idChuyenVien . "','" . $month . "','" . $year . "','" . $paid_date . "','" . $total_days . "','" . $luongcoban . "','" . $bonus . "','" . $status . "','" . $tax . "','" . $total_pay . "','" . $diducion . "')";
                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
                // var_dump ($table);
                return $table;
            }else {
                return false;
            }
        }
       
        #Cap nhap nhan vien phan phoi
        public function update_luong($idLuong,$idChuyenVien, $month, $year, $paid_date,$total_days,$luongcoban,$bonus,$status,$tax,$total_pay,$diducion){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				// if($username !=""){
					$string ="update luong";
					$string .= " set month='".$month."', year='".$year."', paid_date='".$paid_date."', $total_days='".$total_days."', luongcoban'".$luongcoban."', $bonus='".$bonus."', status='".$status."', tax='".$tax."', total_pay='".$total_pay."', diducion='".$diducion."'";
					$string .= " Where id_luong='".$idLuong."'";
				// }else {
					// $string ="update nhanvienphanphoi";
					// $string .= " set MaNVPP='".$MaNVPP."', TenNVPP='".$TenNVPP."', SDT='".$SDT."', DiaChiNha='".$DiaChiNha."', NgaySinh='".$NgaySinh."', Email='".$Email."', GioiTinh='".$GioiTinh."',MaXa='".$MaXa."',MaTrungTamPP='".$MaTrungTamPP."'";
					// $string .= " Where MaNVPP='".$MaNVPP."'";
				// }
				
				// echo $string;
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				return $table;

			}else {
				return false;
			}
		}

        #xoa nhân viên phân phối
        function del_luong($idLuong){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM luong where id_luong='".$idLuong."'";
				//echo $string;
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//var_dump($table);
				return $table;
			}else{
				return false;
			}
		}
    }
?>