########################################### DATABASE
CREATE DATABASE libro_03;
USE libro_03;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;

########################################### TABELLE
CREATE TABLE joke (
  `id` INT NOT NULL AUTO_INCREMENT,
  `joketext` TEXT NOT NULL,
  `jokedate` DATE NOT NULL,
  authorid INT NOT NULL,
  PRIMARY KEY (`id`)
);
  
CREATE TABLE author (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE category (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

CREATE TABLE jokecategory (
	jokeid INT NOT NULL,
    categoryid INT NOT NULL,
    PRIMARY KEY (jokeid, categoryid)
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
INSERT INTO author (id, `name`, email) VALUES (1, 'Kevin Yank', 'thatguy@kevinyank.com');
INSERT INTO author (id, `name`, email) VALUES (2, 'Tom Butler', 'tom.r@bubba.de');

UPDATE joke SET authorid = 1 WHERE id = 1;
UPDATE joke SET authorid = 2 WHERE id = 2;
INSERT INTO joke (joketext, jokedate, authorid) VALUES (
	'Why was the empty array stuck outside? it didn\'t have any keys',
    '2017-04-01',
    2);
    
    
# test query JOIN
SELECT id, LEFT(joketext, 20), authorid
FROM joke;

SELECT j.id, LEFT(joketext, 20) as testo_ridotto, `name`, email
FROM joke j 
INNER JOIN author a ON j.authorid = a.id;