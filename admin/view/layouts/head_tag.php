<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Control Panel</title>
  <link rel="icon" type="image/x-icon" href="assets/public/images/iconu.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist1/css/adminlte.min.css">
  <!-- scripts -->
  <!-- jQuery -->
  <script src="assets/plugins/jquery/chart.min.js"></script>
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/public/ajax/ajax_tinh_thanh.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist1/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="assets/dist1/js/demo.js"></script> -->
  <!--  -->
  <script>
    function confirm_delete(){
			var x= confirm("Bạn đã chắc chắn xóa?");
			if(x){
				return true;
			}
			else{
        
				return false;
			}
		}
  </script>
</head>