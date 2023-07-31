-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 09:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garment_billing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fname` varchar(50) NOT NULL,
  `admin_lname` varchar(50) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_mobileno` bigint(10) NOT NULL,
  `admin_photo` varchar(100) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `otp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_password`, `admin_mobileno`, `admin_photo`, `address`, `otp`) VALUES
(1, 'Mayuri', 'K', 'mayuri.infospace@gmail.com', '97ae7cdf1eb3ce9d97ef11450cbe80729fa7ac08e2183a92f3b04bc35916c020', 9090909090, 'sfgsfg.jpg', 'Shankar Bhawan, 2nd Floor, Ravi Shankar Marg, Kothrud, Pune, Maharashtra 411038', 7347);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(50) NOT NULL,
  `delete_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`, `delete_status`) VALUES
(1, 'Cotton', 0),
(2, 'Polyster', 0),
(3, 'Silk', 0),
(4, 'Linen', 0),
(5, 'Rayon', 0),
(6, 'Denim', 0),
(7, 'Velvet', 0),
(8, 'Satin', 0),
(9, 'Nylon', 0),
(10, 'Lycra', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_fname` varchar(50) NOT NULL,
  `cust_lname` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_mobile` bigint(10) NOT NULL,
  `cust_add` varchar(500) NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_state` varchar(50) NOT NULL,
  `cdate` date DEFAULT NULL,
  `delete_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_mobile`, `cust_add`, `cust_city`, `cust_state`, `cdate`, `delete_status`) VALUES
(3, 'Rakesh', 'Jain', 'rakesh@gmail.com', 6060707070, '759/8, Off, Prabhat Road, next to Sahyadri Hospital, Deccan Gymkhana, Pune, Maharashtra 411004', 'Pune', 'Maharashtra', '2023-05-15', 0),
(4, 'Yash', 'Joshi', 'yash@gmail.com', 8080708080, 'Laxminarayan Building, 270/3, Jawaharlal Nehru Road, New Timber Market, Kashewadi, Pune, Maharashtra 411042', 'Pune', 'Maharashtra', '2023-05-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `short_title` varchar(500) NOT NULL,
  `footer` text NOT NULL,
  `currency_symbol` text NOT NULL,
  `login_logo` text NOT NULL,
  `website_logo` varchar(500) NOT NULL,
  `background_login_image` text NOT NULL,
  `pay_qrcode` text NOT NULL,
  `terms` longtext NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`id`, `title`, `short_title`, `footer`, `currency_symbol`, `login_logo`, `website_logo`, `background_login_image`, `pay_qrcode`, `terms`, `status`) VALUES
(1, 'Garment Shop Billing Software', 'tfgyfty', 'Garment Shop', 'Rs', '585-5850541_mkaslika-full-logo-fashion-logo-for-men-and__1_-removebg-preview.png', 'logo2.png', 'uniq-launch-b.jpeg', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `ot_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `prize` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `i_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `delete_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_received` double(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `cust_id` int(11) NOT NULL,
  `delete_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `i_id` int(11) NOT NULL,
  `i_prize` double(10,2) NOT NULL,
  `product_sprize` double(10,2) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `submitted_date` date NOT NULL DEFAULT current_timestamp(),
  `cate_id` int(11) NOT NULL,
  `delete_status` tinyint(2) NOT NULL,
  `openning_stock` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='product';

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`i_id`, `i_prize`, `product_sprize`, `i_name`, `submitted_date`, `cate_id`, `delete_status`, `openning_stock`) VALUES
(1, 120.00, 150.00, 'Cotton King', '0000-00-00', 1, 0, 60),
(2, 180.00, 230.00, 'Raymond', '2023-05-12', 4, 0, 61),
(3, 80.00, 100.00, 'Kumar', '2023-05-12', 5, 0, 84),
(4, 260.00, 320.00, 'Luis Vuitton', '2023-05-12', 6, 0, 88),
(5, 320.00, 380.00, 'Supreme Clothing', '2023-05-12', 7, 0, 89),
(6, 340.00, 420.00, 'Gucci Cloth ', '2023-05-12', 2, 0, 0),
(7, 420.00, 500.00, 'Peter England', '2023-05-12', 10, 0, 85),
(8, 430.00, 500.00, 'Vardhaman Textiles', '2023-05-12', 8, 0, 83),
(9, 450.00, 510.00, 'Tommy Hilfiger', '2023-05-12', 9, 0, 84),
(10, 460.00, 530.00, 'Bombay Fashion', '2023-05-12', 3, 0, 89);

-- --------------------------------------------------------

--
-- Table structure for table `purchace_order`
--

CREATE TABLE `purchace_order` (
  `porder_id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `prize` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `sup_id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `delete_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `sup1` int(50) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `itemquantity` int(10) NOT NULL,
  `itemprice` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `sid` int(10) NOT NULL,
  `openning_stock` int(50) NOT NULL,
  `delete_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `saleid` int(10) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `sale_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cust_id` int(11) NOT NULL,
  `delete_status` int(2) NOT NULL,
  `discount` double(20,2) NOT NULL,
  `gst` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`saleid`, `invoice_no`, `amount`, `sale_date`, `cust_id`, `delete_status`, `discount`, `gst`) VALUES
(1, 'VXCHAJQ', '5540.4', '2023-05-15 12:29:30', 3, 0, 0.00, 14.00),
(2, 'NQJP6AL', '10966.8', '2023-05-15 12:31:31', 4, 0, 0.00, 14.00);

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE `sale_item` (
  `id` int(100) NOT NULL,
  `sale_id` int(100) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `itemquantity` double(10,2) NOT NULL,
  `itemprice` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`id`, `sale_id`, `itemname`, `itemquantity`, `itemprice`, `total`) VALUES
(1, 1, '1', 59.60, 150.00, 2100.00),
(2, 1, '2', 60.70, 230.00, 2760.00),
(3, 2, '3', 83.50, 100.00, 1600.00),
(4, 2, '4', 87.70, 320.00, 3840.00),
(5, 2, '5', 88.70, 380.00, 4180.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `build_date` date NOT NULL DEFAULT current_timestamp(),
  `sub_total` double(10,2) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `gst` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `final_total` double(10,2) NOT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `submited_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `build_date`, `sub_total`, `sup_id`, `gst`, `discount`, `final_total`, `delete_status`, `submited_date`) VALUES
(1, '2023-05-15', 30000.00, 3, 14.00, 0.00, 25800.00, 0, '2023-05-15'),
(2, '2023-05-15', 66000.00, 3, 14.00, 5.00, 53922.00, 0, '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchce_quantity` int(11) NOT NULL,
  `rate` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `i_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_items`
--

INSERT INTO `stock_items` (`id`, `quantity`, `purchce_quantity`, `rate`, `total`, `i_id`, `stock_id`) VALUES
(1, 100, 100, 120.00, 12000.00, 1, 1),
(2, 100, 100, 180.00, 18000.00, 2, 1),
(3, 100, 100, 80.00, 8000.00, 3, 2),
(4, 100, 100, 320.00, 32000.00, 5, 2),
(5, 100, 100, 260.00, 26000.00, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sup_id` int(11) NOT NULL,
  `sup_fname` varchar(50) NOT NULL,
  `sup_lname` varchar(50) NOT NULL,
  `sup_email` varchar(50) NOT NULL,
  `sup_mobile` bigint(11) NOT NULL,
  `sup_add` varchar(500) NOT NULL,
  `sup_city` varchar(11) NOT NULL,
  `sup_state` varchar(11) NOT NULL,
  `delete_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sup_id`, `sup_fname`, `sup_lname`, `sup_email`, `sup_mobile`, `sup_add`, `sup_city`, `sup_state`, `delete_status`) VALUES
(3, 'Radhika', 'Gandhi', 'radhika@gmail.com', 7070707070, '2nd Floor, Opposite Hotel Central Park, Apte Road, near HDFC Bank, Deccan Gymkhana, Pune, Maharashtra 411005', 'Pune', 'Maharashtra', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `smtp_server` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `stmp_port` varchar(255) NOT NULL,
  `smtp_type` varchar(255) NOT NULL,
  `keywords` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`smtp_server`, `smtp_username`, `smtp_password`, `stmp_port`, `smtp_type`, `keywords`) VALUES
('mail.raghavinfocom.com', 'no_reply@raghavinfocom.com', 'zo?n6BDVGtdo', '587', 'tls', 'sadad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `manage_website`
--
ALTER TABLE `manage_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`ot_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `purchace_order`
--
ALTER TABLE `purchace_order`
  ADD PRIMARY KEY (`porder_id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`sup1`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleid`);

--
-- Indexes for table `sale_item`
--
ALTER TABLE `sale_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `ot_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchace_order`
--
ALTER TABLE `purchace_order`
  MODIFY `porder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `sup1` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `saleid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_item`
--
ALTER TABLE `sale_item`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
