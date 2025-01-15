<?php
    include_once("controller/HocPhi/cHocPhi.php");
    
    if(isset($_REQUEST['idHocPhi'])){
		$idHocPhi = $_REQUEST['idHocPhi'];
		$p = new cHocPhi();
		$delete = $p ->del_hocphi($idHocPhi);
		if($delete=1){
				echo "<script>alert('Xóa thành công');</script>";
				echo "<script>window.location.href='?qlhocphi'</script>";
			}else{
            	echo "<script>alert('Xóa không thành công');</script>";
            	echo "<script>window.location.href='?qlhocphi'</script>";
			}	
		}
	

?>