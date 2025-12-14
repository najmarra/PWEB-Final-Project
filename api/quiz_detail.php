<?php
include "../config/koneksi.php"; // SESUAIKAN PATH

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
  echo json_encode(["error" => "ID tidak dikirim"]);
  exit;
}

$id = intval($_GET['id']);

$q = mysqli_query($conn, "SELECT * FROM kuis WHERE id = $id");

if (!$q) {
  echo json_encode(["error" => mysqli_error($conn)]);
  exit;
}

$data = mysqli_fetch_assoc($q);

if (!$data) {
  echo json_encode(["error" => "Data tidak ditemukan"]);
  exit;
}

echo json_encode($data);
