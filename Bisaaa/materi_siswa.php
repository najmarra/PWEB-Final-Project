<?php
include "../config/koneksi.php";
header("Content-Type: application/json");

$stmt = $pdo->query("
  SELECT id, judul, jenis, file
  FROM materi
  ORDER BY created_at DESC
");

$data = [
  "pdf"   => [],
  "video" => []
];

while ($m = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $data[$m['jenis']][] = $m;
}

echo json_encode($data);
