USE wewalk;
ALTER TABLE activity ADD COLUMN gather_location CHAR(50) NOT NULL DEFAULT '';
ALTER TABLE activity ADD COLUMN leaders CHAR(50) NOT NULL DEFAULT '遗忘';
ALTER TABLE activity ADD COLUMN sleep_style CHAR(50) NOT NULL DEFAULT '农家';
ALTER TABLE activity ADD COLUMN strength TINYINT NOT NULL DEFAULT 3;
ALTER TABLE activity ADD COLUMN diffculty TINYINT NOT NULL DEFAULT 3;
ALTER TABLE activity ADD COLUMN danger TINYINT NOT NULL DEFAULT 3;
ALTER TABLE activity ADD COLUMN view TINYINT NOT NULL DEFAULT 5;