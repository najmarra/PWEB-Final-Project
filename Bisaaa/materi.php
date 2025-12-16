<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Materi Belajar</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root{
      /* =====================
        BASE
      ====================== */
      --bg: #F7F8F6;
      --glass: rgba(255,255,255,0.9);
      --border: #ECECEC;

      --dark: #0C3B2E;
      --muted: #6B7280;

      /* =====================
        YELLOW PASTEL (PRIMARY)
      ====================== */
      --yellow-soft: #FFF3C4;   /* hover / soft background */
      --yellow-main: #FFE08A;   /* primary pastel */
      --yellow-deep: #F2C94C;   /* accent / gradient */

      /* =====================
        GREEN (PAIR)
      ====================== */
      --green-soft: #E6F4EA;    /* background soft */
      --green-main: #6D9773;    /* primary green */
      --green-deep: #3E6B4E;    /* chart / emphasis */

      /* =====================
        STATUS
      ====================== */
      --red: #F87171;           /* soft danger */

      /* =====================
        SHADOW
      ====================== */
      --card-shadow: 0 8px 22px rgba(109,151,115,.15);
      --hover-shadow: 0 12px 26px rgba(109,151,115,.25);
    }

/* BASE */
html,body{
  height:100%;
  margin:0;
  overflow:auto;
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

/* FILTER */
.filter-bar button{
  border-radius:20px;
  font-size:13px;
}

.filter-bar button.active{
  background:var(--green-main);
  color:#fff;
  border:none;
}

/* MATERI GRID */
.materi-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
  gap:18px;
}

.materi-item{
  background:var(--yellow-deep);
  border-radius:16px;
  padding:14px;
  cursor:pointer;
  transition:.25s;
}

.materi-item:hover{
  background:var(--yellow-main);
}

.materi-thumb{
  height:110px;
  border-radius:12px;
  background:var(--green-soft);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:32px;
  margin-bottom:12px;
}

.materi-title{
  font-weight:600;
  font-size:15px;
}

.materi-meta{
  font-size:13px;
  color:#6B7280;
}

.materi-box .btn-success{
  color:black;
  background:var(--yellow-main);
  border-color:var(--yellow-main);
}

.materi-box .btn-success:hover{
  color:white;
  background:var(--green-main);
  border-color:var(--green-main);
}

/* VIDEO LIST */
.class-card{
  background:var(--green-deep);
  color: white; 
  border-radius:14px;
  padding:14px;
  margin-bottom:12px;
  cursor:pointer;
}

.class-card:hover{
  background:var(--green-main);
  color: var(----muted)
}

/* LIVE */
.live-card{
  min-width:220px;
  background:var(--yellow-deep);
  border-radius:14px;
  padding:12px;
  cursor:pointer;
  transition:.25s;
}

.live-card:hover{
  background:var(--yellow-main);
}

.live-thumb{
  height:90px;
  border-radius:10px;
  background:var(--dark);
  color:#fff;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:26px;
  margin-bottom:8px;
}

/* ZOOM */
.zoom-card{
  background:var(--green-main);
  border-radius:16px;
  padding:14px;
}

.zoom-card .btn-primary{
  color:black;
  background:var(--yellow-main);
  border-color:var(--yellow-main);
}

.zoom-card .btn-primary:hover{
  color:black;
  background:var(--yellow-soft);
  border-color:var(--yellow-soft);
}


/* POPUP MATERI */
.materi-reader{
  position:fixed;
  inset:0;
  background:rgba(12,59,46,.55);
  display:flex;
  align-items:center;
  justify-content:center;
  z-index:99;
}

.materi-box{
  position:relative;
  background:#fff;
  width:600px;
  max-height:80vh;
  padding:20px;
  border-radius:16px;
  overflow:auto;
}

.close-btn{
  position:absolute;
  top:10px;
  right:10px;
  border:none;
  background:none;
  font-size:20px;
}

#downloadLink{
  color:black;
  border-color:var(--green-main);
  transition:.25s;
}

#downloadLink:hover{
  color:#fff;                    
  background:var(--green-main);  
  border-color:var(--green-main);
}

.cardVideo{
  background:var(--yellow-main);
  border-radius:16px;
  display:flex;
  flex-direction:column;
  padding:20px;
  margin-bottom:20px;
  box-shadow:0 10px 25px rgba(214,178,76,.18);
}

#videoTitle{
  align-self:flex-start;
  text-align:left;
  width:100%;
}

/* =====================
   CUSTOM ACTION BUTTON
===================== */

button.btn.btn-warning.btn-action{
  background:linear-gradient(
    135deg,
    var(--green-deep),
    var(--green-deep)
  );
  color:white;
  border:none;
  border-radius:14px;
  padding:10px 45px;
  font-weight:600;
  transition:.25s;
}

/* hover */
button.btn.btn-warning.btn-action:hover{
  background:var(--green-soft);
  color:var(--dark);
  transform:translateY(-1px);
}

/* active */
button.btn.btn-warning.btn-action:active{
  transform:scale(.98);
}

/* focus */
button.btn.btn-warning.btn-action:focus{
  box-shadow:0 0 0 3px rgba(242,201,76,.35);
}

.cardVideo .button.btn.btn-warning.btn-action{
  align-self:center;
  margin-top:12px;
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
      <div class="navlink active" onclick="location.href='materi.php'"><i class="bi bi-people-fill"></i>Materi Belajar</div>
      <div class="navlink" onclick="location.href='quiz.php'"><i class="bi bi-journal-bookmark"></i>Latihan Soal</div>
      <div class="navlink" onclick="location.href='laporan.php'"><i class="bi bi-calendar2-event"></i>Laporan Siswa</div>
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

      <!-- TAB MATERI -->
      <div id="tab-materi">
        <div class="card">
          <h4>Materi Belajar</h4>

      <!-- TAB -->
      <div class="filter-bar mb-3">
        <button class="btn btn-sm btn-light active"
                data-tab="materi"
                onclick="showTab('materi')">Materi</button>

        <button class="btn btn-sm btn-light"
                data-tab="video"
                onclick="showTab('video')">Video</button>

        <button class="btn btn-sm btn-light"
                data-tab="live"
                onclick="showTab('live')">Live</button>
      </div>
        <div id="materiList" class="materi-grid"></div>
        </div>
      </div>

      <!-- TAB VIDEO -->
      <div id="tab-video" class="d-none">
        <div class="card">
          <h4>Materi Belajar</h4>

        <div class="filter-bar mb-3">
          <button class="btn btn-sm btn-light"
                  data-tab="materi"
                  onclick="showTab('materi')">Materi</button>

          <button class="btn btn-sm btn-light active"
                  data-tab="video"
                  onclick="showTab('video')">Video</button>

          <button class="btn btn-sm btn-light"
                  data-tab="live"
                  onclick="showTab('live')">Live</button>
        </div>

        <div class="row">
          <div class="col-4 video-list" id="videoList"></div>
          <div class="col-8">
            <div class="cardVideo">
              <div class="ratio ratio-16x9">
                <iframe id="videoPlayer" src="" allowfullscreen></iframe>
              </div>
              <h6 class="mt-2" id="videoTitle"></h6>
              <p id="videoDesc"></p>
              <button id="btnQuiz" class="btn btn-warning btn-action" style="display:none" onclick="window.location.href='quiz.php'"> Latihan Soal</button>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- TAB LIVE -->
      <!-- TAB LIVE -->
  <div id="tab-live" class="d-none">

  <!-- LIVE STREAMING -->
  <div class="card mb-4">
    <h4>Materi Belajar</h4>

      <div class="filter-bar mb-3">
        <button class="btn btn-sm btn-light"
                data-tab="materi"
                onclick="showTab('materi')">Materi</button>

        <button class="btn btn-sm btn-light"
                data-tab="video"
                onclick="showTab('video')">Video</button>

        <button class="btn btn-sm btn-light"
                data-tab="live"
                onclick="showTab('live') active">Live</button>
      </div>

    <h5 class="mb-3">🔴 Live Streaming</h5>

    <!-- VIDEO UTAMA -->
    <div class="ratio ratio-16x9 mb-3">
      <iframe id="livePlayer"
        src=""
        allowfullscreen></iframe>
    </div>

    <!-- LIST LIVE -->
    <div class="d-flex gap-3 overflow-auto pb-2" id="liveList">
      <!-- card live di render js -->
    </div>
  </div>

  <!-- ZOOM -->
  <div class="card">
    <h5 class="mb-3">🎥 Zoom Class</h5>

    <h6 class="text-muted mb-2">Sedang Berlangsung</h6>
    <div class="materi-grid mb-4" id="zoomLive"></div>

    <h6 class="text-muted mb-2">Terjadwal</h6>
    <div class="materi-grid" id="zoomUpcoming"></div>
  </div>

</div>

<!-- MATERI POPUP -->
<div id="materiReader" class="materi-reader d-none">
  <div class="materi-box">
    <button class="close-btn" onclick="closeMateri()">✖</button>
    <h5 id="materiTitle"></h5>
    <p id="materiContent"></p>

    <div class="d-flex justify-content-between mt-3">
      <button class="btn btn-success" onclick="goVideo()">Video Materi</button>
      <a id="downloadLink" class="btn btn-outline-primary" download>Download</a>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ===== DOM ===== */
const materiList   = document.getElementById('materiList');
const videoList    = document.getElementById('videoList');
const videoPlayer  = document.getElementById('videoPlayer');
const videoTitle   = document.getElementById('videoTitle');
const videoDesc    = document.getElementById('videoDesc');
const materiReader = document.getElementById('materiReader');
const materiTitle  = document.getElementById('materiTitle');
const materiContent= document.getElementById('materiContent');
const downloadLink = document.getElementById('downloadLink');

/* ===== LOAD MATERI DARI BACKEND ===== */
fetch("../api/materi_siswa.php")
  .then(res => res.json())
  .then(data => {
    renderMateri(data.pdf);
    renderVideo(data.video);
  })
  .catch(err => console.error(err));

/* ===== RENDER PDF ===== */
function renderMateri(list){
  materiList.innerHTML = "";

  if(list.length === 0){
    materiList.innerHTML = "<div class='text-muted'>Belum ada materi</div>";
    return;
  }

  list.forEach(m=>{
    materiList.innerHTML += `
      <div class="materi-item" onclick='openMateri(${JSON.stringify(m)})'>
        <div class="materi-thumb">📄</div>
        <div class="materi-title">${m.judul}</div>
      </div>
    `;
  });
}

/* ===== RENDER VIDEO ===== */
function renderVideo(list){
  videoList.innerHTML = "";

  list.forEach(v=>{
    videoList.innerHTML += `
      <div class="class-card"
           onclick="playVideo('${extractDriveId(v.file)}','${v.judul}')">
        <strong>${v.judul}</strong>
      </div>
    `;
  });
}

/* ===== OPEN MATERI ===== */
function openMateri(m){
  materiReader.classList.remove("d-none");
  materiTitle.innerText = m.judul;

  if(m.jenis === 'pdf'){
    materiContent.innerHTML = `
      <iframe src="../${m.file}" width="100%" height="450"></iframe>
    `;
    downloadLink.href = "../" + m.file;
    downloadLink.classList.remove("d-none");
  } else {
    materiContent.innerHTML = `
      <iframe src="${convertDriveLink(m.file)}"
              width="100%" height="450"
              allowfullscreen></iframe>
    `;
    downloadLink.classList.add("d-none");
  }
}

function closeMateri(){
  materiReader.classList.add("d-none");
}

/* ===== VIDEO PLAYER ===== */
function playVideo(id,title){
  showTab('video');
  videoPlayer.src = `https://www.youtube.com/embed/${id}`;
  videoTitle.innerText = title;
}

/* ===== UTIL ===== */
function extractDriveId(link){
  const id = link.match(/\/d\/(.*?)\//);
  return id ? id[1] : "";
}

function convertDriveLink(link){
  const id = link.match(/\/d\/(.*?)\//);
  return id
    ? `https://drive.google.com/file/d/${id[1]}/preview`
    : link;
}
</script>
</body>
</html>