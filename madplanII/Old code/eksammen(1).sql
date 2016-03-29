-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2015 at 01:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eksammen`
--

-- --------------------------------------------------------

--
-- Table structure for table `favoriter`
--

CREATE TABLE IF NOT EXISTS `favoriter` (
  `fID` int(11) NOT NULL AUTO_INCREMENT,
  `retID` int(11) NOT NULL,
  `brugerID` int(11) NOT NULL,
  PRIMARY KEY (`fID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `favoriter`
--

INSERT INTO `favoriter` (`fID`, `retID`, `brugerID`) VALUES
(7, 87, 1),
(8, 86, 1),
(9, 86, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ingrad`
--

CREATE TABLE IF NOT EXISTS `ingrad` (
  `IngID` int(11) NOT NULL AUTO_INCREMENT,
  `RetID` int(11) NOT NULL,
  `Maengte` int(11) NOT NULL,
  `Enhed` text NOT NULL,
  `Navn` text NOT NULL,
  PRIMARY KEY (`IngID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=206 ;

--
-- Dumping data for table `ingrad`
--

INSERT INTO `ingrad` (`IngID`, `RetID`, `Maengte`, `Enhed`, `Navn`) VALUES
(127, 86, 500, 'g', 'Hakket Ã˜ksekÃ¸d'),
(128, 86, 500, 'g', 'LÃ¸g'),
(129, 86, 500, 'ml', 'Hakede Tomater'),
(130, 86, 500, 'ml', 'Hvide bÃ¸nner'),
(131, 86, 500, 'ml', 'Kidney BÃ¸nner'),
(132, 86, 70, 'g', 'Tomatpure'),
(133, 86, 1, 'st', 'Chili, stÃ¸dt'),
(134, 87, 250, 'ml', 'skummetmÃ¦lk'),
(135, 87, 150, 'g', 'Hvedemel'),
(136, 87, 1, 'st', 'Ã¦g'),
(137, 87, 1, 'st', 'sukker spsk'),
(138, 87, 1, 'st', 'bage pulver tsk'),
(139, 87, 25, 'g', 'smÃ¸r'),
(140, 89, 300, 'g', 'havregryn'),
(141, 90, 300, 'g', 'havregryn'),
(142, 98, 200, 'g', 'stuff'),
(143, 101, 200, 'g', 'makka '),
(144, 102, 2, 'g', 'kaka'),
(145, 103, 2, 'g', 'makaka'),
(146, 104, 2, 'g', 'makak'),
(147, 105, 2, 'g', 'nsgsg'),
(148, 106, 1, 'g', 'skjgowhgowr'),
(149, 107, 2, 'g', 'afsuhdaou'),
(150, 108, 2, 'g', 'aeghrfh'),
(151, 108, 20, 'g', 'makaka KÃ¸d'),
(152, 113, 2, 'g', 'dtjdj'),
(153, 114, 2, 'g', 'arhrhwr'),
(154, 115, 2, 'g', 'rwehrjhet'),
(155, 115, 0, 'g', 'ghsfhsfhfhfh'),
(156, 115, 3, 'g', 'dgsdg'),
(157, 116, 0, 'g', 'hfdffd'),
(158, 117, 2, 'g', 'tjjkryj'),
(159, 119, 1, 'g', 'wrrh'),
(160, 119, 2, 'g', 'egaeghwr'),
(161, 120, 2, 'g', 'hshs'),
(162, 120, 2, 'g', 'agdhsh'),
(163, 120, 2, 'g', 'etujetjeyj'),
(164, 120, 5, 'g', 'dgngd'),
(165, 120, 2, 'g', 'rhwrehe'),
(166, 120, 2, 'g', 'rtjryjr'),
(167, 120, 2, 'g', 'tjytjtujtuju'),
(168, 120, 2, 'g', 'dngdndg'),
(169, 120, 2, 'g', 'rgrgrg'),
(170, 120, 2, 'g', 'ergreg'),
(171, 120, 2, 'g', 'hee'),
(172, 125, 250, 'g', 'shfhfsj'),
(173, 125, 5, 'g', 'djgjdgj'),
(174, 125, 250, 'g', 'hs<hhhhhhhhhhhhhhhhhhhhhhhh'),
(175, 125, 4, 'g', 'jdggggggggggggggggggg'),
(176, 127, 2, 'g', 'sfhfjssfj'),
(177, 128, 2, 'g', 'rwwuwtu'),
(178, 130, 2, 'g', 'whrrhpwjrhoiwrjoijwrh'),
(179, 131, 3, 'g', 'arhwrhwrht'),
(180, 132, 3, 'g', 'wrujtwj'),
(181, 132, 250, 'g', 'whrwjhsfhsfhfssfhhfs'),
(182, 133, 3, 'g', 'rwhsrhwhrhw'),
(183, 134, 2, 'g', 'kiiihjk'),
(184, 135, 2, 'g', 'hasarht'),
(185, 141, 2, 'g', 'makaka'),
(186, 142, 2, 'g', 'fqeapjgpdjvsg'),
(187, 143, 200, 'g', 'aklggdjladj'),
(188, 144, 200, 'g', 'sdgljghosdhgol'),
(189, 145, 2, 'g', 'gldjglsjdg'),
(190, 146, 200, 'g', 'hej'),
(191, 147, 2, 'g', 'dlkggdlajdls'),
(192, 147, 250, 'g', 'dfhgsldghlsdhglsdglsdgjsdlggsddg'),
(193, 148, 20, 'g', 'dgÃ¦gjaÃ¦pjgpÃ¦aqjgepqejggdsgsdgsdgsddsg'),
(194, 149, 2, 'g', 'faÃ¦jgÃ¦ajgadÃ¦gjbxfffggfx'),
(195, 150, 2, 'g', 'dkggsdlsdldsgklsdgklndgsdgskjsdgdgsdgsdgssdgkjhasdgegskjj'),
(196, 151, 2, 'g', 'slgmÃ¦sjgÃ¦dsjgdgÃ¦ssdgggggggggggggg'),
(197, 152, 200, 'g', 'hej'),
(198, 153, 2, 'g', 'dsgdklgnsdlkgnlsdkgn'),
(199, 153, 155, 'g', 'adgÃ¦lmdgÃ¦admgÃ¦adm'),
(200, 153, 2, 'g', 'daffdda'),
(201, 153, 1, 'g', 'dfdfad'),
(202, 153, 2, 'g', 'sdsdfdsf'),
(203, 171, 2, 'g', 'sljhd'),
(204, 172, 2, 'g', 'sdgdg'),
(205, 175, 90, 'g', '&lt;b&gt;test');

-- --------------------------------------------------------

--
-- Table structure for table `madplan`
--

CREATE TABLE IF NOT EXISTS `madplan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Dato` date NOT NULL,
  `Dag` text CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `Ret` text CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `AntalP` int(11) NOT NULL,
  `type` text CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `Bruger` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `madplan`
--

INSERT INTO `madplan` (`ID`, `Dato`, `Dag`, `Ret`, `AntalP`, `type`, `Bruger`) VALUES
(33, '2015-03-31', 'Tirsdag ', 'Chili con carne', 2, 'Aftensmad', 1),
(34, '2015-04-01', 'Onsdag ', 'Amerikanske pandekager', 2, 'Aftensmad', 1),
(37, '2015-04-02', 'Torsdag ', 'Chili con carne', 2, 'Aftensmad', 1),
(38, '2015-04-03', 'Fredag ', 'Amerikanske pandekager', 2, 'Aftensmad', 1),
(39, '2015-04-04', 'LÃ¸rdag ', 'Chili con carne', 2, 'Aftensmad', 1),
(40, '2015-04-05', 'SÃ¸ndag ', 'Chili con carne', 2, 'Aftensmad', 1),
(41, '2015-03-31', 'Tirsdag ', 'Chili con carne', 2, 'Frokkost', 1),
(42, '2015-04-01', 'Onsdag ', 'Chili con carne', 2, 'Frokkost', 1),
(43, '2015-04-02', 'Torsdag ', 'Chili con carne', 2, 'Frokkost', 1),
(44, '2015-04-06', 'Mandag ', 'Amerikanske pandekager', 2, 'Aftensmad', 1),
(45, '2015-04-07', 'Tirsdag ', 'Amerikanske pandekager', 2, 'Aftensmad', 1),
(46, '2015-04-08', 'Onsdag ', 'Amerikanske pandekager', 2, 'Aftensmad', 1),
(47, '2015-04-09', 'Torsdag ', 'Amerikanske pandekager', 3, 'Aftensmad', 1),
(48, '2015-04-10', 'Fredag ', 'Amerikanske pandekager', 2, 'Aftensmad', 1),
(49, '2015-03-31', 'Tirsdag ', 'Chili con carne', 2, 'Morgenmad', 1),
(50, '2015-04-01', 'Onsdag ', 'Chili con carne', 2, 'Morgenmad', 1),
(51, '2015-04-03', 'Fredag ', 'Amerikanske pandekager', 2, 'Frokkost', 1),
(52, '2015-04-02', 'Torsdag ', 'Chili con carne', 2, 'Morgenmad', 1),
(53, '2015-04-03', 'Fredag ', 'Chili con carne', 4, 'Morgenmad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `madplanbruger`
--

CREATE TABLE IF NOT EXISTS `madplanbruger` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `madplanbruger`
--

INSERT INTO `madplanbruger` (`ID`, `Name`, `Password`, `Email`) VALUES
(1, 'Taras', '3e676e7cac96f4740ff743ba1b86d057', 'bro@bro.com'),
(2, 'test1', '3e676e7cac96f4740ff743ba1b86d057', 'test@test.dk'),
(3, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(4, 'Taras', '311a139d3b1475c2b62d410bda546afe', 'tarass777@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `opskreft`
--

CREATE TABLE IF NOT EXISTS `opskreft` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NavnO` text NOT NULL,
  `Status` text NOT NULL,
  `opskreft` text NOT NULL,
  `ForfO` text NOT NULL,
  `Populaer` int(11) NOT NULL,
  `AntalP` int(11) NOT NULL,
  `Dato` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;

--
-- Dumping data for table `opskreft`
--

INSERT INTO `opskreft` (`ID`, `NavnO`, `Status`, `opskreft`, `ForfO`, `Populaer`, `AntalP`, `Dato`) VALUES
(86, 'Chili con carne', 'Active', 'Rist kÃ¸det pÃ¥ en tÃ¸r slip-let-pande. pil lÃ¸gene, hak dem fint og vend dem i kÃ¸det. TilsÃ¦t tomater og kog det igennem. Lad det simre 5 min.  TilsÃ¦t de to slags bÃ¸nner, tomatpure og chilipulver. Kog retten igennem og smag til med salt', 'bro@bro.com', 4, 4, '2015-03-05'),
(87, 'Amerikanske pandekager', 'Active', 'Bland alle de ovenstÃ¥ende ingredienser i en skÃ¥l, til dejen er ensartet.  Varm panden, evt. en spejlÃ¦gspande eller blinispande, og kom en lille smule smÃ¸r pÃ¥. Kom dejen pÃ¥ panden i klatter, som skal flyde ud af sig selv (ca Â½ dl.). Bag dem, indtil overfladen bobler og undersiden er lysebrun. Vend pandekagerne og bag videre.  Det tager et par minutter pÃ¥ hver side.  Server pandekagerne i stakke med smÃ¸r og ahornsirup, evt. med lidt bacon eller pÃ¸lser til, hvis det skal vÃ¦re rigtig amerikansk', 'bro@bro.com', 7, 6, '2015-03-05'),
(90, 'HavregrÃ¸d2', 'Active', 'Dette er Marks opskrift ', 'bro@bro.com', 1, 2, '2015-03-19'),
(153, 'dvkgklsdgksl', 'Active', 'hej det er et forsÃ¸g \ndu mÃ¥ ikke lave detslndkjsgnlsjdnglksdg\ndsgjdhglsdnglkdsnglksdnglksdnglkdsngsdknglksdnglkdsnglksdnglksdnglksdgnlksdgnlksdnglksdnglksdnglksdgnlkdsgnlksdgnlksdgnlksdngklsdnglksdgnlksdnglksdgnlksdnglksdnglksdnglkdsnglksdgnldksgnlkdsgndslg\n', 'bro@bro.com', 0, 25, '2015-03-29'),
(154, 'shogdsldg', 'Not Aktive', '', 'tarass777@hotmail.com', 0, 2, '2015-04-02'),
(172, 'gsdgsd', 'Active', 'slgdkhdlskgnv', 'bro@bro.com', 0, 2, '2015-04-07'),
(178, 'hej ala emil22', 'Not Aktive', '', 'bro@bro.com', 0, 2, '2015-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `requestbruger`
--

CREATE TABLE IF NOT EXISTS `requestbruger` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Navn` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `requestbruger`
--

INSERT INTO `requestbruger` (`ID`, `Navn`, `Password`, `Email`) VALUES
(2, 'test1', '098f6bcd4621d373cade4e832627b4f6', 'test@test.dk'),
(3, 'Taras', '3e676e7cac96f4740ff743ba1b86d057', 'bro@bro.com'),
(4, 'Test', '3e676e7cac96f4740ff743ba1b86d057', 'bro@bro.com'),
(5, 'stuff', '49d02d55ad10973b7b9d0dc9eba7fdf0', 'bro@bro.com'),
(6, 'Bro', '7694f4a66316e53c8cdd9d9954bd611d', 'bro@bro.com'),
(7, 'maka', 'b65cb28b7c2569d90631cef9c8a8c29e', 'bro@bro.com'),
(8, 'kama', '2c68e1d50809e4ae357bcffe1fc99d2a', 'bro@bro.com'),
(9, 'kama', '2c68e1d50809e4ae357bcffe1fc99d2a', 'bro@bro.com'),
(10, 'kama', '2c68e1d50809e4ae357bcffe1fc99d2a', 'bro@bro.com'),
(11, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(12, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(13, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(14, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(15, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(16, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(17, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(18, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(19, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(20, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(21, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(22, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(23, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(24, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(25, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(26, 'i', '098f6bcd4621d373cade4e832627b4f6', 'makaka@makaka.com'),
(27, 'sf', '2510c39011c5be704182423e3a695e91', 'h@h.com'),
(28, 'sf', '2510c39011c5be704182423e3a695e91', 'h@h.com'),
(29, 'sf', '2510c39011c5be704182423e3a695e91', 'h@h.com'),
(30, 'Taras', '5541c7b5a06c39b267a5efae6628e003', 'mot@gma.cpm'),
(31, 'Taras', '5541c7b5a06c39b267a5efae6628e003', 'mot@gma.cpm'),
(32, 'Taras', '311a139d3b1475c2b62d410bda546afe', 'tarass777@hotmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
