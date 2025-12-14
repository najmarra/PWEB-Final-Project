<?php
include "../config/koneksi.php";

$q = mysqli_query($conn, "
  SELECT id, nama, jk, email, telp, tgl_lahir, jadwal, mapel, kelas
  FROM mentor
  WHERE id = 1
");

$data = mysqli_fetch_assoc($q);
echo json_encode($data);
