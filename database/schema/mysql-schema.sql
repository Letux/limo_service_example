/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `airlines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airlines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `airport_id` tinyint(3) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `iata` char(2) NOT NULL,
  `icao` char(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airports` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `short_name` varchar(3) NOT NULL,
  `zip` int(5) unsigned NOT NULL,
  `pickup_tax` decimal(5,2) NOT NULL,
  `dropoff_tax` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `auto_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_rates` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `empty` tinyint(1) NOT NULL COMMENT 'холостой ход',
  `level` smallint(5) unsigned NOT NULL,
  `rate` float NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `browse_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `browse_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `referer` varchar(200) NOT NULL,
  `user_agent` varchar(1000) NOT NULL,
  `hash` char(32) NOT NULL,
  `url` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `short_name` tinytext NOT NULL COMMENT 'For sms',
  `path_int` varchar(100) NOT NULL,
  `path_ext` varchar(100) NOT NULL,
  `interior` text NOT NULL,
  `exterior` text NOT NULL,
  `pass_number` int(3) NOT NULL DEFAULT 1,
  `bags_number` tinyint(3) unsigned NOT NULL,
  `night_mult` float NOT NULL DEFAULT 1,
  `multiplier` float NOT NULL DEFAULT 1,
  `sort_order` smallint(6) DEFAULT 0 COMMENT 'to sort cars according to this field',
  `not_work_days` varchar(7) NOT NULL DEFAULT '0',
  `holiday_multiplier` float NOT NULL DEFAULT 1,
  `p2p_multiplier` float NOT NULL,
  `p2p_holiday_multiplier` float NOT NULL,
  `hc_holiday_multiplier` float NOT NULL DEFAULT 1,
  `pre_time_additional` int(10) unsigned DEFAULT NULL,
  `visibility` varchar(4) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `pass_number` (`pass_number`,`visibility`),
  KEY `sort_order` (`sort_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(85) NOT NULL,
  `search_name` varchar(100) NOT NULL COMMENT 'Поле по которому происходит поис. Настоящее название города или альтернативное.',
  `state` varchar(2) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `search_name` (`search_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Alternative city names';
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cron_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_tasks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jobtype` varchar(45) NOT NULL,
  `title` varchar(40) NOT NULL,
  `data` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'task / method',
  `created` datetime NOT NULL,
  `notbefore` datetime DEFAULT NULL,
  `fetched` datetime DEFAULT NULL,
  `completed` datetime DEFAULT NULL,
  `failed` int(3) NOT NULL DEFAULT 0,
  `failure_message` text DEFAULT NULL,
  `workerkey` varchar(45) DEFAULT NULL,
  `interval` int(10) NOT NULL DEFAULT 0 COMMENT 'in minutes',
  `status` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `distances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zip1` int(11) NOT NULL,
  `zip2` int(11) NOT NULL,
  `distance` decimal(7,2) NOT NULL,
  `duration` varchar(20) NOT NULL COMMENT 'Travel time',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zip1` (`zip1`,`zip2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `email` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 - active, 2 -deleted',
  `comments` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  `body` text NOT NULL,
  `help` text NOT NULL,
  `table` tinytext NOT NULL COMMENT 'DB table',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `emails_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_old` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  `body` text NOT NULL,
  `help` text NOT NULL,
  `table` tinytext NOT NULL COMMENT 'DB table',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='при старте новой системы можно будет удалить';
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `hourly_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hourly_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NOT NULL,
  `hours` tinyint(4) NOT NULL,
  `sun_fri` float NOT NULL,
  `saturday` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `car_id` (`car_id`,`hours`),
  KEY `hours` (`hours`,`sun_fri`),
  KEY `hours_2` (`hours`,`saturday`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `limos_com_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `limos_com_quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quote_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `request_mail` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `service_date` varchar(100) NOT NULL,
  `passengers` varchar(100) NOT NULL,
  `pickup_time` varchar(100) NOT NULL,
  `pickup_address` varchar(200) NOT NULL,
  `dropoff_address` varchar(200) NOT NULL,
  `destination_stops` varchar(100) NOT NULL,
  `vehicles` varchar(300) NOT NULL,
  `reply_mail` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Запросы с limos.com';
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `messages_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `phone` tinytext DEFAULT NULL,
  `email_part` tinytext DEFAULT NULL,
  `email` tinytext DEFAULT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `status` tinytext NOT NULL,
  `response` text DEFAULT NULL,
  `subject` varchar(1000) DEFAULT NULL,
  `body` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_history_driver_id_foreign` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='History of sent info to drivers';
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `change_id` int(11) NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `field` varchar(30) NOT NULL,
  `value_old` varchar(200) NOT NULL,
  `value_new` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `change_id` (`change_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_drivers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `real_order_id` int(10) unsigned NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_drivers_real_order_id_foreign` (`real_order_id`),
  KEY `order_drivers_driver_id_foreign` (`driver_id`),
  CONSTRAINT `order_drivers_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  CONSTRAINT `order_drivers_real_order_id_foreign` FOREIGN KEY (`real_order_id`) REFERENCES `real_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `return_from` int(10) unsigned DEFAULT NULL COMMENT 'Return from order ID',
  `similar_order_id` int(10) unsigned DEFAULT NULL,
  `to` tinyint(4) NOT NULL COMMENT 'Where do you want to go?',
  `status` tinyint(4) NOT NULL,
  `money_status` tinyint(4) NOT NULL DEFAULT 0,
  `rate_id` int(10) unsigned DEFAULT NULL,
  `pass_number` tinyint(3) unsigned NOT NULL,
  `pickup_time` datetime NOT NULL,
  `pickup_zip` varchar(5) NOT NULL,
  `pickup_address` varchar(200) NOT NULL,
  `pickup_hotelbusiness` varchar(100) DEFAULT NULL,
  `pickup_street` varchar(100) DEFAULT NULL,
  `pickup_aptsuite` varchar(100) DEFAULT NULL,
  `airport_id` tinyint(4) DEFAULT NULL,
  `airlines` varchar(100) DEFAULT NULL,
  `flight` varchar(20) DEFAULT NULL,
  `arrival` time DEFAULT NULL,
  `flight_from` varchar(80) DEFAULT NULL,
  `luggage` tinyint(1) DEFAULT NULL,
  `text_on_board` varchar(100) DEFAULT NULL,
  `charter_minutes` int(10) unsigned DEFAULT NULL,
  `dropoff_time` datetime DEFAULT NULL,
  `dropoff_zip` varchar(5) DEFAULT NULL,
  `dropoff_address` varchar(200) DEFAULT NULL,
  `dropoff_hotelbusiness` varchar(100) DEFAULT NULL,
  `dropoff_street` varchar(100) DEFAULT NULL,
  `dropoff_aptsuite` varchar(100) DEFAULT NULL,
  `primary_person_traveling` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `child_seat` tinyint(3) unsigned DEFAULT NULL,
  `stops` tinyint(3) unsigned DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `car_id` int(10) unsigned DEFAULT NULL,
  `airport_tax` decimal(5,2) DEFAULT NULL,
  `step2_price` decimal(7,2) DEFAULT NULL,
  `way_price` decimal(7,2) DEFAULT NULL,
  `car_surcharge` decimal(7,2) DEFAULT NULL,
  `fuel_surcharge` decimal(7,2) NOT NULL DEFAULT 0.00,
  `night_surcharge` decimal(7,2) DEFAULT NULL,
  `holiday_surcharge` decimal(7,2) DEFAULT NULL,
  `childseat_tax` decimal(7,2) DEFAULT NULL,
  `stops_tax` decimal(7,2) DEFAULT NULL,
  `luggage_tax` decimal(7,2) DEFAULT NULL,
  `step3_price` decimal(7,2) DEFAULT NULL,
  `promocode_tax` decimal(7,2) DEFAULT NULL,
  `promo_code_id` int(10) unsigned DEFAULT NULL,
  `tip` decimal(7,2) DEFAULT NULL,
  `tip_saved` tinyint(1) DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_string` varchar(8) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `name_on_card` varchar(200) DEFAULT NULL,
  `billing_street` varchar(100) DEFAULT NULL,
  `billing_aptsuite` varchar(100) DEFAULT NULL,
  `billing_country` varchar(2) DEFAULT NULL,
  `billing_city` varchar(80) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(10) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `ipstep4` varchar(15) DEFAULT NULL,
  `trace_path` text DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `orders_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT 'Date when the order was placed',
  `id_car` int(11) NOT NULL DEFAULT 0,
  `car_name` text NOT NULL,
  `rt` int(11) NOT NULL DEFAULT 0,
  `date_txt` varchar(22) NOT NULL COMMENT 'old text formatted date',
  `date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT 'When car is required',
  `pass_number` int(11) NOT NULL DEFAULT 0,
  `fname` tinytext NOT NULL COMMENT 'Primary person traveling',
  `mname` tinytext NOT NULL COMMENT 'Primary person traveling',
  `lname` tinytext NOT NULL COMMENT 'Primary person traveling',
  `price` int(11) NOT NULL DEFAULT 0,
  `tips` decimal(6,2) NOT NULL,
  `taxes` decimal(6,2) NOT NULL DEFAULT 0.00 COMMENT 'airport fee, etc.',
  `total` decimal(9,2) NOT NULL COMMENT 'price+tips+taxes',
  `pickup_addr` text NOT NULL,
  `pickup_addr_apt` text NOT NULL,
  `town_id` int(11) DEFAULT NULL,
  `town` text NOT NULL,
  `airport` text NOT NULL,
  `airline` text DEFAULT NULL,
  `arrive` text NOT NULL,
  `luggage` varchar(4) NOT NULL DEFAULT '',
  `roundtrip` int(11) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `card_number` text NOT NULL,
  `expiration_date` text NOT NULL,
  `card_type` text NOT NULL,
  `name_on_card` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `address` text NOT NULL,
  `apt` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` text NOT NULL,
  `cell_phone` text NOT NULL,
  `e_mail` text NOT NULL,
  `comments` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '',
  `ip` text NOT NULL,
  `trace_path` text DEFAULT NULL COMMENT 'this field stores a path of a visitor untill s/he gets to this order',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `p2pempty_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p2pempty_rates` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(10) unsigned NOT NULL,
  `rate` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `p2puseful_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p2puseful_rates` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(10) unsigned NOT NULL,
  `rate` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 3 COMMENT '3 - active, 5 - deleted',
  `code` varchar(50) NOT NULL,
  `dollars` decimal(5,2) DEFAULT NULL,
  `percent` tinyint(3) unsigned DEFAULT NULL,
  `exp_date` date NOT NULL,
  `per_user` smallint(5) unsigned DEFAULT NULL COMMENT 'promo numbers per user',
  `user_id` int(10) unsigned NOT NULL,
  `min_amount` decimal(5,2) DEFAULT NULL,
  `max_amount` decimal(5,2) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `email_part` tinytext NOT NULL,
  `comments` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='SMS Providers';
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `queued_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queued_tasks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jobtype` varchar(45) NOT NULL,
  `data` text DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `notbefore` datetime DEFAULT NULL,
  `fetched` datetime DEFAULT NULL,
  `progress` float(3,2) DEFAULT NULL,
  `completed` datetime DEFAULT NULL,
  `failed` int(3) NOT NULL DEFAULT 0,
  `failure_message` text DEFAULT NULL,
  `workerkey` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `quote_texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_texts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `string_id` char(35) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `to` tinyint(4) NOT NULL,
  `pass_number` tinyint(4) NOT NULL,
  `pickup_time` datetime NOT NULL,
  `pickup_zip` varchar(6) NOT NULL,
  `pickup_address` varchar(200) NOT NULL,
  `airport_id` tinyint(4) NOT NULL,
  `dropoff_time` datetime NOT NULL,
  `dropoff_zip` varchar(5) NOT NULL,
  `dropoff_address` varchar(200) NOT NULL,
  `charter_minutes` int(11) NOT NULL,
  `reply_mail` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `string_id` (`string_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Запросы';
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `quotes_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_cars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quote_id` int(10) unsigned NOT NULL,
  `car_id` int(10) unsigned NOT NULL,
  `price` decimal(11,2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zip` varchar(5) NOT NULL,
  `town` varchar(85) NOT NULL,
  `state` char(2) DEFAULT 'IL' COMMENT 'two letter state, ex.: IL',
  `short_name` tinytext NOT NULL COMMENT 'for sms',
  `ORD` int(11) NOT NULL DEFAULT 0,
  `MDW` int(11) NOT NULL DEFAULT 0,
  `MKE` int(11) NOT NULL DEFAULT 0,
  `CHI` int(11) NOT NULL DEFAULT 0,
  `chicagoland` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Is this a Chicago land city',
  `major_city` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Should this be on the MAJOR city list or is this small city',
  `url_rates` varchar(255) DEFAULT NULL COMMENT 'the URL for Rates',
  `manual_rate` tinyint(1) NOT NULL DEFAULT 0,
  `old_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zip` (`zip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `rates_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rates_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `town` text NOT NULL,
  `state` char(2) DEFAULT 'IL' COMMENT 'two letter state, ex.: IL',
  `short_name` tinytext NOT NULL COMMENT 'for sms',
  `ORD` int(11) NOT NULL DEFAULT 0,
  `MDW` int(11) NOT NULL DEFAULT 0,
  `MKE` int(11) NOT NULL DEFAULT 0,
  `CHI` int(11) NOT NULL DEFAULT 0,
  `chicagoland` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Is this a Chicago land city',
  `major_city` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Should this be on the MAJOR city list or is this small city',
  `url_rates` varchar(255) DEFAULT NULL COMMENT 'the URL for Rates',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `real_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `real_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `return_from` int(10) unsigned DEFAULT NULL COMMENT 'Return from order ID',
  `similar_order_id` int(10) unsigned DEFAULT NULL,
  `to` tinyint(4) NOT NULL COMMENT 'Where do you want to go?',
  `status` tinyint(4) NOT NULL,
  `money_status` tinyint(4) DEFAULT NULL,
  `pass_number` tinyint(3) unsigned DEFAULT NULL,
  `pickup_time` datetime DEFAULT NULL,
  `pickup_zip` varchar(5) DEFAULT NULL,
  `pickup_address` varchar(200) DEFAULT NULL,
  `pickup_hotelbusiness` varchar(100) DEFAULT NULL,
  `pickup_street` varchar(100) DEFAULT NULL,
  `pickup_aptsuite` varchar(100) DEFAULT NULL,
  `airport_id` tinyint(4) DEFAULT NULL,
  `airlines` varchar(100) DEFAULT NULL,
  `flight` varchar(20) DEFAULT NULL,
  `arrival` time DEFAULT NULL,
  `flight_from` varchar(80) DEFAULT NULL,
  `luggage` tinyint(1) DEFAULT NULL,
  `text_on_board` varchar(100) DEFAULT NULL,
  `charter_minutes` int(10) unsigned DEFAULT NULL,
  `dropoff_time` datetime DEFAULT NULL,
  `dropoff_zip` varchar(5) DEFAULT NULL,
  `dropoff_address` varchar(200) DEFAULT NULL,
  `dropoff_hotelbusiness` varchar(100) DEFAULT NULL,
  `dropoff_street` varchar(100) DEFAULT NULL,
  `dropoff_aptsuite` varchar(100) DEFAULT NULL,
  `primary_person_traveling` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `child_seat` tinyint(3) unsigned DEFAULT NULL,
  `stops` tinyint(3) unsigned DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `car_id` int(10) unsigned DEFAULT NULL,
  `airport_tax` decimal(5,2) DEFAULT NULL,
  `step2_price` decimal(7,2) DEFAULT NULL,
  `way_price` decimal(7,2) DEFAULT NULL,
  `car_surcharge` decimal(7,2) DEFAULT NULL,
  `night_surcharge` decimal(7,2) DEFAULT NULL,
  `holiday_surcharge` decimal(7,2) DEFAULT NULL,
  `childseat_tax` decimal(7,2) DEFAULT NULL,
  `stops_tax` decimal(7,2) DEFAULT NULL,
  `luggage_tax` decimal(7,2) DEFAULT NULL,
  `step3_price` decimal(7,2) DEFAULT NULL,
  `promocode_tax` decimal(7,2) DEFAULT NULL,
  `promo_code_id` int(10) unsigned DEFAULT NULL,
  `tip` decimal(7,2) DEFAULT NULL,
  `tip_saved` tinyint(1) DEFAULT NULL,
  `fuel_surcharge` decimal(7,2) DEFAULT 0.00,
  `price` decimal(7,2) DEFAULT NULL,
  `card_number` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `card_number_enc` varbinary(200) DEFAULT NULL,
  `card_string` varchar(8) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `name_on_card` varchar(200) DEFAULT NULL,
  `billing_street` varchar(100) DEFAULT NULL,
  `billing_aptsuite` varchar(100) DEFAULT NULL,
  `billing_country` varchar(2) DEFAULT NULL,
  `billing_city` varchar(80) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(10) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `ipstep4` varchar(15) DEFAULT NULL,
  `trace_path` text DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `user_hash` varchar(32) DEFAULT NULL,
  `notification24_mail_sent` tinyint(1) NOT NULL DEFAULT 0,
  `notification24_sms_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `status` (`status`,`pickup_time`),
  KEY `user_id` (`user_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` datetime NOT NULL COMMENT 'Date of travel',
  `start_date_TS` int(11) NOT NULL DEFAULT 0 COMMENT 'this is a time stamp format field',
  `start_date_txt` text NOT NULL,
  `pickup_addr` text NOT NULL,
  `destination` text DEFAULT NULL,
  `duration` text NOT NULL,
  `request` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT 'Date when the request was placed',
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `comments` text NOT NULL,
  `car_name` text NOT NULL,
  `ip` text NOT NULL,
  `trace_path` text DEFAULT NULL COMMENT 'this field stores a path of a visitor untill s/he gets to this request',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type` varchar(20) NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `auth_code` varchar(10) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_type` varchar(20) NOT NULL,
  `response_code` int(11) NOT NULL,
  `response_message` varchar(1000) NOT NULL,
  `response_object` varchar(2000) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1 - admin, 2 - customer',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `sms_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`,`password`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `property_name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `coments` varchar(200) NOT NULL,
  `order` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `zip_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zip_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ZipCode` char(5) NOT NULL DEFAULT '00000',
  `Country` char(3) NOT NULL DEFAULT 'USA',
  `City` varchar(100) DEFAULT NULL COMMENT 'city name in small letters',
  `County` varchar(100) DEFAULT NULL,
  `State` char(2) NOT NULL DEFAULT 'NO',
  `order` tinyint(4) NOT NULL,
  `StateLong` varchar(100) NOT NULL DEFAULT '0',
  `Latitude` float NOT NULL DEFAULT 0,
  `Longitude` float NOT NULL DEFAULT 0,
  `RadLatitude` float NOT NULL DEFAULT 0,
  `RadLongitude` float NOT NULL DEFAULT 0,
  `AreaCode` varchar(3) DEFAULT NULL,
  `TimeZone` int(11) NOT NULL DEFAULT 0,
  `timeORD` varchar(16) DEFAULT '0' COMMENT 'Driving time from O''Hare',
  `distanceORD` decimal(5,1) DEFAULT 0.0 COMMENT 'Driving distance from O''Hare',
  `timeMDW` varchar(16) DEFAULT '0' COMMENT 'Driving time from Midway',
  `distanceMDW` decimal(5,1) DEFAULT 0.0 COMMENT 'Driving distance from Midway',
  `timeCHI` varchar(16) DEFAULT '0' COMMENT 'Driving time from Chicago loop',
  `distanceCHI` decimal(5,1) DEFAULT 0.0 COMMENT 'Driving distance from Chicago loop',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  UNIQUE KEY `idZip` (`id`),
  KEY `City` (`City`),
  KEY `City_2` (`City`,`State`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `zip_codes_travelmaps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zip_codes_travelmaps` (
  `id` double NOT NULL AUTO_INCREMENT,
  `ZipCode` varchar(5) NOT NULL DEFAULT '00000' COMMENT 'Zip from where',
  `destination` varchar(15) NOT NULL DEFAULT '00000' COMMENT 'point MDW ORD CHI',
  `duration` varchar(20) NOT NULL DEFAULT '0' COMMENT 'travel time',
  `distance` decimal(5,1) NOT NULL DEFAULT 0.0 COMMENT 'travel distance',
  `TOWNlat` float NOT NULL DEFAULT 0 COMMENT 'ZIP lat',
  `TOWNlng` float NOT NULL DEFAULT 0 COMMENT 'ZIP lng',
  `MAINlat` float NOT NULL DEFAULT 0 COMMENT 'point lat',
  `MAINlng` float NOT NULL DEFAULT 0 COMMENT 'point lng',
  `SWlat` float NOT NULL DEFAULT 0,
  `SWlng` float NOT NULL DEFAULT 0,
  `NElat` float NOT NULL DEFAULT 0,
  `NElng` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `ZipCode` (`ZipCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2023_09_21_161612_add_bags_number_to_cars',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2023_10_17_165938_add_sms_allowed_to_users',3);
