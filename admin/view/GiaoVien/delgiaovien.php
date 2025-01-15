<?php
    include_once("controller/GiaoVien/cGiaoVien.php");
    include_once("controller/TaiKhoan/ctaikhoan.php");
    if(isset($_REQUEST['idGiaoVien'])&& isset($_REQUEST['username'])){
		$idGiaoVien = $_REQUEST['idGiaoVien'];
		$username = $_REQUEST['username'];
		$p = new cGV();
	    $tk = new ctaikhoan();
		$delete = $p -> del_GV($idGiaoVien);
		if($delete=1){
			$delete= $tk-> delete_taikhoan($username);
			if ($delete=1) {
				echo "<script>alert('Xóa thành công');</script>";
				echo "<script>window.location.href='?qlgv'</script>";
			}else{
            	echo "<script>alert('Xóa không thành công');</script>";
            	echo "<script>window.location.href='?qlgv'</script>";
			}	
		}
	}

?>