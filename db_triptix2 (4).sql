-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2025 pada 04.04
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
-- Database: `db_triptix2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_dpn` varchar(100) NOT NULL,
  `nama_blkg` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_mitra`
--

CREATE TABLE `akun_mitra` (
  `id_akun_mitra` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('pengelola_wisata','perusahaan_transportasi','perusahaan_penginapan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun_mitra`
--

INSERT INTO `akun_mitra` (`id_akun_mitra`, `username`, `password`, `email`, `role`) VALUES
(7, 'ahmadammarsalas', '$2y$10$7miT0ORZpKwUoGd3kzprreMheA8J3W371h6vYcpRjsnNeamvulZfq', 'ahmadammarsalas@triptix.local', 'perusahaan_transportasi'),
(8, 'ammarsalas27@gmail.com', '$2y$10$wSSwtjReJKfD8lUW9JlbJ.fTAwmd2PeYmV3myKriaOzg165oymuCy', 'ammarsalas27@gmail.com@triptix.local', 'perusahaan_transportasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` int(11) NOT NULL,
  `nama_metode` varchar(50) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama_metode`, `status_aktif`) VALUES
(1, 'Transfer Bank', 1),
(2, 'E-Wallet', 1),
(3, 'Kartu Kredit', 1),
(4, 'Toko Retail', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_penginapan`
--

CREATE TABLE `paket_penginapan` (
  `id_paket_penginapan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_penginapan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_transportasi`
--

CREATE TABLE `paket_transportasi` (
  `id_paket_transportasi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_transportasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_tujuan`
--

CREATE TABLE `paket_tujuan` (
  `id_paket_tujuan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga_paket` decimal(10,2) NOT NULL,
  `lama_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `jumlah_pembayaran` decimal(10,2) NOT NULL,
  `status_bayar` enum('pending','dibayar','gagal') DEFAULT 'pending',
  `id_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_transportasi`
--

CREATE TABLE `pemesanan_transportasi` (
  `id_pemesanan_transportasi` int(11) NOT NULL,
  `id_transportasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan_transportasi`
--

INSERT INTO `pemesanan_transportasi` (`id_pemesanan_transportasi`, `id_transportasi`, `id_user`, `nama_pemesan`, `jumlah_tiket`, `tanggal_berangkat`, `created_at`) VALUES
(1, 27, NULL, 'Jamal Ludin', 3, '2025-06-11', '2025-06-10 07:10:00'),
(2, 27, NULL, 'Jamal Ludin', 3, '2025-06-11', '2025-06-10 07:13:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelola_wisata`
--

CREATE TABLE `pengelola_wisata` (
  `id_pengelola` int(11) NOT NULL,
  `nama_pengelola` varchar(100) NOT NULL,
  `email_pengelola` varchar(100) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `id_akun_mitra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) NOT NULL,
  `nama_dpn` varchar(100) NOT NULL,
  `nama_blkg` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `nama_dpn`, `nama_blkg`, `email`, `tgl_lahir`, `tgl_pendaftaran`, `password`) VALUES
(10, 'fikri putra', '', 'fikriputra@gmail.com', '2025-06-19', '2025-06-03', '$2y$10$giBeuR2HNbP1KXRUvTB4HOhWQeQaztP7Mr2UeyrlgO3vvZ5QewbWu'),
(11, 'triptix', '', 'triptix23@gmail.com', '2025-06-24', '2025-06-04', '$2y$10$EnXqvekWUjrr8SJBEkUPau86raIxTcZK7RpNpp6us5uykQc3KuOOa'),
(12, 'ammar', 'salas', 'ammarsalas27@gmail.com', '2025-06-09', '2025-06-09', '$2y$10$DXVre0fqrSJDUFYJtdJeueAHlOkyx5BpJQFEkXdpnO1m6/vQoyMkK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penginapan`
--

CREATE TABLE `penginapan` (
  `id_penginapan` int(11) NOT NULL,
  `nama_penginapan` varchar(100) NOT NULL,
  `tipe` text NOT NULL,
  `harga_per_malam` decimal(10,2) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `id_penginapan_perusahaan` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penginapan`
--

INSERT INTO `penginapan` (`id_penginapan`, `nama_penginapan`, `tipe`, `harga_per_malam`, `alamat`, `kota`, `provinsi`, `id_penginapan_perusahaan`, `foto`) VALUES
(15, 'pullman', 'Homestay', 250000.00, 'bojong soang', 'Kota Bekasi', 'Jawa Barat', 5, ''),
(16, 'pullman', 'Homestay', 25000.00, 'bojong soang', 'Kota Bekasi', 'Jawa Barat', 5, ''),
(17, 'citra', 'Homestay', 750000.00, 'jl.seokarna', 'bekasi', 'jawa', 6, ''),
(18, 'citra', 'Homestay', 5600000.00, 'jl.seokarna', 'bandung', 'jawa barat', 6, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan_penginapan`
--

CREATE TABLE `perusahaan_penginapan` (
  `id_penginapan_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `email_perusahaan` varchar(100) NOT NULL,
  `id_akun_mitra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perusahaan_penginapan`
--

INSERT INTO `perusahaan_penginapan` (`id_penginapan_perusahaan`, `nama_perusahaan`, `email_perusahaan`, `id_akun_mitra`) VALUES
(5, 'pullman', 'ahmadammarsalas@triptix.local', 7),
(6, 'citra', 'ammarsalas27@gmail.com@triptix.local', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan_transportasi`
--

CREATE TABLE `perusahaan_transportasi` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `email_perusahaan` varchar(100) NOT NULL,
  `id_akun_mitra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perusahaan_transportasi`
--

INSERT INTO `perusahaan_transportasi` (`id_perusahaan`, `nama_perusahaan`, `email_perusahaan`, `id_akun_mitra`) VALUES
(19, 'surga', 'ahmadammarsalas@triptix.local', 7),
(20, 'surga', 'ammarsalas27@gmail.com@triptix.local', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambahan_orang`
--

CREATE TABLE `tambahan_orang` (
  `id_keluarga` int(11) NOT NULL,
  `nama_dpn` varchar(100) NOT NULL,
  `nama_blkg` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `id_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telpn_pengelola`
--

CREATE TABLE `telpn_pengelola` (
  `id_telpn_pengelola` int(11) NOT NULL,
  `no_telpn` varchar(20) NOT NULL,
  `id_pengelola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telpn_pengguna`
--

CREATE TABLE `telpn_pengguna` (
  `id_telpn` int(11) NOT NULL,
  `no_telpn` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telpn_penginapan`
--

CREATE TABLE `telpn_penginapan` (
  `id_telpn_penginapan` int(11) NOT NULL,
  `no_telpn` varchar(20) NOT NULL,
  `id_penginapan_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `telpn_transportasi`
--

CREATE TABLE `telpn_transportasi` (
  `id_telpn_trans` int(11) NOT NULL,
  `no_telpn` varchar(20) NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `harga_tiket` decimal(10,2) NOT NULL,
  `jenis_tiket` varchar(100) NOT NULL,
  `id_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transportasi`
--

CREATE TABLE `transportasi` (
  `id_transportasi` int(11) NOT NULL,
  `jenis_transportasi` varchar(100) NOT NULL,
  `nama_mitra` varchar(100) NOT NULL,
  `jadwal_berangkat` datetime NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `keberangkatan` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `IdNoPolKen` varchar(40) DEFAULT NULL,
  `Waktu_tiba` datetime DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transportasi`
--

INSERT INTO `transportasi` (`id_transportasi`, `jenis_transportasi`, `nama_mitra`, `jadwal_berangkat`, `harga`, `kapasitas`, `keberangkatan`, `tujuan`, `id_perusahaan`, `IdNoPolKen`, `Waktu_tiba`, `deskripsi`) VALUES
(22, 'Travel', 'surga', '2025-06-10 01:01:00', 5000.00, 45, 'depok', '0', 19, 'B 123 ABC', '2025-06-10 01:01:00', 'dadsdads'),
(23, 'Bus', 'surga', '2025-06-10 01:18:00', 5000.00, 45, 'depok', '0', 19, 'B 123 ABC', '2025-06-10 01:18:00', 'ADADASDASDASD'),
(24, 'Travel', 'surga', '2025-06-10 11:49:00', 500000.00, 50, 'mangga dua', '0', 20, 'B 123 ABC', '2025-06-10 11:50:00', 'safdafdsdf'),
(25, 'Pesawat', 'gelooo', '2025-06-10 13:29:00', 99999999.99, 50, 'mangga dua', '0', 20, 'B 123 ABC', '2025-06-10 13:27:00', 'dawdawdawdawd'),
(26, 'Kereta', 'surga', '2025-06-10 13:33:00', 10000.00, 50, 'mangga dua', '0', 20, 'B 123 ABC', '2025-06-10 13:33:00', 'ASassads'),
(27, 'Kereta', 'gelooo', '2025-06-10 13:34:00', 50000.00, 34, 'mangga dua', '0', 20, 'B 123 ABC', '2025-06-10 13:34:00', 'sdasdasdsd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan_wisata`
--

CREATE TABLE `tujuan_wisata` (
  `id_wisata` int(11) NOT NULL,
  `nama_wisata` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_wisata` decimal(10,2) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `jalan` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tujuan_wisata`
--

INSERT INTO `tujuan_wisata` (`id_wisata`, `nama_wisata`, `deskripsi`, `harga_wisata`, `lokasi`, `jalan`, `kota`, `provinsi`, `foto`) VALUES
(12, 'citra', 'dasdasdads', 450000.00, 'anjay', 'bojong soang', 'Kota Bekasi', 'Jawa Barat', '684727c4e5ab6.png'),
(13, 'wowo', 'dsadasdasdasd', 30000.00, 'buah batu', 'jl.bojong soang', 'bandung', 'jawa barat', '6847ba4eebeba.png'),
(14, 'wowo', 'Asdasdasd', 45000.00, 'buah batu', 'jl.bojong soang', 'anjay', 'jawa barat', '6847d009f1e47.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `akun_mitra`
--
ALTER TABLE `akun_mitra`
  ADD PRIMARY KEY (`id_akun_mitra`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`),
  ADD UNIQUE KEY `nama_metode` (`nama_metode`);

--
-- Indeks untuk tabel `paket_penginapan`
--
ALTER TABLE `paket_penginapan`
  ADD PRIMARY KEY (`id_paket_penginapan`),
  ADD KEY `fk_pp_paket` (`id_paket`),
  ADD KEY `fk_pp_penginapan` (`id_penginapan`);

--
-- Indeks untuk tabel `paket_transportasi`
--
ALTER TABLE `paket_transportasi`
  ADD PRIMARY KEY (`id_paket_transportasi`),
  ADD KEY `fk_pt_paket` (`id_paket`),
  ADD KEY `fk_pt_transportasi` (`id_transportasi`);

--
-- Indeks untuk tabel `paket_tujuan`
--
ALTER TABLE `paket_tujuan`
  ADD PRIMARY KEY (`id_paket_tujuan`),
  ADD KEY `fk_ptu_paket` (`id_paket`),
  ADD KEY `fk_ptu_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_pembayaran_pemesanan` (`id_pemesanan`),
  ADD KEY `fk_pembayaran_metode` (`id_metode`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `fk_pemesanan_user` (`id_user`),
  ADD KEY `fk_pemesanan_paket` (`id_paket`);

--
-- Indeks untuk tabel `pemesanan_transportasi`
--
ALTER TABLE `pemesanan_transportasi`
  ADD PRIMARY KEY (`id_pemesanan_transportasi`),
  ADD KEY `fk_pemesanan_transportasi_transportasi` (`id_transportasi`),
  ADD KEY `fk_pemesanan_transportasi_user` (`id_user`);

--
-- Indeks untuk tabel `pengelola_wisata`
--
ALTER TABLE `pengelola_wisata`
  ADD PRIMARY KEY (`id_pengelola`),
  ADD UNIQUE KEY `email_pengelola` (`email_pengelola`),
  ADD UNIQUE KEY `id_akun_mitra` (`id_akun_mitra`),
  ADD KEY `fk_pengelola_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `penginapan`
--
ALTER TABLE `penginapan`
  ADD PRIMARY KEY (`id_penginapan`),
  ADD KEY `fk_penginapan_perusahaan` (`id_penginapan_perusahaan`);

--
-- Indeks untuk tabel `perusahaan_penginapan`
--
ALTER TABLE `perusahaan_penginapan`
  ADD PRIMARY KEY (`id_penginapan_perusahaan`),
  ADD UNIQUE KEY `email_perusahaan` (`email_perusahaan`),
  ADD UNIQUE KEY `id_akun_mitra` (`id_akun_mitra`);

--
-- Indeks untuk tabel `perusahaan_transportasi`
--
ALTER TABLE `perusahaan_transportasi`
  ADD PRIMARY KEY (`id_perusahaan`),
  ADD UNIQUE KEY `email_perusahaan` (`email_perusahaan`),
  ADD UNIQUE KEY `id_akun_mitra` (`id_akun_mitra`);

--
-- Indeks untuk tabel `tambahan_orang`
--
ALTER TABLE `tambahan_orang`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD KEY `fk_tambahan_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `telpn_pengelola`
--
ALTER TABLE `telpn_pengelola`
  ADD PRIMARY KEY (`id_telpn_pengelola`),
  ADD KEY `fk_telpn_pengelola` (`id_pengelola`);

--
-- Indeks untuk tabel `telpn_pengguna`
--
ALTER TABLE `telpn_pengguna`
  ADD PRIMARY KEY (`id_telpn`),
  ADD KEY `fk_telpn_pengguna` (`id_user`);

--
-- Indeks untuk tabel `telpn_penginapan`
--
ALTER TABLE `telpn_penginapan`
  ADD PRIMARY KEY (`id_telpn_penginapan`),
  ADD KEY `fk_telpn_penginapan` (`id_penginapan_perusahaan`);

--
-- Indeks untuk tabel `telpn_transportasi`
--
ALTER TABLE `telpn_transportasi`
  ADD PRIMARY KEY (`id_telpn_trans`),
  ADD KEY `fk_telpn_transportasi` (`id_perusahaan`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `fk_tiket_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`id_transportasi`),
  ADD KEY `fk_transportasi_perusahaan` (`id_perusahaan`);

--
-- Indeks untuk tabel `tujuan_wisata`
--
ALTER TABLE `tujuan_wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `akun_mitra`
--
ALTER TABLE `akun_mitra`
  MODIFY `id_akun_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `paket_penginapan`
--
ALTER TABLE `paket_penginapan`
  MODIFY `id_paket_penginapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `paket_transportasi`
--
ALTER TABLE `paket_transportasi`
  MODIFY `id_paket_transportasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `paket_tujuan`
--
ALTER TABLE `paket_tujuan`
  MODIFY `id_paket_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_transportasi`
--
ALTER TABLE `pemesanan_transportasi`
  MODIFY `id_pemesanan_transportasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengelola_wisata`
--
ALTER TABLE `pengelola_wisata`
  MODIFY `id_pengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `penginapan`
--
ALTER TABLE `penginapan`
  MODIFY `id_penginapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `perusahaan_penginapan`
--
ALTER TABLE `perusahaan_penginapan`
  MODIFY `id_penginapan_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `perusahaan_transportasi`
--
ALTER TABLE `perusahaan_transportasi`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tambahan_orang`
--
ALTER TABLE `tambahan_orang`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `telpn_pengelola`
--
ALTER TABLE `telpn_pengelola`
  MODIFY `id_telpn_pengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `telpn_pengguna`
--
ALTER TABLE `telpn_pengguna`
  MODIFY `id_telpn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `telpn_penginapan`
--
ALTER TABLE `telpn_penginapan`
  MODIFY `id_telpn_penginapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `telpn_transportasi`
--
ALTER TABLE `telpn_transportasi`
  MODIFY `id_telpn_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transportasi`
--
ALTER TABLE `transportasi`
  MODIFY `id_transportasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tujuan_wisata`
--
ALTER TABLE `tujuan_wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `paket_penginapan`
--
ALTER TABLE `paket_penginapan`
  ADD CONSTRAINT `fk_pp_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `fk_pp_penginapan` FOREIGN KEY (`id_penginapan`) REFERENCES `penginapan` (`id_penginapan`),
  ADD CONSTRAINT `paket_penginapan_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `paket_penginapan_ibfk_2` FOREIGN KEY (`id_penginapan`) REFERENCES `penginapan` (`id_penginapan`);

--
-- Ketidakleluasaan untuk tabel `paket_transportasi`
--
ALTER TABLE `paket_transportasi`
  ADD CONSTRAINT `fk_pt_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `fk_pt_transportasi` FOREIGN KEY (`id_transportasi`) REFERENCES `transportasi` (`id_transportasi`),
  ADD CONSTRAINT `paket_transportasi_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `paket_transportasi_ibfk_2` FOREIGN KEY (`id_transportasi`) REFERENCES `transportasi` (`id_transportasi`);

--
-- Ketidakleluasaan untuk tabel `paket_tujuan`
--
ALTER TABLE `paket_tujuan`
  ADD CONSTRAINT `fk_ptu_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `fk_ptu_wisata` FOREIGN KEY (`id_wisata`) REFERENCES `tujuan_wisata` (`id_wisata`),
  ADD CONSTRAINT `paket_tujuan_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `paket_tujuan_ibfk_2` FOREIGN KEY (`id_wisata`) REFERENCES `tujuan_wisata` (`id_wisata`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_metode` FOREIGN KEY (`id_metode`) REFERENCES `metode_pembayaran` (`id_metode`),
  ADD CONSTRAINT `fk_pembayaran_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`),
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`),
  ADD CONSTRAINT `fk_pemesanan_user` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`),
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `pemesanan_transportasi`
--
ALTER TABLE `pemesanan_transportasi`
  ADD CONSTRAINT `fk_pemesanan_transportasi_transportasi` FOREIGN KEY (`id_transportasi`) REFERENCES `transportasi` (`id_transportasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemesanan_transportasi_user` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengelola_wisata`
--
ALTER TABLE `pengelola_wisata`
  ADD CONSTRAINT `fk_pengelola_akun` FOREIGN KEY (`id_akun_mitra`) REFERENCES `akun_mitra` (`id_akun_mitra`),
  ADD CONSTRAINT `fk_pengelola_wisata` FOREIGN KEY (`id_wisata`) REFERENCES `tujuan_wisata` (`id_wisata`),
  ADD CONSTRAINT `pengelola_wisata_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `tujuan_wisata` (`id_wisata`),
  ADD CONSTRAINT `pengelola_wisata_ibfk_2` FOREIGN KEY (`id_akun_mitra`) REFERENCES `akun_mitra` (`id_akun_mitra`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penginapan`
--
ALTER TABLE `penginapan`
  ADD CONSTRAINT `fk_penginapan_perusahaan` FOREIGN KEY (`id_penginapan_perusahaan`) REFERENCES `perusahaan_penginapan` (`id_penginapan_perusahaan`),
  ADD CONSTRAINT `penginapan_ibfk_1` FOREIGN KEY (`id_penginapan_perusahaan`) REFERENCES `perusahaan_penginapan` (`id_penginapan_perusahaan`);

--
-- Ketidakleluasaan untuk tabel `perusahaan_penginapan`
--
ALTER TABLE `perusahaan_penginapan`
  ADD CONSTRAINT `fk_pp_akun` FOREIGN KEY (`id_akun_mitra`) REFERENCES `akun_mitra` (`id_akun_mitra`),
  ADD CONSTRAINT `perusahaan_penginapan_ibfk_1` FOREIGN KEY (`id_akun_mitra`) REFERENCES `akun_mitra` (`id_akun_mitra`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `perusahaan_transportasi`
--
ALTER TABLE `perusahaan_transportasi`
  ADD CONSTRAINT `fk_pt_akun` FOREIGN KEY (`id_akun_mitra`) REFERENCES `akun_mitra` (`id_akun_mitra`),
  ADD CONSTRAINT `perusahaan_transportasi_ibfk_1` FOREIGN KEY (`id_akun_mitra`) REFERENCES `akun_mitra` (`id_akun_mitra`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tambahan_orang`
--
ALTER TABLE `tambahan_orang`
  ADD CONSTRAINT `fk_tambahan_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`),
  ADD CONSTRAINT `tambahan_orang_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `telpn_pengelola`
--
ALTER TABLE `telpn_pengelola`
  ADD CONSTRAINT `fk_telpn_pengelola` FOREIGN KEY (`id_pengelola`) REFERENCES `pengelola_wisata` (`id_pengelola`),
  ADD CONSTRAINT `telpn_pengelola_ibfk_1` FOREIGN KEY (`id_pengelola`) REFERENCES `pengelola_wisata` (`id_pengelola`);

--
-- Ketidakleluasaan untuk tabel `telpn_pengguna`
--
ALTER TABLE `telpn_pengguna`
  ADD CONSTRAINT `fk_telpn_pengguna` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`),
  ADD CONSTRAINT `telpn_pengguna_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `telpn_penginapan`
--
ALTER TABLE `telpn_penginapan`
  ADD CONSTRAINT `fk_telpn_penginapan` FOREIGN KEY (`id_penginapan_perusahaan`) REFERENCES `perusahaan_penginapan` (`id_penginapan_perusahaan`),
  ADD CONSTRAINT `telpn_penginapan_ibfk_1` FOREIGN KEY (`id_penginapan_perusahaan`) REFERENCES `perusahaan_penginapan` (`id_penginapan_perusahaan`);

--
-- Ketidakleluasaan untuk tabel `telpn_transportasi`
--
ALTER TABLE `telpn_transportasi`
  ADD CONSTRAINT `fk_telpn_transportasi` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan_transportasi` (`id_perusahaan`),
  ADD CONSTRAINT `telpn_transportasi_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan_transportasi` (`id_perusahaan`);

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `fk_tiket_pemesanan` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`),
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Ketidakleluasaan untuk tabel `transportasi`
--
ALTER TABLE `transportasi`
  ADD CONSTRAINT `fk_transportasi_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan_transportasi` (`id_perusahaan`),
  ADD CONSTRAINT `transportasi_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan_transportasi` (`id_perusahaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
