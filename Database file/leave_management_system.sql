-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 07:34 PM
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
-- Database: `leave_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Human Resource', 'Active', '2024-08-02 13:40:20'),
(2, 'Sales', 'Active', '2024-08-02 13:40:30'),
(3, 'Information Technology', 'Active', '2024-08-02 13:40:38'),
(4, 'Research', 'Active', '2024-08-02 13:40:48'),
(5, 'Finance', 'Active', '2024-08-02 13:41:18'),
(6, 'Marketing', 'Active', '2024-08-02 13:41:26'),
(7, 'Volunteer', 'Active', '2024-08-02 13:41:34'),
(8, 'Operations', 'Active', '2024-08-02 13:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `start_date`, `end_date`, `reason`, `status`, `created_at`) VALUES
(1, 2, 1, '2024-08-06', '2024-08-08', 'Personal Work', 'rejected', '2024-08-06 14:42:30'),
(2, 2, 2, '2024-06-03', '2024-06-04', 'Health Concerns', 'pending', '2024-08-06 14:43:28'),
(3, 2, 4, '2024-04-09', '2024-04-13', 'To care for the mother and child.', 'approved', '2024-08-06 14:44:54'),
(4, 3, 1, '2024-08-07', '2024-08-08', 'Personal work', 'rejected', '2024-08-06 14:45:45'),
(5, 3, 10, '2024-05-07', '2024-05-07', 'Voting', 'approved', '2024-08-06 14:46:19'),
(6, 3, 9, '2024-07-29', '2024-08-01', 'Adverse Weather Leave', 'pending', '2024-08-06 14:47:07'),
(7, 4, 12, '2024-08-01', '2024-08-09', 'Personal reason time off', 'approved', '2024-08-06 14:53:06'),
(8, 4, 8, '2024-08-26', '2024-08-26', 'Religious holiday', 'approved', '2024-08-06 14:53:54'),
(9, 4, 5, '2024-08-01', '2024-08-02', 'To attend funeral arrangements.', 'approved', '2024-08-06 14:55:16'),
(19, 5, 1, '2024-08-08', '2024-08-15', 'For a small trip', 'rejected', '2024-08-06 14:58:20'),
(20, 6, 1, '2024-08-06', '2024-08-10', 'For a small vacation trip', 'rejected', '2024-08-06 14:58:46'),
(21, 7, 1, '2024-08-07', '2024-08-08', 'Small trip', 'pending', '2024-08-06 15:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type`, `status`, `created_at`) VALUES
(1, 'Casual Leave', 'Active', '2024-08-02 13:11:18'),
(2, 'Medical Leave', 'Active', '2024-08-02 13:11:33'),
(3, 'Restricted Holiday', 'Active', '2024-08-02 13:12:12'),
(4, 'Paternity Leave', 'Active', '2024-08-02 13:12:20'),
(5, 'Bereavement Leave', 'Active', '2024-08-02 13:12:29'),
(6, 'Compensatory Leave', 'Active', '2024-08-02 13:12:38'),
(7, 'Maternity Leave', 'Active', '2024-08-02 13:12:47'),
(8, 'Religious Holidays', 'Active', '2024-08-02 13:12:56'),
(9, 'Adverse Weather Leave', 'Active', '2024-08-02 13:16:28'),
(10, 'Voting Leave', 'Active', '2024-08-02 13:16:36'),
(11, 'Self-Quarantine Leave', 'Inactive', '2024-08-02 13:16:46'),
(12, 'Personal Time Off', 'Active', '2024-08-02 13:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `status`) VALUES
(1, 'Admin', 'Active'),
(2, 'Manager', 'Active'),
(3, 'Staff', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other','') NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','hod','staff') NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `role_id`, `department_id`, `phone`, `address`, `dob`, `gender`, `status`, `created_at`, `updated_at`, `role`, `profile_image`) VALUES
(1, 'Rohan Ilake', 'admin', 'rohanilake07@gmail.com', '$2y$10$VWKsVQjkA6/u6gIejChH1.WM/clmHV3KRB85RobFaIKAv1nACX7MC', 1, 1, '9156512265', 'Kolhapur', '2014-04-16', 'Male', 'Active', '2024-07-13 05:21:46', '2024-07-13 05:21:46', 'admin', 'profile_1_3940.png'),
(2, 'Rahul Ilake', 'rohan', 'rohanilake32@gmail.com', '$2y$10$CcrM7aeKbUu915eh/ChQOuBOEKDcp7Wb5uvvIj61oE9uVjNgimDNy', 2, 2, '9156512268', 'kolhapur', '2024-07-10', 'Male', 'Active', '2024-07-13 07:47:09', '2024-07-13 07:47:09', 'hod', '../uploads/emp.jpg'),
(3, 'Rahul Shinde', 'rahul', 'rahul07@gmail.com', '$2y$10$znXAtTx8M.L/u0IHMaa6seWYIkQJ0V6uognzn4eXVpulX6OFa5mmO ', 2, 3, '9865321456', 'Kolhapur', '2024-07-02', 'Male', 'Active', '2024-07-13 09:05:06', '2024-07-13 09:05:06', 'staff', '../uploads/emp.jpg'),
(4, 'Shravani Patil', 'shravani', 'shravanip@gmail.com', '$2y$10$kZZItcDQ/pWLNQ7ZTIQTuOljRFGZyoJg/W3dsHxQKVulkeVeZPW/6 ', 3, 4, '7456326598', 'Kolhapur', '2024-07-25', 'Female', 'Active', '2024-07-13 09:55:28', '2024-07-13 09:55:28', 'staff', '../uploads/Female.png'),
(5, 'Sonal Jadhav', 'sonal', 'sonal@gmail.com', '$2y$10$kWm8KUl7gTepwehcgt7j6.9DASgm9PUdMbIYKh1u61fuHv90yNLCu ', 3, 5, '9562654891', 'Kolhapur', '2000-06-07', 'Female', 'Active', '2024-08-02 13:03:59', '2024-08-02 13:03:59', 'staff', '../uploads/Female.png'),
(6, 'Vaishnavi Bhat', 'vaishnavi', 'vaishnavi@gmail.com', '$2y$10$tCyDbQdZ6NNb2FHHi6fsCeIqMXyji88P1jlqfZKlMLPABVyYA7.BS ', 3, 5, '9456823410', 'Kolhapur', '1999-10-19', 'Female', 'Active', '2024-08-02 13:27:52', '2024-08-02 13:27:52', 'staff', '../uploads/Female.png'),
(7, 'Somnath Gurav', 'somnath', 'somnath@gmail.com', '$2y$10$b/HqWFRt5715.GlcC47kYOjpPffmTwaG1GHs71tYkZGFFj8uxdhAW', 3, 6, '9654871263', 'Kolhapur', '1999-09-20', 'Male', 'Active', '2024-08-02 13:30:08', '2024-08-02 13:30:08', 'staff', '../uploads/emp.jpg'),
(10, 'Shraman Patil', 'shraman', 'shramanpatil@gmail.com', '$2y$10$lNV2LrJ3sBuDvEqSlGG.p.qvD3U6mP33hD96bAUMlZakYUCIK.szG ', 3, 7, '9561234587', 'Kolhapur', '2001-06-12', 'Male', 'Active', '2024-08-06 14:24:24', '2024-08-06 14:24:24', 'admin', '../uploads/emp.jpg'),
(11, 'Sonali Pawar', 'sonali', 'sonalipawar@gmail.com', '$2y$10$HR/Q4xMTzncCcvFjPrXT5es0xqIX4W7Rh5rw3jatEYox4af2nCuXu ', 3, 7, '7546123584', 'Kolhapur', '2000-06-04', 'Female', 'Active', '2024-08-06 14:27:24', '2024-08-06 14:27:24', 'admin', '../uploads/Female.png'),
(12, 'Yogita Ravan', 'yogita', 'yogitaravan@gmail.com', '$2y$10$kk1QJ7prkbEuzcrs8WI7He/zLpRAQqbbzq0CtRpzoDc/.fUTH3GAS ', 3, 8, '9561892265', 'Kolhapur', '1990-02-12', 'Female', 'Active', '2024-08-06 14:28:39', '2024-08-06 14:28:39', 'admin', '../uploads/Female.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `leave_type_id` (`leave_type_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `leaves_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
