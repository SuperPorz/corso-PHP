CREATE DATABASE php_lez20;
USE php_lez20;

CREATE TABLE cani(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_n DATE NOT NULL
);

SELECT * FROM cani;

insert into cani (nome, data_n) values ('bubula', '2023/08/12');
insert into cani (nome, data_n) values ('ringhio', '1997/04/22');
insert into cani (nome, data_n) values ('birba', '2016/05/15');


truncate cani;