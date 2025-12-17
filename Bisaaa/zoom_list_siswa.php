<?php
header("Content-Type: application/json");
include "../config/koneksi.php";

/* ================= GET LIVE ================= */
$stmtLive = $pdo->prepare("
  SELECT id, title, join_url, created_at
  FROM zoom_meeting
  WHERE status = 'live'
  ORDER BY created_at DESC
");
$stmtLive->execute();
$live = $stmtLive->fetchAll(PDO::FETCH_ASSOC);

/* ================= GET UPCOMING ================= */
/* kalau belum punya jadwal, boleh kosong dulu */
$stmtUpcoming = $pdo->prepare("
  SELECT id, title, join_url, created_at
  FROM zoom_meeting
  WHERE status = 'scheduled'
  ORDER BY created_at ASC
");
$stmtUpcoming->execute();
$upcoming = $stmtUpcoming->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
  "live" => $live,
  "upcoming" => $upcoming
]);