-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2024 at 04:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kumhrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `aid` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `adate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `atime` time DEFAULT '10:15:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`aid`, `patient_id`, `doctor_id`, `adate`, `status`, `atime`) VALUES
(1, 1, 1, '2024-05-01', 'Completed', '10:30:00'),
(2, 2, 2, '2024-05-02', 'Scheduled', '10:30:00'),
(3, 3, 3, '2024-05-03', 'Completed', '10:30:00'),
(4, 4, 4, '2024-05-04', 'Cancelled', '10:30:00'),
(5, 5, 5, '2024-05-05', 'Scheduled', '10:30:00'),
(6, 6, 6, '2024-05-06', 'Completed', '10:30:00'),
(7, 7, 7, '2024-05-07', 'Scheduled', '10:30:00'),
(8, 8, 8, '2024-05-08', 'Completed', '10:30:00'),
(9, 9, 9, '2024-05-09', 'Scheduled', '10:30:00'),
(10, 10, 10, '2024-05-10', 'Completed', '10:30:00'),
(11, 11, 11, '2024-05-11', 'Cancelled', '10:30:00'),
(12, 12, 12, '2024-05-12', 'Scheduled', '10:30:00'),
(13, 13, 13, '2024-05-13', 'Completed', '10:30:00'),
(14, 14, 14, '2024-05-14', 'Scheduled', '10:30:00'),
(15, 15, 15, '2024-05-15', 'Completed', '10:30:00'),
(16, 16, 16, '2024-05-16', 'Scheduled', '10:30:00'),
(17, 17, 17, '2024-05-17', 'Completed', '10:30:00'),
(18, 18, 18, '2024-05-18', 'Scheduled', '10:30:00'),
(19, 19, 19, '2024-05-19', 'Completed', '10:30:00'),
(20, 20, 20, '2024-05-20', 'Scheduled', '10:30:00'),
(21, 1, 21, '2024-05-21', 'Completed', '10:30:00'),
(22, 2, 22, '2024-05-22', 'Scheduled', '10:30:00'),
(23, 3, 23, '2024-05-23', 'Completed', '10:30:00'),
(24, 4, 24, '2024-05-24', 'Cancelled', '10:30:00'),
(25, 5, 25, '2024-05-25', 'Scheduled', '10:30:00'),
(26, 6, 26, '2024-05-26', 'Completed', '10:30:00'),
(27, 7, 27, '2024-05-27', 'Scheduled', '10:30:00'),
(28, 8, 28, '2024-05-28', 'Completed', '10:30:00'),
(29, 9, 29, '2024-05-29', 'Scheduled', '10:30:00'),
(30, 10, 30, '2024-05-30', 'Completed', '10:30:00'),
(31, 7, 24, '2024-05-16', 'Scheduled', '11:30:00'),
(32, 7, 24, '2024-05-16', 'Scheduled', '11:30:00'),
(33, 7, 2, '2024-05-16', 'Scheduled', '11:00:00'),
(34, 7, 9, '2024-05-16', 'Scheduled', '08:00:00'),
(35, 7, 9, '2024-05-16', 'Scheduled', '08:00:00'),
(36, 7, 24, '2024-05-24', 'Scheduled', '09:30:00'),
(37, 7, 15, '2024-05-31', 'Scheduled', '09:00:00'),
(38, 7, 15, '2024-05-31', 'Scheduled', '08:30:00'),
(39, 21, 14, '2024-05-31', 'Scheduled', '12:00:00'),
(40, NULL, 29, '2024-05-22', 'Scheduled', '10:00:00'),
(41, 1, 28, '2024-05-19', 'Scheduled', '12:00:00'),
(42, 22, 8, '2024-05-17', 'Scheduled', '08:00:00'),
(43, 22, 8, '2024-05-17', 'Scheduled', '08:30:00'),
(44, 22, 8, '2024-05-17', 'Scheduled', '09:00:00'),
(45, 24, 4, '2024-05-22', 'Scheduled', '09:30:00'),
(46, 1, 26, '2024-05-23', 'Scheduled', '10:30:00'),
(47, 1, 33, '2024-05-22', 'Scheduled', '09:30:00'),
(48, 25, 24, '2024-05-24', 'Scheduled', '11:00:00'),
(49, 25, 13, '2024-06-01', 'Scheduled', '10:00:00'),
(50, 25, 33, '2024-06-04', 'Scheduled', '08:30:00'),
(51, 25, 34, '2024-06-07', 'Scheduled', '09:00:00'),
(52, NULL, 33, '2024-06-01', 'Scheduled', '10:00:00'),
(53, 26, 33, '2024-05-30', 'Scheduled', '08:00:00'),
(54, 26, 33, '2024-05-30', 'Scheduled', '10:00:00'),
(55, 26, 33, '2024-05-30', 'Scheduled', '08:30:00'),
(56, 26, 33, '2024-05-30', 'Scheduled', '09:00:00'),
(57, 26, 33, '2024-05-30', 'Scheduled', '09:30:00'),
(58, 26, 33, '2024-05-30', 'Scheduled', '10:30:00'),
(59, 26, 33, '2024-05-30', 'Scheduled', '11:00:00'),
(60, 26, 33, '2024-05-30', 'Scheduled', '11:30:00'),
(61, 26, 33, '2024-05-30', 'Scheduled', '12:00:00'),
(62, 26, 8, '2024-05-30', 'Scheduled', '08:00:00'),
(63, 22, 33, '2024-06-08', 'Scheduled', '08:00:00'),
(64, 25, 6, '2024-06-06', 'Scheduled', '08:00:00'),
(65, 25, 5, '2024-06-06', 'Scheduled', '10:00:00'),
(66, 22, 22, '2024-06-11', 'Scheduled', '08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `department_id` int(11) NOT NULL,
  `dname` varchar(100) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`department_id`, `dname`, `hospital_id`) VALUES
(8, 'Acil Servis', 3),
(23, 'Acil Servis', 8),
(38, 'Acil Servis', 13),
(53, 'Acil Servis', 18),
(62, 'Beyin Cerrahisi', 22),
(63, 'Dahiliye', 23),
(14, 'Dermatoloji', 5),
(29, 'Dermatoloji', 10),
(44, 'Dermatoloji', 15),
(59, 'Dermatoloji', 20),
(9, 'Kadın Doğum', 3),
(24, 'Kadın Doğum', 8),
(39, 'Kadın Doğum', 13),
(54, 'Kadın Doğum', 18),
(1, 'Kardiyoloji', 1),
(7, 'Kardiyoloji', 3),
(10, 'Kardiyoloji', 4),
(16, 'Kardiyoloji', 6),
(22, 'Kardiyoloji', 8),
(25, 'Kardiyoloji', 9),
(31, 'Kardiyoloji', 11),
(37, 'Kardiyoloji', 13),
(40, 'Kardiyoloji', 14),
(46, 'Kardiyoloji', 16),
(52, 'Kardiyoloji', 18),
(55, 'Kardiyoloji', 19),
(2, 'Nöroloji', 1),
(11, 'Nöroloji', 4),
(17, 'Nöroloji', 6),
(26, 'Nöroloji', 9),
(32, 'Nöroloji', 11),
(41, 'Nöroloji', 14),
(47, 'Nöroloji', 16),
(56, 'Nöroloji', 19),
(6, 'Onkoloji', 2),
(15, 'Onkoloji', 5),
(21, 'Onkoloji', 7),
(30, 'Onkoloji', 10),
(36, 'Onkoloji', 12),
(45, 'Onkoloji', 15),
(51, 'Onkoloji', 17),
(60, 'Onkoloji', 20),
(61, 'Onkoloji', 21),
(3, 'Ortopedi', 1),
(13, 'Ortopedi', 5),
(18, 'Ortopedi', 6),
(28, 'Ortopedi', 10),
(33, 'Ortopedi', 11),
(43, 'Ortopedi', 15),
(48, 'Ortopedi', 16),
(58, 'Ortopedi', 20),
(4, 'Pediatri', 2),
(12, 'Pediatri', 4),
(19, 'Pediatri', 7),
(27, 'Pediatri', 9),
(34, 'Pediatri', 12),
(42, 'Pediatri', 14),
(49, 'Pediatri', 17),
(57, 'Pediatri', 19),
(5, 'Radyoloji', 2),
(20, 'Radyoloji', 7),
(35, 'Radyoloji', 12),
(50, 'Radyoloji', 17);

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `doctor_id` int(11) NOT NULL,
  `rid` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`doctor_id`, `rid`, `department_id`) VALUES
(1, 2, 1),
(2, 4, 2),
(3, 6, 3),
(4, 8, 4),
(5, 9, 5),
(6, 11, 6),
(7, 13, 7),
(8, 15, 8),
(9, 16, 9),
(10, 18, 10),
(11, 20, 11),
(12, 21, 12),
(13, 23, 13),
(14, 25, 14),
(15, 26, 15),
(16, 28, 16),
(17, 30, 17),
(18, 31, 18),
(19, 33, 19),
(20, 34, 20),
(21, 36, 21),
(22, 37, 22),
(23, 39, 23),
(24, 41, 24),
(25, 43, 25),
(26, 45, 26),
(27, 47, 27),
(28, 49, 28),
(29, 50, 29),
(30, 1, 30),
(31, 53, 61),
(32, 53, 61),
(33, 54, 62),
(34, 56, 63);

-- --------------------------------------------------------

--
-- Table structure for table `Hospital`
--

CREATE TABLE `Hospital` (
  `hospital_id` int(11) NOT NULL,
  `hname` varchar(100) DEFAULT NULL,
  `haddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Hospital`
--

INSERT INTO `Hospital` (`hospital_id`, `hname`, `haddress`) VALUES
(1, 'Acıbadem Hastanesi', 'Şişli Mahallesi, Şişli, İstanbul'),
(2, 'Amerikan Hastanesi', 'Nişantaşı Mahallesi, Şişli, İstanbul'),
(3, 'Memorial Hastanesi', 'Bahçelievler Mahallesi, Bahçelievler, İstanbul'),
(4, 'Florence Nightingale Hastanesi', 'Mecidiyeköy Mahallesi, Şişli, İstanbul'),
(5, 'Medical Park Hastanesi', 'Göztepe Mahallesi, Kadıköy, İstanbul'),
(6, 'Anadolu Sağlık Merkezi', 'Gebze Mahallesi, Gebze, Kocaeli'),
(7, 'Başkent Üniversitesi Hastanesi', 'Bahçelievler Mahallesi, Çankaya, Ankara'),
(8, 'Koç Üniversitesi Hastanesi', 'Topkapı Mahallesi, Fatih, İstanbul'),
(9, 'Liv Hospital', 'Ulus Mahallesi, Beşiktaş, İstanbul'),
(10, 'Medicana Hastanesi', 'Beylikdüzü Mahallesi, Beylikdüzü, İstanbul'),
(11, 'Şişli Etfal Hastanesi', 'Etfal Mahallesi, Şişli, İstanbul'),
(12, 'Türkiye Hastanesi', 'Cevizlibağ Mahallesi, Zeytinburnu, İstanbul'),
(13, 'Yeditepe Üniversitesi Hastanesi', 'Kayışdağı Mahallesi, Ataşehir, İstanbul'),
(14, 'Gaziantep Üniversitesi Hastanesi', 'Şehitkamil Mahallesi, Şehitkamil, Gaziantep'),
(15, 'Antalya Eğitim ve Araştırma Hastanesi', 'Muratpaşa Mahallesi, Muratpaşa, Antalya'),
(16, 'Pamukkale Üniversitesi Hastanesi', 'Kınıklı Mahallesi, Pamukkale, Denizli'),
(17, 'Dokuz Eylül Üniversitesi Hastanesi', 'Balçova Mahallesi, Balçova, İzmir'),
(18, 'Ege Üniversitesi Hastanesi', 'Bornova Mahallesi, Bornova, İzmir'),
(19, 'Karadeniz Teknik Üniversitesi Hastanesi', 'Trabzon Merkez, Ortahisar, Trabzon'),
(20, 'Çukurova Üniversitesi Hastanesi', 'Sarıçam Mahallesi, Sarıçam, Adana'),
(21, 'Acıbadem', 'Istanbul'),
(22, 'Akbudak Hospital', 'Diyarbakir'),
(23, 'Princeton Plainsboro Teaching Hospital', 'Princeton');

-- --------------------------------------------------------

--
-- Table structure for table `MedicineDetail`
--

CREATE TABLE `MedicineDetail` (
  `mid` int(11) NOT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `tpd` int(11) DEFAULT NULL,
  `tpu` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MedicineDetail`
--

INSERT INTO `MedicineDetail` (`mid`, `medicine_name`, `dosage`, `quantity`, `tpd`, `tpu`, `note`) VALUES
(1, 'Parol', '500 mg', 20, 3, 1, 'Take after meals'),
(2, 'Augmentin', '1 g', 14, 2, 1, 'Take with water'),
(3, 'Aspirin', '300 mg', 30, 1, 1, 'Take before meals'),
(4, 'Nexium', '40 mg', 28, 1, 1, 'Take on an empty stomach'),
(5, 'Ventolin', '100 mcg', 1, 4, 2, 'Inhale as needed'),
(6, 'Lyrica', '75 mg', 60, 2, 1, 'Take with or without food'),
(7, 'Xanax', '0.5 mg', 60, 2, 1, 'Take with water'),
(8, 'Metformin', '500 mg', 90, 3, 1, 'Take with meals'),
(9, 'Lipitor', '20 mg', 30, 1, 1, 'Take at bedtime'),
(10, 'Amaryl', '2 mg', 30, 1, 1, 'Take with breakfast'),
(11, 'Paracetamol', '1', 10, 3, 1, 'Take after meal'),
(12, 'Paracetamol', '1', 10, 3, 1, 'Take after meal'),
(13, 'Paracetamol', '1', 10, 3, 1, 'Take after meal'),
(14, 'Paracetamol', '1', 10, 3, 1, 'Take after meal'),
(15, 'Parol', '500 mg', 30, 3, 1, 'Take after meals.'),
(16, 'Aferin', '300 mg', 20, 2, 4, 'Tok karnina'),
(17, 'Parasetamol', '400 mg', 3, 2, 2, 'Al'),
(18, 'Nexium', '10 mg', 1, 2, 2, 'içme'),
(19, 'Lyrica', '10 mg', 1, 1, 1, 'iç'),
(20, 'Fitil', '10 mg', 1, 1, 1, 'iç'),
(21, 'fitil', '1 mg', 1, 1, 1, 'iç'),
(22, 'fitil ', '1 mg', 1, 1, 1, 'iç'),
(23, 'Fitil', '1 mg', 1, 1, 1, 'iç'),
(24, 'Fitil', '1 mg', 1, 1, 10, 'lsd'),
(25, 'Fitil', '10 mg', 1, 1, 1, 'iç'),
(26, 'Fitil', '10 mg', 1234, 123, 132, '123'),
(27, 'Fitil', '10 mg', 1, 1, 1, 'iç'),
(28, 'Amoxilin', '400 mg', 3453, 2, 3, 'Take it after meal.');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `patient_id` int(11) NOT NULL,
  `rid` int(11) DEFAULT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`patient_id`, `rid`, `emergency_contact`) VALUES
(1, 1, '05079876543'),
(2, 3, '05071234568'),
(3, 5, '05076543210'),
(4, 7, '05079876542'),
(5, 10, '05076543211'),
(6, 12, '05076543212'),
(7, 14, '05076543213'),
(8, 17, '05076543214'),
(9, 19, '05076543215'),
(10, 22, '05076543216'),
(11, 24, '05076543217'),
(12, 27, '05076543218'),
(13, 29, '05076543219'),
(14, 32, '05076543220'),
(15, 35, '05076543221'),
(16, 38, '05076543222'),
(17, 40, '05076543223'),
(18, 42, '05076543224'),
(19, 44, '05076543225'),
(20, 46, '05076543226'),
(21, 31, NULL),
(22, 50, NULL),
(23, 8, NULL),
(24, 9, NULL),
(25, 54, NULL),
(26, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `rid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `insnumber` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pnumber` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`rid`, `name`, `email`, `gender`, `bdate`, `insnumber`, `address`, `pnumber`, `password`) VALUES
(1, 'test', 'test@gmail.com', 'Male', '1990-05-15', '123456789', 'Atatürk Mahallesi, Kadıköy, İstanbul', '05071234567', 'test'),
(2, 'dtest', 'dtest@gmail.com', 'Male', '1985-09-23', '987654321', 'Çamlık Mahallesi, Ataşehir, İstanbul', '05061234567', 'dtest'),
(3, 'test1', 'test1@gmail.com', 'Female', '1992-11-30', '112233445', 'Bahçelievler Mahallesi, Bahçelievler, Ankara', '05051234567', 'test1'),
(4, 'Fatma Kaya', 'fatma.kaya@example.com', 'Female', '1988-03-21', '556677889', 'Çankaya Mahallesi, Çankaya, Ankara', '05041234567', 'password4'),
(5, 'Ali Can', 'ali.can@example.com', 'Male', '1995-07-12', '443322110', 'Mevlana Mahallesi, Selçuklu, Konya', '05031234567', 'password5'),
(6, 'Emine Aydın', 'emine.aydin@example.com', 'Female', '1980-02-18', '998877665', 'Sarıyer Mahallesi, Sarıyer, İstanbul', '05021234567', 'password6'),
(7, 'Hasan Şahin', 'hasan.sahin@example.com', 'Male', '1987-12-05', '776655443', 'Göztepe Mahallesi, Kadıköy, İstanbul', '05011234567', 'password7'),
(8, 'Elif Yıldız', 'elif.yildiz@example.com', 'Female', '1993-06-27', '665544332', 'Bostancı Mahallesi, Kadıköy, İstanbul', '05081234567', 'password8'),
(9, 'Mustafa Çelik', 'mustafa.celik@example.com', 'Male', '1975-10-14', '554433221', 'Kızılay Mahallesi, Çankaya, Ankara', '05091234567', 'password9'),
(10, 'Zeynep Arslan', 'zeynep.arslan@example.com', 'Female', '1998-04-01', '443322110', 'Cumhuriyet Mahallesi, Küçükçekmece, İstanbul', '05071234568', 'password10'),
(11, 'Ahmet Kılıç', 'ahmet.kilic@example.com', 'Male', '1982-11-10', '334455667', 'Beyazıt Mahallesi, Fatih, İstanbul', '05061234568', 'password11'),
(12, 'Mehmet Uslu', 'mehmet.uslu@example.com', 'Male', '1983-05-23', '223344556', 'Altındağ Mahallesi, Altındağ, Ankara', '05051234568', 'password12'),
(13, 'Ayşe Koç', 'ayse.koc@example.com', 'Female', '1991-07-09', '112233445', 'Kazım Karabekir Mahallesi, Keçiören, Ankara', '05041234568', 'password13'),
(14, 'Fatma Karaca', 'fatma.karaca@example.com', 'Female', '1989-03-05', '556677889', 'Yenişehir Mahallesi, Mersin', '05031234568', 'password14'),
(15, 'Ali Doğan', 'ali.dogan@example.com', 'Male', '1978-12-29', '443322110', 'Gazi Mahallesi, Sincan, Ankara', '05021234568', 'password15'),
(16, 'Emine Tuncel', 'emine.tuncel@example.com', 'Female', '1981-01-17', '998877665', 'Davutpaşa Mahallesi, Esenler, İstanbul', '05011234568', 'password16'),
(17, 'Hasan Acar', 'hasan.acar@example.com', 'Male', '1977-06-25', '776655443', 'Çıksalın Mahallesi, Eyüp, İstanbul', '05081234568', 'password17'),
(18, 'Elif Güler', 'elif.guler@example.com', 'Female', '1996-03-14', '665544332', 'Kızıltoprak Mahallesi, Kadıköy, İstanbul', '05091234568', 'password18'),
(19, 'Mustafa Korkmaz', 'mustafa.korkmaz@example.com', 'Male', '1974-08-30', '554433221', 'Yeşiltepe Mahallesi, Yeşilyurt, Malatya', '05071234569', 'password19'),
(20, 'Zeynep Tekin', 'zeynep.tekin@example.com', 'Female', '1986-09-15', '443322110', 'Ataköy Mahallesi, Bakırköy, İstanbul', '05061234569', 'password20'),
(21, 'Ahmet Polat', 'ahmet.polat@example.com', 'Male', '1973-02-03', '334455667', 'Cevizli Mahallesi, Kartal, İstanbul', '05051234569', 'password21'),
(22, 'Mehmet Demirtaş', 'mehmet.demirtas@example.com', 'Male', '1984-05-27', '223344556', 'Oran Mahallesi, Çankaya, Ankara', '05041234569', 'password22'),
(23, 'Ayşe Gürbüz', 'ayse.gurbuz@example.com', 'Female', '1990-10-20', '112233445', 'Erenköy Mahallesi, Kadıköy, İstanbul', '05031234569', 'password23'),
(24, 'Fatma Kaplan', 'fatma.kaplan@example.com', 'Female', '1985-04-07', '556677889', 'Yenibosna Mahallesi, Bahçelievler, İstanbul', '05021234569', 'password24'),
(25, 'Ali Keskin', 'ali.keskin@example.com', 'Male', '1982-11-11', '443322110', 'Bağcılar Mahallesi, Bağcılar, İstanbul', '05011234569', 'password25'),
(26, 'Emine Yalçın', 'emine.yalcin@example.com', 'Female', '1976-06-19', '998877665', 'Yeşilköy Mahallesi, Bakırköy, İstanbul', '05081234569', 'password26'),
(27, 'Hasan Özkan', 'hasan.ozkan@example.com', 'Male', '1988-08-12', '776655443', 'Kartaltepe Mahallesi, Bayrampaşa, İstanbul', '05091234569', 'password27'),
(28, 'Elif Turan', 'elif.turan@example.com', 'Female', '1994-02-23', '665544332', 'Şirinevler Mahallesi, Bahçelievler, İstanbul', '05071234570', 'password28'),
(29, 'Mustafa Yavuz', 'mustafa.yavuz@example.com', 'Male', '1980-07-04', '554433221', 'Levent Mahallesi, Beşiktaş, İstanbul', '05061234570', 'password29'),
(30, 'Zeynep Çoban', 'zeynep.coban@example.com', 'Female', '1987-09-13', '443322110', 'Moda Mahallesi, Kadıköy, İstanbul', '05051234570', 'password30'),
(31, 'Ahmet Altın', 'ahmet.altin@example.com', 'Male', '1971-01-06', '334455667', 'Kozyatağı Mahallesi, Kadıköy, İstanbul', '05041234570', 'password31'),
(32, 'Mehmet Durmaz', 'mehmet.durmaz@example.com', 'Male', '1989-04-25', '223344556', 'Beylerbeyi Mahallesi, Üsküdar, İstanbul', '05031234570', 'password32'),
(33, 'Ayşe Sezer', 'ayse.sezer@example.com', 'Female', '1992-11-16', '112233445', 'Ata Mahallesi, Konak, İzmir', '05021234570', 'password33'),
(34, 'Fatma Ceylan', 'fatma.ceylan@example.com', 'Female', '1974-03-08', '556677889', 'Mimar Sinan Mahallesi, Üsküdar, İstanbul', '05011234570', 'password34'),
(35, 'Ali Işık', 'ali.isik@example.com', 'Male', '1985-12-19', '443322110', 'Kadıköy Mahallesi, Kadıköy, İstanbul', '05081234570', 'password35'),
(36, 'Emine Pekel', 'emine.pekel@example.com', 'Female', '1979-05-03', '998877665', 'Topkapı Mahallesi, Fatih, İstanbul', '05091234570', 'password36'),
(37, 'Hasan Dinç', 'hasan.dinc@example.com', 'Male', '1983-08-11', '776655443', 'Aksaray Mahallesi, Fatih, İstanbul', '05071234571', 'password37'),
(38, 'Elif Eren', 'elif.eren@example.com', 'Female', '1990-03-15', '665544332', 'Beykoz Mahallesi, Beykoz, İstanbul', '05061234571', 'password38'),
(39, 'Mustafa Güneş', 'mustafa.gunes@example.com', 'Male', '1975-07-22', '554433221', 'Taksim Mahallesi, Beyoğlu, İstanbul', '05051234571', 'password39'),
(40, 'Zeynep Çelik', 'zeynep.celik@example.com', 'Female', '1984-06-17', '443322110', 'Gümüşsuyu Mahallesi, Beyoğlu, İstanbul', '05041234571', 'password40'),
(41, 'Ahmet Ateş', 'ahmet.ates@example.com', 'Male', '1981-11-08', '334455667', 'Cihangir Mahallesi, Beyoğlu, İstanbul', '05031234571', 'password41'),
(42, 'Mehmet Keleş', 'mehmet.keles@example.com', 'Male', '1982-04-12', '223344556', 'Ortaköy Mahallesi, Beşiktaş, İstanbul', '05021234571', 'password42'),
(43, 'Ayşe Özdemir', 'ayse.ozdemir@example.com', 'Female', '1988-08-14', '112233445', 'Yıldız Mahallesi, Beşiktaş, İstanbul', '05011234571', 'password43'),
(44, 'Fatma Bilgin', 'fatma.bilgin@example.com', 'Female', '1977-10-21', '556677889', 'Arnavutköy Mahallesi, Beşiktaş, İstanbul', '05081234571', 'password44'),
(45, 'Ali Karataş', 'ali.karatas@example.com', 'Male', '1986-05-05', '443322110', 'Balat Mahallesi, Fatih, İstanbul', '05091234571', 'password45'),
(46, 'Emine Güngör', 'emine.gungor@example.com', 'Female', '1991-02-27', '998877665', 'Karaköy Mahallesi, Beyoğlu, İstanbul', '05071234572', 'password46'),
(47, 'Hasan Şimşek', 'hasan.simsek@example.com', 'Male', '1984-09-11', '776655443', 'İstinye Mahallesi, Sarıyer, İstanbul', '05061234572', 'password47'),
(48, 'Elif Kurt', 'elif.kurt@example.com', 'Female', '1976-01-04', '665544332', 'Kuruçeşme Mahallesi, Beşiktaş, İstanbul', '05051234572', 'password48'),
(49, 'Mustafa Erdem', 'mustafa.erdem@example.com', 'Male', '1979-07-19', '554433221', 'Harbiye Mahallesi, Şişli, İstanbul', '05041234572', 'password49'),
(50, 'Zeynep Tan', 'zeynep.tan@example.com', 'Female', '1985-12-06', '443322110', 'Beşiktaş Mahallesi, Beşiktaş, İstanbul', '05031234572', 'password50'),
(51, 'John Doe', 'john', 'M', '1990-01-01', '123456789', '324312423', '123456789', '123456789'),
(52, 'John Doe', 'john@gmail.com', 'M', '1990-01-01', '123456', 'New York, NY', '123456789', '123456789'),
(53, 'Doctor Who', 'who@gmail.com', 'M', '1990-01-01', '1234567', 'New York, NY', '123456789', '123456789'),
(54, 'Ilhan Akbudak', 'iakbudak20@ku.edu.tr', 'Male', '1990-01-01', '12345678910', 'University', '05325639017', 'password'),
(55, 'asdf', 'mdeniz20@ku.edu.tr', 'Male', '2024-05-09', '134', '1324', '1234', '1234'),
(56, 'Gregory House', 'ghouse@ppth.us', 'Male', '1990-01-01', 'NA', 'PPTH Hospital Princeton NJ UnitedStates', '999', 'house');

-- --------------------------------------------------------

--
-- Table structure for table `Prescription`
--

CREATE TABLE `Prescription` (
  `prescription_id` int(11) NOT NULL,
  `aid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Prescription`
--

INSERT INTO `Prescription` (`prescription_id`, `aid`) VALUES
(1, 1),
(2, 3),
(3, 5),
(4, 6),
(5, 8),
(6, 10),
(7, 13),
(8, 15),
(9, 17),
(10, 19),
(11, 21),
(12, 23),
(13, 25),
(14, 26),
(15, 28),
(17, 29),
(16, 30),
(18, 45),
(19, 45),
(20, 47),
(23, 50),
(22, 53),
(21, 54),
(24, 55),
(29, 56),
(28, 57),
(25, 58),
(26, 59),
(27, 60),
(30, 61),
(31, 63);

-- --------------------------------------------------------

--
-- Table structure for table `PrescriptionMedicine`
--

CREATE TABLE `PrescriptionMedicine` (
  `prescription_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PrescriptionMedicine`
--

INSERT INTO `PrescriptionMedicine` (`prescription_id`, `mid`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 1),
(11, 2),
(12, 3),
(13, 4),
(14, 5),
(15, 6),
(16, 7),
(17, 11),
(17, 12),
(17, 13),
(17, 14),
(19, 15),
(19, 16),
(20, 17),
(21, 18),
(22, 19),
(23, 20),
(24, 21),
(25, 22),
(26, 23),
(27, 24),
(28, 25),
(29, 26),
(30, 27),
(31, 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `dname` (`dname`,`hospital_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `rid` (`rid`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `Hospital`
--
ALTER TABLE `Hospital`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `MedicineDetail`
--
ALTER TABLE `MedicineDetail`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `PrescriptionMedicine`
--
ALTER TABLE `PrescriptionMedicine`
  ADD PRIMARY KEY (`prescription_id`,`mid`),
  ADD KEY `mid` (`mid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `Patient` (`patient_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `Doctor` (`doctor_id`);

--
-- Constraints for table `Department`
--
ALTER TABLE `Department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `Hospital` (`hospital_id`);

--
-- Constraints for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `Person` (`rid`),
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `Department` (`department_id`);

--
-- Constraints for table `Patient`
--
ALTER TABLE `Patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `Person` (`rid`);

--
-- Constraints for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `Appointment` (`aid`);

--
-- Constraints for table `PrescriptionMedicine`
--
ALTER TABLE `PrescriptionMedicine`
  ADD CONSTRAINT `prescriptionmedicine_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `Prescription` (`prescription_id`),
  ADD CONSTRAINT `prescriptionmedicine_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `MedicineDetail` (`mid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
