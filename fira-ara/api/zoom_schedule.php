<?php
session_start();
require "../config/koneksi.php";
require "zoom_token.php";

if ($_SESSION['role'] !== 'mentor') {
  echo json_encode(["error"=>"Unauthorized"]);
  exit;
}

$mentor_id = $_SESSION['mentor_id'];

date_default_timezone_set("Asia/Jakarta");

$title     = $_POST['title'];
$startTime = $_POST['start_time']; // 2025-01-01T09:00
$duration  = $_POST['duration'];

if(!$title || !$startTime){
  echo json_encode(["error"=>"Data tidak lengkap"]);
  exit;
}

$token = getZoomAccessToken();
if(!$token){
  echo json_encode(["error"=>"Token Zoom gagal"]);
  exit;
}

$data = [
  "topic" => $title,
  "type" => 2, // scheduled
  "start_time" => $startTime,
  "duration" => $duration,
  "timezone" => "Asia/Jakarta",
  "settings" => [
    "waiting_room" => true,
    "join_before_host" => false
  ]
];

$ch = curl_init("https://api.zoom.us/v2/users/me/meetings");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer $token",
    "Content-Type: application/json"
  ],
  CURLOPT_POSTFIELDS => json_encode($data)
]);

$res = curl_exec($ch);
curl_close($ch);

$z = json_decode($res, true);

$stmt = $pdo->prepare("
  INSERT INTO zoom_meetings
  (mentor_id,title,zoom_meeting_id,start_time,duration,timezone,start_url,join_url,status)
  VALUES (?,?,?,?,?,?,?,?,'scheduled')
");

$stmt->execute([
  $mentor_id,
  $title,
  $z['id'],
  $startTime,
  $duration,
  $z['timezone'],
  $z['start_url'],
  $z['join_url']
]);

echo json_encode(["success"=>true]);
