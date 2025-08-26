########################################### DATABASE
CREATE DATABASE estate_es12_officina;
USE estate_es12_officina;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
CREATE TABLE operatore (
	id_operat INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_operat)
);

CREATE TABLE lavorazione (
	id_lavoraz INT NOT NULL AUTO_INCREMENT,
	descrizione VARCHAR(255) NOT NULL,
    costo_h INT NOT NULL,
	PRIMARY KEY (id_lavoraz)
);

CREATE TABLE tempi_per_operatore (
	id_operat INT NOT NULL,
	id_lavoraz INT NOT NULL,
    tempo INT NOT NULL,
    FOREIGN KEY (id_operat) REFERENCES operatore(id_operat) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_lavoraz) REFERENCES lavorazione(id_lavoraz) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY (id_operat, id_lavoraz, tempo)
);

CREATE TABLE intervento (
	id_interv INT NOT NULL AUTO_INCREMENT,
	targa VARCHAR(255) NOT NULL,
	id_lavoraz INT NOT NULL,
	id_operat INT NOT NULL,
	FOREIGN KEY (id_operat) REFERENCES operatore(id_operat),
	FOREIGN KEY (id_lavoraz) REFERENCES lavorazione(id_lavoraz),
	PRIMARY KEY (id_interv)
);


########################################## INSERIMENTO DATI
insert into joke set
joketext = "A programmer was found dead in the shower. The instructions read: lather, rinse, repeat.",
jokedate = "2017/06/01";

insert into joke (joketext, jokedate) values (
	"!False - it\'s funny because it\'s true",
    '2017-06-01');
    
    
########################################## TEST QUERY
SELECT id, LEFT(joketext, 20), authorid
FROM joke;

SELECT j.id, LEFT(joketext, 20) as testo_ridotto, `name`, email
FROM joke j 
INNER JOIN author a ON j.authorid = a.id;