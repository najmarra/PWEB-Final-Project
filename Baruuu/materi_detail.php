<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM materi WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$m = $stmt->get_result()->fetch_assoc();
?>

<h5><?= $m['judul']; ?></h5>

<?php if($m['jenis']=='video'): ?>
  <video controls width="100%">
    <source src="uploads/<?= $m['file']; ?>">
  </video>
<?php else: ?>
  <iframe src="uploads/<?= $m['file']; ?>" width="100%" height="500"></iframe>
<?php endif; ?>
