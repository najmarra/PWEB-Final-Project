<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin — Cover Dashboard (Single Page)</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Bootstrap & Icons -->
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


   /* ===============================
   GLOBAL
    ================================ */
    html,body{
      height:100%;
      margin:0;
      overflow:hidden;
      font-family:'Roboto',system-ui,Arial;
      background:var(--dark);
    }

    /* ===============================
      CONTAINER
    ================================ */
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

    /* ===============================
      MAIN AREA
    ================================ */
    .main{
      flex:1;
      display:flex;
      flex-direction:column;
      gap:14px;
      min-width:0;
    }

    .topbar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
    }

    .searchbox{ width:48%; min-width:200px }

    .top-actions{
      display:flex;
      gap:8px;
      align-items:center;
    }

    .top-actions .avatar{
      width:36px;
      height:36px;
      border-radius:50%;
      overflow:hidden;
      padding:0;
      border:none;
      background:none;
    }

    .top-actions .avatar img{
      width:100%;
      height:100%;
      object-fit:cover;
    }

    /* ===============================
      HERO (HEIGHT & PADDING AMAN)
    ================================ */
    .hero{
      height:200px;
      border-radius:18px;
      padding:18px 22px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      background:linear-gradient(135deg,var(--yellow-main),var(--yellow-deep));
      color:#1f2937;
      box-shadow:0 12px 30px rgba(0,0,0,.08);
    }

    .hero h2{
      font-family:'Poppins',sans-serif;
      margin:6px 0;
      font-size:20px;
    }

    .hero-content{ max-width:60% }

    /* ===============================
      CARD & PANEL
    ================================ */
    .panel,
    .widget,
    .stat-card{
      background:#fff;
      border-radius:12px;
      padding:12px;
      box-shadow:0 8px 22px rgba(214,178,76,.18);
    }

    .panel{
      overflow:hidden;
      display:flex;
      flex-direction:column;
    }

    .panel .body{
      overflow:auto;
      padding-right:8px;
      flex:1;
    }

    /* ===============================
      COURSE ITEM
    ================================ */
    .course-item{
      display:flex;
      align-items:center;
      gap:10px;
      padding:7px;
      border-radius:10px;
      background:#fbfbfb;
      border:1px solid var(--border);
      margin-bottom:8px;
      transition:box-shadow .25s ease;
    }

    .course-item:hover{
      box-shadow:0 12px 26px rgba(214,178,76,.25);
    }

    .badge-thumb{
      width:52px;
      height:48px;
      border-radius:8px;
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:700;
      font-size:18px;
      background:linear-gradient(135deg,var(--yellow-main),var(--yellow-deep));
      color:#1f2937;
    }

    /* ===============================
      INTERACTIVE (TANPA GESER)
    ================================ */
    .stat-card.interactive{
      cursor:pointer;
      transition:box-shadow .25s ease;
    }

    .stat-card.interactive:hover{
      box-shadow:0 12px 26px rgba(0,0,0,.18);
      transform:none;
    }

    /* ===============================
      ISI DALAM CARD
    ================================ */
    .stat-row{
      display:flex;
      align-items:center;
      gap:8px;
      width:100%;
    }

    /* ANGKA BESAR */
    .stat-number{
      font-size:28px;
      font-weight:700;
      line-height:1.1; /* KUNCI: setara 2 baris teks */
      flex-shrink:0;
    }

    /* TEXT 2 BARIS */
    .stat-text{
      display:flex;
      flex-direction:column;
      justify-content:center;

      font-size:13px;
      line-height:1.2;
    }

    .activity-stats{
      display:grid;
      grid-template-columns: repeat(2, 1fr);
      gap:10px;
    }

    /* MATIKAN SEMUA GERAK */
    .activity-stats .stat-card,
    .activity-stats .stat-card:hover,
    .activity-stats .stat-card:active{
      transform:none !important;
    }

    /* ===============================
      STAT CARD
    ================================ */
    .stat-card{
      border-radius:18px;
      padding:10px 16px;
      min-height:0px;
      display:flex;
      align-items:center;
      margin:0 auto;
      max-width: 150px;
      box-sizing:border-box;
    }

    /* warna tetap */
    .stat-card.yellow{
      background:linear-gradient(135deg,var(--yellow-main),var(--yellow-deep));
      color:#1f2937;
    }

    .stat-card.red{
      background:linear-gradient(135deg,#FB6B5F,#E85A4F);
      color:#fff;
    }

    button.btn-sm.btn-outline-secondary.btn-action:hover{
      background:var(--green-main);
      color:var(--green-soft);
      transform:translateY(-1px);
    }

    .chart-card.interactive{
      cursor:pointer;
      transition:box-shadow .25s ease;
    }

    .chart-card.interactive:hover{
      box-shadow:0 12px 26px rgba(0,0,0,.18);
      transform:none;
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
  <div class="cover" role="application" aria-label="Siswa cover dashboard">
  <div class="sidebar" role="navigation" aria-label="Sidebar">
  <div class="brand">
    <div class="logo">Logo</div>
    <div>
      <div style="font-weight:700;font-family:'Poppins',sans-serif;">
        NAMA BIMBEL
      </div>
    </div>
  </div>
  <div class="navlink active" onclick="location.href='dashboard.php'"><i class="bi bi-gear-fill"></i>Dashboard</div>
      <div class="navlink" onclick="location.href='kelas.php'"><i class="bi bi-people-fill"></i>Daftar Kelas</div>
      <div class="navlink" onclick="location.href='materi.php'"><i class="bi bi-people-fill"></i>Materi Belajar</div>
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
    <div class="main" role="main">
      <!-- topbar -->
      <div class="topbar">
        <div class="searchbox">
          <div class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input class="form-control" id="searchInput" placeholder="Cari materimu di sini!">
          </div>
        </div>

        <div class="top-actions">
          <button class="btn btn-light" title="Messages"><i class="bi bi-envelope"></i></button>
          <button class="btn btn-light position-relative" title="Notifications"><i class="bi bi-bell"></i><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background:var(--yellow); color:#0C3B2E">3</span></button>
          <div class="dropdown">
              <div class="avatar dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                <img src="https://tse2.mm.bing.net/th/id/OIP.Wb-rNKmADPns03uPU_4nvgHaHa?pid=Api&P=0&h=220"
                    alt="admin">
              </div>

              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" onclick="window.location.href='setting.php'">⚙️ Pengaturan</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item text-danger" id="logoutBtn" href="#">🚪 Logout</a>
                </li>
              </ul>
            </div>
        </div>
      </div>

      <!-- HERO -->
      <div class="hero hero-illustration" id="overview">
        <div class="hero-content">

          <h2>
            Selamat Datang, <strong><?= $_SESSION['name']; ?></strong> 👋 👋
          </h2>

          <p>
            Mau belajar apa hari ini?  
            Yuk tingkatkan skill kamu bersama kami 🚀
          </p>
        </div>
      </div>


      <!-- DASHBOARD ROW (Popular / Activity / Leaderboard) -->
      <div style="display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:16px;margin-top:14px; flex: 1; min-height: 0;">

        <!-- POPULAR COURSES (MATA PELAJARAN SMA) -->
        <div class="panel courses">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
            <div style="font-weight:700;font-family:'Poppins',sans-serif">
              Materi Belajar
            </div>
            <a href="#" class="small" style="color:var(--green);text-decoration:none" onclick="window.location.href='materi.php'">Semua</a>
          </div>

        <div class="body">
          <div class="course-item">
            <div class="badge-thumb" style="background:#FFC107">M</div>
            <div style="flex:1">
              <div style="font-weight:600">Matematika</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>

          <div class="course-item">
            <div class="badge-thumb" style="background:#4FB6A3">F</div>
            <div style="flex:1">
              <div style="font-weight:600">Fisika</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>

          <div class="course-item">
            <div class="badge-thumb" style="background:#FF6B5F">B</div>
            <div style="flex:1">
              <div style="font-weight:600">Bahasa Indonesia</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>

          <div class="course-item">
            <div class="badge-thumb" style="background:#4FB6A3">E</div>
            <div style="flex:1">
              <div style="font-weight:600">Bahasa Inggris</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>

          <div class="course-item">
            <div class="badge-thumb" style="background:#FF6B5F">M</div>
            <div style="flex:1">
              <div style="font-weight:600">Informatika</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>

          <div class="course-item">
            <div class="badge-thumb" style="background:#FFC107">M</div>
            <div style="flex:1">
              <div style="font-weight:600">Biologi</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>

          <div class="course-item">
            <div class="badge-thumb" style="background:#4FB6A3">M</div>
            <div style="flex:1">
              <div style="font-weight:600">Kimia</div>
              <div class="small-muted">Kelas XII</div>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-action">Lihat</button>
          </div>
          </div>
        </div>

        <!-- CURRENT ACTIVITY -->
        <div class="panel current-activity">
          <div style="font-weight:700; margin-bottom:8px">Current Activity</div>

          <!-- CARD GRAFIK -->
          <div class="chart-card interactive" onclick="window.location.href='laporan.php'">
            <div class="chart-title">
              <div style="font-weight:600; font-size:12px">Monthly Progress</div>
              <div style="font-size:10px; opacity:0.85">This is the latest improvement</div>
            </div>

            <div class="chart-box">
              <canvas id="chartActivity"></canvas>
            </div>
          </div>

          <!-- CARD BAWAH -->
          <div class="activity-stats">

            <div class="stat-card yellow interactive" onclick="window.location.href='quiz.php'">
              <div class="stat-row">
                <div class="stat-number">45</div>
                <div class="stat-text">
                  <div>Quiz</div>
                  <div>Selesai</div>
                </div>
              </div>
            </div>

            <div class="stat-card red interactive" onclick="window.location.href='materi.php'">
              <div class="stat-row">
                <div class="stat-number">20</div>
                <div class="stat-text">
                  <div>Video</div>
                  <div>Materi</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- LEADERBOARD SISWA -->
        <div class="panel leaderboard">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
            <div style="font-weight:700;font-family:'Poppins',sans-serif">Leaderboard</div>
            <a href="#" class="small" style="color:var(--green);text-decoration:none" onclick="window.location.href='laporan.php'">Semua</a>
          </div>
          
          <div class="body">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Alya</div>
              <div class="small-muted">1200 poin</div>
            </div>
            <span class="badge bg-success">#1</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=2" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Rizky</div>
              <div class="small-muted">1100 poin</div>
            </div>
            <span class="badge bg-success">#2</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px">
            <img src="https://i.pravatar.cc/40?img=3" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Nabila</div>
              <div class="small-muted">980 poin</div>
            </div>
            <span class="badge bg-success">#3</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Naufa</div>
              <div class="small-muted">975 poin</div>
            </div>
            <span class="badge bg-secondary">#4</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Dani</div>
              <div class="small-muted">950 poin</div>
            </div>
            <span class="badge bg-secondary">#5</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Megan</div>
              <div class="small-muted">947 poin</div>
            </div>
            <span class="badge bg-secondary">#6</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Naura</div>
              <div class="small-muted">933 poin</div>
            </div>
            <span class="badge bg-secondary">#7</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Bagas</div>
              <div class="small-muted">916 poin</div>
            </div>
            <span class="badge bg-secondary">#8</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Linda</div>
              <div class="small-muted">901 poin</div>
            </div>
            <span class="badge bg-secondary">#9</span>
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
            <img src="https://i.pravatar.cc/40?img=1" style="width:36px;height:36px;border-radius:8px">
            <div style="flex:1">
              <div style="font-weight:600">Mahda</div>
              <div class="small-muted">899 poin</div>
            </div>
            <span class="badge bg-secondary">#10</span>
          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
      /* ======================
        ACTIVITY CHART
      ====================== */
      const act = document.getElementById('chartActivity');
      if (act) {
        new Chart(act, {
          type:'line',
          data:{
            labels:['Jan','Feb','Mar','Apr','May','Jun'],
            datasets:[{
              data:[12,18,9,24,18,30],
              tension:0.4,
              fill:true,
              backgroundColor:'rgba(109,151,115,0.12)',
              borderColor:'rgba(109,151,115,1)',
              pointRadius:0
            }]
          },
          options:{
            plugins:{ legend:{display:false} },
            scales:{
              y:{ min:0, max:60, display:false },
              x:{ grid:{display:false} }
            },
            maintainAspectRatio:false
          }
        });
      }

      /* ======================
        LOGOUT
      ====================== */
      document.getElementById('logoutBtn')?.addEventListener('click', e => {
        e.preventDefault();
        if(confirm('Yakin ingin logout?')){
          window.location.href = 'logout.php';
        }
      });

      /* ======================
        SEARCH
      ====================== */
      const searchInput = document.getElementById('searchInput');
      searchInput?.addEventListener('input', () => {
        const keyword = searchInput.value.toLowerCase();

        document.querySelectorAll('.course-item').forEach(item=>{
          item.style.display = item.innerText.toLowerCase().includes(keyword) ? '' : 'none';
        });

        document.querySelectorAll('.leaderboard .body > div').forEach(row=>{
          row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
        });
      });
      </script>
</body>
</html>

