<h2 class="judul-riwayat">Dashboard Petugas</h2>

<div class="dashboard-cards">

  <!-- Laporan dalam Proses -->
  <a href="?p=pengaduan" class="card-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-tasks"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_proses = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE status='dalam proses'");
            echo mysqli_num_rows($q_proses);
          ?>
        </h3>
        <p>Laporan Perlu Ditangani</p>
      </div>
    </div>
  </a>

  <!-- Diselesaikan oleh Petugas Ini -->
  <a href="?p=pengaduan&filter=selesai-anda" class="card-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-user-check"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_selesai_anda = mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_petugas='".$_SESSION['data']['id_petugas']."'");
            echo mysqli_num_rows($q_selesai_anda);
          ?>
        </h3>
        <p>Selesai oleh Anda</p>
      </div>
    </div>
  </a>

  <!-- Semua Laporan Selesai -->
  <a href="?p=pengaduan&filter=selesai" class="card-link">
    <div class="card-box">
      <div class="icon"><i class="fas fa-check-circle"></i></div>
      <div class="info">
        <h3>
          <?php 
            $q_selesai_semua = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE status='selesai'");
            echo mysqli_num_rows($q_selesai_semua);
          ?>
        </h3>
        <p>Semua Laporan Selesai</p>
      </div>
    </div>
  </a>

</div>
