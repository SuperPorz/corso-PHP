-- --- DB ES.01 - LEZ 10 -------
CREATE DATABASE php_es01;
USE php_es01;
SET SQL_SAFE_UPDATES = 0;

CREATE TABLE cani (
	id_c VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    data_n VARCHAR(20) NOT NULL,
    data_v VARCHAR(20) NOT NULL
);
-- --- DB ES.01 - LEZ 10 -------
CREATE DATABASE php_es02;
USE php_es02;
SET SQL_SAFE_UPDATES = 0;

CREATE TABLE padroni (
	id_p VARCHAR(20) PRIMARY KEY,
    nome_p VARCHAR(20) NOT NULL
);

CREATE TABLE cani (
	id_c VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    data_n VARCHAR(20) NOT NULL,
    data_v VARCHAR(20) NOT NULL,
    id_p VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_p) REFERENCES padroni(id_p) 
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- --- DB ES.03 - LEZ 10 -------

CREATE DATABASE php_es03;
USE php_es03;
SET SQL_SAFE_UPDATES = 0;

CREATE TABLE padroni (
	id_p VARCHAR(20) PRIMARY KEY,
    nome_p VARCHAR(20) NOT NULL,
    telefono INT NOT NULL
);

CREATE TABLE cani (
	id_c VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    data_n DATE NOT NULL,
    data_v DATE NOT NULL,
    id_p VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_p) REFERENCES padroni(id_p) 
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- --- QUERY PER FARE TEST -----

SELECT c.*, nome_p, telefono
FROM cani c
JOIN padroni p ON c.id_p = p.id_p
WHERE data_v < DATE_SUB(NOW(),INTERVAL 1 YEAR);

SELECT *
FROM padroni;

DELETE FROM cani;

DROP TABLE cani;
DROP TABLE padroni;


INSERT INTO cani (id_c, nome, data_n, data_v) VALUES ('5d3906', 'michele', '2025-07-01', '2025-07-02')