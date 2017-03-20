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
content TEXT NOT NULL,
status TINYINT UNSIGNED NOT NULL DEFAULT 0,
cover CHAR(50) DEFAULT ''
) ENGINE = innodb DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS blog(
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
caption CHAR(60) NOT NULL DEFAULT '',
content TEXT NOT NULL,
cover CHAR(50) DEFAULT '',
author CHAR(30) DEFAULT '',
status TINYINT UNSIGNED NOT NULL DEFAULT 0, 
createtime DATETIME DEFAULT CURRENT_TIMESTAMP,
lastupdate DATETIME ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS config(
name CHAR(30) NOT NULL PRIMARY KEY,
value CHAR(60) NOT NULL DEFAULT ''
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

INSERT IGNORE INTO config(name, value) VALUE("home_carousel_img1", "images/home/home_carousel_img1.jpg");
INSERT IGNORE INTO config(name, value) VALUE("home_carousel_img2", "images/home/home_carousel_img2.jpg");
INSERT IGNORE INTO config(name, value) VALUE("home_carousel_img3", "images/home/home_carousel_img3.jpg");
INSERT IGNORE INTO config(name, value) VALUE("home_carousel_link1", "#");
INSERT IGNORE INTO config(name, value) VALUE("home_carousel_link2", "#");
INSERT IGNORE INTO config(name, value) VALUE("home_carousel_link3", "#");