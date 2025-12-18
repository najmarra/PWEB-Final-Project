<?php
require_once "../config/koneksi.php";
header("Content-Type: application/json");

$id = $_GET['id'] ?? 0;

try {
  $pdo->beginTransaction();

  // 1️⃣ hapus jawaban siswa terkait soal ini
  $stmtAns = $pdo->prepare("
    DELETE FROM quiz_answers
    WHERE kuis_id = :id
  ");
  $stmtAns->execute([':id'=>$id]);

  // 2️⃣ hapus soal kuis
  $stmtKuis = $pdo->prepare("
    DELETE FROM kuis
    WHERE id = :id
  ");
  $stmtKuis->execute([':id'=>$id]);

  $pdo->commit();

  echo json_encode([
    'status'=>'OK',
    'msg'=>'Kuis berhasil dihapus'
  ]);

} catch(PDOException $e){
  $pdo->rollBack();
  http_response_code(500);
  echo json_encode([
    'status'=>'ERROR',
    'msg'=>$e->getMessage()
  ]);
}