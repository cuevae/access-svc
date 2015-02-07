
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- customer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `second_name` VARCHAR(255),
    `first_surname` VARCHAR(255) NOT NULL,
    `second_surname` VARCHAR(255),
    `address_line1` VARCHAR(255) NOT NULL,
    `address_line2` VARCHAR(255),
    `house_number` VARCHAR(255),
    `postcode` VARCHAR(255) NOT NULL,
    `town` VARCHAR(255) NOT NULL,
    `county` VARCHAR(255),
    `country` VARCHAR(255) NOT NULL,
    `telephone1` VARCHAR(255) NOT NULL,
    `telephone2` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`,`username`),
    UNIQUE INDEX `customer_u_b1ef01` (`first_name`, `first_surname`, `second_surname`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- account
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account`
(
    `account_number` VARCHAR(255) NOT NULL,
    `customer_id` INTEGER NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `balance` FLOAT DEFAULT 0.0,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`account_number`,`customer_id`,`type`),
    UNIQUE INDEX `account_u_297565` (`customer_id`, `type`),
    CONSTRAINT `account_fk_7e8f3e`
        FOREIGN KEY (`customer_id`)
        REFERENCES `customer` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- transaction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `customer_id` INTEGER NOT NULL,
    `account_number` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `amount` FLOAT NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `transaction_u_e9fc4f` (`id`, `customer_id`, `account_number`, `type`, `amount`),
    INDEX `transaction_fi_7e8f3e` (`customer_id`),
    INDEX `transaction_fi_31d0fe` (`account_number`),
    CONSTRAINT `transaction_fk_7e8f3e`
        FOREIGN KEY (`customer_id`)
        REFERENCES `customer` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `transaction_fk_31d0fe`
        FOREIGN KEY (`account_number`)
        REFERENCES `account` (`account_number`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
