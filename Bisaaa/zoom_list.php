<?php
header("Content-Type: application/json");
include "../config/koneksi.php";

$stmt = $pdo->query("
  SELECT id, title, join_url, status, created_at
  FROM zoom_meeting
  WHERE status = 'live'
  ORDER BY created_at DESC
");

echo json_encode($stmt->fetchAll());