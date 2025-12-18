<?php
session_start();
require '../config/koneksi.php';

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$newPass = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

// ================= UPDATE USERNAME =================
$stmt = $pdo->prepare("UPDATE users SET username=? WHERE id=?");
$stmt->execute([$username, $user_id]);

$_SESSION['username'] = $username;

// ================= RESET PASSWORD (OPSIONAL) =================
if (!empty($newPass)) {

  if ($newPass !== $confirm) {
    echo "<script>alert('Konfirmasi password tidak cocok');history.back();</script>";
    exit;
  }

  $hash = password_hash($newPass, PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
  $stmt->execute([$hash, $user_id]);
}

echo "<script>
  alert('Data akun berhasil diperbarui');
  window.location='../setting.php';
</script>";
