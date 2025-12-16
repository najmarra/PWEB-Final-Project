<?php
include "../koneksi.php";
header("Content-Type: application/json");

// tampilkan error SQL
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
  $data = json_decode(file_get_contents("php://input"), true);

  if (!$data) {
    throw new Exception("Data JSON kosong");
  }

  $siswa_id = intval($data['siswa_id'] ?? 0);
  $sub_bab  = trim($data['sub_bab'] ?? '');
  $nilai    = intval($data['nilai'] ?? 0);

  if ($siswa_id <= 0 || $sub_bab === '') {
    throw new Exception("Parameter tidak lengkap");
  }

  // ambil kuis_id
  $stmt = $conn->prepare("SELECT id FROM kuis WHERE sub_bab=? LIMIT 1");
  $stmt->bind_param("s", $sub_bab);
  $stmt->execute();
  $res = $stmt->get_result();

  if ($res->num_rows === 0) {
    throw new Exception("Kuis tidak ditemukan");
  }

  $kuis_id = $res->fetch_assoc()['id'];

  // simpan nilai
  $stmt = $conn->prepare("
    INSERT INTO nilai (siswa_id, kuis_id, nilai)
    VALUES (?, ?, ?)
  ");
  $stmt->bind_param("iii", $siswa_id, $kuis_id, $nilai);
  $stmt->execute();

  echo json_encode(["status" => "OK"]);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode([
    "status" => "ERROR",
    "msg" => $e->getMessage()
  ]);
}
