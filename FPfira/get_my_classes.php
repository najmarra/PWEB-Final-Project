<?php
session_start();
require 'koneksi.php';

$user_id = $_SESSION['user_id'];

$sql = "
SELECT
  c.id,
  s.name AS subject,
  c.description AS `desc`,
  c.mentor,
  c.start_date AS startDate,
  c.end_date AS endDate,
  c.time
FROM user_classes uc
JOIN classes c ON uc.class_id = c.id
JOIN subjects s ON c.subject_id = s.id
WHERE uc.user_id = ?
ORDER BY c.start_date
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);


echo json_encode($stmt->fetchAll());
