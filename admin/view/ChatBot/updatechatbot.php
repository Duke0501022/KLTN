<?php
    include("controller/ChatBot/cChatbot.php");
     $idchatbot = $_REQUEST['idChatBot'];


    $p = new cChatbot();
    $table = $p-> select_chatbot_id($idchatbot);
?> 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý CHAT BOT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý Chat Bot</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">


            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Danh sách thông tin khách hàng</h3>  | <a href="#">Thêm khách hàng mới</a> -->

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>-->
              <!-- /.card-header -->
              <h3 style="text-align:center">Cập nhật chat bot</h3>
              <form action="#" method="post">
                <div class="row">
                  <div class="col">
                    <?php
                    // var_dump ($table);
                      if($table){
                        if(mysqli_num_rows($table)>0){
                          while ($row=mysqli_fetch_assoc($table)) {

                             $array = array(
                               "1" => "Admin",
                               "2" => "Phụ Huynh",
                               "3" => "Chuyên Viên",
                               "4" => "Quản trị viên"
                           );
                            
                          //  foreach($array as $key=>$a){
                            // if(in_array($a,$array)){
                              //  if($key != $row['MaVaiTro']){
                                //  echo "<input type='text' name='mavaitro'readonly value='".$key."'>".$a."";
                                // }else{
                                  // echo "<input type='text' name='mavaitro' value='".$row['MaVaiTro']."' checked='checked'>".$a."";
                                // }
                            // }
                          // }	
                        
            
                           
                            echo "<td>ID Chat Bot</td>";
                            echo "<td><input type='text' class='form-control' name='idchatbot'  readonly value='" . $row['idChatBot'] . "'></td>";
                            echo "<td>Câu Hỏi</td>";
                            echo "<td><input type='text' class='form-control' name='query' value='" . $row['query'] . "'></td>";
                            echo "<td>Câu Trả Lời</td>";
                            echo "<td><input type='text' class='form-control' name='answer' value='" . $row['answer'] . "'></td>";
                            
                          }
                        }
                      }
                      
                      
                    ?>
                  <br>
                  </div>
                  
                </div>
                <button type="submit" class="btn btn-primary" name="submit" style="margin-left:45%">Submit</button>
                <button type="reset" class="btn btn-primary" name="reset">Reset</button>
              </form>
             
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  if(isset($_REQUEST["submit"])){
    $idChatBot = $_REQUEST["idchatbot"];
    $answer=$_REQUEST["answer"];
    $query=$_REQUEST["query"];
    // echo $MaVaiTro;

    // var_dump ($password);
    // var_dump ($username);
    $p=new cChatbot();
    $table=$p->update_chatbot($idChatBot,$query,$answer);
    if($table==1){
      echo "<script>alert('Cập nhật thành công')</script>";
      echo "<script>window.location.href= 'index.php?chatbot'</script>";
    }else {
      echo "<script>alert('Cập nhật khong thành công')</script>";
      echo "<script>window.location.href= 'index.php?chatbot'</script>";
    }
  }
?>
  