    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header("Location: ../auth/login.php");
      exit;
    }?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <title>Daftar Kelas</title>

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP & ICON -->
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

    /* ================= GLOBAL ================= */
    html,body{
    height:100%;
    margin:0;
    overflow:hidden;
    font-family:'Roboto',system-ui,Arial;
    background:var(--dark);
    }

    /* ================= COVER ================= */
    .cover{
    width:95vw;
    height:96vh;
    margin:2vh auto;
    background:var(--glass);
    border-radius:18px;
    padding:20px;
    display:flex;
    gap:20px;
    box-shadow:0 18px 50px rgba(12,59,46,.08);
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

    /* ================= MAIN ================= */
    .main{
    flex:1;
    display:flex;
    flex-direction:column;
    min-width:0;
    }

    /* ================= GRID ================= */
    .layout-grid{
    flex:1;
    display:flex;
    gap:20px;
    overflow:hidden;
    }

    /* ================= LEFT PANEL ================= */
    .left-panel{
    flex:3;
    overflow-y:auto;
    padding-right:6px;
    }

    /* ================= RIGHT PANEL ================= */
    .right-panel{
    flex:1.4;
    display:flex;
    flex-direction:column;
    gap:16px;
    flex-shrink:0;
    }

    /* ================= CONTENT ================= */
    .content{
    flex:1;
    overflow-y:auto;
    padding-right:6px;
    }

    /* ================= CONTENT PANEL ================= */
    .content-panel{
    background:var(--yellow-main);
    border-radius:18px;
    padding:20px;
    box-shadow:0 12px 26px rgba(12,59,46,.06);
    }

    /* ================= CARD UMUM ================= */
    .card{
      background:#fff;
      border-radius:16px;
      padding:20px;
      margin-bottom:20px;
      box-shadow:0 10px 25px rgba(214,178,76,.18);
    }

    /* VARIASI WARNA CARD */
    .card:nth-of-type(1){
    background:var(--green-soft);
    border-color:rgba(109,151,115,.35);
    }

    .card:nth-of-type(2){
    background:var(--yellow-soft);
    border-color:rgba(255,186,0,.35);
    }

    .card:nth-of-type(3){
    background:rgba(187,138,82,.18);
    border-color:rgba(187,138,82,.4);
    }

    .card:nth-of-type(4){
    background:rgba(109,151,115,.12);
    border-color:rgba(109,151,115,.35);
    }

    /* ================= CLASS CARD ================= */
    .class-card{
    background: var(--green-soft);
    border-radius:14px;
    padding:14px;
    display:flex;
    gap:12px;
    margin-bottom:12px;
    box-shadow:0 6px 16px rgba(12,59,46,.05);
    }

    .class-thumb{
    width:64px;
    height:64px;
    border-radius:12px;
    background:var(--yellow-deep);
    }

    .class-info h6{
    margin:0;
    font-weight:600;
    }

    .class-meta{
    font-size:13px;
    color:var(--muted);
    }

    /* ================= CALENDAR ================= */
    .calendar-box,
    .schedule-box{
    background: var(--yellow-deep);
    border-radius:16px;
    padding:14px;
    box-shadow:0 8px 20px rgba(12,59,46,.06);
    }

    .calendar-day{
    padding:8px;
    border-radius:8px;
    background:#F1F5F3;
    text-align:center;
    font-size:13px;
    }

    .calendar-day.today{
    background:var(--dark);
    color:#fff;
    font-weight:700;
    }

    .calendar-day.has-class{
    background:var(--green-main);
    font-weight:600;
    }

    .calendar-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:6px;
    margin-top:10px;
    }

    .calendar-day.empty{
    background:transparent;
    }

    /* ================= SCHEDULE ================= */
    .schedule-item{
    padding:10px;
    border-radius:10px;
    background:var(--green-soft);
    margin-bottom:8px;
    font-size:14px;
    }

    /* ================= INFO ROW ================= */
    .info-row{
    padding:10px 0;
    border-bottom:1px dashed rgba(12,59,46,.15);
    }

    /* FILTER */
    .filter-bar button{
      border-radius:20px;
      font-size:13px;
      background: white;
    }

    .filter-bar button.active{
      background:var(--green-main);
      color:#fff;
      border:none;
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
    </style>
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
      <div class="navlink active" onclick="location.href='kelas.php'"><i class="bi bi-people-fill"></i>Daftar Kelas</div>
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
    <!-- MAIN AREA -->
    <main class="content">

        <!-- CONTENT -->
        <div class="layout-grid">

        <!-- LEFT -->
        <div class="left-panel">

        <div class="content-panel">
            <h4>Daftar Kelas</h4>

            <div class="filter-bar mb-3">
                  <button class="btn btn-sm btn-light active"
                          onclick="showTab('semua',this)">
                    Semua
                  </button>

                  <button class="btn btn-sm btn-light"
                          onclick="showTab('saat',this)">
                    Saat Ini
                  </button>

                  <button class="btn btn-sm btn-light"
                          onclick="showTab('terjadwal',this)">
                    Terjadwal
                  </button>
                  <button class="btn btn-sm btn-light"
                          onclick="showTab('selesai',this)">
                    Selesai
                  </button>
                </div>

                <div id="tab-materi"></div>
                <div id="tab-video" class="d-none"></div>
                <div id="tab-live" class="d-none"></div>

                <div id="myClassList"></div>
            <hr>

            <h5>Rekomendasi Kelas</h5>
            <div id="recommendedList"></div>
        </div>
        </div>


        <!-- RIGHT -->
        <div class="right-panel">
        <div class="calendar-box">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <button class="btn btn-sm btn-outline-secondary" onclick="prevMonth()">‹</button>
            <strong id="calendarTitle" class="text-center flex-grow-1"></strong>
            <button class="btn btn-sm btn-outline-secondary" onclick="nextMonth()">›</button>
        </div>

        <div class="calendar-grid text-muted" style="font-size:12px">
            <div>Min</div><div>Sen</div><div>Sel</div>
            <div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
        </div>

        <div class="calendar-grid" id="calendar"></div>
        </div>


        <div class="schedule-box">
            <strong>Schedule Terdekat</strong>
            <div id="scheduleList"></div>
        </div>
        </div>

    </div>
    </div>

    <script>
/* ================= DOM ================= */
const myClassList      = document.getElementById('myClassList');
const recommendedList = document.getElementById('recommendedList');
const calendar         = document.getElementById('calendar');
const calendarTitle    = document.getElementById('calendarTitle');
const scheduleList     = document.getElementById('scheduleList');

/* ================= DATE ================= */
let currentMonth = new Date().getMonth();
let currentYear  = new Date().getFullYear();
const today      = new Date();

/* ================= DATA ================= */
let recommendedClasses = [];
let myClasses = [];
let filteredClasses = [];
let currentTab = 'semua';

/* ================= FETCH RECOMMENDED ================= */
fetch('../api/get_classes.php')
  .then(res => res.json())
  .then(data => {
    recommendedClasses = data;
    updateRecommended();
  });

/* ================= FETCH MY CLASSES ================= */
fetchMyClasses();

/* ================= FETCH MY CLASSES FUNC ================= */
function fetchMyClasses(){
  fetch('../api/get_my_classes.php')
    .then(res => {
      if(!res.ok) throw new Error('Response error');
      return res.text(); // ⬅️ JANGAN langsung res.json()
    })
    .then(text => {
      const data = text ? JSON.parse(text) : [];
      myClasses = Array.isArray(data) ? data : [];
    })
    .catch(err => {
      console.warn('My classes kosong / error:', err);
      myClasses = [];
    })
    .finally(() => {
      // ⬅️ INI KUNCI UTAMA
      filterClasses(currentTab);
      updateRecommended();
      renderCalendar();   // ✅ PASTI DIPANGGIL
      renderSchedule();
    });
}

/* ================= TAB / FILTER ================= */
function showTab(type, btn){
  currentTab = type;

  document.querySelectorAll('.filter-bar button')
    .forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');

  filterClasses(type);
}

/* ================= FILTER ================= */
function filterClasses(type){
  const now = new Date();
  now.setHours(0,0,0,0); // 🔑 KUNCI UTAMA

  filteredClasses = myClasses.filter(c=>{
    const start = new Date(c.startDate + 'T00:00:00');
    const end   = new Date(c.endDate + 'T23:59:59');

    if(type === 'saat')       return now >= start && now <= end;
    if(type === 'terjadwal')  return now < start;
    if(type === 'selesai')    return now > end;
    return true;
  });

  renderMyClasses();
}

/* ================= RENDER MY CLASS ================= */
function renderMyClasses(){
  myClassList.innerHTML = '';

  if(filteredClasses.length === 0){
    myClassList.innerHTML = `<small class="text-muted">Belum ada kelas</small>`;
    return;
  }

  filteredClasses.forEach(c=>{
    myClassList.innerHTML += `
      <div class="class-card">
        <div class="class-thumb"></div>
        <div class="class-info">
          <h6>${c.subject}</h6>
          <small>${c.desc}</small>
          <div class="class-meta">
            👨‍🏫 ${c.mentor} • 🕒 ${c.time}
          </div>
        </div>
      </div>
    `;
  });
}

/* ================= RENDER RECOMMENDED ================= */
function renderRecommended(list){
  recommendedList.innerHTML = '';

  if(list.length === 0){
    recommendedList.innerHTML =
      `<small class="text-muted">Tidak ada rekomendasi</small>`;
    return;
  }

  list.forEach(c=>{
    recommendedList.innerHTML += `
      <div class="class-card">
        <div class="class-thumb"></div>
        <div class="class-info">
          <h6>${c.subject}</h6>
          <small>${c.desc}</small><br>
          <button class="btn btn-sm btn-success mt-1"
            onclick="addClass(${c.id})">
            Tambah
          </button>
        </div>
      </div>
    `;
  });
}

/* ================= UPDATE RECOMMENDED ================= */
function updateRecommended(){
  const myClassIds = myClasses.map(c => c.id);
  const filtered = recommendedClasses.filter(
    c => !myClassIds.includes(c.id)
  );
  renderRecommended(filtered);
}

/* ================= ADD CLASS ================= */
function addClass(id){
  fetch('../api/add_classes.php', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `course_id=${id}`
  })
  .then(res => res.json())
  .then(data => {
    if(data.status === 'success'){
      fetchMyClasses();
    } else {
      alert(data.message);
    }
  });
}

/* ================= CALENDAR ================= */
function renderCalendar(){
  calendar.innerHTML = '';

  const classes = Array.isArray(myClasses) ? myClasses : [];
  
  const firstDay = new Date(currentYear, currentMonth, 1).getDay();
  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

  const monthNames = [
    'Januari','Februari','Maret','April','Mei','Juni',
    'Juli','Agustus','September','Oktober','November','Desember'
  ];

  calendarTitle.innerText = `${monthNames[currentMonth]} ${currentYear}`;

  for(let i=0;i<firstDay;i++){
    calendar.innerHTML += `<div class="calendar-day empty"></div>`;
  }

  for(let day=1;day<=daysInMonth;day++){
    let cls = 'calendar-day';

    if(
      day === today.getDate() &&
      currentMonth === today.getMonth() &&
      currentYear === today.getFullYear()
    ) cls += ' today';

    classes.forEach(c=>{
      const start = new Date(c.startDate + 'T00:00:00');
      if(
        start.getDate() === day &&
        start.getMonth() === currentMonth &&
        start.getFullYear() === currentYear
      ) cls += ' has-class';
    });

    calendar.innerHTML += `<div class="${cls}">${day}</div>`;
  }
}

/* ================= SCHEDULE ================= */
function renderSchedule(){
  scheduleList.innerHTML = '';

  myClasses
    .filter(c => new Date(c.startDate) >= today)
    .sort((a,b)=>new Date(a.startDate)-new Date(b.startDate))
    .slice(0,5)
    .forEach(c=>{
      scheduleList.innerHTML += `
        <div class="schedule-item">
          <strong>${c.subject}</strong><br>
          ${c.startDate} • ${c.time}
        </div>
      `;
    });
}
</script>
    </body>
    </html>