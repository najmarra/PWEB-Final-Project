<?php
session_start();
require "../config/koneksi.php";

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
    echo json_encode(['error'=>'Belum login']);
    exit;
}

$mentor_id = $_SESSION['mentor_id'] ?? 0;

$nama      = trim($_POST['nama'] ?? '');
$email     = trim($_POST['email'] ?? '');
$password  = trim($_POST['password'] ?? '');
$telp      = trim($_POST['telp'] ?? '');
$tgl_lahir = $_POST['tgl_lahir'] ?? null;
$jadwal    = $_POST['jadwal'] ?? '';
$mapel     = $_POST['mapel'] ?? '';
$kelas     = $_POST['kelas'] ?? '';

// validasi sederhana
if(!$nama || !$email){
    echo json_encode(['error'=>'Nama dan email wajib diisi']);
    exit;
}

// update query
$sql = "UPDATE mentor SET 
        nama=:nama, email=:email, telp=:telp, tgl_lahir=:tgl_lahir, 
        jadwal=:jadwal, mapel=:mapel, kelas=:kelas";

$params = [
    ':nama'=>$nama,
    ':email'=>$email,
    ':telp'=>$telp,
    ':tgl_lahir'=>$tgl_lahir,
    ':jadwal'=>$jadwal,
    ':mapel'=>$mapel,
    ':kelas'=>$kelas
];

if($password){
    $sql .= ", password=:password";
    $params[':password'] = $password;
}

$sql .= " WHERE id=:id";
$params[':id'] = $mentor_id;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

echo json_encode(['success'=>true]);
?>
