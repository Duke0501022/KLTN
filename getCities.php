<?php 
include_once("Model/Connect.php");

$sql = "SELECT * FROM `province`";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['province_id'],
        'name'=> $row['name']
    ];
}
echo json_encode($data);
?>