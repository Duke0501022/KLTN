<?php 

	include_once("model/connect.php");

	class mHocPhi{
		//--------------THỐNG KÊ
		//
		#THỐNG KÊ SỐ LƯỢNG CÂU HỎI
		public function count_hocphi(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT count(*) FROM hocphi";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
		public function count_hocphi1($start_date, $end_date) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				$string = "SELECT SUM(soTien) as total FROM thanhtoan 
						   WHERE payment_status = 'Paid' 
						   AND ngayThanhToan BETWEEN '$start_date' AND '$end_date'";
				$table = mysqli_query($conn, $string);
				$p->dongketnoi($conn);
				//
				if ($table) {
					$row = mysqli_fetch_assoc($table);
					return $row['total'];
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	
		//
		//------------------------------------------
		#xem câu hỏi
		public function select_hocphi() {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				$string = "SELECT *
						   FROM hocphi
						   INNER JOIN chitietlophoc ON hocphi.idHoSo = chitietlophoc.idHoSo
						   INNER JOIN hosotreem ON hocphi.idHoSo = hosotreem.idHoSo
						   INNER JOIN lophoc ON chitietlophoc.idLopHoc = lophoc.idLopHoc
						   ORDER BY hocphi.idHocPhi ASC";
				$table = mysqli_query($conn, $string);
				$p->dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
		public function search_hocphi($search_query) {
			// Kết nối đến database
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				$search_query = "%" . $search_query . "%";
				$string = "SELECT * FROM hocphi 
						  INNER JOIN chitietlophoc ON hocphi.idHoSo = chitietlophoc.idHoSo
						   INNER JOIN hosotreem ON hocphi.idHoSo = hosotreem.idHoSo
						   INNER JOIN lophoc ON chitietlophoc.idLopHoc = lophoc.idLopHoc
						   WHERE hoTenTE LIKE ? 
						   OR tenLop LIKE ? 
						   OR namHoc LIKE ?";
				
				$stmt = $conn->prepare($string);
				$stmt->bind_param("sss", $search_query, $search_query, $search_query);
				$stmt->execute();
				$result = $stmt->get_result();
				
				$p->dongketnoi($conn);
				
				return $result;
			} else {
				return false;
			}
		}
        public function select_thanhtoan(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM `thanhtoan`";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				return $table;
			}else{
				return false;
			}
		}
        public function select_lophoc(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM `lophoc`";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				return $table;
			}else{
				return false;
			}
		}
        public function select_hosotre(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM `hosotreem`";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				return $table;
			}else{
				return false;
			}
		}

		function Accepthocphi($idhocphi)
        {
            $p = new ketnoi();
           if ($p->moketnoi($conn)){
            $update = '';
            foreach ($idhocphi as $id) {
                $update .= "UPDATE hocphi SET `status` = 1 WHERE idhocphi = $id; ";
            }
    
            $kq = mysqli_multi_query($conn, $update);
            $p->dongketnoi($conn);
            return $kq;
        }
    }
		function SelectAllCHWait($wait)
		{
			$p = new  ketnoi();
			$connect = $p->moketnoi($conn);
			$tbl ="SELECT * FROM hocphi 
			INNER JOIN unit on hocphi.idUnit = unit.idUnit 
				JOIN linhvuc on hocphi.idLinhVuc = linhvuc.idLinhVuc 
			Where status =$wait  ORDER BY idhocphi ASC";
			$table = mysqli_query($connect, $tbl);
			$list_users = array();
			if (mysqli_num_rows($table) > 0) {
				while ($row = mysqli_fetch_assoc($table)) {
					$list_users[] = $row;
				}
				return $list_users;
			}
			$p->dongketnoi($connect);
		}
		#THÊM CÂU HỎI 
		public function add_hocphi($idHoSo, $soTien, $hocKy, $namHoc,  $moTa, $check_tt) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				// Prepare the SQL query
				$string = "INSERT INTO hocphi (idHoSo, soTien, hocky, namHoc,  moTa, check_tt) VALUES ( ?, ?, ?, ?, ?, ?)";
				
				// Prepare the statement
				$stmt = $conn->prepare($string);
				
				// Bind parameters
				$stmt->bind_param("iisssi", $idHoSo, $soTien, $hocKy, $namHoc, $moTa, $check_tt);
				
				// Execute the statement
				$result = $stmt->execute();
				
				// Close the statement
				$stmt->close();
				
				// Close the connection
				$p->dongketnoi($conn);
				
				return $result;
			} else {
				return false;
			}
		}
        
		
		#Hiển thị câu hỏi theo ID
		public function select_hocphi_id($idHocPhi){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM hocphi
						WHERE idhocphi ='".$idHocPhi."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
		}
		#UPDATE CÂU HỎI
		public function update_hocphi($idHocPhi,$idHoSo,$soTien,$hocKy,$namHoc,$moTa){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				// if($username !=""){
					$string ="update hocphi";
					$string .= " set  idHoSo='".$idHoSo."', soTien='".$soTien."', hocky='".$hocKy."', namHoc='".$namHoc."',moTa= '".$moTa."'";
					$string .= " Where idHocPhi='".$idHocPhi."'";
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;

			}else {
				return false;
			}
		}
		
		#XÓA CAU HỎI
		function del_hocphi($idHocPhi){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM hocphi where idHocPhi ='".$idHocPhi."'";
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