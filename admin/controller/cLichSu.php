<?php 

	include_once("model/mLichSu.php");

	class cLichSu{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG KHÁCH HÀNG DOANH NGHIỆP
        public function select_ketqua(){
            $p = new mLichSu();
            $table = $p -> select_ketqua();
            return $table;
        }
        //
        //------------------------------------------
        #xem doanh nghiệp
		
        public function select_ketqua_idPhuHuynh($idPhuHuynh){
            $p= new mLichSu();
            $table = $p->select_ketqua_idPhuHuynh($idPhuHuynh);
            //  var_dump($table);
            return $table;
        }
    }
?>