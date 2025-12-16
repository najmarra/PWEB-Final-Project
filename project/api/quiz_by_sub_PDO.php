<?php
require_once "../koneksi_PDO.php"; // pastikan ada $pdo
header("Content-Type: application/json");

try {
    $sub = $_GET['sub'] ?? '';

    $stmt = $pdo->prepare("
        SELECT *
        FROM kuis
        WHERE sub_bab = :sub
        ORDER BY created_at ASC
    ");

    $stmt->execute([
        ':sub' => $sub
    ]);

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'ERROR',
        'msg'    => $e->getMessage()
    ]);
}
