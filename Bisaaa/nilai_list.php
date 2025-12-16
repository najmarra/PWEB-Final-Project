<?php
require "../config/koneksi.php";
header("Content-Type: application/json");

$stmt = $pdo->prepare("
  SELECT
    u.name AS nama,
    qa.sub_bab,
    qa.score AS nilai
  FROM quiz_attempts qa
  JOIN users u ON qa.user_id = u.id
  ORDER BY qa.sub_bab, qa.score DESC
");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = [];
$currentSub = "";
$rank = 0;

foreach ($rows as $row) {
  if ($row['sub_bab'] !== $currentSub) {
    $currentSub = $row['sub_bab'];
    $rank = 1;
  } else {
    $rank++;
  }

  $row['rank'] = $rank;
  $data[] = $row;
}

echo json_encode($data);
