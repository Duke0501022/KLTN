<?php
require './app/Views/inc/HeaderPersonal.php';
?>

<?php
$ngayXemLich = (new DateTime())->format('Y-m-d');

$monday = strtotime('this week monday');
$thu2 = date('d/m/Y', $monday);

$tuesday = strtotime('this week tuesday');
$thu3 = date('d/m/Y', $tuesday);

$thursday = strtotime('this week wednesday');
$thu4 = date('d/m/Y', $thursday);

$thursday = strtotime('this week thursday');
$thu5 = date('d/m/Y', $thursday);

$friday = strtotime('this week friday');
$thu6 = date('d/m/Y', $friday);

$saturday = strtotime('this week saturday');
$thu7 = date('d/m/Y', $saturday);

$sunday = strtotime('this week sunday');
$thu8 = date('d/m/Y', $sunday);
if (!isset($_SESSION['t2'])) {

    $_SESSION['t2'] = $thu2;
    $_SESSION['t3'] = $thu3;
    $_SESSION['t4'] = $thu4;
    $_SESSION['t5'] = $thu5;
    $_SESSION['t6'] = $thu6;
    $_SESSION['t7'] = $thu7;
    $_SESSION['t8'] = $thu8;
}

if (isset($_POST['next'])) {
    $dates = ['t2', 't3', 't4', 't5', 't6', 't7', 't8'];

    foreach ($dates as $date) {
        $dateTime = DateTime::createFromFormat('d/m/Y', $_SESSION[$date]);
        $dateTime->modify('+7 days');
        $_SESSION[$date] = $dateTime->format('d/m/Y');
    }

} elseif (isset($_POST['prev'])) {
    $dates = ['t2', 't3', 't4', 't5', 't6', 't7', 't8'];

    foreach ($dates as $date) {
        $dateTime = DateTime::createFromFormat('d/m/Y', $_SESSION[$date]);
        $dateTime->modify('-7 days');
        $_SESSION[$date] = $dateTime->format('d/m/Y');
    }


} elseif (isset($_POST['current'])) {
    $_SESSION['t2'] = $thu2;
    $_SESSION['t3'] = $thu3;
    $_SESSION['t4'] = $thu4;
    $_SESSION['t5'] = $thu5;
    $_SESSION['t6'] = $thu6;
    $_SESSION['t7'] = $thu7;
    $_SESSION['t8'] = $thu8;
} elseif (isset($_POST['findDate'])) {

    $ngay_dau_tuan = date('Y-m-d', strtotime('monday this week', strtotime($_POST['date'])));
    $ngay_trong_tuan = array();

    $ngay_trong_tuan[] = $ngay_dau_tuan;

    for ($i = 1; $i < 7; $i++) {
        $ngay_trong_tuan[] = date('Y-m-d', strtotime("+$i day", strtotime($ngay_dau_tuan)));
    }


    $_SESSION['t2'] = date('d/m/Y', strtotime($ngay_trong_tuan[0]));
    $_SESSION['t3'] = date('d/m/Y', strtotime($ngay_trong_tuan[1]));
    $_SESSION['t4'] = date('d/m/Y', strtotime($ngay_trong_tuan[2]));
    $_SESSION['t5'] = date('d/m/Y', strtotime($ngay_trong_tuan[3]));
    $_SESSION['t6'] = date('d/m/Y', strtotime($ngay_trong_tuan[4]));
    $_SESSION['t7'] = date('d/m/Y', strtotime($ngay_trong_tuan[5]));
    $_SESSION['t8'] = date('d/m/Y', strtotime($ngay_trong_tuan[6]));
}



$t2 = $_SESSION['t2'];
$t3 = $_SESSION['t3'];
$t4 = $_SESSION['t4'];
$t5 = $_SESSION['t5'];
$t6 = $_SESSION['t6'];
$t7 = $_SESSION['t7'];
$t8 = $_SESSION['t8'];






?>


<main id="main" class="main">

    <div class="container-fluid px-4 calendar">

        <h3>Lịch làm việc</h3><br>

        <form action="" method="post">
            <input type="date" id="selectedDate" class="p-1 rounded-2" name="date" value="<?php if (isset($_POST['findDate'])) {
                echo $_POST['date'];
            } else {
                echo DateTime::createFromFormat('d/m/Y', $_SESSION['t2'])->format('Y-m-d');
                ;
            } ?>" onchange="submitForm()">
            <input type="hidden" name="t2" value="<?php echo $t2 ?>">
            <input type="submit" value="Trở về" id="previousWeekButton" name="prev"
                class="bg-info text-light border-0 rounded" style="padding: 4px 15px;">
            <input type="submit" value="Hiện Tại" id="currentDateButton" name="current"
                class="bg-info text-light border-0 rounded" style="padding: 4px 15px;">
            <input type="submit" value="Tiếp" id="nextWeekButton" name="next"
                class="bg-info text-light border-0 rounded" style="padding: 4px 15px;">




            <input type="submit" value="Tìm" id="findDate" name="findDate" style="display: none;">

            <div style="float: right;">
                <div class="bg-warning" style="display: inline-block; height: 15px; width: 15px;"></div> <span
                    class="text-warning">Đã khám</span><br>
                <div class="bg-secondary" style="display: inline-block; height: 15px; width: 15px;"></div> <span>Chưa
                    khám</span>

            </div>
        </form>

        <div>

        </div>

        <div>
            <table class="calendartable table table-bordered mt-3">
                <tr class="bg-primary border-3">

                    <th class="text-light bg-danger text-center">Thời gian</th>
                    <th class="text-light text-center" id="day">Thứ 2
                        <?php echo $t2; ?>
                    </th>


                    <th class="text-light text-center" id="day">Thứ 3
                        <?php echo $t3; ?>
                    </th>


                    <th class="text-light text-center" id="day">Thứ 4
                        <?php echo $t4; ?>
                    </th>


                    <th class="text-light text-center" id="day">Thứ 5
                        <?php echo $t5; ?>
                    </th>


                    <th class="text-light text-center" id="day">Thứ 6
                        <?php echo $t6; ?>
                    </th>


                    <th class="text-light text-center" id="day">Thứ 7
                        <?php echo $t7; ?>
                    </th>


                    <th class="text-light text-center" id="day">Chủ nhật
                        <?php echo $t8; ?>
                    </th>


                </tr>
                <tr class="border-3">
                    <td class="text-center align-middle bg-warning"><b>Sáng</b></td>
                    <?php for ($i = 2; $i <= 6; $i++) { ?>
                        <td>
                            <?php
                            if (!empty(${"appointment$i"})) {
                                foreach (${"appointment$i"} as $appoint) {

                                    if (strtotime($appoint['hour']) < strtotime('12:00:00')) {

                                        if ($appoint['check'] == 1) {
                                            ?>
                                            <div class="bg-warning  m-1 p-2 rounded-3"
                                                style="min-height: 195px; max-width: 140px; position: relative; overflow: hidden;">
                                                <p class="bg-danger text-light"
                                                    style="position: absolute; transform: rotate(55deg); right:-25px; top: 15px; padding: 0px 20px; font-size:10px">
                                                    Đã khám</p>
                                            <?php } else { ?>
                                                <div class="bg-secondary m-1 p-2 rounded-3" style="min-height: 195px; max-width: 140px;">

                                                <?php } ?>
                                                <h6 class="text-center text-light">
                                                    <?php echo substr($appoint['hour'], 0, 5) ?>
                                                </h6>
                                                <h6>Phòng: A4.<?php echo $_SESSION['is_login']['id_account'] ?></h6>
                                                <p class="text-light" style="font-size: 12px;">Bệnh nhân:
                                                    <?php echo $appoint['fullNamePatient'] ?>
                                                </p>
                                                <p style="font-size: 12px; line-height: 1;">
                                                    <?php echo $appoint['describe_problem'] ?>
                                                </p>
                                                <button type="button" class="btn-danger border-none rounded" data-bs-toggle="modal"
                                                    data-bs-target="#appoint<?php echo $appoint['id_appointment'] ?>"
                                                    style="font-size: 10px;">
                                                    Xem chi tiết
                                                </button>
                                                <div class="modal fade" id="appoint<?php echo $appoint['id_appointment'] ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin chi tiết
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Họ tên</th>
                                                                        <th>Năm sinh</th>
                                                                        <th>giới tính</th>
                                                                        <th>số điện thoại</th>

                                                                    </tr>
                                                                    <tr>
                                                                        <th><?php echo $appoint['fullNamePatient'] ?></th>
                                                                        <th><?php echo $appoint['patientBirthday'] ?></th>
                                                                        <th><?php echo $appoint['genderPatient'] ?></th>
                                                                        <th><?php echo $appoint['patientPhone'] ?></th>



                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($appoint['check'] == 1) {
                                                    ?>
                                                    <a href="<?php echo _WEB_ROOT ?>/Personal/medicalHistoryPatient/<?php echo $appoint['id_patient'] ?>"
                                                        class="text-light border-none rounded" style="font-size: 10px;">
                                                        <button class="btn-light rounded">Phiếu khám</button>
                                                    </a>
                                                <?php } else {
                                                    $specifiedDate = (new DateTime($appoint['date']))->setTime(0, 0, 0);
                                                    $currentDate = (new DateTime())->setTime(0, 0, 0);
                                                    if ($specifiedDate == $currentDate) {
                                                        ?>
                                                        <a href="<?php echo _WEB_ROOT ?>/Personal/medicalBill/<?php echo $appoint['id_appointment'] ?>"
                                                            class="text-light border-none rounded" style="font-size: 10px;">
                                                            <button class="btn-primary rounded"> Lập phiếu khám</button>
                                                        </a>
                                                    <?php }
                                                } ?>
                                            </div>
                                        <?php }
                                }
                            } ?>
                        </td>
                    <?php } ?>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>



                <tr class="border-3">
                    <td class="text-center align-middle bg-warning"><b>Chiều</b></td>
                    <?php
                    for ($i = 2; $i <= 6; $i++) { ?>
                        <td>
                            <?php
                            if (!empty(${"appointment$i"})) {

                                foreach (${"appointment$i"} as $appoint) {
                                    if (strtotime($appoint['hour']) > strtotime('12:00:00')) {
                                        if ($appoint['check'] == 1) {
                                            ?>
                                            <div class="bg-warning  m-1 p-2 rounded-3"
                                                style="min-height: 195px; max-width: 140px; position: relative; overflow: hidden;">
                                                <p class="bg-danger text-light"
                                                    style="position: absolute; transform: rotate(55deg); right:-25px; top: 15px; padding: 0px 20px; font-size:10px">
                                                    Đã khám</p>
                                            <?php } else { ?>
                                                <div class="bg-secondary m-1 p-2 rounded-3" style="min-height: 195px; max-width: 140px;">
                                                <?php } ?>


                                                <h6 class="text-center text-light">
                                                    <?php echo substr($appoint['hour'], 0, 5) ?>
                                                </h6>
                                                <h6>Phòng: A4.<?php echo $_SESSION['is_login']['id_account'] ?>
                                                </h6>
                                                <p class="text-light" style="font-size: 12px;">Bệnh nhân:
                                                    <?php echo $appoint['fullNamePatient'] ?>
                                                </p>
                                                <p style="font-size: 12px; line-height: 1;">
                                                    <?php echo $appoint['describe_problem'] ?>
                                                </p>
                                                <button type="button" class="btn-danger border-none rounded" data-bs-toggle="modal"
                                                    data-bs-target="#appoint<?php echo $appoint['id_appointment'] ?>"
                                                    style="font-size: 10px;">
                                                    Xem chi tiết
                                                </button>
                                                <div class="modal fade" id="appoint<?php echo $appoint['id_appointment'] ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin chi tiết
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Họ tên</th>
                                                                        <th>Năm sinh</th>
                                                                        <th>giới tính</th>
                                                                        <th>số điện thoại</th>

                                                                    </tr>
                                                                    <tr>
                                                                        <th><?php echo $appoint['fullNamePatient'] ?></th>
                                                                        <th><?php echo $appoint['patientBirthday'] ?></th>
                                                                        <th><?php echo $appoint['genderPatient'] ?></th>
                                                                        <th><?php echo $appoint['patientPhone'] ?></th>



                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($appoint['check'] == 1) {
                                                    ?>
                                                    <a href="<?php echo _WEB_ROOT ?>/Personal/medicalHistoryPatient/<?php echo $appoint['id_patient'] ?>"
                                                        class="text-light border-none rounded" style="font-size: 10px;">
                                                        <button class="btn-light rounded">Xem phiếu</button>
                                                    </a>
                                                <?php } else {
                                                    $specifiedDate = (new DateTime($appoint['date']))->setTime(0, 0, 0);
                                                    $currentDate = (new DateTime())->setTime(0, 0, 0);
                                                    if ($specifiedDate == $currentDate) {

                                                        ?>
                                                        <a href="<?php echo _WEB_ROOT ?>/Personal/medicalBill/<?php echo $appoint['id_appointment'] ?>"
                                                            class="text-light border-none rounded" style="font-size: 10px;">
                                                            <button class="btn-primary rounded"> Lập phiếu khám</button>
                                                        </a>
                                                    <?php }
                                                } ?>
                                            </div>
                                        <?php }
                                }
                            } ?>
                        </td>
                    <?php } ?>
                    <td></td>
                    <td></td>
                </tr>
            </table>

        </div>
    </div>
</main>
<?php
require './app/Views/inc/FooterPersonal.php';
?>
<script>
    function submitForm() {
        document.getElementById("findDate").click();
    }
</script>