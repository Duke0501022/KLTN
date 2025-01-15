<?php
include_once("Model/Connect.php");

class mViewLichSu
{
    public function view_schedule_su($idPhuHuynh, $username) {
        $p = new clsketnoi();
        $conn = $p->ketnoiDB($conn);
        if ($conn) {
            if ($idPhuHuynh) {
                $string = "SELECT ketqua.*, phuhuynh.hoTenPH AS hoTen, unit.tenUnit, linhvuc.tenLinhVuc, ketqualinhvuc.diemLinhVuc
                            FROM chitietketqua
                            JOIN phuhuynh ON phuhuynh.idPhuHuynh = chitietketqua.idPhuHuynh
                            LEFT JOIN ketqua ON ketqua.idKetQua  = chitietketqua.idKetQua
                            LEFT JOIN unit ON unit.idUnit = ketqua.idUnit
                            LEFT JOIN ketqualinhvuc ON ketqualinhvuc.idKetQuaLV = chitietketqua.idKetQuaLV
                            LEFT JOIN linhvuc ON linhvuc.idLinhVuc = ketqualinhvuc.idLinhVuc
                            WHERE phuhuynh.idPhuHuynh = ? 
                            GROUP BY ketqua.idKetQua, ketqua.ngayTao, unit.tenUnit, linhvuc.tenLinhVuc";
            } elseif ($username) {
                $string = "SELECT ketqua.*, phuhuynh.hoTenPH AS hoTen, ketqualinhvuc.*, unit.tenUnit, linhvuc.tenLinhVuc
                           FROM ketqua
                           JOIN phuhuynh ON phuhuynh.idPhuHuynh = ketqua.idPhuHuynh
                           LEFT JOIN ketqualinhvuc ON  ketqualinhvuc.idKetQua = ketqua.idKetQua
                           LEFT JOIN unit ON unit.idUnit = ketqua.idUnit
                           LEFT JOIN linhvuc ON linhvuc.idLinhVuc = ketqualinhvuc.idLinhVuc
                           WHERE phuhuynh.username = ?
                           GROUP BY ketqua.idKetQua, ketqua.ngayTao, unit.tenUnit, linhvuc.tenLinhVuc";
            } else {
                $string = "SELECT ketqua.*, phuhuynh.hoTenPH AS hoTen, unit.tenUnit, linhvuc.tenLinhVuc, ketqua.diemSo
                    FROM ketqua
                    JOIN phuhuynh ON phuhuynh.idPhuHuynh = ketqua.idPhuHuynh
                    LEFT JOIN unit ON unit.idUnit = ketqua.idUnit
                    LEFT JOIN linhvuc ON linhvuc.idLinhVuc = ketqua.idLinhVuc
                    GROUP BY ketqua.idKetQua, ketqua.ngayTao, unit.tenUnit, linhvuc.tenLinhVuc";
            }

            $stmt = $conn->prepare($string);
            if ($idPhuHuynh) {
                $stmt->bind_param("i", $idPhuHuynh);
            } elseif ($username) {
                $stmt->bind_param("s", $username);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $p->dongketnoi($conn);

            return $result;
        } else {
            return false;
        }
    }
}
?>