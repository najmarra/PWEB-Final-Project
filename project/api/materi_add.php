<?php
include "../koneksi.php";
header("Content-Type: application/json");

session_start();
$mentor_id = $_SESSION['mentor_id'] ?? 1;

$judul = trim($_POST['judul'] ?? '');
$jenis = $_POST['jenis'] ?? '';

if ($judul === '' || !in_array($jenis, ['pdf','video'])) {
  http_response_code(400);
  echo json_encode(["error"=>"Data tidak valid"]);
  exit;
}

$filePath = "";

/* ===== PDF ===== */
if ($jenis === "pdf") {
  if (!isset($_FILES['file'])) {
    echo json_encode(["error"=>"File PDF tidak ada"]);
    exit;
  }

  if ($_FILES['file']['type'] !== "application/pdf") {
    echo json_encode(["error"=>"File harus PDF"]);
    exit;
  }

  $folder = "../uploads/materi/pdf/";
  if (!is_dir($folder)) mkdir($folder, 0777, true);

  $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['file']['name']);
  move_uploaded_file($_FILES['file']['tmp_name'], $folder . $filename);

  $filePath = "/uploads/materi/pdf/" . $filename;
}

/* ===== VIDEO ===== */
if ($jenis === "video") {
  $filePath = trim($_POST['video'] ?? '');
  if ($filePath === '') {
    echo json_encode(["error"=>"Link video kosong"]);
    exit;
  }
}

/* ===== INSERT ===== */
$stmt = $conn->prepare(
  "INSERT INTO materi (mentor_id, judul, jenis, file) VALUES (?,?,?,?)"
);
$stmt->bind_param("isss", $mentor_id, $judul, $jenis, $filePath);
$stmt->execute();

echo json_encode(["success"=>true]);
