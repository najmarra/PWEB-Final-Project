<?php
include "../config/koneksi.php";

$id = $_GET['id'] ?? 0;
if (!$id) exit;

/* Ambil data dulu (untuk hapus file pdf) */
$stmt = $pdo->prepare("SELECT jenis, file FROM materi WHERE id = ?");
$stmt->execute([$id]);
$m = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$m) exit;

/* Hapus file jika PDF */
if ($m['jenis'] === 'pdf') {
  $path = "../" . $m['file'];
  if (file_exists($path)) unlink($path);
}

/* Hapus data */
$del = $pdo->prepare("DELETE FROM materi WHERE id = ?");
$del->execute([$id]);

echo "OK";
