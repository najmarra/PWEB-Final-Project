<?php
include "../koneksi.php";
header("Content-Type: application/json");

$q = $conn->query("
  SELECT sub_bab, COUNT(*) total
  FROM kuis
  GROUP BY sub_bab
");

$data=[];
while($r=$q->fetch_assoc()) $data[]=$r;
echo json_encode($data);
