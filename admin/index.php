<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['login_admin']) || !$_SESSION['login_admin']) {
    include("login.php");
    exit();
}
include_once("view/layouts/header.php");

if ($_SESSION['Role'] == 1) {
    include("view/layouts/slidebar.php");
    if (isset($_REQUEST["qlqtcv"])) {
        include("view/QTV/quanliqtcv.php");
    } else if (isset($_REQUEST["thongtin"])) {
        include("view/vProfile.php");
    } else if (isset($_REQUEST["addqtcv"])) {
        include("view/QTV/addqtchuyenvien.php");
    } else if (isset($_REQUEST["updateqtcv"])) {
        include("view/QTV/updateqtcv.php");
    } else if (isset($_REQUEST["delqtcv"])) {
        include("view/QTV/delqtchuyenvien.php");
    } else if (isset($_REQUEST["addqtgv"])) {
        include("view/QTV/addqtgiaovien.php");
    } else if (isset($_REQUEST["updateqtgv"])) {
        include("view/QTV/updateqtgv.php");
    } else if (isset($_REQUEST["delqtgv"])) {
        include("view/QTV/delqtgiaovien.php");
    }  else if (isset($_REQUEST["chatbot"])) {
        include("view/ChatBot/quanlichatbot.php");
    } else if (isset($_REQUEST["addcb"])) {
        include("view/ChatBot/addchatbot.php");
    } else if (isset($_REQUEST["updatecb"])) {
        include("view/ChatBot/updatechatbot.php");
    } else if (isset($_REQUEST["delcb"])) {
        include("view/ChatBot/delchatbot.php");
    } else if (isset($_REQUEST["qltk"])) {
        include("view/TaiKhoan/quanlitaikhoan.php");
    } else if (isset($_REQUEST["addtk"])) {
        include("view/TaiKhoan/addtaikhoan.php");
    } else if (isset($_REQUEST["updatetk"])) {
        include("view/TaiKhoan/updatetaikhoan.php");
    } else if (isset($_REQUEST["deletetk"])) {
        include("view/TaiKhoan/deletetaikhoan.php");
    } else if (isset($_REQUEST["qlqtgv"])) {
        include("view/QTV/quanliqtgv.php");
    }
     else {
        include("view/pagelog.php");
    }
    
    #CHUYENVIEN
} else if ($_SESSION['Role'] == 3) {
    include_once("view/layouts/slidebarcv.php");
    if (isset($_REQUEST["thongtin"])) {
        include("view/vProfile.php");
    } else if (isset($_REQUEST["tuvan"])) {
        include_once("view/dsPhuHuynh.php");
    } else if (isset($_REQUEST["tuvankh"])) {
        include_once("view/vTuVan.php");
    } else if (isset($_REQUEST["dstest"])) {
        include_once("view/vLichSu.php");    
    } else if (isset($_REQUEST["qlbt"])) {
        include("view/CauHoi/quanlicauhoi.php");
    } else if (isset($_REQUEST["addcauhoi"])) {
        include("view/CauHoi/addcauhoi.php");
    } else if (isset($_REQUEST["qltt"])) {
        include("view/TinTuc/quanlitintuc.php");
    } else if (isset($_REQUEST["addtt"])) {
        include("view/TinTuc/addtintuc.php");
    }else if (isset($_REQUEST["lichtuvan"])) {
        include("view/ChuyenVien/tuvan.php");
    }else if (isset($_REQUEST["TempCancel"])) {
        include("view/LSTV/TempCancel.php");
    }else if (isset($_REQUEST["HoSoTV"])) {
        include("view/ChuyenVien/hoSoTuVan.php");
    }else if (isset($_REQUEST["hoso"])) {
        include("view/ChuyenVien/danhsachHoSo.php");
    }
     else {
        include("view/pagelog.php");
    }
    #QTV CHUYEN VIEN
} else if ($_SESSION['Role'] == 4) {
    include_once("view/layouts/slidebarqtvcv.php");
    if (isset($_REQUEST["thongtin"])) {
        include("view/vProfile.php");
    } else if (isset($_REQUEST["qltt"])) {
        include("view/TinTuc/quanlitintuc.php");
    } else if (isset($_REQUEST["addtt"])) {
        include("view/TinTuc/addtintuc.php");
    } else if (isset($_REQUEST["updatett"])) {
        include("view/TinTuc/updatetintuc.php");
    } else if (isset($_REQUEST["deltintuc"])) {
        include("view/TinTuc/deltintuc.php");
    } else if (isset($_REQUEST["duyett"])) {
        include("view/TinTuc/duyettin.php");
    } else if (isset($_REQUEST["phanhoi"])) {
        include("view/vPhanHoi.php");
    } else if (isset($_REQUEST["tinhluong"])) {
        include("view/Luong/tinhLuong.php");
    } else if (isset($_REQUEST["qlcv"])) {
        include("view/ChuyenVien/quanlinhanvien.php");
    } else if (isset($_REQUEST["addnv"])) {
        include("view/ChuyenVien/addnhanvien.php");
    } else if (isset($_REQUEST["updatenv"])) {
        include("view/ChuyenVien/updatenv.php");
    } else if (isset($_REQUEST["delnvpp"])) {
        include("view/ChuyenVien/delnhanvien.php");
    } else if (isset($_REQUEST["qltv"])) {
        include("view/LSTV/qltuvan.php");
    }else if (isset($_REQUEST["DeleteDL"])) {
        include("view/LSTV/delTuVan.php");
    }else if (isset($_REQUEST["duyetuvan"])) {
        include("view/LSTV/duyetCancel.php");
    }else if (isset($_REQUEST["uptuvan"])) {
        include("view/LSTV/DontAccept.php");
    }else if (isset($_REQUEST["hosoQTV"])) {
        include("view/LSTV/HoSoQTV.php");
    }else if (isset($_REQUEST["delHS"])) {
        include("view/LSTV/delHoSo.php");
    }
     else {
        include_once("view/thongke/content1.php");
    }
    #GIAOVIEN
} else if ($_SESSION['Role'] == 5) {
    include_once("view/layouts/slidebargv.php");
    if (isset($_REQUEST["dstest"])) {
        include_once("view/vLichSu.php"); 
    } else if (isset($_REQUEST["xemlichday"])) {
        include("view/GiaoVien/xemlichday.php");
    } else if (isset($_REQUEST["thongtin"])) {
        include("view/vProfile.php");
    } else if (isset($_REQUEST["xemlop"])) {
        include("view/LopHoc/xemlop.php");
    } else if (isset($_REQUEST["addcauhoi"])) {
        include("view/CauHoi/addcauhoi.php");
    }else if (isset($_REQUEST["updateStudent"])) {
        include("view/LopHoc/update_tt.php");
    }
    else {
        include("view/pagelog.php");
    }
    #QTV GIAOVIEN
} else if ($_SESSION['Role'] == 6) {
    include_once("view/layouts/slidebarqtgv.php");
    if (isset($_REQUEST["thongtin"])) {
        include("view/vProfile.php");
    } #QUAN LÍ TRẺ
    else if (isset($_REQUEST["qlte"])) {
        include("view/TreEM/quanlyhosotreem.php");
    } else if (isset($_REQUEST["addtreem"])) {
        include("view/TreEM/addTreEm.php");
    } else if (isset($_REQUEST["deltreem"])) {
        include("view/TreEM/delTreEm.php");
    } else if (isset($_REQUEST["qlluong"])) {
        include("view/Luong/listLuong.php");
    } #QUAN LÍ LỚP HỌC
    else if (isset($_REQUEST["qllop"])) {
        include("view/LopHoc/quanliLop.php");
    } else if (isset($_REQUEST["addlop"])) {
        include("view/LopHoc/addLop.php");
    } else if (isset($_REQUEST["dellop"])) {
        include("view/LopHoc/delLop.php");
    } else if (isset($_REQUEST["upLop"])) {
        include("view/LopHoc/updateLop.php");
        #QUẢN LÍ LỊCH DẠY
    } else if (isset($_REQUEST["qlgd"])) {
        include("view/LichDay/quanlilichday.php");
    } else if (isset($_REQUEST["addgd"])) {
        include("view/LichDay/addlichday.php");
    }else if (isset($_REQUEST["UpdateStatus"])) {
        include("view/LichDay/update_status.php");
    } else if (isset($_REQUEST["DeleteDishMenu"])) {
        include("view/LichDay/delLich.php");
        #QUẢN LÍ PHỤ HUYNH
    } else if (isset($_REQUEST["qlkhdn"])) {
        include("view/PhuHuynh/quanliph.php");
    } else if (isset($_REQUEST["adddn"])) {
        include("view/PhuHuynh/addphuhuynh.php");
    } else if (isset($_REQUEST["delkh"])) {
        include("view/PhuHuynh/delphuhuynh.php");
    } else if (isset($_REQUEST["updatekh"])) {
        include("view/PhuHuynh/updateph.php");
    } # QUẢN LÝ GIÁO VIÊN
    else if (isset($_REQUEST["qlgv"])) {
        include("view/GiaoVien/quanligv.php");
    } else if (isset($_REQUEST["addgv"])) {
        include("view/GiaoVien/addgiaovien.php");
    } else if (isset($_REQUEST["delgv"])) {
        include("view/GiaoVien/delgiaovien.php");
    } else if (isset($_REQUEST["updategv"])) {
        include("view/GiaoVien/updategv.php");
    } else if (isset($_REQUEST["qlbt"])) {
        include("view/CauHoi/quanlicauhoi.php");
    } else if (isset($_REQUEST["addcauhoi"])) {
        include("view/CauHoi/addcauhoi.php");
    } else if (isset($_REQUEST["updatecauhoi"])) {
        include("view/CauHoi/updatecauhoi.php");
    } else if (isset($_REQUEST["delch"])) {
        include("view/CauHoi/delcauhoi.php"); 
    } else if (isset($_REQUEST["duyetcauhoi"])) {
        include("view/CauHoi/duyetcauhoi.php");
        #QUẢN LÝ HỌC PHÍ
    } else if (isset($_REQUEST["qlhocphi"])) {
        include("view/HocPhi/quanlyhocphi.php");
    }else if (isset($_REQUEST["addhocphi"])) {
        include("view/HocPhi/addhocphi.php");
    }else if (isset($_REQUEST["uphocphi"])) {
        include("view/HocPhi/uphocphi.php");
    }else if (isset($_REQUEST["delhocphi"])) {
        include("view/HocPhi/delhocphi.php");
        #QUẢN LÝ LV
    }else if (isset($_REQUEST["qllinhvuc"])) {
            include("view/LinhVuc/quanlylinhvuc.php");
        }else if (isset($_REQUEST["addlv"])) {
            include("view/LinhVuc/addlv.php");
        }else if (isset($_REQUEST["uplv"])) {
            include("view/LinhVuc/uplinhvuc.php");
        }else if (isset($_REQUEST["dellv"])) {
            include("view/LinhVuc/dellinhvuc.php");
        }
     else {
        include("view/thongke/content.php");
    }
}

include_once("view/layouts/footer.php");
?>