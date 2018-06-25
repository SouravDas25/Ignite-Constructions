
DROP TABLE IF EXISTS `site_transfer_details`;
DROP TABLE IF EXISTS `site_transfers`;
DROP TABLE IF EXISTS `labours`;
DROP TABLE IF EXISTS `statuses`;
DROP TABLE IF EXISTS `godown_transfers`;
DROP TABLE IF EXISTS `sites`;
DROP TABLE IF EXISTS `godowns`;
DROP TABLE IF EXISTS `purchases`;
DROP TABLE IF EXISTS `goods`;
DROP TABLE IF EXISTS `sellers`;


CREATE TABLE IF NOT EXISTS `sellers` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`name` varchar(250) NOT NULL,
	`contact_no` varchar(10) NOT NULL UNIQUE ,
	`email` varchar(250) NOT NULL UNIQUE ,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `goods` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`name` varchar(250) NOT NULL,
	`details` varchar(250) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `purchases` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`seller_id` INT(50) NOT NULL,
	`goods_id` INT(50) NOT NULL,
	`date` DATE NOT NULL,
	`quantity` INT(50) NOT NULL,
	`cost` DECIMAL(50) NOT NULL,
	`purchase_due` DECIMAL(50) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	FOREIGN KEY fk_seller_purchase(seller_id)
	REFERENCES sellers(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY fk_seller_goods(goods_id)
	REFERENCES goods(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `godowns` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`name` varchar(250) NOT NULL,
	`location` GEOMETRY NOT NULL,
	`address` varchar(250) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `sites` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`name` varchar(250) NOT NULL,
	`location` GEOMETRY NOT NULL,
	`address` varchar(250) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `godown_transfers` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`godown_id` INT(50) NOT NULL,
	`purchase_id` INT(50) NOT NULL,
	`date` DATE NOT NULL,
	`quantity` INT(50) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	FOREIGN KEY fk_godown_transfer_godown(godown_id)
	REFERENCES godowns(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY fk_purchase_godown(purchase_id)
	REFERENCES purchases(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `statuses` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`details` varchar(250) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `labours` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`name` varchar(250) NOT NULL UNIQUE ,
	`password` varchar(250) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `site_transfers` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`site_id` INT(50) NOT NULL,
	`godown_transfer_id` INT(50) NOT NULL,
	`date` DATE NOT NULL,
	`quantity` INT(50) NOT NULL,
	`labour_id` INT(50) NOT NULL,
	`status_id` INT(50) NOT NULL,
	`created_id` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	FOREIGN KEY fk_site_transfer_godown_transfer(godown_transfer_id)
	REFERENCES godown_transfers(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY fk_site_transfer_site(site_id)
	REFERENCES sites(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY fk_site_transfer_labour(labour_id)
	REFERENCES labours(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY fk_site_transfer_status(status_id)
	REFERENCES statuses(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `site_transfer_details` (
	`id` INT(50) NOT NULL AUTO_INCREMENT,
	`site_transfer_id` INT(50) NOT NULL,
	`onset_datetime` DATETIME NOT NULL,
	`quantity` INT(50) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	FOREIGN KEY fk_site_transfer_details_site_transfer(site_transfer_id)
	REFERENCES site_transfers(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);




