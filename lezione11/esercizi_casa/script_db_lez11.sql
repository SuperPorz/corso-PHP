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