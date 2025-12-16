<?php
require_once "../koneksi_PDO.php"; // pastikan ada $pdo
header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'ERROR',
        'msg'    => 'ID kuis tidak ditemukan'
    ]);
    exit;
}

$id = (int) $_GET['id'];

try {
    // Gunakan transaction biar aman
    $pdo->beginTransaction();

    /*
      1️⃣ Hapus nilai yang terkait kuis
    */
    $stmtNilai = $pdo->prepare("
        DELETE FROM nilai
        WHERE kuis_id = :id
    ");
    $stmtNilai->execute([':id' => $id]);

    /*
      2️⃣ Hapus kuis
    */
    $stmtKuis = $pdo->prepare("
        DELETE FROM kuis
        WHERE id = :id
    ");
    $stmtKuis->execute([':id' => $id]);

    $pdo->commit();

    echo json_encode([
        'status' => 'OK',
        'msg'    => 'Kuis berhasil dihapus'
    ]);

} catch (PDOException $e) {
    $pdo->rollBack();
    http_response_code(500);

    echo json_encode([
        'status' => 'ERROR',
        'msg'    => $e->getMessage()
    ]);
}
