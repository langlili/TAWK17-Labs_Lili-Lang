-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 14 feb 2019 kl 11:48
-- Serverversion: 10.1.26-MariaDB
-- PHP-version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `redoinglabs`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `authors`
--

CREATE TABLE `authors` (
  `ID` int(11) NOT NULL,
  `F_name` varchar(20) NOT NULL,
  `L_name` varchar(20) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `authors`
--

INSERT INTO `authors` (`ID`, `F_name`, `L_name`, `dob`) VALUES
(1, 'Diana', 'Gabaldon', '1946-03-23'),
(2, 'Johan', 'Cheval', '1960-08-01'),
(3, 'Maia', 'Kilenja', '1982-11-09'),
(4, 'John', 'Dawson', '1973-01-22'),
(5, 'Kalle', 'Ivarsson', '1950-09-30'),
(6, 'Ashton', 'Grunerwald', '1989-04-14');

-- --------------------------------------------------------

--
-- Tabellstruktur `books`
--

CREATE TABLE `books` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `No_pages` int(11) NOT NULL,
  `Ed_nr` int(11) NOT NULL,
  `Pub_year` int(4) NOT NULL,
  `Pub_name` varchar(50) NOT NULL,
  `onloan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `books`
--

INSERT INTO `books` (`id`, `title`, `No_pages`, `Ed_nr`, `Pub_year`, `Pub_name`, `onloan`) VALUES
(1, 'Outlander', 798, 2, 1999, 'Bonnier', 0),
(2, 'Vita Vaggan', 199, 1, 1982, 'Perseus Book Group', 0),
(3, 'Far From The Sky', 499, 3, 2009, 'Penguin Random House', 0),
(4, 'Science of Screams', 300, 2, 2002, 'Pearson Ltd', 0),
(6, 'Figure of Speech', 432, 2, 2011, 'Cambridge University Press', 0),
(14, 'Article About Stuff', 56, 1, 1999, 'Research Center Corp.', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `book_author`
--

CREATE TABLE `book_author` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `book_author`
--

INSERT INTO `book_author` (`id`, `book_id`, `author_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(17, 14, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `userpass` varchar(250) NOT NULL,
  `administrator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `userpass`, `administrator`) VALUES
(4, 'admin', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1),
(5, 'lili', 'b9bc0e22d8c17cfe2f85edc4143923f0a2fd7cb0', 0),
(6, 'mod', '4eae83bfe743f7e25f3f52b5b861755c7c14304a', 0),
(7, 'test', 'b444ac06613fc8d63795be9ad0beaf55011936ac', 0),
(8, 'test2', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', 1),
(9, 'test3', '3ebfa301dc59196f18593c45e519287a23297589', 0),
(10, 'test4', '1ff2b3704aede04eecb51e50ca698efd50a1379b', 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`) USING BTREE,
  ADD KEY `author_id` (`author_id`) USING BTREE;

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `authors`
--
ALTER TABLE `authors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT för tabell `books`
--
ALTER TABLE `books`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT för tabell `book_author`
--
ALTER TABLE `book_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`ID`),
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
