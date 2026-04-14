-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2026 pada 18.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `nomor_identitas` varchar(50) NOT NULL,
  `foto_identitas` varchar(255) NOT NULL,
  `tipe_kamar` enum('Standard','Deluxe','Suite','Presidential') NOT NULL,
  `jumlah_tamu` int(11) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `fasilitas` text DEFAULT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `permintaan_khusus` text DEFAULT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_pembayaran` enum('Pending','Lunas') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `nama_lengkap`, `email`, `nomor_telepon`, `alamat_lengkap`, `nomor_identitas`, `foto_identitas`, `tipe_kamar`, `jumlah_tamu`, `tgl_checkin`, `tgl_checkout`, `fasilitas`, `metode_pembayaran`, `permintaan_khusus`, `waktu_input`, `status_pembayaran`) VALUES
(1, NULL, 'Adhan', 'adhan@gmail.com', '+6214388422323', 'sjdfhihdqowq', '3123t127378273', 'id_1776003248_69dba8b058bb4.png', 'Suite', 10, '2026-04-14', '2026-04-25', 'Sarapan, WiFi, Spa', 'Kartu Kredit', 'makasih', '2026-04-12 14:17:43', 'Pending'),
(2, NULL, 'Isyana', 'isyanapt209@gmail.com', '+6281385898887', 'jalan dr mansyur', '3123t127378273', 'id_1776003924_69dbab54944bd.png', 'Deluxe', 2, '2026-04-14', '2026-04-16', 'Sarapan, WiFi, Antar Jemput, Kolam Renang, Gym, Spa', 'Kartu Kredit', '', '2026-04-12 14:25:38', 'Pending'),
(3, NULL, '020_Isyana Putri Mayza', 'isyanaptrimayza@gmail.com', '+6214388422323', 'medan', '3123t127378273', 'id_1776004705_69dbae61e00a3.png', 'Presidential', 5, '2026-04-13', '2026-04-25', 'Sarapan, WiFi, Antar Jemput, Kolam Renang, Gym, Spa', 'Kartu Kredit', '', '2026-04-12 14:38:40', 'Pending'),
(4, NULL, '020_Isyana Putri Mayza', 'isyanaptrimayza@gmail.com', '+6281385898887', 'jawa', '3123t127378273', 'id_1776005051_69dbafbbbd980.png', 'Standard', 5, '2026-04-12', '2026-04-13', 'Sarapan', 'Transfer Bank', '', '2026-04-12 14:44:30', 'Pending'),
(5, NULL, '020_Isyana Putri Mayza', 'isyanaptrimayza@gmail.com', '+6214388422323', 'papua', '3123t127378273', 'id_1776005608_69dbb1e806429.png', 'Suite', 9, '2026-04-12', '2026-04-13', 'Sarapan', 'Kartu Kredit', '', '2026-04-12 14:53:48', 'Pending'),
(6, NULL, 'jihan', 'jihan@gmail.com', '+621437683281', 'meadan', '736721548721321382', 'id_1776006083_69dbb3c33b16b.png', 'Suite', 4, '2026-04-12', '2026-04-16', 'WiFi, Gym', 'Kartu Kredit', '', '2026-04-12 15:01:29', 'Pending'),
(7, NULL, 'maulana', 'maulana@gmail.com', '+6281385898887', 'johor', '736721548721321382', 'id_1776011995_69dbcadb4376a.png', 'Suite', 8, '2026-04-12', '2026-04-13', 'Sarapan, Gym, Spa', 'Kartu Kredit', 'ga ada makasih', '2026-04-12 16:40:41', 'Pending'),
(8, NULL, 'maulana', 'maulana@gmail.com', '+6214388422323', 'johor', '3123t127378273', 'id_1776012213_69dbcbb51a284.png', 'Suite', 8, '2026-04-12', '2026-04-13', 'Sarapan, Gym, Spa', 'Transfer Bank', 'ga makasih', '2026-04-12 16:44:28', 'Pending'),
(9, NULL, '020_Isyana Putri Mayza', 'isyanaptrimayza@gmail.com', '+6281385898887', 'johor', '3123t127378273', 'id_1776012342_69dbcc36a7782.png', 'Deluxe', 8, '2026-04-12', '2026-04-13', 'Sarapan, Gym, Spa', 'Transfer Bank', 'g', '2026-04-12 16:45:50', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
