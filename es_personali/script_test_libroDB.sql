CREATE DATABASE test_libro;
USE test_libro;
SET SQL_SAFE_UPDATES = 0;

CREATE TABLE `test_libro`.`joke` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `joketext` TEXT NOT NULL,
  `jokedate` DATE NOT NULL,
  PRIMARY KEY (`id`));

select * from joke;

CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
FLUSH PRIVILEGES;


insert into joke set
joketext = "A programmer was found dead in the shower. The instructions read: lather, rinse, repeat.",
jokedate = "2017/06/01";

insert into joke (joketext, jokedate) values (
	"!False - it\'s funny because it\'s true",
    '2017-06-01');