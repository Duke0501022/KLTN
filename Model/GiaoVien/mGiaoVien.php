<?php
include_once("Model/Connect.php");
class mGiaoVien {
    public function select_giaovien() {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM giaovien ";
            $result = mysqli_query($conn, $string);
            $p->dongketnoi($conn);
            $specialists = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $specialists[] = $row;
            }
            return $specialists;
        } else {
            return false;
        }
    }

 
}
?>