-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 01:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drone`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(1, 'Harry Potter Book', 500, 100, 'old', 'This book is a medium for recording information in the form of writing or images, typically composed of many pages bound together and protected by a cover. The technical term for this physical arrangement is codex.', '', 'rushikesh@gmail.comBook.png', '2020-04-06 20:14:12', '	\r\ndeepakbandal9@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chatmsg`
--

CREATE TABLE `chatmsg` (
  `sno` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `product` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `emailblock` datetime NOT NULL,
  `emailidblock` datetime NOT NULL,
  `emaildelete` datetime NOT NULL,
  `emailiddelete` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatmsg`
--

INSERT INTO `chatmsg` (`sno`, `email`, `emailid`, `product`, `time`, `emailblock`, `emailidblock`, `emaildelete`, `emailiddelete`) VALUES
(64, 'deepakbandal9@gmail.com', 'rushikesh@gmail.com', 'fashionables-1', '2020-04-15 21:50:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'instruments-44', '2020-04-16 11:40:40', '2020-04-16 14:34:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'deepakbandal9@gmail.com', 'shreebandal0@gmail.com', 'books-1', '2020-04-16 11:40:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `sno` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `reciver` varchar(100) NOT NULL,
  `content` varchar(700) NOT NULL,
  `isread` int(11) NOT NULL DEFAULT 0,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `isonline` datetime NOT NULL DEFAULT current_timestamp(),
  `senderdelete` int(11) NOT NULL DEFAULT 0,
  `receverdelete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`sno`, `product`, `sender`, `reciver`, `content`, `isread`, `datetime`, `isonline`, `senderdelete`, `receverdelete`) VALUES
(76, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'i am here', 1, '2020-04-14 23:14:16', '0000-00-00 00:00:00', 0, 1),
(78, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'so babe', 1, '2020-04-14 23:17:03', '0000-00-00 00:00:00', 0, 1),
(80, 'fashionables-2', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'ntg ', 1, '2020-04-15 11:10:52', '2020-04-16 11:40:29', 1, 0),
(84, 'fashionables-2', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'so what should i do', 1, '2020-04-15 15:49:46', '2020-04-16 11:40:29', 1, 0),
(87, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'shut up', 1, '2020-04-15 18:34:16', '0000-00-00 00:00:00', 0, 1),
(88, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'plzzz', 1, '2020-04-15 19:26:41', '0000-00-00 00:00:00', 0, 1),
(89, 'instruments-43', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'hiii', 1, '2020-04-15 22:25:55', '2020-04-16 11:40:29', 0, 1),
(90, 'clothing-9', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'hellow', 1, '2020-04-15 22:26:04', '2020-04-16 11:40:29', 1, 1),
(91, 'vehicals-1', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'shree', 1, '2020-04-15 22:29:53', '2020-04-16 11:40:29', 0, 1),
(92, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'hey brother', 1, '2020-04-15 22:30:54', '0000-00-00 00:00:00', 0, 1),
(93, 'vehicals-1', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'shreeyansh', 1, '2020-04-15 22:31:07', '0000-00-00 00:00:00', 1, 0),
(95, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'hellow', 1, '2020-04-16 01:06:52', '0000-00-00 00:00:00', 0, 1),
(96, 'fashionables-2', 'rushikesh@gmail.com', 'shreebandal0@gmail.com', 'tree', 1, '2020-04-16 01:26:46', '0000-00-00 00:00:00', 1, 0),
(98, 'instruments-44', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'shree', 0, '2020-04-16 12:24:10', '2020-04-16 12:24:10', 1, 0),
(99, 'instruments-44', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'so', 0, '2020-04-16 12:24:19', '2020-04-16 12:24:19', 1, 0),
(100, 'instruments-44', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'take chill', 0, '2020-04-16 12:24:28', '2020-04-16 12:24:28', 1, 0),
(101, 'instruments-44', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'shree', 0, '2020-04-16 13:30:19', '2020-04-16 13:30:19', 0, 0),
(102, 'instruments-44', 'shreebandal0@gmail.com', 'rushikesh@gmail.com', 'shreeyansh', 0, '2020-04-16 13:30:30', '2020-04-16 13:30:30', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clothing`
--

CREATE TABLE `clothing` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clothing`
--

INSERT INTO `clothing` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(2, 'Swet jacket', 3000, 500, 'used', 'A sweater, also called a jumper in British English, is a piece of clothing, typically with long sleeves, made of knitted or crocheted material that covers the upper part of the body. When sleeveless, the garment is often called a slipover or sweater vest.', '', 'rushikesh@gmail.comimg2.jpg', '2020-04-08 17:22:32', 'rushikesh@gmail.com', 0, 0),
(4, 'waistcoat', 2500, 500, 'new', 'A waistcoat, or vest, is a sleeveless upper-body garment. It is usually worn over a dress shirt and necktie and below a coat as a part of most mens formal wear. It is also sported as the third piece in the traditional three-piece male lounge suit.', '', 'rushikesh@gmail.comWaistcoat.jpg', '2020-04-08 17:25:13', 'rushikesh@gmail.com', 0, 0),
(17, 'uew qhUHDUH', 655465, 4454, 'new', 'E WJKJSKJDFS KLJF KDSJKFSDMFDSMF', '', 'rushikesh@gmail.combanner.jpg', '2020-04-15 21:45:22', 'rushikesh@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(9) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mailotp` int(1) NOT NULL DEFAULT 0,
  `validation_key` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `isblock` int(11) NOT NULL DEFAULT 0,
  `isdelete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `email`, `address`, `password`, `mailotp`, `validation_key`, `pic`, `picture`, `isblock`, `isdelete`) VALUES
(175, 'Shree', 'Bandal', 'shreebandal0@gmail.com', 'i live in my home', '$2y$10$.ed7C1YuV.71vT6To/RLKebClC/JfIm.5e69fwmlYGMXcV1iw4XRy', 1, '115147673376456130844', 'https://lh3.googleusercontent.com/a-/AOh14GhxSsTH94v7XpMtA-Kac0Xa9Vmdvv_VJLdTf9dRNg', '', 0, 0),
(186, 'rushi', 'patil', 'rushikesh@gmail.com', 'new bombay', '$2y$10$tZwkzvZucE2AsLynhrNlD.3BAYgsh.ThcVnOmEErnW8ORmKRKox/i', 1, 'NzEwMTJhOGZiY2FjNGMxYTZlMmMyZDU1', '', 'rushikesh@gmail.comprofile.jpg', 0, 0),
(187, 'deepak', 'bandal', 'deepakbandal9@gmail.com', 'pen raigad 402107', '$2y$10$hQINqYYz1GI3JxC5qTO63e0PxyJLaY2Aabe/HILNYPnAqlCI95Bi.', 1, 'YjVhYWM5ZTEwYjExNmQ5NjJiMzgxYzMw', '', 'deepakbandal9@gmail.comprofile.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `electronics`
--

CREATE TABLE `electronics` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fashionables`
--

CREATE TABLE `fashionables` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fashionables`
--

INSERT INTO `fashionables` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(1, 'Titan Watch', 999, 100, 'used', 'A watch is a portable timepiece intended to be carried or worn by a person. It is designed to keep a consistent movement despite the motions caused by the persons activities.', 'sports watches<br>chronograph<br>analogue<br>digital<br>', 'rushikesh@gmail.comwatch.jpg', '2020-04-06 20:35:42', 'deepakbandal9@gmail.com', 0, 0),
(2, 'shoes', 2999, 999, 'used', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes has varied enormously through time and from culture to culture, with appearance originally being ti', '', 'shreebandal0@gmail.comshooe.jpg', '2020-04-06 21:22:07', 'shreebandal0@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `sno` int(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feebacktype` text NOT NULL,
  `feedbackmsg` varchar(255) NOT NULL,
  `feedbackpic` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`sno`, `email`, `feebacktype`, `feedbackmsg`, `feedbackpic`, `date`) VALUES
(15, 'rushikesh@gmail.com', 'technical', 'nsabdbjdb ajsjknsjjkjsajkdasjkdjhaskjh', 'rushikesh@gmail.comcal.jpg', '2020-04-15 21:07:14'),
(16, 'rushikesh@gmail.com', 'technical', 'nsabdbjdb ajsjknsjjkjsajkdasjkdjhaskjh', 'rushikesh@gmail.comcal.jpg', '2020-04-15 21:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `fitness`
--

CREATE TABLE `fitness` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitness`
--

INSERT INTO `fitness` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(1, 'Dumbells', 1000, 300, 'new', 'The dumbbell, a type of free weight, is a piece of equipment used in weight training. It can be used individually or in pairs, with one in each hand.', '5 kg iron dumbbell<br>', 'rushikesh@gmail.comdumbbell.png', '2020-04-06 20:18:06', 'rushikesh@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instruments`
--

INSERT INTO `instruments` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(44, 'jfvhjsdzkjk', 534545, 12122, 'new', 'zxjhjcjhjkxhjcjhjkhjkhjzjjhjhjjcz jj', '', 'rushikesh@gmail.comprofile.jpg', '2020-04-15 21:14:39', 'rushikesh@gmail.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mycart`
--

CREATE TABLE `mycart` (
  `cartid` int(11) NOT NULL,
  `personname` varchar(255) NOT NULL,
  `producttype` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `uniquecart` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(1, 'Travel BackPack', 5000, 499, 'old', 'A backpack also called knapsack, rucksack, rucksac, pack, sackpack, booksack, bookbag or backsack is, in its simplest frameless form, a cloth sack carried on ones back and secured with two straps that go over the shoulders, but it can have an external fra', '', 'rushikesh@gmail.combag.jpg', '2020-04-06 20:39:11', 'rushikesh@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `sno` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `feebacktype` varchar(255) NOT NULL,
  `feedbackmsg` varchar(300) NOT NULL,
  `feedbackpic` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`sno`, `email`, `feebacktype`, `feedbackmsg`, `feedbackpic`, `date`) VALUES
(1, 'rushikesh@gmail.com', 'Spam', 'uh duhUHSDILSAJLJDLKJSKAJLKJKDJLKa j', 'shreebandal0@gmail.comScreenshot (1).png', '2020-04-16 14:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `vehicals`
--

CREATE TABLE `vehicals` (
  `prodid` int(9) NOT NULL,
  `prodname` text NOT NULL,
  `prodoldprice` int(9) NOT NULL,
  `prodnewprice` int(9) NOT NULL,
  `prodcondition` text NOT NULL,
  `proddesc` varchar(255) NOT NULL,
  `prodfetures` varchar(255) NOT NULL,
  `prodpic` varchar(255) NOT NULL,
  `proddate` datetime NOT NULL DEFAULT current_timestamp(),
  `prodseller` varchar(100) NOT NULL,
  `issold` int(1) NOT NULL DEFAULT 0,
  `prodadd` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicals`
--

INSERT INTO `vehicals` (`prodid`, `prodname`, `prodoldprice`, `prodnewprice`, `prodcondition`, `proddesc`, `prodfetures`, `prodpic`, `proddate`, `prodseller`, `issold`, `prodadd`) VALUES
(1, 'bicycle ', 5000, 999, 'used', 'Individuals who cycle regularly have also reported mental health improvements, including less perceived stress and better vitality.', '', 'rushikesh@gmail.comcycle.jpg', '2020-04-06 20:05:41', 'rushikesh@gmail.com', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `chatmsg`
--
ALTER TABLE `chatmsg`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `product` (`product`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `electronics`
--
ALTER TABLE `electronics`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `fashionables`
--
ALTER TABLE `fashionables`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `fitness`
--
ALTER TABLE `fitness`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `mycart`
--
ALTER TABLE `mycart`
  ADD PRIMARY KEY (`cartid`),
  ADD UNIQUE KEY `uniquecart` (`uniquecart`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`prodid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `vehicals`
--
ALTER TABLE `vehicals`
  ADD PRIMARY KEY (`prodid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chatmsg`
--
ALTER TABLE `chatmsg`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `electronics`
--
ALTER TABLE `electronics`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fashionables`
--
ALTER TABLE `fashionables`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `sno` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fitness`
--
ALTER TABLE `fitness`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `mycart`
--
ALTER TABLE `mycart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicals`
--
ALTER TABLE `vehicals`
  MODIFY `prodid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
