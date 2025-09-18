########################################### DATABASE
CREATE DATABASE estate_es18_bis;
USE estate_es18_bis;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
-- Tabella unica per gestire tutto il flusso di prenotazione
CREATE TABLE prenotazione (
    idp INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Dati gestore (sempre presenti)
    id_gestore INT,
    nome_gestore VARCHAR(100) NOT NULL,
    data_gestore DATE NOT NULL,
    orario_gestore ENUM(
        '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00',
        '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',
        '16:00 - 17:00', '17:00 - 18:00'
    ) NOT NULL,
    
    -- Dati cliente (NULL fino alla prenotazione)
    id_cliente INT NULL,
    nome_cliente VARCHAR(100) NULL,
    data_cliente DATE NULL,
    orario_cliente ENUM(
        '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00',
        '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',
        '16:00 - 17:00', '17:00 - 18:00'
    ) NULL,
    
    -- Timestamps per tracciamento
    data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_prenotazione TIMESTAMP NULL,
    
    -- VINCOLO UNICO: un gestore non può avere due prenotazioni stessa data e orario
    UNIQUE KEY unique_gestore_slot (nome_gestore, data_gestore, orario_gestore)
);


########################################### PSTORED PROCEDURE per POPOLARE DATABASE

DELIMITER //

CREATE PROCEDURE PopolaDatabaseUnico()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE j INT DEFAULT 0;
    DECLARE random_nome_gestore VARCHAR(100);
    DECLARE random_nome_cliente VARCHAR(100);
    DECLARE random_data DATE;
    DECLARE random_orario VARCHAR(15);
    DECLARE giorni_aggiunti INT;
    DECLARE success BOOLEAN;
    
    -- Variabili per nomi casuali (CENTRI ESTETICI)
    DECLARE nomi_gestori VARCHAR(1000) DEFAULT 'Bellezza Naturale,Estetica Divina,Centro Benessere Sereno,Spa Armonia,Studio Eleganza,Beauty Clinic,Estetica Perfetta,Centro Relax,Salone di Bellezza,Wellness Oasis';
    DECLARE nomi_clienti VARCHAR(1000) DEFAULT 'Mario Rossi,Luca Bianchi,Giulia Verdi,Anna Russo,Marco Ferrari,Sofia Romano,Alessio Costa,Chiara Esposito,Francesco Ricci,Elena Marino';
    
    -- Pulisce la tabella
    DELETE FROM prenotazione;
    ALTER TABLE prenotazione AUTO_INCREMENT = 1;
    
    -- Popola 30 slot di disponibilità
    WHILE i <= 30 DO
        SET success = FALSE;
        SET j = 0;
        
        -- Tentativo di inserimento con gestione duplicati
        WHILE NOT success AND j < 10 DO
            SET random_nome_gestore = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(nomi_gestori, ',', FLOOR(1 + RAND() * 10)), ',', -1));
            SET giorni_aggiunti = FLOOR(RAND() * 30);
            SET random_data = DATE_ADD(CURDATE(), INTERVAL giorni_aggiunti DAY);
            SET random_orario = ELT(FLOOR(1 + RAND() * 8), 
                '9:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', 
                '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00', 
                '16:00 - 17:00', '17:00 - 18:00');
            
            BEGIN
                DECLARE CONTINUE HANDLER FOR 1062 BEGIN END; -- Gestisce errore duplicato
            
                -- Inserisce slot disponibili (senza cliente)
                INSERT INTO prenotazione (
                    id_gestore, nome_gestore, data_gestore, orario_gestore
                ) VALUES (
                    i, random_nome_gestore, random_data, random_orario
                );
                
                SET success = TRUE;
            END;
            
            SET j = j + 1;
        END WHILE;
        
        SET i = i + 1;
    END WHILE;
    
    -- Simula prenotazioni per alcuni slot (circa 10)
    UPDATE prenotazione 
    SET 
        id_cliente = FLOOR(1 + RAND() * 100),
        nome_cliente = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(nomi_clienti, ',', FLOOR(1 + RAND() * 10)), ',', -1)),
        data_cliente = data_gestore,
        orario_cliente = orario_gestore,
        data_prenotazione = NOW() - INTERVAL FLOOR(RAND() * 7) DAY
    WHERE idp <= 10;
    
    SELECT 'Database popolato con successo!' AS Messaggio;
    SELECT 
        COUNT(*) AS 'Slot totali',
        SUM(CASE WHEN id_cliente IS NULL THEN 1 ELSE 0 END) AS 'Disponibili',
        SUM(CASE WHEN id_cliente IS NOT NULL THEN 1 ELSE 0 END) AS 'Prenotati'
    FROM prenotazione;
    
END //

DELIMITER ;

########################################### CALL per POPOLARE DATABASE
CALL PopolaDatabaseUnico();

########################################### TEST QUERY
SELECT *
FROM prenotazione;

