CREATE DATABASE IF NOT EXISTS `expensemate` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `expensemate`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `item` VARCHAR(150) NOT NULL,
  `details` TEXT DEFAULT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `expense_date` DATE NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX (`user_id`),
  INDEX (`expense_date`),
  CONSTRAINT `fk_expenses_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `budgets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `year` SMALLINT UNSIGNED NOT NULL,
  `month` TINYINT UNSIGNED NOT NULL, 
  `limit_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_year_month` (`user_id`,`year`,`month`),
  CONSTRAINT `fk_budgets_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `users` (`full_name`, `email`, `password_hash`) VALUES
('Test User', 'test@example.com', '$2b$12$x0zyJNrvK.phlHRXDkQyuuFIFyGamoFehGBZlhUleE1jxCUDUMqMa');

INSERT IGNORE INTO `categories` (`name`) VALUES
('Food'),
('Transport'),
('Shopping'),
('Bills'),
('Entertainment'),
('Healthcare'),
('Other');

INSERT INTO `expenses` (`user_id`, `category`, `item`, `details`, `amount`, `expense_date`) VALUES
(1, 'Food', 'Cafeteria lunch', 'Veg thali + tea', 120.00, '2025-11-02'),
(1, 'Transport', 'Bus pass', 'College weekly pass', 250.00, '2025-11-01'),
(1, 'Shopping', 'Stationery', 'Notebooks and pens', 340.50, '2025-10-29'),
(1, 'Bills', 'Mobile recharge', 'Prepaid plan', 199.00, '2025-10-15'),
(1, 'Entertainment', 'Movie', 'Weekend movie', 350.00, '2025-09-05'),
(1, 'Healthcare', 'Pharmacy', 'Medicines', 450.00, '2024-12-05');

INSERT INTO `budgets` (`user_id`, `year`, `month`, `limit_amount`) VALUES
(1, 2025, 11, 20000.00);

