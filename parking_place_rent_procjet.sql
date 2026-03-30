-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 07:27 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garaz_baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admini`
--

CREATE TABLE `admini` (
  `id_admina` int(11) NOT NULL,
  `imie` varchar(20) DEFAULT NULL,
  `nazwisko` varchar(30) DEFAULT NULL,
  `numer_telefonu` varchar(11) DEFAULT NULL,
  `stanowisko` varchar(30) DEFAULT NULL,
  `mail_pracowniczy` varchar(40) NOT NULL,
  `haslo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admini`
--

INSERT INTO `admini` (`id_admina`, `imie`, `nazwisko`, `numer_telefonu`, `stanowisko`, `mail_pracowniczy`, `haslo`) VALUES
(1, 'Jan', 'Kowalski', '12345678901', 'konsultant', 'jan.kowalski@garazex.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'Jan', 'Nowak', '11232135', 'admin', 'admin@garazex.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `numer_telefonu` int(11) NOT NULL,
  `haslo` varchar(100) NOT NULL,
  `id_pracownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `imie`, `nazwisko`, `email`, `numer_telefonu`, `haslo`, `id_pracownika`) VALUES
(3, 'Jan', 'Kowalski', 'jan.kowalski@example.com', 123456789, '', 1),
(4, 'Kamil', 'Reczka', 'romka@wp.pl', 2524547, '3cd969896e49a6d3326acf33f0c2d8cc38b0d06a', NULL),
(5, 'Kamil', 'Adrianowicz', 'adrian@interia.pl', 2524547, '69dd0d17085451edc7a356c689407429fc6cea46', NULL),
(6, 'wuja', 'kaminska', 'kar@wp.pl', 14154654, '23d202fb561c67ac5d22ae22f0e595ed35106b02', NULL),
(7, 'Kamilek', 'Muszynski', 'muszynskijan@wp.pl', 1253456478, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(8, 'tescik', 'testowicz', 'test@test.pl', 123456123, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(10, 'test', 'tescik', 'test@wp.pl', 3534256, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(11, 'Jewgienii', 'Andreas', 'jew@uk.ua', 352552343, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(13, 'John', 'Example', 'johnexample@example.com', 123456789, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `konsultanci`
-- (See below for the actual view)
--
CREATE TABLE `konsultanci` (
`id_pracownika` int(11)
,`imie` varchar(20)
,`nazwisko` varchar(30)
,`e_mail` varchar(50)
,`numer_telefonu` int(11)
,`stanowisko` varchar(30)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejsca`
--

CREATE TABLE `miejsca` (
  `numer_miejsca` int(11) NOT NULL,
  `pietro` enum('1','2','3') NOT NULL,
  `rozmiar` enum('2.5 X 5','3.5 X 5','3 X 6.5','1.6 X 3.5') NOT NULL,
  `format` enum('jednopojazdowe','dwupojazdowe') NOT NULL,
  `cena_za_miesiac` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `miejsca`
--

INSERT INTO `miejsca` (`numer_miejsca`, `pietro`, `rozmiar`, `format`, `cena_za_miesiac`) VALUES
(1, '1', '2.5 X 5', 'jednopojazdowe', 150),
(2, '1', '2.5 X 5', 'jednopojazdowe', 150),
(3, '1', '2.5 X 5', 'jednopojazdowe', 150),
(4, '1', '3.5 X 5', 'jednopojazdowe', 200),
(5, '1', '3.5 X 5', 'jednopojazdowe', 200),
(6, '1', '3 X 6.5', 'jednopojazdowe', 250),
(7, '1', '3 X 6.5', 'jednopojazdowe', 250),
(8, '1', '1.6 X 3.5', 'jednopojazdowe', 100),
(9, '1', '1.6 X 3.5', 'jednopojazdowe', 100),
(10, '1', '2.5 X 5', 'dwupojazdowe', 300),
(11, '1', '2.5 X 5', 'dwupojazdowe', 300),
(12, '1', '3.5 X 5', 'dwupojazdowe', 400),
(13, '1', '3.5 X 5', 'dwupojazdowe', 400),
(14, '1', '3 X 6.5', 'dwupojazdowe', 500),
(15, '1', '3 X 6.5', 'dwupojazdowe', 500),
(16, '1', '1.6 X 3.5', 'dwupojazdowe', 200),
(101, '1', '2.5 X 5', 'jednopojazdowe', 150),
(102, '2', '3 X 6.5', 'dwupojazdowe', 200),
(103, '2', '2.5 X 5', 'jednopojazdowe', 150),
(104, '2', '3.5 X 5', 'jednopojazdowe', 200),
(105, '2', '3.5 X 5', 'jednopojazdowe', 200),
(106, '2', '3 X 6.5', 'jednopojazdowe', 250),
(107, '2', '3 X 6.5', 'jednopojazdowe', 250),
(108, '2', '1.6 X 3.5', 'jednopojazdowe', 100),
(109, '2', '1.6 X 3.5', 'jednopojazdowe', 100),
(110, '2', '2.5 X 5', 'dwupojazdowe', 300),
(111, '2', '2.5 X 5', 'dwupojazdowe', 300),
(112, '2', '3.5 X 5', 'dwupojazdowe', 400),
(113, '2', '3.5 X 5', 'dwupojazdowe', 400),
(114, '2', '3 X 6.5', 'dwupojazdowe', 500),
(115, '2', '3 X 6.5', 'dwupojazdowe', 500),
(116, '2', '1.6 X 3.5', 'dwupojazdowe', 200),
(201, '3', '2.5 X 5', 'jednopojazdowe', 150),
(202, '3', '2.5 X 5', 'jednopojazdowe', 150),
(203, '3', '2.5 X 5', 'jednopojazdowe', 150),
(204, '3', '3.5 X 5', 'jednopojazdowe', 200),
(205, '3', '3.5 X 5', 'jednopojazdowe', 200),
(206, '3', '3 X 6.5', 'jednopojazdowe', 250),
(207, '3', '3 X 6.5', 'jednopojazdowe', 250),
(208, '3', '1.6 X 3.5', 'jednopojazdowe', 100),
(209, '3', '1.6 X 3.5', 'jednopojazdowe', 100),
(210, '3', '2.5 X 5', 'dwupojazdowe', 300),
(211, '3', '2.5 X 5', 'dwupojazdowe', 300),
(212, '3', '3.5 X 5', 'dwupojazdowe', 400),
(213, '3', '3.5 X 5', 'dwupojazdowe', 400),
(214, '3', '3 X 6.5', 'dwupojazdowe', 500),
(215, '3', '3 X 6.5', 'dwupojazdowe', 500),
(216, '3', '1.6 X 3.5', 'dwupojazdowe', 200);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platnosci`
--

CREATE TABLE `platnosci` (
  `id_platnosci` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `data_wplaty` date NOT NULL,
  `kwota_platnosci` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platnosci`
--

INSERT INTO `platnosci` (`id_platnosci`, `id_klienta`, `data_wplaty`, `kwota_platnosci`) VALUES
(3, 7, '2025-03-29', 100),
(4, 7, '2025-03-29', 100),
(5, 7, '2025-03-29', 59),
(6, 7, '2025-03-29', 3),
(7, 8, '2025-03-29', 100),
(8, 11, '2025-03-29', 150),
(9, 11, '2025-03-29', 1),
(10, 11, '2025-03-29', 1),
(11, 11, '2025-03-29', 1),
(12, 11, '2025-03-29', 2),
(13, 11, '2025-03-29', 3),
(14, 11, '2025-03-29', 1),
(15, 11, '2025-03-29', 1),
(16, 11, '2025-03-29', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `numer_telefonu` int(11) NOT NULL,
  `stanowisko` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownika`, `imie`, `nazwisko`, `e_mail`, `numer_telefonu`, `stanowisko`) VALUES
(1, 'Marek', 'Zieliński', 'marek.zielinski@example.com', 555666777, 'Kierownik'),
(2, 'Ewa', 'Dąbrowska', 'ewa.dabrowska@example.com', 444333222, 'Recepcjonistka');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `przelewy`
-- (See below for the actual view)
--
CREATE TABLE `przelewy` (
`id_klienta` int(11)
,`przychody` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `saldo_klientow`
-- (See below for the actual view)
--
CREATE TABLE `saldo_klientow` (
`id_klienta` int(11)
,`dlug` decimal(34,0)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uslugi`
--

CREATE TABLE `uslugi` (
  `id_uslugi` int(11) NOT NULL,
  `nazwa_uslugi` varchar(11) NOT NULL,
  `cena_uslugi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uslugi`
--

INSERT INTO `uslugi` (`id_uslugi`, `nazwa_uslugi`, `cena_uslugi`) VALUES
(1, 'Mycie samoc', 50),
(2, 'dezynfekcja', 100),
(3, 'Mycie podło', 150),
(4, 'Czyszczenie', 100),
(5, 'Usuwanie ol', 200),
(6, 'Czyszczenie', 180);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `wolne_miejsca`
-- (See below for the actual view)
--
CREATE TABLE `wolne_miejsca` (
`numer_miejsca` int(11)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `wykupione_uslugi`
-- (See below for the actual view)
--
CREATE TABLE `wykupione_uslugi` (
`id_klienta` int(11)
,`wykupione_u` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynajem`
--

CREATE TABLE `wynajem` (
  `id_wynajmu` int(11) NOT NULL,
  `data_rozpoczecia` date NOT NULL,
  `data_zakonczenia` date NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `numer_miejsca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wynajem`
--

INSERT INTO `wynajem` (`id_wynajmu`, `data_rozpoczecia`, `data_zakonczenia`, `id_klienta`, `numer_miejsca`) VALUES
(3, '2025-02-26', '2025-03-06', 3, 101),
(4, '2025-03-12', '2025-06-26', 3, 101),
(5, '2025-03-28', '2025-04-04', 7, 1),
(6, '2025-03-28', '2025-04-02', 7, 102),
(7, '2025-03-29', '2025-04-05', 7, 4),
(8, '2025-03-27', '2025-04-03', 7, 3),
(9, '2025-03-28', '2025-04-12', 8, 10),
(10, '2025-03-20', '2025-04-05', 8, 11),
(12, '2025-03-28', '2025-04-01', 11, 205),
(14, '2026-03-23', '2026-03-31', 13, 1);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `zajete_miejsca`
-- (See below for the actual view)
--
CREATE TABLE `zajete_miejsca` (
`numer_miejsca` int(11)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zakupione_uslugi`
--

CREATE TABLE `zakupione_uslugi` (
  `id_zakupionych_uslug` int(11) NOT NULL,
  `id_uslugi` int(11) NOT NULL,
  `numer_miejsca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zakupione_uslugi`
--

INSERT INTO `zakupione_uslugi` (`id_zakupionych_uslug`, `id_uslugi`, `numer_miejsca`) VALUES
(6, 1, 1),
(9, 1, 4),
(12, 1, 11),
(1, 1, 101),
(3, 1, 102),
(7, 1, 102),
(17, 2, 10),
(13, 2, 11),
(18, 2, 13),
(2, 2, 102),
(4, 2, 102),
(8, 2, 102),
(21, 2, 216),
(22, 3, 216),
(10, 4, 10),
(14, 4, 10),
(19, 4, 205),
(11, 5, 10),
(20, 5, 205),
(15, 6, 10),
(16, 6, 11);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `zobowiazania_klientow`
-- (See below for the actual view)
--
CREATE TABLE `zobowiazania_klientow` (
`id_klienta` int(11)
,`naleznosc` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Struktura widoku `konsultanci`
--
DROP TABLE IF EXISTS `konsultanci`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pawel-nieweglowski_garaz_baza`@`%` SQL SECURITY DEFINER VIEW `konsultanci`  AS SELECT `pracownicy`.`id_pracownika` AS `id_pracownika`, `pracownicy`.`imie` AS `imie`, `pracownicy`.`nazwisko` AS `nazwisko`, `pracownicy`.`e_mail` AS `e_mail`, `pracownicy`.`numer_telefonu` AS `numer_telefonu`, `pracownicy`.`stanowisko` AS `stanowisko` FROM `pracownicy` WHERE `pracownicy`.`stanowisko` = 'konsultant' ;

-- --------------------------------------------------------

--
-- Struktura widoku `przelewy`
--
DROP TABLE IF EXISTS `przelewy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `przelewy`  AS SELECT `platnosci`.`id_klienta` AS `id_klienta`, sum(`platnosci`.`kwota_platnosci`) AS `przychody` FROM `platnosci` GROUP BY `platnosci`.`id_klienta` ;

-- --------------------------------------------------------

--
-- Struktura widoku `saldo_klientow`
--
DROP TABLE IF EXISTS `saldo_klientow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `saldo_klientow`  AS SELECT `zobowiazania_klientow`.`id_klienta` AS `id_klienta`, `zobowiazania_klientow`.`naleznosc`- ifnull(`przelewy`.`przychody`,0) AS `dlug` FROM (`zobowiazania_klientow` left join `przelewy` on(`przelewy`.`id_klienta` = `zobowiazania_klientow`.`id_klienta`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `wolne_miejsca`
--
DROP TABLE IF EXISTS `wolne_miejsca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pawel-nieweglowski_garaz_baza`@`%` SQL SECURITY DEFINER VIEW `wolne_miejsca`  AS SELECT `miejsca`.`numer_miejsca` AS `numer_miejsca` FROM (`miejsca` left join `zajete_miejsca` on(`miejsca`.`numer_miejsca` = `zajete_miejsca`.`numer_miejsca`)) WHERE `zajete_miejsca`.`numer_miejsca` is null ;

-- --------------------------------------------------------

--
-- Struktura widoku `wykupione_uslugi`
--
DROP TABLE IF EXISTS `wykupione_uslugi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wykupione_uslugi`  AS SELECT `wynajem`.`id_klienta` AS `id_klienta`, sum(`uslugi`.`cena_uslugi`) AS `wykupione_u` FROM ((((`miejsca` join `zakupione_uslugi` on(`zakupione_uslugi`.`numer_miejsca` = `miejsca`.`numer_miejsca`)) join `uslugi` on(`uslugi`.`id_uslugi` = `zakupione_uslugi`.`id_uslugi`)) join `wynajem` on(`miejsca`.`numer_miejsca` = `wynajem`.`numer_miejsca`)) join `klienci` on(`klienci`.`id_klienta` = `wynajem`.`id_klienta`)) GROUP BY `wynajem`.`id_klienta` ;

-- --------------------------------------------------------

--
-- Struktura widoku `zajete_miejsca`
--
DROP TABLE IF EXISTS `zajete_miejsca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pawel-nieweglowski_garaz_baza`@`%` SQL SECURITY DEFINER VIEW `zajete_miejsca`  AS SELECT `wynajem`.`numer_miejsca` AS `numer_miejsca` FROM `wynajem` WHERE current_timestamp() between `wynajem`.`data_rozpoczecia` and `wynajem`.`data_zakonczenia` ;

-- --------------------------------------------------------

--
-- Struktura widoku `zobowiazania_klientow`
--
DROP TABLE IF EXISTS `zobowiazania_klientow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `zobowiazania_klientow`  AS SELECT `wynajem`.`id_klienta` AS `id_klienta`, `wykupione_uslugi`.`wykupione_u`+ `miejsca`.`cena_za_miesiac` * timestampdiff(MONTH,`wynajem`.`data_rozpoczecia`,`wynajem`.`data_zakonczenia`) AS `naleznosc` FROM ((`wynajem` join `miejsca` on(`wynajem`.`numer_miejsca` = `miejsca`.`numer_miejsca`)) join `wykupione_uslugi` on(`wykupione_uslugi`.`id_klienta` = `wynajem`.`id_klienta`)) GROUP BY `wynajem`.`id_klienta` ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id_admina`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`),
  ADD KEY `fk_k_p` (`id_pracownika`);

--
-- Indeksy dla tabeli `miejsca`
--
ALTER TABLE `miejsca`
  ADD PRIMARY KEY (`numer_miejsca`);

--
-- Indeksy dla tabeli `platnosci`
--
ALTER TABLE `platnosci`
  ADD PRIMARY KEY (`id_platnosci`),
  ADD KEY `id_klienta` (`id_klienta`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id_pracownika`);

--
-- Indeksy dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id_uslugi`);

--
-- Indeksy dla tabeli `wynajem`
--
ALTER TABLE `wynajem`
  ADD PRIMARY KEY (`id_wynajmu`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `numer_miejsca` (`numer_miejsca`);

--
-- Indeksy dla tabeli `zakupione_uslugi`
--
ALTER TABLE `zakupione_uslugi`
  ADD PRIMARY KEY (`id_zakupionych_uslug`),
  ADD KEY `id_uslugi` (`id_uslugi`,`numer_miejsca`),
  ADD KEY `numer_miejsca` (`numer_miejsca`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admini`
--
ALTER TABLE `admini`
  MODIFY `id_admina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `miejsca`
--
ALTER TABLE `miejsca`
  MODIFY `numer_miejsca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `platnosci`
--
ALTER TABLE `platnosci`
  MODIFY `id_platnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id_uslugi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wynajem`
--
ALTER TABLE `wynajem`
  MODIFY `id_wynajmu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `zakupione_uslugi`
--
ALTER TABLE `zakupione_uslugi`
  MODIFY `id_zakupionych_uslug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klienci`
--
ALTER TABLE `klienci`
  ADD CONSTRAINT `fk_k_p` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id_pracownika`);

--
-- Constraints for table `platnosci`
--
ALTER TABLE `platnosci`
  ADD CONSTRAINT `platnosci_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id_klienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wynajem`
--
ALTER TABLE `wynajem`
  ADD CONSTRAINT `wynajem_ibfk_1` FOREIGN KEY (`numer_miejsca`) REFERENCES `miejsca` (`numer_miejsca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wynajem_ibfk_2` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id_klienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zakupione_uslugi`
--
ALTER TABLE `zakupione_uslugi`
  ADD CONSTRAINT `zakupione_uslugi_ibfk_1` FOREIGN KEY (`id_uslugi`) REFERENCES `uslugi` (`id_uslugi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zakupione_uslugi_ibfk_2` FOREIGN KEY (`numer_miejsca`) REFERENCES `miejsca` (`numer_miejsca`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
