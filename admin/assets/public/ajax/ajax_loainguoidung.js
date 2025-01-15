$(document).ready(function(){
  $("#slvaitro").change(function(){
    var l = $("#slvaitro").val();
    //alert(l);
    if(l == 4){
    	var data1 = "<div class='input-group mb-3'><input type='text' class='form-control' name='tendn' placeholder='Tên doanh nghiệp'></div>";
    	var data2 = "<div class='input-group mb-3'><input type='text' class='form-control' name='mst' placeholder='Mã số thuế'></div";
    	var data3 = "<div class='input-group mb-3'><input type='text' class='form-control' name='gioithieu' placeholder='Giới thiệu'></div>";
        $("#themtendn").html(data1);
        $("#themmst").html(data2);
        $("#themgioithieu").html(data3);
    } 
    // else if(l == 3){
    //   var data1 = "<div class='input-group mb-3'><input type='text' class='form-control' name='tenncc' placeholder='Tên nhà cung cấp'></div>";
    //     $("#themtendn").html(data1);
    //     $("#date").hide();
    // }
    else{
        $("#themtendn").html("");
        $("#themmst").html("");
        $("#themgioithieu").html("");
    }
  });
    $("#trolai").click(function(){
  window.history.back();
    });
  })