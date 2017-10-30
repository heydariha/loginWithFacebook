CREATE TABLE `users` (
  `fb_id` VARCHAR(25) COLLATE latin1_swedish_ci NOT NULL,
  `fb_name` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `fb_profile_pic` TEXT COLLATE latin1_swedish_ci,
  `fb_is_active` TINYINT(1) DEFAULT 1,
  `fb_token` TINYTEXT COLLATE latin1_swedish_ci,
  UNIQUE KEY `fb_id` (`fb_id`) USING BTREE
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;