<?php 
  $data = $_SESSION['data']; 
?>

<h2 class="akun-title">Profil Saya</h2>

<div class="akun-card">
  <div class="akun-photo">
    <img src="../img/profil.png" alt="Foto Profil">
  </div>

  <table class="akun-table">
    <tr>
      <th>Nama</th>
      <td><?= $data['nama_petugas'] ?></td>
    </tr>
    <tr>
      <th>Username</th>
      <td><?= $data['username'] ?></td>
    </tr>
    <tr>
      <th>Level</th>
      <td><?= $data['level'] ?></td>
    </tr>
  </table>

  <a href="../logout.php" class="akun-logout">
    <i class="fas fa-sign-out-alt"></i> Keluar
  </a>
</div>
  
