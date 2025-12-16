<?php
require_once "../koneksi_PDO.php"; // pastikan ada $pdo
header("Content-Type: application/json");

try {
    $mentor_id = 1; // nanti idealnya dari session

    $stmt = $pdo->prepare("
        SELECT id, sub_bab, pertanyaan
        FROM kuis
        WHERE mentor_id = :mentor_id
        ORDER BY created_at DESC
    ");

    $stmt->execute([
        ':mentor_id' => $mentor_id
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
