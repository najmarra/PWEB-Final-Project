<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengaturan</title>

<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- BOOTSTRAP & ICON -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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

/* FULL COVER */
html,body{
  height:100%;
  margin:0;
  overflow:hidden;
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
}

/* SIDEBAR */
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

/* MAIN CONTENT (SCROLL) */
.main{
  flex:1;
  overflow-y:auto;
  padding-right:6px;
}

/* SECTION */
.settings-section{
  margin-bottom:50px;
}
.section-title{
  font-size:20px;
  font-weight:700;
  margin-bottom:16px;
  color:#256b55;
}

/* CARD */
.panel-card{
  background:#fff;
  border-radius:16px;
  padding:20px;
  margin-bottom:20px;
  box-shadow:0 10px 25px rgba(0,0,0,.04);
}
.panel-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:14px;
}
.panel-title{
  font-size:18px;
  font-weight:700;
}
.edit-btn{
  background:none;
  border:none;
  color:var(--muted);
  cursor:pointer;
}

/* ROW */
.row{
  display:grid;
  grid-template-columns:1fr auto;
  padding:10px 0;
  border-bottom:1px solid var(--border);
}
.row:last-child{border-bottom:none}
.row span{color:var(--muted)}

/* PROFILE */
.profile{
  display:flex;
  gap:14px;
  align-items:center;
}

.avatar{
  width:56px;
  height:56px;
  border-radius:50%;
  object-fit:cover;
}

.link{
  color:var(--muted);
  font-size:13px;
  cursor:pointer;
}

textarea{
  width:100%;
  height:120px;
  padding:10px;
  border-radius:10px;
  border:1px solid #ddd;
}

.select-yellow{
  background-color: var(--yellow-main);
  border:1px solid var(--yellow-deep);
  color: var(--dark);
  font-weight:500;
  border-radius:10px;
  padding-right:32px;
}

/* fokus */
.select-yellow:focus{
  border-color: var(--yellow-deep);
  box-shadow: 0 0 0 3px rgba(242,201,76,.35);
}

.btn.btn-action:hover {
  background: var(--green-main) !important;
  color: #fff !important;
}

/* =====================
   MODAL BASE
===================== */
.modal {
  position: fixed;
  inset: 0;
  background: rgba(12, 59, 46, 0.25); /* dark soft overlay */
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

/* =====================
   MODAL BOX
===================== */
.modal-box {
  background: var(--glass);
  width: 380px;
  padding: 26px;
  border-radius: 18px;
  box-shadow: var(--card-shadow);
  border: 1px solid var(--border);
  animation: popUp .25s ease;
}

/* =====================
   TITLE
===================== */
.modal-box h3 {
  margin-bottom: 16px;
  color: var(--dark);
  font-weight: 700;
}

/* =====================
   FORM
===================== */
.modal-box label {
  display: block;
  margin-top: 12px;
  font-size: 13px;
  color: var(--muted);
  font-weight: 600;
}

.modal-box input,
.modal-box select {
  width: 100%;
  padding: 9px 12px;
  margin-top: 5px;
  border-radius: 10px;
  border: 1px solid var(--border);
  background: var(--bg);
  font-size: 14px;
}

.modal-box input:focus,
.modal-box select:focus {
  outline: none;
  border-color: var(--yellow-deep);
  background: #fff;
}

/* =====================
   ACTION BUTTONS
===================== */
.modal-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 22px;
}

.modal-actions button {
  border-radius: 12px;
  padding: 8px 16px;
  font-size: 14px;
  cursor: pointer;
  border: none;
}

/* Cancel */
.modal-actions button:first-child {
  background: var(--yellow-soft);
  color: var(--dark);
}

/* Save */
.btn-save {
  background: var(--green-main);
  color: white;
}

.btn-save:hover {
  background: var(--green-deep);
}

/* =====================
   ANIMATION
===================== */
@keyframes popUp {
  from {
    transform: scale(.9);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

.password-wrapper {
  position: relative;
}

.password-wrapper input {
  width: 100%;
  padding-right: 40px;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: var(--muted);
  font-size: 1.1rem;
}

.toggle-password:hover {
  color: var(--green-main);
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
<!-- EDIT PROFILE MODAL -->
<div class="modal" id="editProfileModal">
  <div class="modal-box">
    <h3>Edit Profil</h3>

    <form method="POST" action="../auth/update_profile.php">
      <label>Nama</label>
      <input type="text" name="name" required
        value="<?= htmlspecialchars($_SESSION['name']) ?>">

      <label>Gender</label>
      <select name="gender">
        <option <?= $_SESSION['gender']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
        <option <?= $_SESSION['gender']=='Perempuan'?'selected':'' ?>>Perempuan</option>
      </select>

      <label>Email</label>
      <input type="email" name="email" required
        value="<?= htmlspecialchars($_SESSION['email']) ?>">

      <label>Kelas</label>
      <input type="text" name="kelas"
        value="<?= htmlspecialchars($_SESSION['kelas']) ?>">

      <div class="modal-actions">
        <button type="button" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn-save">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- EDIT PASSWORD MODAL -->
<div class="modal" id="editaccountModal">
  <div class="modal-box">
    <h3>Edit Username & Password</h3>

    <form id = "passwordForm" method="POST" action="../auth/update_password.php">

      <!-- ================= USERNAME ================= -->
      <label>Username</label>
      <input type="text" name="username"
        value="<?= htmlspecialchars($_SESSION['username']) ?>" required>

      <hr>

      <!-- ================= RESET PASSWORD ================= -->
      <label>Password Baru</label>
        <div class="password-wrapper">
          <input type="password" id="newPass" name="new_password">
          <i class="bi bi-eye toggle-password"
            onclick="togglePassword(this, 'newPass')"></i>
        </div>

      <label>Konfirmasi Password</label>
        <div class="password-wrapper">
          <input type="password" id="confirmPass" name="confirm_password">
          <i class="bi bi-eye toggle-password"
            onclick="togglePassword(this, 'confirmPass')"></i>
        </div>

      <div class="modal-actions">
        <button type="button" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn-save">Simpan</button>
      </div>

    </form>
  </div>
</div>

<body>
<div class="cover">

  <!-- SIDEBAR -->
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
      <div class="navlink" onclick="location.href='laporan.php'"><i class="bi bi-calendar2-event"></i>Laporan Siswa</div>
      <div class="navlink active" onclick="location.href='setting.php'"><i class="bi bi-gear-fill"></i>Pengaturan</div>
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

    <!-- ACCOUNT -->
    <section class="settings-section">
      <div class="section-title">Profil Account</div>

      <div class="panel-card">
        <div class="panel-header">
          <div class="panel-title">Photo</div>
          <button class="edit-btn" onclick="openEditProfile()">Edit</button>
        </div>

        <div class="profile">
          <img src="https://i.pravatar.cc/100" class="avatar">
          <div>
            <div class="link">Upload new picture</div>
            <div class="link">Remove</div>
          </div>
        </div>
      </div>

      <div class="panel-card">
        <div class="row"><span>Name</span>
          <strong><?= htmlspecialchars($_SESSION['name']) ?></strong>
        </div>

        <div class="row"><span>Gender</span>
          <strong><?= htmlspecialchars($_SESSION['gender']) ?></strong>
        </div>

        <div class="row"><span>Email</span>
          <strong><?= htmlspecialchars($_SESSION['email']) ?></strong>
        </div>

        <div class="row"><span>Kelas</span>
          <strong><?= htmlspecialchars($_SESSION['kelas']) ?></strong>
        </div>
      </div>

      <div class="panel-card">
        <div class="panel-header">
          <div class="panel-title">Account Info</div>
          <button class="edit-btn" onclick="openEditPass()">Edit</button>
        </div>

        <div class="row"><span>Username</span>
            <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
          </div>

          <div class="row"><span>Password</span>
            <strong>********</strong>
          </div>
      </div>
    </section>

    <!-- NOTIFICATIONS -->
    <section class="settings-section">
      <div class="section-title">Notifications</div>
      <div class="panel-card">
        <div class="row"><span>Email Notifications</span><input type="checkbox" checked></div>
        <div class="row"><span>Push Notifications</span><input type="checkbox"></div>
        <div class="row"><span>Weekly Report</span><input type="checkbox" checked></div>
      </div>
    </section>

    <!-- LANGUAGE -->
    <section class="settings-section">
      <div class="section-title">Language</div>
      <div class="panel-card">
        <div class="row">
          <span>Language</span>
          <select class="form-select w-auto select-yellow">
            <option>Bahasa Indonesia</option>
            <option>English</option>
          </select>
        </div>
      </div>
    </section>

    <!-- HELP -->
    <section class="settings-section">
      <div class="section-title">Help</div>

      <div class="panel-card">
        <div class="row"><span>Cara edit profil?</span><strong>›</strong></div>
        <div class="row"><span>Cara reset password?</span><strong>›</strong></div>
        <div class="row"><span>Kenapa progres tidak muncul?</span><strong>›</strong></div>
      </div>

      <div class="panel-card">
        <div class="panel-title">Saran</div>
        <textarea placeholder="Tulis saran atau kendala..."></textarea>
        <button class="btn btn-success mt-3 btn-action">Kirim</button>
      </div>
    </section>

  </main>
</div>

<script>
document.querySelectorAll('.navlink').forEach(el=>{
      el.addEventListener('click', ()=> {
        document.querySelectorAll('.navlink').forEach(n=>n.classList.remove('active'));
        el.classList.add('active');
        // optional: scroll internal panels or focus by id if implemented
        const target = el.dataset.target;
        if(target){
          // highlight corresponding panel briefly (if present)
          const panel = document.getElementById(target);
          if(panel){
            panel.style.boxShadow = '0 12px 40px rgba(109,151,115,0.12)';
            setTimeout(()=> panel.style.boxShadow = '0 8px 22px rgba(12,59,46,0.03)', 900);
          }
        }
      });
    });
    
function openEditProfile() {
  document.getElementById('editProfileModal').style.display = 'flex';
}

function openEditPass(){
  document.getElementById('editaccountModal').style.display = 'flex';
}

function closeModal(){
  document.querySelectorAll('.modal').forEach(m=>{
    m.style.display = 'none';
  });
}

function togglePassword(icon, inputId){
  const input = document.getElementById(inputId);

  if(input.type === "password"){
    input.type = "text";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  }
}

document.getElementById('passwordForm').addEventListener('submit', function(e){
  const newPass = document.getElementById('newPass').value;
  const confirm = document.getElementById('confirmPass').value;

  if(newPass !== "" && newPass !== confirm){
    e.preventDefault(); // stop submit
    alert("Konfirmasi password tidak cocok ❌");
  }
});
</script>

</body>
</html>
