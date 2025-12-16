<?php
include "../koneksi.php";
header("Content-Type: application/json");

/* VALIDASI PARAMETER */
$sub = $_GET['sub'] ?? '';

if($sub === ''){
  echo json_encode([]);
  exit;
}

/* QUERY AMAN */
$stmt = $conn->prepare("
  SELECT id, pertanyaan, a, b, c, d, jawaban
  FROM kuis
  WHERE sub_bab = ?
");

$stmt->bind_param("s", $sub);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while($r = $result->fetch_assoc()){
  $data[] = [
    "id" => $r['id'],
    "q" => $r['pertanyaan'],
    "options" => [$r['a'], $r['b'], $r['c'], $r['d']],
    "answer" => ["A"=>0,"B"=>1,"C"=>2,"D"=>3][$r['jawaban']]
  ];
}

echo json_encode($data);
