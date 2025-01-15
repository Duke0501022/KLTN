<?php 

	include_once("model/connect.php");

	class mLienHe{
		//---------------------------
		//---------------------------
		//---------------------------
		//---------------------------
		//-----LẤY DỮ LIỆU PHẢN HỒI CỦA NGƯỜI DÙNG 
		//---------------------------
		//---------------------------
		//---------------------------
		public function select_lienhe(){
	
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT * FROM lienhe";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
		public function delete_lienhe($idTieuDe){
			$p = new ketnoi();
			if ($p->moketnoi($conn)){
				$string = "DELETE FROM lienhe WHERE idTieuDe = $idTieuDe";
				$result = mysqli_query($conn, $string);
				$p->dongketnoi($conn);
				return $result;
			} else {
				return false;
			}
		}
	
		public function count_lh(){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "SELECT count(*) FROM lienhe";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}
		//---------------------------
		//---------------------------
		//---------------------------
		//---------------------------
		//-----THÊM DỮ LIỆU PHẢN HỒI KHÁCH HÀNG
		//---------------------------
		//---------------------------
		//---------------------------
		public function insert_lienhe($tieude,$noidung,$thoiGian,$nguoiGui,$sodienthoai,$email){
		
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "INSERT INTO lienhe(tieuDe, noiDung, thoiGian, nguoiGui, soDienThoai, email) VALUES ('".$tieude."','".$noidung."','".$thoiGian."','".$nguoiGui."','".$sodienthoai."','".$email."')";
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//
				return $table;
			}else{
				return false;
			}
		}	
		// 
		// 
		// 
		function AcceptPhanHoi($idTieuDe)
	{
		$p = new ketnoi();
	   if ($p->moketnoi($conn)){
		$update = '';
		$update .= "UPDATE lienhe SET `status` = 1 WHERE idTieuDe = $idTieuDe ";
		
		$kq = mysqli_multi_query($conn, $update);
		$p->dongketnoi($conn);
		return $kq;
	}
	}
}	
	


 ?>