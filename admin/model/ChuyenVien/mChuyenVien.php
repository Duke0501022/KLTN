<?php
    include_once("model/connect.php");

    class mCV{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG KHÁCH HÀNG DOANH NGHIỆP
        public function count_nhanvien(){
          
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT count(*) FROM chuyenvien";
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
        public function select_nhanvien(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT *FROM chuyenvien";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        #Xem nhà cung cấp theo ID
        public function select_NVPP_id($idChuyenVien){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM chuyenvien
						WHERE idChuyenVien ='".$idChuyenVien."'";
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
        public function add_NVPP($hoTen, $soDienThoai, $email, $hinhAnh,$moTa,$gioiTinh,$ngaySinh,$diaChi,$username){
            
            $p = new ketnoi();
            if($p->moketnoi($conn)){
                $string = "INSERT INTO chuyenvien (hoTen, soDienThoai, email, hinhAnh, moTa, gioiTinh, ngaySinh,diaChi, username) VALUES ";
$string .= "('" . $hoTen . "','" . $soDienThoai . "','" . $email . "','" . $hinhAnh . "','" . $moTa . "','" . $gioiTinh . "','" . $ngaySinh . "','" . $diaChi . "','" . $username . "')";
                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
                // var_dump ($table);
                return $table;
            }else {
                return false;
            }
        }
        public function getUserDataByIds($idChuyenVien) {
            $p = new ketnoi();
            
            if ($p->moketnoi($conn)) {
                $string = "SELECT * FROM chuyenvien WHERE idChuyenVien = ?";
                $stmt = $conn->prepare($string);
                $stmt->bind_param("i", $idChuyenVien);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Đóng kết nối
                $p->dongketnoi($conn);
                
                if ($result->num_rows > 0) {
                    return $result->fetch_assoc(); // Trả về dữ liệu dưới dạng mảng kết hợp
                } else {
                    return false; // Không tìm thấy bản ghi
                }
            } else {
                return false; // Kết nối không thành công
            }
        }
        #Cap nhap nhan vien phan phoi
        public function update_NVPPS($idChuyenVien, $hoTen, $soDienThoai, $email, $hinhAnh,$moTa,$gioiTinh,$ngaySinh,$diaChi){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				// if($username !=""){
					$string ="update chuyenvien";
					$string .= " set hoTen='".$hoTen."', soDienThoai='".$soDienThoai."', email='".$email."', hinhAnh='".$hinhAnh."', moTa='".$moTa."', gioiTinh='".$gioiTinh."', ngaySinh='".$ngaySinh."',diaChi='".$diaChi."'";
					$string .= " Where idChuyenVien='".$idChuyenVien."'";
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
        public function search_chuyenvien($search_query) {
            // Kết nối đến database
            $p = new ketnoi();
            if($p -> moketnoi($conn)){
                $string =  "SELECT * FROM chuyenvien
                WHERE 
                hoTen LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
                OR email LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
                OR soDienThoai LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%'
                OR (gioiTinh = " . ($search_query == 'Nam' ? 0 : ($search_query == 'Nữ' ? 1 : -1)) . ")";
                $table = mysqli_query($conn,$string);
                $p -> dongketnoi($conn);
                //
                return $table;
            }else{
                return false;
            }
        }
    
        #xoa nhân viên phân phối
        function del_NVPP($idChuyenVien){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM chuyenvien where idChuyenVien='".$idChuyenVien."'";
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