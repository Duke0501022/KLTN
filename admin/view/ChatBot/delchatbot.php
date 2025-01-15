<?php
    include("controller/ChatBot/cChatbot.php");
    
        if(isset($_REQUEST['idChatBot'])){
            $idChatBot=$_REQUEST['idChatBot'];
            $p=new cChatbot();
            $table=$p->del_chatbot($idChatBot);
            if($table){
                echo "<script>alert('Xóa thành công');</script>";
                echo "<script>window.location.href='?chatbot'</script>";
            }else {
                echo "<script>alert('Xóa không thành công');</script>";
                echo "<script>window.location.href='?chatbot'</script>";
               
            }
        }
    
        
?>