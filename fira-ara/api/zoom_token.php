<?php
require "../config/zoom.php";

function getZoomAccessToken() {
  $url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=" . ZOOM_ACCOUNT_ID;

  $headers = [
    "Authorization: Basic " . base64_encode(ZOOM_CLIENT_ID . ":" . ZOOM_CLIENT_SECRET)
  ];

  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => $headers
  ]);

  $res = curl_exec($ch);
  curl_close($ch);

  $data = json_decode($res, true);
  return $data['access_token'] ?? null;
}
