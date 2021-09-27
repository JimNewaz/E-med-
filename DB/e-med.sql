-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 05:21 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-med`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `registration_date`, `token`) VALUES
(1, 'admin', 'forallpurposes3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2021-08-28 16:17:12', '740fdae9834f48e13cef70270007e0'),
(2, 'demo', 'ximnewaz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2021-06-01 05:57:54', '9a884ea3716488341f3cb44aba4aed');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT current_timestamp(),
  `serial` varchar(10) DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `password`, `contact_no`, `address`, `registration_date`, `status`) VALUES
(1, 'xyz', 'xyz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '12343', '2021-09-27 09:22:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `imgpath` varchar(1000) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `featured` varchar(10) NOT NULL DEFAULT 'no',
  `featured_date` date DEFAULT NULL,
  `speciality` varchar(20) DEFAULT NULL,
  `visit_fee` varchar(10) DEFAULT NULL,
  `chamber_time_start` varchar(10) DEFAULT NULL,
  `chamber_time_end` varchar(10) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `meet_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `pass`, `contact_no`, `imgpath`, `token`, `featured`, `featured_date`, `speciality`, `visit_fee`, `chamber_time_start`, `chamber_time_end`, `status`, `reg_date`, `meet_link`) VALUES
(1, 'Jack Jemon', 'forallpurposes3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123', NULL, 'a890d5ef9f9bb6acda885219576d12', 'no', NULL, NULL, NULL, NULL, NULL, 1, '2021-09-27 19:29:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `ref_type` varchar(30) DEFAULT NULL,
  `remark` varchar(30) DEFAULT NULL,
  `fee_amount` varchar(30) DEFAULT NULL,
  `date_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `ref_id`, `ref_type`, `remark`, `fee_amount`, `date_time`) VALUES
(1, 0, 'doctor', '02021-09-23emed', '25000', '2021-09-23 21:44:31'),
(2, 1, 'user', ' User Doctor Fee', '5000', '2021-09-24 01:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `shipping_charge` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `product_availability` varchar(255) NOT NULL,
  `feature` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `company`, `price`, `image1`, `image2`, `image3`, `description`, `shipping_charge`, `stock`, `product_availability`, `feature`, `posting_date`) VALUES
(2, 'Napa ', 'Square', '80', 'v.jpg', 'panawell.jpg', 'neo.jpg', '																						Lorem&nbsp; Ipsum test', '10', 100, '<br />\r\n<b>Notice</b>:  Undefined index: productAvailability in <b>C:XAMPPhtdocsJIMEmedadminedit-products.php</b> on line <b>144</b><br />\r\n', 'yes', '2021-06-20 07:55:35'),
(10, 'Ace', 'Square', '120', 'napa.jpg', 'napa.jpg', 'ace.jpg', '											Lorem Ipsum											', '100', 0, 'Out of Stock', 'yes', '2021-06-19 08:23:34'),
(11, 'Vitamin', 'ABCD', '1000', 'Vicks_AU_Cough_2in1_Syrup_front.jpg', 'Vicks_AU_Cough_2in1_Syrup_front.jpg', 'Vicks_AU_Cough_2in1_Syrup_front.jpg', '																						Lorem Ipsum Demo											', '20', 100, 'In Stock', 'yes', '2021-06-20 07:56:13'),
(12, 'Vitamin A', 'Lorem', '300', 'vitamin a.jpg', 'vitamin a.jpg', 'vitamin a.jpg', 'Lorem Ipsum', '50', 10, 'In Stock', 'yes', '2021-06-10 11:12:28'),
(13, 'Vitamin D', 'Lorem', '90', 'vitamin d.jpg', 'vitamin d.jpg', 'vitamin d.jpg', '											Lorem Ipsum											', '0', 8, '<br />\r\n<b>Notice</b>:  Undefined index: productAvailability in <b>C:XAMPPhtdocsJIMEmedadminedit-products.php</b> on line <b>144</b><br />\r\n', 'yes', '2021-07-05 15:34:06'),
(14, 'Vitamin D3', 'Lorem', '1800', 'omega3.jpg', 'omega3.jpg', 'omega3.jpg', 'Lorem Ipsum', '20', 0, 'Out of Stock', 'no', '2021-06-10 11:13:47'),
(16, 'Eye Drop', 'Lorem', '50', '6158jBL6lbL._SL1080_.jpg', 'tearon.jpg', 'tearon.jpg', '																																	Lorem Ipsum																																	', '10', 10, 'In Stock', 'yes', '2021-09-27 11:06:36'),
(17, 'Nose Drop', 'Lorem Ipsum', '400', 'nasivion-classic-adult-0-05-nasal-spray-0.png', 'nasivion-classic-adult-0-05-nasal-spray-0.png', 'nasivion-classic-adult-0-05-nasal-spray-0.png', 'Lorem Ipsum', '20', 100, 'In Stock', 'no', '2021-06-10 12:10:43'),
(18, 'Panawell', 'Lorem Ipsum', '200', 'panawell.jpg', 'panawell.jpg', 'panawell.jpg', 'Lorem Ipsum', '50', 10, 'In Stock', 'no', '2021-06-10 12:17:00'),
(19, 'Ace', 'lorem', '20', 'ace.jpg', '', '', 'lorem', '30', 8, 'In Stock', 'no', '2021-06-19 10:05:14'),
(20, 'ere', 'ere', '122', 'vitamin a.jpg', '', '', 'lorem ipsum', '10', 10, 'In Stock', 'no', '2021-06-20 07:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_orders`
--

CREATE TABLE `medicine_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderdate` timestamp NULL DEFAULT current_timestamp(),
  `amount` bigint(20) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_orders`
--

INSERT INTO `medicine_orders` (`id`, `user_id`, `product_id`, `quantity`, `orderdate`, `amount`, `order_status`, `address`, `payment`) VALUES
(35, 1, 13, 1, '2021-06-18 19:32:28', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(36, 1, 16, 1, '2021-06-18 19:34:02', 0, NULL, 'Test 1 2 3 4', 'Your Point'),
(37, 1, 12, 1, '2021-06-18 19:40:12', 0, NULL, '', 'Cash on Delivery'),
(38, 1, 16, 1, '2021-06-18 19:41:55', 0, NULL, '', 'Cash on Delivery'),
(39, 1, 16, 1, '2021-06-18 19:54:01', 0, NULL, '', 'Cash on Delivery'),
(40, 1, 12, 1, '2021-06-18 19:54:40', 0, NULL, '', 'Cash on Delivery'),
(41, 1, 13, 1, '2021-06-18 19:55:51', 130, NULL, '', 'bkash'),
(42, 1, 16, 1, '2021-06-18 20:04:04', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(43, 1, 13, 1, '2021-06-18 20:15:31', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(44, 1, 13, 1, '2021-06-18 20:16:07', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(45, 1, 13, 1, '2021-06-18 20:16:38', 130, NULL, '', 'Nagad'),
(46, 1, 13, 1, '2021-06-18 20:17:00', 130, NULL, '', 'Nagad'),
(47, 1, 13, 1, '2021-06-18 20:19:32', 130, NULL, '', 'Nagad'),
(48, 1, 13, 1, '2021-06-18 20:20:46', 130, NULL, '', 'Nagad'),
(49, 1, 13, 1, '2021-06-18 20:22:27', 130, NULL, '', 'Nagad'),
(50, 1, 13, 1, '2021-06-18 20:25:30', 130, NULL, '', 'Nagad'),
(51, 1, 13, 1, '2021-06-18 20:27:07', 130, NULL, '', 'Nagad'),
(52, 1, 13, 1, '2021-06-18 20:29:33', 130, NULL, '', 'Nagad'),
(53, 1, 2, 1, '2021-06-18 20:29:53', 130, NULL, '', 'Nagad'),
(54, 1, 13, 1, '2021-06-18 20:30:56', 130, NULL, '', 'Nagad'),
(55, 1, 13, 1, '2021-06-18 20:34:02', 130, NULL, '', ''),
(56, 1, 13, 1, '2021-06-18 20:40:50', 130, NULL, '', 'bkash'),
(57, 1, 13, 1, '2021-06-18 20:45:13', 130, NULL, '', 'bkash'),
(58, 1, 16, 1, '2021-06-18 20:50:49', 130, NULL, '', 'bkash'),
(59, 1, 13, 1, '2021-06-18 20:54:22', 130, NULL, '', 'bkash'),
(60, 1, 16, 1, '2021-06-18 20:54:47', 130, NULL, '', 'bkash'),
(61, 1, 16, 1, '2021-06-18 20:55:30', 130, NULL, '', 'bkash'),
(62, 1, 13, 1, '2021-06-18 20:56:57', 130, NULL, '', 'bkash'),
(63, 1, 13, 1, '2021-06-18 20:57:52', NULL, NULL, NULL, NULL),
(64, 1, 13, 1, '2021-06-18 21:01:17', NULL, NULL, NULL, NULL),
(65, 1, 12, 1, '2021-06-18 21:02:07', NULL, NULL, NULL, NULL),
(66, 1, 13, 1, '2021-06-18 21:02:07', NULL, NULL, NULL, NULL),
(67, 1, 16, 1, '2021-06-18 21:03:08', NULL, NULL, NULL, NULL),
(68, 1, 16, 1, '2021-06-18 21:09:57', NULL, NULL, NULL, NULL),
(69, 1, 13, 1, '2021-06-18 21:12:03', NULL, NULL, NULL, NULL),
(70, 1, 16, 1, '2021-06-18 21:12:03', NULL, NULL, NULL, NULL),
(71, 1, 13, 1, '2021-06-18 21:25:02', NULL, NULL, NULL, NULL),
(72, 1, 16, 1, '2021-06-18 21:25:02', NULL, NULL, NULL, NULL),
(73, 1, 13, 1, '2021-06-18 21:28:40', NULL, NULL, NULL, NULL),
(74, 1, 12, 1, '2021-06-18 21:30:17', NULL, NULL, NULL, NULL),
(75, 1, 13, 1, '2021-06-18 21:32:52', NULL, NULL, NULL, NULL),
(76, 1, 13, 1, '2021-06-18 21:33:05', NULL, NULL, NULL, NULL),
(77, 1, 16, 1, '2021-06-18 21:33:45', NULL, NULL, NULL, NULL),
(78, 1, 16, 1, '2021-06-18 21:35:09', NULL, NULL, NULL, NULL),
(79, 1, 16, 1, '2021-06-18 21:35:14', NULL, NULL, NULL, NULL),
(80, 1, 16, 1, '2021-06-18 21:35:45', NULL, NULL, NULL, NULL),
(81, 1, 16, 1, '2021-06-18 21:35:58', 170, NULL, 'Test 1 2 3 4', 'Your Point'),
(82, 1, 2, 1, '2021-06-18 21:36:42', 110, NULL, 'Test 1 2 3 4', 'Your Point'),
(83, 1, 13, 1, '2021-06-18 21:39:33', 130, NULL, '', 'Cash on Delivery'),
(84, 1, 12, 1, '2021-06-18 21:43:00', 350, 'Delivered', 'Test 1 2 3 4', 'Nagad'),
(85, 1, 13, 1, '2021-06-18 21:47:26', 130, 'in Process', 'Test 1 2 3 4', 'Your Point'),
(86, 1, 11, 1, '2021-06-18 21:59:24', NULL, 'Delivered', NULL, NULL),
(87, 1, 13, 1, '2021-06-18 22:00:11', 130, 'in Process', 'Test 1 2 3 4', 'Your Point'),
(88, 1, 12, 1, '2021-06-19 09:15:50', 480, NULL, 'Test 1 2 3 4', 'Cash on Delivery'),
(89, 1, 13, 1, '2021-06-19 09:15:50', 480, NULL, 'Test 1 2 3 4', 'Cash on Delivery'),
(90, 1, 2, 2, '2021-06-19 10:02:04', NULL, 'in Process', NULL, NULL),
(91, 1, 13, 1, '2021-06-19 10:02:04', NULL, NULL, NULL, NULL),
(92, 1, 13, 1, '2021-06-19 10:02:58', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(93, 1, 13, 1, '2021-06-19 10:02:58', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(94, 1, 16, 1, '2021-06-19 10:03:35', 170, 'in Process', 'Test 1 2 3 4', 'bkash'),
(95, 1, 13, 1, '2021-06-19 10:03:35', 170, 'Delivered', 'Test 1 2 3 4', 'bkash'),
(96, 1, 13, 1, '2021-06-19 10:17:28', 130, 'Delivered', 'Test 1 2 3 4', 'Your Point'),
(97, 1, 13, 1, '2021-06-20 02:56:18', 130, NULL, 'Test 1 2 3 4', 'Your Point'),
(98, 1, 13, 1, '2021-06-20 03:42:54', NULL, 'in Process', NULL, NULL),
(99, 1, 13, 1, '2021-06-20 03:46:08', 170, NULL, 'Test 1 2 3 4', 'bkash'),
(100, 1, 16, 1, '2021-06-20 03:46:30', NULL, 'Delivered', NULL, NULL),
(101, 1, 12, 2, '2021-06-20 03:47:38', 650, NULL, 'Test 1 2 3 4', 'bkash'),
(102, 1, 18, 1, '2021-06-20 03:49:18', NULL, NULL, NULL, NULL),
(103, 1, 16, 1, '2021-06-20 03:51:02', NULL, NULL, NULL, NULL),
(104, 1, 12, 1, '2021-06-20 03:51:23', NULL, NULL, NULL, NULL),
(105, 1, 13, 1, '2021-06-20 07:10:31', 130, NULL, 'Test 1 2 3 4', 'bkash'),
(106, 1, 13, 1, '2021-06-20 07:48:23', 130, 'Delivered', 'Test 1 2 3 4', 'Your Point'),
(107, 6, 13, 1, '2021-07-05 15:34:17', 90, NULL, '', 'Your Point'),
(108, 1, 12, 1, '2021-09-01 18:16:10', 350, NULL, 'Test 1 2 3 4', 'Cash on Delivery'),
(109, 1, 12, 1, '2021-09-11 11:00:16', 350, NULL, 'Test 1 2 3 4', 'Your Point'),
(110, 1, 16, 1, '2021-09-11 11:01:43', 170, NULL, 'Test 1 2 3 4', 'bkash'),
(111, 1, 16, 1, '2021-09-11 11:03:17', 170, NULL, 'Test 1 2 3 4', 'bkash'),
(112, 1, 12, 1, '2021-09-11 18:18:58', NULL, NULL, NULL, NULL),
(113, 1, 16, 1, '2021-09-12 06:05:27', 170, 'Delivered', 'Test 1 2 3 4', 'Cash on Delivery'),
(114, 1, 16, 1, '2021-09-12 06:09:28', 170, NULL, 'Test 1 2 3 4', 'Cash on Delivery'),
(115, 1, 16, 1, '2021-09-12 06:51:54', NULL, NULL, NULL, NULL),
(116, 1, 12, 1, '2021-09-12 06:52:12', NULL, NULL, NULL, NULL),
(117, 1, 16, 1, '2021-09-12 06:52:12', NULL, 'in Process', NULL, NULL),
(118, 1, 16, 1, '2021-09-12 06:56:16', 170, NULL, 'Test 1 2 3 4', 'Your Point'),
(119, 1, 16, 1, '2021-09-12 06:56:16', NULL, NULL, NULL, NULL),
(120, 1, 12, 1, '2021-09-12 07:31:31', 350, NULL, 'Test 1 2 3 4', 'bkash'),
(121, 1, 16, 1, '2021-09-12 07:31:31', NULL, NULL, NULL, NULL),
(122, 1, 16, 1, '2021-09-12 07:32:22', 170, NULL, 'Test 1 2 3 4', 'Your Point'),
(123, 1, 16, 1, '2021-09-12 07:32:22', NULL, NULL, NULL, NULL),
(124, 1, 12, 1, '2021-09-12 09:02:20', 350, NULL, 'Test 1 2 3 4', 'Cash on Delivery'),
(125, 1, 19, 1, '2021-09-12 09:03:51', 50, NULL, 'Test 1 2 3 4', 'Your Point'),
(126, 1, 16, 1, '2021-09-27 11:06:50', 60, NULL, 'Test 1 2 3 4', 'Your Point'),
(127, 1, 16, 1, '2021-09-27 11:13:51', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `med_orders_medicine`
--

CREATE TABLE `med_orders_medicine` (
  `order_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_pres`
--

CREATE TABLE `po_pres` (
  `prescription_id` int(11) NOT NULL,
  `prescription_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `disease_type` varchar(255) NOT NULL,
  `prescription_image` varchar(255) NOT NULL,
  `upload_date` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `hospital`, `doctor`, `disease_type`, `prescription_image`, `upload_date`, `status`) VALUES
(51, 1, 'Normal Disease', 'Test', 'Test', 'Indicate-why-the-prescription-is-not-appropriate-as-written.png', '2021-09-12 06:16:29', 1),
(52, 1, 'Normal Disease', 'Test', 'ssd', 'Indicate-why-the-prescription-is-not-appropriate-as-written.png', '2021-09-12 07:26:38', 1),
(53, 1, 'Normal Disease', 'Test', 'Test', 'Indicate-why-the-prescription-is-not-appropriate-as-written.png', '2021-09-12 07:27:08', 1),
(54, 1, 'Normal Disease', 'test', 'test', 'Indicate-why-the-prescription-is-not-appropriate-as-written.png', '2021-09-12 09:03:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_order`
--

CREATE TABLE `prescription_order` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `amount` decimal(10,0) NOT NULL DEFAULT 0,
  `hospital` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `disease_type` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription_order`
--

INSERT INTO `prescription_order` (`id`, `company_id`, `prescription_id`, `quantity`, `amount`, `hospital`, `doctor`, `disease_type`, `payment_method`, `order_status`, `order_date`) VALUES
(1, 1, 54, 1, '50', 'Normal Disease', 'test', 'test', 'bkash', 'Pending', '2021-09-27 12:13:45'),
(2, 1, 53, 1, '50', 'Normal Disease', 'Test', 'Test', 'bkash', 'Pending', '2021-09-27 12:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ratting` int(11) NOT NULL,
  `isapproved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratting`
--

CREATE TABLE `ratting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ratting` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `isapproved` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratting`
--

INSERT INTO `ratting` (`id`, `name`, `ratting`, `review`, `pid`, `isapproved`, `time`) VALUES
(39, 'ok', 5, 'ok', 13, 1, '2021-09-26 06:55:15'),
(40, 'Newaz', 3, 'Fair', 12, 1, '2021-09-26 06:55:20'),
(42, 'Newaz', 5, 'Test', 16, 0, '2021-09-27 12:34:59'),
(43, 'Newaz', 4, 'Good Product', 16, 0, '2021-09-27 12:34:45'),
(44, 'Newaz', 5, 'good', 16, 1, '2021-09-27 12:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `contact_no`, `shipping_address`, `registration_date`, `status`, `point`, `token`) VALUES
(1, 'Sayed Nur E Newaz', 'ximnewaz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0123213', 'Test 1 2 3 4', '2021-09-27 12:47:34', 0, 120, '8e921bc85c63cc157bd1c270081f45'),
(4, 'Demo', 'demo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123', NULL, '2021-06-02 14:39:19', 0, 2, 'bc2ea0ea8251054b722290c75a7f4f'),
(6, 'jim', 'jim@gmail.com', '202cb962ac59075b964b07152d234b70', '123', NULL, '2021-08-28 09:15:15', 0, 110, '99db6f514f5508650324d03c22d32a'),
(8, 'Demo', 'Demo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, '2021-09-18 20:34:17', 0, 0, '46a3266dbedbc9c29d8eef931e9c2d');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `posting date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`list_id`, `user_id`, `medicine_id`, `posting date`) VALUES
(15, 1, 10, '2021-06-20 07:50:54'),
(19, 1, 12, '2021-09-12 09:07:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_orders`
--
ALTER TABLE `medicine_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKorders438149` (`user_id`);

--
-- Indexes for table `med_orders_medicine`
--
ALTER TABLE `med_orders_medicine`
  ADD PRIMARY KEY (`order_id`,`medicine_id`),
  ADD KEY `FKproducts_o292795` (`order_id`),
  ADD KEY `FKproducts_o914777` (`medicine_id`);

--
-- Indexes for table `po_pres`
--
ALTER TABLE `po_pres`
  ADD PRIMARY KEY (`prescription_id`,`prescription_order_id`),
  ADD KEY `FKimage_orde830788` (`prescription_id`),
  ADD KEY `FKimage_orde75649` (`prescription_order_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKimages918690` (`user_id`);

--
-- Indexes for table `prescription_order`
--
ALTER TABLE `prescription_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKimage_orde420554` (`company_id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratting`
--
ALTER TABLE `ratting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `FKwishlist308861` (`user_id`),
  ADD KEY `FKwishlist616636` (`medicine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `medicine_orders`
--
ALTER TABLE `medicine_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `prescription_order`
--
ALTER TABLE `prescription_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `ratting`
--
ALTER TABLE `ratting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine_orders`
--
ALTER TABLE `medicine_orders`
  ADD CONSTRAINT `FKorders438149` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `med_orders_medicine`
--
ALTER TABLE `med_orders_medicine`
  ADD CONSTRAINT `FKproducts_o292795` FOREIGN KEY (`order_id`) REFERENCES `medicine_orders` (`id`),
  ADD CONSTRAINT `FKproducts_o914777` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`);

--
-- Constraints for table `po_pres`
--
ALTER TABLE `po_pres`
  ADD CONSTRAINT `FKimage_orde75649` FOREIGN KEY (`prescription_order_id`) REFERENCES `prescription_order` (`id`),
  ADD CONSTRAINT `FKimage_orde830788` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `FKimages918690` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `prescription_order`
--
ALTER TABLE `prescription_order`
  ADD CONSTRAINT `FKimage_orde420554` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FKwishlist308861` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FKwishlist616636` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
