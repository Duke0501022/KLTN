<?php
include_once("Controller/cTinTuc.php");
$tintuc = new cTinTuc();
$wait=1;
$tinTucList = $tintuc->selectALL($wait);
$danhMucList = $tintuc->getAllDanhMuc();
if (isset($_GET['idDanhMuc'])) {
    $idDanhMuc = $_GET['idDanhMuc'];
    $tinTucList = $tintuc->getTinTucTheoDanhMuc($idDanhMuc);
}
if (isset($_GET['idTinTuc'])) {
    $idTinTuc = $_GET['idTinTuc'];
    $tinTucList = $tintuc->getTinTuc($idTinTuc);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Tin Tức</title>
    <style>
      
        #danhMuc {
            background-color: #f8f9fa;
            padding: 20px;
        }
        #tinTuc {
            padding: 20px;
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
        ul li a {
            text-decoration: none;
            color: #555;
        }
        ul li a:hover {
            color: #007bff;
        }
        #tinTuc h2 {
            margin-top: 20px;
            color: #333;
        }
        #tinTuc p {
            color: #666;
        }
        #tinTuc img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
    
            <div class="col-md-9" id="tinTuc">
                <h1>Tin Tức</h1>
                <?php foreach ($tinTucList as $tinTuc) { ?>
                    <!-- <h2><a href="?idTinTuc=<?php //echo $tinTuc['idTinTuc']; ?>"><?php //echo $tinTuc['tieuDe']; ?></a></h2> -->
                    <h2><a href="View/tintuc/showtintuc.php?idTinTuc=<?php echo $tinTuc['idTinTuc']; ?>"><?php echo $tinTuc['tieuDe']; ?></a></h2>
                    <p><?php echo substr($tinTuc['noiDung'], 0, 100); ?>...</p>
                    <?php 
                    if ($tinTuc['hinhAnh'] == NULL) {
                            echo "<td style='text-align:center'><img src='/assets/uploads/images/user.png' alt='' height='100px' width='150px'></td>";
                          } else {
                            echo "<td style='text-align:center'><img src='admin/admin/assets/uploads/images/" . $tinTuc['hinhAnh'] . "' alt='' height='100px' width='300px' style='border-radius: 10px;'></td>";

                          }
                          ?>
                    <p>Category: <?php echo $tinTuc['tenDanhMuc']; ?></p>
                    <hr>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>