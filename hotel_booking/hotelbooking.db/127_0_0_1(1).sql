-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 11:08 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--
CREATE DATABASE IF NOT EXISTS `hotel_booking` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotel_booking`;

-- --------------------------------------------------------

--
-- Table structure for table `booking_users`
--

CREATE TABLE `booking_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_users`
--

INSERT INTO `booking_users` (`id`, `username`, `email`, `mobile_number`, `room_type`, `price`, `transaction_id`, `hotel_name`, `city`) VALUES
(14, 'shubham', 'abc@gmail.com', '7666877591', 'Suite', '5000.00', 'TXN_67e4eff2475de', 'The Oberoi', 'Mumbai'),
(15, 'test', 'abc@gmail.com', '767655659', 'Deluxe Room', '2000.00', 'TXN_67e4f03cc397a', 'Taj Hotel', 'Mumbai'),
(16, 'demo', 'abhi@gmail.ocm', '7666877591', 'Deluxe Room', '2000.00', 'TXN_67e4f0eece8be', 'Taj Hotel', 'Mumbai'),
(17, 'test3', 'test@gmail.com', '7666876527', 'Deluxe Room', '2000.00', 'TXN_67e50232b5839', 'Taj Hotel', 'Mumbai'),
(18, 'test4', 'abc@gmail.com', '123478990', 'Suite', '5000.00', 'TXN_67e503051943d', 'The Oberoi', 'Mumbai'),
(19, 'test5', 'abc@gmail.com', '765434342567', 'Luxury Room', '3500.00', 'TXN_67e50338d7eee', 'Taj Hotel', 'Mumbai'),
(20, 'test', 'abc@gmail.com', '76543461', 'Luxury Room', '3500.00', 'TXN_67e50608a3851', 'Taj Hotel', 'Mumbai'),
(21, 'shiv', 'abc@gmail.com', '123345678', 'Deluxe Room', '2000.00', 'TXN_67e511aed96b4', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `rooms` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Confirmed','Cancelled') DEFAULT 'Confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `amenities` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `city`, `price`, `rating`, `amenities`, `image`) VALUES
(1, 'Taj Hotel', 'Mumbai', '200.00', 5, 'wifi,pool,parking', 'taj.jpg'),
(2, 'The Oberoi', 'Mumbai', '180.00', 5, 'wifi,pool', 'oberoi.jpg'),
(3, 'JW Marriott', 'Mumbai', '150.00', 4, 'wifi,parking', 'jw.jpg'),
(4, 'Conrad', 'Pune', '160.00', 5, 'wifi,pool,parking', 'conrad.jpg'),
(5, 'Hyatt Regency', 'Pune', '140.00', 4, 'wifi,parking', 'hyatt.jpg'),
(6, 'Taj Hotel', 'Mumbai', '200.00', 5, 'wifi,pool,parking', 'taj.jpg'),
(7, 'The Oberoi', 'Mumbai', '180.00', 5, 'wifi,pool', 'oberoi.jpg'),
(8, 'JW Marriott', 'Mumbai', '150.00', 4, 'wifi,parking', 'jw.jpg'),
(9, 'Conrad', 'Pune', '160.00', 5, 'wifi,pool,parking', 'conrad.jpg'),
(10, 'Hyatt Regency', 'Pune', '140.00', 4, 'wifi,parking', 'hyatt.jpg'),
(11, 'Satara Grand', 'Satara', '100.00', 4, 'wifi,parking', 'satara.jpg'),
(12, 'Buldana Residency', 'Buldana', '120.00', 4, 'wifi', 'buldana.jpg'),
(13, 'Nagpur Inn', 'Nagpur', '130.00', 4, 'wifi,pool', 'nagpur.jpg'),
(14, 'Nashik Bliss', 'Nashik', '125.00', 4, 'wifi,parking', 'nashik.jpg'),
(15, 'Kolhapur Palace', 'Kolhapur', '140.00', 5, 'wifi,pool,parking', 'kolhapur.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotels1`
--

CREATE TABLE `hotels1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `amenities` text,
  `image` varchar(255) DEFAULT NULL,
  `image_url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotels1`
--

INSERT INTO `hotels1` (`id`, `name`, `city`, `price`, `rating`, `amenities`, `image`, `image_url`) VALUES
(1, 'Taj Hotel', 'Mumbai', '2002.00', '5.0', 'wifi,pool,parking', 'taj.jpg', '["images/hoteldetails.jpg", "images/Room.jpg","images/Guest.jpg"]'),
(2, 'The Oberoi', 'Mumbai', '1800.00', '5.0', 'wifi,pool', 'oberoi.jpg', 'images/hotel2.jpg'),
(3, 'JW Marriott', 'Mumbai', '150.00', '4.0', 'wifi,parking', 'jw.jpg', 'images/hotel1.jpg'),
(4, 'Conrad', 'Pune', '1600.00', '5.0', 'wifi,pool,parking', 'conrad.jpg', '["images/hoteldetails.jpg", "images/Room.jpg","images/Guest.jpg"]'),
(5, 'Hyatt Regency', 'Pune', '1400.00', '4.0', 'wifi,parking', 'hyatt.jpg', '["images/Room.jpg", "images/hoteldetails.jpg","images/Guest.jpg"]'),
(6, 'Satara Grand', 'Satara', '1000.00', '3.5', 'wifi,parking', 'satara.jpg', ''),
(7, 'Buldana Residency', 'Buldana', '1200.00', '4.0', 'wifi', 'buldana.jpg', ''),
(8, 'Nagpur Inn', 'Nagpur', '1300.00', '4.2', 'wifi,pool', 'nagpur.jpg', ''),
(9, 'Nashik Bliss', 'Nashik', '1250.00', '4.0', 'wifi,parking', 'nashik.jpg', ''),
(10, 'Kolhapur Palace', 'Kolhapur', '1400.00', '4.5', 'wifi,pool,parking', 'kolhapur.jpg', ''),
(11, 'Grand Hotel', 'New York', '1200.00', '4.5', 'Free WiFi, Pool, Gym', NULL, 'images/grand_hotel.jpg'),
(12, 'Taj Hotel', 'Mumbai', NULL, NULL, NULL, NULL, NULL),
(13, 'The Oberoi', 'Delhi', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `Srno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hotel_id`, `room_type`, `price`, `image_url`, `hotel_name`, `city`, `Srno`) VALUES
(1, 1, 'Deluxe Room', '2000.00', 'images/room1.jpg', 'pune', 'pune', NULL),
(2, 1, 'Luxury Room', '3500.00', 'images/Guest.jpg', '', '', NULL),
(3, 2, 'Suite', '5000.00', 'images/room2.jpg', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_users`
--
ALTER TABLE `booking_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels1`
--
ALTER TABLE `hotels1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_users`
--
ALTER TABLE `booking_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `hotels1`
--
ALTER TABLE `hotels1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels1` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels1` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
