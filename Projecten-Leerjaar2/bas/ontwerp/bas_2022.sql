-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 feb 2026 om 09:16
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas_2022`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `artId` int(11) NOT NULL,
  `artOmschrijving` varchar(100) NOT NULL,
  `artInkoop` decimal(6,2) NOT NULL,
  `artVerkoop` decimal(6,2) NOT NULL,
  `artVoorraad` int(11) NOT NULL,
  `artMinVoorraad` int(11) NOT NULL,
  `artMaxVoorraad` int(11) NOT NULL,
  `artLocatie` int(11) NOT NULL,
  `levId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`, `levId`) VALUES
(1, 'Aardbeienjam', 1.20, 2.49, 12, 10, 100, 5, 1),
(2, 'Pindakaas', 1.10, 2.29, 8, 10, 80, 6, 1),
(3, 'Afwasmiddel', 0.90, 1.99, 25, 5, 60, 12, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporder`
--

CREATE TABLE `inkooporder` (
  `inkOrdId` int(11) NOT NULL,
  `levId` int(11) NOT NULL,
  `artId` int(11) NOT NULL,
  `inkOrdDatum` date NOT NULL,
  `inkOrdBestAantal` int(11) NOT NULL,
  `inkOrdStatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inkooporder`
--

INSERT INTO `inkooporder` (`inkOrdId`, `levId`, `artId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 1, 2, '2026-02-26', 50, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(100) NOT NULL,
  `klantEmail` varchar(100) NOT NULL,
  `klantAdres` varchar(100) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Test 1', 'test1@example.com', 'Straat 1', '3011AA', 'City 1'),
(2, 'Test 2', 'test2@example.com', 'Straat 2', '3011BB', 'City 2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leverancier`
--

CREATE TABLE `leverancier` (
  `levId` int(11) NOT NULL,
  `levNaam` varchar(50) NOT NULL,
  `levContact` varchar(50) DEFAULT NULL,
  `levEmail` varchar(100) NOT NULL,
  `levAdres` varchar(100) DEFAULT NULL,
  `levPostcode` varchar(6) DEFAULT NULL,
  `levWoonplaats` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leverancier`
--

INSERT INTO `leverancier` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'JamCo', 'S. de Vries', 'sales@jamco.nl', 'Jamstraat 1', '3011AA', 'Rotterdam'),
(2, 'CleanPro', 'A. Jansen', 'info@cleanpro.nl', 'Zeepweg 12', '3063BB', 'Rotterdam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkooporder`
--

CREATE TABLE `verkooporder` (
  `verkOrdId` int(11) NOT NULL,
  `klantId` int(11) NOT NULL,
  `artId` int(11) NOT NULL,
  `verkOrdDatum` date NOT NULL,
  `verkOrdBestAantal` int(11) NOT NULL,
  `verkOrdStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verkooporder`
--

INSERT INTO `verkooporder` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(1, 1, 1, '2026-02-26', 2, 1),
(2, 2, 2, '2026-02-26', 1, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artId`),
  ADD KEY `levId` (`levId`);

--
-- Indexen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD PRIMARY KEY (`inkOrdId`),
  ADD KEY `levId` (`levId`),
  ADD KEY `artId` (`artId`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `leverancier`
--
ALTER TABLE `leverancier`
  ADD PRIMARY KEY (`levId`);

--
-- Indexen voor tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD PRIMARY KEY (`verkOrdId`),
  ADD KEY `klantId` (`klantId`),
  ADD KEY `artId` (`artId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  MODIFY `inkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `leverancier`
--
ALTER TABLE `leverancier`
  MODIFY `levId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  MODIFY `verkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`levId`) REFERENCES `leverancier` (`levId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD CONSTRAINT `inkooporder_ibfk_1` FOREIGN KEY (`levId`) REFERENCES `leverancier` (`levId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inkooporder_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD CONSTRAINT `verkooporder_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klant` (`klantId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `verkooporder_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
