########################################### DATABASE
CREATE DATABASE php_lez13;
USE php_lez13;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE pagina(idp, nome, template, include, contenuto)
CREATE TABLE pagina (
	idp INT NOT NULL AUTO_INCREMENT,
	url VARCHAR(255) NOT NULL,
	template VARCHAR(255),
	include VARCHAR(255),
    contenuto TEXT,
	PRIMARY KEY (idp)
);

########################################### POPOLAMENTO DB
INSERT INTO pagina (url, template, contenuto) VALUES
('lista-cani', 'cani.twig', 
	' 
		{
			"titolo":"lista cani",
            "h1":"Gestione cani"
        }
	');

INSERT INTO pagina (url, template, contenuto) VALUES
('lista-persone', 'persone.twig', 
	' 
		{
			"titolo":"lista persone",
            "h1":"Gestione persone"
        }
	');


########################################### QUERY
SELECT *
FROM pagina;