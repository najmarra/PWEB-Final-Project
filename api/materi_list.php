<?php
include "../config/koneksi.php";

$q = mysqli_query($conn,"SELECT * FROM materi ORDER BY id DESC");
$data = [];

while($r = mysqli_fetch_assoc($q)){
  $data[] = $r;
}

echo json_encode($data);
