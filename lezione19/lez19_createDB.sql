CREATE DATABASE php_lez19;
USE php_lez19;

CREATE TABLE notizie(
	idn INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(100) NOT NULL,
    testo VARCHAR(255) NOT NULL
);

SELECT * FROM notizie;

insert into notizie (titolo, testo) values ('titolo1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m');
insert into notizie (titolo, testo) values ('titolo2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m');
insert into notizie (titolo, testo) values ('titolo3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m');
insert into notizie (titolo, testo) values ('titolo4', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m');
insert into notizie (titolo, testo) values ('titolo5', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m');
insert into notizie (titolo, testo) values ('titolo6', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m');
insert into notizie (titolo, testo) values ('GFGFGFFG', 'S,DHFKDSJHFKDSJHFKHFKSHDFSSHKHFDSJ');

truncate notizie;