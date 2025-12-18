<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT 
    SUM(total_correct + total_wrong) AS total_soal,
    SUM(total_correct) AS total_benar,
    SUM(total_wrong) AS total_salah
  FROM quiz_attempts
  WHERE user_id = ?
");

$stmt->execute([$user_id]);
$summary = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
  SELECT 
    DATE_FORMAT(created_at, '%Y-%m') AS month,
    SUM(score) AS points
  FROM quiz_attempts
  WHERE user_id = ?
  GROUP BY DATE_FORMAT(created_at, '%Y-%m')
  ORDER BY DATE_FORMAT(created_at, '%Y-%m')
");

$stmt->execute([$user_id]);
$reportData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
  SELECT AVG(score) AS avg_score
  FROM quiz_attempts
  WHERE user_id = ?
");
$stmt->execute([$user_id]);
$avg = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
  SELECT 
    u.id,
    u.name,
    SUM(qa.score) AS total_poin
  FROM users u
  JOIN quiz_attempts qa ON qa.user_id = u.id
  GROUP BY u.id
  ORDER BY total_poin DESC
");
$leaderboard = $stmt->fetchAll(PDO::FETCH_ASSOC);

$myRank = null;
$rank = 1;

foreach ($leaderboard as $row) {
  if ($row['id'] == $user_id) {
    $myRank = $rank;
    break;
  }
  $rank++;
}?>

<?php $page = 'laporan'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Siswa</title>

<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- BOOTSTRAP & ICON -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
  --bg:#F7F8F6;
  --glass:rgba(255,255,255,.9);
  --border:#ECECEC;

  --dark:#0C3B2E;
  --muted:#6B7280;

  --yellow-soft:#FFF3C4;
  --yellow-main:#FFE08A;
  --yellow-deep:#F2C94C;

  --green-soft:#E6F4EA;
  --green-main:#6D9773;
  --green-deep:#3E6B4E;
}

/* BASE */
html,body{
  height:100%;
  margin:0;
  overflow:hidden;
  font-family:'Roboto',system-ui,Arial;
  background:var(--dark);
}

/* CONTAINER */
.cover{
  width:95vw;
  height:96vh;
  margin:2vh auto;
  background:var(--glass);
  border-radius:18px;
  padding:20px;
  display:flex;
  gap:20px;
  box-shadow:0 18px 50px rgba(0,0,0,.08);
  box-sizing:border-box;
}

.sidebar{
  width:240px;
  display:flex;
  flex-direction:column;
  gap:14px;
  flex-shrink:0;
}

.brand{
  display:flex;
  align-items:center;
  gap:10px;
}

.logo{
  width:44px;
  height:44px;
  border-radius:10px;
  background:linear-gradient(135deg,var(--yellow-main),var(--yellow-deep));
  color:#1f2937;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:700;
}

.navlink{
  padding:10px 12px;
  border-radius:10px;
  display:flex;
  gap:12px;
  align-items:center;
  cursor:pointer;
  color:var(--muted);
  transition:background-color .25s ease,color .25s ease;
  text-decoration:none;
}

.navlink i{
  color:var(--green-main);
}

.navlink:hover{
  background:var(--yellow-soft);
  color:var(--dark);
}

.navlink.active{
  background:linear-gradient(135deg,var(--yellow-main),var(--yellow-deep));
  color:#1f2937;
  font-weight:600;
}

.navlink.active i{
  color:#1f2937;
}

/* Quick Card — Sidebar Default */
.sidebar .quick-card{
  margin-top:auto;
  width:100%;
  min-height:96px;
  padding:14px;
  background:#fff;
  border-radius:12px;
  text-align:center;
  box-shadow:0 8px 22px rgba(214,178,76,.18);
  box-sizing:border-box;
}

button,
.btn{
  background:linear-gradient(135deg,var(--yellow-main),var(--yellow-deep));
  color:#1f2937;
  border:none;
}

button:hover,
.btn:hover{
  filter:brightness(1.05);
}

/* MAIN */
.main{
  flex:1;
  display:flex;
  flex-direction:column;
  min-width:0;
}

/* CONTENT */
.content{
  flex:1;
  overflow-y:auto;
  padding-right:6px;
}

/* CARD */
.card{
  background:#fff;
  border-radius:16px;
  padding:20px;
  margin-bottom:20px;
  box-shadow:0 10px 25px rgba(214,178,76,.18);
}

.title{
  font-size:18px;
  font-weight:700;
  margin-bottom:14px;
  font-family:'Poppins',sans-serif;
}

.info-row{
  display:grid;
  grid-template-columns:1fr auto;
  padding:10px 0;
  border-bottom:1px solid var(--border);
}

.info-row:last-child{border-bottom:none}
.info-row span{color:var(--muted)}

/* ===============================
  CARD THEME VARIANTS
================================ */

/* base enhancement */
.card{
  position:relative;
  overflow:hidden;
}

/* accent bar kiri */
.card::before{
  content:'';
  position:absolute;
  left:0;
  top:0;
  width:6px;
  height:100%;
  border-radius:6px 0 0 6px;
}

/* ===== CARD VARIANTS ===== */

/* Grafik */
.card.chart{
  box-shadow:0 12px 26px rgba(242,201,76,.25);
}
.card.chart::before{
  background:linear-gradient(180deg,var(--yellow-main),var(--yellow-deep));
}

/* Ringkasan */
.card.summary{
  box-shadow:0 10px 24px rgba(109,151,115,.22);
}
.card.summary::before{
  background:linear-gradient(180deg,var(--green-main),var(--green-deep));
}

/* Poin Bulanan */
.card.monthly{
  box-shadow:0 10px 24px rgba(242,201,76,.22);
}
.card.monthly::before{
  background:linear-gradient(180deg,var(--yellow-soft),var(--yellow-main));
}

/* Rata-rata */
.card.average{
  box-shadow:0 12px 26px rgba(62,107,78,.25);
}
.card.average::before{
  background:linear-gradient(180deg,var(--green-deep),var(--green-main));
}

.card.leaderboard::before{
  background:linear-gradient(180deg,#FFD700,#F2C94C);
}

.table-warning{
  font-weight:600;
}

@media (max-width:1100px){
      .cover{ width:98vw; height:94vh; padding:12px; flex-direction:column; overflow:auto }
      html,body{ overflow:auto } 
      .sidebar{ width:100%; flex-direction:row; overflow:auto }
      .col-right{ width:100%; order:3 }
      .body-row{ flex-direction:column; height:auto }
    }

</style>
</head>

<body>
<div class="cover">
<div class="sidebar" role="navigation" aria-label="Sidebar">
  <div class="brand">
    <div class="logo">Logo</div>
    <div>
      <div style="font-weight:700;font-family:'Poppins',sans-serif;">
        NAMA BIMBEL
      </div>
    </div>
  </div>
  <div class="navlink" onclick="location.href='dashboard.php'"><i class="bi bi-gear-fill"></i>Dashboard</div>
      <div class="navlink" onclick="location.href='kelas.php'"><i class="bi bi-people-fill"></i>Daftar Kelas</div>
      <div class="navlink" onclick="location.href='materi.php'"><i class="bi bi-people-fill"></i>Materi Belajar</div>
      <div class="navlink" onclick="location.href='quiz.php'"><i class="bi bi-journal-bookmark"></i>Latihan Soal</div>
      <div class="navlink active" onclick="location.href='laporan.php'"><i class="bi bi-calendar2-event"></i>Laporan Siswa</div>
      <div class="navlink" onclick="location.href='setting.php'"><i class="bi bi-gear-fill"></i>Pengaturan</div>
      <div class="sidebar-spacer"></div>
      <div style="margin-top:auto">
        <div class="quick-card">
          <strong>Quick Actions</strong>
          <button class="btn btn-sm mt-2" style="background:var(--yellow-deep);color:var(--dark)" onclick="window.location.href='materi.php'"> 📝 Lanjutkan Belajar </button>
        </div>
      </div>
  </div>
  <!-- MAIN -->
  <main class="main">
    <div class="content">

      <!-- ISI TETAP (TIDAK DIUBAH) -->
      <div class="card chart">
        <div class="title">Grafik Performa Belajar</div>
        <canvas id="reportChart" height="120"></canvas>
      </div>

      <div class="card summary">
        <div class="title">Ringkasan</div>
        <div class="info-row"><span>Total Soal</span><strong id="totalSoal"></strong></div>
        <div class="info-row"><span>Jawaban Benar</span><strong id="totalBenar"></strong></div>
        <div class="info-row"><span>Jawaban Salah</span><strong id="totalSalah"></strong></div>
      </div>

      <div class="card monthly">
        <div class="title">Poin Bulanan</div>
        <div id="monthlyPoints"></div>
      </div>

      <div class="card average">
        <div class="title">Rata-rata Poin</div>
        <div class="info-row">
          <span>Average Score</span>
          <strong id="avgPoint"></strong>
        </div>
      </div>

      <div class="card leaderboard">
        <div class="title">🏆 Leaderboard</div>

        <table class="table table-borderless">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Nama</th>
              <th>Total Poin</th>
            </tr>
          </thead>
          <tbody>
            <?php $rank = 1; ?>
            <?php foreach ($leaderboard as $row): ?>
              <tr class="<?= $row['id'] == $user_id ? 'table-warning' : '' ?>">
                <td><?= $rank ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><strong><?= $row['total_poin'] ?></strong></td>
              </tr>
              <?php $rank++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>

        <!-- Peringkat Kamu -->
        <div class="mt-3 text-center">
          <strong>📌 Peringkat kamu:</strong>
          <span class="badge bg-warning text-dark">
            #<?= $myRank ?? '-' ?>
          </span>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ===== DATA & CHART (ASLI) ===== */
const reportData = <?= json_encode($reportData); ?>;

totalSoal.innerText  = <?= $summary['total_soal'] ?? 0 ?>;
totalBenar.innerText = <?= $summary['total_benar'] ?? 0 ?>;
totalSalah.innerText = <?= $summary['total_salah'] ?? 0 ?>;

avgPoint.innerText = <?= round($avg['avg_score'] ?? 0) ?> + ' poin';

monthlyPoints.innerHTML = reportData.map(d => `
  <div class="info-row">
    <span>${d.month}</span>
    <strong>${d.points} poin</strong>
  </div>
`).join('');

new Chart(reportChart,{
  type:'line',
  data:{
    labels: reportData.map(d => d.month),
    datasets:[{
      data: reportData.map(d => d.points),
      tension:.4,
      fill:true,
      backgroundColor:'rgba(109,151,115,.15)',
      borderColor:'rgba(109,151,115,1)',
      pointRadius:0
    }]
  },
  options:{plugins:{legend:{display:false}}}
});
</script>

</body>
</html>