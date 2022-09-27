-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2020 at 03:29 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodgroup`
--



CREATE TABLE `plusone_attendance`.`attendance` 
( `attendance_id` INT(11) NOT NULL AUTO_INCREMENT , `emp_id` INT(11) NOT NULL , `attendance_date` DATE NOT NULL , 
`clock_in_time` VARCHAR(22) NOT NULL , `clock_out_time` VARCHAR(22) NOT NULL , `clock_out_reason` VARCHAR(100) NOT NULL , 

PRIMARY KEY (`attendance_id`)) ENGINE = InnoDB;

CREATE TABLE `plusone_attendance`.`employee_tbl` ( `emp_id` INT(11) NOT NULL AUTO_INCREMENT , 
`emp_firstname` VARCHAR(22) NOT NULL , `emp_lastname` VARCHAR(22) NOT NULL , `emp_email` VARCHAR(30) NOT NULL , 
`emp_position` VARCHAR(22) NOT NULL , PRIMARY KEY (`emp_id`)) ENGINE = InnoDB;
