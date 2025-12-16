<?php
require "../config/koneksi.php";
header("Content-Type: application/json");

$stmt = $pdo->query("
  SELECT sub_bab, COUNT(*) AS total
  FROM kuis
  WHERE sub_bab IS NOT NULL AND sub_bab != ''
  GROUP BY sub_bab
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));