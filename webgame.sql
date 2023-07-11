-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 11, 2023 at 03:49 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgame`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `wood` int(11) NOT NULL,
  `stone` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `premiumdays` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `wood`, `stone`, `gold`, `premiumdays`) VALUES
(1, 'Adam', '$2y$10$LjWUMuISy17ez1mUboUuLuMJZqtvapnU97/1FzdmePmky7.OrSquK', 'adam@gmail.com', 213, 5675, 342, '2023-07-09 15:03:28'),
(24, 'Andrew', '$2y$10$1yZ4fR//rPHEAudS91WCbOvQ8fVxpuIrp5UhtJmJVo1bOvwtPpq0u', 'andy@gmail.com', 100, 100, 100, '2023-07-25 15:21:00'),
(23, 'John', '$2y$10$f03OcW4oIPVlff2kT/q9EOZMynuI5t0bOcuNcYZzIaElTVdnUWyka', 'lock@gmail.com', 100, 100, 100, '2023-07-25 14:22:16'),
(22, 'Tomas', '$2y$10$Y96XWqsL7Fljzueb75lABukfcJj2KAxVfM4n8xp9wXWPmKAxONSMC', 'tomas@gmail.com', 100, 100, 100, '2023-07-25 14:13:52');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
