<?php 

	include_once("model/connect.php");

	class mKhachHangDoanhNghiep{
		//--------------THỐNG KÊ
		//
		#THỐNG KÊ SỐ LƯỢNG PHỤ HUYNH
		public function count_dn(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT count(*) FROM phuhuynh";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
		//
		//------------------------------------------
		#xem phụ huynh
		public function select_KHDN(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM phuhuynh";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
		public function search_KHDN($search_query) {
			// Kết nối đến database
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string =  "SELECT * FROM phuhuynh 
				WHERE 
			     hoTenPH LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
				OR email LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
				OR (gioiTinh = " . ($search_query == 'Nam' ? 0 : ($search_query == 'Nữ' ? 1 : -1)) . ")";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}

		#THÊM THÔNG TIN PHỤ HUYNH
		public function add_KHDN($email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh,$diaChi, $username){
			
			$p = new ketnoi();
			if($p->moketnoi($conn)){
				if ($username !="") {
					$string="insert into phuhuynh(email,hinhAnh,hoTenPH,soDienThoai,gioiTinh,ngaySinh,diaChi, username) values";
                	$string .= "('".$email."','".$hinhAnh."','".$hoTen."','".$soDienThoai."','".$gioiTinh."','".$ngaySinh."','".$diaChi."','".$username."')";
				}else {
					$string="insert into phuhuynh(email,hinhAnh,hoTenPH,soDienThoai,gioiTinh,ngaySinh,diaChi) values";
                	$string .= "('".$email."','".$hinhAnh."','".$hoTen."','".$soDienThoai."','".$gioiTinh."','".$ngaySinh."','".$diaChi."')";
				}
				
                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
				// var_dump($table);
                return $table;
            }else{
                return false;
            }
		}
		
		#THÊM USERNAME CHO PH CHƯA CÓ TÀI KHOẢN TRÊN BẢNG KHÁCH HÀNG
		public function update_khdn_username($idPhuHuynh,$username){
			
			$p = new ketnoi();
			if($p->moketnoi($conn)){
					$string ="update phuhuynh";
					$string .= " set username='".$username."'";
					$string .= " Where idPhuHuynh='".$idPhuHuynh."'";
                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
				// var_dump($table);
                return $table;
            }else{
                return false;
            }
		}
		#Hiển thị theo MAKH
		public function select_doanhnghiep_id($idPhuHuynh){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM phuhuynh
						WHERE idPhuHuynh ='".$idPhuHuynh."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
		}

		public function getUserDataById($idPhuHuynh) {
			$p = new ketnoi();
			
			if ($p->moketnoi($conn)) {
				$string = "SELECT * FROM phuhuynh WHERE idPhuHuynh = ?";
				$stmt = $conn->prepare($string);
				$stmt->bind_param("i", $idPhuHuynh);
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
		#UPDATE KHACH HANG 
		public function update_KHDN($idPhuHuynh,$email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh,$diaChi){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				// if($username !=""){
					$string ="update phuhuynh";
					$string .= " set idPhuHuynh='".$idPhuHuynh."', email='".$email."', hinhAnh='".$hinhAnh."', hoTenPH='".$hoTen."', soDienThoai='".$soDienThoai."', gioiTinh='".$gioiTinh."', ngaySinh='".$ngaySinh."', diaChi='".$diaChi."'";
					$string .= " Where idPhuHuynh='".$idPhuHuynh."'";
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
		#UPDATE KHACH HANG  CO USERNAME
		public function update_KHDN1($idPhuHuynh,$username){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				
					$string ="update phuhuynh";
					$string .= " set username='".$username."'";
					$string .= " Where idPhuHuynh='".$idPhuHuynh."'";
				
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
		#UPDATE TAI KHOAN KHACH HANG
		public function updatetaikhoan($username,$password){
           
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                // $password=md5('1');
                $string="update taikhoan1";
                $string .=" set username='".$username."', password='".$password."'";
                $string .= "where username='".$username."'";
                // echo $string;
                $table = mysqli_query($conn, $string);
				// var_dump($table);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
		
		#XÓA KH
		function del_KHDN($idPhuHuynh){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM phuhuynh where idPhuHuynh ='".$idPhuHuynh."'";
				// echo $string;
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				// var_dump($table);
				return $table;
			}else{
				return false;
			}
		}
	}	
?>