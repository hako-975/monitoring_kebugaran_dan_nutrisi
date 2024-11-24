-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2024 pada 05.20
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_kebugaran_dan_nutrisi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berat_tinggi_badan`
--

CREATE TABLE `berat_tinggi_badan` (
  `id_berat_tinggi_badan` int(11) NOT NULL,
  `berat_badan` float NOT NULL,
  `tinggi_badan` float NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_hitung` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_bmi`
--

CREATE TABLE `kategori_bmi` (
  `id_kategori_bmi` int(11) NOT NULL,
  `kategori` varchar(150) NOT NULL,
  `bmi_min` float NOT NULL,
  `bmi_max` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_bmi`
--

INSERT INTO `kategori_bmi` (`id_kategori_bmi`, `kategori`, `bmi_min`, `bmi_max`) VALUES
(1, 'Kekurangan berat badan berat', 0, 15.99),
(2, 'Kekurangan berat badan sedang', 16, 16.99),
(3, 'Kekurangan berat badan ringan', 17, 18.49),
(4, 'Normal', 18.5, 24.99),
(5, 'Kelebihan berat badan', 25, 29.99),
(6, 'Obesitas Kelas I', 30, 34.99),
(7, 'Obesitas Kelas II', 35, 39.99),
(8, 'Obesitas Kelas III (Obesitas Morbid)', 40, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tgl_log`, `id_user`) VALUES
(81, 'Kategori BMI Kekurangan berat badan berat berhasil diubah!', '2024-11-24 03:54:52', 1),
(82, 'Kategori BMI Kekurangan berat badan berat berhasil diubah!', '2024-11-24 03:54:58', 1),
(83, 'Kategori BMI obes berhasil ditambahkan!', '2024-11-24 04:00:12', 1),
(84, 'Kategori BMI obes123 berhasil diubah!', '2024-11-24 04:00:20', 1),
(85, 'Kategori BMI obes123 berhasil dihapus!', '2024-11-24 04:19:11', 1),
(86, 'Kategori BMI  berhasil dihapus!', '2024-11-24 04:20:34', 1),
(87, 'Kategori BMI obes berhasil ditambahkan!', '2024-11-24 04:20:41', 1),
(88, 'Kategori BMI obes berhasil dihapus!', '2024-11-24 04:20:44', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi_makanan`
--

CREATE TABLE `rekomendasi_makanan` (
  `id_rekomendasi_makanan` int(11) NOT NULL,
  `id_kategori_bmi` int(11) NOT NULL,
  `makanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekomendasi_makanan`
--

INSERT INTO `rekomendasi_makanan` (`id_rekomendasi_makanan`, `id_kategori_bmi`, `makanan`, `deskripsi`) VALUES
(1, 1, 'Nasi, Ayam, dan Sayuran', 'Makanan tinggi kalori dan protein untuk menambah berat badan.'),
(2, 2, 'Kentang Rebus dan Telur', 'Kaya protein dan karbohidrat kompleks untuk memperbaiki berat badan.'),
(3, 3, 'Roti Gandum dan Susu', 'Cocok untuk menambah berat badan ringan dengan asupan nutrisi seimbang.'),
(4, 4, 'Buah-buahan, Sayuran, dan Ikan', 'Pola makan sehat untuk mempertahankan berat badan normal.'),
(5, 5, 'Salad Sayur dan Protein Rendah Lemak', 'Mengontrol berat badan dengan asupan kalori moderat.'),
(6, 6, 'Oatmeal dan Ikan Panggang', 'Mengurangi asupan kalori dengan tetap memenuhi kebutuhan nutrisi.'),
(7, 7, 'Sup Sayur Tanpa Minyak', 'Rendah kalori untuk menurunkan berat badan lebih efektif.'),
(8, 8, 'Sayuran Kukus dan Protein Nabati', 'Makanan sangat rendah kalori untuk kategori obesitas berat.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi_olahraga`
--

CREATE TABLE `rekomendasi_olahraga` (
  `id_rekomendasi_olahraga` int(11) NOT NULL,
  `id_kategori_bmi` int(11) NOT NULL,
  `olahraga` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekomendasi_olahraga`
--

INSERT INTO `rekomendasi_olahraga` (`id_rekomendasi_olahraga`, `id_kategori_bmi`, `olahraga`, `deskripsi`) VALUES
(1, 1, 'Latihan Kekuatan (Strength Training)', 'Olahraga untuk menambah massa otot dan berat badan.'),
(2, 2, 'Jogging Ringan dan Latihan Kekuatan', 'Meningkatkan nafsu makan dan memperbaiki berat badan dengan olahraga teratur.'),
(3, 3, 'Lari, Sepeda, dan Yoga', 'Aktivitas yang membantu menambah berat badan ringan dan meningkatkan kebugaran tubuh.'),
(4, 4, 'Lari, Bersepeda, dan Senam Aerobik', 'Olahraga dengan intensitas sedang untuk menjaga berat badan tetap normal.'),
(5, 5, 'Berenang, Jalan Cepat', 'Olahraga yang membakar kalori tanpa meningkatkan massa otot secara berlebihan.'),
(6, 6, 'Yoga dan Pilates', 'Mengurangi stres dan menjaga keseimbangan tubuh dengan aktivitas yang lebih rendah kalori.'),
(7, 7, 'Senam Aerobik dan Lari Ringan', 'Membantu mengurangi berat badan dengan aktivitas intensitas tinggi.'),
(8, 8, 'Latihan Kardio Berat dan Angkat Beban', 'Olahraga intensif untuk menurunkan berat badan dan mengurangi lemak tubuh.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('admin','petugas') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `jabatan`, `nama`, `foto`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$PDN4Md5jfPRsvJ5DJyJ.r.Bcf6mMSG.g5BBZaivJEd6padJYBerky', 'admin', 'Administrator', '668bdcf48892c_1720442100_avatar5.png', '2024-07-04 15:52:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berat_tinggi_badan`
--
ALTER TABLE `berat_tinggi_badan`
  ADD PRIMARY KEY (`id_berat_tinggi_badan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `kategori_bmi`
--
ALTER TABLE `kategori_bmi`
  ADD PRIMARY KEY (`id_kategori_bmi`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `rekomendasi_makanan`
--
ALTER TABLE `rekomendasi_makanan`
  ADD PRIMARY KEY (`id_rekomendasi_makanan`),
  ADD KEY `id_kategori_bmi` (`id_kategori_bmi`);

--
-- Indeks untuk tabel `rekomendasi_olahraga`
--
ALTER TABLE `rekomendasi_olahraga`
  ADD PRIMARY KEY (`id_rekomendasi_olahraga`),
  ADD KEY `id_kategori_bmi` (`id_kategori_bmi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berat_tinggi_badan`
--
ALTER TABLE `berat_tinggi_badan`
  MODIFY `id_berat_tinggi_badan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_bmi`
--
ALTER TABLE `kategori_bmi`
  MODIFY `id_kategori_bmi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_makanan`
--
ALTER TABLE `rekomendasi_makanan`
  MODIFY `id_rekomendasi_makanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_olahraga`
--
ALTER TABLE `rekomendasi_olahraga`
  MODIFY `id_rekomendasi_olahraga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
