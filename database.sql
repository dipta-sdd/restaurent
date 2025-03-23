--
-- Database: `restaurent`
--
CREATE DATABASE IF NOT EXISTS `restaurent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `restaurent`;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `name`, `phone`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Bilpar', '01301727106', 1, 1, '2025-01-13 14:51:30', '2025-01-13 14:51:30'),
(2, 'dfgh', '01301727106', 1, 1, '2025-01-13 14:55:40', '2025-01-13 14:55:40'),
(3, 'df', '01301727106', 1, 1, '2025-01-13 15:02:00', '2025-01-13 15:02:00'),
(4, 'gfd', '01301727106', 1, 1, '2025-01-15 06:13:58', '2025-01-15 06:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Foods', NULL, NULL, NULL, NULL, NULL),
(2, 'Drinks', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `subcategory_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '/storage/images/items/Bondor_20250131155656.png',
  `allergens` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dietary_options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('food','drink') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `status` enum('available','outofstock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_18_141529_create_addresses_table', 1),
(5, '2024_11_18_142201_create_categories_table', 1),
(6, '2024_11_18_142424_create_subcategories_table', 1),
(7, '2024_11_18_142727_create_items_table', 1),
(8, '2024_11_18_143225_create_variants_table', 1),
(10, '2024_11_18_145533_create_tables_table', 1),
(12, '2024_11_18_145938_create_carts_table', 1),
(13, '2024_11_18_244754_create_orders_table', 1),
(14, '2024_11_18_245012_create_order_items_table', 1),
(15, '2024_11_22_143736_create_personal_access_tokens_table', 1),
(16, '2025_01_09_111230_update_table_status_enum', 1),
(17, '2024_11_18_145646_create_reservations_table', 2),
(18, '2024_11_18_144652_create_payment_methods_table', 3),
(19, '2024_01_15_000000_update_users_default_status', 4),
(20, '2025_01_14_093350_add_address_id_to_users_table', 4),
(21, '2025_02_04_140334_add_variant_to_order_items_table', 4),
(22, '2025_02_05_160338_update_orders', 5),
(23, '2025_02_05_160514_update_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `order_type` enum('delivery','pickup','dine-in') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','ready','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(10,2) NOT NULL,
  `address_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `reservation_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `table_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_type`, `status`, `instructions`, `total_amount`, `address_id`, `transaction_id`, `payment_method_id`, `reservation_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `table_id`) VALUES
(5, NULL, 'pickup', 'processing', NULL, 13.50, NULL, NULL, NULL, NULL, '2025-02-04 08:24:44', '2025-02-04 08:24:44', 1, 1, NULL),
(6, NULL, 'pickup', 'processing', NULL, 13.50, NULL, NULL, NULL, NULL, '2025-02-04 08:25:07', '2025-02-04 08:25:07', 1, 1, NULL),
(7, NULL, 'pickup', 'processing', NULL, 13.50, NULL, NULL, NULL, NULL, '2025-02-04 08:25:20', '2025-02-04 08:25:20', 1, 1, NULL),
(8, NULL, 'pickup', 'processing', NULL, 13.50, NULL, NULL, NULL, NULL, '2025-02-04 08:25:27', '2025-02-04 08:25:27', 1, 1, NULL),
(9, NULL, 'pickup', 'processing', NULL, 19.68, NULL, NULL, NULL, NULL, '2025-02-04 08:27:43', '2025-02-04 08:27:43', 1, 1, NULL),
(10, NULL, 'dine-in', 'processing', NULL, 0.00, NULL, NULL, NULL, NULL, '2025-02-05 10:30:08', '2025-02-05 10:30:08', 1, 1, NULL),
(11, NULL, 'dine-in', 'processing', NULL, 22.26, NULL, NULL, 1, NULL, '2025-02-07 16:02:44', '2025-02-07 16:02:44', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `customization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `price`, `customization`, `created_at`, `updated_at`, `variant_id`) VALUES
(5, 9, 246, 1, 1.90, NULL, '2025-02-04 08:27:43', '2025-02-04 08:27:43', NULL),
(6, 9, 248, 1, 3.95, NULL, '2025-02-04 08:27:43', '2025-02-04 08:27:43', NULL),
(7, 9, 254, 2, 3.30, NULL, '2025-02-04 08:27:43', '2025-02-04 08:27:43', NULL),
(8, 11, 68, 1, 8.60, NULL, '2025-02-07 16:02:44', '2025-02-07 16:02:44', NULL),
(9, 11, 69, 1, 9.95, NULL, '2025-02-07 16:02:44', '2025-02-07 16:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'css', 'fgjfc', 'active', '2025-01-13 15:34:44', '2025-01-13 15:34:44', 1, 1),
(2, 'Cash', 'cash money', 'active', '2025-02-04 07:43:24', '2025-02-04 07:43:24', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `table_id` bigint UNSIGNED DEFAULT NULL,
  `reservation_date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `status` enum('pending','confirmed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'confirmed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `customer_id`, `table_id`, `reservation_date`, `start`, `end`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 11, '2025-02-08', '20:23:39', '22:23:39', 'confirmed', NULL, NULL, NULL, NULL),
(2, 1, 11, '2025-02-09', '20:23:39', '22:23:39', 'confirmed', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5MRGoyjLVQYzRick4XXA7Nv3LiEj8UBH01dnHw7z', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGRubjdLT1JDd0VvZU5RbmhYOU5nQ0lQT21GQ0lCbmpENER3ajk5YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvZGFzaGJvYXJkL3RhYmxlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1739029597);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint UNSIGNED NOT NULL,
  `capacity` int NOT NULL,
  `status` enum('available','maintenance','closed','occupied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin','manager','rider','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_exp` timestamp NULL DEFAULT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `status` enum('inactive','active','suspended','banned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `address_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `phone`, `verified_at`, `otp`, `otp_exp`, `social_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `address_id`) VALUES
(1, 'Sankarsan', 'das', 'admin@email.com', '$2y$12$9MgRh2YJKZk2ZKghrYMVMu14pV4qoXVl2dGy.dTq.Mhhh.4jhX/l.', 'admin', '01887436514', '2025-01-13 02:56:38', NULL, NULL, NULL, '2025-01-13 02:55:34', '2025-01-13 02:56:38', NULL, NULL, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','outofstok') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_created_by_foreign` (`created_by`),
  ADD KEY `addresses_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`),
  ADD KEY `carts_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_created_by_foreign` (`created_by`),
  ADD KEY `items_updated_by_foreign` (`updated_by`),
  ADD KEY `items_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`),
  ADD KEY `orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `orders_reservation_id_foreign` (`reservation_id`),
  ADD KEY `orders_created_by_foreign` (`created_by`),
  ADD KEY `orders_updated_by_foreign` (`updated_by`),
  ADD KEY `orders_table_id_foreign` (`table_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_item_id_foreign` (`item_id`),
  ADD KEY `order_items_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_created_by_foreign` (`created_by`),
  ADD KEY `payment_methods_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_customer_id_foreign` (`customer_id`),
  ADD KEY `reservations_table_id_foreign` (`table_id`),
  ADD KEY `reservations_created_by_foreign` (`created_by`),
  ADD KEY `reservations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_created_by_foreign` (`created_by`),
  ADD KEY `subcategories_updated_by_foreign` (`updated_by`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_created_by_foreign` (`created_by`),
  ADD KEY `tables_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_updated_by_foreign` (`updated_by`),
  ADD KEY `users_address_id_foreign` (`address_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variants_created_by_foreign` (`created_by`),
  ADD KEY `variants_updated_by_foreign` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `addresses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `items_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payment_methods_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `subcategories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `subcategories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tables_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `variants_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
