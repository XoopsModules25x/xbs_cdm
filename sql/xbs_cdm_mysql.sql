-- phpMyAdmin SQL Dump
-- version 2.6.0
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 02, 2004 at 11:12 AM
-- Server version: 4.0.21
-- PHP Version: 4.3.9
-- 
-- CDM SQL Dump for Xoops2
-- A Kitson Oct 2004
-- Thanks to Roberto Artigas <rartiga1@midsouth.rr.com> for supplying some data
-- 
-- This file is used by CDM install to populate
-- initial data.  Language is defaulted to EN (English - Base)
-- ------------------------------------------------------

-- 
-- Table structure for table cdm_code
-- 
-- Creation: Sep 29, 2004 at 09:54 PM
-- Last update: Oct 03, 2005 at 02:20 PM
-- 

CREATE TABLE cdm_code (
  id bigint(20) NOT NULL auto_increment,
  cd_set varchar(10) NOT NULL default '',
  cd_lang varchar(10) NOT NULL default 'EN',
  cd varchar(10) NOT NULL default '',
  cd_prnt varchar(10) default NULL,
  cd_value varchar(50) default NULL,
  cd_desc varchar(255) default NULL,
  cd_param varchar(255) default NULL,
  row_flag enum('Active','Defunct','Suspended') NOT NULL default 'Active',
  row_uid int(10) unsigned NOT NULL default '0',
  row_dt timestamp(14) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY cdm_code_main_index (cd_set,cd_lang,cd),
  KEY cdm_code_FKIndex1 (cd_set)
) ENGINE=MyISAM COMMENT='Sets of codes';

-- 
-- RELATIONS FOR TABLE cdm_code:
--   cd_prnt
--       cdm_code -> cd
--   cd_set
--       cdm_meta -> cd_set
-- 

-- 
-- Table structure for table cdm_meta
-- 
-- Creation: Sep 29, 2004 at 09:53 PM
-- Last update: Oct 03, 2005 at 02:20 PM

-- 

CREATE TABLE cdm_meta (
  cd_set varchar(10) NOT NULL default 'BASE',
  cd_type enum('INTEGER','BIGINT','CHAR','VARCHAR') NOT NULL default 'CHAR',
  cd_len int(10) unsigned NOT NULL default '0',
  val_type enum('INTEGER','BIGINT','CHAR','VARCHAR') NOT NULL default 'VARCHAR',
  val_len int(10) unsigned NOT NULL default '255',
  cd_desc varchar(255) default NULL,
  row_flag enum('Active','Defunct','Suspended') default 'Active',
  row_uid int(10) unsigned default '0',
  row_dt timestamp(14) NOT NULL,
  PRIMARY KEY  (cd_set)
) ENGINE=MyISAM COMMENT='Data about codes';

CREATE TABLE cdm_list (
  cd_set varchar(10) NOT NULL default '',
  cd_lang varchar(10) NOT NULL default 'EN',
  subset int(4) NOT NULL default '0',
  tree tinyint(4) NOT NULL default '0',
  fld varchar(10) NOT NULL default 'cd_value',
  cd_list text NOT NULL,
  PRIMARY KEY  (cd_set,cd_lang,subset,tree,fld)
) ENGINE=MyISAM COMMENT='Stores precompiled array of code=>code_value pairs for fast retrieval and use';

INSERT INTO cdm_meta (cd_set,cd_type,cd_len,val_type,val_len,cd_desc) VALUES ('LANGUAGE','CHAR',6,'VARCHAR',30,'Set of languages');
INSERT INTO cdm_meta (cd_set,cd_type,cd_len,val_type,val_len,cd_desc) VALUES ('COUNTRY','CHAR',2,'VARCHAR',35,'ISO Country Codes');
INSERT INTO cdm_meta (cd_set,cd_type,cd_len,val_type,val_len,cd_desc) VALUES ('CURRENCY','CHAR',3,'VARCHAR',45,'ISO Currency Codes');
INSERT INTO cdm_meta (cd_set, cd_type, cd_len, val_type, val_len, cd_desc) VALUES ('BASE', 'CHAR', 4, 'VARCHAR', 30, 'Base code set. Can be used by application for config values');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('BASE', 'EN', 'BASE', 'BASE', 'Base code set', 'The base code set. Do not remove!!', NULL);
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AD', NULL, 'Andorra', 'Andorra', 'iso3code=AND|iso3num=020|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AE', NULL, 'United Arab Emirates', 'United Arab Emirates', 'iso3code=ARE|iso3num=784|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AF', NULL, 'Afghanistan', 'Afghanistan', 'iso3code=AFG|iso3num=004|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AG', NULL, 'Antigua and Barbuda', 'Antigua and Barbuda', 'iso3code=ATG|iso3num=028|geolevel1=Islands|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AI', NULL, 'Anguilla', 'Anguilla', 'iso3code=AIA|iso3num=660|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AL', NULL, 'Albania', 'Albania', 'iso3code=ALB|iso3num=008|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AM', NULL, 'Armenia', 'Armenia', 'iso3code=ARM|iso3num=051|geolevel1=Country|geolevel2=State|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AN', NULL, 'Netherlands Antilles', 'Netherlands Antilles', 'iso3code=ANT|iso3num=532|geolevel1=Country|geolevel2=Islands|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AO', NULL, 'Angola', 'Angola', 'iso3code=AGO|iso3num=024|geolevel1=Country|geolevel2=District|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AQ', NULL, 'Antartica', 'Antartica', 'iso3code=ATA|iso3num=010|geolevel1=Country|geolevel2=Base|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AR', NULL, 'Argentina', 'Argentina', 'iso3code=ARG|iso3num=032|geolevel1=Country|geolevel2=Province|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AS', NULL, 'American Samoa', 'American Samoa', 'iso3code=ASM|iso3num=016|geolevel1=Territory|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AT', NULL, 'Austria', 'Austria', 'iso3code=AUT|iso3num=040|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AU', NULL, 'Australia', 'Australia', 'iso3code=AUS|iso3num=036|geolevel1=Country|geolevel2=Internal Division|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AW', NULL, 'Aruba', 'Aruba', 'iso3code=ABW|iso3num=533|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'AZ', NULL, 'Azerbaijan', 'Azerbaijan', 'iso3code=AZE|iso3num=031|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BA', NULL, 'Bosnia and Herzegowina', 'Bosnia and Herzegowina', 'iso3code=BIH|iso3num=070|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BB', NULL, 'Barbados', 'Barbados', 'iso3code=BRB|iso3num=052|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BE', NULL, 'Belgium', 'Belgium', 'iso3code=BEL|iso3num=056|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BF', NULL, 'Burkina Faso', 'Burkina Faso', 'iso3code=BFA|iso3num=854|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BG', NULL, 'Bulgaria', 'Bulgaria', 'iso3code=BGR|iso3num=100|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BH', NULL, 'Bahrain', 'Bahrain', 'iso3code=BHR|iso3num=048|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BI', NULL, 'Burundi', 'Burundi', 'iso3code=BDI|iso3num=108|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BJ', NULL, 'Benin', 'Benin', 'iso3code=BEN|iso3num=204|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BM', NULL, 'Bermuda', 'Bermuda', 'iso3code=BMU|iso3num=060|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BN', NULL, 'Brunei Darussalam', 'Brunei Darussalam', 'iso3code=BRN|iso3num=096|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BO', NULL, 'Bolivia', 'Bolivia', 'iso3code=BOL|iso3num=068|geolevel1=Country|geolevel2=Department|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BR', NULL, 'Brazil', 'Brazil', 'iso3code=BRA|iso3num=076|geolevel1=Country|geolevel2=States and Territories|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BS', NULL, 'Bahamas', 'Bahamas', 'iso3code=BHS|iso3num=044|geolevel1=Country|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BT', NULL, 'Bhutan', 'Bhutan', 'iso3code=BTN|iso3num=064|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BV', NULL, 'Bouvet Island', 'Bouvet Island', 'iso3code=BVT|iso3num=074|geolevel1=Island|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BW', NULL, 'Botswana', 'Botswana', 'iso3code=BWA|iso3num=072|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BY', NULL, 'Belarus', 'Belarus', 'iso3code=BLR|iso3num=112|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'BZ', NULL, 'Belize', 'Belize', 'iso3code=BLZ|iso3num=084|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CA', NULL, 'Canada', 'Canada', 'iso3code=CAN|iso3num=124|geolevel1=Country|geolevel2=Province|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CC', NULL, 'Cocos Island', 'Cocos Island', 'iso3code=CCK|iso3num=166|geolevel1=Island|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CD', NULL, 'The Dem. Republic of the Congo', 'The Dem. Republic of the Congo', 'iso3code=COD|iso3num=180|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CF', NULL, 'Central African Republic', 'Central African Republic', 'iso3code=CAF|iso3num=140|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CG', NULL, 'Congo', 'Congo', 'iso3code=COG|iso3num=178|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CH', NULL, 'Switzerland', 'Switzerland', 'iso3code=CHE|iso3num=756|geolevel1=Country|geolevel2=Canton|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CI', NULL, 'Cote D''Ivoire', 'Cote D''Ivoire', 'iso3code=CIV|iso3num=384|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CK', NULL, 'Cook Islands', 'Cook Islands', 'iso3code=COK|iso3num=184|geolevel1=Country|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CL', NULL, 'Chile', 'Chile', 'iso3code=CHL|iso3num=152|geolevel1=Country|geolevel2=State|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CM', NULL, 'Cameroon', 'Cameroon', 'iso3code=CMR|iso3num=120|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CN', NULL, 'China', 'China', 'iso3code=CHN|iso3num=156|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CO', NULL, 'Colombia', 'Colombia', 'iso3code=COL|iso3num=170|geolevel1=Country|geolevel2=Internal Division|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CR', NULL, 'Costa Rica', 'Costa Rica', 'iso3code=CRI|iso3num=188|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CU', NULL, 'Cuba', 'Cuba', 'iso3code=CUB|iso3num=192|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CV', NULL, 'Cape Verde', 'Cape Verde', 'iso3code=CPV|iso3num=132|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CX', NULL, 'Christmas Island', 'Christmas Island', 'iso3code=CXR|iso3num=162|geolevel1=Island|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CY', NULL, 'Cyprus', 'Cyprus', 'iso3code=CYP|iso3num=196|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'CZ', NULL, 'Czech Republic', 'Czech Republic', 'iso3code=CZE|iso3num=203|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DB', NULL, 'Bangladesh', 'Bangladesh', 'iso3code=BGD|iso3num=050|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DE', NULL, 'Germany', 'Germany', 'iso3code=DEU|iso3num=276|geolevel1=Country|geolevel2=Internal Division|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DJ', NULL, 'Djibouti', 'Djibouti', 'iso3code=DJI|iso3num=262|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DK', NULL, 'Denmark', 'Denmark', 'iso3code=DNK|iso3num=208|geolevel1=Country|geolevel2=County|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DM', NULL, 'Dominica', 'Dominica', 'iso3code=DMA|iso3num=212|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DO', NULL, 'Dominican Republic', 'Dominican Republic', 'iso3code=DOM|iso3num=214|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'DZ', NULL, 'Algeria', 'Algeria', 'iso3code=DZA|iso3num=012|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'EC', NULL, 'Ecuador', 'Ecuador', 'iso3code=ECU|iso3num=218|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'EE', NULL, 'Estonia', 'Estonia', 'iso3code=EST|iso3num=233|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'EG', NULL, 'Egypt', 'Egypt', 'iso3code=EGY|iso3num=818|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'EH', NULL, 'Western Sahara', 'Western Sahara', 'iso3code=ESH|iso3num=732|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ER', NULL, 'Eritrea', 'Eritrea', 'iso3code=ERI|iso3num=232|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ES', NULL, 'Spain', 'Spain', 'iso3code=ESP|iso3num=724|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ET', NULL, 'Ethiopia', 'Ethiopia', 'iso3code=ETH|iso3num=231|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FI', NULL, 'Finland', 'Finland', 'iso3code=FIN|iso3num=246|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FJ', NULL, 'Fiji', 'Fiji', 'iso3code=FJI|iso3num=242|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FK', NULL, 'Falkland Islands', 'Falkland Islands', 'iso3code=FLK|iso3num=238|geolevel1=Country|geolevel2=Island|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FM', NULL, 'Federated States of Micronesia', 'Federated States of Micronesia', 'iso3code=FSM|iso3num=583|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FO', NULL, 'Faeroe Islands', 'Faeroe Islands', 'iso3code=FRO|iso3num=234|geolevel1=Country|geolevel2=Island|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FR', NULL, 'France', 'France', 'iso3code=FRA|iso3num=250|geolevel1=Country|geolevel2=Department|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'FX', NULL, 'France, Metropolitan', 'France, Metropolitan', 'iso3code=FXX|iso3num=249|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GA', NULL, 'Gabon', 'Gabon', 'iso3code=GAB|iso3num=266|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GB', NULL, 'United Kingdom', 'United Kingdom', 'iso3code=GBR|iso3num=826|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GD', NULL, 'Grenada', 'Grenada', 'iso3code=GRD|iso3num=308|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GE', NULL, 'Georgia', 'Georgia', 'iso3code=GEO|iso3num=268|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GF', NULL, 'French Guiana', 'French Guiana', 'iso3code=GUF|iso3num=254|geolevel1=Country|geolevel2=District|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GH', NULL, 'Ghana', 'Ghana', 'iso3code=GHA|iso3num=288|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GI', NULL, 'Gibraltar', 'Gibraltar', 'iso3code=GIB|iso3num=292|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GL', NULL, 'Greenland', 'Greenland', 'iso3code=GRL|iso3num=304|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GM', NULL, 'Gambia', 'Gambia', 'iso3code=GMB|iso3num=270|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GN', NULL, 'Guinea', 'Guinea', 'iso3code=GIN|iso3num=324|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GP', NULL, 'Guadelupe', 'Guadelupe', 'iso3code=GLP|iso3num=312|geolevel1=Country|geolevel2=Islands|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GQ', NULL, 'Equatorial Guinea', 'Equatorial Guinea', 'iso3code=GNQ|iso3num=226|geolevel1=Country|geolevel2=Territory|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GR', NULL, 'Greece', 'Greece', 'iso3code=GRC|iso3num=300|geolevel1=Country|geolevel2=Region|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GS', NULL, 'South Georgia and Sandwich Is.', 'South Georgia and Sandwich Is.', 'iso3code=SGS|iso3num=239|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GT', NULL, 'Guatemala', 'Guatemala', 'iso3code=GTM|iso3num=320|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GU', NULL, 'Guam', 'Guam', 'iso3code=GUM|iso3num=316|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GW', NULL, 'Guinea-Bissau', 'Guinea-Bissau', 'iso3code=GNB|iso3num=624|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'GY', NULL, 'Guyana', 'Guyana', 'iso3code=GUY|iso3num=328|geolevel1=Country|geolevel2=District|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'HK', NULL, 'Hong Kong', 'Hong Kong', 'iso3code=HKG|iso3num=344|geolevel1=Area|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'HM', NULL, 'Heard and Mc Donald Islands', 'Heard and Mc Donald Islands', 'iso3code=HMD|iso3num=334|geolevel1=Islands|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'HN', NULL, 'Honduras', 'Honduras', 'iso3code=HND|iso3num=340|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'HR', NULL, 'Croatia', 'Croatia', 'iso3code=HRV|iso3num=191|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'HT', NULL, 'Haiti', 'Haiti', 'iso3code=HTI|iso3num=332|geolevel1=Country|geolevel2=Department|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'HU', NULL, 'Hungary', 'Hungary', 'iso3code=HUN|iso3num=348|geolevel1=Country|geolevel2=County|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ID', NULL, 'Indonesia', 'Indonesia', 'iso3code=IDN|iso3num=360|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IE', NULL, 'Ireland', 'Ireland', 'iso3code=IRL|iso3num=372|geolevel1=Country|geolevel2=District|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IL', NULL, 'Israel', 'Israel', 'iso3code=ISR|iso3num=376|geolevel1=Country|geolevel2=District|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IN', NULL, 'India', 'India', 'iso3code=IND|iso3num=356|geolevel1=Country|geolevel2=Internal Division|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IO', NULL, 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'iso3code=IOT|iso3num=086|geolevel1=Territory|geolevel2=Islands|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IQ', NULL, 'Iraq', 'Iraq', 'iso3code=IRQ|iso3num=368|geolevel1=Country|geolevel2=Governorate|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IR', NULL, 'Iran', 'Iran', 'iso3code=IRN|iso3num=364|geolevel1=Country|geolevel2=Internal Division|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IS', NULL, 'Iceland', 'Iceland', 'iso3code=ISL|iso3num=352|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'IT', NULL, 'Italy', 'Italy', 'iso3code=ITA|iso3num=380|geolevel1=Country|geolevel2=Region|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'JM', NULL, 'Jamaica', 'Jamaica', 'iso3code=JAM|iso3num=388|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'JO', NULL, 'Jordan', 'Jordan', 'iso3code=JOR|iso3num=400|geolevel1=Country|geolevel2=Governorate|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'JP', NULL, 'Japan', 'Japan', 'iso3code=JPN|iso3num=392|geolevel1=Country|geolevel2=Prefecture|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KE', NULL, 'Kenya', 'Kenya', 'iso3code=KEN|iso3num=404|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KG', NULL, 'Kyrgyzstan', 'Kyrgyzstan', 'iso3code=KGZ|iso3num=417|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KH', NULL, 'Cambodia', 'Cambodia', 'iso3code=KHM|iso3num=116|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KI', NULL, 'Kiribati', 'Kiribati', 'iso3code=KIR|iso3num=296|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KM', NULL, 'Comoros', 'Comoros', 'iso3code=COM|iso3num=174|geolevel1=Islands|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KN', NULL, 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', 'iso3code=KNA|iso3num=659|geolevel1=Islands|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KP', NULL, 'Korea, Democratic Republic of', 'Korea, Democratic Republic of', 'iso3code=PRK|iso3num=408|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KR', NULL, 'Korea, Republic of', 'Korea, Republic of', 'iso3code=KOR|iso3num=410|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KW', NULL, 'Kuwait', 'Kuwait', 'iso3code=KWT|iso3num=414|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KY', NULL, 'Cayman Islands', 'Cayman Islands', 'iso3code=CYM|iso3num=136|geolevel1=Country|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'KZ', NULL, 'Kazakhstan', 'Kazakhstan', 'iso3code=KAZ|iso3num=398|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LA', NULL, 'Lao People Democratic Republic', 'Lao People Democratic Republic', 'iso3code=LAO|iso3num=418|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LB', NULL, 'Lebanon', 'Lebanon', 'iso3code=LBN|iso3num=422|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LC', NULL, 'Saint Lucia', 'Saint Lucia', 'iso3code=LCA|iso3num=662|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LI', NULL, 'Liechtenstein', 'Liechtenstein', 'iso3code=LIE|iso3num=438|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LK', NULL, 'Sri Lanka', 'Sri Lanka', 'iso3code=LKA|iso3num=144|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LR', NULL, 'Liberia', 'Liberia', 'iso3code=LBR|iso3num=430|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LS', NULL, 'Lesotho', 'Lesotho', 'iso3code=LSO|iso3num=426|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LT', NULL, 'Lithuania', 'Lithuania', 'iso3code=LTU|iso3num=440|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LU', NULL, 'Luxembourg', 'Luxembourg', 'iso3code=LUX|iso3num=442|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LV', NULL, 'Latvia', 'Latvia', 'iso3code=LVA|iso3num=428|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'LY', NULL, 'Libyan Arab Jamahiriya', 'Libyan Arab Jamahiriya', 'iso3code=LBY|iso3num=434|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MA', NULL, 'Morocco', 'Morocco', 'iso3code=MAR|iso3num=504|geolevel1=Country|geolevel2=Division|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MC', NULL, 'Monaco', 'Monaco', 'iso3code=MCO|iso3num=492|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MD', NULL, 'Moldova, Republic of', 'Moldova, Republic of', 'iso3code=MDA|iso3num=498|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MG', NULL, 'Madagascar', 'Madagascar', 'iso3code=MDG|iso3num=450|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MH', NULL, 'Marshall Islands', 'Marshall Islands', 'iso3code=MHL|iso3num=584|geolevel1=Islands|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MK', NULL, 'Macedonia, Former Republic of', 'Macedonia, Former Republic of', 'iso3code=MKD|iso3num=807|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ML', NULL, 'Mali', 'Mali', 'iso3code=MLI|iso3num=466|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MM', NULL, 'Myanmar', 'Myanmar', 'iso3code=MMR|iso3num=104|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MN', NULL, 'Mongolia', 'Mongolia', 'iso3code=MNG|iso3num=496|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MO', NULL, 'Macau', 'Macau', 'iso3code=MAC|iso3num=446|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MP', NULL, 'Northern Mariana Islands', 'Northern Mariana Islands', 'iso3code=MNP|iso3num=580|geolevel1=Islands|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MQ', NULL, 'Martinique', 'Martinique', 'iso3code=MTQ|iso3num=474|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MR', NULL, 'Mauritania', 'Mauritania', 'iso3code=MRT|iso3num=478|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MS', NULL, 'Montserrat', 'Montserrat', 'iso3code=MSR|iso3num=500|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MT', NULL, 'Malta', 'Malta', 'iso3code=MLT|iso3num=470|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MU', NULL, 'Mauritius', 'Mauritius', 'iso3code=MUS|iso3num=480|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MV', NULL, 'Maldives', 'Maldives', 'iso3code=MDV|iso3num=462|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MW', NULL, 'Malawi', 'Malawi', 'iso3code=MWI|iso3num=454|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MX', NULL, 'Mexico', 'Mexico', 'iso3code=MEX|iso3num=484|geolevel1=Country|geolevel2=State|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MY', NULL, 'Malaysia', 'Malaysia', 'iso3code=MYS|iso3num=458|geolevel1=Country|geolevel2=State|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'MZ', NULL, 'Mozambique', 'Mozambique', 'iso3code=MOZ|iso3num=508|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NA', NULL, 'Namibia', 'Namibia', 'iso3code=NAM|iso3num=516|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NC', NULL, 'New Caledonia', 'New Caledonia', 'iso3code=NCL|iso3num=540|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NE', NULL, 'Niger', 'Niger', 'iso3code=NER|iso3num=562|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NF', NULL, 'Norfolk Island', 'Norfolk Island', 'iso3code=NFK|iso3num=574|geolevel1=Island|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NG', NULL, 'Nigeria', 'Nigeria', 'iso3code=NGA|iso3num=566|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NI', NULL, 'Nicaragua', 'Nicaragua', 'iso3code=NIC|iso3num=558|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NL', NULL, 'Netherlands', 'Netherlands', 'iso3code=NLD|iso3num=528|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NO', NULL, 'Norway', 'Norway', 'iso3code=NOR|iso3num=578|geolevel1=Country|geolevel2=County|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NP', NULL, 'Nepal', 'Nepal', 'iso3code=NPL|iso3num=524|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NR', NULL, 'Nauru', 'Nauru', 'iso3code=NRU|iso3num=520|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NU', NULL, 'Niue', 'Niue', 'iso3code=NIU|iso3num=570|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'NZ', NULL, 'New Zealand', 'New Zealand', 'iso3code=NZL|iso3num=554|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'OM', NULL, 'Oman', 'Oman', 'iso3code=OMN|iso3num=512|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PA', NULL, 'Panama', 'Panama', 'iso3code=PAN|iso3num=591|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PE', NULL, 'Peru', 'Peru', 'iso3code=PER|iso3num=604|geolevel1=Country|geolevel2=Department|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PF', NULL, 'French Polynesia', 'French Polynesia', 'iso3code=PYF|iso3num=258|geolevel1=Country|geolevel2=Island|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PG', NULL, 'Papua New Guinea', 'Papua New Guinea', 'iso3code=PNG|iso3num=598|geolevel1=Country|geolevel2=Islands|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PH', NULL, 'Philipines', 'Philipines', 'iso3code=PHL|iso3num=608|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PK', NULL, 'Pakistan', 'Pakistan', 'iso3code=PAK|iso3num=586|geolevel1=Country|geolevel2=Province|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PL', NULL, 'Poland', 'Poland', 'iso3code=POL|iso3num=616|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PM', NULL, 'St Pierre and Miquelon', 'St Pierre and Miquelon', 'iso3code=SPM|iso3num=666|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PN', NULL, 'Pitcairn Island', 'Pitcairn Island', 'iso3code=PCN|iso3num=612|geolevel1=Island|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PR', NULL, 'Puerto Rico', 'Puerto Rico', 'iso3code=PRI|iso3num=630|geolevel1=Country|geolevel2=District|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PT', NULL, 'Portugal', 'Portugal', 'iso3code=PRT|iso3num=620|geolevel1=Country|geolevel2=District|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PW', NULL, 'Palau', 'Palau', 'iso3code=PLW|iso3num=585|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'PY', NULL, 'Paraguay', 'Paraguay', 'iso3code=PRY|iso3num=600|geolevel1=Country|geolevel2=Department|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'QA', NULL, 'Qatar', 'Qatar', 'iso3code=QAT|iso3num=634|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'RE', NULL, 'Reunion', 'Reunion', 'iso3code=REU|iso3num=638|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'RO', NULL, 'Romenia', 'Romenia', 'iso3code=ROM|iso3num=642|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'RU', NULL, 'Russian Federation', 'Russian Federation', 'iso3code=RUS|iso3num=643|geolevel1=Country|geolevel2=Republic|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'RW', NULL, 'Rwanda', 'Rwanda', 'iso3code=RWA|iso3num=646|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SA', NULL, 'Saudi Arabia', 'Saudi Arabia', 'iso3code=SAU|iso3num=682|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SB', NULL, 'Solomon Islands', 'Solomon Islands', 'iso3code=SLB|iso3num=090|geolevel1=Islands|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SC', NULL, 'Seychelles', 'Seychelles', 'iso3code=SYC|iso3num=690|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SD', NULL, 'Sudan', 'Sudan', 'iso3code=SDN|iso3num=736|geolevel1=Country|geolevel2=Region|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SE', NULL, 'Sweeden', 'Sweeden', 'iso3code=SWE|iso3num=752|geolevel1=Country|geolevel2=County|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SG', NULL, 'Singapore', 'Singapore', 'iso3code=SGP|iso3num=702|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SH', NULL, 'St. Helena', 'St. Helena', 'iso3code=SHN|iso3num=654|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SI', NULL, 'Slovenia', 'Slovenia', 'iso3code=SVN|iso3num=705|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SJ', NULL, 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands', 'iso3code=SJM|iso3num=744|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SK', NULL, 'Slovakia', 'Slovakia', 'iso3code=SVK|iso3num=703|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SL', NULL, 'Sierra Leone', 'Sierra Leone', 'iso3code=SLE|iso3num=694|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SM', NULL, 'San Marino', 'San Marino', 'iso3code=SMR|iso3num=674|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SN', NULL, 'Senegal', 'Senegal', 'iso3code=SEN|iso3num=686|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SO', NULL, 'Somalia', 'Somalia', 'iso3code=SOM|iso3num=706|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SR', NULL, 'Suriname', 'Suriname', 'iso3code=SUR|iso3num=740|geolevel1=Country|geolevel2=District|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ST', NULL, 'Sao Tome and Principe', 'Sao Tome and Principe', 'iso3code=STP|iso3num=678|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SV', NULL, 'El Salvador', 'El Salvador', 'iso3code=SLV|iso3num=222|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SY', NULL, 'Syrian Arab Republic', 'Syrian Arab Republic', 'iso3code=SYR|iso3num=760|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'SZ', NULL, 'Swaziland', 'Swaziland', 'iso3code=SWZ|iso3num=748|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TC', NULL, 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'iso3code=TCA|iso3num=796|geolevel1=Island|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TD', NULL, 'Chad', 'Chad', 'iso3code=TCD|iso3num=148|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TF', NULL, 'French Southern Territories', 'French Southern Territories', 'iso3code=ATF|iso3num=260|geolevel1=Islands|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TG', NULL, 'Togo', 'Togo', 'iso3code=TGO|iso3num=768|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TH', NULL, 'Thailand', 'Thailand', 'iso3code=THA|iso3num=764|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TJ', NULL, 'Tajikistan', 'Tajikistan', 'iso3code=TJK|iso3num=762|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TK', NULL, 'Tokelau Islands', 'Tokelau Islands', 'iso3code=TKL|iso3num=772|geolevel1=Islands|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TM', NULL, 'Turkmenistan', 'Turkmenistan', 'iso3code=TKM|iso3num=795|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TN', NULL, 'Tunisia', 'Tunisia', 'iso3code=TUN|iso3num=788|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TO', NULL, 'Tonga Islands', 'Tonga Islands', 'iso3code=TON|iso3num=776|geolevel1=Country|geolevel2=Islands|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TP', NULL, 'East Timor', 'East Timor', 'iso3code=TMP|iso3num=626|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TR', NULL, 'Turkey', 'Turkey', 'iso3code=TUR|iso3num=792|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TT', NULL, 'Trinidad and Tobago', 'Trinidad and Tobago', 'iso3code=TTO|iso3num=780|geolevel1=Country|geolevel2=Islands|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TV', NULL, 'Tuvalu', 'Tuvalu', 'iso3code=TUV|iso3num=798|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TW', NULL, 'Taiwan', 'Taiwan', 'iso3code=TWN|iso3num=158|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'TZ', NULL, 'Tanzania, United Republic of', 'Tanzania, United Republic of', 'iso3code=TZA|iso3num=834|geolevel1=Country|geolevel2=Region|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'UA', NULL, 'Ukraine', 'Ukraine', 'iso3code=UKR|iso3num=804|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'UG', NULL, 'Uganda', 'Uganda', 'iso3code=UGA|iso3num=800|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'UM', NULL, 'United States Minor Islands', 'United States Minor Islands', 'iso3code=UMI|iso3num=581|geolevel1=Islands|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'US', NULL, 'United States of America', 'United States of America', 'iso3code=USA|iso3num=840|ms3code=USA|geolevel1=Country|geolevel2=State|geolevel3=County|geolevel4=City|geolevels=4');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'UY', NULL, 'Uruguay', 'Uruguay', 'iso3code=URY|iso3num=858|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'UZ', NULL, 'Uzbekistan', 'Uzbekistan', 'iso3code=UZB|iso3num=860|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VA', NULL, 'Holy See', 'Holy See', 'iso3code=VAT|iso3num=336|geolevel1=Religious City State|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VC', NULL, 'Saint Vincent and Grenadines', 'Saint Vincent and Grenadines', 'iso3code=VCT|iso3num=670|geolevel1=Islands|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VE', NULL, 'Venezuela', 'Venezuela', 'iso3code=VEN|iso3num=862|geolevel1=Country|geolevel2=State|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VG', NULL, 'Virgin Islands, British', 'Virgin Islands, British', 'iso3code=VGB|iso3num=092|geolevel1=Islands|geolevel2=Island|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VI', NULL, 'Virgin Islands, USA', 'Virgin Islands, USA', 'iso3code=VIR|iso3num=850|geolevel1=Territory|geolevel2=Islands|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VN', NULL, 'Vietnam', 'Vietnam', 'iso3code=VNM|iso3num=704|geolevel1=Country|geolevel2=State|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'VU', NULL, 'Vanuatu', 'Vanuatu', 'iso3code=VUT|iso3num=584|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'WF', NULL, 'Wallis and Futuna Islands', 'Wallis and Futuna Islands', 'iso3code=WLF|iso3num=876|geolevel1=Island|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'WS', NULL, 'Samoa', 'Samoa', 'iso3code=WSM|iso3num=882|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'YE', NULL, 'Yemen', 'Yemen', 'iso3code=YEM|iso3num=887|ms3code=YEM|geolevel1=Country|geolevel2=City|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'YT', NULL, 'Mayotte', 'Mayotte', 'iso3code=MYT|iso3num=175|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'YU', NULL, 'Yugoslavia', 'Yugoslavia', 'iso3code=YUG|iso3num=891|geolevel1=Country|geolevel2=Internal Division|geolevel3=City|geolevels=3');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ZA', NULL, 'South Africa', 'South Africa', 'iso3code=ZAF|iso3num=710|ms3code=ZAF|geolevel1=Country|geolevel2=Province|geolevels=2');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ZE', NULL, 'Zimbabwe', 'Zimbabwe', 'iso3code=ZWE|iso3num=716|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ZM', NULL, 'Zambia', 'Zambia', 'iso3code=ZMB|iso3num=894|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('COUNTRY', 'EN', 'ZR', NULL, 'Zaire', 'Zaire', 'iso3code=ZAR|iso3num=180|geolevel1=Country|geolevels=1');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ADP', NULL, 'Andorra Peseta', 'Andorra Peseta', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=020');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AED', NULL, 'UAE Dirham', 'UAE Dirham', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=784');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AFA', NULL, 'Afghanistan Afghani', 'Afghanistan Afghani', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=004');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ALL', NULL, 'Albania Lek', 'Albania Lek', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=008');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AMD', NULL, 'Armenia Dram', 'Armenia Dram', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AMS', NULL, 'Armenia Dram', 'Armenia Dram', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ANG', NULL, 'Netherlands Antillian Guilder', 'Netherlands Antillian Guilder', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=532');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AOK', NULL, 'Angola Kwanza', 'Angola Kwanza', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=024');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AON', NULL, 'Angola New Kwanza', 'Angola New Kwanza', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AOR', NULL, 'Angola Kwanza Reajustado', 'Angola Kwanza Reajustado', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ARA', NULL, 'Argentina Austral', 'Argentina Austral', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=032');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ARP', NULL, 'Argentina Peso', 'Argentina Peso', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ATS', NULL, 'Austria Schilling', 'Austria Schilling', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AUD', NULL, 'Australia Dollar', 'Australia Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=036');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AWF', NULL, 'Aruba Florin', 'Aruba Florin', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AWG', NULL, 'Aruba Guilder', 'Aruba Guilder', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=533');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AZM', NULL, 'Azerbaijan Manat', 'Azerbaijan Manat', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'AZS', NULL, 'Azerbaijan Manat', 'Azerbaijan Manat', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BAD', NULL, 'Bosnia Dinar', 'Bosnia Dinar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BAM', NULL, 'Bosnia Convertible Mark', 'Bosnia Convertible Mark', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BBD', NULL, 'Barbados Dollar', 'Barbados Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=052');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BDT', NULL, 'Bangladesh Taka', 'Bangladesh Taka', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=050');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BEC', NULL, 'Convertible Franc', 'Convertible Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=993');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BEF', NULL, 'Belgium Franc', 'Belgium Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=056');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BEL', NULL, 'Financial Franc', 'Financial Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=992');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BES', NULL, 'Belarus Ruble', 'Belarus Ruble', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BGL', NULL, 'Bulgaria Lev', 'Bulgaria Lev', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=100');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BHD', NULL, 'Bahrain Dinar', 'Bahrain Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=048');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BIF', NULL, 'Burundi Franc', 'Burundi Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=108');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BMD', NULL, 'Bermuda Dollar', 'Bermuda Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=060');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BND', NULL, 'Brunei Darussalam Dollar', 'Brunei Darussalam Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=096');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BOB', NULL, 'Bolivia Boliviano', 'Bolivia Boliviano', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=068');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BOP', NULL, 'Bolivia Boliviano', 'Bolivia Boliviano', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BOV', NULL, 'Bolivia Mvdol', 'Bolivia Mvdol', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BPS', NULL, 'Canton and Enderbury Pound', 'Canton and Enderbury Pound', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BRC', NULL, 'Brazil Cruzeiro', 'Brazil Cruzeiro', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=076');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BRL', NULL, 'Brazil Real', 'Brazil Real', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BRR', NULL, 'Brazil Real', 'Brazil Real', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BSD', NULL, 'Bahamas Dollar', 'Bahamas Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=044');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BTN', NULL, 'Bhutam Ngultrum', 'Bhutam Ngultrum', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=064');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BTR', NULL, 'Bhutan Rupee', 'Bhutan Rupee', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BUK', NULL, 'Burma Kyat', 'Burma Kyat', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=102');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BWP', NULL, 'Botswana Pula', 'Botswana Pula', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=072');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BYB', NULL, 'Belarus Ruble', 'Belarus Ruble', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BYR', NULL, 'Belarus Ruble', 'Belarus Ruble', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'BZD', NULL, 'Belize Dollar', 'Belize Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=084');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CAD', NULL, 'Canada Dollar', 'Canada Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=124|whole=[100,Dollar,Dollars]|fraction=[1,Cent,Cents]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CDF', NULL, 'DRC Franc', 'DRC Franc', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CFP', NULL, 'CFP Franc', 'CFP Franc', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CHF', NULL, 'Swiss Franc', 'Swiss Franc', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=756|whole=[100,Franc,Francs]|fraction=[1,Rappen,Rappens]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CLF', NULL, 'Chile Unidades de fomento', 'Chile Unidades de fomento', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CLP', NULL, 'Chile Peso', 'Chile Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=152');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CNY', NULL, 'China Yuan Renminbi', 'China Yuan Renminbi', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=156');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'COP', NULL, 'Colombia Peso', 'Colombia Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=170');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CRC', NULL, 'Costa Rica Colon', 'Costa Rica Colon', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=188');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CSK', NULL, 'Czech Republic Koruna', 'Czech Republic Koruna', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=200');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CUP', NULL, 'Cuba Peso', 'Cuba Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=192');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CVE', NULL, 'Cape Verde Escudo', 'Cape Verde Escudo', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=132');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CYP', NULL, 'Cyprus Pound', 'Cyprus Pound', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=196');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'CZK', NULL, 'Czech Republic Koruna', 'Czech Republic Koruna', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'DEM', NULL, 'Germany Mark', 'Germany Mark', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=280|whole=[100,Deutsche Mark,Deutsche Marks]|fraction=[1,Pfennig,Pfennigs]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'DJF', NULL, 'Djibouti Franc', 'Djibouti Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=262');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'DKK', NULL, 'Denmark Krone', 'Denmark Krone', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=208');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'DOP', NULL, 'Dominican Republic Peso', 'Dominican Republic Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=214');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'DZD', NULL, 'Algeria Dinar', 'Algeria Dinar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=012');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ECS', NULL, 'Ecuador Sucre', 'Ecuador Sucre', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=218');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ECV', NULL, 'Ecuador Valor Constante', 'Ecuador Valor Constante', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'EEK', NULL, 'Estonia Kroon', 'Estonia Kroon', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'EGP', NULL, 'Egypt Pound', 'Egypt Pound', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=818');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ERN', NULL, 'Eritrea Nakfa', 'Eritrea Nakfa', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ESB', NULL, 'Convertible Peseta', 'Convertible Peseta', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=995');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ESP', NULL, 'Spain Peseta', 'Spain Peseta', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=724');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ESS', NULL, 'Ecuador Sucre', 'Ecuador Sucre', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ETB', NULL, 'Ethiopia Birr', 'Ethiopia Birr', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=230');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'EUR', NULL, 'European Spot', 'European Spot', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'FIM', NULL, 'Finland Markka', 'Finland Markka', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=246');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'FJD', NULL, 'Fiji Dollar', 'Fiji Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=242');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'FKP', NULL, 'Falkland Islands Pound', 'Falkland Islands Pound', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=238');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'FRF', NULL, 'France Franc', 'France Franc', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=250|whole=[100,Franc,Francs]|fraction=[1,Centime,Centimes]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GBP', NULL, 'England Pound Sterling', 'England Pound Sterling', 'digits=2|thousands=,|decimals=.|symbol=Â£|iso3num=826|whole=[100,Pound,Pound]|fraction=[1,Pence,Pence]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GEL', NULL, 'Georgia Lari', 'Georgia Lari', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GHC', NULL, 'Ghana Cedi', 'Ghana Cedi', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=288');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GIP', NULL, 'Gibraltar Pound', 'Gibraltar Pound', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=292');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GMD', NULL, 'Ghambia Dalasi', 'Ghambia Dalasi', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=270');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GNF', NULL, 'Guinea Franc', 'Guinea Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=324');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GNS', NULL, 'Guinea Franc', 'Guinea Franc', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GRD', NULL, 'Greece Drachma', 'Greece Drachma', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=300');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GTQ', NULL, 'Guatemala Quetzal', 'Guatemala Quetzal', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=320');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GWP', NULL, 'Guinea-Bissau Peso', 'Guinea-Bissau Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=624');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'GYD', NULL, 'Guyana Dollar', 'Guyana Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=328');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'HKD', NULL, 'Hong Kong Dollar', 'Hong Kong Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=344');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'HNL', NULL, 'Honduras Lempira', 'Honduras Lempira', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=340');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'HRK', NULL, 'Croatia Kuna', 'Croatia Kuna', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'HTG', NULL, 'Haiti Gourde', 'Haiti Gourde', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=332');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'HUF', NULL, 'Hungary Forint', 'Hungary Forint', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=348');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'IDR', NULL, 'Indonesia Rupiah', 'Indonesia Rupiah', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=360');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'IEP', NULL, 'Ireland Punt', 'Ireland Punt', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=372');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ILS', NULL, 'Israel Shekel', 'Israel Shekel', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'INR', NULL, 'India Rupee', 'India Rupee', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=356');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'IQD', NULL, 'Iraq Dinar', 'Iraq Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=368');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'IRR', NULL, 'Iran Rial', 'Iran Rial', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=360');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ISK', NULL, 'Iceland Krona', 'Iceland Krona', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=352');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ISS', NULL, 'Israel Shekel', 'Israel Shekel', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=376');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ITL', NULL, 'Italy Lira', 'Italy Lira', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=380|whole=[100,Lira,Lira]|fraction=[1,Centisimi,Centisimi]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'JMD', NULL, 'Jamaica Dollar', 'Jamaica Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=388');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'JOD', NULL, 'Jordan Dinar', 'Jordan Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=400');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'JPY', NULL, 'Japan Yen', 'Japan Yen', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=392|whole=[100,Yen,Yen]|fraction=[1,Sen,Sen]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KES', NULL, 'Kenya Shilling', 'Kenya Shilling', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=404');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KGS', NULL, 'Kyrgyzstan Som', 'Kyrgyzstan Som', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KHR', NULL, 'Cambodia Riel', 'Cambodia Riel', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=116');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KMF', NULL, 'Comoros Franc', 'Comoros Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=174');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KPW', NULL, 'North Korea Won', 'North Korea Won', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=408');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KRW', NULL, 'South Korea Won', 'South Korea Won', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=410');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KTS', NULL, 'Kazakhstan Tenge', 'Kazakhstan Tenge', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KWD', NULL, 'Kuwait Dinar', 'Kuwait Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=414');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KYD', NULL, 'Cayman Islands Dollar', 'Cayman Islands Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=136');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KYS', NULL, 'Kyrgyzstan Som', 'Kyrgyzstan Som', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'KZT', NULL, 'Kazakhstan Tenge', 'Kazakhstan Tenge', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LAK', NULL, 'Laos Kip', 'Laos Kip', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=418');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LBP', NULL, 'Lebanon Pound', 'Lebanon Pound', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=422');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LKR', NULL, 'Sri Lanka Rupee', 'Sri Lanka Rupee', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=144');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LRD', NULL, 'Liberia Dollar', 'Liberia Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=430');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LSL', NULL, 'Lesotho Loti', 'Lesotho Loti', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=426');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LTL', NULL, 'Lithuania Lita', 'Lithuania Lita', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LTT', NULL, 'Lithuania Lita', 'Lithuania Lita', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LUF', NULL, 'Luxembourg Franc', 'Luxembourg Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=442');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LVL', NULL, 'Latvia Lat', 'Latvia Lat', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LVR', NULL, 'Latvia Lat', 'Latvia Lat', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'LYD', NULL, 'Libya Dinar', 'Libya Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=434');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MAD', NULL, 'Morocco Dirham', 'Morocco Dirham', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=504');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MDL', NULL, 'Moldova Leu', 'Moldova Leu', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MGF', NULL, 'Madagascar Malagasy Franc', 'Madagascar Malagasy Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=450');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MKD', NULL, 'Macedonia Denar', 'Macedonia Denar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MMK', NULL, 'Myanmar Kyat', 'Myanmar Kyat', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MNT', NULL, 'Mongoloa Tugrik', 'Mongoloa Tugrik', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=496');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MOP', NULL, 'Macau Pataca', 'Macau Pataca', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=446');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MRO', NULL, 'Mauritania Ouguiya', 'Mauritania Ouguiya', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=478');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MTL', NULL, 'Malta Lira', 'Malta Lira', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=470');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MUR', NULL, 'Mauritius Rupee', 'Mauritius Rupee', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=480');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MVR', NULL, 'Malidives Rufiyaa', 'Malidives Rufiyaa', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=462');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MVS', NULL, 'Moldova Leu', 'Moldova Leu', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MWK', NULL, 'Malawi Kwacha', 'Malawi Kwacha', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=454');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MXP', NULL, 'Mexico Peso', 'Mexico Peso', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=484');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MXV', NULL, 'Mexico Unidad de Inversion', 'Mexico Unidad de Inversion', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MYR', NULL, 'Malaysia Ringgit', 'Malaysia Ringgit', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=458');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'MZM', NULL, 'Mozambique Metical', 'Mozambique Metical', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=508');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NAD', NULL, 'Namibia Dollar', 'Namibia Dollar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NGN', NULL, 'Nigeria Naira', 'Nigeria Naira', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=566');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NIC', NULL, 'Nicaragua Cordoba Oro', 'Nicaragua Cordoba Oro', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=558');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NIO', NULL, 'Nicaragua Cordoba Oro', 'Nicaragua Cordoba Oro', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NLG', NULL, 'Netherlands Guilder', 'Netherlands Guilder', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=528|whole=[100,Guilder,Guilders]|fraction=[1,Cent,Cents]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NOK', NULL, 'Norway Kroner', 'Norway Kroner', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=578');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NPR', NULL, 'Nepal Rupee', 'Nepal Rupee', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=524');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'NZD', NULL, 'New Zealand Dollar', 'New Zealand Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=554');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'OMR', NULL, 'Oman Sul Rial', 'Oman Sul Rial', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=512');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PAB', NULL, 'Panama Balboa', 'Panama Balboa', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=590');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PEI', NULL, 'Inti', 'Inti', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=604');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PEN', NULL, 'Peru Nuevo Sol', 'Peru Nuevo Sol', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PGK', NULL, 'Papau New Guinea Kina', 'Papau New Guinea Kina', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=598');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PHP', NULL, 'Philippines Peso', 'Philippines Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=608');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PKR', NULL, 'Pakistan Rupee', 'Pakistan Rupee', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=586');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PLN', NULL, 'Poland Zloty', 'Poland Zloty', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PLZ', NULL, 'Poland Zloty', 'Poland Zloty', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=616');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PSS', NULL, 'Peru Nuevo Sol', 'Peru Nuevo Sol', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PTE', NULL, 'Portugal Escudo', 'Portugal Escudo', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=620');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'PYG', NULL, 'Paraguay Guarani', 'Paraguay Guarani', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=600');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'QAR', NULL, 'Qatar Rial', 'Qatar Rial', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=634');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ROL', NULL, 'Romania Leu', 'Romania Leu', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=642');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'RUB', NULL, 'Russian Federation Ruble', 'Russian Federation Ruble', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'RUR', NULL, 'Russian Federation Ruble', 'Russian Federation Ruble', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'RWF', NULL, 'Rwanda Franc', 'Rwanda Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=646');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SAR', NULL, 'Saudi Arabia Riyal', 'Saudi Arabia Riyal', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=682');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SBD', NULL, 'Solomon Islands Dollar', 'Solomon Islands Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=090');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SCR', NULL, 'Seychelles Rupee', 'Seychelles Rupee', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=690');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SDD', NULL, 'Sudan Dinar', 'Sudan Dinar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SEK', NULL, 'Sweden Krona', 'Sweden Krona', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=752');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SGD', NULL, 'Singapore Dollar', 'Singapore Dollar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SHP', NULL, 'Saint Helena Pound', 'Saint Helena Pound', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=654');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SIT', NULL, 'Slovenia Tolar', 'Slovenia Tolar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SKK', NULL, 'Slovakia Koruna', 'Slovakia Koruna', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SLL', NULL, 'Sierra Leone Leone', 'Sierra Leone Leone', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=694');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SOS', NULL, 'Somalia Shilling', 'Somalia Shilling', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=706');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SRG', NULL, 'Suriname Guilder', 'Suriname Guilder', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=740');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'STD', NULL, 'Sao Tome and Principe Dobra', 'Sao Tome and Principe Dobra', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=678');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SUR', NULL, 'Russian Federation Rouble', 'Russian Federation Rouble', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=810');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SVC', NULL, 'El Salvador Colon', 'El Salvador Colon', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=222');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SYP', NULL, 'Syria Pound', 'Syria Pound', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=760');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'SZL', NULL, 'Swaziland Lilangeni', 'Swaziland Lilangeni', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=748');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'THB', NULL, 'Thailand Baht', 'Thailand Baht', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=764');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TJR', NULL, 'Tajikistan Ruble', 'Tajikistan Ruble', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TMM', NULL, 'Turkmenistan Manat', 'Turkmenistan Manat', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TND', NULL, 'Tunisia Dinar', 'Tunisia Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=788');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TOP', NULL, 'Tonga Pa''anga', 'Tonga Pa''anga', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=776');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TPE', NULL, 'East Timor Escudo', 'East Timor Escudo', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=626');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TRL', NULL, 'Turkey Lira', 'Turkey Lira', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=792');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TTD', NULL, 'Trinidad and Tobago Dollar', 'Trinidad and Tobago Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=780');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TWD', NULL, 'Taiwan Dollar', 'Taiwan Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=901');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'TZS', NULL, 'Tanzania Shilling', 'Tanzania Shilling', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=834');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UAH', NULL, 'Ukraine Hryvnia', 'Ukraine Hryvnia', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UAK', NULL, 'Ukraine Hryvnia', 'Ukraine Hryvnia', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UGS', NULL, 'Uganda Shilling', 'Uganda Shilling', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=800');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UGX', NULL, 'Uganda Shilling', 'Uganda Shilling', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'USD', NULL, 'USA Dollar', 'USA Dollar', 'digits=2|thousands=,|decimals=.|symbol=$|iso3num=840|whole=[100,Dollar,Dollars]|fraction=[1,Cent,Cents]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'USN', NULL, 'USA Dollar (Next Day)', 'USA Dollar (Next Day)', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=997|whole=[100,Dollar,Dollars]|fraction=[1,Cent,Cents]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'USS', NULL, 'USA Dollar (Same Day)', 'USA Dollar (Same Day)', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=998|whole=[100,Dollar,Dollars]|fraction=[1,Cent,Cents]');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UYP', NULL, 'Uruguay Peso', 'Uruguay Peso', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=858');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UYU', NULL, 'Uruguay Peso', 'Uruguay Peso', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'UZS', NULL, 'Uzbekistan Som', 'Uzbekistan Som', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'VEB', NULL, 'Venezuela Bolivar', 'Venezuela Bolivar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=862');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'VND', NULL, 'Viet Nam Dong', 'Viet Nam Dong', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=704');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'VUV', NULL, 'Vanuatu Vatu', 'Vanuatu Vatu', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=548');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'WST', NULL, 'Western Samoa Tala', 'Western Samoa Tala', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=882');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XAF', NULL, 'CFA Franc BEAC', 'CFA Franc BEAC', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=950');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XAG', NULL, 'New York Silver Ounces', 'New York Silver Ounces', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=961');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XAU', NULL, 'New York Gold Ounces', 'New York Gold Ounces', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=959');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XBA', NULL, 'European Composite (EURCO)', 'European Composite (EURCO)', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=955');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XBB', NULL, 'European Monetary (EMU-6)', 'European Monetary (EMU-6)', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=956');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XBC', NULL, 'European Account 9 (EUA-9)', 'European Account 9 (EUA-9)', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=957');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XBD', NULL, 'European Account 17 (EUA-17)', 'European Account 17 (EUA-17)', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=958');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XCD', NULL, 'East Caribbean Dollar', 'East Caribbean Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=951');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XDR', NULL, 'I.M.F. Special Drawing Right', 'I.M.F. Special Drawing Right', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=960');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XEC', NULL, 'East Caribbean Dollar', 'East Caribbean Dollar', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XEU', NULL, 'European Currency Unit (ECU)', 'European Currency Unit (ECU)', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=954');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XFO', NULL, 'Gold-Franc', 'Gold-Franc', 'digits=0|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XOF', NULL, 'CFA Franc BCEAO', 'CFA Franc BCEAO', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=952');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XPD', NULL, 'New York Palladium Ounces', 'New York Palladium Ounces', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'XPF', NULL, 'CFP Franc', 'CFP Franc', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=953');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'YDD', NULL, 'Yemen Dinar', 'Yemen Dinar', 'digits=3|thousands=,|decimals=.|symbol=|iso3num=720');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'YER', NULL, 'Yemen Rial', 'Yemen Rial', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=886');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'YUN', NULL, 'Yugoslavia New Dinar', 'Yugoslavia New Dinar', 'digits=0|thousands=,|decimals=.|symbol=|iso3num=890');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ZAL', NULL, 'Lesotho Financial Rand', 'Lesotho Financial Rand', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=991');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ZAR', NULL, 'South Africa Rand', 'South Africa Rand', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=710');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ZMK', NULL, 'Zambia Kwacha', 'Zambia Kwacha', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=894');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ZRN', NULL, 'Zaire New Zaire', 'Zaire New Zaire', 'digits=2|thousands=,|decimals=.|symbol=');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ZRZ', NULL, 'Zaire Zaire', 'Zaire Zaire', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=180');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc, cd_param) VALUES ('CURRENCY', 'EN', 'ZWD', NULL, 'Zimbabwe Dollar', 'Zimbabwe Dollar', 'digits=2|thousands=,|decimals=.|symbol=|iso3num=716');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'AF', NULL, 'Afrikaans', 'Afrikaans', 'locale=af');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'AR', NULL, 'Arabic', 'Arabic (Base)', 'locale=ar');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARAE', 'AR', 'Arabic', 'Arabic (UAE)', 'locale=ar-ae');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARBH', 'AR', 'Arabic', 'Arabic (Bahrain)', 'locale=ar-bh');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARDZ', 'AR', 'Arabic', 'Arabic (Algeria)', 'locale=ar-dz');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'AREG', 'AR', 'Arabic', 'Arabic (Egypt)', 'locale=ar-eg');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARIQ', 'AR', 'Arabic', 'Arabic (Iraq)', 'locale=ar-iq');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARJO', 'AR', 'Arabic', 'Arabic (Jordan)', 'locale=ar-jo');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARKW', 'AR', 'Arabic', 'Arabic (Kuwait)', 'locale=ar-kw');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARLB', 'AR', 'Arabic', 'Arabic (Lebanon)', 'locale=ar-lb');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARLY', 'AR', 'Arabic', 'Arabic (Libya)', 'locale=ar-ly');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARMA', 'AR', 'Arabic', 'Arabic (Morocco)', 'locale=ar-ma');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'AROM', 'AR', 'Arabic', 'Arabic (Oman)', 'locale=ar-om');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARQA', 'AR', 'Arabic', 'Arabic (Qatar)', 'locale=ar-qa');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARSA', 'AR', 'Arabic', 'Arabic (Saudi Arabia)', 'locale=ar-sa');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARSY', 'AR', 'Arabic', 'Arabic (Syria)', 'locale=ar-sy');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARTN', 'AR', 'Arabic', 'Arabic (Tunisia)', 'locale=ar-tn');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ARYE', 'AR', 'Arabic', 'Arabic (Yemen)', 'locale=ar-ye');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'BE', NULL, 'Belarussian', 'Belarussian', 'locale=be');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'BG', NULL, 'Bulgarian', 'Bulgarian', 'locale=bg');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'CA', NULL, 'Catalan', 'Catalan', 'locale=ca');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'CS', NULL, 'Czech', 'Czech', 'locale=cs');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'DA', NULL, 'Danish', 'Danish', 'locale=da');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'DE', NULL, 'German', 'German (Germany)', 'locale=de');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'DEAT', 'DE', 'German', 'German (Austria)', 'locale=de-at');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'DECH', 'DE', 'German', 'German (Switzerland)', 'locale=de-ch');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'DELI', 'DE', 'German', 'German (Leichtenstein)', 'locale=de-li');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'DELU', 'DE', 'German', 'German (Luxembourgh)', 'locale=de-lu');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'EL', NULL, 'Greek', 'Greek', 'locale=el');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'EN', NULL, 'English', 'English (Base)', 'locale=en');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENAU', 'EN', 'English', 'English (Australian)', 'locale=en-au');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENBZ', 'EN', 'English', 'English (Belize)', 'locale=en-bz');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENCA', 'EN', 'English', 'English (Canadian)', 'locale=en-ca');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENGB', 'EN', 'English', 'English (United Kingdom)', 'locale=en-gb');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENIE', 'EN', 'English', 'English (Ireland)', 'locale=en-ie');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENJM', 'EN', 'English', 'English (Jamaica)', 'locale=en-jm');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENKY', 'EN', 'English', 'English (Caribbean)', 'locale=en-ky');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENNZ', 'EN', 'English', 'English (New Zealand)', 'locale=en-nz');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENTT', 'EN', 'English', 'English (Trinidad)', 'locale=en-tt');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENUS', 'EN', 'English', 'English (American)', 'locale=en-us');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ENZA', 'EN', 'English', 'English (South Africa)', 'locale=en-za');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ES', NULL, 'Spanish', 'Spanish (Modern)', 'locale=es');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESAR', 'ES', 'Spanish', 'Spanish (Argentina)', 'locale=es-ar');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESBO', 'ES', 'Spanish', 'Spanish (Bolivia)', 'locale=es-bo');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESCL', 'ES', 'Spanish', 'Spanish (Chile)', 'locale=es-cl');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESCO', 'ES', 'Spanish', 'Spanish (Colombia)', 'locale=es-co');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESCR', 'ES', 'Spanish', 'Spanish (Costa Rica)', 'locale=es-cr');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESDO', 'ES', 'Spanish', 'Spanish (Dominican Republic)', 'locale=es-do');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESEC', 'ES', 'Spanish', 'Spanish (Ecuador)', 'locale=es-ec');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESGT', 'ES', 'Spanish', 'Spanish (Guatemala)', 'locale=es-gt');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESHN', 'ES', 'Spanish', 'Spanish (Honduras)', 'locale=es-hn');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESMX', 'ES', 'Spanish', 'Spanish (Mexico)', 'locale=es-mx');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESNI', 'ES', 'Spanish', 'Spanish (Nicaragua)', 'locale=es-ni');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESPA', 'ES', 'Spanish', 'Spanish (Panama)', 'locale=es-pa');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESPE', 'ES', 'Spanish', 'Spanish (Peru)', 'locale=es-pe');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESPR', 'ES', 'Spanish', 'Spanish (Puerto Rico)', 'locale=es-pr');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESPY', 'ES', 'Spanish', 'Spanish (Paraguay)', 'locale=es-py');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESSV', 'ES', 'Spanish', 'Spanish (El Salvador)', 'locale=es-sv');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESUY', 'ES', 'Spanish', 'Spanish (Uruguay)', 'locale=es-uy');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ESVE', 'ES', 'Spanish', 'Spanish (Venezuela)', 'locale=es-ve');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ET', NULL, 'Estonian', 'Estonian', 'locale=et');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'EU', NULL, 'Basque', 'Basque', 'locale=eu');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FA', NULL, 'Farsi', 'Farsi', 'locale=fa');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FI', NULL, 'Finnish', 'Finnish', 'locale=fi');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FO', NULL, 'Faroese', 'Faroese', 'locale=fo');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FR', NULL, 'French', 'French (France)', 'locale=fr');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FRBE', 'FR', 'French', 'French (Belgium)', 'locale=fr-be');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FRCA', 'FR', 'French', 'French (Canada)', 'locale=fr-ca');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FRCH', 'FR', 'French', 'French (Switzerland)', 'locale=fr-ch');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'FRLU', 'FR', 'French', 'French (Luxembourgh)', 'locale=fr-lu');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'GD', NULL, 'Gaelic', 'Gaelic (Scots)', 'locale=gd');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'HE', NULL, 'Hebrew', 'Hebrew', 'locale=he');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'HI', NULL, 'Hindi', 'Hindi', 'locale=hi');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'HR', NULL, 'Croatian', 'Croatian', 'locale=hr');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'HU', NULL, 'Hungarian', 'Hungarian', 'locale=hu');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'IN', NULL, 'Indonesian', 'Indonesian', 'locale=in');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'IS', NULL, 'Icelandic', 'Icelandic', 'locale=is');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'IT', NULL, 'Italian', 'Italian (Italy)', 'locale=it');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ITCH', 'IT', 'Italian', 'Italian (Switzerland)', 'locale=it-ch');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'JA', NULL, 'Japanense', 'Japanese', 'locale=ja');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'JI', NULL, 'Yiddish', 'Yiddish', 'locale=ji');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'KO', NULL, 'Korean', 'Korean (Extended Wansung)', 'locale=ko');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'LT', NULL, 'Lithuanian', 'Lithuanian', 'locale=lt');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'LV', NULL, 'Letish', 'Lettish', 'locale=lv');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'MK', NULL, 'Macedonian', 'Macedonian', 'locale=mk');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'MS', NULL, 'Malay', 'Malay (Malaysia)', 'locale=ms');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'MT', NULL, 'Maltese', 'Maltese', 'locale=mt');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'NL', NULL, 'Dutch', 'Dutch (Nederland)', 'locale=nl');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'NLBE', 'NL', 'Dutch', 'Dutch (Belgium)', 'locale=nl-be');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'NO', NULL, 'Norwegian', 'Norwegian (Bokmal)', 'locale=no');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'PL', NULL, 'Polish', 'Polish', 'locale=pl');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'PT', NULL, 'Portuguese', 'Portuguese', 'locale=pt');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'PTBR', 'PT', 'Portuguese', 'Portuguese (Brazil)', 'locale=pt-br');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'RM', NULL, 'Rhaeto-Romance', 'Rhaeto-Romance', 'locale=rm');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'RO', NULL, 'Romanian', 'Romanian', 'locale=ro');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ROMO', 'RO', 'Romanian', 'Romanian (Moldova)', 'locale=ro-mo');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'RU', NULL, 'Russian', 'Russian', 'locale=ru');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'RUMO', 'RU', 'Russian', 'Russian (Moldova)', 'locale=ru-mo');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SK', NULL, 'Slovak', 'Slovak', 'locale=sk');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SL', NULL, 'Slovenian', 'Slovenian', 'locale=sl');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SQ', NULL, 'Albanian', 'Albanian', 'locale=sq');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SR', NULL, 'Serbian', 'Serbian (Cyrillic)', 'locale=sr');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SV', NULL, 'Swedish', 'Swedish', 'locale=sv');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SVFI', 'SV', 'Swedish', 'Swedish (Finland)', 'locale=sv-fi');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'SX', NULL, 'Sutu', 'Sutu', 'locale=sx');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'TH', NULL, 'Thai', 'Thai', 'locale=th');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'TN', NULL, 'Setsuana', 'Setsuana', 'locale=tn');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'TR', NULL, 'Turkish', 'Turkish', 'locale=tr');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'TS', NULL, 'Tsonga', 'Tsonga', 'locale=ts');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'UK', NULL, 'Ukrainian', 'Ukrainian', 'locale=uk');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'UR', NULL, 'Urdu', 'Urdu (Pakistan)', 'locale=ur');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'VI', NULL, 'Vietnamese', 'Vietnamese', 'locale=vi');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'XH', NULL, 'Xhosa', 'Xhosa', 'locale=xh');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ZH', NULL, 'Chinese', 'Chinese (Base)', 'locale=zh');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ZHCN', 'ZH', 'Chinese', 'Chinese (PRC)', 'locale=zh-cn');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ZHHK', 'ZH', 'Chinese', 'Chinese (Hong Kong)', 'locale=zh-hk');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ZHSG', 'ZH', 'Chinese', 'Chinese (Singapore)', 'locale=zh-sg');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ZHTW', 'ZH', 'Chinese', 'Chinese (Taiwan)', 'locale=zh-tw');
INSERT INTO cdm_code (cd_set, cd_lang, cd, cd_prnt, cd_desc, cd_value, cd_param) VALUES ('LANGUAGE', 'EN', 'ZU', NULL, 'Zulu', 'Zulu', 'locale=zu');
        
