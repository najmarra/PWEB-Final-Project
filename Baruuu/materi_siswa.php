<?php
include "../config/koneksi.php";
header("Content-Type: application/json");

$stmt = $pdo->query("
  SELECT id, judul, deskripsi, jenis, file
  FROM materi
  ORDER BY created_at DESC
");

$data = [
  "pdf"   => [],
  "video" => []
];

while ($m = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $jenis = strtolower(trim($m['jenis']));

  if ($jenis === 'pdf') {
    $data['pdf'][] = $m;
  } elseif ($jenis === 'video') {
    $data['video'][] = $m;
  }
}

echo json_encode($data);
