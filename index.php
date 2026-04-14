<?php require_once 'data.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($site['name']) ?> — <?= htmlspecialchars($site['tagline']) ?></title>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

<nav class="navbar" id="navbar">
  <div class="nav-container">
    <a href="#beranda" class="nav-logo">
      <?= htmlspecialchars($site['name']) ?><span><?= htmlspecialchars($site['domain']) ?></span>
    </a>
    <ul class="nav-links" id="navLinks">
      <?php foreach ($nav_links as $link): ?>
        <li>
          <a href="<?= $link['href'] ?>" class="nav-link">
            <?= htmlspecialchars($link['label']) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="nav-actions">
      <a href="#login" class="btn-login">Login</a>
      <a href="form.php" class="btn-reservasi">Reservasi</a>
    </div>
    <button class="nav-toggle" id="navToggle" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<section class="hero" id="beranda">
  <div class="hero-bg"></div>
</section>

<section class="tentang section-white" id="tentang">
  <div class="container tentang-grid">
    <div class="tentang-text">
      <div class="eyebrow">TENTANG KAMI</div>
      <h2 class="section-title">Tentang Digitalheir</h2>
      <p>Digitalheir bukan sekadar destinasi penginapan, melainkan sebuah manifestasi dari kesenangan dan keistimewaan. Lahir dari visi untuk menghubungkan komunitas eksklusif dengan kenyamanan premium.</p>
      <p>Setiap elemen di Digitalheir dirancang dengan prinsip <strong>"Invisible Protection"</strong>. Dari sistem biometrik hingga komunitas anonim, kami memastikan satu-satunya hal yang Anda pikirkan adalah bagaimana menikmati momen yang indah.</p>
      <div class="tentang-stats">
        <div class="stat"><span class="stat-num">500+</span><span class="stat-label">Tamu Puas</span></div>
        <div class="stat"><span class="stat-num">4.9★</span><span class="stat-label">Rating</span></div>
        <div class="stat"><span class="stat-num">24/7</span><span class="stat-label">Layanan</span></div>
      </div>
      <div class="tentang-location">
        <i class="fa-solid fa-location-dot"></i>
        <span><?= htmlspecialchars($site['address']) ?></span>
      </div>
    </div>
    <div class="tentang-visual">
      <div class="tentang-img-main"></div>
      <div class="tentang-quote-card">
        <i class="fa-solid fa-quote-left"></i>
        <p>Bertemu orang besar ternyata memang bisa jauh lebih berkesan dalam suasana yang tepat.</p>
      </div>
    </div>
  </div>
</section>

<section class="fasilitas section-blue" id="fasilitas">
  <div class="container">
    <div class="eyebrow light">LAYANAN EKSKLUSIF</div>
    <h2 class="section-title light">Fasilitas Hotel</h2>
    <p class="section-sub light">Kami menyediakan yang terbaik agar pengalaman menginap Anda menjadi sempurna.</p>
    <div class="fasilitas-grid">
      <?php foreach ($fasilitas as $f): ?>
      <div class="fcard">
        <div class="fcard-icon"><i class="fa-solid <?= $f['icon'] ?>"></i></div>
        <h3><?= htmlspecialchars($f['title']) ?></h3>
        <p><?= htmlspecialchars($f['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="kamar section-white" id="kamar">
  <div class="container">
    <div class="kamar-header">
      <div>
        <div class="eyebrow">PILIHAN KAMAR</div>
        <h2 class="section-title">Kamar &amp; Suite</h2>
        <p class="section-sub">Temukan tempat peristirahatan sempurna yang sesuai kebutuhan Anda.</p>
      </div>
      <div class="slider-controls">
        <button class="slider-btn" id="slidePrev" aria-label="Previous">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="slider-btn" id="slideNext" aria-label="Next">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="slider-viewport">
    <div class="slider-track" id="sliderTrack">
      <?php foreach ($rooms as $i => $room): ?>
      <div class="room-card" data-index="<?= $i ?>">
        <?php if ($room['badge']): ?>
          <div class="room-badge"><?= htmlspecialchars($room['badge']) ?></div>
        <?php endif; ?>
        <div class="room-img" style="background-image: url('<?= $room['img_url'] ?>')">
          <div class="room-img-overlay"></div>
          <div class="room-type-tag"><?= htmlspecialchars($room['type']) ?></div>
        </div>
        <div class="room-body">
          <div class="room-head">
            <h3><?= htmlspecialchars($room['title']) ?></h3>
            <div class="room-rating">
              <i class="fa-solid fa-star"></i> <?= htmlspecialchars($room['rating']) ?>
            </div>
          </div>
          <p><?= htmlspecialchars($room['desc']) ?></p>
          <div class="room-features">
            <?php foreach ($room['features'] as $feat): ?>
              <span class="room-feat"><i class="fa-solid fa-check"></i> <?= htmlspecialchars($feat) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="room-footer">
            <div class="room-price">
              <span class="price-label">Mulai dari</span>
              <span class="price-val"><?= htmlspecialchars($room['price']) ?></span>
              <span class="price-per">/malam</span>
            </div>
            <a href="#kontak" class="btn-book">Pesan Sekarang</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="slider-dots" id="sliderDots">
    <?php foreach ($rooms as $i => $room): ?>
      <button class="dot <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>"></button>
    <?php endforeach; ?>
  </div>
</section>

<section class="ulasan section-blue" id="ulasan">
  <div class="container">
    <div class="ulasan-layout">
      <div class="ulasan-score">
        <div class="eyebrow light">ULASAN TAMU</div>
        <div class="rating-display">
          <span class="rating-num">4.9</span>
          <div>
            <div class="stars-big">
              <?php for ($i = 0; $i < 5; $i++): ?>
                <i class="fa-solid fa-star"></i>
              <?php endfor; ?>
            </div>
            <span class="rating-count">dari 500+ ulasan</span>
          </div>
        </div>
        <p>Komitmen kami terhadap kepuasan tamu menjadi standar yang selalu kami jaga.</p>
      </div>
      <div class="ulasan-cards">
        <?php foreach ($ulasan as $u): ?>
        <div class="ulasan-card">
          <div class="stars-sm">
            <?php for ($i = 0; $i < $u['rating']; $i++): ?>
              <i class="fa-solid fa-star"></i>
            <?php endfor; ?>
          </div>
          <p>"<?= htmlspecialchars($u['text']) ?>"</p>
          <div class="reviewer">
            <div class="reviewer-av"><?= htmlspecialchars($u['initial']) ?></div>
            <div>
              <strong><?= htmlspecialchars($u['name']) ?></strong>
              <span><?= htmlspecialchars($u['role']) ?></span>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="berita section-white" id="berita">
  <div class="container">
    <div class="eyebrow">TERBARU DARI KAMI</div>
    <h2 class="section-title">Berita &amp; Penawaran</h2>
    <div class="berita-grid">
      <?php foreach ($berita as $b): ?>
      <div class="berita-card">
        <div class="berita-img" style="background-image: url('<?= $b['img'] ?>')">
          <span class="berita-tag <?= $b['color'] ?>"><?= htmlspecialchars($b['tag']) ?></span>
        </div>
        <div class="berita-body">
          <h3><?= htmlspecialchars($b['title']) ?></h3>
          <p><?= htmlspecialchars($b['desc']) ?></p>
          <a href="#kontak" class="berita-link">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="kontak section-blue" id="kontak">
  <div class="container kontak-layout">
    <div class="kontak-form">
      <div class="eyebrow light">HUBUNGI KAMI</div>
      <h2 class="section-title light">Layanan Kontak</h2>
      <p class="light-text">Hubungi kami untuk informasi lebih lanjut atau lakukan reservasi sekarang.</p>
      <?php
        $submitted = false;
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
          $nama  = htmlspecialchars(trim($_POST['nama']  ?? ''));
          $email = htmlspecialchars(trim($_POST['email'] ?? ''));
          $telp  = htmlspecialchars(trim($_POST['telp']  ?? ''));
          $pesan = htmlspecialchars(trim($_POST['pesan'] ?? ''));
          if ($nama && $email && $pesan) {
            $submitted = true;
          } else {
            $error = 'Mohon isi semua kolom yang wajib diisi.';
          }
        }
      ?>
      <?php if ($submitted): ?>
        <div class="form-success">
          <i class="fa-solid fa-circle-check"></i>
          <h3>Pesan Terkirim!</h3>
          <p>Terima kasih <?= $nama ?>. Tim kami akan menghubungi Anda segera.</p>
        </div>
      <?php else: ?>
        <?php if ($error): ?>
          <div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> <?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="#kontak" class="contact-form">
          <div class="form-group">
            <label>Nama <span class="req">*</span></label>
            <input type="text" name="nama" placeholder="Nama lengkap Anda" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required/>
          </div>
          <div class="form-group">
            <label>Email <span class="req">*</span></label>
            <input type="email" name="email" placeholder="email@contoh.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required/>
          </div>
          <div class="form-group">
            <label>Pesan <span class="req">*</span></label>
            <textarea name="pesan" placeholder="Tulis pesan atau permintaan khusus Anda..."><?= htmlspecialchars($_POST['pesan'] ?? '') ?></textarea>
          </div>
          <button type="submit" name="send" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
          </button>
        </form>
      <?php endif; ?>
    </div>
    <div class="kontak-visual">
      <div class="kontak-img"></div>
      <div class="kontak-info-cards">
        <div class="info-card">
          <i class="fa-solid fa-phone"></i>
          <div><strong>Telepon</strong><span><?= htmlspecialchars($site['phone']) ?></span></div>
        </div>
        <div class="info-card">
          <i class="fa-solid fa-envelope"></i>
          <div><strong>Email</strong><span><?= htmlspecialchars($site['email']) ?></span></div>
        </div>
        <div class="info-card">
          <i class="fa-solid fa-location-dot"></i>
          <div><strong>Alamat</strong><span><?= htmlspecialchars($site['address']) ?></span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <div class="footer-logo"><?= htmlspecialchars($site['name']) ?><span><?= htmlspecialchars($site['domain']) ?></span></div>
      <p>Tempat di mana privasi digital terjaga dengan kenyamanan fisik terbaik. Untuk mereka yang memahami nilai perlindungan sejati.</p>
      <div class="social-links">
        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
      </div>
    </div>
    <div class="footer-col">
      <h4>JELAJAHI</h4>
      <ul>
        <?php foreach ($nav_links as $link): ?>
          <li><a href="<?= $link['href'] ?>"><?= htmlspecialchars($link['label']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-col">
      <h4>KAMAR</h4>
      <ul>
        <?php foreach ($rooms as $r): ?>
          <li><a href="#kamar"><?= htmlspecialchars($r['title']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="footer-col">
      <h4>DUKUNGAN</h4>
      <ul>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Kebijakan Privasi</a></li>
        <li><a href="#">Syarat &amp; Ketentuan</a></li>
        <li><a href="#">Bantuan</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name']) ?><?= htmlspecialchars($site['domain']) ?>. Semua hak dilindungi.</p>
  </div>
</footer>

<div class="modal-overlay" id="loginModal">
  <div class="modal-box">
    <button class="modal-close" id="modalClose"><i class="fa-solid fa-xmark"></i></button>
    <div class="modal-logo"><?= htmlspecialchars($site['name']) ?><span><?= htmlspecialchars($site['domain']) ?></span></div>
    <h2>Masuk ke Akun</h2>
    <p>Akses reservasi dan layanan eksklusif Anda</p>
    <div class="form-group">
      <label>Email</label>
      <input type="email" placeholder="email@contoh.com"/>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" placeholder="••••••••"/>
    </div>
    <button class="btn-submit full">Masuk</button>
    <p class="modal-footer-text">Belum punya akun? <a href="#kontak">Hubungi kami</a></p>
  </div>
</div>

<script>

function smoothScroll(target, duration = 900) {
  const navH = document.getElementById('navbar').offsetHeight;
  const start = window.scrollY;
  const dest  = target.getBoundingClientRect().top + window.scrollY - navH;
  const diff  = dest - start;
  let startTime = null;

  function ease(t) {
    return t < 0.5 ? 4*t*t*t : 1 - Math.pow(-2*t+2, 3)/2;
  }
  function step(now) {
    if (!startTime) startTime = now;
    const elapsed = now - startTime;
    const progress = Math.min(elapsed / duration, 1);
    window.scrollTo(0, start + diff * ease(progress));
    if (progress < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', function(e) {
    const id = this.getAttribute('href');
    if (id === '#login') return;
    const target = document.querySelector(id);
    if (target) { e.preventDefault(); smoothScroll(target); }
  });
});

const navbar = document.getElementById('navbar');
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
  let current = '';
  sections.forEach(sec => {
    if (window.scrollY >= sec.offsetTop - navbar.offsetHeight - 40) {
      current = sec.getAttribute('id');
    }
  });
  navLinks.forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === '#' + current);
  });
}, { passive: true });

document.getElementById('navToggle').addEventListener('click', () => {
  document.getElementById('navLinks').classList.toggle('open');
});

const track  = document.getElementById('sliderTrack');
const dots   = document.querySelectorAll('.dot');
const cards  = document.querySelectorAll('.room-card');
let current  = 0;
let isDragging = false, startX = 0, scrollLeft = 0;

function getCardWidth() {
  return cards[0].offsetWidth + parseInt(getComputedStyle(track).gap || 28);
}

function goTo(index) {
  current = Math.max(0, Math.min(index, cards.length - 1));
  const offset = current * getCardWidth();
  track.scrollTo({ left: offset, behavior: 'smooth' });
  dots.forEach((d, i) => d.classList.toggle('active', i === current));
}

document.getElementById('slidePrev').addEventListener('click', () => goTo(current - 1));
document.getElementById('slideNext').addEventListener('click', () => goTo(current + 1));
dots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));

// Touch/drag support
track.addEventListener('mousedown', e => {
  isDragging = true;
  startX = e.pageX - track.offsetLeft;
  scrollLeft = track.scrollLeft;
  track.style.cursor = 'grabbing';
});
track.addEventListener('mouseleave', () => { isDragging = false; track.style.cursor = ''; });
track.addEventListener('mouseup', e => {
  if (!isDragging) return;
  isDragging = false;
  track.style.cursor = '';
  const diff = (e.pageX - track.offsetLeft - startX);
  if (Math.abs(diff) > 60) goTo(diff < 0 ? current + 1 : current - 1);
});
track.addEventListener('mousemove', e => {
  if (!isDragging) return;
  e.preventDefault();
  track.scrollLeft = scrollLeft - (e.pageX - track.offsetLeft - startX);
});

let touchStartX = 0;
track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
track.addEventListener('touchend', e => {
  const diff = touchStartX - e.changedTouches[0].clientX;
  if (Math.abs(diff) > 50) goTo(diff > 0 ? current + 1 : current - 1);
});

// Update dot on manual scroll
track.addEventListener('scroll', () => {
  const idx = Math.round(track.scrollLeft / getCardWidth());
  if (idx !== current) {
    current = idx;
    dots.forEach((d, i) => d.classList.toggle('active', i === current));
  }
}, { passive: true });

// ─── Login Modal ──────────────────────────────────────────
const modal = document.getElementById('loginModal');
document.querySelector('.btn-login').addEventListener('click', e => {
  e.preventDefault();
  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
});
function closeModal() {
  modal.classList.remove('open');
  document.body.style.overflow = '';
}
document.getElementById('modalClose').addEventListener('click', closeModal);
modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// ─── Scroll reveal ────────────────────────────────────────
const observer = new IntersectionObserver(entries => {
  entries.forEach(el => {
    if (el.isIntersecting) { el.target.classList.add('visible'); }
  });
}, { threshold: 0.12 });
document.querySelectorAll('.fcard, .room-card, .berita-card, .ulasan-card, .stat').forEach(el => {
  el.classList.add('reveal');
  observer.observe(el);
});
</script>
</body>
</html>