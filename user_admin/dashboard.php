<h2 class="judul-riwayat">Dashboard Admin</h2>

<div class="dashboard-cards">

  <!-- Laporan Perlu Dikonfirmasi -->
  <a href="index.php?p=pengaduan" class="card-box-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_konfirmasi = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE status='belum diproses'");
            echo mysqli_num_rows($q_konfirmasi);
          ?>
        </h3>
        <p>Laporan Perlu Dikonfirmasi</p>
      </div>
    </div>
  </a>

  <!-- Laporan Belum Ditangani -->
  <a href="index.php?p=pengaduan" class="card-box-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-tasks"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_belum = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE status='dalam proses'");
            echo mysqli_num_rows($q_belum);
          ?>
        </h3>
        <p>Laporan Sedang Ditangani</p>
      </div>
    </div>
  </a>

  <!-- Laporan Selesai -->
  <a href="index.php?p=pengaduan" class="card-box-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-check-circle"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_selesai = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE status='selesai'");
            echo mysqli_num_rows($q_selesai);
          ?>
        </h3>
        <p>Laporan Selesai</p>
      </div>
    </div>
  </a>

  <!-- Jumlah Admin -->
  <a href="index.php?p=datauser" class="card-box-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-user-shield"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_admin = mysqli_query($koneksi, "SELECT * FROM petugas WHERE level='admin'");
            echo mysqli_num_rows($q_admin);
          ?>
        </h3>
        <p>Jumlah Admin</p>
      </div>
    </div>
  </a>

  <!-- Jumlah Petugas -->
  <a href="index.php?p=datauser" class="card-box-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-user-tie"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_petugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE level='petugas'");
            echo mysqli_num_rows($q_petugas);
          ?>
        </h3>
        <p>Jumlah Petugas</p>
      </div>
    </div>
  </a>

  <!-- Jumlah Masyarakat -->
  <a href="index.php?p=datauser" class="card-box-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-users"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_masyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat");
            echo mysqli_num_rows($q_masyarakat);
          ?>
        </h3>
        <p>Jumlah Masyarakat</p>
      </div>
    </div>
  </a>

</div>
