<?php
session_start();
require __DIR__ . '/../koneksi.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(401);
    echo json_encode([]);
    exit;
}

$stmt = $pdo->query("
    SELECT 
        u.name,
        TIMESTAMPDIFF(SECOND, l.login_time, NOW()) AS diff_seconds
    FROM login_logs_siswa l
    JOIN users u ON l.siswa_id = u.id
    ORDER BY l.login_time DESC
    LIMIT 5
");

$result = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $diff = (int)$row['diff_seconds'];

    if ($diff < 60) {
        $waktu = 'Baru saja';
    } elseif ($diff < 3600) {
        $waktu = floor($diff / 60) . ' menit lalu';
    } elseif ($diff < 86400) {
        $waktu = floor($diff / 3600) . ' jam lalu';
    } else {
        $waktu = floor($diff / 86400) . ' hari lalu';
    }

    $result[] = [
        'name' => $row['name'],
        'login_text' => $waktu
    ];
}

echo json_encode($result);

