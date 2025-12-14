<?php
include "../config/koneksi.php"; // SESUAIKAN PATH

$mentor_id = 1; // nanti dari session
$judul = $_POST['judul'] ?? '';
$jenis = $_POST['jenis'] ?? '';

if ($judul === '' || $jenis === '') {
  http_response_code(400);
  exit("Data tidak lengkap");
}

$filePath = "";

/* ===== PDF ===== */
if ($jenis === "pdf") {
  if (empty($_FILES['file']['name'])) {
    exit("File PDF tidak ditemukan");
  }

  $folder = "../uploads/materi/pdf/";
  if (!is_dir($folder)) mkdir($folder, 0777, true);

  $filename = time() . "_" . basename($_FILES['file']['name']);
  move_uploaded_file($_FILES['file']['tmp_name'], $folder . $filename);

  $filePath = "uploads/materi/pdf/" . $filename;
}

/* ===== VIDEO ===== */
if ($jenis === "video") {
  $filePath = trim($_POST['video'] ?? '');
  if ($filePath === '') exit("Link video kosong");
}

/* ===== INSERT DATABASE ===== */
$sql = "INSERT INTO materi (mentor_id, judul, jenis, file)
        VALUES ('$mentor_id', '$judul', '$jenis', '$filePath')";

mysqli_query($conn, $sql) or die(mysqli_error($conn));

echo json_encode(["success" => true]);
