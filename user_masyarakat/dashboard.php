<div class="form-container">
  <div class="form-card">
    <h2 class="judul-riwayat">Tulis Laporan</h2>

    <form method="POST" enctype="multipart/form-data">
      <label for="judul">Judul Laporan</label>
      <input type="text" id="judul" name="judul" placeholder="Contoh: Lampu Jalan Mati" required maxlength="50" />

      <label for="laporan">Keterangan</label>
      <input type="text" id="laporan" name="laporan" placeholder="Masukkan keterangan" required />

      <label for="lokasi">Lokasi Kejadian</label>
      <div class="lokasi-wrapper">
        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi" required />
        <span class="ikon-lokasi" onclick="ambilLokasi()" title="Gunakan Lokasi">
          <i class="fas fa-location-dot"></i>
        </span>
        <span id="lokasiStatus" class="status-lokasi" style="display: none;">Lokasi berhasil diambil.</span>
      </div>

      <label for="foto">Foto <span style="color: red;">*</span></label>
      <input type="file" id="foto" name="foto" accept="image/*" required />

      <button type="submit" name="kirim">Kirim</button>
    </form>
  </div>
</div>

<?php 
if (isset($_POST['kirim'])) {
  $nik    = $_SESSION['data']['nik'];
  $judul  = mysqli_real_escape_string($koneksi, $_POST['judul']);
  $tgl    = date('d-m-Y');
  $isi    = mysqli_real_escape_string($koneksi, $_POST['laporan']);
  $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

  $foto    = $_FILES['foto']['name'];
  $source  = $_FILES['foto']['tmp_name'];
  $size    = $_FILES['foto']['size'];
  $folder  = './../img/upload/';
  $listeks = ['jpg', 'jpeg', 'png'];
  $pecah   = explode('.', $foto);
  $eks     = strtolower(end($pecah));

  $nama_baru = date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.jpg';

  if (strlen($judul) > 50) {
    echo "<script>alert('Judul tidak boleh lebih dari 50 karakter.'); location.href='index.php';</script>";
    exit;
  }

  if ($foto != "") {
    if (in_array($eks, $listeks)) {
      if ($size <= 10000000) {
        $destination = $folder . $nama_baru;

        // Kompres dan konversi ke JPG
        if ($eks == 'jpg' || $eks == 'jpeg') {
          $image = imagecreatefromjpeg($source);
        } elseif ($eks == 'png') {
          $image = imagecreatefrompng($source);
          $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
          $white = imagecolorallocate($bg, 255, 255, 255);
          imagefilledrectangle($bg, 0, 0, imagesx($image), imagesy($image), $white);
          imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
          imagedestroy($image);
          $image = $bg;
        }

        imagejpeg($image, $destination, 75);
        imagedestroy($image);

        $query = mysqli_query($koneksi, "
          INSERT INTO pengaduan VALUES (
            NULL, '$tgl', '$nik', '$judul', '$isi', '$nama_baru', '$lokasi', 'belum diproses'
          )
        ");

        if ($query) {
          echo "<script>alert('Pengaduan berhasil dikirim. Akan segera diproses.'); location='index.php';</script>";
        } else {
          echo "<script>alert('Gagal menyimpan ke database');</script>";
        }

      } else {
        echo "<script>alert('Ukuran gambar tidak boleh lebih dari 10MB');</script>";
      }
    } else {
      echo "<script>alert('Format file tidak didukung. Hanya jpg/jpeg/png.');</script>";
    }
  } else {
    echo "<script>alert('Foto wajib diunggah');</script>";
  }
}
?>

<script>
  function ambilLokasi() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        const koordinatFix = `${lat.toFixed(6)}, ${lon.toFixed(6)}`;

        const status = document.getElementById("lokasiStatus");
        status.textContent = "berhasil menggunakan lokasi saat ini.";
        status.style.color = "#4caf50";
        status.style.display = "inline";

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
          .then(response => response.json())
          .then(data => {
            const alamat = data.display_name;
            const gabungan = `${alamat} (${koordinatFix})`;
            document.getElementById("lokasi").value = gabungan;
          })
          .catch(err => {
            console.error(err);
            document.getElementById("lokasi").value = `Koordinat: (${koordinatFix})`;
          });
      },
      function () {
        const status = document.getElementById("lokasiStatus");
        status.textContent = "Gagal mengambil lokasi saat ini";
        status.style.color = "red";
        status.style.display = "inline";
      }
    );
  } else {
    alert("Geolocation tidak didukung di browser ini.");
  }
}
</script>