<?php
header('Content-Type: application/json');

require_once "../koneksi_PDO.php"; // pastikan ini set $pdo

try {
    $mentor_id = 1; // mentor default (nanti bisa dari session)

    $stmt = $pdo->prepare("
        INSERT INTO kuis
        (mentor_id, sub_bab, pertanyaan, a, b, c, d, jawaban)
        VALUES
        (:mentor_id, :sub_bab, :pertanyaan, :a, :b, :c, :d, :jawaban)
    ");

    $stmt->execute([
        ':mentor_id' => $mentor_id,
        ':sub_bab'   => $_POST['sub'],
        ':pertanyaan'=> $_POST['q'],
        ':a'         => $_POST['a'],
        ':b'         => $_POST['b'],
        ':c'         => $_POST['c'],
        ':d'         => $_POST['d'],
        ':jawaban'   => $_POST['jawaban']
    ]);

    echo json_encode([
        'status' => 'OK',
        'msg'    => 'Kuis berhasil disimpan'
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'ERROR',
        'msg'    => $e->getMessage()
    ]);
}
