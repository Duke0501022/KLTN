<?php
    include_once("model/connect.php");
    class mtaikhoan{
        #hiển thị thông tin tài khoản
        public function select_taikhoan(){
           
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM taikhoan1 order by username desc";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else{
                return false;
            }
        }
        public function select_taikhoan_role($Role){
           
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM taikhoan1 WHERE Role = '".$Role."'";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else{
                return false;
            }
        }
        #THÊM TÀI KHOẢN
        public function addtaikhoan($username,$password,$Role){
            
            $p=new ketnoi();
            if ($p->moketnoi($conn)){
                $password = md5($password);
                $string="Insert into taikhoan1 (username,password,Role) values";
                $string .="('".$username."','".$password."','".$Role."')";
                // echo $string;
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else{
                return false;
            }
        }
        #XEM TÀI KHOẢN THEO USERNAME
        public function select_taikhoan_username($username,$Role){
            
            $p=new ketnoi;
            if ($p->moketnoi($conn)){
                // $string="SELECT *FROM taikhoan WHERE username='".$username."'";
                $string="SELECT * FROM taikhoan1 JOIN role on taikhoan1.Role = role.idRole WHERE taikhoan1.username='".$username."' && role.idRole=".$Role."";
                // echo $string;
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        #XEM TÀI KHOẢN USERNAME THEO KHACH1 HANG
        public function select_taikhoan_usernamedoanhnghiep(){
           
            $p=new ketnoi;
            if ($p->moketnoi($conn)){
                // $string="SELECT *FROM taikhoan WHERE username='".$username."'";
                $string="SELECT * FROM taikhoan1 JOIN phuhuynh on taikhoan1.username = phuhuynh.username WHERE taikhoan1.Role=2";
                // echo $string;
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
  
        public function updatetaikhoan($username,$usernamecu,$password){
           
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                // $password=md5('$password');
                $string="update taikhoan1";
                $string .=" set username='".$username."',password=md5('".$password."')";
                $string .= "where username='".$usernamecu."'";
                // echo $string;
                $table = mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        // 
        //
        #UPDATE MẬT KHẨU CHO TÀI KHOẢN TRÊN BẢNG TÀI KHOẢN
        public function update_matkhau($username,$password){
            
            $p=new ketnoi();
            if ($p->moketnoi($conn)){
                $string="update taikhoan1";
                $string .="  set password=md5('".$password."')";
                $string .= "where username='".$username."'";
                // echo $string;
                $table = mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        

        // KIỂM TRA TRÙNG TÀI KHOẢN KHI ĐĂNG NHẬP
        // 
        // 
        #kiểm tra trùng tài khoản
        public function check_taikhoan($username){
            $p = new ketnoi();
            if($p->moketnoi($conn)){
                $string = "SELECT * FROM taikhoan1 WHERE username = '$username'";
                $table = mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                
                // Thêm dòng debug này
                echo "Số lượng kết quả: " . mysqli_num_rows($table);
                
                return mysqli_num_rows($table) > 0;
            } else {
                return false;
            }
        }
        public function check_user_khachhang($username) {
            $p = new ketnoi();
            if($p->moketnoi($conn)) {
                $tables = ['phuhuynh', 'giaovien', 'chuyenvien', 'quantrigiaovien', 'admin', 'quantrichuyenvien'];
                
                foreach ($tables as $table) {
                    $string = "SELECT * FROM $table WHERE username = '$username'";
                    $result = mysqli_query($conn, $string);
                    
                    if (mysqli_num_rows($result) > 0) {
                        $p->dongketnoi($conn);
                        return $result; // Trả về result object để kiểm tra num_rows
                    }
                }
                
                $p->dongketnoi($conn);
                return $result; // Trả về result cuối cùng (sẽ có num_rows = 0)
            }
            
            return false;
        }
        public function select_check_email($email) {
            $p = new ketnoi();
            if ($p->moketnoi($conn)) {
                $tables = ['phuhuynh', 'giaovien', 'chuyenvien', 'quantrigiaovien', 'quantrichuyenvien'];
                foreach ($tables as $table) {
                    $string = "SELECT * FROM $table WHERE email = '$email'";
                    $result = mysqli_query($conn, $string);
                    if (mysqli_num_rows($result) > 0) {
                        $p->dongketnoi($conn);
                        return true;
                    }
                }
                $p->dongketnoi($conn);
                return false;
            }
            return false;
        }
        public function check_user_chuyenvien($username){
            
            $p= new ketnoi();
            if($p->moketnoi($conn)){
                $string = "SELECT * FROM chuyenvien WHERE username = '$username'";
                // echo $string;
                $table= mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                // var_dump($table);
                return $table;
            }else {
                return false;
            }
        }
        public function check_user_giaovien($username){
            
            $p= new ketnoi();
            if($p->moketnoi($conn)){
                $string = "SELECT * FROM giaovien WHERE username = '$username'";
                // echo $string;
                $table= mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                // var_dump($table);
                return $table;
            }else {
                return false;
            }
        }
        public function check_user_qtchuyenvien($username){
            
            $p= new ketnoi();
            if($p->moketnoi($conn)){
                $string = "SELECT * FROM quantrichuyenvien WHERE username = '$username'";
                // echo $string;
                $table= mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                // var_dump($table);
                return $table;
            }else {
                return false;
            }
        }
        public function check_user_qtgiaovien($username){
            
            $p= new ketnoi();
            if($p->moketnoi($conn)){
                $string = "SELECT * FROM quantrigiaovien WHERE username = '$username'";
                // echo $string;
                $table= mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                // var_dump($table);
                return $table;
            }else {
                return false;
            }
        }
        // 
        // 
        // 
        // 
        #DELETE TAI KHOAN
        public function deletetaikhoan($username){
           
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string = "DELETE FROM taikhoan1 WHERE username ='".$username."'";
                // echo $string;
                $table=mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }

        //LOGIN
        //hàm đăng nhập
        public function login($username, $password){
            
            $p = new ketnoi();
            if($p -> moketnoi($conn)){
                $sql = "SELECT * FROM taikhoan1 WHERE username = '".$username."' and password = '".$password."'";
               
                // echo $sql;
                $result = mysqli_query($conn,$sql);
                $p -> dongketnoi($conn);
                return $result;
            }else{
                return false;
            }
        }
        public function updateStatus($idChuyenVien, $status) {
            $p = new ketnoi();
            $conn = $p->moketnoi($conn);
            if ($conn) {
                $sql = "UPDATE chuyenvien SET statuss = '$status', last_activity = NOW() WHERE idChuyenVien = '$idChuyenVien'";
                $result = mysqli_query($conn, $sql);
                $p->dongketnoi($conn);
                return $result;
            }
            return false;
        }
        //hàm lấy thông tin người dùng đã đăng nhập vào tài khoản
        public function select_tt_taikhoan($username,$Role){
           
            $p = new ketnoi();
            if($p -> moketnoi($conn)){
                if ($Role == 1) {
                    $sql = "SELECT * FROM taikhoan1 JOIN admin ON taikhoan1.username = admin.username WHERE taikhoan1.username = '".$username."'";
                }elseif ($Role == 4){
                    $sql = "SELECT * FROM taikhoan1 JOIN quantrichuyenvien ON taikhoan1.username = quantrichuyenvien.username WHERE taikhoan1.username = '".$username."'";
                }elseif ($Role == 3){
                    $sql = "SELECT * FROM taikhoan1 JOIN chuyenvien ON taikhoan1.username = chuyenvien.username  WHERE taikhoan1.username = '".$username."'";
                }elseif ($Role == 6){
                    $sql = "SELECT * FROM taikhoan1 JOIN quantrigiaovien ON taikhoan1.username = quantrigiaovien.username  WHERE taikhoan1.username = '".$username."'";
                }elseif ($Role == 5){
                    $sql = "SELECT * FROM taikhoan1 JOIN giaovien ON taikhoan1.username = giaovien.username  WHERE taikhoan1.username = '".$username."'";
                }
                $result = mysqli_query($conn,$sql);
                $p -> dongketnoi($conn);
                return $result;
            }else{
                return false;
            }
        }
    }

?>