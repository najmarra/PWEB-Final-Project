<?php
session_start();
require "../config/koneksi.php";

$stmt = $pdo->query("
SELECT id,title,start_time,status
FROM zoom_meetings
WHERE mentor_id=?
ORDER BY start_time ASC

");

echo json_encode($stmt->fetchAll());
