CREATE DATABASE IF NOT EXISTS wewalk;
USE wewalk;

CREATE TABLE IF NOT EXISTS blog(
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
content TEXT
);

SET @caption = "test blog";
SET @content = "this is my first blog content";
INSERT INTO blog(caption, content) VALUE(@caption, @content);

CREATE TABLE IF NOT EXISTS activity(
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
caption CHAR(60) NOT NULL, 
location CHAR(30) NOT NULL,
start DATETIME NOT NULL,
end DATETIME NOT NULL,
price int UNSIGNED NOT NULL, 
content TEXT NOT NULL
) ENGINE = innodb DEFAULT CHARSET=utf8;