<?php
include "../koneksi.php";
header("Content-Type: application/json");

$data = [];
$q = mysqli_query($conn,"
  SELECT title, join_url
  FROM zoom_meeting
  WHERE status='live'
  ORDER BY created_at DESC
");

while($r = mysqli_fetch_assoc($q)){
  $data[] = $r;
}

echo json_encode($data);
