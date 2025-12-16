<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include "../koneksi.php";
session_start();

/* ====== ZOOM CREDENTIAL ====== */
$accountId    = "o4f1KeauQW-va8hsbnQ9uA";
$clientId     = "fPLkAjZUTBm5KWnoGmjHcg";
$clientSecret = "aB4Ku1sDCr5yDtwV0OZFB5Z9Ce7RAXBq";

$mentor_id = $_SESSION['mentor_id'] ?? 1;
$title = "Live Class Mentor";

/* ================= TOKEN ================= */
$tokenUrl = "https://zoom.us/oauth/token";
$basicAuth = base64_encode("$clientId:$clientSecret");

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $tokenUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        "grant_type" => "account_credentials",
        "account_id" => $accountId
    ]),
    CURLOPT_HTTPHEADER => [
        "Authorization: Basic $basicAuth"
    ],
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode(["error"=>"Curl token error","detail"=>curl_error($ch)]);
    exit;
}
curl_close($ch);

$data = json_decode($response, true);
if (!isset($data['access_token'])) {
    echo json_encode(["error"=>"Token gagal","response"=>$data]);
    exit;
}

$accessToken = $data['access_token'];

/* ================= CREATE MEETING ================= */
$meetingData = [
    "topic" => $title,
    "type" => 1, // instant meeting
    "settings" => [
        "host_video" => true,
        "participant_video" => true,
        "waiting_room" => false
    ]
];

$ch = curl_init("https://api.zoom.us/v2/users/me/meetings");
curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($meetingData),
    CURLOPT_RETURNTRANSFER => true
]);

$result = curl_exec($ch);

if ($result === false) {
    echo json_encode(["error"=>"Gagal create meeting","detail"=>curl_error($ch)]);
    exit;
}
curl_close($ch);

$meeting = json_decode($result, true);

if (!isset($meeting['join_url'])) {
    echo json_encode(["error"=>"Meeting gagal dibuat","response"=>$meeting]);
    exit;
}

/* ================= SIMPAN KE DATABASE ================= */
$stmt = $conn->prepare("
  INSERT INTO zoom_meeting (mentor_id, title, start_url, join_url, status)
  VALUES (?, ?, ?, ?, 'live')
");
$stmt->bind_param(
  "isss",
  $mentor_id,
  $title,
  $meeting['start_url'],
  $meeting['join_url']
);
$stmt->execute();

/* ================= RESPONSE ================= */
echo json_encode([
  "success"   => true,
  "start_url"=> $meeting['start_url'],
  "join_url" => $meeting['join_url']
]);
