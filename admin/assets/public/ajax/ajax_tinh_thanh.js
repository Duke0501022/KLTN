$(document).ready(function(){
	$("#tinh").change(function(){
		var id = $("#tinh").val();
		//alert(id);
		$.post("view/process_ajax/huyen.php", {tinh: id}, function(data){
			$("#huyen").html(data);
			//alert("Data: " + data);
		})
	})
	$("#huyen").change(function(){
		var id1 = $("#huyen").val();
		$.post("view/process_ajax/xa.php", {huyen: id1}, function(data){
			$("#xa").html(data);
		})
	})
})