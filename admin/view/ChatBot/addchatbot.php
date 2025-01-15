<?php
  include_once("controller/ChatBot/cChatbot.php");
  
  $p =new cChatbot();
  $list_loai  = $p->select_chatbot();
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
              <li class="breadcrumb-item active">Quản lý chat bot</li>
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
              <h3 style="text-align:center">Thêm Chat Bot</h3>
              <form action="#" method='post'>
                <div class="row">
                  <div class="col-md-4">
                    <td>Câu Hỏi </td>
                    <input type="text" class="form-control" id="cauhoi" placeholder="Nhập Câu Hỏi" name="cauhoi"  required=""></br>
                    
                    <td>Trả Lời</td>
                    <input type="text" class="form-control" id="cau1" placeholder="Nhập câu trả lời" name="cau1"  required="">
                    <span id="cau1" style="color:red;"></span></br>
                    
                </tr>

                    
                  </div>
                  
                  
                </div>
                <button type="submit" id="button" class="btn btn-primary" name="submit" style="margin-left:45%">Thêm chatbot</button>
                <!-- <button type="submit" class="btn btn-primary" name="reset" >Reset</button> -->
                <!-- <input type="submit" value="Thêm Doanh Nghiệp" style="text-align:center"> -->
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
      $query=$_REQUEST["cauhoi"];
      $answer=$_REQUEST["cau1"];
    

      $p= new cChatbot();
        $insert=$p->add_chatbot($query,$answer);
        if ($insert ==1){
            echo "<script>alert('Thêm thành công');</script>";
            echo "<script>window.location.href='?chatbot'</script>";
          }else {
            echo "<script>alert('Thêm không thành công');</script>";
            echo "<script>window.location.href='?chatbot'</script>";
        }
      }

    
      
    
  ?>