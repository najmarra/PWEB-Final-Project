<?php
include "../koneksi.php";
header("Content-Type: application/json");

$sub = $_GET['sub'] ?? '';

$q = mysqli_query($conn,"SELECT * FROM kuis WHERE sub_bab='$sub'");
$data=[];
while($r=mysqli_fetch_assoc($q)){
  $data[]=$r;
}
echo json_encode($data);
