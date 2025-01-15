<?php
    include_once("controller/QTV/cQTV.php");
    include_once("controller/TaiKhoan/ctaikhoan.php");
    if(isset($_REQUEST['idQTCV'])&& isset($_REQUEST['username'])){
		$idQTCV = $_REQUEST['idQTCV'];
		$username = $_REQUEST['username'];
		$p = new cQTV();
	    $tk = new ctaikhoan();
		$delete = $p -> del_QTCV($idQTCV);
		if($delete=1){
			$delete= $tk-> delete_taikhoan($username);
			if ($delete=1) {
				echo "<script>alert('Xóa thành công');</script>";
				echo "<script>window.location.href='?qlqtcv'</script>";
			}else{
            	echo "<script>alert('Xóa không thành công');</script>";
            	echo "<script>window.location.href='?qlqtcv'</script>";
			}	
		}
	}

?>