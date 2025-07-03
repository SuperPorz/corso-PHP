CREATE DATABASE php_es00;

USE php_es00;

DROP TABLE umani;
DROP TABLE log_;

CREATE TABLE umani (
id_p VARCHAR(20) PRIMARY KEY, 
nome VARCHAR(20) NOT NULL, 
cognome VARCHAR(20) NOT NULL, 
numero INT NOT NULL
);

SELECT *
FROM umani;

-- ---------------------------

CREATE TABLE log_ (
id_log INT AUTO_INCREMENT PRIMARY KEY, 
azione VARCHAR(10) NOT NULL,
id_p VARCHAR(20) NOT NULL, 
nome_v VARCHAR(20),
nome_n VARCHAR(20),  
cognome_v VARCHAR(20),
cognome_n VARCHAR(20),  
numero_v INT,
numero_n INT,
data_az DATE NOT NULL,
ora_az datetime NOT NULL
);

SELECT *
FROM log_;

-- ---------------------------  ESERCIZIO MOSTI IN CLASSE ---------------------------------
CREATE DATABASE php_esMOSTI;

USE php_esMOSTI;

DROP TABLE persone;

CREATE TABLE persone (
id_p INT AUTO_INCREMENT PRIMARY KEY, 
nome VARCHAR(20) NOT NULL, 
numero INT NOT NULL
);

SELECT *
FROM persone;

