<?php
    include_once("controller/QTV/cQTV.php");
    include_once("controller/TaiKhoan/ctaikhoan.php");
    if(isset($_REQUEST['idQTGV'])&& isset($_REQUEST['username'])){
		$idQTCV = $_REQUEST['idQTGV'];
		$username = $_REQUEST['username'];
		$p = new cQTV();
	    $tk = new ctaikhoan();
		$delete = $p -> del_QTGV($idQTGV);
		if($delete=1){
			$delete= $tk-> delete_taikhoan($username);
			if ($delete=1) {
				echo "<script>alert('Xóa thành công');</script>";
				echo "<script>window.location.href='?qlqtgv'</script>";
			}else{
            	echo "<script>alert('Xóa không thành công');</script>";
            	echo "<script>window.location.href='?qlqtgv'</script>";
			}	
		}
	}

?>