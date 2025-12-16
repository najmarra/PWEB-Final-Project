<?php
include "../koneksi.php";
header("Content-Type: application/json");

$q = $conn->query("
  SELECT 
    n.id,
    s.nama,
    k.sub_bab,
    n.nilai
  FROM nilai n
  JOIN siswa s ON n.siswa_id = s.id
  JOIN kuis k ON n.kuis_id = k.id
  ORDER BY k.sub_bab, n.nilai DESC
");

$data = [];
$current_sub = '';
$rank = 0;
$last_score = null;

while($row = $q->fetch_assoc()) {
    if($row['sub_bab'] !== $current_sub){
        $current_sub = $row['sub_bab'];
        $rank = 1;
        $last_score = null;
    } else {
        if($row['nilai'] < $last_score){
            $rank++;
        }
    }
    $last_score = $row['nilai'];
    $row['rank'] = $rank;
    $data[] = $row;
}

echo json_encode($data);
