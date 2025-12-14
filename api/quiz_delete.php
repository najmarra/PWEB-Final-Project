<?php
include "../config/koneksi.php";

if (!isset($_GET['id'])) {
  http_response_code(400);
  echo "ID tidak ditemukan";
  exit;
}

$id = intval($_GET['id']);

/* 
  Hapus dulu nilai yang terkait kuis (agar tidak error FK)
*/
mysqli_query($conn, "DELETE FROM nilai WHERE kuis_id = $id");

/* 
  Hapus kuis
*/
$query = mysqli_query($conn, "DELETE FROM kuis WHERE id = $id");

if ($query) {
  echo "success";
} else {
  http_response_code(500);
  echo "gagal";
}
