<?php

include "../config/koneksi.php"; 
// pastikan $pdo adalah instance PDO

$data = [];

$stmt = $pdo->query("SELECT COUNT(*) FROM materi");
$data['materi'] = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM kuis");
$data['kuis'] = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$data['siswa'] = $stmt->fetchColumn();

header('Content-Type: application/json');
echo json_encode($data);
