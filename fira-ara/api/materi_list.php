<?php
include "../config/koneksi.php";
header("Content-Type: application/json");

$stmt = $pdo->query("
  SELECT id, judul, deskripsi, jenis, file, created_at
  FROM materi
  ORDER BY created_at DESC
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
