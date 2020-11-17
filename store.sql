-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 10:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`) VALUES
(2, 'Engine', '2020-10-30'),
(5, 'Outfitters', '2020-10-30'),
(7, 'HP', '2020-11-16'),
(8, 'Logitech', '2020-11-16'),
(9, 'Dell', '2020-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand` int(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `brand`, `created_at`) VALUES
(2, 'Cloth', 0, '2020-10-30'),
(4, 'Accessories', 0, '2020-10-30'),
(6, 'Laptop', 7, '2020-11-16'),
(7, 'LCDs', 9, '2020-11-16'),
(8, 'Men Clothes', 5, '2020-11-16'),
(10, 'Accessories', 7, '2020-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `dropdown_value`
--

CREATE TABLE `dropdown_value` (
  `dropdown_single` varchar(255) NOT NULL,
  `dropdown_multi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dropdown_value`
--

INSERT INTO `dropdown_value` (`dropdown_single`, `dropdown_multi`) VALUES
('Computer Science Engineering', 'N;'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Electronics and Comm. Engineering', 'a:3:{i:0;s:1:\"C\";i:1;s:3:\"C++\";i:2;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:3:{i:0;s:1:\"C\";i:1;s:3:\"C++\";i:2;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:3:{i:0;s:1:\"C\";i:1;s:3:\"C++\";i:2;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:3:{i:0;s:1:\"C\";i:1;s:3:\"C++\";i:2;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:4:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";i:2;s:4:\"JAVA\";i:3;s:8:\"DATABASE\";}'),
('Computer Science Engineering', 'a:1:{i:0;s:8:\"DATABASE\";}'),
('Computer Science Engineering', 'a:5:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";i:2;s:4:\"JAVA\";i:3;s:8:\"DATABASE\";i:4;s:3:\"PHP\";}'),
('Computer Science Engineering', 'a:5:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";i:2;s:4:\"JAVA\";i:3;s:8:\"DATABASE\";i:4;s:3:\"PHP\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:3:{i:0;s:1:\"C\";i:1;s:3:\"C++\";i:2;s:6:\"ORACLE\";}'),
('Electronics and Comm. Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:1:{i:0;s:3:\"C++\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}'),
('Computer Science Engineering', 'a:2:{i:0;s:1:\"C\";i:1;s:6:\"ORACLE\";}');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `brand` int(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `subcategory` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `brand`, `category`, `subcategory`, `status`, `created_at`) VALUES
(17, 'hp corei7 7th gen', 50000, 5, 7, '6', '7', 0, '2020-11-16'),
(18, 'blue men jeans', 3000, 15, 5, '8', '5', 0, '2020-11-16'),
(19, 'HP wireless mouse', 2500, 20, 7, '10', '8', 0, '2020-11-16'),
(20, 'Dell 24\'\' LCD Black', 5000, 10, 9, '7', '6', 0, '2020-11-16'),
(21, 'Black men jeans', 4000, 20, 5, '8', '5', 0, '2020-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand` int(50) NOT NULL,
  `category` int(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `brand`, `category`, `created_at`) VALUES
(5, 'Jeans', 5, 8, '2020-11-16'),
(6, '24\'\' LCD', 9, 7, '2020-11-16'),
(7, 'Corei7 laptop', 7, 6, '2020-11-16'),
(8, 'Computer Accessories', 7, 10, '2020-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$YmjdGVas0sc8M6.zZvrW5Oxx7qGhuaMQbQa.iVhfU/UP4eD.WYSUu', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1603813240, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(3, '::1', NULL, '$2y$10$pULvSa/G1/58p94Kgy4Inuc17blkPkKNYAjyRZRUF/BXDYvZaGs6.', 'hamza@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1603805832, 1605518709, 1, 'Muhammad', 'Hamza', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
