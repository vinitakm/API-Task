-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2019 at 01:08 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.3.3-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anapioficeandfire`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `url` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `authors` varchar(180) NOT NULL,
  `numberOfPages` int(50) NOT NULL,
  `publiser` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `mediaType` varchar(200) NOT NULL,
  `released` date NOT NULL,
  `characters` varchar(500) NOT NULL,
  `povCharacters` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `url`, `name`, `isbn`, `authors`, `numberOfPages`, `publiser`, `country`, `mediaType`, `released`, `characters`, `povCharacters`) VALUES
(1, '', 'A Game of Thrones', '978-0553103540', 'George R. R. Martin', 694, 'Bantam Books', 'United States', '', '2018-08-01', '', ''),
(2, '', 'My First Book', '123-3213243567', 'John Doe', 350, 'Acme Books', 'United States', '', '2019-08-01', '', ''),
(3, '', 'A Clash of Kings', '978-0553108033', 'George R. R. Martin', 768, 'Bantam Books', 'United States', 'Hardcover', '1999-02-02', 'https://www.anapioficeandfire.com/api/characters/2', 'https://www.anapioficeandfire.com/api/characters/148');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
