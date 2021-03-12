-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2021 at 01:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `nb_Donation` double NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `id_organisaton` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `photo`, `Description`, `nb_Donation`, `date`, `id_organisaton`) VALUES
(1, 'Appel aux dons pour creuser des puits dans les zones rurales du grand atlas', 'uploads/annonce.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. \r\nPlaceat dolorum odio sed quos provident nihil aliquid commodi beatae cum obcaecati facere tempora sapiente expedita deserunt, \r\nitaque voluptatem minima amet. Molestiae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet error eaque voluptates voluptatibus, ducimus saepe incidunt officia odio enim voluptate corporis. Reprehenderit laudantium quaerat, beatae nobis ex, recusandae facilis sit hic corrupti temporibus perspiciatis at quam error corporis architecto accusamus iusto voluptates molestias ea animi obcaecati dolorum maxime quasi soluta! Et dolore facere deserunt asperiores veniam molestias magnam consequatur! Fuga excepturi, \r\nlaudantium fugit voluptatem praesentium repellendus rerum nihil sed illum voluptatum suscipit veniam eius dolores nesciunt voluptates quaerat magni cum.\r\n', 0, '2021-02-21 00:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id_events` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `login`, `email`, `password`, `verified`) VALUES
(1, 'Afoulki', 'Afoulki@contact.com', '$2y$10$5uG2zopeEyVBB4r.YUyux.KZnsOnkiNQjQpHAXoacV2saQABM9ICi', 1),
(2, 'MekkiL', 'MekkiL@contact.com', '$2y$10$6yi3S3VVE16UjYEPpFm2muYMvSJksj/3n9.Up49isoSVemhsoifnu', 1),
(3, 'Soleil bleu', 'soleilbleu@contact.com', '$2y$10$E/Z/KyxaLMuqkFA4FdRW0ONxGGVk991ZQRu3sIRyQqX0T6cmKcZVW', 1),
(4, 'ATAA', 'ATAA@contact.com', '$2y$10$rQE.tt0WmzTcd5WHjPvRQuqlaQW8qIViWkfkSEtbBeQCC1lsLOpBO', 1),
(5, 'Coeur Maroc', 'coeurmaroc@contact.com', '$2y$10$kdFIuxLEnamAwGJOSK0DUOshEymfZivaimtTPzYiwOeBSHMA7WgL2', 1),
(6, 'Enfants Bâdiya', 'enfantsbadiya@contact.com', '$2y$10$KKvC.wS3P5Wy/dRapa.3Pe9CojC0oRyz7peqjgiqN7FftIoaXOqAm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payInfo`
--

CREATE TABLE `payInfo` (
  `id` int(11) NOT NULL,
  `payMethod` varchar(255) NOT NULL DEFAULT 'Credit Card',
  `NameCard` varchar(255) NOT NULL DEFAULT 'Cardholder Name',
  `NumberCard` varchar(255) NOT NULL DEFAULT 'XXXX-XXXX-XXXX-XXXX',
  `Expiration` varchar(255) NOT NULL DEFAULT 'mm/AA',
  `CCV` varchar(255) NOT NULL DEFAULT 'XXX',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nb_donation` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_organisaton` (`id_organisaton`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_events` (`id_events`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payInfo`
--
ALTER TABLE `payInfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payInfo`
--
ALTER TABLE `payInfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_ibfk_1` FOREIGN KEY (`id_organisaton`) REFERENCES `organisations` (`id`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`id_events`) REFERENCES `advertisements` (`id`);

--
-- Constraints for table `payInfo`
--
ALTER TABLE `payInfo`
  ADD CONSTRAINT `payInfo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
