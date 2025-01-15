<?php
    include("controller/TinTuc/cTinTuc.php");
    
        if(isset($_REQUEST['idTinTuc'])){
            $idTinTuc=$_REQUEST['idTinTuc'];
            $p=new cloaibaiviet();
            $table=$p->del_tintuc($idTinTuc);
            if($table){
                echo "<script>alert('Xóa thành công');</script>";
                echo "<script>window.location.href='?qltt'</script>";
            }else {
                echo "<script>alert('Xóa không thành công');</script>";
                echo "<script>window.location.href='?qltt'</script>";
               
            }
        }
    
        
?>