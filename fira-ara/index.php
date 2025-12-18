<?php
session_start();
date_default_timezone_set("Asia/Jakarta");

if (
    !isset($_SESSION['login']) ||
    $_SESSION['login'] !== true ||
    $_SESSION['role'] !== 'mentor'
) {
    header("Location: login.php");
    exit;
}

// data mentor aman
$namaMentor = $_SESSION['mentor_nama'];

// ================= KONEKSI =================
require "config/koneksi.php";

// ================= DATA NILAI =================
$stmtNilai = $pdo->prepare("
  SELECT
    u.name,
    qa.sub_bab,
    qa.score,
    qa.created_at
  FROM quiz_attempts qa
  JOIN users u ON qa.user_id = u.id
  ORDER BY qa.created_at DESC
");
$stmtNilai->execute();
$dataNilai = $stmtNilai->fetchAll();

// ================= LEADERBOARD =================
$stmtLeaderboardGuru = $pdo->prepare("
  SELECT
    u.id,
    u.name,
    SUM(qa.score) AS total_poin
  FROM quiz_attempts qa
  JOIN users u ON qa.user_id = u.id
  GROUP BY qa.user_id
  ORDER BY total_poin DESC
");
$stmtLeaderboardGuru->execute();
$leaderboardGuru = $stmtLeaderboardGuru->fetchAll();

$jam = date("H");
if ($jam < 11) {
  $salam = "Selamat Pagi";
} elseif ($jam < 15) {
  $salam = "Selamat Siang";
} elseif ($jam < 18) {
  $salam = "Selamat Sore";
} else {
  $salam = "Selamat Malam";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>E-Learning Mentor</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
</head>


<body>
    <aside class="sidebar">
      <div class="sidebar-brand">
        <img src="logo.png" alt="Logo" class="sidebar-logo">
        <span class="sidebar-title">Mentor</span>
      </div>

      <ul>
      <li class="active" onclick="openPage('dashboard', this)">Dashboard</li>
      <li onclick="openPage('materi', this)">Materi</li>
      <li onclick="openPage('quiz', this)">Kuis</li>
      <li onclick="openPage('nilai', this)">Nilai</li>
      <li onclick="openPage('zoom', this)">Zoom</li>
      <li onclick="openPage('settings', this)">Setelan</li>
    </ul>
  </aside>

  <main>
    <!-- DASHBOARD -->
    <section id="dashboard" class="page active">
    <div class="card hero">
      <h3>
        👋 <?= $salam ?>, <strong><?= htmlspecialchars($namaMentor) ?></strong>
      </h3>

      <p class="text-muted">Semoga aktivitas mengajar hari ini berjalan lancar 🚀</p>
    </div>

    <div class="dashboard-grid">
      <div class="profile-card">
        <h3>Profil Mentor</h3>
        <table class="info-table">
          <tr><td>ID Mentor</td><td id="id"></td></tr>
          <tr><td>Nama</td><td id="nama"></td></tr>
          <tr><td>Jenis Kelamin</td><td id="jk"></td></tr>
          <tr><td>Email</td><td id="email"></td></tr>
          <tr><td>No Telp</td><td id="telp"></td></tr>
          <tr><td>Tgl Lahir</td><td id="ttl"></td></tr>
        </table>
      </div>

      <div class="teaching-info">
        <h3>Informasi Mengajar</h3>

        <div class="teach-item">
          <span>Jadwal</span>
          <p id="jadwal">-</p>
        </div>

        <div class="teach-item">
          <span>Mata Pelajaran</span>
          <p id="mapel">-</p>
        </div>

        <div class="teach-item">
          <span>Kelas</span>
          <p id="kelas">-</p>
        </div>
      </div>
    </div>

      <!-- STATISTIK -->
      <div class="stats-row">
        <div class="stat-card">
          <p>Total Materi</p>
          <h2 id="totalMateri">0</h2>
        </div>

        <div class="stat-card">
          <p>Total Kuis</p>
          <h2 id="totalKuis">0</h2>
        </div>

        <div class="stat-card">
          <p>Total Siswa</p>
          <h2 id="totalSiswa">0</h2>
        </div>
      </div>
    </section>

    <!-- MATERI -->
    <section id="materi" class="page">
      <div class="header-bar search-bar">
        <input
          type="text"
          placeholder="Cari judul / data..."
          onkeyup="searchTable(this)"
        />
      </div>

      <div class="card">
        <h3>Unggah Materi</h3>

        <div class="form-grid">
          <input id="judul" placeholder="Judul Materi" />
          <select id="jenis">
            <option value="pdf">PDF</option>
            <option value="video">Video Drive</option>
          </select>
        </div>

        <br />

        <div class="form-grid">
          <input type="text" id="deskripsi" placeholder="Deskripsi singkat materi" />
          <input id="video" placeholder="Link Google Drive" />
          <div></div>
        </div>

        <br />

        <div class="form-grid">
          <input type="file" id="file" />
        </div>

        <br />

        <button class="btn-add" onclick="uploadMateri()">
          Simpan Materi
        </button>
      </div>

      <div class="table-wrap">
        <div class="table-title">Daftar Materi</div>
        <table>
         <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Jenis</th>
            <th>Aksi</th>
          </tr>
          <tbody id="materiBody"></tbody>
        </table>
      </div>
    </section>

    <!-- QUIZ -->
    <section id="quiz" class="page">
      <div class="header-bar search-bar">
        <input
          type="text"
          placeholder="Cari judul / data..."
          onkeyup="searchTable(this)"
        />
      </div>

      <div class="quiz-card">
        <h3>Buat Kuis</h3>

        <div class="form-group">
          <label>Materi</label>
          <input type="text" id="sub" placeholder="Contoh: Sistem Pencernaan">
        </div>

        <div class="form-group">
          <label>Pertanyaan</label>
          <textarea id="q" rows="3" placeholder="Tuliskan pertanyaan..."></textarea>
        </div>

        <div class="option-grid">
          <div class="form-group">
            <label>Opsi A</label>
            <input id="a">
          </div>
          <div class="form-group">
            <label>Opsi B</label>
            <input id="b">
          </div>
          <div class="form-group">
            <label>Opsi C</label>
            <input id="c">
          </div>
          <div class="form-group">
            <label>Opsi D</label>
            <input id="d">
          </div>
        </div>

        <div class="form-footer">
          <div class="form-group">
            <label>Jawaban Benar</label>
            <select id="jawaban">
              <option>A</option>
              <option>B</option>
              <option>C</option>
              <option>D</option>
            </select>
          </div>

          <button class="btn-save" onclick="simpanQuiz()">Simpan Kuis</button>
        </div>
      </div>

      <div class="table-wrap">
        <div class="table-title">Daftar Kuis</div>
        <table>
          <tr>
            <th>No</th>
            <th>Sub Bab</th>
            <th>Pertanyaan</th>
            <th>Aksi</th>
          </tr>
          <tbody id="quizBody"></tbody>
        </table>
      </div>
    </section>

    <!-- NILAI -->
    <section id="nilai" class="page">
      <div id="nilaiContainer"></div>
      <div class="header-bar search-bar">
        <input
          type="text"
          placeholder="Cari judul / data..."
          onkeyup="searchTable(this)"
        />
      </div>

      <div class="table-wrap">
        <div class="table-title">Nilai & Ranking Siswa</div>
        <table>
          <tr>
            <th>Peringkat</th>
            <th>Nama</th>
            <th>Materi</th>
            <th>Nilai</th>
          </tr>
          <tbody id="nilaiBody"></tbody>
        </table>
      </div>
    </section>

    <!-- ZOOM -->
    <section id="zoom" class="page">
      <div class="zoom-wrapper">

        <!-- LIVE -->
        <div class="zoom-card">
          <div class="zoom-icon">🔴</div>
          <h3>Live Sekarang</h3>
          <p>Mulai kelas Zoom langsung sekarang</p>
          <button class="btn-zoom live" onclick="startLiveZoom()">
            ▶ Live Sekarang
          </button>
        </div>

        <!-- SCHEDULE -->
        <div class="zoom-card">
          <div class="zoom-icon">📅</div>
          <h3>Jadwalkan Zoom</h3>

          <input type="text" id="zoom_title" placeholder="Judul kelas">
          <input type="datetime-local" id="zoom_time">
          <input type="number" id="zoom_duration" placeholder="Durasi (menit)" value="60">

          <button class="btn-zoom schedule" onclick="scheduleZoom()">
            📅 Simpan Jadwal
          </button>

          <div id="scheduleResult"></div>
        </div>

      </div>
    </section>

    <!-- SETTINGS -->
    <section id="settings" class="page">
      <div class="card">
        <h3>Edit Profil Mentor</h3>
        
        <div class="form-group">
          <label>Nama</label>
          <input type="text" id="s_nama">
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" id="s_email">
        </div>

        <div class="form-group">
          <label>No Telp</label>
          <input type="text" id="s_telp">
        </div>

        <div class="form-group">
          <label>Tgl Lahir</label>
          <input type="date" id="s_tgl_lahir">
        </div>

        <div class="form-group">
          <label>Jadwal Mengajar</label>
          <input type="text" id="s_jadwal">
        </div>

        <div class="form-group">
          <label>Mata Pelajaran</label>
          <input type="text" id="s_mapel">
        </div>

        <div class="form-group">
          <label>Kelas</label>
          <input type="text" id="s_kelas">
        </div>

        <div class="form-group">
          <label>Password <small>(kosongkan jika tidak ingin diganti)</small></label>
          <input type="password" id="s_password">
        </div>

        <button class="btn-save" onclick="simpanSettings()">Simpan Perubahan</button>
      </div>
    </section>

    <!-- QUIZ DETAIL MODAL -->
    <div id="quizModal" class="quiz-modal">
      <div class="quiz-box">
        <div class="quiz-header">
          <h3>Detail Soal</h3>
          <span class="close-btn" onclick="closeQuiz()">×</span>
        </div>

        <div class="quiz-content">
          <p id="qText" class="quiz-question"></p>

          <ul class="quiz-options">
            <li id="optA"></li>
            <li id="optB"></li>
            <li id="optC"></li>
            <li id="optD"></li>
          </ul>

          <div id="jawabanBenar" class="quiz-answer"></div>
        </div>
      </div>
    </div>

  </main>


<script>
document.addEventListener("DOMContentLoaded", () => {

  // ================== ELEMENT ==================
  const materiBody = document.getElementById("materiBody");
  const quizBody   = document.getElementById("quizBody");
  const nilaiBody  = document.getElementById("nilaiBody");

  const quizModal = document.getElementById("quizModal");
  const qText = document.getElementById("qText");
  const optA = document.getElementById("optA");
  const optB = document.getElementById("optB");
  const optC = document.getElementById("optC");
  const optD = document.getElementById("optD");
  const jawabanBenar = document.getElementById("jawabanBenar");
  
  // ================== NAVIGATION ==================
  window.openPage = function(id, el) {
    document.querySelectorAll(".page").forEach(p => p.classList.remove("active"));
    document.getElementById(id)?.classList.add("active");

    document.querySelectorAll(".sidebar li").forEach(li => li.classList.remove("active"));
    el.classList.add("active");
  };

  // ================== DASHBOARD ==================
  fetch("api/dashboard.php")
    .then(res => res.json())
    .then(d => {
      totalMateri.innerText = d.materi;
      totalKuis.innerText  = d.kuis;
      totalSiswa.innerText = d.siswa;
    });

  fetch("api/mentor_profile.php")
    .then(res => res.json())
    .then(d => {
      document.getElementById("id").innerText = d.id ?? "-";
      document.getElementById("nama").innerText = d.nama ?? "-";
      document.getElementById("jk").innerText = d.jk ?? "-";
      document.getElementById("email").innerText = d.email ?? "-";
      document.getElementById("telp").innerText = d.telp ?? "-";
      document.getElementById("ttl").innerText = d.tgl_lahir ?? "-";
      document.getElementById("jadwal").innerText = d.jadwal ?? "-";
      document.getElementById("mapel").innerText = d.mapel ?? "-";
      document.getElementById("kelas").innerText = d.kelas ?? "-";
    });

  // ================== MATERI ==================
  window.loadMateri = function () {
    fetch("api/materi_list.php")
      .then(r => r.json())
      .then(d => {
        materiBody.innerHTML = ""; // kosongkan tbody

        if (!d.length) {
          materiBody.innerHTML = `<tr><td colspan="5" class="text-muted">Belum ada materi.</td></tr>`;
          return;
        }

        d.forEach((m, i) => {
          // pastikan file ada
          const fileUrl = m.file ? m.file : "#";

          // buat kolom jenis klikable
          const jenisHtml = m.jenis === "pdf"
            ? `<a href="${fileUrl}" target="_blank" class="badge-pdf">PDF</a>`
            : `<a href="${fileUrl}" target="_blank" class="badge-video">VIDEO</a>`;

          materiBody.innerHTML += `
            <tr>
              <td>${i + 1}</td>
              <td>${m.judul}</td>
              <td class="text-muted">${m.deskripsi || '-'}</td>
              <td>${jenisHtml}</td>
              <td>
                <button onclick="hapusMateri(${m.id})">🗑</button>
              </td>
            </tr>
          `;
        });
      })
      .catch(err => {
        console.error(err);
        materiBody.innerHTML = `<tr><td colspan="5">Gagal memuat data materi.</td></tr>`;
      });
  };
  loadMateri();

  window.uploadMateri = function () {
  const judul     = document.getElementById("judul");
  const deskripsi = document.getElementById("deskripsi");
  const jenis     = document.getElementById("jenis");
  const file      = document.getElementById("file");
  const video     = document.getElementById("video");

  const form = new FormData();
  form.append("judul", judul.value);
  form.append("deskripsi", deskripsi.value);
  form.append("jenis", jenis.value);

  if (jenis.value === "pdf") {
    if (!file.files.length) {
      alert("Pilih file PDF");
      return;
    }
    form.append("file", file.files[0]);
  } else {
    if (video.value.trim() === "") {
      alert("Masukkan link Google Drive");
      return;
    }
    form.append("video", video.value.trim());
  }

  fetch("api/materi_add.php", {
    method: "POST",
    body: form
  })
  .then(r => r.json())
  .then(res => {
    console.log(res);
    if (res.error) {
      alert(res.error);
      return;
    }
    alert("Materi berhasil ditambahkan");
    loadMateri();
  })
  .catch(err => {
    console.error(err);
    alert("Gagal upload materi");
  });
};

  // ================== QUIZ ==================
  window.loadQuiz = function () {
    fetch("api/quiz_list.php")
      .then(r=>r.json())
      .then(d=>{
        quizBody.innerHTML="";
        d.forEach((q,i)=>{
          quizBody.innerHTML+=`
           <tr onclick="lihatQuiz(${q.id})">
              <td>${i+1}</td>
              <td>${q.sub_bab}</td>
              <td>${q.pertanyaan}</td>
              <td>
                <button onclick="hapusQuiz(${q.id});event.stopPropagation()">🗑</button>
              </td>
            </tr>`;
        });
      });
  };
  loadQuiz();

  window.lihatQuiz = function(id){
    fetch("api/quiz_detail.php?id=" + id)
      .then(r => r.json())
      .then(q => {
        qText.innerText = q.pertanyaan;

        optA.innerText = "A. " + q.a;
        optB.innerText = "B. " + q.b;
        optC.innerText = "C. " + q.c;
        optD.innerText = "D. " + q.d;

        jawabanBenar.innerText = "Jawaban Benar: " + q.jawaban;

        quizModal.style.display = "flex"; 
      })
      .catch(err => {
        alert("Gagal memuat detail quiz");
        console.error(err);
      });
  };

  window.closeQuiz = function(){
    quizModal.style.display="none";
  };

  window.simpanQuiz = function () {
    const data = new URLSearchParams({
      sub: sub.value,
      q: q.value,
      a: a.value,
      b: b.value,
      c: c.value,
      d: d.value,
      jawaban: jawaban.value
    });

    fetch("api/quiz_add.php", {
      method: "POST",
      body: data
    })
    .then(r => r.json())
    .then(res => {
      if(res.error){
        alert("Gagal simpan: " + res.error);
        return;
      }
      alert("Kuis berhasil disimpan");
      loadQuiz();
    });

  };

  window.hapusQuiz = function (id) {
    if (!confirm("Hapus kuis ini?")) return;
    fetch("api/quiz_delete.php?id=" + id)
      .then(() => loadQuiz());
  };

// ================== NILAI ==================
fetch("api/nilai_list.php") // sesuaikan path
  .then(res => res.json())
  .then(data => {
    const tbody = document.getElementById("nilaiBody");
    tbody.innerHTML = "";

    if(!data.length){
      tbody.innerHTML = `<tr><td colspan="4" class="text-muted">Belum ada data nilai.</td></tr>`;
      return;
    }

    // urutkan dulu per sub_bab, lalu berdasarkan score DESC
    const grouped = {};
    data.forEach(item => {
      if(!grouped[item.sub_bab]) grouped[item.sub_bab] = [];
      grouped[item.sub_bab].push(item);
    });

    for(const sub_bab in grouped){
      // urutkan tiap sub_bab berdasarkan nilai DESC
      grouped[sub_bab].sort((a,b)=>b.nilai - a.nilai);

      grouped[sub_bab].forEach((n,i)=>{
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${i+1}</td>
          <td>${n.nama}</td>
          <td>${sub_bab}</td>
          <td>${n.nilai}</td>
        `;
        tbody.appendChild(tr);
      });
    }
  })
  .catch(err => {
    console.error("Gagal memuat data nilai:", err);
    document.getElementById("nilaiBody").innerHTML = `<tr><td colspan="4">Gagal memuat data.</td></tr>`;
  });

  // ================== SEARCH ==================
  window.searchTable = function (input) {
    const filter = input.value.toLowerCase();
    const rows = input.closest("section").querySelectorAll("tbody tr");

    rows.forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(filter)
        ? ""
        : "none";
    });
  };

  // ================== ZOOM ==================
window.startZoom = function () {
  fetch("api/zoom_create.php", {
    method: "POST"
  })
  .then(r => r.json())
  .then(d => {
    if (d.error) {
      alert(d.error);
      return;
    }
    window.open(d.start_url, "_blank");
  });
};


window.startLiveZoom = function(){
  fetch("api/zoom_create.php", { method:"POST" })
    .then(r=>r.json())
    .then(d=>{
      if(d.error) return alert(d.error);
      window.open(d.start_url,"_blank");
    });
};

window.scheduleZoom = function(){
  const title = document.getElementById("zoom_title").value;
  const time  = document.getElementById("zoom_time").value;
  const dur   = document.getElementById("zoom_duration").value;

  if(!title || !time){
    alert("Judul dan waktu wajib diisi");
    return;
  }

  fetch("api/zoom_schedule.php",{
    method:"POST",
    body:new URLSearchParams({
      title:title,
      start_time:time,
      duration:dur
    })
  })
  .then(r=>r.json())
  .then(d=>{
    if(d.error) return alert(d.error);
    document.getElementById("scheduleResult").innerHTML =
      "✅ Jadwal Zoom berhasil dibuat";
  });
};


  // ================== SETTINGS ==================
  window.loadSettings = function(){
    fetch("api/mentor_profile.php")
      .then(res=>res.json())
      .then(d=>{
        document.getElementById("s_nama").value      = d.nama ?? "";
        document.getElementById("s_email").value     = d.email ?? "";
        document.getElementById("s_telp").value      = d.telp ?? "";
        document.getElementById("s_tgl_lahir").value = d.tgl_lahir ?? "";
        document.getElementById("s_jadwal").value    = d.jadwal ?? "";
        document.getElementById("s_mapel").value     = d.mapel ?? "";
        document.getElementById("s_kelas").value     = d.kelas ?? "";
        document.getElementById("s_password").value  = "";
      });
  };
  loadSettings();

  window.simpanSettings = function(){
    const data = new URLSearchParams({
      nama: document.getElementById("s_nama").value,
      email: document.getElementById("s_email").value,
      password: document.getElementById("s_password").value,
      telp: document.getElementById("s_telp").value,
      tgl_lahir: document.getElementById("s_tgl_lahir").value,
      jadwal: document.getElementById("s_jadwal").value,
      mapel: document.getElementById("s_mapel").value,
      kelas: document.getElementById("s_kelas").value
    });

    fetch("api/mentor_update.php", {
      method: "POST",
      body: data
    })
    .then(res=>res.json())
    .then(res=>{
      if(res.error){
        alert("Gagal update: " + res.error);
        return;
      }
      alert("Profil berhasil diperbarui");
      loadSettings();
    })
    .catch(err=>{
      console.error(err);
      alert("Gagal menyimpan profil");
    });
  };

});
</script>
</body>
</html>