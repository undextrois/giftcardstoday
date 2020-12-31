-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 14, 2005 at 05:24 AM
-- Server version: 3.23.56
-- PHP Version: 4.3.10
-- 
-- Database: `giftcardtoday_com`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_login_info`
-- 

DROP TABLE IF EXISTS `_gct_login_info`;
CREATE TABLE IF NOT EXISTS `_gct_login_info` (
  `loginid` int(5) unsigned zerofill NOT NULL auto_increment,
  `user` varchar(16) NOT NULL default '',
  `pass` varchar(32) NOT NULL default '',
  `question` int(11) NOT NULL default '0',
  `answer` varchar(32) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`loginid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `_gct_login_info`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_reg_ip_history`
-- 

DROP TABLE IF EXISTS `_gct_reg_ip_history`;
CREATE TABLE IF NOT EXISTS `_gct_reg_ip_history` (
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
CREATE TABLE IF NOT EXISTS `_gct_secret_question` (
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
CREATE TABLE IF NOT EXISTS `_gct_store_category` (
  `category_id` int(8) unsigned zerofill NOT NULL auto_increment,
  `caption` varchar(64) NOT NULL default '',
  `icon` varchar(64) NOT NULL default '',
  `ndate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`category_id`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `_gct_store_category`
-- 

INSERT INTO `_gct_store_category` VALUES (00000001, 'Men''s Apparel', 'r_apprael.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000002, 'Women''s Apparel', 'r_apprael_women.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000003, 'Air Miles', 'airplane.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000004, 'Auto Related', 'r_auto.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000005, 'Beauty & Spa', 'r_beauty.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000006, 'Books CDs, and Movies', 'r_books.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000007, 'Children & Toys', 'r_child.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000008, 'Dining & Food', 'r_food.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000009, 'Electronics', 'r_electronics.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000010, 'Emailable Certificates', 'r_certificates.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000011, 'Entertainment', 'r_entertaiment.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000012, 'Gifts', 'r_gifts.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000013, 'Home', 'r_home.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000014, 'Luxury / Specialty', 'r_luxury.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000015, 'Shopping Malls', 'r_shopping.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000016, 'Sports / Vacations', 'r_sports.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000017, 'Teens', 'r_teens.gif', '0000-00-00');
INSERT INTO `_gct_store_category` VALUES (00000018, 'Everything Else', 'r_everything.gif', '0000-00-00');

-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_store_tbl`
-- 

DROP TABLE IF EXISTS `_gct_store_tbl`;
CREATE TABLE IF NOT EXISTS `_gct_store_tbl` (
  `store_id` int(5) unsigned zerofill NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `idate` datetime NOT NULL default '0000-00-00 00:00:00',
  `icon` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`store_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `_gct_store_tbl`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `_gct_user_info`
-- 

DROP TABLE IF EXISTS `_gct_user_info`;
CREATE TABLE IF NOT EXISTS `_gct_user_info` (
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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `_gct_user_info`
-- 

