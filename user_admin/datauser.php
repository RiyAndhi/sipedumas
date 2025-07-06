<h2 class="judul-riwayat">Manajemen Pengguna</h2>

<div style="margin-bottom: 20px; text-align: center;">
  <button class="btn-tambah-user" onclick="openModal('modalTambahUser')">
    <i class="fa fa-plus"></i> Tambah Admin / Petugas
  </button>
</div>

<?php $modals = []; ?>

<!-- ===================== -->
<!-- Data Admin -->
<h3 class="judul-riwayat">Data Admin</h3>
<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr><th>No</th><th>Nama</th><th>Username</th><th>Telepon</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $admin = mysqli_query($koneksi, "SELECT * FROM petugas WHERE level='admin'");
        if (mysqli_num_rows($admin) > 0) {
        while ($r = mysqli_fetch_assoc($admin)) {
            $id = $r['id_petugas'];
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$r['nama_petugas']}</td>
                    <td>{$r['username']}</td>
                    <td>{$r['telp_petugas']}</td>
                    <td>
                    <button class='btn-detail' onclick=\"openModal('edit{$id}')\">Edit</button>
                    <form method='post' style='display:inline;' onsubmit=\"return confirm('Yakin ingin menghapus user ini?')\">
                        <input type='hidden' name='hapus_user' value='{$id}'>
                        <button type='submit' class='btn-hapus'>Hapus</button>
                    </form>
                    </td>
                </tr>";

            $modals[] = "
                <div id='edit{$id}' class='modal'>
                <div class='modal-content'>
                    <h4>Edit Admin</h4>
                    <form method='post'>
                    <input type='hidden' name='id_petugas' value='{$id}'>
                    <label>Nama</label>
                    <input type='text' name='nama_petugas' value='{$r['nama_petugas']}' required>
                    <label>Username</label>
                    <input type='text' name='username' value='{$r['username']}' required>
                    <label>Telepon</label>
                    <input type='text' name='telp_petugas' value='{$r['telp_petugas']}' required>
                    <div class='modal-footer'>
                        <button type='submit' name='edit_user' class='btn-detail'>Simpan</button>
                        <button type='button' class='btn-close' onclick=\"closeModal('edit{$id}')\">Tutup</button>
                    </div>
                    </form>
                </div>
                </div>";
            $no++;
        }
    } else {
    echo "<tr><td colspan='5' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada data admin.</td></tr>";
    }
    ?>
    </tbody>
  </table>
</div>

<!-- ===================== -->
<!-- Data Petugas -->
<h3 class="judul-riwayat">Data Petugas</h3>
<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr><th>No</th><th>Nama</th><th>Username</th><th>Telepon</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $petugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE level='petugas'");
        if (mysqli_num_rows($petugas) > 0) {
            while ($r = mysqli_fetch_assoc($petugas)) {
                $id = $r['id_petugas'];
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$r['nama_petugas']}</td>
                        <td>{$r['username']}</td>
                        <td>{$r['telp_petugas']}</td>
                        <td>
                        <button class='btn-detail' onclick=\"openModal('edit{$id}')\">Edit</button>";
                        
                        if ($id != 1) {
                            echo "
                            <form method='post' style='display:inline;' onsubmit=\"return confirm('Yakin ingin menghapus user ini?')\">
                                <input type='hidden' name='hapus_user' value='{$id}'>
                                <button type='submit' class='btn-hapus'>Hapus</button>
                            </form>";
                        } else {
                            echo "<span style='font-size:0.8rem; color:gray;'>Tidak bisa dihapus</span>";
                        }

                        echo "</td>
                    </tr>";

                $modals[] = "
                <div id='edit{$id}' class='modal'>
                <div class='modal-content'>
                    <h4>Edit Petugas</h4>
                    <form method='post'>
                    <input type='hidden' name='id_petugas' value='{$id}'>
                    <label>Nama</label>
                    <input type='text' name='nama_petugas' value='{$r['nama_petugas']}' required>
                    <label>Username</label>
                    <input type='text' name='username' value='{$r['username']}' required>
                    <label>Telepon</label>
                    <input type='text' name='telp_petugas' value='{$r['telp_petugas']}' required>
                    <div class='modal-footer'>
                        <button type='submit' name='edit_user' class='btn-detail'>Simpan</button>
                        <button type='button' class='btn-close' onclick=\"closeModal('edit{$id}')\">Tutup</button>
                    </div>
                    </form>
                </div>
                </div>";
                $no++;
            }
        } else {
        echo "<tr><td colspan='5' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada data petugas.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- ===================== -->
<!-- Data Masyarakat -->
<h3 class="judul-riwayat">Data Masyarakat</h3>
<div class="riwayat-wrapper">
  <table class="riwayat-table">
    <thead>
      <tr><th>No</th><th>NIK</th><th>Nama</th><th>Username</th><th>Telepon</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $masyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat");
        if (mysqli_num_rows($masyarakat) > 0) {
        while ($r = mysqli_fetch_assoc($masyarakat)) {
        $id = $r['nik'];
        echo "<tr>
                <td>{$no}</td>
                <td>{$r['nik']}</td>
                <td>{$r['nama']}</td>
                <td>{$r['username']}</td>
                <td>{$r['telp']}</td>
                <td>
                  <button class='btn-detail' onclick=\"openModal('edit{$id}')\">Edit</button>
                  <form method='post' style='display:inline;' onsubmit=\"return confirm('Yakin ingin menghapus user ini?')\">
                    <input type='hidden' name='hapus_masyarakat' value='{$id}'>
                    <button type='submit' class='btn-hapus'>Hapus</button>
                  </form>
                </td>
              </tr>";

            $modals[] = "
            <div id='edit{$id}' class='modal'>
            <div class='modal-content'>
                <h4>Edit Masyarakat</h4>
                <form method='post'>
                <input type='hidden' name='nik' value='{$id}'>
                <label>Nama</label>
                <input type='text' name='nama' value='{$r['nama']}' required>
                <label>Username</label>
                <input type='text' name='username' value='{$r['username']}' required>
                <label>Telepon</label>
                <input type='text' name='telp' value='{$r['telp']}' required>
                <div class='modal-footer'>
                    <button type='submit' name='edit_masyarakat' class='btn-detail'>Simpan</button>
                    <button type='button' class='btn-close' onclick=\"closeModal('edit{$id}')\">Tutup</button>
                </div>
                </form>
            </div>
            </div>";
            $no++;
            }
        } else {
        echo "<tr><td colspan='6' style='text-align:center; padding:16px; font-style:italic; color:#888;'>Belum ada data masyarakat.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php
foreach ($modals as $modal) {
  echo $modal;
}

if (isset($_POST['simpan_user'])) {
  $nama_petugas = mysqli_real_escape_string($koneksi, $_POST['nama_petugas']);
  $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $telp_petugas = mysqli_real_escape_string($koneksi, $_POST['telp_petugas']);
  $level        = $_POST['level'];

  $cek_username = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");
  if (mysqli_num_rows($cek_username) > 0) {
    echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.'); location.href='index.php?p=datauser';</script>";
    exit;
  }

  mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas, username, password, telp_petugas, level)
                          VALUES ('$nama_petugas', '$username', '$password', '$telp_petugas', '$level')");
  echo "<script>alert('User berhasil ditambahkan'); location.href='index.php?p=datauser';</script>";
}

if (isset($_POST['edit_user'])) {
  $id_petugas   = $_POST['id_petugas'];
  $nama_petugas = mysqli_real_escape_string($koneksi, $_POST['nama_petugas']);
  $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
  $telp_petugas = mysqli_real_escape_string($koneksi, $_POST['telp_petugas']);

  $cek_username = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND id_petugas != '$id_petugas'");
  if (mysqli_num_rows($cek_username) > 0) {
    echo "<script>alert('Username sudah digunakan oleh user lain.'); location.href='index.php?p=datauser';</script>";
    exit;
  }

  mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama_petugas', username='$username', telp_petugas='$telp_petugas' WHERE id_petugas='$id_petugas'");
  echo "<script>alert('Data berhasil diperbarui'); location.href='index.php?p=datauser';</script>";
}

if (isset($_POST['edit_masyarakat'])) {
  $nik     = $_POST['nik'];
  $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $username= mysqli_real_escape_string($koneksi, $_POST['username']);
  $telp    = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $cek_username_masyarakat = mysqli_query($koneksi, "
    SELECT * FROM masyarakat WHERE username='$username' AND nik != '$nik'
    ");
    if (mysqli_num_rows($cek_username_masyarakat) > 0) {
    echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.'); location.href='index.php?p=datauser';</script>";
    exit;
    }

  mysqli_query($koneksi, "UPDATE masyarakat SET nama='$nama', username='$username', telp='$telp' WHERE nik='$nik'");
  echo "<script>alert('Data masyarakat berhasil diperbarui'); location.href='index.php?p=datauser';</script>";
}

if (isset($_POST['hapus_user'])) {
  $id = $_POST['hapus_user'];
  if ($id == 1) {
    echo "<script>alert('Admin utama tidak boleh dihapus'); location.href='index.php?p=datauser';</script>";
  } else {
    mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id'");
    echo "<script>alert('User berhasil dihapus'); location.href='index.php?p=datauser';</script>";
  }
}

if (isset($_POST['hapus_masyarakat'])) {
  $nik = $_POST['hapus_masyarakat'];
  mysqli_query($koneksi, "DELETE FROM masyarakat WHERE nik='$nik'");
  echo "<script>alert('Masyarakat berhasil dihapus'); location.href='index.php?p=datauser';</script>";
}
?>

<div id="modalTambahUser" class="modal">
  <div class="modal-content">
    <h4>Tambah Admin / Petugas</h4>
    <form method="post">
      <label>Nama</label>
      <input type="text" name="nama_petugas" required>
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <label>Telepon</label>
      <input type="text" name="telp_petugas" required>
      <label>Level</label>
        <div class="select-wrapper">
        <select name="level" required>
            <option value="" disabled selected>Pilih Level</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
        </div>
      <div class="modal-footer">
        <button type="submit" name="simpan_user" class="btn-detail">Simpan</button>
        <button type="button" class="btn-close" onclick="closeModal('modalTambahUser')">Tutup</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(id) {
  document.getElementById(id).style.display = "block";
}
function closeModal(id) {
  document.getElementById(id).style.display = "none";
}
window.onclick = function(event) {
  document.querySelectorAll(".modal").forEach(modal => {
    if (event.target == modal) modal.style.display = "none";
  });
}
</script>
