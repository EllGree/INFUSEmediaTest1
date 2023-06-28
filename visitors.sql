CREATE TABLE visitors (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ip_address` VARCHAR(16),
    `user_agent` VARCHAR(255),
    `page_url` VARCHAR(255),
    `views_count` INT UNSIGNED,
    `view_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `visit` (ip_address, user_agent, page_url)
);