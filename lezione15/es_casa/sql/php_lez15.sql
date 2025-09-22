########################################### DATABASE
-- Cancellazione database precedente se esiste
DROP DATABASE IF EXISTS php_lez15;
CREATE DATABASE php_lez15;
USE php_lez15;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### CANCELLAZIONE TABELLE
DROP TABLE IF EXISTS sosta;
DROP TABLE IF EXISTS auto;
DROP TABLE IF EXISTS parcheggio;



########################################### TABELLE
CREATE TABLE auto (
    ida INT AUTO_INCREMENT PRIMARY KEY,
    targa VARCHAR(100) NOT NULL,
    proprietario VARCHAR(100) NOT NULL
);

CREATE TABLE parcheggio (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tariffa DECIMAL(5,2) NOT NULL
);

-- tabella many-to-many
CREATE TABLE sosta (
    ids INT AUTO_INCREMENT PRIMARY KEY,
    ida INT NOT NULL,
    idp INT NOT NULL,
    inizio_sosta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fine_sosta DATETIME NULL,
    costo_sosta DECIMAL(8,2) DEFAULT 0,
    FOREIGN KEY (ida) REFERENCES auto(ida) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idp) REFERENCES parcheggio(idp) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Trigger per calcolare automaticamente il costo quando viene impostata fine_sosta
DELIMITER $$

-- Elimina il trigger esistente se c'è
-- DROP TRIGGER IF EXISTS calcola_costo_sosta;

CREATE TRIGGER calcola_costo_sosta
BEFORE INSERT ON sosta
FOR EACH ROW
BEGIN
    -- Calcola il costo se fine_sosta è già impostata all'inserimento
    IF NEW.fine_sosta IS NOT NULL THEN
        SET NEW.costo_sosta = ROUND(
            TIMESTAMPDIFF(MINUTE, NEW.inizio_sosta, NEW.fine_sosta) * 
            (SELECT tariffa FROM parcheggio WHERE idp = NEW.idp) / 60,
            2  -- Arrotonda a 2 cifre decimali
        );
    END IF;
END$$

DELIMITER ;


########################################### POPOLAMENTO DATABASE

DELIMITER $$

CREATE PROCEDURE popola_database()
BEGIN
    -- Inserimento auto con nomi comuni
    INSERT INTO auto (targa, proprietario) VALUES
    ('AB123CD', 'Mario Rossi'),
    ('EF456GH', 'Luigi Verdi'),
    ('IJ789KL', 'Giovanni Bianchi'),
    ('MN012OP', 'Anna Ferrari'),
    ('QR345ST', 'Laura Romano'),
    ('UV678WX', 'Marco Esposito'),
    ('YZ901AB', 'Sofia Ricci'),
    ('CD234EF', 'Paolo Bruno'),
    ('GH567IJ', 'Elena Marino'),
    ('KL890MN', 'Andrea Conti'),
    ('OP123QR', 'Chiara Costa'),
    ('ST456UV', 'Francesco Greco'),
    ('WX789YZ', 'Giulia Barbieri'),
    ('AB012CD', 'Davide Moretti'),
    ('EF345GH', 'Elisa Gallo'),
    ('IJ678KL', 'Simone Fontana'),
    ('MN901OP', 'Valentina Santoro'),
    ('QR234ST', 'Roberto Rizzo'),
    ('UV567WX', 'Alessia Longo'),
    ('YZ890AB', 'Stefano De Luca');

    -- Inserimento parcheggi
    INSERT INTO parcheggio (nome, tariffa) VALUES
    ('Centrale', 2.81),
    ('Stazione', 3.26),
    ('Ospedale', 1.833),
    ('Università', 1.50),
    ('Stadio', 4.16),
    ('Centro Commerciale', 2.23),
    ('Aeroporto', 5.00);

    -- Inserimento soste (10 chiuse, 5 aperte)
    INSERT INTO sosta (ida, idp, inizio_sosta, fine_sosta) VALUES
    -- Soste chiuse
    (1, 1, '2024-01-15 08:30:00', '2024-01-15 10:45:00'),
    (2, 2, '2024-01-15 09:15:00', '2024-01-15 12:30:00'),
    (3, 3, '2024-01-15 14:00:00', '2024-01-15 16:20:00'),
    (4, 4, '2024-01-16 10:00:00', '2024-01-16 11:45:00'),
    (5, 5, '2024-01-16 15:30:00', '2024-01-16 18:15:00'),
    (6, 6, '2024-01-17 08:45:00', '2024-01-17 10:30:00'),
    (7, 7, '2024-01-17 13:20:00', '2024-01-17 15:40:00'),
    (8, 1, '2024-01-18 09:00:00', '2024-01-18 11:30:00'),
    (9, 2, '2024-01-18 14:15:00', '2024-01-18 16:45:00'),
    (10, 3, '2024-01-19 10:30:00', '2024-01-19 12:15:00'),
    
    -- Soste aperte (solo inizio)
    (11, 4, '2024-01-19 15:00:00', NULL),
    (12, 5, '2024-01-19 16:20:00', NULL),
    (13, 6, '2024-01-20 09:45:00', NULL),
    (14, 7, '2024-01-20 11:10:00', NULL),
    (15, 1, '2024-01-20 14:30:00', NULL);

    SELECT 'Database popolato con successo!' as Messaggio;
END$$

DELIMITER ;

-- CALL DI POPOLAMENTO DB
CALL popola_database();


########################################### TEST QUERY
-- Verifica tutte le prenotazioni
SELECT * FROM sosta;
SELECT * FROM auto;
SELECT * FROM parcheggio;

SELECT s.ids, a.targa, a.proprietario, p.nome, p.tariffa, s.inizio_sosta, s.costo_sosta 
FROM sosta s
JOIN auto a ON s.ida = a.ida
JOIN parcheggio p ON p.idp = s.idp
WHERE s.fine_sosta IS  NULL;

SELECT s.ids, a.targa, a.proprietario, p.nome, p.tariffa, s.inizio_sosta 
FROM sosta s
JOIN auto a ON s.ida = a.ida
JOIN parcheggio p ON p.idp = s.idp
WHERE s.fine_sosta IS NULL AND s.idp = 1;


SELECT s.ids, a.targa, a.proprietario, p.nome, p.tariffa, s.inizio_sosta, s.costo_sosta 
FROM sosta s
JOIN auto a ON s.ida = a.ida
JOIN parcheggio p ON p.idp = s.idp
WHERE s.fine_sosta IS NOT NULL;


SELECT *
FROM auto
WHERE ida NOT IN (
	SELECT ida
    FROM sosta
);

SELECT s.ids, a.targa, a.proprietario, p.nome, p.tariffa, s.inizio_sosta, s.fine_sosta, s.costo_sosta 
FROM sosta s
JOIN auto a ON s.ida = a.ida
JOIN parcheggio p ON p.idp = s.idp
WHERE s.fine_sosta IS NOT NULL AND s.idp = 3;

