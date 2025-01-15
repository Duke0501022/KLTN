<?php
    include_once("model/connect.php");

    class mChatbot{
        //--------------THỐNG KÊ
        //
        #THỐNG KÊ SỐ LƯỢNG chatbot
        public function count_chatbot(){
          
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT count(*) FROM chatbot";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        //
        //------------------------------------------
        #Hiển thị thông tin chat bot
        public function select_chatbot(){
         
            $p=new ketnoi();
            if($p->moketnoi($conn)){
                $string="SELECT * FROM chatbot";
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }
        #Xem chatbot theo id
        public function select_chatbot_id($idChatBot){
           
            $p= new ketnoi();
			if($p->moketnoi($conn)){
				$string="SELECT * FROM chatbot
						WHERE idChatBot ='".$idChatBot."'";
				// echo $string;
				$table=mysqli_query($conn,$string);
				$p->dongketnoi($conn);
				// var_dump($table);
				return $table;
						
			}else{
				return false;
			}
			
        }
        #Thêm chatbot
        public function add_chatbot($query,$answer){
            
            $p=new ketnoi();
            if ($p->moketnoi($conn)){
               
                $string="Insert into chatbot(query,answer) values";
                $string .="('".$query."','".$answer."')";
                // echo $string;
                $table=mysqli_query($conn,$string);
                $p->dongketnoi($conn);
                return $table;
            }else{
                return false;
            }
        }
       
        #Cap nhật chatbot
        public function update_chatbot($idChatBot,$query,$answer){
			
			$p=new ketnoi();
            if($p->moketnoi($conn)){
                // $password=md5('$password');
                $string="update chatbot";
                $string .=" set query='".$query."',answer='".$answer."'";
                $string .= "where idChatBot='".$idChatBot."'";
                // echo $string;
                $table = mysqli_query($conn, $string);
                $p->dongketnoi($conn);
                return $table;
            }else {
                return false;
            }
        }

        

        #xoa nhân viên phân phối
        function del_chatbot($idChatBot){
			
			$p = new ketnoi();
			if($p -> moketnoi($conn)){
				$string = "Delete FROM chatbot where idChatBot='".$idChatBot."'";
				//echo $string;
				$table = mysqli_query($conn,$string);
				$p -> dongketnoi($conn);
				//var_dump($table);
				return $table;
			}else{
				return false;
			}
		}
    }
?>