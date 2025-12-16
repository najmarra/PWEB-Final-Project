<?php
include "../koneksi_PDO.php"; // pastikan ini berisi $pdo
header("Content-Type: application/json");

try {
    $stmt = $pdo->prepare("
        SELECT sub_bab, COUNT(*) AS total
        FROM kuis
        GROUP BY sub_bab
    ");
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Database error",
        "msg"   => $e->getMessage()
    ]);
}
