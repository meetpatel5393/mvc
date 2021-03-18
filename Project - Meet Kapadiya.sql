-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 06:35 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybercom1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `userName`, `password`, `status`, `createdDate`) VALUES
(25, 'Meet Kapadiya', 'mk', 1, '2021-03-07 14:46:18.000000'),
(29, 'Krunal Ambaliya', 'mk', 0, '2021-03-13 19:19:48.000000'),
(34, 'Raj kandolia', 'mk', 1, '2021-03-16 19:52:54.000000');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(64) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(6, 'product', 'color', 'color', 'select', 'varchar', 2, 'abc'),
(7, 'product', 'brand', 'brand', 'select', 'varchar', 1, 'abc'),
(8, 'product', 'type', 'type', 'text', 'varchar', 1, 'abc'),
(10, 'product', 'type1', 'type1', 'radio', 'varchar', 2, 'mk'),
(12, 'product', 'material', 'material', 'select', 'varchar', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `attributeoption`
--

CREATE TABLE `attributeoption` (
  `optionId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributeoption`
--

INSERT INTO `attributeoption` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(24, 'brand 2', 7, 2),
(25, 'brand 3', 7, 3),
(26, 'brand 4', 7, 4),
(27, 'brand 1', 7, 1),
(29, 'black', 6, 1),
(30, 'red', 6, 2),
(31, 'yellow', 6, 3),
(36, 'purple', 6, 5),
(37, 'r3', 10, 2),
(38, 'r2', 10, 2),
(39, 'r1', 10, 1),
(40, 'green', 6, 5),
(41, 'material 2', 12, 1),
(42, 'material 3', 12, 5),
(43, 'material 4', 12, 3),
(44, 'material 5', 12, 4),
(45, 'material 1', 12, 2),
(46, 'color1', 6, 5),
(47, 'pink', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parentId` int(50) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `status`, `description`, `parentId`, `path`) VALUES
(1, 'Living Room Furniture', 1, 'Living Room Furniture			', 0, '1'),
(2, 'Sofas & Loveseats', 1, 'Sofas & Loveseats			', 1, '1=2'),
(3, 'Sectionals', 1, 'Sectionals', 1, '1=3'),
(4, 'Accent Chairs', 1, 'Accent Chairs', 1, '1=4'),
(5, 'End & Side Tables', 1, 'End & Side Tables', 1, '1=5'),
(6, 'Coffee Tables', 1, 'Coffee Tables', 1, '1=6'),
(7, 'TV Stands', 1, 'TV Stands', 1, '1=7'),
(8, 'Chairs & Recliners', 1, 'Chairs & Recliners', 1, '1=8'),
(9, 'Futons & Daybeds', 1, 'Futons & Daybeds', 1, '1=9'),
(10, 'Living Room Sets', 1, 'Living Room Sets', 1, '1=10'),
(11, 'Chaise Lounges', 1, 'Chaise Lounges', 1, '1=11'),
(12, 'Ottomans & Poufs', 1, 'Ottomans & Poufs', 1, '1=12'),
(13, 'Cabinets & Chests', 1, 'Cabinets & Chests					', 1, '1=13'),
(14, 'Bedroom Furniture', 1, 'Bedroom Furniture', 0, '14'),
(15, 'Beds', 1, 'Beds					', 14, '14=15'),
(16, 'Dressers', 1, 'Dressers', 14, '14=16'),
(17, 'Nightstands', 1, 'Nightstands', 14, '14=17'),
(18, 'Headboards', 1, 'Headboards', 14, '14=18'),
(19, 'Bed Frames', 1, 'Bed Frames', 14, '14=19'),
(20, 'Bedroom Sets', 1, 'Bedroom Sets', 14, '14=20'),
(21, 'Mattresses & Foundations', 1, 'Mattresses & Foundations', 14, '14=21'),
(22, 'Kitchen & Dining', 1, 'Kitchen & Dining', 0, '22'),
(23, 'Dining Tables', 1, 'Dining Tables', 22, '22=23'),
(24, 'Dining Room Sets', 1, 'Dining Room Sets', 22, '22=24'),
(25, 'Bar Stools', 1, 'Bar Stools', 22, '22=25'),
(26, 'Dining Chairs', 1, 'Dining Chairs', 22, '22=26'),
(27, 'Kitchen Islands', 1, 'Kitchen Islands', 22, '22=27'),
(28, 'Sideboards & Buffets', 1, 'Sideboards & Buffets', 22, '22=28'),
(29, 'Office', 1, 'Office					', 0, '29'),
(30, 'Desks', 1, 'Desks					', 29, '29=30'),
(31, 'Bookcases', 1, 'Bookcases', 29, '29=31'),
(32, 'File Cabinets', 1, 'File Cabinets', 29, '29=32'),
(33, 'Office Chairs', 1, 'Office Chairs', 29, '29=33'),
(34, 'Room Dividers', 1, 'Room Dividers', 29, '29=34'),
(35, 'Laptop Tables & Stands', 1, 'Laptop Tables & Stands', 29, '29=35'),
(36, 'Entry & Mudroom', 1, 'Entry & Mudroom					', 0, '36'),
(37, 'Console Tables', 1, 'Console Tables					', 36, '36=37'),
(38, 'Storage Benches', 1, 'Storage Benches					', 36, '36=38'),
(39, 'Hall Trees', 1, 'Hall Trees', 36, '36=39'),
(40, 'Coat Racks', 1, 'Coat Racks', 36, '36=40'),
(41, 'Game Room Furniture', 1, 'Game Room Furniture					', 0, '41'),
(42, 'Bean Bag Chairs', 1, 'Bean Bag Chairs', 41, '41=42'),
(43, 'Gaming Chairs', 1, 'Gaming Chairs', 41, '41=43'),
(44, 'Pool Tables ', 1, 'Pool Tables', 41, '41=44'),
(45, 'Outdoor & Patio Furniture', 1, 'Outdoor & Patio Furniture', 0, '45'),
(46, 'Outdoor Lounge Chairs', 1, 'Outdoor Lounge Chairs', 45, '45=46'),
(47, 'Patio Dining Sets', 1, 'Patio Dining Sets', 45, '45=47'),
(48, 'Adirondack Chairs', 1, 'Adirondack Chairs', 45, '45=48'),
(49, 'Outdoor Seating & Patio Chairs', 1, 'Outdoor Seating & Patio Chairs', 45, '45=49'),
(50, 'Patio Rocking Chairs & Gliders', 1, 'Patio Rocking Chairs & Gliders', 45, '45=50'),
(51, 'Porch Swings', 1, 'Porch Swings', 45, '45=51'),
(52, 'Hammocks', 1, 'Hammocks', 45, '45=52'),
(53, 'Patio Conversation Sets', 1, 'Patio Conversation Sets', 45, '45=53'),
(54, 'Patio Bar Furniture', 1, 'Patio Bar Furniture', 45, '45=54'),
(55, 'Outdoor Cooking & Tabletop', 1, 'Outdoor Cooking & Tabletop', 0, '55'),
(56, 'Gas Grills', 1, 'Gas Grills					', 55, '55=56'),
(57, 'Charcoal Grills', 1, 'Charcoal Grills					', 55, '55=57'),
(58, 'Outdoor Kitchens', 1, 'Outdoor Kitchens					', 55, '55=58'),
(59, 'Coolers', 1, 'Coolers					', 55, '55=59'),
(60, 'Outdoor Shades', 1, 'Outdoor Shades					', 0, '60'),
(61, 'Gazebos', 1, 'Gazebos					', 60, '60=61'),
(62, 'Outdoor Umbrellas', 1, 'Outdoor Umbrellas					', 60, '60=62'),
(63, 'Pergolas', 1, 'Pergolas					', 60, '60=63'),
(64, 'Canopies', 1, 'Canopies', 60, '60=64'),
(65, 'Outdoor Décor', 1, 'Outdoor Décor					', 0, '65'),
(66, 'Outdoor Rugs', 1, 'Outdoor Rugs					', 65, '65=66'),
(67, 'Statues & Sculptures', 1, 'Statues & Sculptures					', 65, '65=67'),
(68, 'Outdoor Pillows & Cushions', 1, 'Outdoor Pillows & Cushions					', 65, '65=68'),
(69, 'Mailboxes', 1, 'Mailboxes					', 65, '65=69'),
(70, 'Bird Baths', 1, 'Bird Baths					', 65, '65=70'),
(71, 'Garden', 1, 'Garden					', 0, '71'),
(72, 'Planters', 1, 'Planters					', 71, '71=72'),
(73, 'Trellises', 1, 'Trellises					', 71, '71=73'),
(74, 'Greenhouses', 1, 'Greenhouses					', 71, '71=74'),
(75, 'Outdoor Lighting', 1, 'Outdoor Lighting					', 0, '75'),
(76, 'Hot Tubs & Saunas', 1, 'Hot Tubs & Saunas					', 0, '76'),
(77, 'Backyard Play', 1, 'Backyard Play					', 0, '77'),
(78, 'Trampolines', 1, 'Trampolines					', 77, '77=78'),
(79, 'Swing Sets', 1, 'Swing Sets					', 77, '77=79'),
(80, 'Sandboxes', 1, 'Sandboxes					', 77, '77=80'),
(81, 'Outdoor Games', 1, 'Outdoor Games					', 77, '77=81'),
(82, 'Outdoor Heating & Cooling', 1, 'Outdoor Heating & Cooling					', 0, '82'),
(83, 'Firepits', 1, 'Firepits					', 82, '82=83'),
(84, 'Chimineas', 1, 'Chimineas					', 82, '82=84'),
(85, 'Garage & Outdoor Organization', 1, 'Garage & Outdoor Organization					', 0, '85'),
(86, 'Sheds', 1, 'Sheds					', 85, '85=86'),
(87, 'Deck Boxes & Patio Storage', 1, 'Deck Boxes & Patio Storage					', 85, '85=87'),
(88, 'Outdoor Fencing & Flooring', 1, 'Outdoor Fencing & Flooring					', 0, '88');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `pageId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageId`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(1, 'contactUs', 'contactUs', '', 1, '2021-03-11 08:45:24.000000'),
(12, 'page 1', 'page 1', '<p>this is page 1</p>\n\n<p><strong>this is header of this page</strong></p>\n', 1, '2021-03-14 10:36:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` date NOT NULL,
  `updatedDate` date NOT NULL,
  `groupId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`, `groupId`) VALUES
(61, 'meet', 'kapadiya', 'meetpatel5393@gmail.com', '', 1, '2021-03-03', '2021-03-10', 26),
(62, 'krunal', 'ambaliya', 'k.ambaliya000@gmail.com', 'km', 0, '2021-03-03', '2021-03-11', NULL),
(63, 'raj', 'kandolia', 'raj@gmail.com', '', 1, '2021-03-03', '2021-03-17', 26);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `customerId` int(11) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zipcode` int(10) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `addressType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`customerId`, `address`, `city`, `state`, `zipcode`, `country`, `addressType`) VALUES
(61, 'gram panchayat nagar street number one , veraval main road , behind gram panchayat , veraval-shapar', 'veraval shapar', 'Gujarat', 360024, 'India', 'billing'),
(61, 'mavdi', 'rajkot', 'gujarat', 360024, 'India', 'shipping'),
(62, 'gram panchayat nagar street number one , veraval main road , behind gram panchayat , veraval-shapar', 'veraval shapar', 'Gujarat', 24003658, 'India', 'billing'),
(62, 'mavdi', 'rajkot', 'gujarat', 5252552, 'India', 'shipping'),
(63, 'gram panchayat nagar street number one , veraval main road , behind gram panchayat , veraval-shapar', 'veraval shapar', 'Gujarat', 112233, 'India', 'billing'),
(63, 'mavdi', 'rajkot', 'gujarat', 360024, 'India', 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `createdDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `status`, `createdDate`) VALUES
(26, 'Retail', 0, '2021-03-10 06:14:00.000000'),
(28, 'Group 3', 1, '2021-03-10 06:14:00.000000'),
(29, 'Group 4', 1, '2021-03-10 06:23:00.000000'),
(37, 'group 5', 1, '2021-03-16 06:41:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group_price`
--

CREATE TABLE `customer_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `groupPrice` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group_price`
--

INSERT INTO `customer_group_price` (`entityId`, `productId`, `groupId`, `groupPrice`) VALUES
(1, 123, 26, 2500),
(2, 123, 29, 1500),
(3, 108, 29, 550),
(4, 123, 28, 230),
(8, 123, 27, 500),
(9, 108, 28, 230),
(10, 108, 27, 0),
(11, 110, 29, 2800),
(12, 110, 28, 2500),
(13, 110, 27, 0),
(14, 117, 29, 500),
(15, 117, 28, 200),
(16, 117, 26, 300),
(17, 117, 27, 600),
(18, 125, 26, 3000),
(19, 125, 27, 4000),
(20, 125, 28, 5000),
(21, 125, 29, 6000),
(22, 126, 26, 541),
(23, 126, 27, 654),
(24, 126, 28, 654),
(25, 126, 29, 654),
(26, 127, 26, 12),
(27, 127, 27, 332),
(28, 127, 28, 6498),
(29, 127, 29, 652498),
(30, 127, 30, 862494),
(31, 131, 26, 0),
(32, 131, 27, 0),
(33, 131, 28, 0),
(34, 131, 29, 0),
(35, 131, 26, 0),
(36, 131, 27, 0),
(37, 131, 28, 0),
(38, 131, 29, 0),
(39, 131, 26, 0),
(40, 131, 27, 0),
(41, 131, 28, 0),
(42, 131, 29, 0),
(43, 131, 26, 0),
(44, 131, 27, 0),
(45, 131, 28, 0),
(46, 131, 29, 0),
(47, 132, 26, 100),
(48, 132, 27, 200),
(49, 132, 28, 300),
(50, 132, 29, 400),
(51, 108, 26, 250),
(52, 109, 26, 4),
(53, 109, 28, 5),
(54, 109, 29, 6),
(55, 109, 26, 0),
(56, 109, 28, 0),
(57, 109, 29, 0),
(58, 133, 26, 21),
(59, 133, 28, 21),
(60, 133, 29, 21),
(61, 134, 26, 565),
(62, 134, 28, 656),
(63, 134, 29, 56),
(64, 134, 35, 565),
(65, 108, 35, 300),
(66, 135, 26, 0),
(67, 135, 28, 0),
(68, 135, 29, 0),
(69, 135, 37, 0),
(70, 108, 37, 150),
(71, 138, 26, 2),
(72, 138, 28, 22),
(73, 138, 29, 2),
(74, 138, 37, 2),
(75, 139, 26, 120),
(76, 139, 28, 320),
(77, 139, 29, 502),
(78, 139, 37, 420),
(79, 109, 37, 7),
(80, 110, 26, 3000),
(81, 110, 37, 3500),
(82, 140, 26, 250),
(83, 140, 28, 300),
(84, 140, 29, 450),
(85, 140, 37, 800),
(86, 141, 26, 35),
(87, 141, 28, 40),
(88, 141, 29, 20),
(89, 141, 37, 60),
(90, 143, 26, 45000),
(91, 143, 28, 53000),
(92, 143, 29, 80000),
(93, 143, 37, 45000),
(94, 144, 26, 450),
(95, 144, 28, 650),
(96, 144, 29, 600),
(97, 144, 37, 800);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `code`, `description`, `status`, `createdDate`) VALUES
(41, 'Cod', 'DMETYOEAPNN', 'codksdhfhu', 'Paid', '2021-03-14 18:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(100) NOT NULL,
  `sku` int(8) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` date NOT NULL,
  `updatedDate` date NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `type1` varchar(50) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`, `color`, `brand`, `type`, `type1`, `material`) VALUES
(140, 1234, 'mouse', 500, 0, 2, 'mouse', 1, '2021-03-17', '2021-03-17', 'red', 'brand 2', 'abc', 'r1', 'material 4'),
(141, 321, 'pen', 50, 0, 50, 'pen', 1, '2021-03-17', '2021-03-17', 'red', 'brand 2', 'm', 'r3', 'material 4'),
(143, 543, 'laptop', 50000, 20, 50, 'laptop', 1, '2021-03-17', '2021-03-17', 'red', 'brand 2', '12', 'r2', 'material 4'),
(144, 56, 'book', 500, 0, 100, 'book', 1, '2021-03-17', '2021-03-17', 'red', 'brand 3', '450', 'r1', 'material 1');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `primaryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`primaryId`, `productId`, `categoryId`) VALUES
(5, 140, 1),
(6, 141, 2),
(7, 143, 6),
(8, 144, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `productId` int(50) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `label` varchar(200) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `gallery` varchar(10) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`productId`, `imageName`, `label`, `small`, `thumb`, `base`, `gallery`) VALUES
(140, '1860069_140_Mc_Pinto.116_muziek mobile_YURkQmFc.jpg', '0', 0, 1, 0, 'off'),
(140, '71720683_140_Erniespezial_Autumn Sounding_YURkQWRc.jpg', '0', 0, 0, 1, 'on'),
(141, '40978685_141_Andres Moreno_Lov-e_YkZjQGQ.jpg', '0', 1, 0, 1, 'on'),
(142, '94204334_142_Brand Logo (13).jpg', '0', 1, 0, 0, 'on'),
(143, '68323718_143_Brand Logo (13).jpg', '0', 0, 1, 0, 'on'),
(144, '10863647_144_Brand Logo (11).jpg', '0', 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `methodId` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(11, 'shipping1', 'SEHPPSPSINGROCCI', '1200', 'shipping 1', 'shipped', '2021-02-19'),
(25, 'shipping2', 'PHSSONRSPPGCIIEC', '300', 'shipping 2', 'shipped', '2021-03-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `customer_group_price`
--
ALTER TABLE `customer_group_price`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`primaryId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attributeoption`
--
ALTER TABLE `attributeoption`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer_group_price`
--
ALTER TABLE `customer_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `primaryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD CONSTRAINT `attributeoption_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
