<?php
require_once "../config/koneksi.php";
header("Content-Type: application/json");
session_start();

$user_id = $_SESSION['user_id'] ?? 1; // sementara
$sub_bab = $_POST['sub_bab'] ?? null;
$answers = json_decode($_POST['answers'] ?? '', true);

if (!$sub_bab || !$answers || !is_array($answers)) {
  http_response_code(400);
  echo json_encode(['error' => 'Data tidak lengkap']);
  exit;
}

try {
  $pdo->beginTransaction();

  // 1️⃣ INSERT ATTEMPT
  $stmtAttempt = $pdo->prepare("
    INSERT INTO quiz_attempts (user_id, sub_bab, score, total_correct, total_wrong)
    VALUES (?, ?, 0, 0, 0)
  ");
  $stmtAttempt->execute([$user_id, $sub_bab]);

  $attempt_id = $pdo->lastInsertId();
  if (!$attempt_id) throw new Exception("Attempt gagal");

  // 2️⃣ SIAPKAN QUERY
  $stmtRight = $pdo->prepare("SELECT jawaban FROM kuis WHERE id=?");
  $stmtAns = $pdo->prepare("
    INSERT INTO quiz_answers (attempt_id, kuis_id, selected_option, is_correct)
    VALUES (?, ?, ?, ?)
  ");

  $correct = 0;
  $total = count($answers);

  // 3️⃣ SIMPAN JAWABAN
  foreach ($answers as $qid => $opt) {
    $stmtRight->execute([$qid]);
    $right = $stmtRight->fetchColumn();
    if (!$right) continue;

    $isCorrect = strtoupper($opt) === $right;
    if ($isCorrect) $correct++;

    $stmtAns->execute([
      $attempt_id,
      $qid,
      strtoupper($opt),
      $isCorrect
    ]);
  }

  // 4️⃣ UPDATE HASIL
  $score = $correct * 10;
  $wrong = $total - $correct;

  $pdo->prepare("
    UPDATE quiz_attempts
    SET score=?, total_correct=?, total_wrong=?
    WHERE id=?
  ")->execute([$score, $correct, $wrong, $attempt_id]);

  $pdo->commit();

  echo json_encode([
    'status' => 'ok',
    'score' => $score,
    'correct' => $correct,
    'wrong' => $wrong
  ]);

} catch (Exception $e) {
  $pdo->rollBack();
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
