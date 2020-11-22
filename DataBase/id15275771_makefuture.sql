-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 17 Lis 2020, 14:05
-- Wersja serwera: 10.3.16-MariaDB
-- Wersja PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `id15275771_makefuture`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE `offers` (
  `offersID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localization` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typeofcontract` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `offerpublication` date DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usersID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `offers`
--

INSERT INTO `offers` (`offersID`, `name`, `company`, `localization`, `typeofcontract`, `offerpublication`, `description`, `usersID`) VALUES
(63, 'Software Tester', 'Live Test', 'Opolskie', 'Contract B2B', '2020-11-12', 'We looking for who ....', 8),
(64, 'Game Developer', 'Game CyberLife', 'Pomorskie', 'Contract of mandate', '2020-11-12', 'We looking for who ....', 8),
(65, 'Programer Andorid', 'Xamarin Company', 'Małopolskie', 'Contract work', '2020-11-12', 'We looking for who ....', 8),
(68, 'IT Programer', 'CyberLife ', 'Łódzkie', 'Contract of employment', '2020-11-16', 'We looking for who ....', 8),
(69, 'Appliacation Mobbile', 'Mobile Life Education', 'Podkarpackie', 'Contract Replacement', '2020-11-16', 'We looking for who ....', 8),
(70, 'Androdi Programmer', 'Programer Over Life', 'Dolnośląskie', 'Contract Replacement', '2020-11-16', 'We looking for who ....', 8),
(71, 'Enginer of Softwer', 'Softwer Our Future', 'Małopolskie', 'Contract of employment', '2020-11-16', 'We looking for who ....', 8),
(72, 'Test Enginer', 'Test Enginer Future', 'Zachodnio-pomorskie', 'Contract B2B', '2020-11-16', 'We looking for who ....', 9),
(73, 'Programer Web Appliaction Full Staff', 'WebMyLife', 'Łódzkie', 'Contract of employment', '2020-11-16', 'We looking for who ....', 9),
(74, 'Windows Form', 'Appliacation My Bissnes', 'Podlaskie', 'Contract of mandate', '2020-11-16', 'We looking for who ....', 9),
(75, 'bartek', 'mhbjkrgfa', 'artret', 'aertar', '2020-11-16', 'aszfdgsh', 10),
(76, 'Tester Website', 'TestAll', 'Lubelskie', 'Contract work', '2020-11-17', 'We looking for who ....', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `usersID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `creationdate` datetime NOT NULL,
  `codeactivate` int(11) NOT NULL,
  `typeofuser` set('recruiter','user') DEFAULT 'user',
  `creationdatecodeactivate` datetime DEFAULT NULL,
  `codeconfirmation` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`usersID`, `username`, `email`, `password`, `creationdate`, `codeactivate`, `typeofuser`, `creationdatecodeactivate`, `codeconfirmation`) VALUES
(8, 'Test2', 'd543f4gg@gmail.com', '123Test2', '2020-10-29 09:58:27', 57858574, 'user', '2020-10-29 09:58:27', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offersID`),
  ADD KEY `usersID` (`usersID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersID`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `offers`
--
ALTER TABLE `offers`
  MODIFY `offersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
