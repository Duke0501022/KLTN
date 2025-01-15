<?php
    
    include_once("controller/ChuyenVien/cChuyenVien.php");
    include_once("controller/TaiKhoan/ctaikhoan.php");
    if(isset($_REQUEST['MaNVPP'])&& isset($_REQUEST['username'])){
		$MaNVPP = $_REQUEST['MaNVPP'];
		$username = $_REQUEST['username'];
		$p = new cNVPP();
	    $tk = new ctaikhoan();
		$delete = $p -> del_NVPP($idChuyenVien);
		if($delete=1){
			$delete= $tk-> delete_taikhoan($username);
			if ($delete=1) {
				echo "<script>alert('Xóa thành công');</script>";
				echo "<script>window.location.href='?qlnv'</script>";
			}else{
            	echo "<script>alert('Xóa không thành công');</script>";
            	echo "<script>window.location.href='?qlnv'</script>";
			}	
		}
	}
?>