<?php 
include_once("Model/Connect.php");

$province_id = $_GET['province_id'];

$sql = "SELECT * FROM `district` WHERE `province_id` = {$province_id}";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['district_id'],
        'name'=> $row['name']
    ];
}
echo json_encode($data);
?>