-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 12:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adoptpetsco`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptionrequests`
--

CREATE TABLE `adoptionrequests` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptionrequests`
--

INSERT INTO `adoptionrequests` (`id`, `pet_id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi I would like to adopt lily :)', '2024-05-07 02:11:54'),
(2, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi I would like to adopt lily :)', '2024-05-07 02:12:44'),
(3, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi I would like to adopt lily :)', '2024-05-07 02:12:58'),
(4, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi I would like to adopt lily :)', '2024-05-07 02:14:23'),
(5, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi I would like to adopt lily :)', '2024-05-07 02:15:20'),
(6, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi I would like to adopt lily :)', '2024-05-07 02:15:48'),
(7, 4, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hi i would like to adopt tony', '2024-05-07 02:17:26'),
(8, 6, 'Menna', 'menna.elg11@yahoo.com', 'Hi I would like to adopt max! :)', '2024-05-07 19:01:30'),
(9, 1, 'Menna Elgayar', 'menna.elg11@yahoo.com', 'Hello I would like to adopt Lily!', '2024-05-07 22:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pet_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` varchar(50) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `size` varchar(20) NOT NULL,
  `color` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `adoption_fee` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pet_id`, `name`, `species`, `breed`, `age`, `gender`, `size`, `color`, `description`, `adoption_fee`, `location`, `photo`) VALUES
(1, 'Lily', 'Cat', 'American Shorthair', 2, 'Female', '2lb', 'grey', 'Lily is a spayed female cat, sweet-natured and affectionate. With captivating green eyes and soft fur, she loves gentle chin scratches and playing with feather toys. A perfect companion ready to bring joy to your home.', 100, 'Lyndhurst, NJ', 'https://www.freeportvet.com/sites/default/files/styles/large/public/american-shorthair-cat-breed-info_0.jpg?itok=MCtZxXLq'),
(2, 'Buddy', 'Dog', 'Golden Retriever', 3, 'Male', '40lb', 'golden', 'Buddy is a lovable and sociable dog, always ready for fun and cuddles. With his soft fur and friendly nature, he\'s everyone\'s favorite companion, whether playing in the park or relaxing at home.', 200, 'Clifton, NJ', 'https://www.goldenretrieverforum.com/attachments/20210324_174517-jpg.882816/'),
(3, 'Lily', 'Cat', 'American Shorthair', 1, 'Female', '6lb', 'orange', 'Meet Lily, the adorable orange kitten ready to bring sunshine into your life. With her playful charm and affectionate nature, she\'s the perfect furry companion for any loving home. Adopt Lily today and fill your days with endless joy and purrs. ', 200, 'Cliffside Park, NJ', 'https://i.pinimg.com/736x/b3/47/98/b34798360e8445729d99d4972eb91ece.jpg'),
(4, 'Tony', 'Dog', 'German Shepherd', 2, 'Male', '32lb', 'Brown', 'Introducing Tony, the loyal German Shepherd seeking a forever home. With his noble stance and gentle eyes, Tony is a devoted companion ready to stand by your side through thick and thin. Bring Tony into your life and experience the unwavering loyalty and love of a true canine friend.', 250, 'Passaic, NJ', 'https://i.pinimg.com/736x/a0/68/08/a06808c24c40784c6b5339eb25732c75.jpg'),
(5, 'Whiskers', 'Cat', 'Persian Cat', 9, 'Female', '13lb', 'grey', 'Meet Whiskers, the elegant Persian cat with luxurious fur and a regal demeanor. With his graceful movements and affectionate purrs, Whiskers brings a touch of sophistication and charm to any home. Adopt Whiskers today and let his gentle presence fill your days with warmth and companionship', 100, 'Hawthorn, NJ', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Stephanie_2.jpg/220px-Stephanie_2.jpg'),
(6, 'Max', 'Dog', 'Labrador Retriever', 12, 'Male', '52lb', 'golden', 'Say hello to Max, the friendly Labrador Retriever bursting with boundless energy and enthusiasm. With his wagging tail and playful antics, Max is always ready for a game of fetch or a long walk in the park. Bring Max into your life and discover the joy and laughter he brings to every moment.', 200, 'Newark, NJ', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Labrador-retriever.jpg/1200px-Labrador-retriever.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`) VALUES
(1, 'Mo', '$2y$10$X5pqKa6dFz/jK9TLnrfUzO3.m3sNm9gdt0JKu3gK4fFLC0GE70aUm', NULL, NULL),
(2, 'sid', '$2y$10$6VyXK5LPTLVfKdaIjPGcVuNCfBvFVkcnwZDTKKrtj210NKNyfXtmS', NULL, NULL),
(3, 'Jenna', '$2y$10$hwLc8tayEK4EZNLA3wlJqu5ktt2HX0VQpighdH9DzhVhTw2awn/Ey', NULL, NULL),
(4, 'Sally', '$2y$10$qVFf./2lr5xt4jqk1qXPF.XQlTU81n13IS0dkyIarERa0lz9tFH/q', NULL, NULL),
(5, 'Janis', '$2y$10$RJh4uwfKqcqMvTK7nSigYOeyMKea.Eo2J7svFQmBqR73Ht6CBla3O', NULL, NULL),
(6, 'Mo123', '$2y$10$1lf/u1ZfhGaR4b7pi3t9.e5MMcUcqdme1gHk2dQbzUVpvWfQe8bVS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptionrequests`
--
ALTER TABLE `adoptionrequests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`pet_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptionrequests`
--
ALTER TABLE `adoptionrequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
