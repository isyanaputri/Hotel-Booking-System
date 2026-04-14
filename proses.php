<?php
session_start(); 

require_once 'koneksi.php';
require_once 'data.php';

if (empty($_SESSION['reservasi_data'])) {
    header('Location: form.php');
    exit;
}

$d = $_SESSION['reservasi_data'];

// Siapkan data
$nama_lengkap      = $conn->real_escape_string($d['nama_lengkap']);
$email             = $conn->real_escape_string($d['email']);
$nomor_telepon     = $conn->real_escape_string($d['nomor_telepon']);
$alamat_lengkap    = $conn->real_escape_string($d['alamat_lengkap']);
$nomor_identitas   = $conn->real_escape_string($d['nomor_identitas']);
$foto_identitas    = $conn->real_escape_string($d['foto_identitas']);
$tipe_kamar        = $conn->real_escape_string($d['tipe_kamar']);
$jumlah_tamu       = (int) $d['jumlah_tamu'];
$tgl_checkin       = $conn->real_escape_string($d['tgl_checkin']);
$tgl_checkout      = $conn->real_escape_string($d['tgl_checkout']);
$fasilitas         = $conn->real_escape_string(implode(', ', $d['fasilitas'] ?? []));
$metode_pembayaran = $conn->real_escape_string($d['metode_pembayaran']);
$permintaan_khusus = $conn->real_escape_string($d['permintaan_khusus']);

$sql = "INSERT INTO reservasi 
        (nama_lengkap, email, nomor_telepon, alamat_lengkap, nomor_identitas, foto_identitas,
         tipe_kamar, jumlah_tamu, tgl_checkin, tgl_checkout, fasilitas, metode_pembayaran, permintaan_khusus, status_pembayaran)
        VALUES
        ('$nama_lengkap', '$email', '$nomor_telepon', '$alamat_lengkap', '$nomor_identitas', '$foto_identitas',
         '$tipe_kamar', $jumlah_tamu, '$tgl_checkin', '$tgl_checkout', '$fasilitas', '$metode_pembayaran', '$permintaan_khusus', 'Pending')";

if ($conn->query($sql)) {
    $id_reservasi = $conn->insert_id;
    $_SESSION['reservasi_success'] = true;
    $_SESSION['reservasi_id']      = $id_reservasi;
    // Simpan kode booking ke session (sudah ada dari pembayaran.php)
    unset($_SESSION['reservasi_data']); // bersihkan data form
    header('Location: konfirmasi.php');
    exit;
} else {
    $_SESSION['reservasi_success'] = false;
    $_SESSION['db_error']          = $conn->error;
    header('Location: konfirmasi.php');
    exit;
}