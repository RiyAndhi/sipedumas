<?php
$data = $_SESSION['data'];
$nik = $data['nik'];
$no = 1;
$modals = [];

$pengaduan = mysqli_query($koneksi, "
  SELECT * FROM pengaduan
  WHERE nik = '$nik'
  ORDER BY id_pengaduan DESC
");
?>

<h2 class="judul-riwayat">Laporan Saya</h2>
<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Keterangan</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($pengaduan) > 0): ?>
        <?php while ($r = mysqli_fetch_assoc($pengaduan)): ?>
          <?php
            $id = $r['id_pengaduan'];
            echo "<tr>
              <td>{$no}</td>
              <td>{$r['judul']}</td>
              <td>{$r['tgl_pengaduan']}</td>
              <td class='status'>{$r['status']}</td>
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
                <tr><th>Tanggal Masuk</th><td>{$r['tgl_pengaduan']}</td></tr>";
                
                if ($r['status'] == 'selesai') {
                  $tanggapan = mysqli_query($koneksi, "SELECT * FROM tanggapan INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas WHERE id_pengaduan='$id'");
                  $res = mysqli_fetch_assoc($tanggapan);

                  $modals[count($modals)-1] .= "
                    <tr><th>Tanggal Tanggapan</th><td>{$res['tgl_tanggapan']}</td></tr>";
                }

          $modals[count($modals)-1] .= "
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
                ."</td></tr>";

                if ($r['status'] == 'selesai') {
                  $modals[count($modals)-1] .= "
                    <tr><th>Petugas</th><td>{$res['nama_petugas']}</td></tr>
                    <tr><th>Respon</th><td>{$res['tanggapan']}</td></tr>";
                }

          $modals[count($modals)-1] .= "
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

          ?>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center; padding:16px; font-style:italic; color:#888;">Belum ada laporan yang Anda kirimkan.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php
foreach ($modals as $modal) {
  echo $modal;
}

if (isset($_POST['hapus'])) {
  $id_pengaduan = $_POST['id_pengaduan'];
  $q = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
  $data = mysqli_fetch_assoc($q);

  if ($data['foto'] != "kosong" && file_exists("../img/upload/" . $data['foto'])) {
    unlink("../img/upload/" . $data['foto']);
  }

  if ($data['status'] == "selesai") {
    mysqli_query($koneksi, "DELETE FROM tanggapan WHERE id_pengaduan='$id_pengaduan'");
  }

  mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
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
