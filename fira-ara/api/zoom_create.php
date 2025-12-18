<?php
session_start();
require "../config/koneksi.php";
require "zoom_token.php";

if ($_SESSION['role'] !== 'mentor') {
    echo json_encode(["error"=>"Unauthorized"]);
    exit;
}

$mentor_id = $_SESSION['mentor_id'];

// ambil data mentor dari DB
$stmt = $pdo->prepare("SELECT nama, mapel FROM mentor WHERE id = ?");
$stmt->execute([$mentor_id]);
$mentor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mentor) {
    echo json_encode(["error"=>"Mentor tidak ditemukan"]);
    exit;
}

date_default_timezone_set("Asia/Jakarta");

// judul Zoom: Kelas Online - Nama Mentor (Mapel) - tanggal
$title = "{$mentor['nama']} ({$mentor['mapel']}) - " . date("d M Y H:i");

$token = getZoomAccessToken();
if(!$token){
    echo json_encode(["error"=>"Token Zoom gagal"]);
    exit;
}

$data = [
    "topic" => $title,
    "type" => 1, // instant meeting
    "settings" => [
        "host_video" => true,
        "participant_video" => true
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

$zoom = json_decode($res, true);

$stmt = $pdo->prepare("
  INSERT INTO zoom_meetings
  (mentor_id,title,zoom_meeting_id,start_url,join_url,status)
  VALUES (?,?,?,?,?,'started')
");

$stmt->execute([
    $mentor_id,
    $title,
    $zoom['id'],
    $zoom['start_url'],
    $zoom['join_url']
]);

echo json_encode([
    "start_url"=>$zoom['start_url']
]);
