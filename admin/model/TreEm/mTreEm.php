<?php 

	include_once("model/connect.php");

	class mHoSoTreEM{
		//--------------THỐNG KÊ
		//
		#thống kê số lượng trẻ em
		public function count_te() {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				$string = "SELECT count(*) as total FROM hosotreem";
				$table = mysqli_query($conn, $string);
				
				if (!$table) {
					// Debugging: Check if the query execution failed
					die("Query failed: " . mysqli_error($conn));
				}
		
				$row = mysqli_fetch_assoc($table);
				$p->dongketnoi($conn);
		
				if ($row) {
					return $row['total'];
				} else {
					// Debugging: Check if fetching the result failed
					die("Fetching result failed");
				}
			} else {
				// Debugging: Check if the connection failed
				die("Connection failed");
			}
		}
		//
		//------------------------------------------
		#xem thông tin trẻ em
		public function select_treem(){
			$p = new ketnoi();
			
			if($p -> moketnoi($conn)){
				$string = "SELECT hosotreem.*, phuhuynh.hoTenPh AS hoTenPH 
						   FROM hosotreem 
						   JOIN phuhuynh ON hosotreem.idPhuHuynh = phuhuynh.idPhuHuynh";
				$table = mysqli_query($conn, $string);
				$p -> dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
		public function search_treem($search_query) {
			// Kết nối đến database
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string =  "SELECT hosotreem.*, phuhuynh.hoTenPh AS hoTenPH 
							FROM hosotreem 
							JOIN phuhuynh ON hosotreem.idPhuHuynh = phuhuynh.idPhuHuynh
							WHERE 
							hosotreem.hoTenTE LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
							OR hosotreem.noiDungKetQua LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
							OR hosotreem.thaiKy LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
							OR hosotreem.tinhTrang LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
							OR (hosotreem.gioiTinh = " . ($search_query == 'Nam' ? 0 : ($search_query == 'Nữ' ? 1 : -1)) . ")";
				$table = mysqli_query($conn, $string);
				$p -> dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
		public function select_ph(){
			$p = new ketnoi();
			
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM phuhuynh";
				$table = mysqli_query($conn, $string);
				$p -> dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
		#thêm thông tin trẻ em
		public function add_treem($hoTen, $ngaySinh,$tinhTrang,$idPhuHuynh){
			
			$p = new ketnoi();
			if($p->moketnoi($conn)){
				
				$string = "INSERT INTO hosotreem (hoTenTE, ngaySinh, tinhTrang, idPhuHuynh) VALUES ('$hoTen', '$ngaySinh', '$tinhTrang', '$idPhuHuynh')";
				
                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
				// var_dump($table);
                return $table;
            }else{
                return false;
            }
		}

		public function select_treem_id($idHoSo){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM hosotreem
						WHERE idHoSo ='".$idHoSo."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
		}
		public function update_treem_id($idHoSo, $tinhTrang, $noiDungKetQua){
			$p = new ketnoi();
			if($p->moketnoi($conn)){
				$string = "UPDATE hosotreem SET 
							tinhTrang = '" . mysqli_real_escape_string($conn, $tinhTrang) . "', 
							noiDungKetQua = '" . mysqli_real_escape_string($conn, $noiDungKetQua) . "' 
							WHERE idHoSo = '" . mysqli_real_escape_string($conn, $idHoSo) . "'";
				$table = mysqli_query($conn, $string);
				$p->dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
		
		
		#XÓA TRẺ EM
		function del_HSTE($idHoSo){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM hosotreem where idHoSo ='".$idHoSo."'";
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