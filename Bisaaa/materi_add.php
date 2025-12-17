<?php
include "../config/koneksi.php";
header("Content-Type: application/json");
session_start();

$mentor_id = $_SESSION['mentor_id'] ?? 1;

$judul     = trim($_POST['judul'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? ''); 
$jenis     = $_POST['jenis'] ?? '';

if ($judul === '' || !in_array($jenis, ['pdf','video'])) {
  echo json_encode(["error"=>"Judul / jenis tidak valid"]);
  exit;
}

$filePath = "";

/* ================= PDF ================= */
if ($jenis === "pdf") {

  if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(["error"=>"Upload file PDF gagal"]);
    exit;
  }

  // cek extension (LEBIH AMAN)
  $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
  if ($ext !== "pdf") {
    echo json_encode(["error"=>"File harus PDF"]);
    exit;
  }

  $folder = "../uploads/materi/pdf/";
  if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
  }

  $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['file']['name']);
  $target   = $folder . $filename;

  if (!move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
    echo json_encode(["error"=>"Gagal menyimpan file"]);
    exit;
  }

  $filePath = "uploads/materi/pdf/" . $filename;
}

/* ================= VIDEO ================= */
if ($jenis === "video") {

  $filePath = trim($_POST['video'] ?? '');

  if ($filePath === '') {
    echo json_encode(["error"=>"Link Google Drive kosong"]);
    exit;
  }
}

if ($deskripsi === '') {
  echo json_encode(["error" => "Deskripsi wajib diisi"]);
  exit;
}
/* ================= INSERT ================= */
$stmt = $pdo->prepare("
  INSERT INTO materi (mentor_id, judul, deskripsi, jenis, file)
  VALUES (:mentor, :judul, :deskripsi, :jenis, :file)
");

$stmt->execute([
  ':mentor'    => $mentor_id,
  ':judul'     => $judul,
  ':deskripsi' => $deskripsi,
  ':jenis'     => $jenis,
  ':file'      => $filePath
]);

echo json_encode(["success"=>true]);
