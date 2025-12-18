<?php $page = 'quiz'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Latihan Soal</title>

<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- BOOTSTRAP & ICON -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
*, *::before, *::after{
  box-sizing:border-box;
}
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

/* FULL COVER */
html,body{
  height:100%;
  margin:0;
  overflow:auto;
  font-family:'Roboto',system-ui,Arial;
  background:var(--dark);
}

/* CONTAINER UTAMA */
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
  overflow: hidden;
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
  min-height:0;
}

/* CONTENT (SCROLL DI SINI) */
.content{
  flex:1;
  overflow-y:auto;
  padding-right:6px;
  min-height:0;
  height:100%;
}

/* CARD */
.card{
  background:#fff;
  border-radius:16px;
  padding:20px;
  margin-bottom:20px;
  box-shadow:0 10px 25px rgba(214,178,76,.18);
}

/* QUIZ */
.option{
  padding:12px;
  border:1px solid #eee;
  border-radius:10px;
  cursor:pointer;
  margin-bottom:10px;
}
.option:hover{
  background:#f5f7f6;
}
.option.active{
  background:#e6f2ee;
  border-color:var(--green);
}

.progress{
  height:10px;
  border-radius:20px;
}

#timerCard{
  background:#fff3cd;
  border-left:6px solid #ffba00;
}

.quiz-wrapper{
  background:#fff;
  border-radius:16px;
  padding:24px;
}

/* HEADER */
.quiz-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:20px;
}

.quiz-header h4{margin-bottom:8px}

.progress{
  height:8px;
  background:#eee;
  border-radius:10px;
}
.progress-bar{
  height:100%;
  background:#0d6efd;
  width:0%;
  border-radius:10px;
}

/* SCORE */
.score-box{
  background:#f1f7ff;
  padding:14px;
  border-radius:12px;
  text-align:center;
}
.score-box strong{
  font-size:22px;
}

/* BODY */
.quiz-body{
  display:flex;
  gap:24px;
}

/* LEFT */
.quiz-left{
  flex:3;
}

/* OPTIONS */
.option{
  background:#ffffff;
  border:2px solid #e5e7eb;
  border-radius:14px;
  padding:15px;
  cursor:pointer;
  transition:all .2s ease;
  font-size:15px;
}

.option:hover{
  background:#fff9e6;
}

.option.active{
  background:var(--yellow-soft);          /* kuning soft */
  border-color:var(--yellow-soft);        /* kuning lebih tegas */
  font-weight:600;
  box-shadow:0 6px 14px rgba(255,204,0,.25);
}

/* NAV */
.quiz-nav{
  display:flex;
  justify-content:space-between;
  margin-top:20px;
}

/* RIGHT */
.quiz-right{
  flex:1;
}

.timer-card{
  background:var(--yellow-soft);
  border-radius:12px;
  padding:14px;
  text-align:center;
}

.card.text-center{
  background:var(--green-deep);
  color: white;
  border-radius:16px;
  padding:20px;
  margin-bottom:20px;
  box-shadow:0 10px 25px rgba(214,178,76,.18);
}

#timeLeft{
  font-size:24px;
  font-weight:700;
  color:black;
}

/* QUESTION LIST */
.question-list{
  max-height:240px; 
  display:flex;
  flex-direction:column;
  overflow-y:auto;
  gap:8px;
}

.question-list div{
  background:#ffffff;
  border-radius:10px;
  padding:10px;
  font-size:14px;
  border:1px solid #e5e7eb;
}

/* SUDAH DIJAWAB */
.question-list div.done{
  background: var(--green-soft);
  border-color: var(--green-main);
  color: var(--dark);
  font-weight:500;
}

/* SOAL AKTIF */
.question-list div.active{
  background: linear-gradient(
    135deg,
    var(--green-main),
    var(--green-deep)
  );
  color:#fff;
  border-color: var(--green-deep);
  font-weight:600;
}

/* AKTIF + SUDAH DIJAWAB (PALING KUAT) */
.question-list div.active.done{
  background: linear-gradient(
    135deg,
    var(--green-deep),
    var(--green-main)
  );
  color:#fff;
}

.question-box{
  background:var(--green-deep);
  max-height:calc(96vh - 220px);
  overflow-y:auto;
  border-radius:16px;
  padding:20px;
  border:1px solid #e5e7eb;
  box-shadow:0 12px 30px rgba(0,0,0,.05);
  margin-bottom: 12px;
}

.question-header{
  background:#ffffff;
  border-radius:12px;
  padding:14px 16px;
  margin-bottom:16px;
  border:1px solid #e5e7eb;
}

.question-header h5{
  margin:6px 0 0;
  font-weight:600;
}

.side-panel{
  background:var(--yellow-deep);
  border-radius:16px;
  padding:16px;
  border:1px solid #e5e7eb;
  display:flex;
  flex-direction:column;
  gap:16px;
}

/* SUMMARY WRAPPER */
.summary-wrapper{
  width:100%;
  height:100%;
  display:flex;
  justify-content:center;
  align-items:center;
  border-radius:14px;
  background: var(--yellow-deep);
}

/* SUMMARY CARD */
.summary-card{
  background:#fff;
  border-radius:24px;
  padding:32px;
  width:420px;
  text-align:center;
  box-shadow:0 20px 40px rgba(0,0,0,.2);
}

/* TROPHY */
.trophy{
  font-size:64px;
  margin-bottom:12px;
}

/* TITLE */
.summary-card h2{
  font-weight:700;
  margin-bottom:6px;
}

/* SCORE TEXT */
.score-text{
  color:#6b7280;
  margin-bottom:24px;
}
.score-text span{
  color:#22c55e;
  font-weight:700;
}

/* STATS */
.summary-stats{
  display:flex;
  justify-content:space-between;
  margin-top:20px;
}

.stat{
  flex:1;
  text-align:center;
}

.stat strong{
  display:block;
  font-size:20px;
  margin-top:6px;
}

.stat small{
  color:#6b7280;
}

/* ICON */
.icon{
  width:36px;
  height:36px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  border-radius:50%;
  font-weight:700;
  color:#fff;
}

.icon.purple{background:#8b5cf6}
.icon.green{background:#22c55e}
.icon.red{background:#ef4444}

/* ANSWER KEY PAGE */
.answer-key-wrapper{
  width:88%;
  max-width:1000px;
  margin:0 auto;
  background:#fff;
  border-radius:18px;
  padding:24px;
  box-shadow:0 12px 30px rgba(0,0,0,.06);
}

.answerkey-card{
  background:#fff;
  width:700px;
  max-height:90vh;
  overflow-y:auto;
  border-radius:20px;
  padding:24px;
}

/* XP BAR */
.xp-box{
  margin:20px 0;
}

.xp-label{
  display:flex;
  justify-content:space-between;
  font-size:14px;
  margin-bottom:6px;
}

.xp-bar{
  display:flex;
  height:18px;
  border-radius:12px;
  overflow:hidden;
  background:#e5e7eb;
}

#xpCorrect, #xpWrong{
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:12px;
  font-weight:600;
  color:#fff;
  white-space:nowrap;
}

#xpCorrect{
  background:#22c55e;
  width:0%;
}

#xpWrong{
  background:#ef4444;
  width:0%;
}

.xp-legend{
  display:flex;
  justify-content:space-between;
  font-size:13px;
  margin-top:6px;
}

.legend-correct{color:#16a34a}
.legend-wrong{color:#dc2626}

/* ANSWER ITEM */
.answer-item{
  border-radius:12px;
  padding:14px;
  margin-bottom:12px;
}

.answer-item.correct{
  background:#dcfce7;
  border-left:6px solid #22c55e;
}

.answer-item.wrong{
  background:#fee2e2;
  border-left:6px solid #ef4444;
}

.answer-item strong{
  display:block;
  margin-bottom:6px;
}
.summary-actions{
  display:flex;
  gap:12px;
  justify-content:center;
  margin-top:20px;
}

.btn-action:hover{
  background: var(--green-main);
  color: #fff;
}

.btn.btn-action1,
.btn.btn-action1:focus,
.btn.btn-action1:active,
.btn.btn-action1:focus-visible {
  outline: none !important;
  box-shadow: none !important;
}

/* Matikan focus ring variable Bootstrap */
.btn.btn-action1 {
  --bs-focus-ring-color: transparent;
  -webkit-tap-highlight-color: transparent;
}

.btn-action1:hover{
  background: white;
  color: black;
}


/* ===============================
   FIX HIGHLIGHT BIRU BOOTSTRAP
================================ */

.btn.btn-action,
.btn.btn-action:focus,
.btn.btn-action:active,
.btn.btn-action:focus-visible {
  outline: none !important;
  box-shadow: none !important;
}

/* Matikan focus ring variable Bootstrap */
.btn.btn-action {
  --bs-focus-ring-color: transparent;
  -webkit-tap-highlight-color: transparent;
}

/* Optional: hover style kamu */
.btn.btn-action:hover {
  background: var(--green-main) !important;
  color: #fff !important;
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
      <div class="navlink active" onclick="location.href='quiz.php'"><i class="bi bi-journal-bookmark"></i>Latihan Soal</div>
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
    <!-- PILIH PAKET -->
    <div id="menuQuiz" class="card">
    <h5 class="mb-3">Pilih Latihan Soal</h5>
      <div class="row" id="paketQuiz"></div>    
    </div>

    <!-- QUIZ (AWALNYA HIDDEN) -->
    <div id="quizPage" class="quiz-wrapper" style="display:none">

    <!-- HEADER -->
    <div class="quiz-header">
        <div>
        <h4 id="quizTitle"></h4>
        <div class="progress">
            <div id="progressBar" class="progress-bar"></div>
        </div>
        </div>
    </div>

    <!-- BODY -->
    <div class="quiz-body">

        <!-- KIRI -->
        <div class="quiz-left">
          <div class="question-box">
            <div class="question-header">
              <small id="questionCount"></small>
              <h5 id="questionText"></h5>
            </div>
            <div id="options"></div>
          </div>
          <div class="quiz-nav">
            <button class="btn btn-outline-secondary btn-action" onclick="prevQuestion()">Previous</button>
            <button class="btn btn-primary btn-action" onclick="nextQuestion()">Next</button>
          </div>
        </div>

        <!-- KANAN -->
        <div class="quiz-right">
          <div class="side-panel">
            <div class="timer-card">
              <strong>Waktu</strong>
              <div id="timeLeft">00:28</div>
            </div>
            <div id="questionList" class="question-list"></div>
          </div>
        </div>
    </div>
    </div>

    <div id="summaryPage" class="summary-wrapper" style="display:none">

    <div class="summary-card">

      <!-- TROPHY -->
      <div class="trophy">
        🏆
      </div>

      <h2>Congratulations!</h2>
      <p class="score-text">
        Kamu mendapatkan <span id="sumScore">0</span> poin
      </p>

      <!-- STATS -->
      <div class="summary-stats">
        <div class="stat">
          <span class="icon purple">Q</span>
          <strong id="sumTotal">0</strong>
          <small>Total Soal</small>
        </div>

        <div class="stat">
          <span class="icon green">✔</span>
          <strong id="sumCorrect">0</strong>
          <small>Benar</small>
        </div>

        <div class="stat">
          <span class="icon red">✖</span>
          <strong id="sumWrong">0</strong>
          <small>Salah</small>
        </div>
      </div>

    <div class="summary-actions">
      <button class="btn btn-primary btn-action" onclick="location.reload()">
        Main Lagi
      </button>

      <button class="btn btn-outline-success btn-action" onclick="openAnswerKey()">
        Kunci
      </button>
    </div>
  </div>
  </div>

  <div id="answerKeyPage" class="answerkey-wrapper" style="display:none">

  <div class="answerkey-card">

    <h3>Kunci Jawaban</h3>

    <!-- XP BAR -->
    <div class="xp-box">
    <div class="xp-bar">
      <div id="xpCorrect">
        <span id="xpCorrectText"></span>
      </div>
      <div id="xpWrong">
        <span id="xpWrongText"></span>
      </div>
    </div>

    <div class="xp-legend">
      <span class="legend-correct">✔ Benar</span>
      <span class="legend-wrong">✖ Salah</span>
    </div>
  </div>

    <!-- LIST SOAL -->
    <div id="answerKeyList"></div>

    <button class="btn btn-secondary mt-4 btn-action" onclick="backToSummary()">Summary </button>
  </div>
</div>
</div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>  
<script>
/* ================= INIT ================= */
let index = 0;
let answers = [];
let time = 60;
let timer;
let quizFinished = false;

/* ================= ELEMENT ================= */
const menuQuiz = document.getElementById('menuQuiz');
const quizPage = document.getElementById('quizPage');
const summaryPage = document.getElementById('summaryPage');
const answerKeyPage = document.getElementById('answerKeyPage');

const quizTitle = document.getElementById('quizTitle');
const questionText = document.getElementById('questionText');
const questionCount = document.getElementById('questionCount');
const options = document.getElementById('options');
const questionList = document.getElementById('questionList');
const timeLeft = document.getElementById('timeLeft');
const progressBar = document.getElementById('progressBar');

const sumTotal = document.getElementById('sumTotal');
const sumCorrect = document.getElementById('sumCorrect');
const sumWrong = document.getElementById('sumWrong');
const sumScore = document.getElementById('sumScore');

const answerKeyList = document.getElementById('answerKeyList');
const xpCorrect = document.getElementById('xpCorrect');
const xpWrong = document.getElementById('xpWrong');
const xpCorrectText = document.getElementById('xpCorrectText');
const xpWrongText = document.getElementById('xpWrongText');

const nextBtn = document.querySelector('.quiz-nav .btn.btn-primary');

/* ================= START ================= */
let questions = [];
let quizSub = '';
let kuisId = null;

function startQuiz(sub){
  quizSub = sub;

  index = 0;
  answers = [];
  time = 60;
  quizFinished = false;
  const mapIndex = { A:0, B:1, C:2, D:3 };

  fetch(`api/quiz_by_sub.php?sub=${encodeURIComponent(sub)}`)
    .then(r => r.json())
    .then(data => {
      if(!data.length){
        alert("Soal belum tersedia");
        return;
      }

      kuisId = data[0].id; // 🔥 INI PENTING

      questions = data.map(q => ({
        id: q.id,
        q: q.pertanyaan,
        options: [q.a, q.b, q.c, q.d],
        answer: mapIndex[q.jawaban.trim()]
      }));

      menuQuiz.style.display = 'none';
      quizPage.style.display = 'block';
      quizTitle.innerText = "Latihan Soal: " + sub;

      renderQuestionList();
      loadQuestion();
      startTimer();
    });
}

/* ================= TIMER ================= */
function startTimer(){
  clearInterval(timer);
  updateTime();

  timer = setInterval(()=>{
    time--;
    updateTime();
    if(time <= 0){
      clearInterval(timer);
      finishQuiz(true);
    }
  },1000);
}

function updateTime(){
  const min = String(Math.floor(time/60)).padStart(2,'0');
  const sec = String(time%60).padStart(2,'0');
  timeLeft.innerText = `${min}:${sec}`;
}

/* ================= QUIZ ================= */
function loadQuestion(){
  const q = questions[index];
  questionText.innerText = q.q;
  questionCount.innerText = `Soal ${index+1} / ${questions.length}`;

  options.innerHTML = '';
  q.options.forEach((opt,i)=>{
    const div = document.createElement('div');
    div.className = 'option';
    div.innerText = opt;
    if(answers[index] === i) div.classList.add('active');
    div.onclick = ()=> selectOption(i, div);
    options.appendChild(div);
  });

  nextBtn.innerText = index === questions.length - 1 ? 'Submit' : 'Next';

  updateProgress();
  highlightQuestion();
}

function selectOption(i, el){
  answers[index] = i;
  document.querySelectorAll('.option').forEach(o=>o.classList.remove('active'));
  el.classList.add('active');
}

function nextQuestion(){
  if(answers[index] === undefined){
    alert('Pilih jawaban dulu');
    return;
  }

  if(index === questions.length - 1){
    finishQuiz();
  } else {
    index++;
    loadQuestion();
  }
}

function prevQuestion(){
  if(index > 0){
    index--;
    loadQuestion();
  }
}

const paketQuiz = document.getElementById('paketQuiz');

fetch("api/sub_bab_list.php")
  .then(r => r.json())
  .then(data => {
    paketQuiz.innerHTML = "";

    if (!data.length) {
      paketQuiz.innerHTML = "<p>Belum ada kuis</p>";
      return;
    }

    data.forEach(row => {
      paketQuiz.innerHTML += `
        <div class="col-md-4">
          <div class="card text-center">
            <h6>${row.sub_bab}</h6>
            <small>${row.total} soal</small>
            <button class="btn btn-success mt-2 btn-action1"
              onclick="startQuiz('${row.sub_bab}')">
              Mulai
            </button>
          </div>
        </div>
      `;
    });
  });

/* ================= UI ================= */
function renderQuestionList(){
  questionList.innerHTML = '';
  questions.forEach((_,i)=>{
    const div = document.createElement('div');
    div.innerText = 'Soal ' + (i+1);
    questionList.appendChild(div);
  });
}

function highlightQuestion(){
  document.querySelectorAll('.question-list div').forEach((d,i)=>{
    d.className = '';
    if(answers[i] !== undefined) d.classList.add('done');
    if(i === index) d.classList.add('active');
  });
}

function updateProgress(){
  const answered = answers.filter(a => a !== undefined).length;
  const percent = Math.round(answered / questions.length * 100);
  progressBar.style.width = percent + '%';
}


/* ================= FINISH ================= */
function finishQuiz(isTimeUp = false){
  if(quizFinished) return;
  quizFinished = true;
  clearInterval(timer);

  const payload = {};
  questions.forEach((q,i)=>{
    payload[q.id] = ['A','B','C','D'][answers[i]];
  });

  fetch("api/quiz_submit.php",{
    method:"POST",
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:new URLSearchParams({
      sub_bab: quizSub,
      answers: JSON.stringify(payload)
    })
  })
  .then(r=>r.json())
  .then(res=>{
    showSummary(res);
  });
}

function showSummary(){
  quizPage.style.display = 'none';
  summaryPage.style.display = 'flex';

  const total = questions.length;
  let correct = 0;
  questions.forEach((q,i)=> answers[i] === q.answer && correct++);

  sumTotal.innerText = total;
  sumCorrect.innerText = correct;
  sumWrong.innerText = total - correct;
  sumScore.innerText = correct * 10;
}

/* ================= ANSWER KEY ================= */
function openAnswerKey(){
  summaryPage.style.display='none';
  answerKeyPage.style.display='flex';
  renderAnswerKey();
}

function backToSummary(){
  answerKeyPage.style.display='none';
  summaryPage.style.display='flex';
}

function renderAnswerKey(){
  answerKeyList.innerHTML = '';
  let correct = 0;

  questions.forEach((q, i) => {
    const isCorrect = answers[i] === q.answer;
    if (isCorrect) correct++;

    const div = document.createElement('div');
    div.className = `answer-item ${isCorrect ? 'correct' : 'wrong'}`;
    div.innerHTML = `
      <strong>Soal ${i+1}</strong>
      <div>Jawaban kamu: <b>${q.options[answers[i]] ?? '-'}</b></div>
      <div>Kunci jawaban: <b>${q.options[q.answer]}</b></div>
    `;
    answerKeyList.appendChild(div);
  });

  const correctPercent = Math.round(correct / questions.length * 100);
  xpCorrect.style.width = correctPercent + '%';
  xpWrong.style.width = (100 - correctPercent) + '%';
  xpCorrectText.innerText = correctPercent + '%';
  xpWrongText.innerText = (100 - correctPercent) + '%';
}
</script>
</body>
</html>
