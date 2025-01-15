<?php 

	include_once("Model/Connect.php");

	class mKhachHangDoanhNghiep{
		//--------------THỐNG KÊ
		//
		#THỐNG KÊ SỐ LƯỢNG KHÁCH HÀNG DOANH NGHIỆP
		public function count_dn(){
			
			$p = new  clsketnoi();
			if($p -> ketnoiDB($conn)){
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
		#xem doanh nghiệp
		public function select_KHDN(){
			
			$p = new  clsketnoi();
			if($p -> ketnoiDB($conn)){
				$string = "SELECT * FROM phuhuynh";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
		public function select_KHDN_email($email) {
			$p = new clsketnoi();
			if ($p->ketnoiDB($conn)) {
				$string = "SELECT * FROM phuhuynh WHERE email = '$email'";
				$table = mysqli_query($conn, $string);
				
				$p->dongketnoi($conn);
		
				if (mysqli_num_rows($table) > 0) {
					return true;
				}
				return false;
			}
			return false;
		}
		public function check_username_in_all_tables($username) {
			$p = new clsketnoi();
			if ($p->ketnoiDB($conn)) {
				$tables = ['phuhuynh', 'giaovien', 'chuyenvien', 'quantrigiaovien', 'admin', 'quantrichuyenvien','taikhoan1'];
				foreach ($tables as $table) {
					$string = "SELECT * FROM $table WHERE username = '$username'";
					$result = mysqli_query($conn, $string);
					if (mysqli_num_rows($result) > 0) {
						$p->dongketnoi($conn);
						return true;
					}
				}
				$p->dongketnoi($conn);
				return false;
			} else {
				return false;
			}
		}
		public function select_City() {
			$p = new clsketnoi();
			if ($p->ketnoiDB($conn)) {
				$sql = "SELECT * FROM province";
				$result = mysqli_query($conn, $sql);
				$cities = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$cities[] = $row;
				}
				echo json_encode($cities);
				$p->dongketnoi($conn);
		
				// Check if any rows were returned
			}
		}
		public function select_quanhuyen() {
			$city_id = $_GET['province_id'];
			$p = new clsketnoi();
			if ($p->ketnoiDB($conn)) {
				$sql = "SELECT * FROM district WHERE province_id = '$city_id'";
				$result = mysqli_query($conn, $sql);
				$districts = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$districts[] = $row;
				}
				echo json_encode($districts);
				$p->dongketnoi($conn);
			}
		}
		public function select_xa() {
			$district_id = $_GET['district_id'];
			$p = new clsketnoi();
			if ($p->ketnoiDB($conn)) {
				$sql = "SELECT * FROM wards WHERE district_id = '$district_id'";
				$result = mysqli_query($conn, $sql);
				$wards = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$wards[] = $row;
				}
				echo json_encode($wards);
				$p->dongketnoi($conn);
			}
		}
		
		#THÊM THÔNG TIN DOANH NGHIỆP 
		public function add_KHDN($email,$hinhAnh,$hoTen,$soDienThoai,$gioiTinh,$ngaySinh, $username,$diaChi, $token = 1, $verifiedEmail = 1){
			
			$p = new  clsketnoi();
			if($p->ketnoiDB($conn)){
				if ($username !="") {
					$string="insert into phuhuynh(email, hinhAnh, hoTenPH, soDienThoai, gioiTinh, ngaySinh,username, diaChi,  token, verifiedEmail) values";
                	$string .= "('".$email."','".$hinhAnh."','".$hoTen."','".$soDienThoai."','".$gioiTinh."','".$ngaySinh."','".$username."','".$diaChi."','".$token."','".$verifiedEmail."')";
				}else {
					$string="insert into phuhuynh(email,hinhAnh,hoTenPH,soDienThoai,gioiTinh,ngaySinh,diaChi, token, verifiedEmail) values";
                	$string .= "('".$email."','".$hinhAnh."','".$hoTen."','".$soDienThoai."','".$gioiTinh."','".$ngaySinh."','".$diaChi."','".$token."','".$verifiedEmail."')";
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
		#THÊM USERNAME CHO DOANH NGHIỆP CHƯA CÓ TÀI KHOẢN TRÊN BẢNG KHÁCH HÀNG
		public function update_khdn_username($idPhuHuynh,$username){
			
			$p = new  clsketnoi();
			if($p->ketnoiDB($conn)){
					$string ="update khachhang";
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
		#Hiển thị doanh nghiệp theo MAKH
		public function select_doanhnghiep_id($idPhuHuynh){
			
			$p= new  clsketnoi();
			if($p->ketnoiDB($conn)){
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
		#lay email kiem tra
		public function select_doanhnghiep_email_id($email){
			
			$p= new  clsketnoi();
			if($p->ketnoiDB($conn)){
				$string="SELECT username, hoTenPH,email FROM phuhuynh
						WHERE email = '$email' ";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$data = array();
				if(mysqli_num_rows($table)>0){
					$data = array();
       
					while ($row = mysqli_fetch_assoc($table)) {
						$data[] = $row;
					}
				}
        		
				}
				
				// var_dump($table);
				return $data;
		
			
			
		}
		#UPDATE KHACH HANG DOANH NGHIEP
		public function update_KHDN1($idPhuHuynh,$email,$hinhAnh,$hoTen,$ngaySinh,$soDienThoai,$gioiTinh){
			
			$p= new  clsketnoi();
			if($p->ketnoiDB($conn)){
				// if($username !=""){
					$string ="update phuhuynh";
					$string .= " set idPhuHuynh='".$idPhuHuynh."', email='".$email."', hinhAnh='".$hinhAnh."', hoTen='".$hoTen."',ngaySinh='".$ngaySinh."', soDienThoai='".$soDienThoai."', gioiTinh='".$gioiTinh."'";
					$string .= " Where idPhuHuynh='".$idPhuHuynh."'";
				
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;

			}else {
				return false;
			}
		}
		#UPDATE KHACH HANG DOANH NGHIEP CO USERNAME
		public function update_KHDN2($idPhuHuynh,$username){
			
			$p= new clsketnoi();
			if($p->ketnoiDB($conn)){
				
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
           
            $p=new  clsketnoi();
            if($p->ketnoiDB($conn)){
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
	
		
		#XÓA DOANH NGHIỆP
		function del_KHDN($idPhuHuynh){
			
			$p = new  clsketnoi();
			if($p -> ketnoiDB($conn)){
				$string = "Delete FROM phuhuynh where idPhuHuynh='".$idPhuHuynh."'";
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
