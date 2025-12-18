<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: ../setting.php");
  exit;
}

$stmt = $pdo->prepare("
  UPDATE users SET name=?, gender=?, email=?, kelas=? WHERE id=?
");

$stmt->execute([
  $_POST['name'],
  $_POST['gender'],
  $_POST['email'],
  $_POST['kelas'],
  $_SESSION['user_id']
]);

// update session
$_SESSION['name']   = $_POST['name'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['email']  = $_POST['email'];
$_SESSION['kelas']  = $_POST['kelas'];

header("Location: ../setting.php");
exit;