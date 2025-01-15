<?php
    include("controller/TaiKhoan/ctaikhoan.php");
    
        if(isset($_REQUEST['username'])){
            $username=$_REQUEST['username'];
            $p=new ctaikhoan();
            $table=$p->delete_taikhoan($username);
            if($table){
                echo "<script>alert('Xóa thành công');</script>";
                echo "<script>window.location.href='?qltk'</script>";
                
            }else {
                echo "<script>alert('Xóa không thành công');</script>";
                echo "<script>window.location.href='?qltk'</script>";
            }
        }
    
        
?>