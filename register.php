<div class="auth-wrapper">
  <h2 class="auth-title">Registrasi</h2>
  <form method="post" class="auth-form">
    <label for="nik">NIK</label>
    <input type="text" id="nik" name="nik" placeholder="Masukkan NIK" required maxlength="16">

    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Buat Username" required>

    <label for="telp">Telepon</label>
    <input type="text" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Buat Password" required>

    <button type="submit" name="register">Daftar</button>

    <p class="auth-link">Sudah punya akun? <a href="index.php?p=login">Login di sini</a></p>
  </form>
</div>

<?php
if (isset($_POST['register'])) {
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    $cek = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nik' OR username='$username'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Registrasi gagal! NIK atau Username sudah terdaftar.');</script>";
    } else {
        $query = "INSERT INTO masyarakat (nik, nama, username, telp, password) 
                  VALUES ('$nik', '$nama', '$username', '$telp', '$password')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location='index.php?p=login';
                  </script>";
        } else {
            echo "<script>alert('Registrasi gagal karena kesalahan sistem.');</script>";
        }
    }
}
?>
