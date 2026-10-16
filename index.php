<?php
// Konfigurasi Database Otomatis
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_brilink";

// 1. Koneksi awal ke MySQL server
$koneksi_init = mysqli_connect($host, $user, $pass);
if (!$koneksi_init) {
    die("<div style='font-family:sans-serif; padding:20px; color:red;'>Koneksi ke MySQL Gagal: " . mysqli_connect_error() . "<br>Pastikan XAMPP/Laragon (Apache & MySQL) sudah aktif!</div>");
}

// 2. Buat database & tabel otomatis
mysqli_query($koneksi_init, "CREATE DATABASE IF NOT EXISTS $db");
mysqli_select_db($koneksi_init, $db);

mysqli_query($koneksi_init, "CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    no_referensi VARCHAR(50) NOT NULL,
    tanggal DATETIME NOT NULL,
    jenis_layanan VARCHAR(50) NOT NULL,
    nama_pelanggan VARCHAR(100) NOT NULL,
    nomor_tujuan VARCHAR(50) NOT NULL,
    nominal DECIMAL(12,2) NOT NULL,
    biaya_admin DECIMAL(10,2) NOT NULL,
    fee_agen DECIMAL(10,2) NOT NULL,
    status ENUM('Sukses', 'Gagal') DEFAULT 'Sukses'
)");

// Cek dan masukkan data dummy jika tabel kosong
$cek_data = mysqli_query($koneksi_init, "SELECT COUNT(*) as jml FROM transaksi");
$d_cek = mysqli_fetch_assoc($cek_data);
if ($d_cek['jml'] == 0) {
    mysqli_query($koneksi_init, "INSERT INTO transaksi (no_referensi, tanggal, jenis_layanan, nama_pelanggan, nomor_tujuan, nominal, biaya_admin, fee_agen, status) VALUES
    ('TRX2026101501', NOW(), 'Transfer BRI', 'Bapak Budi', '356101023456508', 500000, 5000, 3000, 'Sukses'),
    ('TRX2026101502', NOW(), 'Tarik Tunai', 'Ibu Siti', '521101558899', 1000000, 10000, 7000, 'Sukses'),
    ('TRX2026101503', NOW(), 'Token PLN', 'Bapak Joko', '14029384756', 100000, 3000, 2000, 'Sukses'),
    ('TRX2026101504', NOW(), 'Top Up DANA', 'Ahmad Fauzi', '081234567890', 250000, 2500, 1500, 'Sukses')");
}

$koneksi = $koneksi_init;
$allowed_pages = ['dashboard', 'transaksi', 'laporan'];
$requested_page = $_GET['page'] ?? 'dashboard';
$page = in_array($requested_page, $allowed_pages, true) ? $requested_page : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pembukuan Agen BRILink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        <!-- Sidebar Navigasi -->
        <div class="w-64 bg-blue-900 text-white flex flex-col flex-shrink-0">
            <div class="p-5 text-xl font-bold tracking-wider flex items-center gap-2 border-b border-blue-800">
                <i class="fa-solid fa-building-columns text-amber-400"></i> BRILink Pro
            </div>
            <?php include __DIR__ . '/includes/menu.php'; ?>
            <div class="p-4 border-t border-blue-800 text-xs text-center text-blue-300">
                &copy; 2026 Agen BRILink Sederhana
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow p-4 flex justify-between items-center flex-shrink-0">
                <h1 class="text-xl font-bold text-gray-800 capitalize">Sistem Pembukuan <?= $page; ?></h1>
                <div class="text-sm text-gray-600">Loket Utama | <span class="text-emerald-600 font-semibold">Online</span></div>
            </header>

            <main class="p-6">
                <?php include __DIR__ . '/pages/' . $page . '.php'; ?>
            </main>
        </div>
    </div>
</body>
</html>