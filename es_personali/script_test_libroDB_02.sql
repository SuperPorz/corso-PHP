########################################### DATABASE
CREATE DATABASE libro_02;
USE test_libro;
SET SQL_SAFE_UPDATES = 0;

CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
FLUSH PRIVILEGES;

########################################### TABELLE
CREATE TABLE `test_libro`.`joke` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `joketext` TEXT NOT NULL,
  `jokedate` DATE NOT NULL,
  PRIMARY KEY (`id`)
);
  
CREATE TABLE author (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

select * from joke;

########################################## INSERIMENTO DATI
insert into joke set
joketext = "A programmer was found dead in the shower. The instructions read: lather, rinse, repeat.",
jokedate = "2017/06/01";

insert into joke (joketext, jokedate) values (
	"!False - it\'s funny because it\'s true",
    '2017-06-01');
    
########################################## MODIFICA TABELLE    
ALTER TABLE joke ADD COLUMN authorname VARCHAR(255);
ALTER TABLE joke ADD COLUMN authoremail VARCHAR(255);

ALTER TABLE joke DROP COLUMN authorname, DROP COLUMN authoremail;
ALTER TABLE joke ADD COLUMN authorid INT;

INSERT INTO author (id, `name`, email) VALUES (1, 'Kevin Yank', 'thatguy@kevinyank.com');
INSERT INTO author (id, `name`, email) VALUES (2, 'Tom Butler', 'tom.r@bubba.de');

UPDATE joke SET authorid = 1 WHERE id = 1;
UPDATE joke SET authorid = 2 WHERE id = 2;
INSERT INTO joke (joketext, jokedate, authorid) VALUES (
	'Why was the empty array stuck outside? it didn\'t have any keys',
    '2017-04-01',
    2);