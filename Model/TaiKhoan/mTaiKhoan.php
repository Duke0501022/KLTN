<?php

include_once("Model/Connect.php");

class mTaiKhoan
{
	//hàm đăng nhập
	// private $conn;
	//   function __construct()
	//   {
	//       $dbcon = new ketnoi();
	//       $conn = $dbcon->moketnoi($conn);
	//   }
	public function login($username, $password)
	{
		$p = new  clsketnoi();
		if ($p->ketnoiDB($conn)) {
			$sql = "SELECT * FROM taikhoan1 WHERE username = '" . $username . "' and password = '" . $password . "'";
			$result = mysqli_query($conn, $sql);
			$p->dongketnoi($conn);
			return $result;
		} else {
			return false;
		}
	}
	// public function login($username,$password)
	//    {
	//    	var_dump($this->conn);
	//        $sql = mysqli_query($this->conn, "SELECT * FROM taikhoan WHERE username = '".$username."' and password = '".$password."'") or die(mysqli_error($this->conn));
	//        //echo $sele;
	//        return $sql;
	//    }
	//hàm thêm tài khoản 
	public function add_taikhoan($username, $password, $Role)
	{

		$p = new clsketnoi();
		if ($p->ketnoiDB($conn)) {
			$password = md5($password);
			$sql = "INSERT INTO taikhoan1(username, password, Role) VALUES ";
			$sql .= "('" . $username . "','" . $password . "'," . $Role . ")";

			$result = mysqli_query($conn, $sql);
			$p->dongketnoi($conn);
			return $result;
		} else {
			return false;
		}
	}
	//hàm lấy thông tin người dùng đã đăng nhập vào tài khoản
	// public function select_tt_taikhoan($username,$Role){

	// 	$p = new  clsketnoi();
	// 	if($p -> ketnoiDB($conn)){
	// 		if ($Role == 1) {
	// 			$sql = "SELECT * FROM taikhoan1 JOIN admin ON taikhoan1.username = admin.username WHERE taikhoan1.username = '".$username."'";
	// 		}elseif ($Role == 2){
	// 			$sql = "SELECT * FROM taikhoan1 JOIN phuhuynh ON taikhoan1.username = phuhuynh.username WHERE taikhoan1.username = '".$username."'";
	// 		}elseif ($Role == 3){
	// 			$sql = "SELECT * FROM taikhoan1 JOIN chuyenvien ON taikhoan1.username = chuyenvien.username WHERE taikhoan1.username = '".$username."'";
	// 		}elseif ($Role == 4){
	// 			$sql = "SELECT * FROM taikhoan1 JOIN quantrivien ON taikhoan1.username = quantrivien.username WHERE taikhoan1.username = '".$username."'";
	// 		}
	// 		else{
	//             $sql = "SELECT * FROM taikhoan1 WHERE username = '".$username."'";
	//         }
	// 		$result = mysqli_query($conn,$sql);
	// 		$p -> dongketnoi($conn);
	// 		return $result;
	// 	}else{
	// 		return false;
	// 	}
	// }
	// hàm lấy thông tin người dùng đã đăng nhập vào tài khoản (chỉ cho Role = 2)
	public function select_tt_taikhoan($username)
	{
		$p = new clsketnoi();
		if ($p->ketnoiDB($conn)) {
			// Chỉ lấy thông tin cho phụ huynh (Role = 2)
			$sql = "SELECT * FROM taikhoan1 JOIN phuhuynh ON taikhoan1.username = phuhuynh.username WHERE taikhoan1.username = '" . $username . "'";

			$result = mysqli_query($conn, $sql);
			$p->dongketnoi($conn);
			return $result;
		} else {
			return false;
		}
	}


	function ChangePassword($username, $matKhau)
	{
		$p = new  clsketnoi();
		if ($p->ketnoiDB($conn)) {
			$matKhau = md5($matKhau);
			$sql = " UPDATE  taikhoan1 SET password  = '$matKhau' WHERE username = '$username' ";
			$result = mysqli_query($conn, $sql);
			$p->dongketnoi($conn);
			return $result;
		} else {
			return false;
		}
	}
}