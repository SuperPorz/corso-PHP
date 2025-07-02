DROP DATABASE IF EXISTS php_test;

CREATE DATABASE php_esercizi;

USE php_test;

select user, host
from mysql.user;

CREATE USER 'MIKY' @'localhost' IDENTIFIED BY '1990';

DROP USER MIKY@'localhost';

GRANT ALL ON php_esercizi TO 'MIKY' @'localhost';

SHOW GRANTS;