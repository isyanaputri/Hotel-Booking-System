<?php
require_once 'data.php';

// Validasi: harus dari POST form.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}

$nama_lengkap      = trim($_POST['nama_lengkap']      ?? '');
$email             = trim($_POST['email']             ?? '');
$nomor_telepon     = trim($_POST['nomor_telepon']     ?? '');
$alamat_lengkap    = trim($_POST['alamat_lengkap']    ?? '');
$nomor_identitas   = trim($_POST['nomor_identitas']   ?? '');
$tipe_kamar        = trim($_POST['tipe_kamar']        ?? '');
$jumlah_tamu       = trim($_POST['jumlah_tamu']       ?? '');
$tgl_checkin       = trim($_POST['tgl_checkin']       ?? '');
$tgl_checkout      = trim($_POST['tgl_checkout']      ?? '');
$fasilitas         = $_POST['fasilitas']              ?? [];
$metode_pembayaran = trim($_POST['metode_pembayaran'] ?? '');
$permintaan_khusus = trim($_POST['permintaan_khusus'] ?? '');

$errors = [];
if (!$nama_lengkap)      $errors[] = 'Nama Lengkap wajib diisi.';
if (!$email)             $errors[] = 'Email wajib diisi.';
if (!$nomor_telepon)     $errors[] = 'Nomor Telepon wajib diisi.';
if (!$alamat_lengkap)    $errors[] = 'Alamat Lengkap wajib diisi.';
if (!$nomor_identitas)   $errors[] = 'Nomor Identitas wajib diisi.';
if (!$tipe_kamar)        $errors[] = 'Tipe Kamar wajib dipilih.';
if (!$jumlah_tamu)       $errors[] = 'Jumlah Tamu wajib diisi.';
if (!$tgl_checkin)       $errors[] = 'Tanggal Check-in wajib diisi.';
if (!$tgl_checkout)      $errors[] = 'Tanggal Check-out wajib diisi.';
if (!$metode_pembayaran) $errors[] = 'Metode Pembayaran wajib dipilih.';

$foto_identitas = '';
if (isset($_FILES['foto_identitas']) && $_FILES['foto_identitas']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
    $ext       = pathinfo($_FILES['foto_identitas']['name'], PATHINFO_EXTENSION);
    $filename  = 'id_' . time() . '_' . uniqid() . '.' . $ext;
    $target    = $upload_dir . $filename;
    if (move_uploaded_file($_FILES['foto_identitas']['tmp_name'], $target)) {
        $foto_identitas = $filename;
    } else {
        $errors[] = 'Gagal mengupload foto identitas.';
    }
} elseif (empty($errors)) {
    $errors[] = 'Foto identitas wajib diupload.';
}

if (!empty($errors)) {
    session_start();
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data']   = $_POST;
    header('Location: form.php');
    exit;
}

$harga = ['Standard' => 1000000, 'Deluxe' => 5000000, 'Suite' => 20000000, 'Presidential' => 75000000];
$harga_per_malam = $harga[$tipe_kamar] ?? 0;
$d1 = new DateTime($tgl_checkin);
$d2 = new DateTime($tgl_checkout);
$durasi = $d1->diff($d2)->days;
$total_harga = $harga_per_malam * $durasi;

session_start();
$_SESSION['reservasi_data'] = [
    'nama_lengkap'      => $nama_lengkap,
    'email'             => $email,
    'nomor_telepon'     => $nomor_telepon,
    'alamat_lengkap'    => $alamat_lengkap,
    'nomor_identitas'   => $nomor_identitas,
    'foto_identitas'    => $foto_identitas,
    'tipe_kamar'        => $tipe_kamar,
    'jumlah_tamu'       => $jumlah_tamu,
    'tgl_checkin'       => $tgl_checkin,
    'tgl_checkout'      => $tgl_checkout,
    'fasilitas'         => $fasilitas,
    'metode_pembayaran' => $metode_pembayaran,
    'permintaan_khusus' => $permintaan_khusus,
    'harga_per_malam'   => $harga_per_malam,
    'durasi'            => $durasi,
    'total_harga'       => $total_harga,
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Review Pemesanan — <?= htmlspecialchars($site['name']) ?></title>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="page-form">

<nav class="navbar scrolled">
  <div class="nav-container">
    <a href="index.php" class="nav-logo">
      <?= htmlspecialchars($site['name']) ?><span><?= htmlspecialchars($site['domain']) ?></span>
    </a>
  </div>
</nav>

<main class="reservasi-main">
  <div class="reservasi-container">

    <div class="reservasi-header">
      <div class="eyebrow light">LANGKAH 2 DARI 4</div>
      <h1 class="reservasi-title">Review Pemesanan</h1>
      <p class="light-text">Periksa kembali data Anda sebelum melanjutkan ke pembayaran.</p>
    </div>

    <div class="step-indicator">
      <div class="step done"><span><i class="fa-solid fa-check"></i></span><p>Isi Form</p></div>
      <div class="step-line active"></div>
      <div class="step active"><span>2</span><p>Review</p></div>
      <div class="step-line"></div>
      <div class="step"><span>3</span><p>Pembayaran</p></div>
      <div class="step-line"></div>
      <div class="step"><span>4</span><p>Konfirmasi</p></div>
    </div>

    <div class="review-grid">

      <div class="review-card">
        <div class="review-card-header">
          <i class="fa-solid fa-user"></i>
          <h3>Data Pribadi</h3>
        </div>
        <div class="review-items">
          <div class="review-item"><span>Nama Lengkap</span><strong><?= htmlspecialchars($nama_lengkap) ?></strong></div>
          <div class="review-item"><span>Email</span><strong><?= htmlspecialchars($email) ?></strong></div>
          <div class="review-item"><span>Nomor Telepon</span><strong><?= htmlspecialchars($nomor_telepon) ?></strong></div>
          <div class="review-item"><span>Nomor Identitas</span><strong><?= htmlspecialchars($nomor_identitas) ?></strong></div>
          <div class="review-item"><span>Alamat</span><strong><?= nl2br(htmlspecialchars($alamat_lengkap)) ?></strong></div>
          <?php if ($foto_identitas): ?>
          <div class="review-item"><span>Foto Identitas</span><strong><i class="fa-solid fa-file-image"></i> <?= htmlspecialchars($foto_identitas) ?></strong></div>
          <?php endif; ?>
        </div>
      </div>

      <div class="review-card">
        <div class="review-card-header">
          <i class="fa-solid fa-bed"></i>
          <h3>Detail Pemesanan</h3>
        </div>
        <div class="review-items">
          <div class="review-item"><span>Tipe Kamar</span><strong><?= htmlspecialchars($tipe_kamar) ?></strong></div>
          <div class="review-item"><span>Jumlah Tamu</span><strong><?= htmlspecialchars($jumlah_tamu) ?> orang</strong></div>
          <div class="review-item"><span>Check-in</span><strong><?= date('d M Y', strtotime($tgl_checkin)) ?></strong></div>
          <div class="review-item"><span>Check-out</span><strong><?= date('d M Y', strtotime($tgl_checkout)) ?></strong></div>
          <div class="review-item"><span>Durasi</span><strong><?= $durasi ?> malam</strong></div>
        </div>
      </div>

      <div class="review-card">
        <div class="review-card-header">
          <i class="fa-solid fa-star"></i>
          <h3>Fasilitas & Pembayaran</h3>
        </div>
        <div class="review-items">
          <div class="review-item">
            <span>Fasilitas Tambahan</span>
            <strong><?= !empty($fasilitas) ? implode(', ', array_map('htmlspecialchars', $fasilitas)) : 'Tidak ada' ?></strong>
          </div>
          <div class="review-item"><span>Metode Pembayaran</span><strong><?= htmlspecialchars($metode_pembayaran) ?></strong></div>
          <?php if ($permintaan_khusus): ?>
          <div class="review-item"><span>Catatan Khusus</span><strong><?= nl2br(htmlspecialchars($permintaan_khusus)) ?></strong></div>
          <?php endif; ?>
        </div>
      </div>

      <div class="review-card price-card">
        <div class="review-card-header">
          <i class="fa-solid fa-receipt"></i>
          <h3>Ringkasan Harga</h3>
        </div>
        <div class="review-items">
          <div class="review-item"><span>Harga per Malam</span><strong>Rp <?= number_format($harga_per_malam, 0, ',', '.') ?></strong></div>
          <div class="review-item"><span>Durasi</span><strong><?= $durasi ?> malam</strong></div>
          <div class="review-item total-row"><span>Total Pembayaran</span><strong class="total-price">Rp <?= number_format($total_harga, 0, ',', '.') ?></strong></div>
        </div>
      </div>

    </div>

    <div class="form-actions">
      <a href="form.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Ubah Data</a>
      <a href="pembayaran.php" class="btn-submit-reservasi">
        Lanjut ke Pembayaran <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

  </div>
</main>

<footer class="footer">
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name']) ?><?= htmlspecialchars($site['domain']) ?>. Semua hak dilindungi.</p>
  </div>
</footer>
</body>
</html>