<?php 
require_once(__DIR__ . "/../../Model/PDFDK/mPDFDK.php");

class cLSTV1 {
   
    public function getAppointmentById($id_datlich,$idPhuHuynh) {
        $info = new mLSTV1();
        $res = $info->selectAppointmentById($id_datlich,$idPhuHuynh);
        return $res;
    }
   
}
?>