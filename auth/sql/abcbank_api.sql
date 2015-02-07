
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- apikey
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `apikey`;

CREATE TABLE `apikey`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `consumer_id` INTEGER NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    `secret` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`,`consumer_id`,`value`,`secret`),
    INDEX `apikey_fi_9b4556` (`consumer_id`),
    CONSTRAINT `apikey_fk_9b4556`
        FOREIGN KEY (`consumer_id`)
        REFERENCES `consumer` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- consumer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `consumer`;

CREATE TABLE `consumer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`,`username`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
