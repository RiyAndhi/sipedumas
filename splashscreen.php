<div class="splash-wrapper">
  <div class="splash-inner">
    <img src="img/logo.png" alt="Logo Sipedumas" class="splash-logo">
    <div class="splash-title">Sipedumas</div>
    <div class="splash-loader"></div>
  </div>
</div>

<style>
  .splash-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: linear-gradient(to bottom right, #e3f2fd, #bbdefb);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .splash-inner {
    text-align: center;
    animation: splashFadeIn 0.5s ease-in;
  }

  .splash-logo {
    width: 160px;
    height: 160px;
    margin-bottom: 12px;
    animation: splashZoom 0.6s ease;
  }

  .splash-title {
    font-size: 2rem;
    font-weight: bold;
    color: #1565c0;
    margin-bottom: 24px;
  }

  .splash-loader {
    width: 40px;
    height: 40px;
    border: 5px solid #90caf9;
    border-top: 5px solid #1565c0;
    border-radius: 50%;
    animation: splashSpin 1s linear infinite;
    margin: 0 auto;
  }

  .splash-inner {
  transform: translateY(-10%);
  }

  @keyframes splashSpin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  @keyframes splashZoom {
    from { transform: scale(0.6); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }

  @keyframes splashFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
</style>

<?php
  session_start();
  echo "<script>
    setTimeout(() => {
      window.location.href = '";
  if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
    if ($_SESSION['level'] == 'masyarakat') {
      echo "user_masyarakat/index.php";
    } elseif ($_SESSION['level'] == 'admin') {
      echo "user_admin/index.php";
    } elseif ($_SESSION['level'] == 'petugas') {
      echo "user_petugas/index.php";
    } else {
      echo "index.php?p=login";
    }
  } else {
    echo "index.php?p=login";
  }
  echo "';
    }, 5000);
  </script>";
?>
