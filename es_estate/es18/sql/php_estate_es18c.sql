########################################### DATABASE
CREATE DATABASE estate_es18c;
USE estate_es18c;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
-- tabella per memorizzare una richiesta di prenotazione
CREATE TABLE cliente (
    idc INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    PRIMARY KEY (idc)
);

-- tabella per memorizzare unadisponibilità di a parte dei gestori
CREATE TABLE gestore (
    idg INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    numero VARCHAR(100) NOT NULL,
    PRIMARY KEY (idg)
);

-- tabella per memorizzare gli appuntamenti CONFERMABILI (match cliente/gestore positivo in termini di data-orario)
CREATE TABLE prenotazione (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    idg INT NOT NULL,
    data_appuntamento DATE NOT NULL,
    orario_appuntamento ENUM(
        '9:00 - 10:00',
        '10:00 - 11:00',
        '11:00 - 12:00',
        '13:00 - 14:00',
        '14:00 - 15:00',
        '15:00 - 16:00',
        '16:00 - 17:00',
        '17:00 - 18:00'
    ) NOT NULL,
    idc INT NULL,
    FOREIGN KEY (idg) REFERENCES gestore(idg) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idc) REFERENCES cliente(idc) ON DELETE CASCADE ON UPDATE CASCADE
);


########################################### POPOLAMENTO DATABASE

DELIMITER //

CREATE PROCEDURE PopolaDatabase()
BEGIN
    -- Inserimento dati nella tabella cliente
    INSERT INTO cliente (nome, mail) VALUES
    ('Mario Rossi', 'mario.rossi@email.com'),
    ('Luigi Verdi', 'luigi.verdi@email.com'),
    ('Giovanni Bianchi', 'giovanni.bianchi@email.com'),
    ('Anna Neri', 'anna.neri@email.com'),
    ('Paola Gialli', 'paola.gialli@email.com'),
    ('Marco Blu', 'marco.blu@email.com'),
    ('Laura Viola', 'laura.viola@email.com'),
    ('Simone Arancione', 'simone.arancione@email.com'),
    ('Elena Rosa', 'elena.rosa@email.com'),
    ('Fabio Celeste', 'fabio.celeste@email.com');

    -- Inserimento dati nella tabella gestore
    INSERT INTO gestore (nome, numero) VALUES
    ('Bellezza Naturale', '+39 333 1234567'),
    ('Estetica Divina', '+39 334 7654321'),
    ('Beauty Clinic', '+39 335 9876543'),
    ('Wellness Oasis', '+39 336 4567890'),
    ('Spa Armonia', '+39 337 2345678');

    -- Inserimento dati nella tabella prenotazione (per i prossimi 7 giorni)
    INSERT INTO prenotazione (idg, data_appuntamento, orario_appuntamento, idc) VALUES
    -- Giorno 1
    (1, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '9:00 - 10:00', 1),
    (2, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '10:00 - 11:00', 2),
    (3, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '11:00 - 12:00', 3),
    (4, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '13:00 - 14:00', 4),
    (5, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '14:00 - 15:00', 5),
    
    -- Giorno 2
    (1, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '15:00 - 16:00', 6),
    (2, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '16:00 - 17:00', 7),
    (3, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '17:00 - 18:00', 8),
    (4, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '9:00 - 10:00', 9),
    (5, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '10:00 - 11:00', 10),
    
    -- Giorno 3 (alcune prenotazioni senza cliente)
    (1, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '11:00 - 12:00', NULL),
    (2, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '13:00 - 14:00', NULL),
    (3, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '14:00 - 15:00', 1),
    (4, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '15:00 - 16:00', 2),
    (5, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '16:00 - 17:00', NULL),
    
    -- Giorno 4
    (1, DATE_ADD(CURDATE(), INTERVAL 4 DAY), '17:00 - 18:00', 3),
    (2, DATE_ADD(CURDATE(), INTERVAL 4 DAY), '9:00 - 10:00', 4),
    (3, DATE_ADD(CURDATE(), INTERVAL 4 DAY), '10:00 - 11:00', 5),
    (4, DATE_ADD(CURDATE(), INTERVAL 4 DAY), '11:00 - 12:00', 6),
    (5, DATE_ADD(CURDATE(), INTERVAL 4 DAY), '13:00 - 14:00', 7),
    
    -- Giorno 5
    (1, DATE_ADD(CURDATE(), INTERVAL 5 DAY), '14:00 - 15:00', 8),
    (2, DATE_ADD(CURDATE(), INTERVAL 5 DAY), '15:00 - 16:00', 9),
    (3, DATE_ADD(CURDATE(), INTERVAL 5 DAY), '16:00 - 17:00', 10),
    (4, DATE_ADD(CURDATE(), INTERVAL 5 DAY), '17:00 - 18:00', 1),
    (5, DATE_ADD(CURDATE(), INTERVAL 5 DAY), '9:00 - 10:00', 2);

    SELECT 'Database popolato con successo!' AS Messaggio;
END //

DELIMITER ;


# chiama la procedura
CALL PopolaDatabase();


########################################### TEST QUERY
SELECT *
FROM prenotazione;

