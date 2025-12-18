<?php
session_start();
require "../config/koneksi.php";

// siswa harus login
if(!isset($_SESSION['login'])){
  echo json_encode([]);
  exit;
}

date_default_timezone_set("Asia/Jakarta");
$now = date("Y-m-d H:i:s");

/*
STATUS LOGIC:
- started  -> live
- scheduled & start_time > now -> upcoming
*/

$stmt = $pdo->prepare("
  SELECT
    id,
    title,
    join_url,
    start_time,
    status,
    created_at
  FROM zoom_meetings
  WHERE status IN ('started','scheduled')
  ORDER BY start_time ASC
");

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$live = [];
$upcoming = [];

foreach($data as $z){

  if($z['status'] === 'started'){
    $live[] = $z;
  }

  if(
    $z['status'] === 'scheduled' &&
    $z['start_time'] > $now
  ){
    $upcoming[] = $z;
  }
}

echo json_encode([
  "live" => $live,
  "upcoming" => $upcoming
]);
