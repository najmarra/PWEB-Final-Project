<?php
session_start();
header('Content-Type: application/json');
require '../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$mentor_id = $_SESSION['mentor_id'];

$stmt = $pdo->prepare("SELECT id, nama, jk, email, telp, tgl_lahir, jadwal, mapel, kelas 
                       FROM mentor WHERE id = ?");
$stmt->execute([$mentor_id]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($data);
