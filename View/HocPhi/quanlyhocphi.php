<body>
    <div class="container mt-4">
        <h2>Danh sách học phí cần thanh toán</h2>
        <?php
        include_once("Controller/HocPhi/cHocPhi.php");
        $p = new cHP();
        $idPhuHuynh = $_SESSION['idPhuHuynh'];
      
        $hocPhiList = $p->getallHocPhi($idPhuHuynh);
        ?>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Mã học phí</th>
                    <th>Họ Tên Trẻ</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                    <th>Số tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($hocPhiList as $hocPhi): ?>
                <tr>
                    <td><?php echo $hocPhi['idHocPhi']; ?></td>
                    <td><?php echo $hocPhi['hocky']; ?></td>
                    <td><?php echo $hocPhi['hoTenTE'];?></td>
                    <td><?php echo $hocPhi['namHoc']; ?></td>
                    <td><?php echo number_format($hocPhi['soTien']); ?> VNĐ</td>
                    <td>
                        <?php 
                            echo $hocPhi['check_tt'] == '1' 
                                ? '<span class="badge bg-success">Đã thanh toán</span>' 
                                : '<span class="badge bg-danger">Chưa thanh toán</span>'; 
                        ?>
                    </td>
                    <td>
                        <?php if($hocPhi['check_tt'] == 0 ): ?>
                            <a href="View/xulyhocphi.php?idHocPhi=<?php echo $hocPhi['idHocPhi']; ?>&soTien=<?php echo $hocPhi['soTien']; ?>" class="btn btn-primary">
                                Thanh toán
                            </a>
                        <?php else: ?>
                            <span class="text-success">Đã thanh toán</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
