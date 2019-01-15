-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 05:03 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brihaspati_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(50) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `book_name` text NOT NULL,
  `book_price` int(11) NOT NULL,
  `book_desc` text NOT NULL,
  `authors` text NOT NULL,
  `edition` text NOT NULL,
  `book_image` text NOT NULL,
  `sub_cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `cat_id`, `book_name`, `book_price`, `book_desc`, `authors`, `edition`, `book_image`, `sub_cat_id`) VALUES
(1, 1, 'Child Development and Learning', 160, 'This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.', 'Chudamani Dhakal & Shiva Dhakal', '2018', '579.jpg', 2),
(2, 1, 'Instructional Evaluation', 150, 'This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.', 'Chudamani Dhakal & Shiva Dhakal', '2018', '561.jpg', 2),
(3, 3, 'Educational Psychology ', 210, 'This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.', 'C.M. Sharma, M. Dhakal', '2018', '190.jpg', 2),
(4, 3, 'Curriculum and Evaluation', 200, 'This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.', 'C.M. Sharma, M. Dhakal', '2018', '449.jpg', 2),
(5, 3, 'Foundation of Education', 210, 'This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.', 'C.M. Sharma, M. Dhakal', '2018', '401.jpg', 1),
(6, 1, 'Teaching Practice Book', 160, 'This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.This is a demo text.', 'Ganesh Raj Adhikari  Basudev Rimal ', '2018', '572.jpg', 2),
(7, 3, 'All is good', 250, 'dsfdfvndvbfvdbnvfbdvbnfvdbvfbvdbvfbdvbnvdbfvdvfbvdbvfbdvfbvfbdv', 'm sharma', '2017', '407.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_name` text NOT NULL,
  `book_image` text NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `ttl_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `book_id`, `user_id`, `book_name`, `book_image`, `quantity`, `price`, `ttl_price`) VALUES
(3, 2, 1, 'Instructional Evaluation', '561.jpg', 1, 150, 150),
(4, 4, 1, 'Curriculum and Evaluation', '449.jpg', 1, 200, 200),
(7, 2, 3, 'Instructional Evaluation', '561.jpg', 1, 150, 150),
(9, 3, 2, 'Educational Psychology ', '190.jpg', 1, 210, 210),
(10, 4, 2, 'Curriculum and Evaluation', '449.jpg', 1, 200, 200);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'HSEB Level Textbooks'),
(2, 'HSEB Level Reference Books'),
(3, 'Bachelor Level Reference Books'),
(4, 'Old is Gold and Syllabus'),
(5, 'Master Level Books'),
(6, 'Other Books'),
(7, 'Secondary Level  Reference Books'),
(10, 'Miscellenous'),
(11, 'Engineering Book');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `sub_cat_id` int(4) NOT NULL,
  `parent_id` int(4) NOT NULL,
  `sub_cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`sub_cat_id`, `parent_id`, `sub_cat_name`) VALUES
(1, 1, 'Class 11 Textbooks'),
(1, 2, 'Class 11 Reference Books'),
(1, 3, 'Bachelor First year Books'),
(2, 1, 'Class 12 Textbooks'),
(2, 2, 'Class 12 Reference Books'),
(2, 3, 'Bachelor Second Year');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `shopName` varchar(50) NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `name`, `email`, `password`, `phone`, `address`, `shopName`, `reg_date`, `last_login`) VALUES
(1, 'Sailesh Dhakal', 'mesailesh05@gmail.com', 'cnp2ZkJqK2piMXpPaVp4aHd2NGlGZz09', 9632478062, 'Chiknayakanahalli', '', '2018-07-31 08:19:55', '2018-09-17 07:41:56'),
(2, 'Sailesh Dhakal', 'mesailesh07@gmail.com', 'cnp2ZkJqK2piMXpPaVp4aHd2NGlGZz09', 9632478062, 'Kathmandu', '', '2018-08-01 11:59:33', '2018-09-19 10:16:05'),
(3, 'Utsav Thapa', 'utsavthapa39@gmail.com', 'WVZzN0pHRUtxZ1NZb2czeGJyNkMrQT09', 9632478062, 'Chiknayakanahalli', '', '2018-09-19 10:12:07', '2018-09-19 10:13:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`sub_cat_id`,`parent_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
