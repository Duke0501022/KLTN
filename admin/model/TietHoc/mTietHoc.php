<?php
include_once("model/connect.php");
class mTH
{

    function SelectAllTH()
    {
        $p = new ketnoi();
        $connect = $p->moketnoi($conn);
        $tbl = "SELECT * FROM tiethoc ";
        $table = mysqli_query($connect, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($connect);
    }
}
?>