-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Haz 2023, 13:12:18
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `muzik_veritabani`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_tablosu`
--

CREATE TABLE `kullanici_tablosu` (
  `kullanici_adi` text DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `sifre` text NOT NULL,
  `kayit_tarihi` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici_tablosu`
--

INSERT INTO `kullanici_tablosu` (`kullanici_adi`, `email`, `sifre`, `kayit_tarihi`) VALUES
('leyla', NULL, '$2y$10$UHyzEmYPyyI31qk64o03t.UuhoLAVpCeipXCmrP/WUCjbV3ej7/wu', '2023-06-12 21:00:00'),
('skeleton', NULL, '$2y$10$5gLNEsfF4XBoBfnF6lpmuOi5wMdF8IiUMfQQqhXou7GHB6UnOllg2', '2023-06-13 01:13:00'),
('serhat', NULL, '$2y$10$rxhMBMcZNz5BrtkUxWAbKeJYl7hVDp282IKPEPIN3iuHexIVEgmYy', '2023-06-13 01:15:00'),
('kapi', NULL, '$2y$10$gN0vQ2n6cU8Lj0qk1H6sKuNrVRBOlEqC/BMT1ve0ZH8JtMUpbiLc.', '2023-06-13 02:16:00'),
('root', NULL, '$2y$10$dLZszr7nenDXl.hzuEHCfeOyehDg3zs274kFvt4Xk3ec4sThMfqO2', '2023-06-22 23:03:00'),
('fefere', NULL, '$2y$10$XBDpWnuuvQvBSJiKb.0SSe/jtZLed7Fgpj06/dcqsKVvV.6HoZHo6', '2023-06-22 23:27:00'),
('erta', NULL, '$2y$10$y1LVjXPRTmrmqs/6zgADHuq2r7Jvd8tcjQQ8X/YEs.3B7vPJKoAxO', '2023-06-23 00:30:00'),
('efe', NULL, '$2y$10$rkfJiJ1.2D7xkOJXi0/b2uaEqbzf/4o9Pmig3J0qYdawEMPx77m.2', '2023-06-23 08:32:00'),
('fer', NULL, '$2y$10$E4wNFJGwdOueTuHQTsmToOSYzzoqkfSGiOTuzk3k2.NdZvofmkfu.', '2023-06-23 10:04:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `muzikler`
--

CREATE TABLE `muzikler` (
  `muzik_adi` varchar(255) NOT NULL,
  `sanatci` varchar(255) NOT NULL,
  `dosya_yolu` varchar(255) NOT NULL,
  `ekleyen_kullanici` varchar(255) NOT NULL,
  `eklenme_tarihi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `muzikler`
--

INSERT INTO `muzikler` (`muzik_adi`, `sanatci`, `dosya_yolu`, `ekleyen_kullanici`, `eklenme_tarihi`) VALUES
('Dancin', 'Aaron Smith ', 'musics/Aaron Smith - Dancin (KRONO Remix) - Lyrics.mp3', '', NULL),
('Lovely', 'Billie Eilish', 'musics/Billie Eilish, Khalid - lovely.mp3', '', NULL),
('Fairytale', 'Alexander Rybak', 'musics/Fairytale.mp3', '', NULL),
('Another Love', 'Tom Odell', 'musics/Tom Odell - Another Love (Lyrics).mp3', '', NULL),
('ed', 'edfe', 'musics/music.mp3', '', NULL),
('Another Love', 'Tom Odell', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', '', NULL),
('Another', 'Sadas', 'muzikler/Fairytale.mp3', 'root', '2023-06-20 00:00:00'),
('an', 'dsfsd', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'root', '2023-06-20 00:00:00'),
('dsfds', 'dsfsd', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'root', '2023-06-20 00:00:00'),
('dsfds', 'dsfsd', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'root', '2023-06-21 00:00:00'),
('dsfds', 'dsfsd', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'root', '2023-06-21 00:00:00'),
('efwe', 'wefw', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'root', '2023-06-21 00:00:00'),
('sargh', 'sasfdr', 'muzikler/Billie Eilish, Khalid - lovely.mp3', 'root', '2023-06-21 00:00:00'),
('dsfsd', 'dsfsd', 'muzikler/Fairytale.mp3', '', '2023-06-21 00:00:00'),
('ewfwe', 'ewfwe', 'muzikler/Fairytale.mp3', 'ece', '2023-06-21 00:00:00'),
('dsfsdf', 'dfs', 'muzikler/Billie Eilish, Khalid - lovely.mp3', 'ece', '2023-06-21 00:58:05'),
('Another Love', 'sdsadf', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'ece', '2023-06-21 01:10:08'),
('Kuzu Kuzu', 'Tarkan', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'ece', '2023-06-23 04:33:34'),
('Bodrum', 'Hakan', 'muzikler/Tom Odell - Another Love (Lyrics).mp3', 'efe', '2023-06-23 12:33:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
