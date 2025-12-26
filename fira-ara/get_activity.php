<?php
session_start();
require __DIR__ . '/../koneksi.php';

header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(401);
    echo json_encode([]);
    exit;
}

// ambil login per jam hari ini
$stmt = $pdo->query("
    SELECT HOUR(login_time) AS jam, COUNT(*) AS total
    FROM login_logs_siswa
    WHERE DATE(login_time) = CURDATE()
    GROUP BY HOUR(login_time)
");

$data = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[(int)$row['jam']] = (int)$row['total'];
}

// jam sekarang (WIB)
$nowHour = (int)date('H');

$result = [];

// ISI JAM DARI 00 SAMPAI JAM SEKARANG
for ($h = 0; $h <= $nowHour; $h++) {
    $result[] = [
        'jam' => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00',
        'total' => $data[$h] ?? 0
    ];
}

echo json_encode($result);
