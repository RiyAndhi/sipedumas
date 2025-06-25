<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 5%;">
    <h3 style="text-align: center;" class="orange-text">Registrasi!</h3>
    <form method="POST">
        <div class="input_field">
            <label for="nik">NIK</label>
            <input id="nik" type="text" name="nik" required>
        </div>
        <div class="input_field">
            <label for="nama">Nama</label>
            <input id="nama" type="text" name="nama" required>
        </div>
        <div class="input_field">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" required>
        </div>
        <div class="input_field">
            <label for="telp">Telp</label>
            <input id="telp" type="text" name="telp" required>
        </div>
        <div class="input_field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>
        <input type="submit" name="register" value="Daftar" class="btn orange" style="width: 100%;">
    </form>
</div>

<?php
if (isset($_POST['register'])) {
    // koneksi ke database
    include 'conn/koneksi.php';


    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    // simpan ke tabel masyarakat (bisa disesuaikan)
    $query = "INSERT INTO masyarakat (nik, nama, username, telp, password) 
              VALUES ('$nik', '$nama', '$username', '$telp', '$password')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='index.php?p=login';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!');</script>";
    }
}
?>
