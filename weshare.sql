-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 04:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
(2, 'Exemple 1 ', 'uploads/external-content.duckduckgo.com.png', 'dictumst quisque sagittis purus sit amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus mauris a diam maecenas sed enim ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl    ', 400, '2021-04-08 00:04:16', 5),
(3, 'Exemple 2', 'uploads/annonce.jpg', 'et magnis dis parturient montes nascetur ridiculus mus mauris vitae ultricies leo integer malesuada nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit egestas dui id ornare arcu odigntkyg rhjg too ut sem nulla pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit sed vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero nunc consequat interdum varius sit amet mattis vulputate enim nulla        ', 100, '2021-05-31 19:54:44', 4),
(4, 'Exemple 3', 'uploads/external-content.duckduckgo.com.png', 'dictumst quisque sagittis purus sit amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus mauris a diam maecenas sed enim ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl    ', 500, '2021-04-08 00:04:24', 5),
(5, 'Exemple 4', 'uploads/annonce.jpg', 'purus faucibus ornare suspendisse sed nisi lacus sed viverra tellus in hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra', 200, '2021-04-07 20:12:31', 4),
(6, 'Exemple 5', 'uploads/external-content.duckduckgo.com.png', 'dictumst quisque sagittis purus sit amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus mauris a diam maecenas sed enim ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl    ', 30, '2021-04-08 00:04:30', 5),
(19, 'Exemple 6', 'uploads/annonce.jpg', 'dictumst quisque sagittis purus sit amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus mauris a diam maecenas sed enim ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl ', 0, '2021-05-31 19:57:53', 4);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id_events` int(11) NOT NULL,
  `amount` double NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id_events`, `amount`, `Date`) VALUES
(4, 200, '2021-05-29 16:32:33'),
(4, 300, '2021-05-29 16:35:04'),
(2, 100, '2021-05-31 20:04:33'),
(3, 100, '2021-06-02 20:36:24'),
(5, 100, '2021-06-02 20:37:00'),
(5, 100, '2021-06-02 20:37:54'),
(2, 100, '2021-06-02 20:44:34'),
(2, 100, '2021-06-03 10:49:56'),
(2, 100, '2021-06-03 11:21:46'),
(6, 30, '2021-06-04 16:07:09');

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
(4, 'ATAA', 'ATAA@contact.com', '$2a$10$t4F9FZrP3GB1WHGLGbqxQu8iCFuyYdf0ca5b9U9irccHhMuVo9r1S', 1),
(5, 'Coeur Maroc', 'coeurmaroc@contact.com', '$2y$10$kdFIuxLEnamAwGJOSK0DUOshEymfZivaimtTPzYiwOeBSHMA7WgL2', 1),
(6, 'Enfants Bâdiya', 'enfantsbadiya@contact.com', '$2y$10$KKvC.wS3P5Wy/dRapa.3Pe9CojC0oRyz7peqjgiqN7FftIoaXOqAm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payinfo`
--

CREATE TABLE `payinfo` (
  `id` int(11) NOT NULL,
  `RIB` varchar(24) DEFAULT NULL,
  `id_org` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payinfo`
--

INSERT INTO `payinfo` (`id`, `RIB`, `id_org`) VALUES
(1, '19078021162172142001186', 4),
(2, '17806002870411187576184', 5);

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
  ADD KEY `id_events` (`id_events`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payinfo`
--
ALTER TABLE `payinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_org` (`id_org`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payinfo`
--
ALTER TABLE `payinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`id_events`) REFERENCES `advertisements` (`id`);

--
-- Constraints for table `payinfo`
--
ALTER TABLE `payinfo`
  ADD CONSTRAINT `payInfo_ibfk_1` FOREIGN KEY (`id_org`) REFERENCES `organisations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
