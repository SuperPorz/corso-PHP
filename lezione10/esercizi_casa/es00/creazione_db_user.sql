CREATE DATABASE php_es00;

USE php_es00;

-- -------- TABELLA UMANI --------
CREATE TABLE umani (
id_p VARCHAR(20) PRIMARY KEY, 
nome VARCHAR(20) NOT NULL, 
cognome VARCHAR(20) NOT NULL, 
numero INT NOT NULL
);

SET SQL_SAFE_UPDATES = 0;

SELECT *
FROM umani;

DELETE FROM umani;

DROP TABLE umani;
-- -------- TABELLA LOG --------

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
data_az VARCHAR(20) NOT NULL,
ora_az VARCHAR(20) NOT NULL
);

SELECT *
FROM log_;

DROP TABLE log_;

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

