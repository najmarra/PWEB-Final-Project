<?php
include "../config/koneksi.php";

$res = $conn->query("
 SELECT s.nama, q.sub_bab, n.nilai
 FROM nilai n
 JOIN siswa s ON n.siswa_id=s.id
 JOIN quiz q ON n.quiz_id=q.id
 ORDER BY n.nilai DESC
");

$data=[];
while($r=$res->fetch_assoc()){
  $data[]=$r;
}
echo json_encode($data);
