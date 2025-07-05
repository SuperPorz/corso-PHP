CREATE DATABASE php_es01;
USE php_es01;
SET SQL_SAFE_UPDATES = 0;

CREATE TABLE cani (
	id_c VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    data_n VARCHAR(20) NOT NULL,
    data_v VARCHAR(20) NOT NULL
);

-- ---- QUERY PER FARE TEST -----

SELECT *
FROM cani;

DELETE FROM cani;

DROP TABLE cani;


INSERT INTO cani (id_c, nome, data_n, data_v) VALUES ('5d3906', 'michele', '2025-07-01', '2025-07-02')