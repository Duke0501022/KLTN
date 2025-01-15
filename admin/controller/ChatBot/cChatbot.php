<?php 

	include_once("model/ChatBot/mchatbot.php");

	class cChatbot{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG CAU HOI
        public function count_chatbot(){
            $p = new mChatbot();
            $table = $p -> count_chatbot();
            return $table;
        }
        //
        //------------------------------------------
        #xem câu hỏi
		public function select_chatbot(){
			$p = new mChatbot();
			$table = $p -> select_chatbot();
			return $table;
		}#Hiển thị  câu hỏi theo id
        public function select_chatbot_id($idchatbot){
            $p= new mChatbot();
            $table = $p->select_chatbot_id($idchatbot);
            //  var_dump($table);
            return $table;
        }
       
        
      
        #update câu hỏi
        // 
        // CẬP NHẬT KHÁCH HÀNG KHÔNG USERNAME
        // 
		public function update_chatbot($idChatBot,$query,$answer){
            $p = new mChatbot();
            $update = $p -> update_chatbot($idChatBot,$query,$answer);
            // var_dump($update);
            if($update){
                return 1; //cập nhật thành công
            }else{
                return 0; //cập nhật không thành công
            }
        }
        
        #thêm câu hỏi
        public function add_chatbot($query,$answer){
            $p = new mChatbot();
            $insert = $p->add_chatbot($query,$answer);
            // var_dump($insert);
            if($insert){
                return 1;// thêm thành công
            }else {
                return 0;//thêm không thành công
            }
           
        }
       
        #xóa khách hàng doanh nghiệp
        function del_chatbot($idChatBot){
			$p = new mChatbot();
			$table  = $p -> del_chatbot($idChatBot);
// 			var_dump($table);
			// return $table;
            if($table){
                return 1; //Xóa thành công
            }else {
                return 0;// Xóa không thành công
            }
		}
	}

 ?>