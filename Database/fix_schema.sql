-- Run once on Railway MySQL (database name: railway)
-- Ignore "Duplicate column name" errors if a column already exists.

ALTER TABLE `property` ADD COLUMN `pimage5` varchar(300) NOT NULL DEFAULT '';
ALTER TABLE `property` ADD COLUMN `pimage6` varchar(300) NOT NULL DEFAULT '';
ALTER TABLE `property` ADD COLUMN `pimage7` varchar(300) NOT NULL DEFAULT '';
ALTER TABLE `property` ADD COLUMN `pimage8` varchar(300) NOT NULL DEFAULT '';
ALTER TABLE `property` ADD COLUMN `uploaded_by` varchar(50) NOT NULL DEFAULT 'agent';

UPDATE `property` SET `uploaded_by` = 'agent' WHERE `uploaded_by` = '' OR `uploaded_by` IS NULL;

CREATE TABLE IF NOT EXISTS `request` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `requirements` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
