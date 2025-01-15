<?php

class PersonalModel extends Model
{
    public function insertMedicalBill($advice, $diagnose, $id_appointment, $medical_bill_detail)
    {
        $insert_medical_bill_detail = '';

        $date_create = date('Y-m-d H:i:s');


        $insert_medical_bill = "INSERT INTO `medical_bill`(date_create, advice, diagnose, id_appointment) VALUES('$date_create', '$advice', '$diagnose', $id_appointment);";

        $insert_medical_bill_detail = "INSERT INTO `medical_bill_detail`(id_record ,id_medicine, quantity, instructions) VALUES ";
        foreach ($medical_bill_detail as $item) {
            $id_medicine = $item['id_medicine'];
            $quantity = $item['quantity'];
            $instructions = $item['instructions'];
            $insert_medical_bill_detail .= "(LAST_INSERT_ID(), $id_medicine, $quantity, '$instructions'),";  //@@IDENTITY
        }
        $insert_medical_bill_detail= rtrim($insert_medical_bill_detail, ",");
        
        $result = mysqli_query($this->connect, $insert_medical_bill);
        $result = mysqli_query($this->connect, $insert_medical_bill_detail);

        return $result;
    }

    public function getListAppointment($condition = '')
    {
        $query = "SELECT *, 
        staff.full_name as fullNameStaff, 
        patient.full_name as fullNamePatient,
        patient.email as emailPatient, 
        patient.gender as genderPatient, 
        patient.birthday as patientBirthday, 
        patient.phone as patientPhone,
        appointment.date as appointmentDate,
        patient.image as patientImage,

        staff.full_name as staffFullname
        FROM patient 
        INNER JOIN appointment ON patient.id_patient = appointment.id_patient 
        INNER JOIN staff ON appointment.id_staff = staff.id_staff
        INNER JOIN department ON department.id_department = staff.id_department        
         $condition";
        $result = mysqli_query($this->connect, $query);
        $data = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }



    public function getListMedicalBillPDF($id_record)
    {
        $query = "SELECT *, 
        staff.full_name as fullNameStaff, 
        patient.full_name as fullNamePatient, 
        patient.email as emailPatient, 
        patient.gender as genderPatient , 
        medical_bill_detail.quantity as billQuantity, 
        patient.birthday as patientBirthday,
        staff.full_name as fullNameStaff 
        FROM appointment
        
        INNER JOIN patient ON patient.id_patient = appointment.id_patient 
       
         INNER JOIN staff ON appointment.id_staff = staff.id_staff 
         INNER JOIN medical_bill ON appointment.id_appointment = medical_bill.id_appointment
         INNER JOIN medical_bill_detail ON medical_bill.id_record = medical_bill.id_record
         INNER JOIN medicine ON medicine.id_medicine = medical_bill_detail.id_medicine
          WHERE medical_bill.id_record = $id_record  AND medical_bill_detail.id_record =$id_record";
        $result = mysqli_query($this->connect, $query);
        $data = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }


    
}
