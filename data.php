<?php

$site = [
  'name'    => 'Digitalheir',
  'tagline' => 'Secure Your Digital Legacy',
  'domain'  => '.co',
  'address' => 'Jl. Dr. Mansyur, Medan, Sumatera Utara',
  'phone'   => '+62 812 3456 7890',
  'email'   => 'hello@digitalheir.co',
];

$nav_links = [
  ['href' => '#beranda',   'label' => 'BERANDA'],
  ['href' => '#kamar',     'label' => 'KAMAR & SUITE'],
  ['href' => '#berita',    'label' => 'BERITA & PENAWARAN'],
  ['href' => '#kontak',    'label' => 'KONTAK'],
];

$fasilitas = [
  ['icon' => 'fa-water-ladder',  'title' => 'Kolam Renang Infinity',  'desc' => 'Nikmati pandangan tak terbatas menyatu dengan cakrawala dan panorama kota dari atas.'],
  ['icon' => 'fa-utensils',      'title' => 'Restoran Bintang 5',     'desc' => 'Pengalaman gastronomi dengan chef terbaik dunia dan menu eksklusif memanjakan selera.'],
  ['icon' => 'fa-children',      'title' => 'Pusat Keluarga',         'desc' => 'Fasilitas modern dengan area bermain spektakuler untuk seluruh anggota keluarga.'],
  ['icon' => 'fa-spa',           'title' => 'Layanan Spa',            'desc' => 'Relaksasi dan perawatan dari terapis profesional berpengalaman lebih dari 10 tahun.'],
  ['icon' => 'fa-vault',         'title' => 'Simpan Lengkap',         'desc' => 'Penyimpanan aman dan terpercaya setiap saat demi keamanan aset digital Anda.'],
  ['icon' => 'fa-car',           'title' => 'Antar Jemput Bandara',   'desc' => 'Transportasi mewah menuju dan dari bandara internasional kapan saja Anda butuhkan.'],
];

$rooms = [
  [
    'type'    => 'STANDARD',
    'title'   => 'Standard Digitalheir',
    'rating'  => '4.8',
    'desc'    => 'Kenyamanan sempurna di setiap sudut. Kamar standar kami menawarkan pengalaman menginap premium dengan desain modern, tempat tidur king-size, dan semua fasilitas esensial yang Anda perlukan.',
    'price'   => 'Rp 1.000.000',
    'img_url' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=900&q=80',
    'features'=> ['King Size Bed', 'Free Wi-Fi', 'Smart TV', 'Mini Bar'],
    'badge'   => null,
  ],
  [
    'type'    => 'DELUXE',
    'title'   => 'Deluxe Digitalheir',
    'rating'  => '4.9',
    'desc'    => 'Pengalaman yang ditingkatkan dengan pemandangan kota yang memukau. Kamar deluxe hadir dengan ruang yang lebih luas, bathtub freestanding, dan akses lounge eksklusif.',
    'price'   => 'Rp 5.000.000',
    'img_url' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?auto=format&fit=crop&w=900&q=80',
    'features'=> ['City View', 'Bathtub', 'Lounge Access', 'Breakfast'],
    'badge'   => 'TOP CHOICE',
  ],
  [
    'type'    => 'SUITE',
    'title'   => 'Suite Digitalheir',
    'rating'  => '5.0',
    'desc'    => 'Kemewahan sejati dalam setiap detail. Suite kami menghadirkan ruang tamu terpisah, dapur kecil lengkap, dan panorama 180° yang tak terlupakan untuk tamu paling spesial kami.',
    'price'   => 'Rp 20.000.000',
    'img_url' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=900&q=80',
    'features'=> ['Living Room', 'Panoramic View', 'Butler Service', 'Jacuzzi'],
    'badge'   => 'PREMIUM',
  ],
  [
    'type'    => 'PRESIDENTIAL',
    'title'   => 'Presidential Suite',
    'rating'  => '5.0',
    'desc'    => 'Puncak keistimewaan yang belum pernah ada sebelumnya. Presidential Suite menawarkan lantai pribadi, ruang konferensi, chef pribadi, dan keamanan tingkat tertinggi yang dirancang khusus.',
    'price'   => 'Rp 75.000.000',
    'img_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=900&q=80',
    'features'=> ['Private Floor', 'Personal Chef', 'Helipad Access', 'VIP Security'],
    'badge'   => 'EXCLUSIVE',
  ],
];

$ulasan = [
  [
    'name'   => 'Aditya Maolana',
    'role'   => 'Tamu VIP',
    'rating' => 5,
    'text'   => 'Sebuah perjalanan yang tak terlupakan. Privasi terjaga sempurna, layanan ramah dan penuh perhatian. Saya pasti akan kembali!',
    'initial'=> 'A',
  ],
  [
    'name'   => 'Sari Pradita',
    'role'   => 'Pelanggan Setia',
    'rating' => 5,
    'text'   => 'Layanan prima dan fasilitas luar biasa! Kolam renang Infinity adalah yang terbaik. Suasana di sini benar-benar unggul.',
    'initial'=> 'S',
  ],
  [
    'name'   => 'Michael Tan',
    'role'   => 'Business Traveler',
    'rating' => 5,
    'text'   => 'Presidential Suite melampaui semua ekspektasi saya. Privasi dan keamanan yang luar biasa untuk rapat-rapat penting.',
    'initial'=> 'M',
  ],
];

$berita = [
  [
    'tag'   => 'LIMITED OFFER',
    'color' => 'tag-red',
    'title' => 'Promo Musim Panas',
    'desc'  => 'Dapatkan diskon spesial hingga 40% untuk pemesanan kamar selama 3 malam. Penawaran terbatas untuk 5 kamar pilihan!',
    'img'   => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80',
  ],
  [
    'tag'   => 'RESTAURANT',
    'color' => 'tag-green',
    'title' => 'Paket Makan Malam Romantis',
    'desc'  => 'Nikmati makan malam berdua dengan suasana penuh keromantisan diiringi musik live pilihan kami.',
    'img'   => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=600&q=80',
  ],
  [
    'tag'   => 'LOCAL AREA',
    'color' => 'tag-blue',
    'title' => 'Staycation Hemat',
    'desc'  => 'Paket staycation terlengkap dengan sarapan, dinner, dan akses penuh ke semua fasilitas premium kami.',
    'img'   => 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&w=600&q=80',
  ],
];
?>