<?php
include "../koneksi.php";

$mentor_id = 1; // mentor default

$stmt = $conn->prepare("
  INSERT INTO kuis
  (mentor_id, sub_bab, pertanyaan, a,b,c,d,jawaban)
  VALUES (?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
  "isssssss",
  $mentor_id,
  $_POST['sub'],
  $_POST['q'],
  $_POST['a'],
  $_POST['b'],
  $_POST['c'],
  $_POST['d'],
  $_POST['jawaban']
);

$stmt->execute();
echo json_encode(["success"=>true]);
