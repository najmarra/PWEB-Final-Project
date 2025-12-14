<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

$accountId = "o4f1KeauQW-va8hsbnQ9uA";
$clientId = "fPLkAjZUTBm5KWnoGmjHcg";
$clientSecret = "aB4Ku1sDCr5yDtwV0OZFB5Z9Ce7RAXBq";

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
    echo json_encode([
        "error" => "Curl Error",
        "detail" => curl_error($ch)
    ]);
    exit;
}
curl_close($ch);

$data = json_decode($response, true);

if (!isset($data['access_token'])) {
    echo json_encode([
        "error" => "Gagal ambil token Zoom",
        "response" => $data
    ]);
    exit;
}

$accessToken = $data['access_token'];

/* ================= CREATE MEETING ================= */
$meetingData = [
    "topic" => "Kelas Online Mentor",
    "type" => 2,
    "settings" => [
        "host_video" => true,
        "participant_video" => true
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
    echo json_encode([
        "error" => "Gagal create meeting",
        "detail" => curl_error($ch)
    ]);
    exit;
}

curl_close($ch);
echo $result;
