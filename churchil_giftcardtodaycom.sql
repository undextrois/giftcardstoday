-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 23, 2005 at 06:08 AM
-- Server version: 3.23.56
-- PHP Version: 4.3.10
-- 
-- Database: `churchil_giftcardtodaycom`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_feedback_info`
-- 

DROP TABLE IF EXISTS `_gct_feedback_info`;
CREATE TABLE `_gct_feedback_info` (
  `feedback_id` int(5) unsigned zerofill NOT NULL auto_increment,
  `product_id` int(5) unsigned zerofill NOT NULL default '00000',
  `login_id` int(5) unsigned zerofill NOT NULL default '00000',
  `rating` int(11) NOT NULL default '0',
  `feedback` varchar(9) NOT NULL default '',
  `comment` varchar(220) NOT NULL default '',
  `fdate` date NOT NULL default '0000-00-00',
  `usertype` char(1) NOT NULL default '',
  PRIMARY KEY  (`feedback_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `_gct_feedback_info`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_login_info`
-- 

DROP TABLE IF EXISTS `_gct_login_info`;
CREATE TABLE `_gct_login_info` (
  `loginid` int(5) unsigned zerofill NOT NULL auto_increment,
  `user` varchar(16) NOT NULL default '',
  `pass` varchar(32) NOT NULL default '',
  `question` int(11) NOT NULL default '0',
  `answer` varchar(32) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  `auth_code` varchar(32) NOT NULL default '',
  `status` varchar(9) NOT NULL default '',
  `mdate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`loginid`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `_gct_login_info`
-- 

INSERT INTO `_gct_login_info` VALUES (00001, 'amiagin', 'testing', 0, 'Job File', 1, 'c5c566a38a575832c124af37431a9a7c', 'Active', '2005-02-21 04:16:27');
INSERT INTO `_gct_login_info` VALUES (00002, 'tukninoy', 'testing', 0, 'Job File', 2, '5732d4cb048afdce0a0bdc96e5d6e936', 'Active', '2005-02-21 04:16:27');

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_product_info`
-- 

DROP TABLE IF EXISTS `_gct_product_info`;
CREATE TABLE `_gct_product_info` (
  `product_id` int(5) unsigned zerofill NOT NULL auto_increment,
  `store_id` mediumint(5) unsigned zerofill NOT NULL default '00000',
  `class` varchar(4) NOT NULL default '',
  `cs_value` float NOT NULL default '0',
  `face_value` float NOT NULL default '0',
  `feedback_id` int(5) unsigned zerofill NOT NULL default '00000',
  `rating` int(11) NOT NULL default '0',
  `cert_type` varchar(9) NOT NULL default '',
  `comment` varchar(220) NOT NULL default '',
  PRIMARY KEY  (`product_id`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `_gct_product_info`
-- 

INSERT INTO `_gct_product_info` VALUES (00001, 00001, 'DGC', 3.7, 5.2, 00000, 0, 'In-Store', '');
INSERT INTO `_gct_product_info` VALUES (00002, 00001, 'DGC', 25, 29.61, 00000, 0, 'In-Store', 'Valid at all Abercrombie locations including Hollister.');
INSERT INTO `_gct_product_info` VALUES (00003, 00001, 'DGC', 36, 40, 00000, 0, 'In-Store', '');
INSERT INTO `_gct_product_info` VALUES (00004, 00001, 'DGC', 42, 50, 00000, 0, 'In-Store', 'This gift card is redeemable for merchandise only at all Abercrombie & Fitch and abercrombie locations. This gift card carries no expiration date.');
INSERT INTO `_gct_product_info` VALUES (00005, 00001, 'FVGC', 25, 25, 00000, 0, 'In-Store', '');
INSERT INTO `_gct_product_info` VALUES (00006, 00001, 'FVGC', 50, 50, 00000, 0, 'in-Store', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_reg_ip_history`
-- 

DROP TABLE IF EXISTS `_gct_reg_ip_history`;
CREATE TABLE `_gct_reg_ip_history` (
  `regid` int(10) unsigned zerofill NOT NULL auto_increment,
  `ip_addr` int(11) NOT NULL default '0',
  `h_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `geo_location` varchar(32) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`regid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `_gct_reg_ip_history`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_secret_question`
-- 

DROP TABLE IF EXISTS `_gct_secret_question`;
CREATE TABLE `_gct_secret_question` (
  `question_id` int(10) unsigned zerofill NOT NULL auto_increment,
  `question` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`question_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `_gct_secret_question`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_store_category`
-- 

DROP TABLE IF EXISTS `_gct_store_category`;
CREATE TABLE `_gct_store_category` (
  `category_id` int(5) unsigned zerofill NOT NULL auto_increment,
  `caption` varchar(64) NOT NULL default '',
  `icon` varchar(64) NOT NULL default '',
  `available` char(1) NOT NULL default 'N',
  `ndate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`category_id`)
) TYPE=MyISAM AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `_gct_store_category`
-- 

INSERT INTO `_gct_store_category` VALUES (00001, 'Men''s Apparel', 'r_apprael.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00002, 'Women''s Apparel', 'r_apprael_women.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00003, 'Air Miles', 'airplane.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00004, 'Auto Related', 'r_auto.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00005, 'Beauty & Spa', 'r_beauty.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00006, 'Books CDs, and Movies', 'r_books.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00007, 'Children & Toys', 'r_child.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00008, 'Dining & Food', 'r_food.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00009, 'Electronics', 'r_electronics.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00010, 'Emailable Certificates', 'r_certificates.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00011, 'Entertainment', 'r_entertaiment.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00012, 'Gifts', 'r_gifts.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00013, 'Home', 'r_home.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00014, 'Luxury / Specialty', 'r_luxury.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00015, 'Shopping Malls', 'r_shopping.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00016, 'Sports / Vacations', 'r_sports.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00017, 'Teens', 'r_teens.gif', '1', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00018, 'Everything Else', 'r_everything.gif', '1', '0000-00-00');

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_store_info`
-- 

DROP TABLE IF EXISTS `_gct_store_info`;
CREATE TABLE `_gct_store_info` (
  `store_id` int(5) unsigned zerofill NOT NULL auto_increment,
  `store_name` varchar(64) NOT NULL default '',
  `store_available` char(1) NOT NULL default 'N',
  `store_website` varchar(120) NOT NULL default '',
  `store_locator` varchar(120) NOT NULL default '',
  `store_description` text NOT NULL,
  `store_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `store_logo` varchar(32) NOT NULL default '',
  `store_status` int(11) NOT NULL default '0',
  `store_category_id` int(5) unsigned zerofill NOT NULL default '00000',
  PRIMARY KEY  (`store_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `_gct_store_info`
-- 

INSERT INTO `_gct_store_info` VALUES (00001, 'Abercrombie & Fitch', 'Y', 'http://www.abercrombie.com', 'http://www.abercrombie.com', 'Abercrombie & Fitch focuses on providing high-quality merchandise that compliments the casual classic American lifestyle. The merchandise is sold in retail stores throughout the United States and through catalogs. ', '0000-00-00 00:00:00', 'Abercrombie.jpg', 1, 00001);
INSERT INTO `_gct_store_info` VALUES (00002, 'Adidas', 'Y', 'http://www.thestore.adidas.com', 'http://www.thestore.adidas.com', 'Adidas is one of the most popular sports brands around. They have the most stylish clothing, footwear, and accessories anywhere. ', '0000-00-00 00:00:00', '', 0, 00001);

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_user_info`
-- 

DROP TABLE IF EXISTS `_gct_user_info`;
CREATE TABLE `_gct_user_info` (
  `userid` int(10) unsigned zerofill NOT NULL auto_increment,
  `fname` varchar(64) NOT NULL default '',
  `lname` varchar(64) NOT NULL default '',
  `street_addr1` varchar(120) NOT NULL default '',
  `street_addr2` varchar(120) NOT NULL default '',
  `city` varchar(64) NOT NULL default '',
  `state` varchar(32) NOT NULL default '',
  `zip_code` varchar(15) NOT NULL default '',
  `country` varchar(32) NOT NULL default '',
  `primary_no` varchar(32) NOT NULL default '',
  `secondary_no` varchar(32) NOT NULL default '',
  `email` varchar(64) NOT NULL default '',
  `date_of_birth` date NOT NULL default '0000-00-00',
  `info_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `_gct_user_info`
-- 

INSERT INTO `_gct_user_info` VALUES (0000000001, 'Cris', 'del Rosario', 'Camarin', '', 'Caloocan', 'Manila', '1117', 'Philippines', '12345678', '87654321', 'amiagin03@yahoo.com', '0000-00-00', '2005-02-18 16:36:01');
INSERT INTO `_gct_user_info` VALUES (0000000002, 'Cris', 'del Rosario', 'Camarin', '', 'Caloocan', 'Manila', '1117', 'Philippines', '12345678', '87654321', 'tukninoy@yahoo.com', '0000-00-00', '2005-02-18 16:39:21');
