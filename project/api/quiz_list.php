<?php
include "../koneksi.php";

$mentor_id = 1;

$q = $conn->query("
  SELECT id, sub_bab, pertanyaan
  FROM kuis
  WHERE mentor_id=$mentor_id
  ORDER BY created_at DESC
");

$data=[];
while($r=$q->fetch_assoc()) $data[]=$r;
echo json_encode($data);
