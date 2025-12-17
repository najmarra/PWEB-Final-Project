<?php
include "../config/koneksi.php";
header("Content-Type: application/json");

$sub = $_GET['sub'] ?? '';

if ($sub === '') {
  echo json_encode([]);
  exit;
}

$stmt = $pdo->prepare("
  SELECT id, pertanyaan, a, b, c, d, jawaban
  FROM kuis
  WHERE sub_bab = :sub
  ORDER BY id ASC
");
$stmt->execute(['sub' => $sub]);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);