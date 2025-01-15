
<?php
include_once("Model/mXemLichSu.php");

class cSeeLichSu
{
    public function get_lichsu($idPhuHuynh, $username)
    {
        $mViewLichSu = new mViewLichSu();
        $tbl = $mViewLichSu->view_schedule_su($idPhuHuynh, $username);
        if ($tbl) {
			if ($tbl->num_rows > 0) {
				return $tbl;
			} else {
				return -1; // Không có dữ liệu trong bảng
			}
		} else {
			return false;
		}
    }
}
?>
