CREATE DATABASE php_lez11_es01;
USE php_lez11_es01;
SET SQL_SAFE_UPDATES = 0;


CREATE TABLE ingrediente (
	idi INT AUTO_INCREMENT PRIMARY KEY,
    nome_i VARCHAR(20) NOT NULL
	);

CREATE TABLE piatto (
	idp VARCHAR(20) PRIMARY KEY,
    nome_p VARCHAR (50) NOT NULL,
    idi INT NOT NULL,
    FOREIGN KEY (idi) REFERENCES ingrediente(idi)
    ON DELETE CASCADE
	);
    
select p.idp, p.nome_p, i.nome_i
from piatto p
join ingrediente i on p.idi = p.idi;

select *
from ingrediente;