<?php
session_start();
require 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    echo "<script>alert('Email dan password wajib diisi');history.back();</script>";
    exit;
}

try {
    // === Cek mentor ===
    $stmt = $pdo->prepare("SELECT * FROM mentor WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $role = 'mentor';
    } else {
        // === Cek siswa ===
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $role = 'siswa';
    }

    if (!$user) {
        echo "<script>alert('Email tidak terdaftar');history.back();</script>";
        exit;
    }

    // Password (plaintext – SESUAI KODE KAMU)
    if ($password !== $user['password']) {
        echo "<script>alert('Password salah');history.back();</script>";
        exit;
    }

    // === SET SESSION ===
    $_SESSION['login'] = true;
    $_SESSION['role']  = $role;

    if ($role === 'mentor') {
        $_SESSION['mentor_id']    = $user['id'];
        $_SESSION['mentor_nama']  = $user['nama'];
        $_SESSION['mentor_email'] = $user['email'];

        header('Location: index.php');
    } else {
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_nama']  = $user['name'];     
        $_SESSION['username']  = $user['username'];
        $_SESSION['user_email']= $user['email'];
        
        header('Location: dashboard.php');
    }
    exit;

} catch (Exception $e) {
    echo "<script>alert('Terjadi kesalahan server');history.back();</script>";
    exit;
}
