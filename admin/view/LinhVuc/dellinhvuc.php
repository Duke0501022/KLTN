<?php
    include_once("controller/LinhVuc/cLinhVuc.php");
    
    if(isset($_REQUEST['idLinhVuc'])){
		$idLinhVuc = $_REQUEST['idLinhVuc'];
		$p = new cLinhVuc();
		$delete = $p ->del_LinhVuc($idLinhVuc);
		if($delete=1){
				echo "<script>alert('Xóa thành công');</script>";
				echo "<script>window.location.href='?qllinhvuc'</script>";
			}else{
            	echo "<script>alert('Xóa không thành công');</script>";
            	echo "<script>window.location.href='?qllinhvuc'</script>";
			}	
		}
	

?>