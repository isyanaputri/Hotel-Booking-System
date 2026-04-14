<?php
session_start();
require_once 'data.php';

if (empty($_SESSION['reservasi_data'])) {
    header('Location: form.php');
    exit;
}

$data            = $_SESSION['reservasi_data'];
$metode          = $data['metode_pembayaran'];
$total           = $data['total_harga'];
$kode_booking    = 'DH-' . strtoupper(substr(md5(uniqid()), 0, 8));

if (empty($_SESSION['kode_booking'])) {
    $_SESSION['kode_booking'] = $kode_booking;
} else {
    $kode_booking = $_SESSION['kode_booking'];
}

$info_pembayaran = [
    'Transfer Bank' => [
        'icon'    => 'fa-building-columns',
        'title'   => 'Transfer Bank',
        'banks'   => [
            ['nama' => 'BCA',     'no_rek' => '1234567890',    'atas_nama' => 'PT Digitalheir Indonesia'],
            ['nama' => 'Mandiri', 'no_rek' => '0987654321',    'atas_nama' => 'PT Digitalheir Indonesia'],
            ['nama' => 'BNI',     'no_rek' => '1122334455',    'atas_nama' => 'PT Digitalheir Indonesia'],
            ['nama' => 'BRI',     'no_rek' => '5544332211',    'atas_nama' => 'PT Digitalheir Indonesia'],
        ],
        'instruksi' => [
            'Buka aplikasi mobile banking atau ATM Anda.',
            'Pilih menu Transfer dan masukkan nomor rekening tujuan.',
            'Masukkan nominal sesuai total tagihan.',
            'Pada kolom berita/keterangan, tulis kode booking Anda.',
            'Simpan bukti transfer dan hubungi kami via WhatsApp/Email.',
        ],
    ],
    'Kartu Kredit' => [
        'icon'      => 'fa-credit-card',
        'title'     => 'Kartu Kredit',
        'desc'      => 'Kami menerima Visa, Mastercard, dan American Express.',
        'instruksi' => [
            'Hubungi tim kami di ' . $site['phone'] . ' untuk proses pembayaran kartu kredit.',
            'Atau kirim email ke ' . $site['email'] . ' dengan subjek: KARTU KREDIT - ' . $kode_booking,
            'Tim kami akan mengirimkan payment link yang aman.',
            'Selesaikan pembayaran melalui link yang dikirimkan.',
        ],
        'cards'     => ['Visa', 'Mastercard', 'American Express'],
    ],
    'E-Wallet' => [
        'icon'      => 'fa-mobile-screen',
        'title'     => 'E-Wallet',
        'wallets'   => [
            ['nama' => 'GoPay',      'no' => '0812-3456-7890', 'qr' => true],
            ['nama' => 'OVO',        'no' => '0812-3456-7890', 'qr' => true],
            ['nama' => 'Dana',       'no' => '0812-3456-7890', 'qr' => true],
            ['nama' => 'ShopeePay',  'no' => '0812-3456-7890', 'qr' => true],
        ],
        'instruksi' => [
            'Buka aplikasi e-wallet pilihan Anda.',
            'Pilih menu Transfer / Kirim Uang.',
            'Masukkan nomor tujuan sesuai e-wallet yang dipilih.',
            'Masukkan nominal sesuai total tagihan.',
            'Pada kolom catatan, tulis kode booking Anda.',
            'Simpan bukti pembayaran dan kirimkan ke email kami.',
        ],
    ],
];

$info = $info_pembayaran[$metode] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembayaran — <?= htmlspecialchars($site['name']) ?></title>
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
      <div class="eyebrow light">LANGKAH 3 DARI 4</div>
      <h1 class="reservasi-title">Pembayaran</h1>
      <p class="light-text">Selesaikan pembayaran untuk mengkonfirmasi reservasi Anda.</p>
    </div>

    <div class="step-indicator">
      <div class="step done"><span><i class="fa-solid fa-check"></i></span><p>Isi Form</p></div>
      <div class="step-line active"></div>
      <div class="step done"><span><i class="fa-solid fa-check"></i></span><p>Review</p></div>
      <div class="step-line active"></div>
      <div class="step active"><span>3</span><p>Pembayaran</p></div>
      <div class="step-line"></div>
      <div class="step"><span>4</span><p>Konfirmasi</p></div>
    </div>

    <div class="payment-layout">

      <div class="payment-bill">
        <div class="bill-header">
          <i class="fa-solid fa-receipt"></i>
          <h3>Tagihan Reservasi</h3>
        </div>
        <div class="bill-kode">
          <span>Kode Booking</span>
          <strong id="kodeBooking"><?= htmlspecialchars($kode_booking) ?></strong>
          <button class="copy-btn" onclick="copyKode()"><i class="fa-solid fa-copy"></i></button>
        </div>
        <div class="bill-items">
          <div class="bill-item"><span>Kamar <?= htmlspecialchars($data['tipe_kamar']) ?></span><span>Rp <?= number_format($data['harga_per_malam'], 0, ',', '.') ?>/malam</span></div>
          <div class="bill-item"><span>Durasi</span><span><?= $data['durasi'] ?> malam</span></div>
          <div class="bill-item"><span>Check-in</span><span><?= date('d M Y', strtotime($data['tgl_checkin'])) ?></span></div>
          <div class="bill-item"><span>Check-out</span><span><?= date('d M Y', strtotime($data['tgl_checkout'])) ?></span></div>
          <div class="bill-item"><span>Jumlah Tamu</span><span><?= $data['jumlah_tamu'] ?> orang</span></div>
          <?php if (!empty($data['fasilitas'])): ?>
          <div class="bill-item"><span>Fasilitas</span><span><?= implode(', ', array_map('htmlspecialchars', $data['fasilitas'])) ?></span></div>
          <?php endif; ?>
        </div>
        <div class="bill-total">
          <span>Total Pembayaran</span>
          <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
        </div>
        <div class="bill-note">
          <i class="fa-solid fa-circle-info"></i>
          Setelah melakukan pembayaran, klik tombol <strong>"Konfirmasi Pembayaran"</strong> di bawah.
        </div>
      </div>

      <div class="payment-info">
        <div class="payment-method-badge">
          <i class="fa-solid <?= $info['icon'] ?>"></i>
          <span><?= htmlspecialchars($metode) ?></span>
        </div>

        <?php if ($metode === 'Transfer Bank'): ?>
        <div class="bank-list">
          <?php foreach ($info['banks'] as $bank): ?>
          <div class="bank-card">
            <div class="bank-name"><?= $bank['nama'] ?></div>
            <div class="bank-norek">
              <span id="rek_<?= $bank['nama'] ?>"><?= $bank['no_rek'] ?></span>
              <button onclick="copyText('rek_<?= $bank['nama'] ?>')" class="copy-btn"><i class="fa-solid fa-copy"></i></button>
            </div>
            <div class="bank-an">a.n. <?= $bank['atas_nama'] ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <?php elseif ($metode === 'Kartu Kredit'): ?>
        <div class="cc-cards">
          <?php foreach ($info['cards'] as $card): ?>
          <span class="cc-badge"><?= $card ?></span>
          <?php endforeach; ?>
        </div>
        <p class="payment-desc"><?= $info['desc'] ?></p>

        <?php elseif ($metode === 'E-Wallet'): ?>
        <div class="wallet-list">
          <?php foreach ($info['wallets'] as $wallet): ?>
          <div class="wallet-card">
            <div class="wallet-name"><?= $wallet['nama'] ?></div>
            <div class="wallet-no">
              <span id="ew_<?= str_replace(' ', '', $wallet['nama']) ?>"><?= $wallet['no'] ?></span>
              <button onclick="copyText('ew_<?= str_replace(' ', '', $wallet['nama']) ?>')" class="copy-btn"><i class="fa-solid fa-copy"></i></button>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="instruksi-box">
          <h4><i class="fa-solid fa-list-check"></i> Cara Pembayaran</h4>
          <ol>
            <?php foreach ($info['instruksi'] as $step): ?>
            <li><?= $step ?></li>
            <?php endforeach; ?>
          </ol>
        </div>

        <div class="payment-contact">
          <i class="fa-solid fa-headset"></i>
          <div>
            <strong>Butuh Bantuan?</strong>
            <span><?= htmlspecialchars($site['phone']) ?> · <?= htmlspecialchars($site['email']) ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-actions" style="margin-top:2rem;">
      <a href="review.php" class="btn-back" onclick="return confirm('Kembali ke halaman review?')">
        <i class="fa-solid fa-arrow-left"></i> Kembali
      </a>
      <a href="proses.php" class="btn-submit-reservasi">
        <i class="fa-solid fa-circle-check"></i> Konfirmasi Pembayaran
      </a>
    </div>

  </div>
</main>

<footer class="footer">
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name']) ?><?= htmlspecialchars($site['domain']) ?>. Semua hak dilindungi.</p>
  </div>
</footer>

<script>
function copyText(id) {
  const el = document.getElementById(id);
  navigator.clipboard.writeText(el.textContent).then(() => {
    const btn = el.nextElementSibling;
    btn.innerHTML = '<i class="fa-solid fa-check"></i>';
    setTimeout(() => btn.innerHTML = '<i class="fa-solid fa-copy"></i>', 2000);
  });
}
function copyKode() {
  const kode = document.getElementById('kodeBooking').textContent;
  navigator.clipboard.writeText(kode).then(() => {
    const btn = document.querySelector('.bill-kode .copy-btn');
    btn.innerHTML = '<i class="fa-solid fa-check"></i>';
    setTimeout(() => btn.innerHTML = '<i class="fa-solid fa-copy"></i>', 2000);
  });
}
</script>
</body>
</html>