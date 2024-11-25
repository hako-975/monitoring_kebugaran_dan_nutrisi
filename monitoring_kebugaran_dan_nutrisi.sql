-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2024 pada 11.03
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
  `id_pelanggan` int(11) NOT NULL,
  `berat_badan` float NOT NULL,
  `tinggi_badan` float NOT NULL,
  `hasil_bmi` float DEFAULT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berat_tinggi_badan`
--

INSERT INTO `berat_tinggi_badan` (`id_berat_tinggi_badan`, `id_pelanggan`, `berat_badan`, `tinggi_badan`, `hasil_bmi`, `tanggal_dibuat`) VALUES
(2, 3, 55, 160, 21.4844, '2024-11-25 16:44:16');

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
(88, 'Kategori BMI obes berhasil dihapus!', '2024-11-24 04:20:44', 1),
(89, 'User admin berhasil logout!', '2024-11-24 04:21:50', 1),
(90, 'User admin berhasil login!', '2024-11-24 10:55:35', 1),
(91, 'Rekomendasi Makanan  berhasil ditambahkan!', '2024-11-24 11:34:20', 1),
(92, 'Kategori BMI  berhasil dihapus!', '2024-11-24 11:34:27', 1),
(93, 'Rekomendasi Makanan asd berhasil ditambahkan!', '2024-11-24 11:36:06', 1),
(94, 'Kategori BMI 4 berhasil dihapus!', '2024-11-24 11:36:15', 1),
(95, 'Rekomendasi Makanan asd berhasil ditambahkan!', '2024-11-24 11:36:34', 1),
(96, 'Kategori BMI asd berhasil dihapus!', '2024-11-24 11:37:58', 1),
(97, 'User admin berhasil logout!', '2024-11-24 11:39:03', 1),
(98, 'User admin berhasil login!', '2024-11-24 11:39:08', 1),
(99, 'User admin berhasil login!', '2024-11-25 07:47:20', 1),
(100, 'Rekomendasi Makanan asd berhasil ditambahkan!', '2024-11-25 07:47:32', 1),
(101, 'Rekomendasi Makanan asd123 gagal diubah!', '2024-11-25 07:47:37', 1),
(102, 'Rekomendasi Makanan asd123 berhasil diubah!', '2024-11-25 07:49:10', 1),
(103, 'Rekomendasi Makanan asd123 berhasil diubah!', '2024-11-25 07:50:41', 1),
(104, 'Rekomendasi Makanan asd berhasil ditambahkan!', '2024-11-25 07:50:47', 1),
(105, 'Rekomendasi Makanan asd123 berhasil diubah!', '2024-11-25 07:50:51', 1),
(106, 'Kategori BMI asd123 berhasil dihapus!', '2024-11-25 07:50:54', 1),
(107, 'Rekomendasi Olahraga asd berhasil ditambahkan!', '2024-11-25 07:53:32', 1),
(108, 'Rekomendasi Olahraga asd123 berhasil diubah!', '2024-11-25 07:54:15', 1),
(109, 'Kategori BMI asd123 berhasil dihapus!', '2024-11-25 07:54:44', 1),
(110, 'Rekomendasi Makanan Daging berhasil ditambahkan!', '2024-11-25 08:00:12', 1),
(111, 'Kategori BMI Daging berhasil dihapus!', '2024-11-25 08:07:08', 1),
(112, 'Rekomendasi Makanan daging berhasil ditambahkan!', '2024-11-25 08:07:33', 1),
(113, 'Rekomendasi Makanan daging berhasil diubah!', '2024-11-25 08:07:52', 1),
(114, 'Kategori BMI daging berhasil dihapus!', '2024-11-25 08:08:32', 1),
(115, 'Rekomendasi Makanan asd berhasil ditambahkan!', '2024-11-25 08:08:41', 1),
(116, 'Rekomendasi Makanan asd berhasil diubah!', '2024-11-25 08:08:46', 1),
(117, 'Kategori BMI asd berhasil dihapus!', '2024-11-25 08:10:54', 1),
(118, 'Rekomendasi Makanan asd berhasil ditambahkan!', '2024-11-25 08:11:00', 1),
(119, 'Rekomendasi Makanan asdasd berhasil diubah!', '2024-11-25 08:11:07', 1),
(120, 'Rekomendasi Makanan asdasd berhasil diubah!', '2024-11-25 08:11:12', 1),
(121, 'Kategori BMI asdasd berhasil dihapus!', '2024-11-25 08:11:20', 1),
(122, 'Rekomendasi Olahraga asd gagal ditambahkan!', '2024-11-25 08:14:09', 1),
(123, 'Rekomendasi Olahraga asd gagal ditambahkan!', '2024-11-25 08:14:17', 1),
(124, 'Rekomendasi Olahraga asd berhasil ditambahkan!', '2024-11-25 08:14:45', 1),
(125, 'Rekomendasi Olahraga asd114 berhasil diubah!', '2024-11-25 08:16:14', 1),
(126, 'Kategori BMI asd114 berhasil dihapus!', '2024-11-25 08:16:22', 1),
(127, 'Rekomendasi Makanan Nasi, Ayam, dan Sayuran berhasil diubah!', '2024-11-25 08:18:07', 1),
(128, 'Rekomendasi Makanan lele berhasil ditambahkan!', '2024-11-25 08:20:48', 1),
(129, 'Kategori BMI lele berhasil dihapus!', '2024-11-25 08:20:58', 1),
(130, 'Rekomendasi Olahraga lari berhasil ditambahkan!', '2024-11-25 08:21:11', 1),
(131, 'Kategori BMI lari berhasil dihapus!', '2024-11-25 08:21:44', 1),
(132, 'Rekomendasi Olahraga Lari, Bersepeda, dan Senam Aerobik berhasil diubah!', '2024-11-25 08:22:03', 1),
(133, 'Pelanggan Andri Firman Saputra berhasil ditambahkan!', '2024-11-25 08:32:12', 1),
(134, 'Pelanggan Andri Firman Saputra123 gagal diubah!', '2024-11-25 08:37:25', 1),
(135, 'Pelanggan Andri Firman Saputra123 berhasil diubah!', '2024-11-25 08:38:10', 1),
(136, 'Pelanggan  berhasil dihapus!', '2024-11-25 08:39:39', 1),
(137, 'Pelanggan  berhasil dihapus!', '2024-11-25 08:40:01', 1),
(138, 'Pelanggan Andri Firman Saputra berhasil ditambahkan!', '2024-11-25 08:40:20', 1),
(139, 'Pelanggan Andre berhasil diubah!', '2024-11-25 08:40:32', 1),
(140, 'Pelanggan Andre berhasil dihapus!', '2024-11-25 08:40:37', 1),
(141, 'Pelanggan Andri Firman Saputra berhasil ditambahkan!', '2024-11-25 08:41:08', 1),
(142, 'Berat Tinggi Badan Andri Firman Saputra berhasil ditambahkan!', '2024-11-25 09:25:30', 1),
(143, 'Berat Tinggi Badan Andri Firman Saputra berhasil ditambahkan!', '2024-11-25 09:28:39', 1),
(144, 'Berat Tinggi Badan Andri Firman Saputra berhasil diubah!', '2024-11-25 09:42:10', 1),
(145, 'Berat Tinggi Badan Andri Firman Saputra berhasil diubah!', '2024-11-25 09:42:21', 1),
(146, 'Berat Tinggi Badan Andri Firman Saputra berhasil dihapus!', '2024-11-25 09:44:09', 1),
(147, 'Berat Tinggi Badan Andri Firman Saputra berhasil ditambahkan!', '2024-11-25 09:44:16', 1),
(148, 'Rekomendasi Makanan Kentang Rebus dan Telur berhasil diubah!', '2024-11-25 09:46:25', 1),
(149, 'Rekomendasi Makanan Roti Gandum dan Susu berhasil diubah!', '2024-11-25 09:46:43', 1),
(150, 'Rekomendasi Makanan Buah-buahan, Sayuran, dan Ikan berhasil diubah!', '2024-11-25 09:47:11', 1),
(151, 'Rekomendasi Makanan Salad Sayur dan Protein Rendah Lemak berhasil diubah!', '2024-11-25 09:47:36', 1),
(152, 'Rekomendasi Makanan Oatmeal dan Ikan Panggang berhasil diubah!', '2024-11-25 09:48:43', 1),
(153, 'Rekomendasi Makanan Sup Sayur Tanpa Minyak berhasil diubah!', '2024-11-25 09:49:07', 1),
(154, 'Rekomendasi Makanan Sayuran Kukus dan Protein Nabati berhasil diubah!', '2024-11-25 09:49:42', 1),
(155, 'Rekomendasi Olahraga Latihan Kekuatan (Strength Training) berhasil diubah!', '2024-11-25 09:50:07', 1),
(156, 'Rekomendasi Olahraga Jogging Ringan dan Latihan Kekuatan berhasil diubah!', '2024-11-25 09:51:03', 1),
(157, 'Rekomendasi Olahraga Lari, Sepeda, dan Yoga berhasil diubah!', '2024-11-25 09:51:46', 1),
(158, 'Rekomendasi Olahraga Berenang, Jalan Cepat berhasil diubah!', '2024-11-25 09:52:12', 1),
(159, 'Rekomendasi Olahraga Yoga dan Pilates berhasil diubah!', '2024-11-25 09:52:46', 1),
(160, 'Rekomendasi Olahraga Lari, Sepeda, dan Yoga berhasil diubah!', '2024-11-25 09:53:28', 1),
(161, 'Rekomendasi Olahraga Senam Aerobik dan Lari Ringan berhasil diubah!', '2024-11-25 09:54:04', 1),
(162, 'Rekomendasi Olahraga Latihan Kardio Berat dan Angkat Beban berhasil diubah!', '2024-11-25 09:54:55', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `foto` text DEFAULT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_lengkap`, `tanggal_lahir`, `no_telepon`, `foto`, `tanggal_dibuat`) VALUES
(3, 'Andri Firman Saputra', '2002-01-29', '087808675313', '67443824a37e8_1732524068_1675754467574.jpg', '2024-11-25 15:41:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi_makanan`
--

CREATE TABLE `rekomendasi_makanan` (
  `id_rekomendasi_makanan` int(11) NOT NULL,
  `id_kategori_bmi` int(11) NOT NULL,
  `makanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekomendasi_makanan`
--

INSERT INTO `rekomendasi_makanan` (`id_rekomendasi_makanan`, `id_kategori_bmi`, `makanan`, `deskripsi`, `foto`) VALUES
(1, 1, 'Nasi, Ayam, dan Sayuran', 'Makanan tinggi kalori dan protein untuk menambah berat badan.', '674432bfa9057_1732522687_download (1).jpeg'),
(2, 2, 'Kentang Rebus dan Telur', 'Kaya protein dan karbohidrat kompleks untuk memperbaiki berat badan.', '674447716949c_1732527985_1.jpeg'),
(3, 3, 'Roti Gandum dan Susu', 'Cocok untuk menambah berat badan ringan dengan asupan nutrisi seimbang.', '674447838ff87_1732528003_2.jpeg'),
(4, 4, 'Buah-buahan, Sayuran, dan Ikan', 'Pola makan sehat untuk mempertahankan berat badan normal.', '6744479fb9fb2_1732528031_403059_5-11-2020_11-55-41.jpeg'),
(5, 5, 'Salad Sayur dan Protein Rendah Lemak', 'Mengontrol berat badan dengan asupan kalori moderat.', '674447b8d864f_1732528056_resep-salad-sayur-untuk-diet-yang-nikmat-dan-mudah-dibuat.jpg'),
(6, 6, 'Oatmeal dan Ikan Panggang', 'Mengurangi asupan kalori dengan tetap memenuhi kebutuhan nutrisi.', '674447fbeb931_1732528123_manfaat-oatmeal-untuk-kesehatan.jpg'),
(7, 7, 'Sup Sayur Tanpa Minyak', 'Rendah kalori untuk menurunkan berat badan lebih efektif.', '67444813a4e86_1732528147_images.jpeg'),
(8, 8, 'Sayuran Kukus dan Protein Nabati', 'Makanan sangat rendah kalori untuk kategori obesitas berat.', '6744483634892_1732528182_4-Makanan-Sumber-Protein-Nabati-Yang-Baik-Untuk-Tubuh-1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi_olahraga`
--

CREATE TABLE `rekomendasi_olahraga` (
  `id_rekomendasi_olahraga` int(11) NOT NULL,
  `id_kategori_bmi` int(11) NOT NULL,
  `olahraga` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekomendasi_olahraga`
--

INSERT INTO `rekomendasi_olahraga` (`id_rekomendasi_olahraga`, `id_kategori_bmi`, `olahraga`, `deskripsi`, `foto`) VALUES
(1, 1, 'Latihan Kekuatan (Strength Training)', 'Olahraga untuk menambah massa otot dan berat badan.', '6744484f1cbb7_1732528207_apa-itu-strength-training-pengertian-jenis-jenis-dan-manfaatnya-medium.jpeg'),
(2, 2, 'Jogging Ringan dan Latihan Kekuatan', 'Meningkatkan nafsu makan dan memperbaiki berat badan dengan olahraga teratur.', '6744488717569_1732528263_Screenshot 2024-11-25 165049.png'),
(3, 3, 'Lari, Sepeda, dan Yoga', 'Aktivitas yang membantu menambah berat badan ringan dan meningkatkan kebugaran tubuh.', '67444918982e4_1732528408_Screenshot 2024-11-25 165319.png'),
(4, 4, 'Lari, Bersepeda, dan Senam Aerobik', 'Olahraga dengan intensitas sedang untuk menjaga berat badan tetap normal.', '674433abb26ae_1732522923_download.jpeg'),
(5, 5, 'Berenang, Jalan Cepat', 'Olahraga yang membakar kalori tanpa meningkatkan massa otot secara berlebihan.', '674448cc5a0f1_1732528332_lima-manfaat-berenang-bagi-keseh-20231116030025.jpg'),
(6, 6, 'Yoga dan Pilates', 'Mengurangi stres dan menjaga keseimbangan tubuh dengan aktivitas yang lebih rendah kalori.', '674448ee5b5af_1732528366_images (1).jpeg'),
(7, 7, 'Senam Aerobik dan Lari Ringan', 'Membantu mengurangi berat badan dengan aktivitas intensitas tinggi.', '6744493c58fd8_1732528444_senam-aerobic.jpg'),
(8, 8, 'Latihan Kardio Berat dan Angkat Beban', 'Olahraga intensif untuk menurunkan berat badan dan mengurangi lemak tubuh.', '6744496f0c7f1_1732528495_images (2).jpeg');

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
  MODIFY `id_berat_tinggi_badan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_bmi`
--
ALTER TABLE `kategori_bmi`
  MODIFY `id_kategori_bmi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_makanan`
--
ALTER TABLE `rekomendasi_makanan`
  MODIFY `id_rekomendasi_makanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_olahraga`
--
ALTER TABLE `rekomendasi_olahraga`
  MODIFY `id_rekomendasi_olahraga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
