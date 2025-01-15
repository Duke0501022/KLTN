<?php
include_once("model/connect.php");
class mGV
{

    function SelectAllGV()
    {
        $p=new ketnoi();
        if($p->moketnoi($conn)){
            $string="SELECT * FROM giaovien";
            $table=mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            return $table;
        }else {
            return false;
        }
    }
    public function count_GV(){
          
        $p=new ketnoi();
        if($p->moketnoi($conn)){
            $string="SELECT count(*) FROM giaovien";
            $table=mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            return $table;
        }else {
            return false;
        }
    }
    public function getUserDataByIds($idGiaoVien) {
        $p = new ketnoi();
        
        if ($p->moketnoi($conn)) {
            $string = "SELECT * FROM giaovien WHERE idGiaoVien = ?";
            $stmt = $conn->prepare($string);
            $stmt->bind_param("i", $idGiaoVien);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Đóng kết nối
            $p->dongketnoi($conn);
            
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Trả về dữ liệu dưới dạng mảng kết hợp
            } else {
                return false; // Không tìm thấy bản ghi
            }
        } else {
            return false; // Kết nối không thành công
        }
    }

    public function search_giaovien($search_query) {
        // Kết nối đến database
        $p = new ketnoi();
        if($p -> moketnoi($conn)){
            $string =  "SELECT * FROM giaovien
            WHERE 
            hoTen LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
            OR email LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%' 
            OR soDienThoai LIKE '%" . mysqli_real_escape_string($conn, $search_query) . "%'
            OR (gioiTinh = " . ($search_query == 'Nam' ? 0 : ($search_query == 'Nữ' ? 1 : -1)) . ")";
            $table = mysqli_query($conn,$string);
            $p -> dongketnoi($conn);
            //
            return $table;
        }else{
            return false;
        }
    }

    public function select_GV_id($idGiaoVien){
       
        $p= new ketnoi();
        if($p->moketnoi($conn)){
            $string="SELECT * FROM giaovien
                    WHERE idGiaoVien ='".$idGiaoVien."'";
            // echo $string;
            $table=mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            // var_dump($table);
            return $table;
                    
        }else{
            return false;
        }
        
    }

    public function add_GV($hoTen, $soDienThoai, $email, $hinhAnh,$gioiTinh,$ngaySinh,$diaChi,$username){
        
        $p = new ketnoi();
        if($p->moketnoi($conn)){
            $string = "INSERT INTO giaovien (hoTen, soDienThoai, email, hinhAnh, gioiTinh, ngaySinh,diaChi, username) VALUES ";
$string .= "('" . $hoTen . "','" . $soDienThoai . "','" . $email . "','" . $hinhAnh . "','" . $gioiTinh . "','" . $ngaySinh . "','" . $diaChi . "','" . $username . "')";
            $table=mysqli_query($conn,$string);
            // echo $string;
            $p->dongketnoi($conn);
            // var_dump ($table);
            return $table;
        }else {
            return false;
        }
    }
   
    

    public function update_GSV($idGiaoVien, $email, $hinhAnh, $hoTen, $soDienThoai, $gioiTinh,$ngaySinh,$diaChi){
			
        $p= new ketnoi();
        if($p->moketnoi($conn)){
            // if($username !=""){
                $string ="update giaovien";
                $string .= " set  email='".$email."', hinhAnh='".$hinhAnh."', hoTen='".$hoTen."', soDienThoai='".$soDienThoai."', gioiTinh='".$gioiTinh."',ngaySinh = '".$ngaySinh."',diaChi='".$diaChi."'";
                $string .= " Where idGiaoVien='".$idGiaoVien."'";
            
            $table =mysqli_query($conn,$string);
            $p->dongketnoi($conn);
            // var_dump($table);
            return $table;

        }else {
            return false;
        }
    }
    function del_GV($idGiaoVien){
        
        $p = new ketnoi();
        if($p -> moketnoi($conn)){
            $string = "Delete FROM giaovien where idGiaoVien='".$idGiaoVien."'";
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