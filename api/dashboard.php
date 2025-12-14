<?php
include "../config/koneksi.php";

$data = [];

$data['materi'] = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT COUNT(*) total FROM materi")
)['total'];

$data['kuis'] = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT COUNT(*) total FROM kuis")
)['total'];

$data['siswa'] = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT COUNT(*) total FROM siswa")
)['total'];

echo json_encode($data);
