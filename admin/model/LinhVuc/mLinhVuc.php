<?php
    include_once("model/connect.php");

    class mLinhVuc{
        public function count_linhvuc(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT count(*) FROM linhvuc";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
        public function select_linhvuc(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM linhvuc";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
		public function select_tenLinhVuc($tenLinhVuc, $idUnit) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				try {
					// Check if tenLinhVuc exists for the specific idUnit
					$stmt = $conn->prepare("SELECT COUNT(*) as count FROM linhvuc WHERE tenLinhVuc = ? AND idUnit = ?");
					$stmt->bind_param("si", $tenLinhVuc, $idUnit);
					$stmt->execute();
					$result = $stmt->get_result();
					$row = $result->fetch_assoc();
					
					$p->dongketnoi($conn);
					return ($row['count'] > 0);
					
				} catch (Exception $e) {
					$p->dongketnoi($conn);
					return false;
				}
			}
			return false;
		}
        public function select_linhvuc_id($idLinhVuc){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * 
               FROM linhvuc 
               LEFT JOIN unit
                 ON unit.idUnit = linhvuc.idUnit
						WHERE idLinhVuc ='".$idLinhVuc."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
        }
        public function select_tenDanhMuc_ten($tenLinhVuc) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				// Sử dụng prepared statement để tránh SQL Injection
				$stmt = $conn->prepare("SELECT * FROM linhvuc WHERE tenLinhVuc = ?");
				$stmt->bind_param("s", $tenLinhVuc);
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
        #Thêm chatbot
        public function add_linhvuc($tenLinhVuc,$idUnit){
            
            $p=new ketnoi();
            if ($p->moketnoi($conn)){
               
                $string="Insert into linhvuc(tenLinhVuc,idUnit) values";
                $string .="('".$tenLinhVuc."','".$idUnit."')";
                // echo $string;
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else{
                return false;
            }
        }
    
       
        #Cap nhật chatbot
		public function update_linhvuc($idLinhVuc, $tenLinhVuc, $idUnit) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				$string = "UPDATE linhvuc SET tenLinhVuc='$tenLinhVuc', idUnit='$idUnit' WHERE idLinhVuc='$idLinhVuc'";
				// In ra câu lệnh SQL để kiểm tra
				echo $string;
				$table = mysqli_query($conn, $string);
				if (!$table) {
					// In ra lỗi từ MySQL nếu có
					echo "Error: " . mysqli_error($conn);
				}
				$p->dongketnoi($conn);
				return $table;
			} else {
				return false;
			}
		}
        
        #xoa nhân viên phân phối
        function del_linhvuc($idLinhvuc){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM linhvuc where idLinhVuc='".$idLinhvuc."'";
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
       
    // }
?>