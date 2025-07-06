<h2 class="judul-riwayat">Laporan yang Perlu Ditangani</h2>

<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Tanggal Masuk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $modals = [];

        $pengaduan = mysqli_query($koneksi, "
          SELECT * FROM pengaduan 
          INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik 
          WHERE pengaduan.status = 'dalam proses' 
          ORDER BY pengaduan.id_pengaduan DESC
        ");

        if (mysqli_num_rows($pengaduan) > 0) {
          while ($r = mysqli_fetch_assoc($pengaduan)) {
            $id = $r['id_pengaduan'];
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$r['nik']}</td>
                    <td>{$r['nama']}</td>
                    <td>{$r['judul']}</td>
                    <td>{$r['tgl_pengaduan']}</td>
                    <td class='opsi'>
                      <button class='btn-detail' onclick=\"openModal('modal{$id}')\">Detail</button>
                    </td>
                  </tr>";
            $no++;

            $modals[] = "
<div id='modal{$id}' class='modal'>
  <div class='modal-content'>
    <h4>Detail Laporan</h4>
    <table class='detail-table'>
      <tr><th>Status</th><td>{$r['status']}</td></tr>
      <tr><th>Tanggal Masuk</th><td>{$r['tgl_pengaduan']}</td></tr>
      <tr><th>NIK</th><td>{$r['nik']}</td></tr>
      <tr><th>Nama</th><td>{$r['nama']}</td></tr>
      <tr><th>Judul</th><td>{$r['judul']}</td></tr>
      <tr><th>Keterangan</th><td>{$r['isi_laporan']}</td></tr>
      <tr><th>Lokasi Kejadian</th><td>" .
        (preg_match('/\(([^)]+)\)/', $r['lokasi'], $match)
          ? "<a href='https://www.google.com/maps/search/?api=1&query=" . urlencode($match[1]) . "' target='_blank' style='color:#1e88e5; text-decoration: underline;'>
              {$r['lokasi']}
            </a>"
          : $r['lokasi']
        ) . "</td></tr>
      <tr><th>Foto</th><td>".
        ($r['foto'] == "kosong"
          ? "<img src='../img/noImage.png' width='100'>"
          : "<img src='../img/upload/{$r['foto']}' width='100'>")
      ."</td></tr>
    </table>

<form method='post' style='margin-top: 16px;'>
  <input type='hidden' name='id_pengaduan' value='{$id}'>
  
  <label for='tanggapan{$id}' style='font-weight:bold; display:block; margin-bottom:6px;'>Tanggapan:</label>
  
  <input 
    type='text' 
    id='tanggapan{$id}' 
    name='tanggapan' 
    maxlength='50'
    placeholder='Masukkan tanggapan singkat'
    style='width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin-bottom:12px;' 
    required>

      <div class='modal-footer'>
        <button type='submit' name='selesaikan' class='btn-detail'>Terselesaikan</button>
        <button type='button' class='btn-close' onclick=\"closeModal('modal{$id}')\">Tutup</button>
      </div>
    </form>
  </div>
</div>";

          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Tidak ada laporan perlu diselesaikan.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- ========================== -->
<h2 class="judul-riwayat">Laporan yang Anda Selesaikan</h2>

<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Tanggal Masuk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $id_petugas_login = $_SESSION['data']['id_petugas'];

        $laporanAnda = mysqli_query($koneksi, "
          SELECT * FROM pengaduan 
          INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik 
          LEFT JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.id_pengaduan 
          WHERE pengaduan.status = 'selesai' AND tanggapan.id_petugas = '$id_petugas_login'
          ORDER BY pengaduan.id_pengaduan DESC
        ");

        if (mysqli_num_rows($laporanAnda) > 0) {
          while ($r = mysqli_fetch_assoc($laporanAnda)) {
            $id = $r['id_pengaduan'];
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$r['nik']}</td>
                    <td>{$r['nama']}</td>
                    <td>{$r['judul']}</td>
                    <td>{$r['tgl_pengaduan']}</td>
                    <td class='opsi'>
                      <button class='btn-detail' onclick=\"openModal('modalAnda{$id}')\">Detail</button>
                    </td>
                  </tr>";
            $no++;

            $modals[] = "
            <div id='modalAnda{$id}' class='modal'>
              <div class='modal-content'>
                <h4>Detail Laporan</h4>
                <table class='detail-table'>
                  <tr><th>Status</th><td>{$r['status']}</td></tr>
                  <tr><th>Tanggal Masuk</th><td>{$r['tgl_pengaduan']}</td></tr>
                  <tr><th>Tanggal Ditanggapi</th><td>{$r['tgl_tanggapan']}</td></tr>
                  <tr><th>NIK</th><td>{$r['nik']}</td></tr>
                  <tr><th>Nama</th><td>{$r['nama']}</td></tr>
                  <tr><th>Keterangan</th><td>{$r['isi_laporan']}</td></tr>
                  <tr><th>Lokasi Kejadian</th><td>" .
                  (preg_match('/\(([^)]+)\)/', $r['lokasi'], $match)
                    ? "<a href='https://www.google.com/maps/search/?api=1&query=" . urlencode($match[1]) . "' target='_blank' style='color:#1e88e5; text-decoration: underline;'>
                        {$r['lokasi']}
                      </a>"
                    : $r['lokasi']
                  ) . "</td></tr>
                  <tr><th>Foto</th><td>" .
                    ($r['foto'] == "kosong"
                      ? "<img src='../img/noImage.png' width='100'>"
                      : "<img src='../img/upload/{$r['foto']}' width='100'>") .
                  "</td></tr>
                  <tr><th>Respon</th><td>" . ($r['tanggapan'] ?? '-') . "</td></tr>
                </table>
                <div class='modal-footer'>
                  <button class='btn-close' onclick=\"closeModal('modalAnda{$id}')\">Tutup</button>
                </div>
              </div>
            </div>";
          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada laporan yang Anda selesaikan.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>


<!-- ========================== -->
<h2 class="judul-riwayat">Laporan Selesai</h2>

<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Tanggal Masuk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $no = 1;
        $laporanSelesai = mysqli_query($koneksi, "
            SELECT * FROM pengaduan 
            INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik 
            LEFT JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.id_pengaduan 
            LEFT JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas
            WHERE pengaduan.status = 'selesai' 
            ORDER BY pengaduan.id_pengaduan DESC
        ");

        if (mysqli_num_rows($laporanSelesai) > 0) {
          while ($r = mysqli_fetch_assoc($laporanSelesai)) {
            $id = $r['id_pengaduan'];
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$r['nik']}</td>
                    <td>{$r['nama']}</td>
                    <td>{$r['judul']}</td>
                    <td>{$r['tgl_pengaduan']}</td>
                    <td class='opsi'>
                      <button class='btn-detail' onclick=\"openModal('modal{$id}')\">Detail</button>
                    </td>
                  </tr>";
            $no++;

            $modals[] = "
            <div id='modal{$id}' class='modal'>
                <div class='modal-content'>
                    <h4>Detail Laporan</h4>
                    <table class='detail-table'>
                    <tr><th>Status</th><td>{$r['status']}</td></tr>
                    <tr><th>Tanggal Masuk</th><td>{$r['tgl_pengaduan']}</td></tr>
                    <tr><th>Tanggal Ditanggapi</th><td>{$r['tgl_tanggapan']}</td></tr>
                    <tr><th>NIK</th><td>{$r['nik']}</td></tr>
                    <tr><th>Nama</th><td>{$r['nama']}</td></tr>
                    <tr><th>Judul</th><td>{$r['judul']}</td></tr>
                    <tr><th>Keterangan</th><td>{$r['isi_laporan']}</td></tr>
                    <tr><th>Lokasi Kejadian</th><td>" .
                    (preg_match('/\(([^)]+)\)/', $r['lokasi'], $match)
                      ? "<a href='https://www.google.com/maps/search/?api=1&query=" . urlencode($match[1]) . "' target='_blank' style='color:#1e88e5; text-decoration: underline;'>
                          {$r['lokasi']}
                        </a>"
                      : $r['lokasi']
                    ) . "</td></tr>
                    <tr><th>Foto</th><td>".
                        ($r['foto'] == "kosong"
                        ? "<img src='../img/noImage.png' width='100'>"
                        : "<img src='../img/upload/{$r['foto']}' width='100'>")
                    ."</td></tr>
                    <tr><th>Petugas</th><td>{$r['nama_petugas']}</td></tr>
                    <tr><th>Respon</th><td>".($r['tanggapan'] ?? '-') ."</td></tr>
                    </table>
                    <div class='modal-footer'>
                    <button class='btn-close' onclick=\"closeModal('modal{$id}')\">Tutup</button>
                    </div>
                </div>
            </div>";
          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Tidak ada laporan yang terselesaikan.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php
  // Tampilkan semua modal
  foreach ($modals as $modal) {
    echo $modal;
  }

  if (isset($_POST['selesaikan'])) {
  $id_pengaduan = $_POST['id_pengaduan'];
  $tanggapan    = mysqli_real_escape_string($koneksi, $_POST['tanggapan']);
  $id_petugas   = $_SESSION['data']['id_petugas'];
  $tgl          = date('d-m-Y');

  mysqli_query($koneksi, "
    UPDATE pengaduan SET status = 'selesai' WHERE id_pengaduan = '$id_pengaduan'
  ");
  
  mysqli_query($koneksi, "
    INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) 
    VALUES ('$id_pengaduan', '$tgl', '$tanggapan', '$id_petugas')
  ");

  echo "<script>alert('Status berhasil diubah menjadi selesai!'); window.location.href='index.php?p=pengaduan';</script>";
}

?>

<script>
function openModal(id) {
  document.getElementById(id).style.display = "block";
}
function closeModal(id) {
  document.getElementById(id).style.display = "none";
}
window.onclick = function(event) {
  const modals = document.querySelectorAll(".modal");
  modals.forEach(modal => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
};
</script>
