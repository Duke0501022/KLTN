<?php 

	include_once("model/connect.php");

	class mCauHoi{
		//--------------THỐNG KÊ
		//
		#THỐNG KÊ SỐ LƯỢNG CÂU HỎI
		public function count_cauhoi(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT count(*) FROM cauhoi";
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
		#xem câu hỏi
		public function select_cauhoi(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM cauhoi 
				INNER JOIN unit on cauhoi.idUnit = unit.idUnit 
				JOIN linhvuc on cauhoi.idLinhVuc = linhvuc.idLinhVuc 
				order by idCauHoi asc";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
        public function select_unit(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM `unit`";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				return $table;
			}else{
				return false;
			}
		}

		public function select_linhvuc(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM `linhvuc`";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				return $table;
			}else{
				return false;
			}
		}
		public function select_cauhoiwait($wait){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM  cauhoi 
				INNER JOIN unit on cauhoi.idUnit = unit.idUnit 
				JOIN linhvuc on cauhoi.idLinhVuc = linhvuc.idLinhVuc 
				Where status = $wait  ORDER BY idcauHoi ASC";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
		function AcceptCauHoi($idCauHoi)
        {
            $p = new ketnoi();
           if ($p->moketnoi($conn)){
            $update = '';
            foreach ($idCauHoi as $id) {
                $update .= "UPDATE cauhoi SET `status` = 1 WHERE idcauHoi = $id; ";
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
			$tbl ="SELECT * FROM cauhoi 
			INNER JOIN unit on cauhoi.idUnit = unit.idUnit 
				JOIN linhvuc on cauhoi.idLinhVuc = linhvuc.idLinhVuc 
			Where status =$wait  ORDER BY idcauHoi ASC";
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
		public function add_cauhoi($cauHoi,$cau1,$cau2,$cau3,$hinhAnh,$idUnit,$idLinhVuc){
			
			$p = new ketnoi();
			if($p->moketnoi($conn)){
				
					$string="insert into cauhoi(cauHoi,cau1,cau2,cau3,hinhAnh,idUnit,idLinhVuc) values";
                	$string .= "('".$cauHoi."','".$cau1."','".$cau2."','".$cau3."','".$hinhAnh."','".$idUnit."','".$idLinhVuc."')";

                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
				// var_dump($table);
                return $table;
            }else{
                return false;
            }
		}
        
		
		#Hiển thị câu hỏi theo ID
		public function select_cauhoi_id($idcauHoi){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM cauhoi
						WHERE idcauHoi ='".$idcauHoi."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
		}
		public function select_cauhoi_ten($cauHoi) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				// Sử dụng prepared statement để tránh SQL Injection
				$stmt = $conn->prepare("SELECT * FROM cauhoi WHERE cauHoi = ?");
				$stmt->bind_param("s", $cauHoi);
				$stmt->execute();
				$result = $stmt->get_result();
				$p->dongketnoi($conn);
				
				// Kiểm tra xem có bản ghi nào được trả về hay không
				if ($result->num_rows > 0) {
					return true; // Câu hỏi đã tồn tại
				} else {
					return false; // Câu hỏi chưa tồn tại
				}
			} else {
				return false;
			}
		}

		#UPDATE CÂU HỎI
		public function update_cauhoi($idcauHoi,$cauHoi,$cau1,$cau2,$cau3,$hinhAnh,$idUnit,$idLinhVuc){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				// if($username !=""){
					$string ="update cauhoi";
					$string .= " set  cauHoi='".$cauHoi."', cau1='".$cau1."', cau2='".$cau2."', cau3='".$cau3."', hinhAnh='".$hinhAnh."',idUnit='".$idUnit."', idLinhVuc='".$idLinhVuc."'";
					$string .= " Where idcauHoi='".$idcauHoi."'";
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;

			}else {
				return false;
			}
		}
		
		#XÓA CAU HỎI
		function del_cauhoi($idcauHoi){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM cauhoi where idcauHoi ='".$idcauHoi."'";
				// echo $string;
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				// var_dump($table);
				return $table;
			}else{
				return false;
			}
		}
		function del_cauhoiwait($idcauHoi){
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "DELETE FROM cauhoi WHERE idcauHoi='".$idcauHoi."'";
				$table = mysqli_query($conn, $string);
				$p -> dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
	}	
?>