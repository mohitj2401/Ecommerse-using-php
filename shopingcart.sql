-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2020 at 07:14 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'shi@gmail.com', 'shi'),
(2, 'lian@gmail.com', 'lian');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_title` text,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'Dell'),
(3, 'Samsung'),
(4, 'Lenovo'),
(5, 'Asus'),
(6, 'Apple'),
(7, 'Dell');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qry` int(10) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Mobiles'),
(2, 'Tablets'),
(3, 'Tvs'),
(4, 'Cameras'),
(5, 'gameing laptop');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_image` text NOT NULL,
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_coun` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_phno` int(10) NOT NULL,
  `customer_add` text NOT NULL,
  `customer_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_image`, `customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_coun`, `customer_city`, `customer_phno`, `customer_add`, `customer_ip`) VALUES
('2017-11-02_19-34-28_103.jpg', 4, 'Mohi', 'mohit@gujn.vvo', 'mohit786@', 'india', 'zdgfgvjbhk', 2147483647, 'zsfdxgfchgmbn,', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

DROP TABLE IF EXISTS `customer_order`;
CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `total_product` int(100) NOT NULL,
  `order_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `total_product`, `order_status`) VALUES
(6, 4, 1200, 675792800, 1, 'pending'),
(7, 4, 2400, 659036197, 3, 'pending'),
(8, 4, 400, 984795805, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

DROP TABLE IF EXISTS `pending_orders`;
CREATE TABLE IF NOT EXISTS `pending_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `order_status` text NOT NULL,
  `order_date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`order_id`, `customer_id`, `invoice_no`, `product_id`, `qty`, `order_status`, `order_date`) VALUES
(1, 4, 675792800, 3, 3, 'pending', '2020-04-04 11:18:12'),
(2, 4, 659036197, 4, 2, 'pending', '2020-04-04 11:19:38'),
(3, 4, 984795805, 2, 1, 'pending', '2020-04-04 13:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) NOT NULL,
  `brand_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_title` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_des` text NOT NULL,
  `product_status` text NOT NULL,
  `product_keywords` tinytext,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `brand_id`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_des`, `product_status`, `product_keywords`) VALUES
(7, 1, 2, 'gvhb', 'download.jpg', '02z7CXr7oYqrcleufNp2rfb-30.fit_lpad.size_624x364.v_1573180988.jpg', 'HP15S-dr0002TU-8i5-8-1-256-W10-MS-FHD-laptop-491570858-i-1-1200Wx1200H-300Wx300H.jpg', 623, 'hjkm', 'On', 'vgvhbn'),
(8, 1, 2, 'cfyvgbhjkn', '02z7CXr7oYqrcleufNp2rfb-30.fit_lpad.size_624x364.v_1573180988.jpg', 'download.jpg', 'HP15S-dr0002TU-8i5-8-1-256-W10-MS-FHD-laptop-491570858-i-1-1200Wx1200H-300Wx300H.jpg', 462333, '<p>xxchvjbhknmk</p>', 'On', 'hp,laptop,gameing'),
(9, 1, 2, 'cfyvgbhjkn', '02z7CXr7oYqrcleufNp2rfb-30.fit_lpad.size_624x364.v_1573180988.jpg', 'download.jpg', 'HP15S-dr0002TU-8i5-8-1-256-W10-MS-FHD-laptop-491570858-i-1-1200Wx1200H-300Wx300H.jpg', 462333, '<p>cg vhbnm,</p>', 'On', 'hp,laptop,gameing'),
(10, 1, 2, 'cfyvgbhjkn', '02z7CXr7oYqrcleufNp2rfb-30.fit_lpad.size_624x364.v_1573180988.jpg', 'download.jpg', 'HP15S-dr0002TU-8i5-8-1-256-W10-MS-FHD-laptop-491570858-i-1-1200Wx1200H-300Wx300H.jpg', 462333, '<p>&nbsp;hbnm,.</p>', 'On', 'hp,laptop,gameing');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
