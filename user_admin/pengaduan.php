<?php
// Bagian Konfirmasi Laporan oleh Admin
?>
<h2 class="judul-riwayat">Laporan Perlu Dikonfirmasi</h2>
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
        $konfirmasi = mysqli_query($koneksi, "
          SELECT * FROM pengaduan 
          INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik 
          WHERE pengaduan.status = 'belum diproses' 
          ORDER BY pengaduan.id_pengaduan DESC
        ");

        if (mysqli_num_rows($konfirmasi) > 0) {
          while ($r = mysqli_fetch_assoc($konfirmasi)) {
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
      <div class='modal-footer'>
        <button type='submit' name='konfirmasi' class='btn-detail'>Konfirmasi</button>
        <button type='submit' name='hapus' class='btn-hapus-modal' onclick=\"return confirm('Yakin ingin menghapus laporan ini?')\">Hapus</button>
        <button type='button' class='btn-close' onclick=\"closeModal('modal{$id}')\">Tutup</button>
      </div>
    </form>
  </div>
</div>";
          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada laporan yang perlu dikonfirmasi.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php
// Bagian Laporan Sedang Ditangani
?>
<h2 class="judul-riwayat">Laporan Sedang Ditangani</h2>
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
        $proses = mysqli_query($koneksi, "
          SELECT * FROM pengaduan 
          INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik 
          WHERE pengaduan.status = 'dalam proses' 
          ORDER BY pengaduan.id_pengaduan DESC
        ");

        if (mysqli_num_rows($proses) > 0) {
          while ($r = mysqli_fetch_assoc($proses)) {
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
      <div class='modal-footer'>
        <button type='submit' name='hapus' class='btn-hapus-modal' onclick=\"return confirm('Yakin ingin menghapus laporan ini?')\">Hapus</button>
        <button type='button' class='btn-close' onclick=\"closeModal('modal{$id}')\">Tutup</button>
      </div>
    </form>
  </div>
</div>";
          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada laporan yang sedang ditangani.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php
// Bagian Laporan Selesai
?>
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
        $selesai = mysqli_query($koneksi, "
          SELECT * FROM pengaduan 
          INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik 
          LEFT JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.id_pengaduan 
          LEFT JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas
          WHERE pengaduan.status = 'selesai' 
          ORDER BY pengaduan.id_pengaduan DESC
        ");

        if (mysqli_num_rows($selesai) > 0) {
          while ($r = mysqli_fetch_assoc($selesai)) {
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
    <form method='post' style='margin-top: 16px;'>
      <input type='hidden' name='id_pengaduan' value='{$id}'>
      <div class='modal-footer'>
        <button type='submit' name='hapus' class='btn-hapus-modal' onclick=\"return confirm('Yakin ingin menghapus laporan ini?')\">Hapus</button>
        <button type='button' class='btn-close' onclick=\"closeModal('modal{$id}')\">Tutup</button>
      </div>
    </form>
  </div>
</div>";
          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada laporan yang terselesaikan.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php
foreach ($modals as $modal) {
  echo $modal;
}

if (isset($_POST['konfirmasi'])) {
  $id_pengaduan = $_POST['id_pengaduan'];
  mysqli_query($koneksi, "UPDATE pengaduan SET status='dalam proses' WHERE id_pengaduan='$id_pengaduan'");
  echo "<script>alert('Laporan dikonfirmasi.'); window.location.href='index.php?p=pengaduan';</script>";
}

if (isset($_POST['hapus'])) {
  $id_pengaduan = $_POST['id_pengaduan'];

  // Ambil data foto & status
  $q = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
  $data = mysqli_fetch_assoc($q);

  // Hapus foto jika bukan "kosong"
  if ($data['foto'] != "kosong" && file_exists("../img/upload/" . $data['foto'])) {
    unlink("../img/upload/" . $data['foto']);
  }

  // Hapus tergantung status
  if ($data['status'] == "belum diproses" || $data['status'] == "dalam proses") {
    mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
  } elseif ($data['status'] == "selesai") {
    // HAPUS tanggapan dulu baru pengaduan
    mysqli_query($koneksi, "DELETE FROM tanggapan WHERE id_pengaduan='$id_pengaduan'");
    mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
  }

  echo "<script>alert('Laporan berhasil dihapus.'); window.location.href='index.php?p=pengaduan';</script>";
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
