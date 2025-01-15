<?php
    include("controller/CauHoi/cCauHoi.php");
    
        if(isset($_REQUEST['idcauHoi'])){
            $idcauHoi=$_REQUEST['idcauHoi'];
            $p=new cCauHoi();
            $table=$p->del_cauhoi($idcauHoi);
            if($table){
                echo "<script>alert('Xóa thành công');</script>";
                echo "<script>window.location.href='?qlbt'</script>";
            }else {
                echo "<script>alert('Xóa không thành công');</script>";
                echo "<script>window.location.href='?qlbt'</script>";
               
            }
        }
    
        
?>