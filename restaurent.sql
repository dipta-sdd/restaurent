-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2025 at 12:14 PM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurent`
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Foods', NULL, NULL, NULL, NULL, NULL),
(2, 'Drinks', NULL, NULL, NULL, NULL, NULL);

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `subcategory_id`, `name`, `description`, `price`, `image`, `allergens`, `dietary_options`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(17, 1, 'Vegetable Curry', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(18, 1, 'Mushroom Bhaji', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(19, 1, 'Cauliflower Bhaji', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(20, 1, 'Aloo Sag', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(21, 1, 'Bombay Potato', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(22, 1, 'Spinach Bhaji', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(23, 1, 'Bhindi Bhaji (Okra)', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(24, 1, 'Brinjal Bhaji (Aubergine)', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(25, 1, 'Tarka Dal', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(26, 1, 'Vegetable Bhaji (Dry)', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(27, 1, 'Aloo Gobi', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(28, 1, 'Sag Paneer', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(29, 1, 'Onion Bhaji', NULL, 3.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(30, 1, 'Chana Massala', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(31, 2, 'Plain Rice', NULL, 2.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(32, 2, 'Pilau Rice', NULL, 3.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(33, 2, 'Special Fried Rice', NULL, 3.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(34, 2, 'Mushroom Rice', NULL, 3.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(35, 2, 'Vegetable Rice', NULL, 3.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(36, 2, 'Plain Fried Rice', NULL, 3.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(37, 2, 'Coconut Rice', NULL, 3.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(38, 2, 'Plain Naan', NULL, 2.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(39, 2, 'Garlic Naan', NULL, 3.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(40, 2, 'Peshwari Naan', NULL, 3.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(41, 2, 'Kulcha Naan', NULL, 3.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(42, 2, 'Cheese Naan', NULL, 3.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(43, 2, 'Keema Naan', NULL, 3.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(44, 2, 'Stuffed Naan', NULL, 3.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(45, 2, 'Plain Parata', NULL, 2.90, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(46, 2, 'Stuffed Parata', NULL, 3.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(47, 2, 'Chapati', NULL, 1.60, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(48, 2, 'Puree', NULL, 1.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(49, 2, 'Roti', NULL, 2.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(50, 2, 'Papadom (Plain/Spicy)', NULL, 0.80, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(51, 2, 'Various Chutney', NULL, 0.60, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(52, 3, 'Chicken Tikka', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(53, 3, 'Lamb Tikka', NULL, 4.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(54, 3, 'Tandoori Chicken', NULL, 4.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(55, 3, 'Rashmee Kebab', NULL, 4.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(56, 3, 'Sheek Kebab', NULL, 4.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(57, 3, 'Shamee Kebab', NULL, 4.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(58, 3, 'Mixed Kebab', NULL, 4.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(59, 3, 'Bengal Platter (for two)', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(60, 3, 'Meat Puree', NULL, 4.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(61, 3, 'Onion Bhaji', NULL, 3.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(62, 3, 'Prawn Puree', NULL, 4.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(63, 3, 'King Prawn Butterfly', NULL, 5.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(64, 3, 'King Prawn Puree', NULL, 6.60, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(65, 3, 'Chicken Chat Puree', NULL, 4.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(66, 4, 'Chicken Tikka', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(67, 4, 'Lamb Tikka', NULL, 8.60, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(68, 4, 'Tandoori Chicken (2 pieces)', NULL, 8.60, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(69, 4, 'Chicken Shashlik', NULL, 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(70, 4, 'Lamb Shashlik', NULL, 10.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(71, 4, 'Tandoori Mix Grill', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(72, 4, 'Tandoori King Prawn', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(73, 5, 'Chicken Biryani', NULL, 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(74, 5, 'Lamb Biryani', NULL, 10.25, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(75, 5, 'Prawn Biryani', NULL, 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(76, 5, 'King Prawn Biryani', NULL, 12.00, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(77, 5, 'Bengal Special Biryani', NULL, 12.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(78, 6, 'Chicken Tikka Masala', NULL, 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(79, 6, 'Meat Tikka Masala', NULL, 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(80, 6, 'King Prawn Masala', NULL, 12.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(81, 6, 'Lamb Passanda', NULL, 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(82, 6, 'Chicken Tikka Saag', NULL, 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(83, 6, 'Chicken Passanda', NULL, 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(84, 6, 'Chicken Jalfreizi', NULL, 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(85, 6, 'King Prawn Jalfreizi', NULL, 12.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(86, 6, 'Korai Chicken', NULL, 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(87, 6, 'Korai Lamb', NULL, 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(88, 6, 'Murog Makani', NULL, 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(89, 7, 'Achar Gosth', 'Unique Lamb dish cooked with diced onions, tomatoes and garlic with a tangy twist in a medium sauce', 9.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(90, 7, 'Garlic Chilli Chicken (dry)', 'Semi-dry dish prepared with fresh onions, green peppers and fresh green chillies', 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(91, 7, 'Chicken Chilli Masala', 'Hot and spicy offering cooked in a fresh garlic and chilli sauce with green chillies', 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(92, 7, 'Chicken Bombay', 'Barbequed pieces of marinated chicken infused in medium spiced sauce with boiled egg and potato', 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(93, 7, 'Hash Makani', 'Tender pieces of marinated duck cooked in a lightly spiced minced lamb sauce', 10.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(94, 7, 'Hash Jalfreizi', 'Barbequed duck prepared in a spicy sauce of onions, capsicum, fresh ginger and green chillies', 10.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(95, 7, 'Chicken or Lamb Naga', 'Slightly hot spiced bhuna style dish cooked with bonnet pepper', 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(96, 7, 'Mango Chicken', 'Tender pieces of chicken braised in spinach and onions all in a spicy but sweet Mango sauce', 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(97, 7, 'Dharjiling Special', 'Chicken or lamb, cooked in garlic, ginger, turmeric, garam masala, lots of tomatoes, peppers, onions & garnished with dry red chillies', 9.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(98, 7, 'Butter Chicken', 'A simple and mouth watering mild dish, with a lovely thick sauce, blended with butter', 8.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(99, 8, 'Chicken Korma', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(100, 8, 'Lamb Korma', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(101, 8, 'Prawn Korma', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(102, 8, 'King Prawn Korma', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(103, 8, 'Vegetable Korma', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(104, 8, 'Chicken Bhuna', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(105, 8, 'Lamb Bhuna', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(106, 8, 'Prawn Bhuna', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(107, 8, 'King Prawn Bhuna', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(108, 8, 'Vegetable Bhuna', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(109, 8, 'Chicken Madras', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(110, 8, 'Lamb Madras', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(111, 8, 'Prawn Madras', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(112, 8, 'King Prawn Madras', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(113, 8, 'Vegetable Madras', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(114, 8, 'Chicken Vindaloo', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(115, 8, 'Lamb Vindaloo', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(116, 8, 'Prawn Vindaloo', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(117, 8, 'King Prawn Vindaloo', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(118, 8, 'Vegetable Vindaloo', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(119, 8, 'Chicken Pathia', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(120, 8, 'Lamb Pathia', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(121, 8, 'Prawn Pathia', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(122, 8, 'King Prawn Pathia', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(123, 8, 'Vegetable Pathia', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(124, 8, 'Chicken Dupiaza', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(125, 8, 'Lamb Dupiaza', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(126, 8, 'Prawn Dupiaza', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(127, 8, 'King Prawn Dupiaza', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(128, 8, 'Vegetable Dupiaza', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(129, 8, 'Chicken Roganjosh', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(130, 8, 'Lamb Roganjosh', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(131, 8, 'Prawn Roganjosh', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(132, 8, 'King Prawn Roganjosh', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(133, 8, 'Vegetable Roganjosh', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(134, 8, 'Chicken Dansak', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(135, 8, 'Lamb Dansak', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(136, 8, 'Prawn Dansak', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(137, 8, 'King Prawn Dansak', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(138, 8, 'Vegetable Dansak', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(139, 8, 'Chicken Balti', NULL, 7.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(140, 8, 'Lamb Balti', NULL, 8.65, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(141, 8, 'Prawn Balti', NULL, 8.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(142, 8, 'King Prawn Balti', NULL, 11.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(143, 8, 'Vegetable Balti', NULL, 6.95, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'food', NULL, NULL, 1, 1, 'available'),
(200, 11, 'Cuvée Jean-Paul Blanc Sec', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(201, 11, 'Mirror Lake Sauvignon Blanc', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(202, 11, 'Bella Giuliana Pinot Grigio', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(203, 11, 'Tremblay-Marchive Chablis', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(204, 11, 'Duc De Morny Picpoul De Pinet', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(205, 12, 'Cuvée Jean-Paul Rouge', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(206, 12, 'Beyond The River Shiraz', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(207, 12, 'Sierra Grande Merlot', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(208, 12, 'Camarada Malbec', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(209, 13, 'Cuvée Jean-Paul Blanc Rosé', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(210, 13, 'Bella Giuliana Pinot Grigio Rosé', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(211, 13, 'The Big Top White Zinfandel', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(212, 14, 'Lunetta Prosecco', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(213, 15, 'Vodka', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(214, 15, 'Gin', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(215, 15, 'Pink Gin', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(216, 15, 'Bombay Sapphire Gin', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(217, 15, 'Rum', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(218, 15, 'Bacardi', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(219, 15, 'Malibu', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(220, 15, 'Archers Peach Schnapps', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(221, 15, 'Tequila', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(222, 15, 'Pernod', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(223, 15, 'Jack Daniel\'s', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(224, 15, 'Scotch Whisky', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(225, 15, 'Martell Brandy', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(226, 15, 'Courvoisier', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(227, 15, 'Remy Martin', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(228, 16, 'Drambuie', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(229, 16, 'Tia Maria', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(230, 16, 'Cointreau', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(231, 16, 'Baileys', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(232, 16, 'Southern Comfort', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(233, 16, 'Grand Marnier', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(234, 16, 'Sambuca', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(235, 16, 'Black Sambuca', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(236, 17, 'Kingfisher', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(237, 17, 'Cobra', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(238, 18, 'Magners', NULL, 4.90, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(239, 18, 'Strongbow', NULL, 3.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(240, 18, 'Non-Alcoholic Lager', NULL, 3.50, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(241, 19, 'Cinzano', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(242, 19, 'Martini Dry', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(243, 19, 'Martini Sweet', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(244, 19, 'Pimm\'s No.1', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(245, 20, 'Ruby', NULL, 3.75, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(246, 21, 'Still / Sparkling Water', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(248, 21, 'Coca-Cola', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(249, 21, 'Diet Coke', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(250, 21, 'Soda Water', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(251, 21, 'Tonic Water', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(252, 21, 'Lemonade', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(253, 21, 'Ginger Ale', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(254, 21, 'Appletiser', NULL, 3.30, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(255, 21, 'J20 Orange & Passion Fruit / Apple & Mango', NULL, 3.30, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(257, 21, 'Orange Juice', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(258, 21, 'Pineapple Juice', NULL, NULL, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available'),
(259, 21, 'Any Mixer with a Spirit', NULL, 1.00, '/storage/images/items/Bondor_20250131155656.png', NULL, NULL, 'drink', NULL, NULL, 1, 1, 'available');

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'Side Vegetables', NULL, NULL, NULL, 1, 1),
(2, 1, 'Sundries', NULL, NULL, NULL, 1, 1),
(3, 1, 'Starters', NULL, NULL, NULL, 1, 1),
(4, 1, 'Tandoori Dishes', NULL, NULL, NULL, 1, 1),
(5, 1, 'Biryani Dishes', NULL, NULL, NULL, 1, 1),
(6, 1, 'Chef Recommendations', NULL, NULL, NULL, 1, 1),
(7, 1, 'Bengal House Specials', NULL, NULL, NULL, 1, 1),
(8, 1, 'Traditional Curries', NULL, NULL, NULL, 1, 1),
(11, 2, 'White Wine', NULL, NULL, NULL, 1, 1),
(12, 2, 'Red Wine', NULL, NULL, NULL, 1, 1),
(13, 2, 'Rosé Wine', NULL, NULL, NULL, 1, 1),
(14, 2, 'Sparkling Wine', NULL, NULL, NULL, 1, 1),
(15, 2, 'Spirits', NULL, NULL, NULL, 1, 1),
(16, 2, 'Liqueurs', NULL, NULL, NULL, 1, 1),
(17, 2, 'Draught Beer/Cider', NULL, NULL, NULL, 1, 1),
(18, 2, 'Bottled Beer/Cider', NULL, NULL, NULL, 1, 1),
(19, 2, 'Aperitifs', NULL, NULL, NULL, 1, 1),
(20, 2, 'Port', NULL, NULL, NULL, 1, 1),
(21, 2, 'Soft Drinks', NULL, NULL, NULL, 1, 1);

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `capacity`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 2, 'available', NULL, NULL, NULL, NULL),
(2, 2, 'available', NULL, NULL, NULL, NULL),
(3, 4, 'available', NULL, NULL, NULL, NULL),
(4, 4, 'available', NULL, NULL, NULL, NULL),
(5, 4, 'available', NULL, NULL, NULL, NULL),
(6, 4, 'available', NULL, NULL, NULL, NULL),
(7, 4, 'available', NULL, NULL, NULL, NULL),
(8, 4, 'available', NULL, NULL, NULL, NULL),
(9, 2, 'available', NULL, NULL, NULL, NULL),
(10, 6, 'available', NULL, NULL, NULL, NULL),
(11, 4, 'available', NULL, '2025-01-13 15:44:41', NULL, 1),
(12, 3, 'available', NULL, NULL, NULL, NULL),
(13, 4, 'available', NULL, NULL, NULL, NULL),
(14, 3, 'available', NULL, NULL, NULL, NULL),
(15, 4, 'available', NULL, NULL, NULL, NULL),
(16, 4, 'available', NULL, NULL, NULL, NULL),
(17, 4, 'available', NULL, NULL, NULL, NULL),
(18, 6, 'available', NULL, NULL, NULL, NULL),
(19, 6, 'available', NULL, NULL, NULL, NULL),
(20, 4, 'available', NULL, NULL, NULL, NULL),
(21, 2, 'available', NULL, NULL, NULL, NULL);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `phone`, `verified_at`, `otp`, `otp_exp`, `social_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Sankarsan', 'das', 'admin@email.com', '$2y$12$9MgRh2YJKZk2ZKghrYMVMu14pV4qoXVl2dGy.dTq.Mhhh.4jhX/l.', 'admin', '01887436514', '2025-01-13 02:56:38', NULL, NULL, NULL, '2025-01-13 02:55:34', '2025-01-13 02:56:38', NULL, NULL, 'active');

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `item_id`, `name`, `price`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 200, '175ML', 4.95, 'available', 1, 1, NULL, NULL),
(4, 200, '250ML', 6.25, 'available', 1, 1, NULL, NULL),
(5, 200, 'Bottle', 15.90, 'available', 1, 1, NULL, NULL),
(6, 201, 'Bottle', 16.90, 'available', 1, 1, NULL, NULL),
(7, 202, '175ML', 5.50, 'available', 1, 1, NULL, NULL),
(8, 202, '250ML', 6.95, 'available', 1, 1, NULL, NULL),
(9, 202, 'Bottle', 18.50, 'available', 1, 1, NULL, NULL),
(10, 203, 'Bottle', 25.00, 'available', 1, 1, NULL, NULL),
(11, 204, 'Bottle', 18.90, 'available', 1, 1, NULL, NULL),
(12, 205, '175ML', 4.95, 'available', 1, 1, NULL, NULL),
(13, 205, '250ML', 6.25, 'available', 1, 1, NULL, NULL),
(14, 205, 'Bottle', 15.90, 'available', 1, 1, NULL, NULL),
(15, 206, 'Bottle', 18.90, 'available', 1, 1, NULL, NULL),
(16, 207, '175ML', 5.50, 'available', 1, 1, NULL, NULL),
(17, 207, '250ML', 6.90, 'available', 1, 1, NULL, NULL),
(18, 207, 'Bottle', 16.90, 'available', 1, 1, NULL, NULL),
(19, 208, 'Bottle', 20.90, 'available', 1, 1, NULL, NULL),
(20, 209, '175ML', 4.50, 'available', 1, 1, NULL, NULL),
(21, 209, '250ML', 5.50, 'available', 1, 1, NULL, NULL),
(22, 209, 'Bottle', 15.90, 'available', 1, 1, NULL, NULL),
(23, 210, 'Bottle', 18.00, 'available', 1, 1, NULL, NULL),
(24, 211, 'Bottle', 16.90, 'available', 1, 1, NULL, NULL),
(25, 212, '20CL', 7.50, 'available', 1, 1, NULL, NULL),
(26, 236, 'Half', 3.25, 'available', 1, 1, NULL, NULL),
(27, 236, 'Pint', 5.50, 'available', 1, 1, NULL, NULL),
(28, 237, 'Half', 3.25, 'available', 1, 1, NULL, NULL),
(29, 237, 'Pint', 5.80, 'available', 1, 1, NULL, NULL),
(30, 246, '330ML', 1.90, 'available', 1, 1, NULL, NULL),
(31, 246, '750ML', 3.95, 'available', 1, 1, NULL, NULL),
(32, 248, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(33, 249, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(34, 248, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(35, 249, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(36, 250, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(37, 251, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(38, 250, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(39, 251, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(40, 252, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(41, 252, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(42, 253, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(43, 253, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(44, 257, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(45, 257, 'Large', 3.95, 'available', 1, 1, NULL, NULL),
(46, 258, 'Small', 2.50, 'available', 1, 1, NULL, NULL),
(47, 258, 'Large', 3.95, 'available', 1, 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
