-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2025 at 04:50 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_kesehatan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_resep`
--

CREATE TABLE `detail_resep` (
  `id_detail` int NOT NULL,
  `id_resep` int NOT NULL,
  `nama_obat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `dosis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_resep`
--

INSERT INTO `detail_resep` (`id_detail`, `id_resep`, `nama_obat`, `jumlah`, `dosis`, `harga_satuan`) VALUES
(1, 1, 'Paracetamol', 30, '500mg 3x sehari', 5000.00),
(2, 1, 'Amoxicillin', 20, '500mg 2x sehari', 10000.00),
(3, 2, 'Cetirizine', 10, '10mg 1x sehari', 7500.00),
(4, 3, 'Losartan', 30, '50mg 1x sehari', 15000.00),
(5, 4, 'Metformin', 60, '500mg 2x sehari', 8000.00),
(6, 5, 'Rifampicin', 90, '600mg 1x sehari', 10000.00),
(7, 6, 'Salbutamol', 1, '100mcg inhalasi', 100000.00),
(8, 7, 'Diazepam', 10, '5mg 1x sehari', 25000.00),
(9, 8, 'Oralit', 10, '1 sachet per hari', 5000.00),
(10, 9, 'Azithromycin', 6, '500mg 1x sehari', 30000.00),
(11, 10, 'Omeprazole', 30, '20mg 1x sehari', 12000.00),
(12, 11, 'Simvastatin', 30, '20mg 1x sehari', 15000.00),
(13, 12, 'Ibuprofen', 20, '400mg 3x sehari', 7000.00),
(14, 13, 'Cefadroxil', 30, '500mg 2x sehari', 18000.00),
(15, 14, 'Dexamethasone', 10, '0.5mg 2x sehari', 8000.00),
(16, 15, 'Furosemide', 30, '40mg 1x sehari', 9000.00),
(17, 16, 'Ranitidine', 30, '150mg 2x sehari', 10000.00),
(18, 17, 'Chlorpheniramine', 20, '4mg 3x sehari', 5000.00),
(19, 18, 'Ciprofloxacin', 20, '500mg 2x sehari', 20000.00),
(20, 19, 'Diclofenac', 30, '50mg 2x sehari', 8000.00),
(21, 20, 'Loratadine', 10, '10mg 1x sehari', 10000.00),
(22, 21, 'Metronidazole', 20, '500mg 3x sehari', 12000.00),
(23, 22, 'Nifedipine', 30, '10mg 3x sehari', 15000.00),
(24, 23, 'Prednisone', 30, '5mg 2x sehari', 10000.00),
(25, 24, 'Tramadol', 20, '50mg 3x sehari', 12000.00),
(26, 25, 'Vitamin B Complex', 30, '1 tablet 1x sehari', 5000.00),
(27, 26, 'Warfarin', 30, '5mg 1x sehari', 18000.00),
(28, 27, 'Zinc Sulfate', 30, '20mg 1x sehari', 7000.00),
(29, 28, 'Amlodipine', 30, '5mg 1x sehari', 15000.00),
(30, 29, 'Bisoprolol', 30, '5mg 1x sehari', 16000.00),
(31, 30, 'Captopril', 30, '25mg 2x sehari', 12000.00),
(32, 31, 'Doxycycline', 20, '100mg 2x sehari', 18000.00),
(33, 32, 'Erythromycin', 30, '500mg 4x sehari', 15000.00),
(34, 33, 'Fluconazole', 10, '150mg 1x sehari', 25000.00),
(35, 34, 'Gabapentin', 30, '300mg 3x sehari', 20000.00),
(36, 35, 'Hydrochlorothiazide', 30, '25mg 1x sehari', 10000.00),
(37, 36, 'Itraconazole', 14, '100mg 2x sehari', 30000.00),
(38, 37, 'Ketoconazole', 20, '200mg 1x sehari', 25000.00),
(39, 38, 'Levofloxacin', 10, '500mg 1x sehari', 30000.00),
(40, 39, 'Mebendazole', 3, '100mg 2x sehari', 15000.00),
(41, 40, 'Naproxen', 30, '250mg 2x sehari', 12000.00),
(42, 41, 'Ondansetron', 10, '4mg 3x sehari', 20000.00),
(43, 42, 'Pantoprazole', 30, '40mg 1x sehari', 18000.00),
(44, 43, 'Quinine', 30, '300mg 2x sehari', 25000.00),
(45, 44, 'Risperidone', 30, '2mg 1x sehari', 22000.00),
(46, 45, 'Sertraline', 30, '50mg 1x sehari', 20000.00),
(47, 46, 'Tetracycline', 30, '250mg 4x sehari', 15000.00),
(48, 47, 'Ursodeoxycholic Acid', 30, '300mg 2x sehari', 25000.00),
(49, 48, 'Valproic Acid', 30, '500mg 2x sehari', 30000.00),
(50, 49, 'Warfarin', 30, '3mg 1x sehari', 18000.00),
(51, 50, 'Xylometazoline', 1, '0.1% nasal spray', 35000.00);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `spesialisasi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `no_izin_praktek` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama`, `spesialisasi`, `no_izin_praktek`, `no_telp`) VALUES
(1, 'Dr. Andi Wijaya', 'Penyakit Dalam', 'ID123456789', '081234567001'),
(2, 'Dr. Budi Santoso', 'Kardiologi', 'ID123456790', '081234567002'),
(3, 'Dr. Citra Dewi', 'Anak', 'ID123456791', '081234567003'),
(4, 'Dr. Dian Sari', 'Bedah Umum', 'ID123456792', '081234567004'),
(5, 'Dr. Eko Prasetyo', 'Neurologi', 'ID123456793', '081234567005'),
(6, 'Dr. Fitriani', 'Kandungan', 'ID123456794', '081234567006'),
(7, 'Dr. Gunawan', 'THT', 'ID123456795', '081234567007'),
(8, 'Dr. Hesti Putri', 'Mata', 'ID123456796', '081234567008'),
(9, 'Dr. Irfan Maulana', 'Orthopedi', 'ID123456797', '081234567009'),
(10, 'Dr. Jihan Ayu', 'Psikiatri', 'ID123456798', '081234567010'),
(11, 'Dr. Kevin Pratama', 'Dermatologi', 'ID123456799', '081234567011'),
(12, 'Dr. Lina Marlina', 'Gigi', 'ID123456800', '081234567012'),
(13, 'Dr. Muhammad Ali', 'Penyakit Dalam', 'ID123456801', '081234567013'),
(14, 'Dr. Nia Kurnia', 'Anestesi', 'ID123456802', '081234567014'),
(15, 'Dr. Oki Setiawan', 'Bedah Ortopedi', 'ID123456803', '081234567015'),
(16, 'Dr. Putri Anggraeni', 'Kandungan', 'ID123456804', '081234567016'),
(17, 'Dr. Rudi Hermawan', 'Jantung', 'ID123456805', '081234567017'),
(18, 'Dr. Siti Rahayu', 'Anak', 'ID123456806', '081234567018'),
(19, 'Dr. Tono Wijaya', 'Bedah Saraf', 'ID123456807', '081234567019'),
(20, 'Dr. Umi Kulsum', 'Penyakit Dalam', 'ID123456808', '081234567020'),
(21, 'Dr. Vino Bastian', 'THT', 'ID123456809', '081234567021'),
(22, 'Dr. Wulan Sari', 'Mata', 'ID123456810', '081234567022'),
(23, 'Dr. Xavier Tan', 'Neurologi', 'ID123456811', '081234567023'),
(24, 'Dr. Yuni Astuti', 'Psikiatri', 'ID123456812', '081234567024'),
(25, 'Dr. Zulkifli', 'Bedah Umum', 'ID123456813', '081234567025'),
(26, 'Dr. Agus Salim', 'Kardiologi', 'ID123456814', '081234567026'),
(27, 'Dr. Bella Amanda', 'Dermatologi', 'ID123456815', '081234567027'),
(28, 'Dr. Cahyo Adi', 'Orthopedi', 'ID123456816', '081234567028'),
(29, 'Dr. Dinda Maharani', 'Anak', 'ID123456817', '081234567029'),
(30, 'Dr. Eri Setiawan', 'Bedah Plastik', 'ID123456818', '081234567030'),
(31, 'Dr. Fanny Octavia', 'Kandungan', 'ID123456819', '081234567031'),
(32, 'Dr. Gilang Saputra', 'THT', 'ID123456820', '081234567032'),
(33, 'Dr. Hani Indriani', 'Mata', 'ID123456821', '081234567033'),
(34, 'Dr. Ivan Gunawan', 'Penyakit Dalam', 'ID123456822', '081234567034'),
(35, 'Dr. Jesslyn Halim', 'Neurologi', 'ID123456823', '081234567035'),
(36, 'Dr. Kevin Sanjaya', 'Bedah Umum', 'ID123456824', '081234567036'),
(37, 'Dr. Lala Kurnia', 'Psikiatri', 'ID123456825', '081234567037'),
(38, 'Dr. Miko Wijaya', 'Jantung', 'ID123456826', '081234567038'),
(39, 'Dr. Nadia Putri', 'Anestesi', 'ID123456827', '081234567039'),
(40, 'Dr. Oscar Pratama', 'Orthopedi', 'ID123456828', '081234567040'),
(41, 'Dr. Putra Aditya', 'Dermatologi', 'ID123456829', '081234567041'),
(42, 'Dr. Queen Bella', 'Anak', 'ID123456830', '081234567042'),
(43, 'Dr. Rizki Amelia', 'Kandungan', 'ID123456831', '081234567043'),
(44, 'Dr. Sandy Nugroho', 'THT', 'ID123456832', '081234567044'),
(45, 'Dr. Tasya Ramadhani', 'Mata', 'ID123456833', '081234567045'),
(46, 'Dr. Umar Said', 'Penyakit Dalam', 'ID123456834', '081234567046'),
(47, 'Dr. Vina Andriani', 'Neurologi', 'ID123456835', '081234567047'),
(48, 'Dr. Wahyu Kurniawan', 'Bedah Umum', 'ID123456836', '081234567048'),
(49, 'Dr. Xena Valentina', 'Psikiatri', 'ID123456837', '081234567049'),
(50, 'Dr. Yuda Permana', 'Jantung', 'ID123456838', '081234567050'),
(51, 'Dr. Zaskia Adya', 'Anestesi', 'ID123456839', '081234567051');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int NOT NULL,
  `id_pasien` int NOT NULL,
  `id_penyakit` int NOT NULL,
  `tgl_kunjungan` datetime NOT NULL,
  `gejala` text COLLATE utf8mb4_general_ci NOT NULL,
  `tindakan` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Rawat Jalan','Rawat Inap','Sembuh','Rujuk') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `id_pasien`, `id_penyakit`, `tgl_kunjungan`, `gejala`, `tindakan`, `status`) VALUES
(1, 1, 1, '2025-08-02 11:35:00', 'Jantung', 'Biasa aja', 'Rawat Inap'),
(2, 1, 1, '2023-01-05 09:00:00', 'Demam tinggi, sakit kepala, nyeri otot', 'Istirahat, minum banyak cairan, paracetamol', 'Sembuh'),
(3, 2, 2, '2023-01-10 10:30:00', 'Pusing, lemas, penglihatan kabur', 'Pemeriksaan tekanan darah, resep obat antihipertensi', 'Rawat Jalan'),
(4, 3, 3, '2023-01-15 11:15:00', 'Sering haus, sering buang air kecil, lemas', 'Tes gula darah, diet khusus diabetes', 'Rawat Jalan'),
(5, 4, 4, '2023-01-20 14:00:00', 'Batuk lebih dari 2 minggu, demam, berat badan turun', 'Tes dahak, pengobatan TB', 'Rawat Jalan'),
(6, 5, 5, '2023-02-01 08:45:00', 'Sesak napas, mengi', 'Inhaler, obat bronkodilator', 'Rawat Jalan'),
(7, 6, 1, '2023-02-10 10:00:00', 'Demam tinggi, mual, ruam kulit', 'Istirahat, cairan infus, pemantauan trombosit', 'Rawat Inap'),
(8, 7, 6, '2023-02-15 13:30:00', 'Diare 3 hari, lemas', 'Oralit, antibiotik', 'Sembuh'),
(9, 8, 7, '2023-02-20 09:15:00', 'Batuk berdahak, demam, sesak napas', 'Antibiotik, istirahat', 'Sembuh'),
(10, 9, 2, '2023-03-05 11:00:00', 'Pusing, mimisan', 'Pemeriksaan tekanan darah, penyesuaian obat', 'Rawat Jalan'),
(11, 10, 8, '2023-03-10 14:30:00', 'Nyeri ulu hati, mual', 'Antasida, diet lambung', 'Sembuh'),
(12, 11, 9, '2023-03-15 10:45:00', 'Lemas, pucat, pusing', 'Tes darah, suplemen zat besi', 'Rawat Jalan'),
(13, 12, 10, '2023-03-20 08:00:00', 'Nyeri sendi, bengkak', 'Obat antiinflamasi, fisioterapi', 'Rawat Jalan'),
(14, 13, 1, '2023-04-05 13:15:00', 'Demam, sakit kepala, nyeri belakang mata', 'Pemantauan trombosit, cairan infus', 'Rawat Inap'),
(15, 14, 3, '2023-04-10 09:30:00', 'Luka sulit sembuh, sering haus', 'Tes gula darah, penyesuaian insulin', 'Rawat Jalan'),
(16, 15, 4, '2023-04-15 11:45:00', 'Batuk darah, berat badan turun', 'Pengobatan TB lanjutan', 'Rawat Jalan'),
(17, 16, 5, '2023-04-20 14:00:00', 'Sesak napas malam hari', 'Penyesuaian obat, inhaler baru', 'Rawat Jalan'),
(18, 17, 6, '2023-05-05 10:15:00', 'Diare dengan darah', 'Antibiotik, cairan infus', 'Rawat Inap'),
(19, 18, 7, '2023-05-10 08:30:00', 'Demam tinggi, batuk, sesak', 'Antibiotik IV, oksigen', 'Rawat Inap'),
(20, 19, 2, '2023-05-15 12:45:00', 'Pusing, mual, penglihatan kabur', 'Pemeriksaan tekanan darah darurat', 'Rawat Inap'),
(21, 20, 9, '2023-05-20 09:00:00', 'Pingsan, sangat pucat', 'Transfusi darah, suplemen zat besi', 'Rawat Inap'),
(22, 21, 11, '2023-09-05 08:30:00', 'Demam, batuk, pilek', 'Obat simptomatik, istirahat', 'Sembuh'),
(23, 22, 12, '2023-09-10 10:15:00', 'Diare 2 hari, lemas', 'Oralit, antibiotik', 'Sembuh'),
(24, 23, 13, '2023-09-15 13:45:00', 'Demam tinggi, sakit kepala', 'Tes widal, antibiotik', 'Rawat Jalan'),
(25, 24, 14, '2023-09-20 09:00:00', 'Demam menggigil, nyeri otot', 'Tes malaria, pengobatan', 'Rawat Inap'),
(26, 25, 15, '2023-09-25 14:30:00', 'Mata merah, nyeri betis', 'Tes leptospirosis', 'Rawat Inap'),
(27, 26, 16, '2023-10-01 11:15:00', 'Ruam kulit, demam', 'Isolasi, pengobatan simptomatik', 'Sembuh'),
(28, 27, 17, '2023-10-05 08:45:00', 'Sakit tenggorokan, suara serak', 'Tes swab, antitoksin', 'Rawat Inap'),
(29, 28, 18, '2023-10-10 13:00:00', 'Batuk paroksismal, muntah', 'Antibiotik, istirahat', 'Rawat Jalan'),
(30, 29, 19, '2023-10-15 10:30:00', 'Berat badan turun, diare kronis', 'Tes HIV, pengobatan ARV', 'Rawat Jalan'),
(31, 30, 20, '2023-10-20 15:15:00', 'Kuning, mual, lemas', 'Tes fungsi hati, USG', 'Rawat Inap'),
(32, 31, 21, '2023-10-25 09:45:00', 'Benjolan payudara, nyeri', 'Mammografi, biopsi', 'Rawat Jalan'),
(33, 32, 22, '2023-11-01 14:00:00', 'Perdarahan pervaginam', 'Papsmear, USG transvaginal', 'Rawat Jalan'),
(34, 33, 23, '2023-11-05 08:15:00', 'Kelemahan sisi tubuh, bicara pelo', 'CT scan, terapi stroke', 'Rawat Inap'),
(35, 34, 24, '2023-11-10 11:30:00', 'Nyeri dada, keringat dingin', 'EKG, enzim jantung', 'Rawat Inap'),
(36, 35, 25, '2023-11-15 13:45:00', 'Sesak napas, bengkak kaki', 'Dialisis, diet ginjal', 'Rawat Inap'),
(37, 36, 26, '2023-11-20 10:00:00', 'Batuk kronis, sesak napas', 'Spirometri, bronkodilator', 'Rawat Jalan'),
(38, 37, 27, '2023-11-25 15:15:00', 'Kejang, tidak sadar', 'EEG, obat antikonvulsan', 'Rawat Inap'),
(39, 38, 28, '2023-12-01 09:30:00', 'Demam, nyeri sendi, ruam', 'Tes chikungunya', 'Rawat Jalan'),
(40, 39, 29, '2023-12-05 14:45:00', 'Gelisah, takut air, fotofobia', 'Perawatan intensif', 'Rawat Inap'),
(41, 40, 30, '2023-12-10 08:00:00', 'Pembengkakan kaki', 'Tes darah mikrofilaria', 'Rawat Jalan'),
(42, 41, 11, '2023-12-15 11:15:00', 'Batuk, pilek, demam ringan', 'Obat simptomatik', 'Sembuh'),
(43, 42, 12, '2023-12-20 16:30:00', 'Diare dengan darah', 'Antibiotik, cairan infus', 'Rawat Inap'),
(44, 43, 13, '2023-12-25 09:45:00', 'Demam tinggi, sakit kepala', 'Tes widal', 'Rawat Jalan'),
(45, 44, 14, '2024-01-01 14:00:00', 'Demam menggigil periodik', 'Tes malaria', 'Rawat Jalan'),
(46, 45, 15, '2024-01-05 08:15:00', 'Mata merah, nyeri otot', 'Tes leptospirosis', 'Rawat Inap'),
(47, 46, 16, '2024-01-10 11:30:00', 'Ruam kulit, demam', 'Isolasi, vitamin A', 'Sembuh'),
(48, 47, 17, '2024-01-15 13:45:00', 'Sakit tenggorokan, pseudomembran', 'Tes swab, antitoksin', 'Rawat Inap'),
(49, 48, 18, '2024-01-20 10:00:00', 'Batuk rejan, muntah', 'Antibiotik, isolasi', 'Rawat Jalan'),
(50, 49, 19, '2024-01-25 15:15:00', 'Berat badan turun, diare', 'Tes HIV, konseling', 'Rawat Jalan'),
(51, 50, 20, '2024-02-01 09:30:00', 'Kuning, mual, lemas', 'Tes fungsi hati', 'Rawat Inap'),
(52, 51, 21, '2024-02-05 14:45:00', 'Benjolan payudara', 'Mammografi', 'Rawat Jalan'),
(53, 52, 22, '2024-02-10 08:00:00', 'Keputihan abnormal', 'Papsmear, kolposkopi', 'Rawat Jalan'),
(54, 53, 23, '2024-02-15 11:15:00', 'Kelemahan wajah sebelah', 'CT scan kepala', 'Rawat Inap'),
(55, 54, 24, '2024-02-20 16:30:00', 'Nyeri dada menjalar ke lengan', 'EKG, enzim jantung', 'Rawat Inap'),
(56, 55, 25, '2024-02-25 09:45:00', 'Mual, sesak napas, edema', 'Tes fungsi ginjal', 'Rawat Inap'),
(57, 56, 26, '2024-03-01 14:00:00', 'Batuk kronis berdahak', 'Spirometri, rontgen thorax', 'Rawat Jalan'),
(58, 57, 27, '2024-03-05 08:15:00', 'Kejang fokal', 'EEG, MRI', 'Rawat Inap'),
(59, 58, 28, '2024-03-10 11:30:00', 'Demam, nyeri sendi hebat', 'Tes chikungunya', 'Rawat Jalan'),
(60, 59, 29, '2024-03-15 13:45:00', 'Gelisah, hidrofobia', 'Perawatan intensif', 'Rawat Inap'),
(61, 60, 30, '2024-03-20 10:00:00', 'Pembengkakan skrotum', 'Tes darah mikrofilaria', 'Rawat Jalan'),
(62, 52, 10, '2025-07-02 14:38:00', 'Anemia', 'Pencegahan', 'Rawat Inap'),
(63, 52, 62, '2025-07-03 15:28:00', '1', '1', 'Rawat Inap'),
(64, 52, 62, '2025-07-03 15:28:00', '1', '1', 'Rawat Inap'),
(65, 52, 62, '2025-07-11 17:41:00', 'a', 'a', 'Rawat Jalan'),
(67, 27, 17, '2025-07-04 16:02:00', 's', 's', 'Sembuh'),
(69, 70, 17, '2025-07-02 20:03:00', 's', 's', 'Rawat Inap');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nik`, `nama`, `tgl_lahir`, `gender`, `alamat`, `no_telp`) VALUES
(1, '12345678', 'Messi', '2025-07-26', 'Laki-laki', 'ITPLN', '0812345678'),
(2, '3273010101010001', 'Ahmad Santoso', '1980-05-15', 'Laki-laki', 'Jl. Merdeka No. 10, Jakarta', '081234567890'),
(3, '3273010202020002', 'Budi Setiawan', '1975-08-20', 'Laki-laki', 'Jl. Sudirman No. 25, Jakarta', '081234567891'),
(4, '3273010303030003', 'Citra Dewi', '1990-03-10', 'Perempuan', 'Jl. Thamrin No. 5, Jakarta', '081234567892'),
(5, '3273010404040004', 'Dian Sastro', '1985-11-25', 'Perempuan', 'Jl. Gatot Subroto No. 15, Jakarta', '081234567893'),
(6, '3273010505050005', 'Eko Prasetyo', '1978-07-30', 'Laki-laki', 'Jl. Asia Afrika No. 20, Bandung', '081234567894'),
(7, '3273010606060006', 'Fitriani', '1995-02-14', 'Perempuan', 'Jl. Pahlawan No. 30, Bandung', '081234567895'),
(8, '3273010707070007', 'Gunawan', '1982-09-05', 'Laki-laki', 'Jl. Diponegoro No. 12, Semarang', '081234567896'),
(9, '3273010808080008', 'Hesti Putri', '1992-12-18', 'Perempuan', 'Jl. Pemuda No. 8, Semarang', '081234567897'),
(10, '3273010909090009', 'Irfan Maulana', '1988-04-22', 'Laki-laki', 'Jl. Ahmad Yani No. 17, Surabaya', '081234567898'),
(11, '3273011010100010', 'Jihan Ayu', '1998-01-30', 'Perempuan', 'Jl. Raya Darmo No. 45, Surabaya', '081234567899'),
(12, '3273011111110011', 'Kurniawan', '1973-06-12', 'Laki-laki', 'Jl. M.T. Haryono No. 22, Yogyakarta', '081234567800'),
(13, '3273011212120012', 'Lina Marlina', '1987-10-08', 'Perempuan', 'Jl. Malioboro No. 5, Yogyakarta', '081234567801'),
(14, '3273011313130013', 'Maman Suherman', '1965-07-25', 'Laki-laki', 'Jl. Siliwangi No. 10, Bogor', '081234567802'),
(15, '3273011414140014', 'Nia Kurniasih', '1993-05-19', 'Perempuan', 'Jl. Raya Pajajaran No. 20, Bogor', '081234567803'),
(16, '3273011515150015', 'Oki Setiawan', '1984-08-15', 'Laki-laki', 'Jl. R.E. Martadinata No. 30, Cirebon', '081234567804'),
(17, '3273011616160016', 'Putri Wulandari', '1997-11-28', 'Perempuan', 'Jl. Siliwangi No. 15, Cirebon', '081234567805'),
(18, '3273011717170017', 'Rudi Hartono', '1970-04-03', 'Laki-laki', 'Jl. Merak No. 8, Tangerang', '081234567806'),
(19, '3273011818180018', 'Siti Aminah', '1968-09-17', 'Perempuan', 'Jl. K.S. Tubun No. 12, Tangerang', '081234567807'),
(20, '3273011919190019', 'Tono Wijaya', '1983-02-09', 'Laki-laki', 'Jl. Raya Serang No. 25, Serang', '081234567808'),
(21, '3273012020200020', 'Umi Kulsum', '1977-12-31', 'Perempuan', 'Jl. Raya Cilegon No. 18, Cilegon', '081234567809'),
(22, '3273012121210021', 'Vino Gading', '1991-03-22', 'Laki-laki', 'Jl. Perintis No. 7, Bekasi', '081234567810'),
(23, '3273012222220022', 'Wulan Sari', '1989-07-14', 'Perempuan', 'Jl. Jend. Sudirman No. 45, Bekasi', '081234567811'),
(24, '3273012323230023', 'Xavier Tan', '1976-11-05', 'Laki-laki', 'Jl. Dipati Ukur No. 33, Bandung', '081234567812'),
(25, '3273012424240024', 'Yuni Astuti', '1994-04-18', 'Perempuan', 'Jl. Cihampelas No. 12, Bandung', '081234567813'),
(26, '3273012525250025', 'Zulkifli', '1969-08-27', 'Laki-laki', 'Jl. Peta No. 8, Bandung', '081234567814'),
(27, '3273012626260026', 'Aisyah Rahma', '1996-01-09', 'Perempuan', 'Jl. Cikutra No. 20, Bandung', '081234567815'),
(28, '3273012727270027', 'Bambang Sudrajat', '1981-05-30', 'Laki-laki', 'Jl. Surapati No. 15, Bandung', '081234567816'),
(29, '3273012828280028', 'Cindy Permata', '1999-10-12', 'Perempuan', 'Jl. Lombok No. 5, Bandung', '081234567817'),
(30, '3273012929290029', 'Dodi Fernando', '1974-02-23', 'Laki-laki', 'Jl. Sumatra No. 28, Bandung', '081234567818'),
(31, '3273013030300030', 'Elisa Putri', '1986-06-16', 'Perempuan', 'Jl. Jawa No. 10, Bandung', '081234567819'),
(32, '3273013131310031', 'Fajar Nugraha', '1990-09-29', 'Laki-laki', 'Jl. Kalimantan No. 3, Bandung', '081234567820'),
(33, '3273013232320032', 'Gita Wulandari', '1983-12-02', 'Perempuan', 'Jl. Sulawesi No. 17, Bandung', '081234567821'),
(34, '3273013333330033', 'Hendro Susilo', '1979-04-15', 'Laki-laki', 'Jl. Papua No. 9, Bandung', '081234567822'),
(35, '3273013434340034', 'Intan Permata', '1992-07-28', 'Perempuan', 'Jl. Bali No. 6, Bandung', '081234567823'),
(36, '3273013535350035', 'Joko Santoso', '1967-10-11', 'Laki-laki', 'Jl. Aceh No. 22, Bandung', '081234567824'),
(37, '3273013636360036', 'Kartika Dewi', '1980-01-24', 'Perempuan', 'Jl. Riau No. 14, Bandung', '081234567825'),
(38, '3273013737370037', 'Luki Hermawan', '1993-05-07', 'Laki-laki', 'Jl. Jambi No. 8, Bandung', '081234567826'),
(39, '3273013838380038', 'Mira Susanti', '1988-08-20', 'Perempuan', 'Jl. Bengkulu No. 11, Bandung', '081234567827'),
(40, '3273013939390039', 'Nando Pratama', '1975-11-03', 'Laki-laki', 'Jl. Bangka No. 5, Bandung', '081234567828'),
(41, '3273014040400040', 'Olivia Wijaya', '1997-02-16', 'Perempuan', 'Jl. Belitung No. 19, Bandung', '081234567829'),
(42, '3273014141410041', 'Pandu Winata', '1984-05-29', 'Laki-laki', 'Jl. Banten No. 7, Bandung', '081234567830'),
(43, '3273014242420042', 'Queency Angel', '1991-09-12', 'Perempuan', 'Jl. Jakarta No. 13, Bandung', '081234567831'),
(44, '3273014343430043', 'Rizky Ramadhan', '1986-12-25', 'Laki-laki', 'Jl. Bogor No. 4, Bandung', '081234567832'),
(45, '3273014444440044', 'Siska Amelia', '1994-03-08', 'Perempuan', 'Jl. Depok No. 16, Bandung', '081234567833'),
(46, '3273014545450045', 'Teguh Prakoso', '1971-06-21', 'Laki-laki', 'Jl. Tangerang No. 10, Bandung', '081234567834'),
(47, '3273014646460046', 'Uci Sanusi', '1989-10-04', 'Perempuan', 'Jl. Bekasi No. 2, Bandung', '081234567835'),
(48, '3273014747470047', 'Viktor Siregar', '1976-01-17', 'Laki-laki', 'Jl. Cirebon No. 18, Bandung', '081234567836'),
(49, '3273014848480048', 'Winda Fitriani', '1995-04-30', 'Perempuan', 'Jl. Semarang No. 9, Bandung', '081234567837'),
(50, '3273014949490049', 'Yoga Pratama', '1982-08-13', 'Laki-laki', 'Jl. Surabaya No. 6, Bandung', '081234567838'),
(51, '3273015050500050', 'Zahra Aulia', '1998-11-26', 'Perempuan', 'Jl. Malang No. 12, Bandung', '081234567839'),
(52, '327301515151005000', 'Agus Salim', '1973-03-09', 'Laki-laki', 'Jl. Yogyakarta No. 8, Bandung', '081234567840'),
(53, '3273015252520052', 'Bella Nurul', '1980-06-22', 'Perempuan', 'Jl. Solo No. 15, Bandung', '081234567841'),
(54, '3273015353530053', 'Cahyo Adi', '1993-10-05', 'Laki-laki', 'Jl. Magelang No. 7, Bandung', '081234567842'),
(55, '3273015454540054', 'Dinda Maharani', '1987-01-18', 'Perempuan', 'Jl. Madiun No. 11, Bandung', '081234567843'),
(56, '3273015555550055', 'Eri Setiawan', '1974-04-01', 'Laki-laki', 'Jl. Kediri No. 14, Bandung', '081234567844'),
(57, '3273015656560056', 'Fanny Octavia', '1991-07-14', 'Perempuan', 'Jl. Blitar No. 5, Bandung', '081234567845'),
(58, '3273015757570057', 'Gilang Saputra', '1985-10-27', 'Laki-laki', 'Jl. Tulungagung No. 10, Bandung', '081234567846'),
(59, '3273015858580058', 'Hani Indriani', '1996-02-09', 'Perempuan', 'Jl. Pasuruan No. 3, Bandung', '081234567847'),
(60, '3273015959590059', 'Ivan Gunawan', '1979-05-22', 'Laki-laki', 'Jl. Probolinggo No. 17, Bandung', '081234567848'),
(61, '3273016060600060', 'Jesslyn Halim', '1984-09-05', 'Perempuan', 'Jl. Lumajang No. 9, Bandung', '081234567849'),
(62, '3273016161610061', 'Kevin Sanjaya', '1997-12-18', 'Laki-laki', 'Jl. Jember No. 12, Bandung', '081234567850'),
(63, '3273016262620062', 'Lala Kurnia', '1982-03-01', 'Perempuan', 'Jl. Banyuwangi No. 6, Bandung', '081234567851'),
(64, '3273016363630063', 'Miko Wijaya', '1977-06-14', 'Laki-laki', 'Jl. Bondowoso No. 8, Bandung', '081234567852'),
(65, '3273016464640064', 'Nadia Putri', '1994-09-27', 'Perempuan', 'Jl. Situbondo No. 14, Bandung', '081234567853'),
(66, '3273016565650065', 'Oscar Pratama', '1989-01-10', 'Laki-laki', 'Jl. Jombang No. 7, Bandung', '081234567854'),
(67, '3273016666660066', 'Putra Aditya', '1976-04-23', 'Laki-laki', 'Jl. Mojokerto No. 11, Bandung', '081234567855'),
(68, '3273016767670067', 'Queen Bella', '1993-08-06', 'Perempuan', 'Jl. Lamongan No. 5, Bandung', '081234567856'),
(69, '3273016868680068', 'Rizki Amelia', '1988-11-19', 'Perempuan', 'Jl. Gresik No. 13, Bandung', '081234567857'),
(70, '3273016969690069', 'Sandy Nugroho', '1975-02-01', 'Laki-laki', 'Jl. Sidoarjo No. 10, Bandung', '081234567858'),
(71, '3273017070700070', 'Tasya Ramadhani', '1998-05-14', 'Perempuan', 'Jl. Ngawi No. 8, Bandung', '081234567859'),
(72, '3273017171710071', 'Umar Said', '1983-08-27', 'Laki-laki', 'Jl. Nganjuk No. 12, Bandung', '081234567860'),
(73, '3273017272720072', 'Vina Andriani', '1990-12-10', 'Perempuan', 'Jl. Bojonegoro No. 6, Bandung', '081234567861'),
(74, '3273017373730073', 'Wahyu Kurniawan', '1977-03-23', 'Laki-laki', 'Jl. Tuban No. 9, Bandung', '081234567862'),
(75, '3273017474740074', 'Xena Valentina', '1994-07-06', 'Perempuan', 'Jl. Ponorogo No. 15, Bandung', '081234567863'),
(76, '3273017575750075', 'Yuda Permana', '1989-10-19', 'Laki-laki', 'Jl. Trenggalek No. 7, Bandung', '081234567864'),
(77, '3273017676760076', 'Zaskia Adya', '1974-01-01', 'Perempuan', 'Jl. Pacitan No. 11, Bandung', '081234567865'),
(78, '3273017777770077', 'Arya Baskara', '1991-04-14', 'Laki-laki', 'Jl. Magetan No. 8, Bandung', '081234567866'),
(79, '3273017878780078', 'Bunga Citra', '1986-07-27', 'Perempuan', 'Jl. Ponorogo No. 12, Bandung', '081234567867'),
(80, '3273017979790079', 'Cakra Ningrat', '1973-11-09', 'Laki-laki', 'Jl. Ngawi No. 5, Bandung', '081234567868'),
(81, '3273018080800080', 'Dewi Sartika', '1996-02-22', 'Perempuan', 'Jl. Madiun No. 14, Bandung', '081234567869'),
(82, '3273018181810081', 'Ega Fernanda', '1981-06-05', 'Laki-laki', 'Jl. Kediri No. 9, Bandung', '081234567870'),
(83, '3273018282820082', 'Fira Yuniar', '1993-09-18', 'Perempuan', 'Jl. Blitar No. 6, Bandung', '081234567871'),
(84, '3273018383830083', 'Guntur Wijaya', '1978-12-31', 'Laki-laki', 'Jl. Tulungagung No. 11, Bandung', '081234567872'),
(85, '3273018484840084', 'Hilda Novianti', '1995-04-13', 'Perempuan', 'Jl. Trenggalek No. 7, Bandung', '081234567873'),
(86, '3273018585850085', 'Indra Kurnia', '1980-07-26', 'Laki-laki', 'Jl. Ponorogo No. 13, Bandung', '081234567874'),
(87, '3273018686860086', 'Jelita Sari', '1997-11-08', 'Perempuan', 'Jl. Pacitan No. 5, Bandung', '081234567875'),
(88, '3273018787870087', 'Krisna Aditya', '1984-02-21', 'Laki-laki', 'Jl. Ngawi No. 10, Bandung', '081234567876'),
(89, '3273018888880088', 'Lia Amelia', '1991-06-04', 'Perempuan', 'Jl. Magetan No. 8, Bandung', '081234567877'),
(90, '3273018989890089', 'Mario Tegar', '1976-09-17', 'Laki-laki', 'Jl. Ponorogo No. 12, Bandung', '081234567878'),
(91, '3273019090900090', 'Nia Ramadhani', '1993-12-30', 'Perempuan', 'Jl. Ngawi No. 6, Bandung', '081234567879'),
(92, '3273019191910091', 'Oki Pratama', '1988-04-12', 'Laki-laki', 'Jl. Madiun No. 9, Bandung', '081234567880'),
(93, '3273019292920092', 'Putri Anggraini', '1995-07-25', 'Perempuan', 'Jl. Kediri No. 11, Bandung', '081234567881'),
(94, '3273019393930093', 'Rangga Saputra', '1980-11-07', 'Laki-laki', 'Jl. Blitar No. 7, Bandung', '081234567882'),
(95, '3273019494940094', 'Siska Wulandari', '1997-02-20', 'Perempuan', 'Jl. Tulungagung No. 14, Bandung', '081234567883'),
(96, '3273019595950095', 'Taufik Hidayat', '1982-06-03', 'Laki-laki', 'Jl. Trenggalek No. 8, Bandung', '081234567884'),
(97, '3273019696960096', 'Ulya Fitri', '1994-09-16', 'Perempuan', 'Jl. Ponorogo No. 10, Bandung', '081234567885'),
(98, '3273019797970097', 'Vito Prasetyo', '1979-12-29', 'Laki-laki', 'Jl. Pacitan No. 12, Bandung', '081234567886'),
(99, '3273019898980098', 'Winda Puspita', '1996-04-11', 'Perempuan', 'Jl. Ngawi No. 5, Bandung', '081234567887'),
(100, '3273019999990099', 'Yoga Maulana', '1983-07-24', 'Laki-laki', 'Jl. Magetan No. 9, Bandung', '081234567888'),
(101, '3273020101010100', 'Zahra Fitriani', '1998-11-06', 'Perempuan', 'Jl. Ponorogo No. 7, Bandung', '081234567889'),
(109, '234567899', 'Argus', '2025-07-02', 'Laki-laki', 'a', '089849284928448');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nama`, `kategori`, `deskripsi`) VALUES
(1, 'Jantung', 'Ringan', 'ya'),
(2, 'Demam Berdarah Dengue', 'Infeksi', 'Penyakit yang ditularkan melalui nyamuk Aedes aegypti'),
(3, 'Hipertensi', 'Jantung', 'Tekanan darah tinggi'),
(4, 'Diabetes Melitus Tipe 2', 'Metabolik', 'Gangguan metabolisme gula darah'),
(5, 'Tuberkulosis', 'Infeksi', 'Infeksi bakteri Mycobacterium tuberculosis'),
(6, 'Asma Bronkial', 'Pernapasan', 'Gangguan pernapasan kronis'),
(7, 'Gastroenteritis', 'Pencernaan', 'Peradangan saluran pencernaan'),
(8, 'Pneumonia', 'Infeksi', 'Infeksi paru-paru'),
(9, 'Gastritis', 'Pencernaan', 'Peradangan lapisan lambung'),
(10, 'Anemia Defisiensi Besi', 'Darah', 'Kekurangan sel darah merah atau hemoglobin'),
(11, 'Osteoartritis', 'Sendi', 'Degenerasi tulang rawan sendi'),
(12, 'ISPA (Infeksi Saluran Pernapasan Akut)', 'Pernapasan', 'Infeksi saluran pernapasan atas'),
(13, 'Diare Akut', 'Pencernaan', 'Gangguan pencernaan dengan frekuensi BAB meningkat'),
(14, 'Demam Tifoid', 'Infeksi', 'Infeksi bakteri Salmonella typhi'),
(15, 'Malaria', 'Infeksi', 'Penyakit parasit yang ditularkan nyamuk'),
(16, 'Leptospirosis', 'Infeksi', 'Penyakit zoonosis dari bakteri Leptospira'),
(17, 'Campak', 'Infeksi', 'Penyakit virus sangat menular'),
(18, 'Difteri', 'Infeksi', 'Infeksi bakteri Corynebacterium diphtheriae'),
(19, 'Pertusis', 'Infeksi', 'Batuk rejan'),
(20, 'HIV/AIDS', 'Infeksi', 'Sindrom defisiensi imun'),
(21, 'Hepatitis B', 'Infeksi', 'Peradangan hati akibat virus HBV'),
(22, 'Kanker Payudara', 'Neoplasma', 'Tumor ganas jaringan payudara'),
(23, 'Kanker Serviks', 'Neoplasma', 'Tumor ganas leher rahim'),
(24, 'Stroke', 'Syaraf', 'Gangguan pembuluh darah otak'),
(25, 'Penyakit Jantung Koroner', 'Jantung', 'Penyempitan pembuluh darah jantung'),
(26, 'Gagal Ginjal Kronik', 'Ginjal', 'Penurunan fungsi ginjal progresif'),
(27, 'Bronkitis Kronis', 'Pernapasan', 'Peradangan saluran pernapasan menahun'),
(28, 'Epilepsi', 'Syaraf', 'Gangguan sistem saraf pusat'),
(29, 'Demam Chikungunya', 'Infeksi', 'Penyakit virus ditularkan nyamuk'),
(30, 'Rabies', 'Infeksi', 'Penyakit virus dari gigitan hewan'),
(31, 'Filariasis', 'Infeksi', 'Penyakit kaki gajah'),
(32, 'Demam Berdarah Dengue', 'Infeksi', 'Penyakit yang ditularkan melalui nyamuk Aedes aegypti'),
(33, 'Hipertensi', 'Jantung', 'Tekanan darah tinggi'),
(34, 'Diabetes Melitus Tipe 2', 'Metabolik', 'Gangguan metabolisme gula darah'),
(35, 'Tuberkulosis', 'Infeksi', 'Infeksi bakteri Mycobacterium tuberculosis'),
(36, 'Asma Bronkial', 'Pernapasan', 'Gangguan pernapasan kronis'),
(37, 'Gastroenteritis', 'Pencernaan', 'Peradangan saluran pencernaan'),
(38, 'Pneumonia', 'Infeksi', 'Infeksi paru-paru'),
(39, 'Gastritis', 'Pencernaan', 'Peradangan lapisan lambung'),
(40, 'Anemia Defisiensi Besi', 'Darah', 'Kekurangan sel darah merah atau hemoglobin'),
(41, 'Osteoartritis', 'Sendi', 'Degenerasi tulang rawan sendi'),
(42, 'ISPA (Infeksi Saluran Pernapasan Akut)', 'Pernapasan', 'Infeksi saluran pernapasan atas'),
(43, 'Diare Akut', 'Pencernaan', 'Gangguan pencernaan dengan frekuensi BAB meningkat'),
(44, 'Demam Tifoid', 'Infeksi', 'Infeksi bakteri Salmonella typhi'),
(45, 'Malaria', 'Infeksi', 'Penyakit parasit yang ditularkan nyamuk'),
(46, 'Leptospirosis', 'Infeksi', 'Penyakit zoonosis dari bakteri Leptospira'),
(47, 'Campak', 'Infeksi', 'Penyakit virus sangat menular'),
(48, 'Difteri', 'Infeksi', 'Infeksi bakteri Corynebacterium diphtheriae'),
(49, 'Pertusis', 'Infeksi', 'Batuk rejan'),
(50, 'HIV/AIDS', 'Infeksi', 'Sindrom defisiensi imun'),
(51, 'Hepatitis B', 'Infeksi', 'Peradangan hati akibat virus HBV'),
(52, 'Kanker Payudara', 'Neoplasma', 'Tumor ganas jaringan payudara'),
(53, 'Kanker Serviks', 'Neoplasma', 'Tumor ganas leher rahim'),
(54, 'Stroke', 'Syaraf', 'Gangguan pembuluh darah otak'),
(55, 'Penyakit Jantung Koroner', 'Jantung', 'Penyempitan pembuluh darah jantung'),
(56, 'Gagal Ginjal Kronik', 'Ginjal', 'Penurunan fungsi ginjal progresif'),
(57, 'Bronkitis Kronis', 'Pernapasan', 'Peradangan saluran pernapasan menahun'),
(58, 'Epilepsi', 'Syaraf', 'Gangguan sistem saraf pusat'),
(59, 'Demam Chikungunya', 'Infeksi', 'Penyakit virus ditularkan nyamuk'),
(60, 'Rabies', 'Infeksi', 'Penyakit virus dari gigitan hewan'),
(61, 'Filariasis', 'Infeksi', 'Penyakit kaki gajah'),
(62, 'a', 'a', 'a'),
(63, 'Anemia Defisiensi Vitamin B12', 'Darah', 'Kekurangan vitamin B12 menyebabkan produksi sel darah merah tidak normal'),
(64, 'Hipertensi Esensial', 'Jantung', 'Tekanan darah tinggi tanpa penyebab yang jelas'),
(65, 'Diabetes Melitus Tipe 2', 'Endokrin', 'Gangguan metabolisme gula darah akibat resistensi insulin'),
(66, 'Asma Bronkial', 'Pernapasan', 'Penyakit saluran napas kronis dengan penyempitan saluran udara'),
(67, 'Gastritis', 'Pencernaan', 'Peradangan pada lapisan lambung'),
(68, 'Dermatitis Atopik', 'Kulit', 'Peradangan kulit kronis dengan gatal dan ruam'),
(69, 'Osteoartritis', 'Tulang', 'Degenerasi tulang rawan sendi'),
(70, 'Migrain', 'Saraf', 'Sakit kepala sebelah dengan gejala neurologis'),
(71, 'Konjungtivitis', 'Mata', 'Peradangan pada selaput mata'),
(72, 'Otitis Media', 'THT', 'Infeksi telinga bagian tengah'),
(73, 'Pneumonia', 'Pernapasan', 'Infeksi paru-paru dengan peradangan alveoli'),
(74, 'Hepatitis B', 'Hati', 'Infeksi virus pada hati tipe B'),
(75, 'Tuberkulosis', 'Pernapasan', 'Infeksi bakteri Mycobacterium tuberculosis'),
(76, 'Demam Berdarah Dengue', 'Infeksi', 'Penyakit virus melalui nyamuk Aedes aegypti'),
(77, 'Malaria', 'Infeksi', 'Penyakit parasit melalui nyamuk Anopheles'),
(78, 'Leptospirosis', 'Infeksi', 'Penyakit bakteri dari air kencing hewan'),
(79, 'Tifoid', 'Infeksi', 'Infeksi Salmonella typhi melalui makanan terkontaminasi'),
(80, 'Campak', 'Infeksi', 'Penyakit virus sangat menular dengan ruam kulit'),
(81, 'Rubella', 'Infeksi', 'Penyakit virus dengan ruam merah muda'),
(82, 'Varicella', 'Infeksi', 'Penyakit cacar air akibat virus varicella-zoster'),
(83, 'Herpes Zoster', 'Infeksi', 'Reaktivasi virus varicella-zoster dengan ruam nyeri'),
(84, 'HIV/AIDS', 'Infeksi', 'Gangguan sistem imun akibat virus HIV'),
(85, 'Kanker Payudara', 'Onkologi', 'Pertumbuhan sel abnormal di jaringan payudara'),
(86, 'Kanker Paru', 'Onkologi', 'Pertumbuhan sel abnormal di jaringan paru'),
(87, 'Kanker Kolorektal', 'Onkologi', 'Pertumbuhan sel abnormal di usus besar/rektum'),
(88, 'Kanker Prostat', 'Onkologi', 'Pertumbuhan sel abnormal di kelenjar prostat'),
(89, 'Kanker Serviks', 'Onkologi', 'Pertumbuhan sel abnormal di leher rahim'),
(90, 'Leukemia Limfoblastik Akut', 'Onkologi', 'Kanker sel darah putih yang berkembang cepat'),
(91, 'Lymphoma Non-Hodgkin', 'Onkologi', 'Kanker sistem limfatik'),
(92, 'Multiple Myeloma', 'Onkologi', 'Kanker sel plasma di sumsum tulang'),
(93, 'Glaukoma', 'Mata', 'Kerusakan saraf optik akibat tekanan mata tinggi'),
(94, 'Katarak', 'Mata', 'Kekeruhan lensa mata yang menyebabkan penglihatan kabur'),
(95, 'Retinopati Diabetik', 'Mata', 'Kerusakan retina akibat diabetes'),
(96, 'Gagal Jantung Kongestif', 'Jantung', 'Ketidakmampuan jantung memompa darah cukup'),
(97, 'Aritmia Jantung', 'Jantung', 'Gangguan irama jantung'),
(98, 'Penyakit Jantung Koroner', 'Jantung', 'Penyempitan pembuluh darah jantung'),
(99, 'Stroke Iskemik', 'Saraf', 'Penyumbatan pembuluh darah otak'),
(100, 'Stroke Hemoragik', 'Saraf', 'Pendarahan pembuluh darah otak'),
(101, 'Epilepsi', 'Saraf', 'Gangguan sistem saraf dengan kejang berulang'),
(102, 'Parkinson', 'Saraf', 'Gangguan neurodegeneratif dengan tremor'),
(104, 'Sirosis Hati', 'Hati', 'Jaringan parut hati kronis'),
(105, 'Pankreatitis', 'Pencernaan', 'Peradangan pankreas'),
(106, 'Ulkus Peptikum', 'Pencernaan', 'Luka pada lapisan lambung atau usus kecil'),
(107, 'Irritable Bowel Syndrome', 'Pencernaan', 'Gangguan usus besar dengan nyeri perut'),
(108, 'Gagal Ginjal Kronis', 'Ginjal', 'Penurunan fungsi ginjal progresif'),
(109, 'Batu Ginjal', 'Ginjal', 'Endapan mineral keras di ginjal'),
(110, 'Glomerulonefritis', 'Ginjal', 'Peradangan unit penyaring ginjal'),
(111, 'Anemia Sel Sabit', 'Darah', 'Kelainan hemoglobin menyebabkan sel darah merah berbentuk sabit'),
(112, 'Hemofilia', 'Darah', 'Gangguan pembekuan darah'),
(113, 'Psoriasis', 'Kulit', 'Penyakit autoimun dengan kulit bersisik');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id_resep` int NOT NULL,
  `id_kunjungan` int NOT NULL,
  `id_dokter` int NOT NULL,
  `tgl_resep` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id_resep`, `id_kunjungan`, `id_dokter`, `tgl_resep`, `total_harga`) VALUES
(1, 1, 1, '2023-01-05', 125000.00),
(2, 2, 2, '2023-01-10', 85000.00),
(3, 3, 3, '2023-01-15', 150000.00),
(4, 4, 4, '2023-01-20', 200000.00),
(5, 5, 5, '2023-01-25', 75000.00),
(6, 6, 6, '2023-02-01', 300000.00),
(7, 7, 7, '2023-02-05', 120000.00),
(8, 8, 8, '2023-02-10', 180000.00),
(9, 9, 9, '2023-02-15', 95000.00),
(10, 10, 10, '2023-02-20', 250000.00),
(11, 11, 11, '2023-02-25', 110000.00),
(12, 12, 12, '2023-03-01', 175000.00),
(13, 13, 13, '2023-03-05', 225000.00),
(14, 14, 14, '2023-03-10', 80000.00),
(15, 15, 15, '2023-03-15', 140000.00),
(16, 16, 16, '2023-03-20', 190000.00),
(17, 17, 17, '2023-03-25', 105000.00),
(18, 18, 18, '2023-04-01', 260000.00),
(19, 19, 19, '2023-04-05', 90000.00),
(20, 20, 20, '2023-04-10', 160000.00),
(21, 21, 21, '2023-04-15', 210000.00),
(22, 22, 22, '2023-04-20', 115000.00),
(23, 23, 23, '2023-04-25', 270000.00),
(24, 24, 24, '2023-05-01', 100000.00),
(25, 25, 25, '2023-05-05', 170000.00),
(26, 26, 26, '2023-05-10', 220000.00),
(27, 27, 27, '2023-05-15', 125000.00),
(28, 28, 28, '2023-05-20', 280000.00),
(29, 29, 29, '2023-05-25', 110000.00),
(30, 30, 30, '2023-06-01', 180000.00),
(31, 31, 31, '2023-06-05', 230000.00),
(32, 32, 32, '2023-06-10', 135000.00),
(33, 33, 33, '2023-06-15', 290000.00),
(34, 34, 34, '2023-06-20', 120000.00),
(35, 35, 35, '2023-06-25', 190000.00),
(36, 36, 36, '2023-07-01', 240000.00),
(37, 37, 37, '2023-07-05', 145000.00),
(38, 38, 38, '2023-07-10', 300000.00),
(39, 39, 39, '2023-07-15', 130000.00),
(40, 40, 40, '2023-07-20', 200000.00),
(41, 41, 41, '2023-07-25', 250000.00),
(42, 42, 42, '2023-08-01', 155000.00),
(43, 43, 43, '2023-08-05', 310000.00),
(44, 44, 44, '2023-08-10', 140000.00),
(45, 45, 45, '2023-08-15', 210000.00),
(46, 46, 46, '2023-08-20', 260000.00),
(47, 47, 47, '2023-08-25', 165000.00),
(48, 48, 48, '2023-09-01', 320000.00),
(49, 49, 49, '2023-09-05', 150000.00),
(50, 50, 50, '2023-09-10', 220000.00),
(51, 1, 26, '2025-07-05', 2.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_resep` (`id_resep`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `no_izin_praktek` (`no_izin_praktek`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_kunjungan` (`id_kunjungan`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id_resep` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD CONSTRAINT `detail_resep_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep_obat` (`id_resep`);

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `resep_obat_ibfk_1` FOREIGN KEY (`id_kunjungan`) REFERENCES `kunjungan` (`id_kunjungan`),
  ADD CONSTRAINT `resep_obat_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
