<?php
include 'conn/koneksi.php';

$total_selesai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as selesai FROM pengaduan WHERE status='selesai'"));
$total_proses = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as proses FROM pengaduan WHERE status='proses'"));
?>

<div style="max-width: 1280px; margin: 80px auto; padding: 40px 20px; background-color: rgba(255,255,255,0.96); border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">

  <!-- Hero -->
  <div class="row valign-wrapper" style="margin-bottom: 60px;">
    <div class="col s12 m6">
      <h2 style="font-weight: 700; color: #333;">SIPEDUMAS</h2>
      <p style="font-size: 17px; color: #555;">Sistem Pengaduan Masyarakat berbasis web untuk menampung laporan publik dan memastikan tindak lanjut secara cepat, adil, dan transparan.</p>
      <a href="?p=login" class="btn-large orange darken-2 waves-effect waves-light" style="margin-top: 24px; border-radius: 8px;">Laporkan Sekarang</a>
    </div>
    <div class="col s12 m6 center-align">
      <img src="img/sipedumas_hero.svg" alt="Ilustrasi SIPEDUMAS" style="max-width: 100%; height: auto;">
    </div>
  </div>

  <!-- Statistics -->
  <div class="row center-align" style="margin-bottom: 60px;">
    <div class="col s12 m6">
      <div style="background-color: #fff3e0; border-left: 6px solid #fb8c00; padding: 20px 16px; border-radius: 12px;">
        <h6 style="margin: 0; font-weight: 500; color: #fb8c00;">Sedang Diproses</h6>
        <h4 style="margin: 4px 0; color: #fb8c00; font-weight: 600;"><?= $total_proses['proses'] ?> laporan</h4>
      </div>
    </div>
    <div class="col s12 m6">
      <div style="background-color: #e8f5e9; border-left: 6px solid #43a047; padding: 20px 16px; border-radius: 12px;">
        <h6 style="margin: 0; font-weight: 500; color: #2e7d32;">Selesai</h6>
        <h4 style="margin: 4px 0; color: #2e7d32; font-weight: 600;"><?= $total_selesai['selesai'] ?> laporan</h4>
      </div>
    </div>
  </div>

  <!-- Fitur -->
  <div style="margin-bottom: 60px;">
    <h5 class="center-align" style="font-weight: 600; color: #333;">Kenapa Memilih SIPEDUMAS?</h5>
    <div class="row" style="margin-top: 30px;">
      <div class="col s12 m4 center-align">
        <img src="img/icon_form.svg" style="width: 64px;"><br>
        <h6 style="margin: 12px 0 4px; font-weight: 500;">Form Mudah</h6>
        <p style="font-size: 14px; color: #666;">Isi laporan dalam waktu singkat dengan antarmuka bersih dan efisien.</p>
      </div>
      <div class="col s12 m4 center-align">
        <img src="img/icon_tracking.svg" style="width: 64px;"><br>
        <h6 style="margin: 12px 0 4px; font-weight: 500;">Lacak Kapan Saja</h6>
        <p style="font-size: 14px; color: #666;">Pantau perkembangan laporan Anda setiap saat secara real-time.</p>
      </div>
      <div class="col s12 m4 center-align">
        <img src="img/icon_petugas.svg" style="width: 64px;"><br>
        <h6 style="margin: 12px 0 4px; font-weight: 500;">Petugas Responsif</h6>
        <p style="font-size: 14px; color: #666;">Laporan Anda langsung ditangani oleh petugas sesuai kategori.</p>
      </div>
    </div>
  </div>

  <!-- Ajakan -->
  <div class="center-align">
    <h5 style="font-weight: 600; color: #333;">Ayo Sampaikan Pengaduan Anda</h5>
    <p style="max-width: 600px; margin: 0 auto; font-size: 15px; color: #555;">Setiap laporan Anda sangat berarti. SIPEDUMAS hadir untuk memastikan semua suara masyarakat didengar dan ditindaklanjuti secara adil dan transparan.</p>
    <a href=register.php class=\"btn orange darken-2\" style=\"margin-top: 20px; border-radius: 8px; padding: 0 24px;\">Mulai Sekarang</a>
  </div>

</div>
