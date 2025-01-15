<?php
    include_once("model/connect.php");

    class mQTV{
        
        public function count_qtgv(){
          
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT count(*) FROM quantrigiaovien";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        public function count_qtcv(){
          
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT count(*) FROM quantrichuyenvien";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
   
        public function select_qtgv(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT *FROM quantrigiaovien";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        public function select_qtcv(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM quantrichuyenvien";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        
        public function select_qtgv_id($idQTGV){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM quantrigiaovien
						WHERE idQTGV ='".$idQTGV."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
        }
        public function select_qtcv_id($idQTCV){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM quantrichuyenvien
						WHERE idQTCV ='".$idQTCV."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
        }
        public function search_qtgiaovien($search_query) {
            // Kết nối đến database
            $p = new ketnoi();
            if($p -> moketnoi($conn)){
                $string =  "SELECT * FROM quantrigiaovien
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
        public function search_qtchuyenvien($search_query) {
            // Kết nối đến database
            $p = new ketnoi();
            if($p -> moketnoi($conn)){
                $string =  "SELECT * FROM quantrichuyenvien
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
   
        public function add_QTGV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$username){
            
            $p = new ketnoi();
            if($p->moketnoi($conn)){
                $string = "INSERT INTO quantrigiaovien (hoTen, soDienThoai, email, hinhAnh,  gioiTinh,  username) VALUES ";
$string .= "('" . $hoTen . "','" . $soDienThoai . "','" . $email . "','" . $hinhAnh . "' ,'" . $gioiTinh . "','" . $username . "')";
                $table=mysqli_query($conn,$string);
                // echo $string;
                $p->dongketnoi($conn);
                // var_dump ($table);
                return $table;
            }else {
                return false;
            }
        }
     
        public function add_QTCV($hoTen, $soDienThoai, $email, $hinhAnh, $gioiTinh, $username) {
            $p = new ketnoi();
            if ($p->moketnoi($conn)) {
                // Kiểm tra sự tồn tại của username trong bảng taikhoan1
                $check_username_query = "SELECT * FROM taikhoan1 WHERE username = '$username'";
                $check_username_result = mysqli_query($conn, $check_username_query);

                if (mysqli_num_rows($check_username_result) == 0) {
                    // Username không tồn tại, trả về thông báo lỗi
                    $p->dongketnoi($conn);
                    return "Username không tồn tại. Vui lòng thêm username vào bảng Tài Khoản trước.";
                }

                if ($username != "") {
                    $string = "INSERT INTO quantrichuyenvien(email, hinhAnh, hoTen, soDienThoai, gioiTinh, username) VALUES";
                    $string .= "('$email', '$hinhAnh', '$hoTen', '$soDienThoai', '$gioiTinh', '$username')";
                } else {
                    $string = "INSERT INTO quantrichuyenvien(email, hinhAnh, hoTen, soDienThoai, gioiTinh) VALUES";
                    $string .= "('$email', '$hinhAnh', '$hoTen', '$soDienThoai', '$gioiTinh')";
                }
                $table = mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            } else {
                return false;
            }
        }
        public function getUserDataByIdQTGV($idQTGV) {
            $p = new ketnoi();
            
            if ($p->moketnoi($conn)) {
                $string = "SELECT * FROM quantrigiaovien WHERE idQTGV = ?";
                $stmt = $conn->prepare($string);
                $stmt->bind_param("i", $idQTGV);
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
        public function getUserDataByIdQTCV($idQTCV) {
            $p = new ketnoi();
            
            if ($p->moketnoi($conn)) {
                $string = "SELECT * FROM quantrichuyenvien WHERE idQTCV = ?";
                $stmt = $conn->prepare($string);
                $stmt->bind_param("i", $idQTCV);
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
       
        public function update_QTGVs($idQTGV, $hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				
					$string ="update quantrigiaovien";
					$string .= " set hoTen='".$hoTen."', soDienThoai='".$soDienThoai."', email='".$email."', hinhAnh='".$hinhAnh."',  gioiTinh='".$gioiTinh."'";
					$string .= " Where idQTGV='".$idQTGV."'";
				
				
				// echo $string;
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				return $table;

			}else {
				return false;
			}
		}
        public function update_QTCVs($idQTCV, $hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh){
			
			$p= new ketnoi();
			if($p->moketnoi($conn)){
				
					$string ="update quantrichuyenvien";
					$string .= " set hoTen='".$hoTen."', soDienThoai='".$soDienThoai."', email='".$email."', hinhAnh='".$hinhAnh."',  gioiTinh='".$gioiTinh."'";
					$string .= " Where idQTCV='".$idQTCV."'";
				
				
				// echo $string;
				$table =mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				return $table;

			}else {
				return false;
			}
		}
        
        function del_QTGV($idQTGV){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM quantrigiaovien where idQTGV='".$idQTGV."'";
				//echo $string;
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//var_dump($table);
				return $table;
			}else{
				return false;
			}
		}
        function del_QTCV($idQTCV){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM quantrichuyenvien where idQTCV='".$idQTCV."'";
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