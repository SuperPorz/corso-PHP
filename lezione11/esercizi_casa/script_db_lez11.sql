-- -----------  LEZ 11 - esercizio 01 ----------------------
CREATE DATABASE php_lez11_es01;
USE php_lez11_es01;
SET SQL_SAFE_UPDATES = 0;


CREATE TABLE ingrediente (
	idi INT AUTO_INCREMENT PRIMARY KEY,
    nome_i VARCHAR(20) NOT NULL
	);

CREATE TABLE piatto (
	idp VARCHAR(20) PRIMARY KEY,
    nome_p VARCHAR (50) UNIQUE NOT NULL,
    ingredienti VARCHAR (255)
	);

select *
from ingrediente;

select *
from piatto;

-- -----------  LEZ 11 - esercizio 02 ----------------------
CREATE DATABASE php_lez11_es02;
USE php_lez11_es02;
SET SQL_SAFE_UPDATES = 0;


CREATE TABLE ingrediente (
	idi INT AUTO_INCREMENT PRIMARY KEY,
    nome_i VARCHAR(20) UNIQUE NOT NULL
	);

CREATE TABLE piatto (
	idp VARCHAR(20) PRIMARY KEY,
    nome_p VARCHAR (50) UNIQUE NOT NULL
	);
    
CREATE TABLE piatti_ingredienti (
	idp VARCHAR(20) NOT NULL,
    idi INT NOT NULL,
    FOREIGN KEY (idp) REFERENCES piatto(idp) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idi) REFERENCES ingrediente(idi) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (idp, idi)
);

select *
from piatti_ingredienti;




