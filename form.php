<?php require_once 'data.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Reservasi — <?= htmlspecialchars($site['name']) ?></title>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="page-form">

<nav class="navbar scrolled" id="navbar">
  <div class="nav-container">
    <a href="index.php" class="nav-logo">
      <?= htmlspecialchars($site['name']) ?><span><?= htmlspecialchars($site['domain']) ?></span>
    </a>
    <ul class="nav-links" id="navLinks">
      <?php foreach ($nav_links as $link): ?>
        <li><a href="index.php<?= $link['href'] ?>" class="nav-link"><?= htmlspecialchars($link['label']) ?></a></li>
      <?php endforeach; ?>
    </ul>
    <button class="nav-toggle" id="navToggle" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<main class="reservasi-main">
  <div class="reservasi-container">

    <!-- Header -->
    <div class="reservasi-header">
      <div class="eyebrow light">PEMESANAN KAMAR</div>
      <h1 class="reservasi-title">Form Reservasi Hotel</h1>
      <p class="light-text">Isi data di bawah ini dengan lengkap dan benar untuk melanjutkan proses reservasi.</p>
    </div>

    <!-- Step Indicator -->
    <div class="step-indicator">
      <div class="step active"><span>1</span><p>Isi Form</p></div>
      <div class="step-line"></div>
      <div class="step"><span>2</span><p>Review</p></div>
      <div class="step-line"></div>
      <div class="step"><span>3</span><p>Pembayaran</p></div>
      <div class="step-line"></div>
      <div class="step"><span>4</span><p>Konfirmasi</p></div>
    </div>

    <form method="POST" action="review.php" enctype="multipart/form-data" class="reservasi-form" id="reservasiForm">

      <!-- ===== SECTION 1: DATA PRIBADI ===== -->
      <div class="form-section">
        <div class="form-section-header">
          <div class="form-section-icon"><i class="fa-solid fa-user"></i></div>
          <div>
            <h2>Data Pribadi</h2>
            <p>Informasi identitas diri pemesan</p>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label>Nama Lengkap <span class="req">*</span></label>
            <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap sesuai KTP" value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '') ?>" required/>
          </div>
          <div class="form-group">
            <label>Email <span class="req">*</span></label>
            <input type="email" name="email" placeholder="contoh@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required/>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label>Nomor Telepon <span class="req">*</span></label>
            <input type="tel" name="nomor_telepon" placeholder="+62 812 3456 7890" value="<?= htmlspecialchars($_POST['nomor_telepon'] ?? '') ?>" required/>
          </div>
          <div class="form-group">
            <label>Nomor Identitas (KTP/Paspor) <span class="req">*</span></label>
            <input type="text" name="nomor_identitas" placeholder="Masukkan nomor KTP atau Paspor" value="<?= htmlspecialchars($_POST['nomor_identitas'] ?? '') ?>" required/>
          </div>
        </div>

        <div class="form-group">
          <label>Alamat Lengkap <span class="req">*</span></label>
          <textarea name="alamat_lengkap" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi" rows="3" required><?= htmlspecialchars($_POST['alamat_lengkap'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
          <label>Upload Foto Identitas (KTP/Paspor) <span class="req">*</span></label>
          <div class="upload-area" id="uploadArea">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <p>Klik atau seret file ke sini</p>
            <span>Format: JPG, PNG, PDF. Maks 5MB</span>
            <input type="file" name="foto_identitas" id="fotoIdentitas" accept="image/*,.pdf" required/>
          </div>
          <div class="upload-preview" id="uploadPreview"></div>
        </div>
      </div>

      <!-- ===== SECTION 2: DETAIL PEMESANAN ===== -->
      <div class="form-section">
        <div class="form-section-header">
          <div class="form-section-icon"><i class="fa-solid fa-bed"></i></div>
          <div>
            <h2>Detail Pemesanan</h2>
            <p>Pilih tipe kamar dan jadwal menginap</p>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label>Tipe Kamar <span class="req">*</span></label>
            <select name="tipe_kamar" required>
              <option value="">-- Pilih Tipe Kamar --</option>
              <option value="Standard" <?= (($_POST['tipe_kamar'] ?? '') === 'Standard') ? 'selected' : '' ?>>Standard — Rp 1.000.000/malam</option>
              <option value="Deluxe"   <?= (($_POST['tipe_kamar'] ?? '') === 'Deluxe')   ? 'selected' : '' ?>>Deluxe — Rp 5.000.000/malam</option>
              <option value="Suite"    <?= (($_POST['tipe_kamar'] ?? '') === 'Suite')    ? 'selected' : '' ?>>Suite — Rp 20.000.000/malam</option>
              <option value="Presidential" <?= (($_POST['tipe_kamar'] ?? '') === 'Presidential') ? 'selected' : '' ?>>Presidential — Rp 75.000.000/malam</option>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Tamu <span class="req">*</span></label>
            <input type="number" name="jumlah_tamu" placeholder="Jumlah tamu (maks. 10)" min="1" max="10" value="<?= htmlspecialchars($_POST['jumlah_tamu'] ?? '') ?>" required/>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label>Tanggal Check-in <span class="req">*</span></label>
            <input type="date" name="tgl_checkin" id="tglCheckin" value="<?= htmlspecialchars($_POST['tgl_checkin'] ?? '') ?>" min="<?= date('Y-m-d') ?>" required/>
          </div>
          <div class="form-group">
            <label>Tanggal Check-out <span class="req">*</span></label>
            <input type="date" name="tgl_checkout" id="tglCheckout" value="<?= htmlspecialchars($_POST['tgl_checkout'] ?? '') ?>" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required/>
          </div>
        </div>

        <div class="durasi-info" id="durasiInfo" style="display:none;">
          <i class="fa-solid fa-moon"></i>
          <span id="durasiText"></span>
        </div>
      </div>

      <!-- ===== SECTION 3: FASILITAS TAMBAHAN ===== -->
      <div class="form-section">
        <div class="form-section-header">
          <div class="form-section-icon"><i class="fa-solid fa-star"></i></div>
          <div>
            <h2>Fasilitas Tambahan</h2>
            <p>Pilih fasilitas yang ingin Anda nikmati (opsional)</p>
          </div>
        </div>

        <div class="checkbox-grid">
          <?php
          $fasilitas_options = [
            ['value' => 'Sarapan',      'icon' => 'fa-utensils',       'label' => 'Sarapan',       'desc' => 'Breakfast untuk semua tamu'],
            ['value' => 'WiFi',         'icon' => 'fa-wifi',           'label' => 'WiFi Premium',  'desc' => 'Internet super cepat'],
            ['value' => 'Antar Jemput', 'icon' => 'fa-car',            'label' => 'Antar Jemput',  'desc' => 'Airport transfer'],
            ['value' => 'Kolam Renang', 'icon' => 'fa-water-ladder',   'label' => 'Kolam Renang',  'desc' => 'Infinity pool akses penuh'],
            ['value' => 'Gym',          'icon' => 'fa-dumbbell',       'label' => 'Gym',           'desc' => 'Pusat kebugaran 24 jam'],
            ['value' => 'Spa',          'icon' => 'fa-spa',            'label' => 'Spa & Relaksasi','desc' => 'Terapis profesional'],
          ];
          $selected_fasilitas = $_POST['fasilitas'] ?? [];
          foreach ($fasilitas_options as $f):
          ?>
          <label class="checkbox-card <?= in_array($f['value'], $selected_fasilitas) ? 'checked' : '' ?>">
            <input type="checkbox" name="fasilitas[]" value="<?= $f['value'] ?>" <?= in_array($f['value'], $selected_fasilitas) ? 'checked' : '' ?>>
            <div class="checkbox-card-inner">
              <i class="fa-solid <?= $f['icon'] ?>"></i>
              <strong><?= $f['label'] ?></strong>
              <span><?= $f['desc'] ?></span>
            </div>
            <div class="checkbox-check"><i class="fa-solid fa-check"></i></div>
          </label>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ===== SECTION 4: METODE PEMBAYARAN ===== -->
      <div class="form-section">
        <div class="form-section-header">
          <div class="form-section-icon"><i class="fa-solid fa-credit-card"></i></div>
          <div>
            <h2>Metode Pembayaran</h2>
            <p>Pilih cara pembayaran yang diinginkan</p>
          </div>
        </div>

        <div class="radio-grid">
          <?php
          $payment_options = [
            ['value' => 'Transfer Bank', 'icon' => 'fa-building-columns', 'label' => 'Transfer Bank',  'desc' => 'BCA, Mandiri, BNI, BRI'],
            ['value' => 'Kartu Kredit',  'icon' => 'fa-credit-card',      'label' => 'Kartu Kredit',   'desc' => 'Visa, Mastercard, AMEX'],
            ['value' => 'E-Wallet',      'icon' => 'fa-mobile-screen',    'label' => 'E-Wallet',       'desc' => 'GoPay, OVO, Dana, ShopeePay'],
          ];
          $selected_payment = $_POST['metode_pembayaran'] ?? '';
          foreach ($payment_options as $p):
          ?>
          <label class="radio-card <?= ($selected_payment === $p['value']) ? 'checked' : '' ?>">
            <input type="radio" name="metode_pembayaran" value="<?= $p['value'] ?>" <?= ($selected_payment === $p['value']) ? 'checked' : '' ?> required>
            <div class="radio-card-inner">
              <i class="fa-solid <?= $p['icon'] ?>"></i>
              <strong><?= $p['label'] ?></strong>
              <span><?= $p['desc'] ?></span>
            </div>
            <div class="radio-check"><i class="fa-solid fa-circle-dot"></i></div>
          </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="form-section">
        <div class="form-section-header">
          <div class="form-section-icon"><i class="fa-solid fa-message"></i></div>
          <div>
            <h2>Permintaan Khusus</h2>
            <p>Informasi tambahan yang ingin kami ketahui (opsional)</p>
          </div>
        </div>

        <div class="form-group">
          <label>Catatan Tambahan</label>
          <textarea name="permintaan_khusus" placeholder="Contoh: Mohon siapkan kamar di lantai atas, perlu tempat tidur bayi, alergi terhadap bahan tertentu, dll." rows="4"><?= htmlspecialchars($_POST['permintaan_khusus'] ?? '') ?></textarea>
        </div>
      </div>

      <!-- ===== TOMBOL SUBMIT ===== -->
      <div class="form-actions">
        <a href="index.php#kontak" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn-submit-reservasi">
          Review Pemesanan <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>

    </form>
  </div>
</main>

<footer class="footer">
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name']) ?><?= htmlspecialchars($site['domain']) ?>. Semua hak dilindungi.</p>
  </div>
</footer>

<script>
const uploadInput = document.getElementById('fotoIdentitas');
const uploadArea  = document.getElementById('uploadArea');
const uploadPreview = document.getElementById('uploadPreview');

uploadArea.addEventListener('click', () => uploadInput.click());
uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('dragover'); });
uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
uploadArea.addEventListener('drop', e => {
  e.preventDefault();
  uploadArea.classList.remove('dragover');
  uploadInput.files = e.dataTransfer.files;
  showPreview(uploadInput.files[0]);
});
uploadInput.addEventListener('change', () => { if (uploadInput.files[0]) showPreview(uploadInput.files[0]); });

function showPreview(file) {
  uploadPreview.innerHTML = `<i class="fa-solid fa-file-image"></i> <span>${file.name}</span> <small>(${(file.size/1024).toFixed(1)} KB)</small>`;
  uploadArea.classList.add('has-file');
}

const checkin  = document.getElementById('tglCheckin');
const checkout = document.getElementById('tglCheckout');
const durasiInfo = document.getElementById('durasiInfo');
const durasiText = document.getElementById('durasiText');

function hitungDurasi() {
  if (checkin.value && checkout.value) {
    const d1 = new Date(checkin.value);
    const d2 = new Date(checkout.value);
    const diff = Math.round((d2 - d1) / (1000*60*60*24));
    if (diff > 0) {
      durasiText.textContent = `Durasi menginap: ${diff} malam`;
      durasiInfo.style.display = 'flex';
      checkout.min = checkin.value;
    } else {
      durasiInfo.style.display = 'none';
      checkout.value = '';
    }
  }
}

checkin.addEventListener('change', () => {
  const next = new Date(checkin.value);
  next.setDate(next.getDate() + 1);
  checkout.min = next.toISOString().split('T')[0];
  if (checkout.value && checkout.value <= checkin.value) checkout.value = '';
  hitungDurasi();
});
checkout.addEventListener('change', hitungDurasi);

document.querySelectorAll('.checkbox-card input').forEach(cb => {
  cb.addEventListener('change', () => {
    cb.closest('.checkbox-card').classList.toggle('checked', cb.checked);
  });
});

document.querySelectorAll('.radio-card input').forEach(rb => {
  rb.addEventListener('change', () => {
    document.querySelectorAll('.radio-card').forEach(c => c.classList.remove('checked'));
    rb.closest('.radio-card').classList.add('checked');
  });
});

document.getElementById('navToggle').addEventListener('click', () => {
  document.getElementById('navLinks').classList.toggle('open');
});
</script>
</body>
</html>