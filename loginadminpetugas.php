<div class="auth-wrapper">
  <h2 class="auth-title">Login Admin / Petugas</h2>
  <form method="post" class="auth-form">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Masukkan Username" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Masukkan Password" required>

    <label for="level">Login Sebagai</label>
    <select name="level" id="level" required>
      <option value="" disabled selected>Pilih Level</option>
      <option value="admin">Admin</option>
      <option value="petugas">Petugas</option>
    </select>

    <button type="submit" name="login">Login</button>

    <p class="auth-link">
      Kembali ke <a href="index.php?p=login">Login Masyarakat</a>
    </p>
  </form>
</div>

<?php 
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password = $_POST['password'];
  $level    = mysqli_real_escape_string($koneksi, $_POST['level']);

  $sql = mysqli_query($koneksi, "
    SELECT * FROM petugas 
    WHERE username='$username' AND level='$level'
  ");

  $cek  = mysqli_num_rows($sql);
  $data = mysqli_fetch_assoc($sql);

  if ($cek > 0 && password_verify($password, $data['password'])) {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION['username'] = $username;
    $_SESSION['data']     = $data;
    $_SESSION['level']    = $data['level'];

    echo "<script>
      alert('Login Berhasil sebagai $level!');
      setTimeout(function() {
        window.location.href = 'user_$level/index.php?showPopup=1';
      }, 500);
    </script>";
  } else {
    echo "<script>alert('Login gagal! Username, password, atau level salah.')</script>";
  }
}
?>