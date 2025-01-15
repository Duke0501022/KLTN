<?php 
include_once("Model/HocPhi/mHocPhi.php");
class cHP{
    public function kiemTraHocPhi($idHocPhi){
        $info = new mHP();
        $res = $info->kiemTraHocPhi($idHocPhi);
        return $res;
    }
    public function getallHocPhi($idPhuHuynh){
        $info = new mHP();
        $res = $info->selectallHocPhi($idPhuHuynh);
        return $res;
    }

  
    
}