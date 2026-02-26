-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql-container
-- Generation Time: Feb 25, 2026 at 03:59 PM
-- Server version: 8.0.45
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`) VALUES
(1, 'Rachel', 'Rees'),
(2, 'Samantha', 'Subin'),
(3, 'April', 'Roach'),
(4, 'Marie', 'Ryan'),
(5, 'Melanie', 'Boylan'),
(6, 'Andrea', 'D\'Ambrosio'),
(7, 'Aisling', 'Kenny'),
(8, 'Annie', 'Palmer'),
(9, 'Samantha', 'Kelly'),
(10, 'Theodara', 'Lau'),
(11, 'Gail', 'Conway'),
(12, 'Priyanka', 'Salve'),
(13, 'Tasmin', 'Lockwood'),
(14, 'Rana', 'Foroohar'),
(15, 'Seema', 'Mody'),
(16, 'Laura', 'McKeown'),
(17, 'Teresa', 'Mannion'),
(18, 'Annemarie', 'Roberts'),
(19, 'Ruth', 'McGann'),
(20, 'Lucy ', 'Norris'),
(21, 'Julie', 'Iannuzzi'),
(22, 'Kristy', 'March'),
(23, 'Belinda', 'Grant-Geary'),
(24, 'Subhasree', 'Kar'),
(25, 'Casey', 'Bond'),
(26, 'Claire', 'Boston'),
(27, 'Mary', 'McKenna'),
(28, 'Anniek', 'Bao'),
(29, 'Julie', 'Boorstin'),
(30, 'Katie', 'Brigham');
<div class="alert alert-danger" role="alert"><h1>Error</h1><p><strong>SQL query:</strong>  <a href="#" class="copyQueryBtn" data-text="SET SQL_QUOTE_SHOW_CREATE = 1">Copy</a>
<a href="index.php?route=/database/sql&sql_query=SET+SQL_QUOTE_SHOW_CREATE+%3D+1&show_query=1&db=news_db"><span class="text-nowrap"><img src="themes/dot.gif" title="Edit" alt="Edit" class="icon ic_b_edit">&nbsp;Edit</span></a>    </p>
<p>
<code class="sql" dir="ltr"><pre>
SET SQL_QUOTE_SHOW_CREATE = 1
</pre></code>
</p>
<p>
    <strong>MySQL said: </strong><a href="./url.php?url=https%3A%2F%2Fdev.mysql.com%2Fdoc%2Frefman%2F8.0%2Fen%2Fserver-error-reference.html" target="mysql_doc"><img src="themes/dot.gif" title="Documentation" alt="Documentation" class="icon ic_b_help"></a>
</p>
<code>#2006 - MySQL server has gone away</code><br></div>