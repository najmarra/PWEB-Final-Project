<?php
include "../koneksi.php";
header("Content-Type: application/json");

$siswa_id = 1;

$q = $conn->query("
  SELECT k.sub_bab, n.nilai, n.created_at
  FROM nilai n
  JOIN kuis k ON n.kuis_id = k.id
  WHERE n.siswa_id = $siswa_id
  ORDER BY n.created_at DESC
");

$data=[];
while($r=$q->fetch_assoc()) $data[]=$r;
echo json_encode($data);
