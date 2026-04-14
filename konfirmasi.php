<?php
session_start();
require_once 'data.php';
require_once 'koneksi.php';

$success      = $_SESSION['reservasi_success'] ?? null;
$id_reservasi = $_SESSION['reservasi_id']      ?? null;
$kode_booking = $_SESSION['kode_booking']      ?? '-';

// Jika akses langsung tanpa proses
if ($success === null) {
    header('Location: form.php');
    exit;
}

$data = null;
if ($success && $id_reservasi) {
    $res = $conn->query("SELECT * FROM reservasi WHERE id_reservasi = $id_reservasi");
    if ($res) $data = $res->fetch_assoc();
}

unset($_SESSION['reservasi_success'], $_SESSION['reservasi_id'], $_SESSION['kode_booking'], $_SESSION['db_error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Konfirmasi — <?= htmlspecialchars($site['name']) ?></title>
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
  <div class="reservasi-container" style="max-width:800px;">

    <div class="step-indicator">
      <div class="step done"><span><i class="fa-solid fa-check"></i></span><p>Isi Form</p></div>
      <div class="step-line active"></div>
      <div class="step done"><span><i class="fa-solid fa-check"></i></span><p>Review</p></div>
      <div class="step-line active"></div>
      <div class="step done"><span><i class="fa-solid fa-check"></i></span><p>Pembayaran</p></div>
      <div class="step-line <?= $success ? 'active' : '' ?>"></div>
      <div class="step <?= $success ? 'done' : 'error' ?>">
        <span><i class="fa-solid <?= $success ? 'fa-check' : 'fa-xmark' ?>"></i></span>
        <p>Konfirmasi</p>
      </div>
    </div>

    <?php if ($success): ?>
    <div class="konfirmasi-box success">
      <div class="konfirmasi-icon success">
        <i class="fa-solid fa-circle-check"></i>
      </div>
      <h2>Reservasi Berhasil!</h2>
      <p class="konfirmasi-msg">Data Anda telah berhasil kami simpan.</p>
      <div class="kode-booking-display">
        <span>Kode Booking Anda</span>
        <strong><?= htmlspecialchars($kode_booking) ?></strong>
        <p>Simpan kode ini untuk keperluan check-in.</p>
      </div>

      <?php if ($data): ?>
      <div class="konfirmasi-summary">
        <h3><i class="fa-solid fa-list"></i> Ringkasan Reservasi</h3>
        <div class="summary-grid">
          <div class="summary-item"><span>Nama</span><strong><?= htmlspecialchars($data['nama_lengkap']) ?></strong></div>
          <div class="summary-item"><span>Email</span><strong><?= htmlspecialchars($data['email']) ?></strong></div>
          <div class="summary-item"><span>Telepon</span><strong><?= htmlspecialchars($data['nomor_telepon']) ?></strong></div>
          <div class="summary-item"><span>No. Identitas</span><strong><?= htmlspecialchars($data['nomor_identitas']) ?></strong></div>
          <div class="summary-item"><span>Tipe Kamar</span><strong><?= htmlspecialchars($data['tipe_kamar']) ?></strong></div>
          <div class="summary-item"><span>Jumlah Tamu</span><strong><?= htmlspecialchars($data['jumlah_tamu']) ?> orang</strong></div>
          <div class="summary-item"><span>Check-in</span><strong><?= date('d M Y', strtotime($data['tgl_checkin'])) ?></strong></div>
          <div class="summary-item"><span>Check-out</span><strong><?= date('d M Y', strtotime($data['tgl_checkout'])) ?></strong></div>
          <div class="summary-item"><span>Fasilitas</span><strong><?= $data['fasilitas'] ?: 'Tidak ada' ?></strong></div>
          <div class="summary-item"><span>Pembayaran</span><strong><?= htmlspecialchars($data['metode_pembayaran']) ?></strong></div>
          <div class="summary-item"><span>Status</span><strong class="badge-pending"><?= htmlspecialchars($data['status_pembayaran']) ?></strong></div>
          <?php if ($data['permintaan_khusus']): ?>
          <div class="summary-item full"><span>Catatan Khusus</span><strong><?= nl2br(htmlspecialchars($data['permintaan_khusus'])) ?></strong></div>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="konfirmasi-info">
        <i class="fa-solid fa-circle-info"></i>
        <p>Tim kami akan menghubungi Anda melalui <strong><?= htmlspecialchars($data['email'] ?? '') ?></strong> dalam 1×24 jam untuk konfirmasi pembayaran.</p>
      </div>
      <div class="konfirmasi-actions print-hidden">
    <button onclick="printSummary()" class="btn-submit-reservasi" style="background: #27ae60; cursor: pointer; border: none; padding: 10px 20px; color: white; border-radius: 5px;">
        <i class="fa-solid fa-file-pdf"></i> Unduh / Cetak Bukti
    </button>
    
    <a href="index.php" class="btn-submit-reservasi print-hidden" style="text-decoration: none;"><i class="fa-solid fa-house"></i> Kembali ke Beranda</a>
</div>

<script>
    function printSummary() {
        var summaryContent = document.querySelector('.konfirmasi-summary').innerHTML;
        var mainTitle = document.querySelector('.konfirmasi-box h2').innerHTML;
        var bookingCode = document.querySelector('.kode-booking-display').innerHTML;

        var originalContent = document.body.innerHTML;

        var printContent = '<div class="reservasi-container" style="max-width:800px; margin: 0 auto; padding: 20px; font-family: \'Plus Jakarta Sans\', sans-serif;">';
        printContent += '<h2 style="text-align: center; color: #2ecc71;">' + mainTitle + '</h2>';
        printContent += '<div class="kode-booking-display" style="text-align: center; margin-bottom: 20px;">' + bookingCode + '</div>';
        printContent += '<div class="konfirmasi-summary">' + summaryContent + '</div>';
        printContent += '</div>';

        document.body.innerHTML = printContent;

        window.print();

        document.body.innerHTML = originalContent;

        window.location.reload();
    }
</script>"index.php" class="btn-submit-reservasi"><i class="fa-solid fa-house"></i> Kembali ke Beranda</a>
</div>
    </div>

    <?php else: ?>

    <div class="konfirmasi-box error">
      <div class="konfirmasi-icon error">
        <i class="fa-solid fa-circle-xmark"></i>
      </div>
      <h2>Penyimpanan Gagal</h2>
      <p class="konfirmasi-msg">Terjadi kesalahan, data gagal disimpan.</p>
      <div class="konfirmasi-info error-info">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <p>Silakan coba kembali. Jika masalah berlanjut, hubungi tim kami di <strong><?= htmlspecialchars($site['phone']) ?></strong>.</p>
      </div>
      <div class="konfirmasi-actions">
        <a href="form.php" class="btn-submit-reservasi"><i class="fa-solid fa-rotate-left"></i> Coba Lagi</a>
        <a href="index.php" class="btn-back"><i class="fa-solid fa-house"></i> Beranda</a>
      </div>
    </div>
    <?php endif; ?>

  </div>
</main>

<footer class="footer">
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name']) ?><?= htmlspecialchars($site['domain']) ?>. Semua hak dilindungi.</p>
  </div>
</footer>
</body>
</html>