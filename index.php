<?php
  session_start();
  include 'conn/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sipedumas</title>
  <link rel="icon" href="img/logo.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style1.css">
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#1e88e5">
</head>
<body>
  <div class="wrapper">
    <?php 
      $page = @$_GET['p'];

      if ($page == "") {
        include 'splashscreen.php';
      } 
      elseif ($page == "login") {
        include_once 'login.php';
      }
      elseif ($page == "loginadminpetugas") {
        include_once 'loginadminpetugas.php';
      }
      elseif ($page == "register") {
        include_once 'register.php';
      }
      elseif ($page == "logout") {
        include_once 'logout.php';
      }
      else {
        echo "<p style='text-align:center; color:red;'>Halaman tidak ditemukan.</p>";
      }
    ?>
  </div>
</body>
<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('service-worker.js')
      .then(reg => console.log('Service Worker registered!', reg))
      .catch(err => console.error('Service Worker registration failed:', err));
  }
</script>
</html>
