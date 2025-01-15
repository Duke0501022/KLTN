<?php
include_once("Model/Connect.php");
class mTracNghiem
{
    //Hàm lấy idUnit
    public function select_tracnghiem($idUnit)
    {

        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            $string = "SELECT * FROM cauhoi WHERE  idUnit = '$idUnit'";
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            return $table;
        } else {
            return false;
        }
    }

    //  select_questions_by_unit
    public function select_questions_by_unit($idUnit , $wait)
    {
        $p = new clsketnoi();
        if ($p->ketnoiDB($conn)) {
            // Câu truy vấn SELECT với JOIN giữa bảng cauhoi và linhvuc dựa vào idLinhVuc
            $string = "SELECT ch.*, lv.tenLinhVuc
              FROM cauhoi ch
              JOIN linhvuc lv ON ch.idLinhVuc = lv.idLinhVuc
              WHERE ch.idUnit = '$idUnit' and ch.status = $wait
              ORDER BY ch.idLinhVuc";
            // Thực hiện truy vấn
            $table = mysqli_query($conn, $string);
            $p->dongketnoi($conn);

            return $table;
        } else {
            return false;
        }
    }
    function luu_ketqua($noiDungKetQua,$ngayTao, $idTaiKhoan, $idUnit, $diemSo, $username, $idLinhVuc)
    {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn);
        $sql = $sql = "SELECT idPhuHuynh FROM phuhuynh WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $idTaiKhoan = $row['idPhuHuynh'];
            $string = "INSERT INTO ketqua (noiDungKetQua,ngayTao, idPhuHuynh, idUnit, diemSo, idLinhVuc) VALUES ('$noiDungKetQua','$ngayTao', $idTaiKhoan, $idUnit, $diemSo, $idLinhVuc)";
            $kq = mysqli_query($conn, $string);
        }
        if (!$kq) {
            throw new mysqli_sql_exception(mysqli_error($conn));
        }
        $p->dongketnoi($conn);
        return $kq;
    }
    public function getTestUnits()
    {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn);
        $string = "SELECT * FROM unit";
        $result = mysqli_query($conn, $string);
        $p->dongketnoi($conn);
        return $result;
    }
    function luu_ketqua1($noiDungKetQua, $ngayTao, $idTaiKhoan, $idUnit, $diemSo, $idLinhVuc, $totalScoreByField)
{
    $p = new clsketnoi();
    $conn = $p->ketnoiDB($conn);
    $sql = "SELECT idPhuHuynh FROM phuhuynh WHERE idPhuHuynh = '$idTaiKhoan'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $idTaiKhoan = $row['idPhuHuynh'];
        $string = "INSERT INTO ketqua (noiDungKetQua, ngayTao, idPhuHuynh, idUnit, diemSo, idLinhVuc) VALUES ('$noiDungKetQua', '$ngayTao', $idTaiKhoan, $idUnit, $diemSo, $idLinhVuc)";
        $kq = mysqli_query($conn, $string);
        if ($kq) {
            $idKetQua = mysqli_insert_id($conn);
            // Lưu điểm tổng cho từng lĩnh vực
            foreach ($totalScoreByField as $fieldId => $score) {
                $sqlField = "INSERT INTO ketqualinhvuc (idKetQua, idLinhVuc, diemLinhVuc) 
                             VALUES ('$idKetQua', '$fieldId', '$score')";
                $kqField = mysqli_query($conn, $sqlField);
                if ($kqField) {
                    $idKetQuaLV = mysqli_insert_id($conn);
                    // Lưu vào bảng chitietketqua
                    $sqlDetail = "INSERT INTO chitietketqua (idKetQua, idKetQuaLV, idPhuHuynh) 
                                  VALUES ('$idKetQua', '$idKetQuaLV', '$idTaiKhoan')";
                    mysqli_query($conn, $sqlDetail);
                }
            }
        }
    }
    if (!$kq) {
        throw new mysqli_sql_exception(mysqli_error($conn));
    }
    $p->dongketnoi($conn);
    return $kq;
}
}
