<?php
session_start();
require "../config/koneksi.php";

if ($_SESSION['role'] !== 'mentor') {
  echo json_encode(["error"=>"Unauthorized"]);
  exit;
}

$mentor_id = $_SESSION['mentor_id'];

// ambil meeting terbaru
$stmt = $pdo->prepare("
  SELECT start_url 
  FROM zoom_meetings
  WHERE mentor_id=?
  ORDER BY start_time DESC
  LIMIT 1
");
$stmt->execute([$mentor_id]);
$z = $stmt->fetch();

if(!$z){
  echo json_encode(["error"=>"Belum ada meeting Zoom"]);
  exit;
}

echo json_encode([
  "start_url"=>$z['start_url']
]);
