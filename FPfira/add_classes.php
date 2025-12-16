<?php
session_start();
header('Content-Type: application/json');
require '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Belum login'
  ]);
  exit;
}

$user_id   = $_SESSION['user_id'];
$class_id = $_POST['course_id'] ?? null;

if (!$class_id) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Course ID kosong'
  ]);
  exit;
}

/* Cegah duplikasi */
try {
  // cek apakah sudah mengambil kelas
  $check = $pdo->prepare(
    "SELECT 1 FROM user_classes 
     WHERE user_id = ? AND class_id = ?"
  );
  $check->execute([$user_id, $class_id]);

  if ($check->fetch()) {
    echo json_encode([
      'status' => 'error',
      'message' => 'Kelas sudah diambil'
    ]);
    exit;
  }

/* Simpan */
$insert = $pdo->prepare(
    "INSERT INTO user_classes (user_id, class_id)
     VALUES (?, ?)"
  );
  $insert->execute([$user_id, $class_id]);

  echo json_encode([
    'status' => 'success'
  ]);

} catch (PDOException $e) {
  echo json_encode([
    'status' => 'error',
    'message' => $e->getMessage()
  ]);
}