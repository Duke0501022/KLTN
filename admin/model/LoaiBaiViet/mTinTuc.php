<?php
    include_once("model/connect.php");

    class mloaibaiviet{
        public function count_tt(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT count(*) FROM tintuc";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
        public function select_tintuc(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM tintuc";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        public function select_tintuc_id($idTinTuc){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT tt.*, dm.tenDanhMuc, dm.idDanhMuc 
               FROM tintuc tt
               LEFT JOIN danhmuctintuc dm ON tt.idDanhMuc = dm.idDanhMuc
						WHERE idTinTuc ='".$idTinTuc."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
        }
        public function select_tieude_ten($tieuDe) {
			$p = new ketnoi();
			if ($p->moketnoi($conn)) {
				// Sử dụng prepared statement để tránh SQL Injection
				$stmt = $conn->prepare("SELECT * FROM tintuc WHERE tieuDe = ?");
				$stmt->bind_param("s", $tieuDe);
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
        public function select_tintucwait($wait){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM tintuc Where status =$wait  ORDER BY idTinTuc ASC";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        public function select_danhmuc(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM `danhmuctintuc`";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				return $table;
			}else{
				return false;
			}
		}
        #Thêm chatbot
        public function add_tintuc($tieuDe,$noiDung,$hinhAnh,$danhMuc){
            
            $p=new ketnoi();
            if ($p->moketnoi($conn)){
               
                $string="Insert into tintuc(tieuDe,noiDung,hinhAnh,idDanhMuc) values";
                $string .="('".$tieuDe."','".$noiDung."','".$hinhAnh."','".$danhMuc."')";
                // echo $string;
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else{
                return false;
            }
        }
        function AcceptDish($idTinTuc)
        {
            $p = new ketnoi();
           if ($p->moketnoi($conn)){
            $update = '';
            foreach ($idTinTuc as $id) {
                $update .= "UPDATE tintuc SET `status` = 1 WHERE idTinTuc = $id; ";
            }
    
            $kq = mysqli_multi_query($conn, $update);
            $p->dongketnoi($conn);
            return $kq;
        }
    }
    function SelectAllDishWait($wait)
    {
        $p = new  ketnoi();
        $connect = $p->moketnoi($conn);
        $tbl ="SELECT * FROM tintuc Where status =$wait  ORDER BY idTinTuc ASC";
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
       
        #Cap nhật chatbot
        public function update_tintuc($idTinTuc,$tieuDe,$noiDung,$hinhAnh,$danhMuc){
			
			$p=new ketnoi();
            if($p->moketnoi($conn)){
                // $password=md5('$password');
                $string="update tintuc";
                $string .=" set tieuDe='".$tieuDe."', noiDung='".$noiDung."', hinhAnh ='".$hinhAnh."',idDanhMuc='".$danhMuc."'";
                $string .= "where idTinTuc='".$idTinTuc."'";
                // echo $string;
                $table = mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        public function Deletetemporary_tintuc($idTinTuc){
			
			$p=new ketnoi();
            if($p->moketnoi($conn)){
                // $password=md5('$password');
                $string="update tintuc";
                $string .=" set hoatdong = 0 ";
                $string .= "where idTinTuc='".$idTinTuc."'";
                // echo $string;
                $table = mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }

        

        #xoa nhân viên phân phối
        function del_tintuc($idTinTuc){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM tintuc where idTinTuc='".$idTinTuc."'";
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