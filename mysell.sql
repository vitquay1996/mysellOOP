-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2016 at 02:03 PM
-- Server version: 5.6.27-2+deb.sury.org~trusty+1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysell`
--

-- --------------------------------------------------------

--
-- Table structure for table `mysell_cat`
--

CREATE TABLE `mysell_cat` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mysell_cat`
--

INSERT INTO `mysell_cat` (`id`, `name`, `id2`) VALUES
(1, 'For Him', '001'),
(2, 'For Her', '002'),
(3, 'Lifestyle Gadgets', '003'),
(4, 'Beauty Products', '004'),
(5, 'Man Shirt', '001.005'),
(6, 'Man Short', '001.006'),
(7, 'Man Watch', '001.007'),
(8, 'Man Shoes', '001.008'),
(9, 'Dress', '002.009'),
(10, 'Skirts', '002.010'),
(11, 'Woman Shorts', '002.011'),
(12, 'Game Console', '003.012'),
(13, 'Phone', '003.013'),
(14, 'Laptop Accessories', '003.014'),
(15, 'Tablet', '003.015'),
(16, 'Lipstick', '004.016'),
(17, 'Mascara', '004.017'),
(18, 'Facial Products', '004.018'),
(19, 'Hygiene', '004.019'),
(22, 'Timberland', '001.005.022'),
(23, 'Levis', '001.005.023'),
(24, 'Lacoste', '001.005.024'),
(25, 'Supra', '001.005.025'),
(26, 'Supra', '001.006.026'),
(27, 'Levis', '001.006.027'),
(28, 'Lacoste', '001.006.028'),
(29, 'Rolex', '001.007.029'),
(30, 'Lacoste', '002.011.030');

-- --------------------------------------------------------

--
-- Table structure for table `mysell_comments`
--

CREATE TABLE `mysell_comments` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postID` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mysell_comments`
--

INSERT INTO `mysell_comments` (`id`, `username`, `postID`, `content`, `date`) VALUES
(1, 'vitquay1996', 27, 'Test comment', '2016-05-20'),
(2, 'vitquay1996', 27, 'Second Test Comment', '2016-05-20'),
(3, 'trandieu', 27, 'Hi there. Is it negotiable?', '2016-05-23'),
(4, 'vitquay1996', 27, 'my 4th comment', '2016-05-24'),
(5, 'vitquay1996', 15, 'yeah yeah\r\n', '2016-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `mysell_posts`
--

CREATE TABLE `mysell_posts` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `catID` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mysell_posts`
--

INSERT INTO `mysell_posts` (`id`, `title`, `description`, `username`, `catID`, `price`, `date`, `status`) VALUES
(7, 'Iphone 6', '<p>asdf</p>\r\n<p>asdf</p>\r\n<p>asdf</p>', 'vitquay1996', '13', 123000000, '2016-05-16', 1),
(8, 'Mechanical Keyboard', '<p>qwerqwer</p>\r\n<p>qwer</p>\r\n<p>qwer</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '14', 130000, '2016-05-16', 1),
(9, 'T-shirt', '<p>aasdfasdf</p>\r\n<p>asdfa</p>\r\n<p>sdf</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '5', 987000, '2016-05-17', 1),
(10, 'Brand new Starbucks tumbler', '<p>qwerqwer</p>\r\n<p>qwerqwer</p>\r\n<p>qwerqwer</p>', 'vitquay1996', '3', 430000, '2016-05-18', 1),
(11, 'Perfume', '<p>qwerqwer</p>\r\n<p>qwerqwer</p>\r\n<p>qwerqwer</p>', 'vitquay1996', '4', 123000, '2016-05-19', 1),
(12, 'Some kind of facial product', '<p>qwerqwer</p>\r\n<p>qwerqwer</p>\r\n<p>qwerqwer</p>', 'vitquay1996', '18', 123123, '2016-05-19', 1),
(14, 'Supra shirt M', '<p>qwerqwr</p>\r\n<p>qewr</p>\r\n<p>qwe</p>\r\n<p>r</p>', 'vitquay1996', '25', 123000, '2016-05-20', 1),
(15, 'Lacoste Shirt M', 'qwer\r\nqwer\r\nqwer\r\n\r\n', 'vitquay1996', '24', 456000, '2016-05-20', 1),
(17, 'Lacoste Short L', '', 'vitquay1996', '28', 156000, '2016-05-20', 1),
(18, 'Lacoste Short S', '<p>qwer</p>\r\n<p>qwer</p>\r\n<p>qerw</p>', 'vitquay1996', '28', 123111, '2016-05-20', 1),
(19, 'Woman SHort Lacoste M', 'qwerqwer\r\nqwer\r\nqwer', 'vitquay1996', '30', 123000, '2016-05-20', 1),
(20, 'Men\'s Watch Rolex', '<p>qwerqwer</p>\r\n<p>qwer</p>\r\n<p>qwer</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '29', 1111111111, '2016-05-20', 1),
(21, 'Men wallet', '<p>qwerqwer</p>\r\n<p>qwer</p>\r\n<p>qwerqwer</p>', 'vitquay1996', '1', 12300, '2016-05-20', 1),
(22, 'Random Men products', '<p>qwerqwer</p>\r\n<p>qwerq</p>\r\n<p>wer</p>', 'vitquay1996', '1', 100000, '2016-05-20', 1),
(23, 'Another random Men product', '<p>qwer</p>\r\n<p>qwer</p>\r\n<p>qwer</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '1', 123000, '2016-05-20', 1),
(24, 'Random Women products', '<p>qwer</p>\r\n<p>qwer</p>\r\n<p>qwer</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '2', 444000, '2016-05-20', 1),
(25, 'Just a test for image', '<p>qwerqwer</p>\r\n<p>qwer</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '1', 123213, '2016-05-20', 1),
(26, 'Another test', '<p>qwer</p>\r\n<p>qwer</p>\r\n<p>qwer</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '1', 12312312, '2016-05-24', 1),
(27, 'Final Test for Uploading', '<p>qwerqwer</p>\r\n<p>qwer</p>\r\n<p>qwe</p>\r\n<p>r</p>', 'vitquay1996', '1', 123123, '2016-05-24', 1),
(28, 'Woman Handbag', '<p>asdfadsf</p>\r\n<p>asdf</p>\r\n<p>asdf</p>\r\n<p>&nbsp;</p>', 'vitquay1996', '2', 123123123, '2016-05-24', 1),
(48, 'asdfasdf', 'asdfasdf', 'vitquay1996', '1', 10000000, '2016-05-31', 1),
(55, 'Brand new bag 2', '<p>qwerqwer</p>', 'vitquay1996', '1', 113123, '2016-06-01', 1),
(56, 'Final test', '<p>asdfasdf</p>\r\n<p>asdfa</p>\r\n<p>s</p>', 'vitquay1996', '1', 123123, '2016-06-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mysell_upload`
--

CREATE TABLE `mysell_upload` (
  `id` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mysell_upload`
--

INSERT INTO `mysell_upload` (`id`, `postID`, `type`, `size`) VALUES
(2, 27, 'jpg', 178378),
(3, 28, 'jpg', 5302),
(4, 49, 'png', 0),
(5, 50, 'png', 181533),
(6, 51, 'png', 181533),
(7, 52, 'png', 181533),
(8, 53, 'png', 181533),
(9, 54, 'png', 181533),
(10, 55, 'png', 181533),
(11, 56, 'png', 181533);

-- --------------------------------------------------------

--
-- Table structure for table `mysell_users`
--

CREATE TABLE `mysell_users` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mysell_users`
--

INSERT INTO `mysell_users` (`id`, `name`, `username`, `password`, `email`, `date`, `admin`) VALUES
(1, 'Tran Viet Quang', 'vitquay1996', '92429d82a41e930486c6de5ebda9602d55c39986', 'vitquay1996@gmail.com', '2016-05-18', 1),
(2, 'DIeu', 'trandieu', '92429d82a41e930486c6de5ebda9602d55c39986', 'tranvietdieu@gmail.com', '2016-05-24', 0),
(4, 'Tran Viet Tiep', 'tiep', '554dbf0b41b3cd068ee1fcfd6235466a263647b4', 'tiep@gmail.com', '2016-05-30', 0),
(5, 'Tam', 'tam', '554dbf0b41b3cd068ee1fcfd6235466a263647b4', 'tam@gmail.com', '2016-05-31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mysell_cat`
--
ALTER TABLE `mysell_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mysell_comments`
--
ALTER TABLE `mysell_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mysell_posts`
--
ALTER TABLE `mysell_posts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `mysell_posts` ADD FULLTEXT KEY `post.title` (`title`);
ALTER TABLE `mysell_posts` ADD FULLTEXT KEY `post.description` (`description`);

--
-- Indexes for table `mysell_upload`
--
ALTER TABLE `mysell_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mysell_users`
--
ALTER TABLE `mysell_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mysell_cat`
--
ALTER TABLE `mysell_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `mysell_comments`
--
ALTER TABLE `mysell_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mysell_posts`
--
ALTER TABLE `mysell_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `mysell_upload`
--
ALTER TABLE `mysell_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mysell_users`
--
ALTER TABLE `mysell_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
