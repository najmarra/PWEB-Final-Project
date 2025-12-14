<?php
include "../config/koneksi.php";

$stmt = $conn->prepare("
  INSERT INTO quiz (sub_bab, pertanyaan, a, b, c, d, jawaban, mentor_id)
  VALUES (?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
  "sssssssi",
  $_POST['sub'],
  $_POST['q'],
  $_POST['a'],
  $_POST['b'],
  $_POST['c'],
  $_POST['d'],
  $_POST['jawaban'],
  $_SESSION['mentor_id']
);

$stmt->execute();
echo json_encode(["status"=>"ok"]);
