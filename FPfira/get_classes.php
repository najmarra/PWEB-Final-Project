<?php
header('Content-Type: application/json');
require '../config/koneksi.php';

$sql = "
  SELECT 
    classes.id,
    subjects.name AS subject,
    classes.description AS `desc`,
    classes.mentor,
    classes.start_date AS startDate,
    classes.end_date AS endDate,
    classes.time
  FROM classes
  JOIN subjects ON classes.subject_id = subjects.id
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

/* INI YANG KAMU LUPA */
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);