########################################### DATABASE
CREATE DATABASE estate_es18;
USE estate_es18;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
-- tabella per memorizzare una richiesta di prenotazione
CREATE TABLE richiesta (
    idu INT AUTO_INCREMENT NOT NULL,
    nome_utente VARCHAR(100) NOT NULL,
    `data` DATE NOT NULL,
    orario ENUM(
        '9:00 - 10:00',
        '10:00 - 11:00',
        '11:00 - 12:00',
        '13:00 - 14:00',
        '14:00 - 15:00',
        '15:00 - 16:00',
        '16:00 - 17:00',
        '17:00 - 18:00'
    ) NOT NULL,
    PRIMARY KEY (idu, `data`, orario)
);

-- tabella per memorizzare unadisponibilità di a parte dei gestori
CREATE TABLE disponibilita (
    idg INT AUTO_INCREMENT NOT NULL,
    nome_gestore VARCHAR(100) NOT NULL,
    `data` DATE NOT NULL,
    orario ENUM(
        '9:00 - 10:00',
        '10:00 - 11:00',
        '11:00 - 12:00',
        '13:00 - 14:00',
        '14:00 - 15:00',
        '15:00 - 16:00',
        '16:00 - 17:00',
        '17:00 - 18:00'
    ) NOT NULL,
    PRIMARY KEY (idg, `data`, orario)
);

-- tabella per memorizzare gli appuntamenti CONFERMABILI (match cliente/gestore positivo in termini di data-orario)
CREATE TABLE prenotazione (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    idu INT NOT NULL,
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
    
    -- Foreign key per richiesta (deve referenziare TUTTA la chiave primaria composta)
    FOREIGN KEY (idu, data_appuntamento, orario_appuntamento) 
        REFERENCES richiesta(idu, `data`, orario) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    
    -- Foreign key per disponibilita (deve referenziare TUTTA la chiave primaria composta)
    FOREIGN KEY (idg, data_appuntamento, orario_appuntamento) 
        REFERENCES disponibilita(idg, `data`, orario) 
        ON DELETE CASCADE ON UPDATE CASCADE
);


########################################### POPOLAMENTO DATABASE

DELIMITER //

CREATE PROCEDURE PopolaDatabase()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE random_nome VARCHAR(100);
    DECLARE random_data DATE;
    DECLARE random_orario VARCHAR(15);
    DECLARE giorni_aggiunti INT;
    
    -- Variabili per nomi casuali
    DECLARE nomi_utenti VARCHAR(1000) DEFAULT 'Mario Rossi,Luca Bianchi,Giulia Verdi,Anna Russo,Marco Ferrari,Sofia Romano,Alessio Costa,Chiara Esposito,Francesco Ricci,Elena Marino';
    DECLARE nomi_gestori VARCHAR(1000) DEFAULT 'TecnoService,AssistenzaTech,RiparazioniExpress,GadgetFix,DeviceCare,PhoneDoctor,TabletMedic,ComputerSalus,LaptopAid,SmartRepair';
    
    -- Pulisce le tabelle
    DELETE FROM prenotazione;
    DELETE FROM richiesta;
    DELETE FROM disponibilita;
    
    -- Reset auto_increment
    ALTER TABLE richiesta AUTO_INCREMENT = 1;
    ALTER TABLE disponibilita AUTO_INCREMENT = 1;
    ALTER TABLE prenotazione AUTO_INCREMENT = 1;
    
    -- Popola richieste (15 record)
    WHILE i <= 15 DO
        SET random_nome = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(nomi_utenti, ',', FLOOR(1 + RAND() * 10)), ',', -1));
        SET giorni_aggiunti = FLOOR(RAND() * 15); -- Ridotto a 15 giorni per aumentare le probabilità di match
        SET random_data = DATE_ADD(CURDATE(), INTERVAL giorni_aggiunti DAY);
        SET random_orario = ELT(FLOOR(1 + RAND() * 8), 
            '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', 
            '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00', 
            '16:00 - 17:00', '17:00 - 18:00');
        
        INSERT INTO richiesta (nome_utente, data, orario)
        VALUES (random_nome, random_data, random_orario);
        
        SET i = i + 1;
    END WHILE;
    
    -- Popola disponibilità - CREO APPUNTAMENTI CON MATCH INTENZIONALI
    SET i = 1;
    WHILE i <= 15 DO
        SET random_nome = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(nomi_gestori, ',', FLOOR(1 + RAND() * 10)), ',', -1));
        
        -- Per i primi 10 record, creo match intenzionali con le richieste
        IF i <= 10 THEN
            -- Prendo una richiesta casuale esistente e uso la sua data e orario
            SELECT data, orario INTO random_data, random_orario 
            FROM richiesta 
            ORDER BY RAND() 
            LIMIT 1;
        ELSE
            -- Per gli ultimi 5 record, creo disponibilità casuali (potrebbero non matchare)
            SET giorni_aggiunti = FLOOR(RAND() * 15);
            SET random_data = DATE_ADD(CURDATE(), INTERVAL giorni_aggiunti DAY);
            SET random_orario = ELT(FLOOR(1 + RAND() * 8), 
                '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', 
                '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00', 
                '16:00 - 17:00', '17:00 - 18:00');
        END IF;
        
        INSERT INTO disponibilita (nome_gestore, data, orario)
        VALUES (random_nome, random_data, random_orario);
        
        SET i = i + 1;
    END WHILE;
    
    -- Popola prenotazioni (solo se c'è match tra richieste e disponibilità)
    INSERT INTO prenotazione (idu, idg, data_appuntamento, orario_appuntamento)
    SELECT r.idu, d.idg, r.data, r.orario
    FROM richiesta r
    INNER JOIN disponibilita d ON r.data = d.data AND r.orario = d.orario;
    
    SELECT 'Database popolato con successo!' AS Messaggio;
    SELECT COUNT(*) AS 'Richieste inserite' FROM richiesta;
    SELECT COUNT(*) AS 'Disponibilità inserite' FROM disponibilita;
    SELECT COUNT(*) AS 'Prenotazioni create' FROM prenotazione;
    
END //

DELIMITER ;


-- Chiama la stored procedure
CALL PopolaDatabase();

########################################### TEST QUERY
SELECT *
FROM prenotazione;

