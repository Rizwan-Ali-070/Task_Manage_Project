-- Database: user-task-project
-- Import this file in phpMyAdmin (XAMPP) before running the project.
-- Steps: Open phpMyAdmin -> Create database named "user-task-project" -> Import -> select this file.

CREATE DATABASE IF NOT EXISTS `user-task-project`;
USE `user-task-project`;

-- Table: users
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: task
CREATE TABLE IF NOT EXISTS `task` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `priority` ENUM('Low','Medium','High') DEFAULT 'Medium',
  `status` ENUM('Pending','In Progress','Completed') DEFAULT 'Pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
