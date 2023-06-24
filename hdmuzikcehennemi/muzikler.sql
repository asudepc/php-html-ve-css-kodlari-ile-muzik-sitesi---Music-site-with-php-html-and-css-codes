-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2023, 22:51:22
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
-- Tablo için tablo yapısı `muzikler`
--

CREATE TABLE `muzikler` (
  `muzik_adi` varchar(255) NOT NULL,
  `sanatci` varchar(255) NOT NULL,
  `dosya_yolu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `muzikler`
--

INSERT INTO `muzikler` (`muzik_adi`, `sanatci`, `dosya_yolu`) VALUES
('Dancin', 'Aaron Smith ', 'musics/Aaron Smith - Dancin (KRONO Remix) - Lyrics.mp3'),
('Lovely', 'Billie Eilish', 'musics/Billie Eilish, Khalid - lovely.mp3'),
('Fairytale', 'Alexander Rybak', 'musics/Fairytale.mp3'),
('Another Love', 'Tom Odell', 'musics/Tom Odell - Another Love (Lyrics).mp3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
