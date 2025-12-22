-- Add settings table for registration limit control
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text NOT NULL,
  `description` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert default registration limit settings
INSERT INTO `settings` (`setting_key`, `setting_value`, `description`, `updated_by`) VALUES
('max_registrations_per_regno', '1', 'Maximum number of event registrations allowed per register number', 'system'),
('registration_enabled', '1', 'Enable/Disable registration system (1=enabled, 0=disabled)', 'system'),
('registration_message', 'Registration is currently open!', 'Message to display on registration page', 'system')
ON DUPLICATE KEY UPDATE 
  `setting_value` = VALUES(`setting_value`),
  `description` = VALUES(`description`);
