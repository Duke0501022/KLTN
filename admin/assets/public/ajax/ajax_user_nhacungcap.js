$(document).ready(function(){
  $("#slvaitro").change(function(){
    var l = $("#slvaitro").val();
    //alert(l);
    if(l == 3){
    	var data1 = "<div class='input-group mb-3'><input type='text' class='form-control' name='tenncc' placeholder='Tên nhà cung cấp'></div>";
    	//var data2 = "";
    	//var data3 = "<div class='input-group mb-3'><input type='text' class='form-control' name='gioithieu' placeholder='Giới thiệu'></div>";
        $("#themtenncc").html(data1);
        //$("#date").hide();
        //$("#div_gioitinh").hide();
        //$("#themmst").html(data2);
        //$("#themgioithieu").html(data3);
    } 
    else{
        $("#themtenncc").html("");
        //$("#themmst").html("");
        //$("#themgioithieu").html("");
    }
  });
    $("#trolai").click(function(){
  window.history.back();
    });
  })