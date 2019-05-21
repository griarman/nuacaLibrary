-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 01:25 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuacalibrary`
--
	CREATE DATABASE nuacalibrary;
	USE nuacalibrary;
-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Table structure for table `admintoken`
--

CREATE TABLE `admintoken` (
  `id` mediumint(9) NOT NULL,
  `token` varchar(128) NOT NULL,
  `expireDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admintoken`
--

INSERT INTO `admintoken` (`id`, `token`, `expireDate`) VALUES
(10, '864fede08c89cd922697d62e18f6adac3c2a9ba34e729b9cdf621ff2e49fac51ca3e78108353294211ab79fa034d00e5eef2ca05ad2ada2ea04f23ed3a0d86da', 1558423839);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `author` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'no-image.png',
  `addedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateOfRelease` year(4) NOT NULL,
  `src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `description`, `image`, `addedDate`, `dateOfRelease`, `src`) VALUES
(1, 'Անուն', 'Հեղինակ', '120 Էջեր', '201905141638082078701014.png', '2019-05-14 16:38:08', 1913, '201905141638081587789478.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `chairs`
--

CREATE TABLE `chairs` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `facultyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chairs`
--

INSERT INTO `chairs` (`id`, `name`, `facultyId`) VALUES
(1, 'Ճարտարապետական նախագծման եվ ճարտարապետական միջավայրի դիզայնի ամբիոն', 1),
(2, 'Ճարտարապետության տեսության, պատմաճարտարապետական ժառանգության վերականգման, վերակառուցման, գեղեցիկ արվեստի եւ պատմության ամբիոն', 1),
(3, 'Քաղաքաշինության ամբիոն', 1),
(4, 'Ճանապարհների և կամուրջների ամբիոն', 2),
(5, 'Շինարարական նյութերի, պատրաստվածքների եվ կոնստրուկցիաների արտադրության տեխնոլոգիայի ամբիոն', 2),
(6, 'Շինարարական մեխանիկայի ամբիոն', 2),
(7, 'Շինարարական կոնստրուկցիաների ամբիոն', 2),
(8, 'Ինժեներական գեոդեզիայի ամբիոն', 2),
(9, 'Հիդրոշինարարության, ջրային համակարգերի և  հիդրոէլեկտրակայանների ամբիոն', 2),
(10, 'Շինարարական արտադրության տեխնոլոգիայի և կազմակերպման ամբիոն', 2),
(11, 'Ջերմագազամատակարարման և օդափոխության ամբիոն', 3),
(12, 'Տեխնիկական թարգմանության ամբիոն', 3),
(13, 'Քիմիայի, կապակցող նյութերի և սիլիկատների ամբիոն', 3),
(14, 'Գեոէկոլոգիայի և կենսաանվտանգության ամբիոն', 3),
(15, 'Հիդրավլիկայի ամբիոն', 3),
(16, 'Շինարարական մեքենաների և երթեվեկության կազմակերպման ամբիոն', 3),
(17, 'Էկոնոմիկայի, իրավունքի և կառավարման ամբիոն', 4),
(18, 'Ինֆորմատիկայի, հաշվողական տեխնիկայի և կառավարման համակարգերի ամբիոն', 4),
(19, 'Գծանկարի, գունանկարի և քանդակի ամբիոն', 5),
(20, 'Դիզայնի ամբիոն', 5),
(21, 'Ինտերիերի և էքստերիերի դիզայնի  ամբիոն', 5),
(22, 'Գծագրության, համակարգչային գրաֆիկայի ամբիոն', 6),
(23, 'Նյութերի դիմադրության ամբիոն', 6),
(24, 'Տեսական մեխանիկայի ամբիոն', 6),
(25, 'Բարձրագույն մաթեմատիկայի ամբիոն', 6),
(26, 'Ֆիզիկայի և էլեկտրատեխնիկայի ամբիոն', 6),
(27, 'Լեզուների ամբիոն', 6);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`) VALUES
(1, 'Ճարտարապետության ֆակուլտետ'),
(2, 'Շինարարության ֆակուլտետ'),
(3, 'Քաղաքային տնտեսության եվ էկոլոգիայի ֆակուլտետ'),
(4, 'Կառավարման եվ տեխնոլոգիայի ֆակուլտետ'),
(5, 'Դիզայնի ֆակուլտետ'),
(6, 'Համահամալսարանական');

-- --------------------------------------------------------

--
-- Table structure for table `keywordbook`
--

CREATE TABLE `keywordbook` (
  `bookId` int(11) NOT NULL,
  `keywordId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keywordbook`
--

INSERT INTO `keywordbook` (`bookId`, `keywordId`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `keyword`) VALUES
(1, 'ewrewr'),
(2, 'werewrwe'),
(3, 'ewrewrwe'),
(4, 'ewrewrew'),
(5, 'werewr'),
(6, 'werwe'),
(7, 'ewrwerew');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `chairId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `chairId`) VALUES
(2, 'Փիլիսոփայություն', 17),
(3, 'Հայոց լեզու և խոսքի մշակում', 27),
(4, 'Ռուսաց լեզու', 27),
(5, 'Բարձրագույն մաթեմատիկա', 25),
(6, 'Ֆիզիկա', 26),
(7, 'Ինֆորմաթիկա', 18),
(8, 'Քաղպաշտպանության և արտակարք իրավիճակների հիմնահարցեր', 14),
(9, 'Գծագրական երկրաչափություն', 22),
(10, 'Տնտեսագիտության տեսություն', 17),
(11, 'Մասնագիտության ներածություն', 18),
(12, 'Հաշվողական տեխնիկայի և ինֆ․ մաթեմ․ հիմունքներ', 18),
(13, 'Կառավարման էլեկտրոնային համակարգեր', 18),
(14, 'Օտար լեզու', 27),
(15, 'Ստանդարտացում և սերտիֆիկացում', 18),
(16, 'Էկոլոգիայի հիմունքներ', 14),
(17, 'Մարկետինգ', 18),
(18, 'Դիսկրետ մաթեմատիկա', 25),
(19, 'Քոմփյութերային տեղեկատվության պաշտպանություն', 18),
(20, 'Պատահական գործընթաց', 25),
(21, 'Էլեկտրոնային հաշվիչ մեքենաներ', 18),
(22, 'Համակարգային վերլ․ և գործող․ հետազոտում', 18),
(23, 'Ծրագրավորման հիմունքներ', 18),
(24, 'Հաշվողական համակարգերի ճարտարապետություն', 18);

-- --------------------------------------------------------

--
-- Table structure for table `subjectbook`
--

CREATE TABLE `subjectbook` (
  `bookId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjectbook`
--

INSERT INTO `subjectbook` (`bookId`, `subjectId`) VALUES
(1, 2),
(1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indexes for table `admintoken`
--
ALTER TABLE `admintoken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chairs`
--
ALTER TABLE `chairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faucltyId` (`facultyId`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywordbook`
--
ALTER TABLE `keywordbook`
  ADD PRIMARY KEY (`bookId`,`keywordId`),
  ADD KEY `keywordId` (`keywordId`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chairId` (`chairId`);

--
-- Indexes for table `subjectbook`
--
ALTER TABLE `subjectbook`
  ADD PRIMARY KEY (`bookId`,`subjectId`),
  ADD KEY `subjectId` (`subjectId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admintoken`
--
ALTER TABLE `admintoken`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chairs`
--
ALTER TABLE `chairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chairs`
--
ALTER TABLE `chairs`
  ADD CONSTRAINT `chairs_ibfk_1` FOREIGN KEY (`facultyId`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keywordbook`
--
ALTER TABLE `keywordbook`
  ADD CONSTRAINT `keywordbook_ibfk_1` FOREIGN KEY (`keywordId`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keywordbook_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`chairId`) REFERENCES `chairs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjectbook`
--
ALTER TABLE `subjectbook`
  ADD CONSTRAINT `subjectbook_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subjectbook_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
