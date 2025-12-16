<?php
require_once "../koneksi_PDO.php"; // pastikan ada $pdo
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'ERROR',
        'msg'    => 'ID tidak dikirim'
    ]);
    exit;
}

$id = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("
        SELECT *
        FROM kuis
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([
        ':id' => $id
    ]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        http_response_code(404);
        echo json_encode([
            'status' => 'ERROR',
            'msg'    => 'Data tidak ditemukan'
        ]);
        exit;
    }

    echo json_encode($data);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'ERROR',
        'msg'    => $e->getMessage()
    ]);
}
