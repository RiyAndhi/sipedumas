<?php
ini_set('session.gc_maxlifetime', 600);
ini_set('session.cookie_lifetime', 600);
session_set_cookie_params(600);

session_start();

if (isset($_SESSION['username'])) {
    setcookie(session_name(), session_id(), time() + 600, "/");
}

error_reporting(0);
include '../conn/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['level'] != "admin") {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SIPEDUMAS •󠁏 Admin</title>
  <link rel="icon" href="../img/logo.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
  <div class="container" role="region" aria-label="Form Laporan Sipedumas">
    <header>
      <span class="akun-icon" onclick="window.location.href='index.php?p=datauser'" title="Manajemen Akun">
        <i class="fas fa-users-cog"></i>
      </span>
      SIPEDUMAS • Admin
      <span class="notif-icon" onclick="openModal('popupNotifikasi')" title="Notifikasi">
        <i class="fas fa-bell"></i>
        <span class="notif-badge"></span>
      </span>

      <div id="popupNotifikasi" class="modal">
        <div class="modal-content">
          <span class="close-btn" onclick="closeModal('popupNotifikasi')">&times;</span>
          
          <img src="../img/iklan.png" alt="Iklan" class="popup-image">
          <p class="popup-text">Selamat datang di SIPEDUMAS</p>
          <p class="popup-text">(Sistem Pengaduan Masyarakat)</p>
        </div>
      </div>
    </header>
    <main>

    <?php 
      include '../conn/koneksi.php';

      $page = isset($_GET['p']) ? $_GET['p'] : '';

      if ($page == "") {
        include_once 'dashboard.php';

      } elseif ($page == "pengaduan") {
        include_once 'pengaduan.php';

      } elseif ($page == "akun") {
        include_once 'akun.php';

      } elseif ($page == "datauser") {
        include_once 'datauser.php';
      }
  
    ?>

    </main>
    <footer>
      <button type="button" onclick="window.location.href='?p='" class="<?= $page == '' ? 'active' : '' ?>">
        <div class="inner">
          <span class="icon"><i class="fas fa-house"></i></span>
          Dashboard
        </div>
      </button>
      <button type="button" onclick="window.location.href='?p=pengaduan'" class="<?= $page == 'pengaduan' ? 'active' : '' ?>">
        <div class="inner">
          <span class="icon"><i class="fas fa-clipboard-list"></i></span>
          Pengaduan
        </div>
      </button>
      <button type="button" onclick="window.location.href='?p=akun'" class="<?= $page == 'akun' ? 'active' : '' ?>">
        <div class="inner">
          <span class="icon"><i class="fas fa-user"></i></span>
          Akun
        </div>
      </button>
    </footer>
  </div>
</body>
</html>

<script>
  function openModal(id) {
    document.getElementById(id).style.display = 'block';
  }

  function closeModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    });
  }

  window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    if (params.get("showPopup") === "1") {
      document.getElementById('popupNotifikasi').style.display = 'block';
    }
  };
</script>