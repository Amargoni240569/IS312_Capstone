-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

/* Creating the Bakers Bakery Database */
CREATE DATABASE bakers_bakery;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakers_bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`) VALUES
(1, 'Cakes', '2026-05-14 05:03:19'),
(2, 'Cookies', '2026-05-14 05:03:19'),
(3, 'Muffins', '2026-05-14 05:03:19'),
(4, 'Pastries', '2026-05-14 05:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','read','resolved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`message_id`, `full_name`, `email`, `subject`, `message`, `created_at`, `status`) VALUES
(1, 'Michael Brown', 'michael.brown@gmail.com', 'Birthday Cake Order', 'I would like to place an order for a custom birthday cake for next weekend.', '2026-05-14 05:03:19', 'pending'),
(2, 'Sarah Johnson', 'sarah.johnson@gmail.com', 'Delivery Inquiry', 'Do you provide delivery services within Madang town area?', '2026-05-14 05:03:19', 'read'),
(3, 'Daniel Wilson', 'daniel.wilson@gmail.com', 'Product Availability', 'Is the red velvet cake available daily?', '2026-05-14 05:03:19', 'resolved'),
(4, 'Emily Davis', 'emily.davis@gmail.com', 'Website Feedback', 'Your bakery website is very easy to use and navigate.', '2026-05-14 05:03:19', 'read'),
(5, 'James Miller', 'james.miller@gmail.com', 'Bulk Order Request', 'I would like to request a quotation for 100 cupcakes.', '2026-05-14 05:03:19', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `email`, `password_hash`, `phone_number`, `created_at`) VALUES
(17, 'Joe Blow', 'joeblow@gmail.com', '$2y$10$nRVm.9p6uhG9xiwvOrqnDOlSq9sGcXWpfDWJ5.4ip2xYxAJa16RCy', '76308659', '2026-05-15 03:10:40'),
(21, 'Michael Brown', 'michaelbrown@gmail.com', '$2y$10$SowPnMR1Vo.iWAVTiaEsVOstes2PiBo.OAImVpdT2ysX7C9b9UFbu', '67571234567', '2026-05-15 07:07:20'),
(22, 'Sarah Johnson', 'sarahjohnson@gmail.com', '$2y$10$GH0Is28.13MdnzlU8G/Huu4jpIHf9wUW1gomqQq49NcVQHPGU6Qvy', '67572345678', '2026-05-15 07:09:01'),
(23, 'Daniel Wilson', 'danielwilson@gmail.com', '$2y$10$cIjWU6gnMV6qFRoF09TVzOAFyz2rXCN2tHRDS5T5GnI96xlVJVvva', '67573456789', '2026-05-15 07:10:18'),
(24, 'Emily Davis', 'emilydavis@gmail.com', '$2y$10$AC7EeAS/X/cHAL7dob4uNuUEgIRo9RV8HE2ifUcQI0SBBWiYi2jWm', '67574567890', '2026-05-15 07:11:16'),
(25, 'James Miller', 'jamesmiller@gmail.com', '$2y$10$7AcBlf7bSnUM6ljVCjkOLecPUjx7BajLd/bVdo1onXKoxl53inGOq', '6757678901', '2026-05-15 07:12:23'),
(26, 'Olivia Thomas', 'oliviathomas@gmail.com', '$2y$10$2sG5rd4jyZMD8q4eSXeoROiVRPIzoCO2HXErUMmy7RSUb/fTt2Shu', '67576789012', '2026-05-15 07:13:26'),
(27, 'Benjamin Lee', 'benjaminlee@gmail.com', '$2y$10$TWoPEJa/XoQTW7cjNAibneV69f7VLWNKbfntxcS3fQ38vpRbhU8Wm', '67577890123', '2026-05-15 07:14:19'),
(28, 'Sophia White', 'sophiawhite@gmail.com', '$2y$10$4ALTSzGxplozE3bJ.i2kVueDIYVnilaKHah9BHi6AX34WOALinncS', '67578901234', '2026-05-15 07:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_reviews`
--

INSERT INTO `customer_reviews` (`review_id`, `customer_id`, `product_id`, `rating`, `comment`, `created_at`, `status`) VALUES
(9, 17, 7, 5, 'Mouth Watery samples was exquisite!', '2026-05-16 07:07:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `rating` decimal(2,1) DEFAULT 0.0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `product_description`, `price`, `image_path`, `stock_quantity`, `rating`, `created_at`) VALUES
(7, 4, 'Cheese Croissant', 'Buttery croissant layered with melted cheese.', 14.00, 'assets/images/Pastry/pastry8.jpg', 35, 4.6, '2026-05-14 05:03:19'),
(8, 2, 'Chocolate Chip Cookies', 'Crunchy cookies packed with chocolate chips.', 6.00, 'assets/images/Cookies/Cookies5.jpg', 80, 4.8, '2026-05-14 05:03:19'),
(9, 2, 'Oatmeal Raisin Cookies', 'Soft oatmeal cookies mixed with sweet raisins.', 6.50, 'assets/images/Cookies/Cookies7.jpg', 60, 4.3, '2026-05-14 05:03:19'),
(10, 3, 'Strawberry Cupcake', 'Vanilla cupcake topped with strawberry cream frosting.', 9.50, 'assets/images/Muffin/Muffin7.jpg', 25, 4.5, '2026-05-14 05:03:19'),
(11, 3, 'Chocolate Cupcake', 'Chocolate cupcake with rich cocoa buttercream.', 9.50, 'assets/images/Muffin/Muffin5.jpg', 25, 4.7, '2026-05-14 05:03:19'),
(19, 1, 'Chocolate Fudge Cake', 'Rich chocolate cake layered with creamy fudge frosting.', 45.99, 'assets/images/Cake/cake1.jpg', 20, 4.8, '2026-05-14 13:25:51'),
(21, 1, 'Red Velvet Delight', 'Classic red velvet cake with smooth cream cheese icing.', 48.75, 'assets/images/Cake/cake3.jpg', 15, 4.9, '2026-05-14 13:25:51'),
(22, 1, 'Caramel Crunch Cake', 'Moist caramel cake finished with crunchy toffee toppings.', 46.20, 'assets/images/Cake/cake4.jpg', 12, 4.6, '2026-05-14 13:25:51'),
(23, 1, 'Black Forest Cake', 'Chocolate sponge layered with cherries and whipped cream.', 50.00, 'assets/images/Cake/cake5.jpg', 10, 4.9, '2026-05-14 13:25:51'),
(24, 2, 'Chocolate Chip Cookies', 'Golden cookies packed with rich chocolate chip pieces.', 8.99, 'assets/images/Cookies/cookies1.jpg', 50, 4.8, '2026-05-14 13:25:51'),
(25, 2, 'Peanut Butter Cookies', 'Soft peanut butter cookies with roasted nut flavor.', 9.50, 'assets/images/Cookies/cookies2.jpg', 45, 4.6, '2026-05-14 13:25:51'),
(26, 2, 'Oatmeal Raisin Cookies', 'Chewy oatmeal cookies blended with sweet raisins.', 7.80, 'assets/images/Cookies/cookies3.jpg', 40, 4.5, '2026-05-14 13:25:51'),
(27, 2, 'Double Choco Cookies', 'Dark chocolate cookies filled with chocolate chunks.', 10.25, 'assets/images/Cookies/cookies4.jpg', 35, 4.9, '2026-05-14 13:25:51'),
(28, 2, 'Coconut Sugar Cookies', 'Crunchy sugar cookies infused with tropical coconut flavor.', 8.40, 'assets/images/Cookies/cookies5.jpg', 30, 4.4, '2026-05-14 13:25:51'),
(29, 3, 'Blueberry Muffin', 'Fluffy muffin filled with juicy blueberry pieces.', 6.99, 'assets/images/Muffin/muffin1.jpg', 25, 4.7, '2026-05-14 13:25:51'),
(30, 3, 'Banana Nut Muffin', 'Fresh banana muffin mixed with crunchy walnut pieces.', 7.50, 'assets/images/Muffin/muffin9.jpg', 20, 4.6, '2026-05-14 13:25:51'),
(31, 3, 'Chocolate Muffin', 'Moist chocolate muffin topped with chocolate chips.', 7.25, 'assets/images/Muffin/muffin3.jpg', 22, 4.8, '2026-05-14 13:25:51'),
(32, 3, 'Strawberry Cream Muffin', 'Soft muffin blended with strawberry cream filling.', 7.95, 'assets/images/Muffin/muffin4.jpg', 18, 4.5, '2026-05-14 13:25:51'),
(33, 3, 'Coffee Cinnamon Muffin', 'Warm cinnamon muffin flavored with rich coffee essence.', 8.10, 'assets/images/Muffin/muffin8.jpg', 16, 4.7, '2026-05-14 13:25:51'),
(34, 4, 'Butter Croissant', 'Flaky buttery croissant baked until golden and crisp.', 5.99, 'assets/images/Pastry/pastry1.jpg', 35, 4.8, '2026-05-14 13:25:51'),
(35, 4, 'Apple Danish', 'Sweet pastry filled with fresh apple cinnamon filling.', 6.75, 'assets/images/Pastry/pastry2.jpg', 28, 4.6, '2026-05-14 13:25:51'),
(36, 4, 'Cheese Puff Pastry', 'Light puff pastry stuffed with creamy cheese filling.', 7.20, 'assets/images/Pastry/pastry3.jpg', 24, 4.7, '2026-05-14 13:25:51'),
(37, 4, 'Chocolate Éclair', 'Classic éclair topped with smooth chocolate glaze.', 8.50, 'assets/images/Pastry/pastry4.jpg', 20, 4.9, '2026-05-14 13:25:51'),
(38, 4, 'Cinnamon Twist Pastry', 'Twisted pastry coated with cinnamon sugar crystals.', 6.40, 'assets/images/Pastry/pastry5.jpg', 26, 4.5, '2026-05-14 13:25:51'),
(40, 2, 'hooray', 'hooray', 123.00, 'assets/images/Cookies/1778769494_cake1.jpg', 321, 0.0, '2026-05-14 14:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(16, 'Admin', 'admin@bakery.com', '$2y$10$SKE4tQwN8cv5ozr3JHFNBe0fI.EqPiMBf6zHAv1Rzd1e8TlbXhc26', 'admin', '2026-05-14 06:06:23'),
(17, 'staff_sung', 'sung@gmail.com', '$2y$10$4lxRndKJ8Eg/tqYJ0XKhD.JODNh66OjJfrgtf81jbvmB1E7UDBdHO', 'staff', '2026-05-15 03:08:04'),
(18, 'admin_baker', 'admin@bakersbakery.com', '$2y$10$qIwUVXMGTOycQrc2/csi2.SFtj8k9XrvKT5b4nwT/opd6guMT36tq', 'staff', '2026-05-15 07:00:18'),
(19, 'manager_john', 'john@bakersbakery.com', '$2y$10$STRSq4q.mEtGaxIVoXj0Ouy.XEQrvZ/ENr6HErfqkJjNwfbowq6LW', 'staff', '2026-05-15 07:02:18'),
(20, 'staff_mary', 'mary@bakersbakery.com', '$2y$10$5FBfXLCG51vNd/wuMIJjhOrAo28LqhjXpkJ4sWTexmHqRpbdCb9N2', 'staff', '2026-05-15 07:03:39'),
(21, 'staff_peter', 'peter@bakersbakery.com', '$2y$10$nnh49xz8CPlCXq3Hnji3Zuy1S9Q39J2Dk4wZgALg61Z8rLcRYgO1S', 'staff', '2026-05-15 07:04:19'),
(22, 'staff_lisa', 'lisa@bakersbakery.com', '$2y$10$u1ljQZMywZEiNJ1mfGkxg.yMuyC1fpDGqT7UZq2eP9mNRcHXF8Vi2', 'staff', '2026-05-15 07:05:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_customer` (`customer_id`),
  ADD KEY `fk_reviews_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD CONSTRAINT `fk_reviews_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
