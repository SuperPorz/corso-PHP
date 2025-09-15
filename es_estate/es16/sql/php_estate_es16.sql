########################################### DATABASE
CREATE DATABASE estate_es16;
USE estate_es16;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
CREATE TABLE articolo (
    ida INT PRIMARY KEY AUTO_INCREMENT,
    autore VARCHAR(100) NOT NULL,
    titolo VARCHAR(100) NOT NULL,
    argomento VARCHAR(100) NOT NULL,
    testo TEXT NOT NULL,
    lunghezza INT GENERATED ALWAYS AS (LENGTH(testo)) STORED
);


########################################### POPOLAMENTO DATABASE



########################################### TEST QUERY
SELECT *
FROM articolo;

