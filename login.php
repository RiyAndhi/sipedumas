<div class="auth-wrapper">
  <h2 class="auth-title">Login</h2>
  <form method="post" class="auth-form">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Masukkan Username" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Masukkan Password" required>

    <button type="submit" name="login">Login</button>

    <a href="index.php?p=loginadminpetugas" class="auth-admin-btn">
      <i class="fas fa-user-shield"></i> Login Admin / Petugas
    </a>

    <p class="auth-link">
      Belum punya akun? <a href="index.php?p=register">Daftar di sini</a>
    </p>
  </form>
</div>


<?php 
  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    $sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
    $cek = mysqli_num_rows($sql);
    $data = mysqli_fetch_assoc($sql);
    
    if($cek > 0){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    $_SESSION['username'] = $username;
    $_SESSION['data'] = $data;
    $_SESSION['level'] = 'masyarakat';

    echo "<script>
        alert('Berhasil Login!');
        setTimeout(function() {
        window.location.href = 'user_masyarakat/index.php?showPopup=1';
        }, 100);
    </script>";
    } else {
      echo "<script>alert('Gagal Login! Username atau Password salah.')</script>";
    }
  }
?>