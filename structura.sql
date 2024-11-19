-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: nov. 19, 2024 la 07:43 AM
-- Versiune server: 5.7.31
-- Versiune PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `cabinet`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `boli`
--

DROP TABLE IF EXISTS `boli`;
CREATE TABLE IF NOT EXISTS `boli` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` int(11) NOT NULL,
  `CodDiagnostic` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `DenumireCodDiagnostic` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Afectiunea` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Aparatul` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `DStart` date DEFAULT NULL,
  `DStop` date DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `clasificare`
--

DROP TABLE IF EXISTS `clasificare`;
CREATE TABLE IF NOT EXISTS `clasificare` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `CodDiagnostic` int(5) DEFAULT NULL,
  `DenumireCodDiagnostic` varchar(200) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Aparatul` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `concedii`
--

DROP TABLE IF EXISTS `concedii`;
CREATE TABLE IF NOT EXISTS `concedii` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` int(11) NOT NULL,
  `NPren` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `CodDiagnostic` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Afectiune` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Aparat` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `TipConcediu` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `DStart` date DEFAULT NULL,
  `DStop` date DEFAULT NULL,
  `Zile` int(4) DEFAULT NULL,
  `Varsta` int(3) DEFAULT NULL,
  `Luna` varchar(2) COLLATE utf8_romanian_ci DEFAULT NULL,
  `An` int(4) DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `fise`
--

DROP TABLE IF EXISTS `fise`;
CREATE TABLE IF NOT EXISTS `fise` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Cal_medicament` tinyint(1) DEFAULT NULL,
  `Angajare` tinyint(1) DEFAULT NULL,
  `Control_medical` tinyint(1) DEFAULT NULL,
  `Adaptare` tinyint(1) DEFAULT NULL,
  `Reluarea_muncii` tinyint(1) DEFAULT NULL,
  `Supraveghere` tinyint(1) DEFAULT NULL,
  `Altele` tinyint(1) DEFAULT NULL,
  `Nr_fisa` int(11) DEFAULT NULL,
  `An_fisa` int(4) DEFAULT NULL,
  `Marca` int(11) DEFAULT NULL,
  `Nume` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Prenume` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `CNP` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Functia` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Loc_munca` varchar(300) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Tip_aviz_medical` int(5) DEFAULT NULL,
  `R_inaltime` varchar(2) COLLATE utf8_romanian_ci DEFAULT NULL,
  `R_noapte` varchar(2) COLLATE utf8_romanian_ci DEFAULT NULL,
  `R_auto` varchar(2) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Alte_recomandari` varchar(1000) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Data_fisa` date DEFAULT NULL,
  `Medic_mm` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Data_urm_examen` date DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `modificarisalariati`
--

DROP TABLE IF EXISTS `modificarisalariati`;
CREATE TABLE IF NOT EXISTS `modificarisalariati` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` int(11) NOT NULL,
  `NPren` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Func` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `SitCIM` varchar(200) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Rezolvat` varchar(1) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S1` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S2` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S3` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S4` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S5` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S6` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S7` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S8` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S9` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S10` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S11` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S12` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `SalariatNou` int(1) DEFAULT NULL,
  `DataSalvare` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `salariati`
--

DROP TABLE IF EXISTS `salariati`;
CREATE TABLE IF NOT EXISTS `salariati` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` int(11) NOT NULL,
  `NPren` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
  `CNP` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `DNastere` varchar(30) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Sex` varchar(1) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Func` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `SitCIM` varchar(200) COLLATE utf8_romanian_ci DEFAULT NULL,
  `FlotaLung` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `TelPersonal` varchar(20) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Jud` varchar(50) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S1` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S2` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S3` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S4` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S5` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S6` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S7` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S8` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S9` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S10` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S11` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `S12` varchar(150) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Nume` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Prenume` varchar(100) COLLATE utf8_romanian_ci DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `urgente`
--

DROP TABLE IF EXISTS `urgente`;
CREATE TABLE IF NOT EXISTS `urgente` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` int(11) NOT NULL,
  `Ambulanta` varchar(200) COLLATE utf8_romanian_ci DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Ora` time DEFAULT NULL,
  `Observatii` varchar(1000) COLLATE utf8_romanian_ci DEFAULT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `utilizatoridrepturi`
--

DROP TABLE IF EXISTS `utilizatoridrepturi`;
CREATE TABLE IF NOT EXISTS `utilizatoridrepturi` (
  `Cheie` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` int(11) NOT NULL,
  `NPren` varchar(100) CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  `DenumirePg` varchar(100) CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  PRIMARY KEY (`Cheie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
