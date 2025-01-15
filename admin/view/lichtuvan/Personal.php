<?php

class Personal extends Controller
{

    private $model;

    private $data = [];



    public function __construct()
    {
        $this->model = $this->model('PersonalModel');
    }

    function index()
    {
        $id_account = $_SESSION['is_login']['id_account'];

        if (isset($_POST['btn_save'])) {
            $this->data['error']['email'] = $this->checkEmail();
            $this->data['error']['fullname'] = $this->checkFullName();
            $this->data['error']['phone'] = $this->checkPhone();
            $this->data['error']['birthday'] = $this->checkBorn();
            $listUserPatient = $this->model->getListTable('patient', "WHERE id_patient != $id_account");
            $listStaff = $this->model->getListTable('staff', "WHERE id_staff != $id_account");

            foreach (array_merge($listUserPatient, $listStaff) as $user) {
                if ($user['email'] == $_POST['email']) {
                    $this->data['error']['email'] = 'Email đã được sử dụng';
                }
                if ($user['phone'] == $_POST['phone']) {
                    $this->data['error']['phone'] = 'Số điện thoại đã được sử dụng';
                }
            }

            foreach ($this->data['error'] as $key => $value) {
                if ($value == '') {
                    unset($this->data['error'][$key]);
                }
            }
            if (empty($this->data['error'])) {
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $birthday = $_POST['birthday'];


                $dataUpdate = [
                    'full_name' => "$fullname",
                    'email' => "$email",
                    'phone' => "$phone",
                    'birthday' => $birthday,

                ];

                if (!empty($_FILES['file']['name'])) {
                    $image = $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], "public/img/users/" . $image);
                    $dataUpdate['image'] = $image;
                }

                if ($_SESSION['is_login']['id_role'] == 5) {
                    $result = $this->model->updateData('patient', $dataUpdate, "id_patient = $id_account");
                } else {
                    $result = $this->model->updateData('staff', $dataUpdate, "id_staff = $id_account");

                }
                if ($result) {
                    echo "<script>alert('Cập nhật thành công tài khoản! Vui lòng đăng nhập lại')</script>";
                    $redirectUrl = _WEB_ROOT . "/account/logout";
                    header("refresh:0; url=$redirectUrl");
                }

            }

        }
        if (isset($_POST['btn_updatePass'])) {
            $this->data['error']['password'] = $this->checkPassword();
            $this->data['error']['confirm_password'] = $this->confirmPassword();
            if ($_POST['password'] != $_POST['confirm_password']) {
                $this->data['error']['confirm_password'] = 'Mật khẩu bạn nhập lại không khớp';
            }
            if (!empty($_POST['passwordCurrent'])) {
                if (md5($_POST['passwordCurrent']) != $_SESSION['is_login']['password']) {
                    $this->data['error']['passwordCurrent'] = 'Mật khẩu hiện tại sai';
                }
            } else {
                $this->data['error']['passwordCurrent'] = 'Chưa nhập mật khẩu';

            }

            if (empty($this->data['error']['confirm_password']) && empty($this->data['error']['passwordCurrent'])) {
                $password = $_POST['password'];

                $updatePass = [
                    'password' => md5($password),
                ];

                if ($_SESSION['is_login']['id_role'] == 5) {
                    $result = $this->model->updateData('patient', $updatePass, "id_patient = $id_account");
                } else {
                    $result = $this->model->updateData('staff', $updatePass, "id_staff = $id_account");

                }
                if ($result) {
                    echo "<script>alert('Cập nhật thành công tài khoản! Vui lòng đăng nhập lại')</script>";
                    $redirectUrl = _WEB_ROOT . "/account/logout";
                    header("refresh:0; url=$redirectUrl");
                }
            }

        }


        $this->view("Personal/Profile", $this->data);
    }

    function profile()
    {
        $this->index();

    }

    function medicalBill($id_appointment)
    {
        $this->data['id_appointment'] = $id_appointment;
        $this->data['medicine'] = $this->model->getListTable('medicine');
        $this->data['patient'] = $this->model->getListAppointment("WHERE appointment.id_appointment = $id_appointment");

        $this->view("Personal/MedicalBill", $this->data);
    }

    function prescription($id_appointment)
    {
        $this->data['id_appointment'] = $id_appointment;
        $id = $id_appointment;
        ;
        $array_medicine = array();
        if (isset($_POST['btn_sub'])) {
            for ($i = 1; $i < 100; $i++) {
                if (isset($_POST["tenthuoc$i"])) {
                    $name_medicine = $_POST["tenthuoc$i"];
                    $array_medicine[$i] = $this->model->getListTable('medicine', "WHERE name_medicine = '$name_medicine'");


                }
            }

            $thuocArray = [];
            $i = 1;
            while (isset($_POST['tenthuoc' . $i])) {
                $thuoc = [
                    'tenthuoc' => $_POST['tenthuoc' . $i],
                    'soluong' => $_POST['soluong' . $i],
                    'dvt' => $_POST['dvt' . $i],
                    'cd' => $_POST['cd' . $i]
                ];
                $thuocArray[] = $thuoc;
                $i++;
            }


            $count = 1;

            $medical_bill_detail = [];
            foreach ($thuocArray as $value) {
                $medical_bill_detail[] = [
                    'id_medicine' => $array_medicine[$count][0]['id_medicine'],
                    'quantity' => $value['soluong'],
                    'instructions' => $value['cd']
                ];
                $count++;
            }



            $advice = $_POST['advice'];
            $diagnose = $_POST['diagnose'];


            $updates = [
                'check' => 1,
            ];

            $reusult = $this->model->insertMedicalBill($advice, $diagnose, $id_appointment, $medical_bill_detail);
            if ($reusult) {

                $this->model->updateData('appointment', $updates, "id_appointment = $id_appointment");
                $redirectUrl = _WEB_ROOT . "/Personal/workCalendar";
                header("refresh:0; url=$redirectUrl");
            }


        }


        $this->view("Personal/Prescription", $this->data);
    }

    function workCalendar()
    {
        $redirectUrl = _WEB_ROOT . "/Personal/workCalendar";

        if (isset($_SESSION['t2'])) {
            $t2 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t2'])));
            $t3 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t3'])));
            $t4 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t4'])));
            $t5 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t5'])));
            $t6 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t6'])));

            if (isset($_POST['prev'])) {

                header("refresh:0; url=$redirectUrl");
            } else if (isset($_POST['next'])) {
                header("refresh:0; url=$redirectUrl");
            } else if (isset($_POST['current'])) {
                header("refresh:0; url=$redirectUrl");
            }

            $id_staff = $_SESSION['is_login']['id_account'];

            $this->data['appointment2'] = $this->model->getListAppointment("WHERE staff.id_staff = $id_staff AND appointment.date='$t2' ORDER BY appointment.hour");
            $this->data['appointment3'] = $this->model->getListAppointment("WHERE staff.id_staff = $id_staff AND appointment.date='$t3' ORDER BY appointment.hour");
            $this->data['appointment4'] = $this->model->getListAppointment("WHERE staff.id_staff = $id_staff AND appointment.date='$t4' ORDER BY appointment.hour");
            $this->data['appointment5'] = $this->model->getListAppointment("WHERE staff.id_staff = $id_staff AND appointment.date='$t5' ORDER BY appointment.hour");
            $this->data['appointment6'] = $this->model->getListAppointment("WHERE staff.id_staff = $id_staff AND appointment.date='$t6' ORDER BY appointment.hour");


        } else {
            header("refresh:0; url=$redirectUrl");

        }
        $this->view("Personal/WorkCalendar", $this->data);
    }

    public function medicalHistory()
    {
        $id_patient = $_SESSION['is_login']['id_account'];

        $this->data['medicalHistory'] = $this->model->getListFromThreeTables('staff', 'appointment', 'medical_bill', 'id_staff', 'id_staff', 'id_appointment', 'id_appointment', "where appointment.id_patient=$id_patient ORDER BY date");
        $this->data['title'] = "Lịch sử khám bệnh";
        $this->view("Personal/Medicalhistory", $this->data);

    }

    public function medicalHistoryPatient($id_patient)
    {

        $this->data['medicalHistory'] = $this->model->getListFromThreeTables('staff', 'appointment', 'medical_bill', 'id_staff', 'id_staff', 'id_appointment', 'id_appointment', "where appointment.id_patient=$id_patient ORDER BY date");
        $this->data['title'] = "Lịch sử khám bệnh";
        $this->view("Personal/Medicalhistory", $this->data);

    }

    function medicalBillPDF($id_record)
    {
        $this->data['medicalBill'] = $this->model->getListMedicalBillPDF($id_record);
        require_once './Library/PDF/vendor/autoload.php';


        $this->view("Personal/MedicalBillPDF", $this->data);

    }

    function prescriptionPDF($id_record)
    {
        $this->data['medicalBill'] = $this->model->getListMedicalBillPDF($id_record);
        require_once './Library/PDF/vendor/autoload.php';

        $this->view("Personal/PrescriptionPDF", $this->data);

    }

    function listAppointment($check = '')
    {
        $appCheck = '';
        if ($check != '') {
            $appCheck = "AND appointment.check = $check";
        }
        $id_patient = $_SESSION['is_login']['id_account'];
        $this->data['appointment'] = $this->model->getListAppointment("WHERE patient.id_patient = $id_patient $appCheck ");
        $this->data['medical_bill'] = $this->model->getListTable('medical_bill');


        $this->view("Personal/ListAppointment", $this->data);

    }

    function deleteAppointment($id_appointment)
    {
        $result = $this->model->DeleteData('appointment', "WHERE id_appointment = $id_appointment");
        if ($result) {
            echo "<script>alert('Hủy lịch thành công')</script>";
            $redirectUrl = _WEB_ROOT . "/Personal/listAppointment";
            header("refresh:0; url=$redirectUrl");
        }
    }

    function listAppointmentPDF($id_appointment)
    {
        $id_patient = $_SESSION['is_login']['id_account'];
        $this->data['appointment'] = $this->model->getListAppointment("WHERE patient.id_patient = $id_patient AND  id_appointment = $id_appointment");
        require_once './Library/PDF/vendor/autoload.php';

        $this->view("Personal/listAppointmentPDF", $this->data);

    }




}
