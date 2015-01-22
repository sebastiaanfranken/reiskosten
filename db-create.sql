DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
	`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`user_id` INT(11) NOT NULL,
	`date` DATE NOT NULL,
	`origin` VARCHAR(255) NOT NULL,
	`destination` VARCHAR(255) NOT NULL,
	`price` VARCHAR(50) NOT NULL,
	`created_at` DATETIME DEFAULT NULL,
	`updated_at` DATETIME DEFAULT NULL
);

DROP TABLE IF EXISTS `meta`;
CREATE TABLE IF NOT EXISTS `meta`(
	`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`meta_key` VARCHAR(255) NOT NULL,
	`meta_value` VARCHAR(255) NOT NULL,
	`created_at` DATETIME DEFAULT NULL,
	`updated_at` DATETIME DEFAULT NULL
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`(
	`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`username` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`role` VARCHAR(100) NOT NULL DEFAULT 'user',
	`fullname` TEXT NOT NULL,
	`bankaccount` VARCHAR(255) NOT NULL,
	`zipcode_home` VARCHAR(20) NOT NULL,
	`remember_token` VARCHAR(100) DEFAULT NULL,
	`created_at` DATETIME DEFAULT NULL,
	`updated_at` DATETIME DEFAULT NULL
);