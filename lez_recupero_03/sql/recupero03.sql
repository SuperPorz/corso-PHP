########################################### DATABASE
CREATE DATABASE recupero03;
USE recupero03;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
-- Creazione tabella articolo da zero con tutti i vincoli
CREATE TABLE vendite (
    idv INT PRIMARY KEY AUTO_INCREMENT,
    agente VARCHAR(100) NOT NULL,
    `data` DATE NOT NULL,
    importo FLOAT NOT NULL,
    provvigione FLOAT NULL
);


########################################### POPOLAMENTO DATABASE
-- procedura 1: 50 records misti
DELIMITER //

CREATE PROCEDURE PopolaVendite50()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE data_vendita DATE;
    DECLARE importo_vendita FLOAT;
    DECLARE provvigione_vendita FLOAT;
    DECLARE has_provvigione INT;
    
    -- Lista di agenti di esempio
    DECLARE agenti VARCHAR(100);
    
    WHILE i <= 50 DO
        -- Genera una data casuale negli ultimi 90 giorni
        SET data_vendita = DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 90) DAY);
        
        -- Genera un importo casuale tra 100 e 10000
        SET importo_vendita = ROUND(100 + (RAND() * 9900), 2);
        
        -- Decide casualmente se avere provvigione (70% con provvigione, 30% NULL)
        SET has_provvigione = FLOOR(RAND() * 10);
        
        IF has_provvigione < 7 THEN
            -- Calcola la provvigione (10% dell'importo)
            SET provvigione_vendita = ROUND(importo_vendita * 0.1, 2);
        ELSE
            -- Imposta provvigione a NULL
            SET provvigione_vendita = NULL;
        END IF;
        
        -- Seleziona casualmente un agente dalla lista
        SET agenti = CASE FLOOR(RAND() * 6)
            WHEN 0 THEN 'Mario Rossi'
            WHEN 1 THEN 'Luigi Bianchi'
            WHEN 2 THEN 'Giulia Verdi'
            WHEN 3 THEN 'Anna Neri'
            WHEN 4 THEN 'Paolo Gialli'
            ELSE 'Laura Blu'
        END;
        
        -- Inserisce il record
        INSERT INTO vendite (agente, data, importo, provvigione)
        VALUES (agenti, data_vendita, importo_vendita, provvigione_vendita);
        
        SET i = i + 1;
    END WHILE;
    
    SELECT 'Inseriti 50 record nella tabella vendite (provvigioni miste)' AS risultato;
END //

DELIMITER ;

-- procedura 2: 10 records con provvigione NULL
DELIMITER //

CREATE PROCEDURE PopolaVenditeNoProvvigione()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE data_vendita DATE;
    DECLARE importo_vendita FLOAT;
    
    -- Lista di agenti di esempio
    DECLARE agenti VARCHAR(100);
    
    WHILE i <= 10 DO
        -- Genera una data casuale negli ultimi 90 giorni
        SET data_vendita = DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 90) DAY);
        
        -- Genera un importo casuale tra 100 e 10000
        SET importo_vendita = ROUND(100 + (RAND() * 9900), 2);
        
        -- Seleziona casualmente un agente dalla lista
        SET agenti = CASE FLOOR(RAND() * 6)
            WHEN 0 THEN 'Mario Rossi'
            WHEN 1 THEN 'Luigi Bianchi'
            WHEN 2 THEN 'Giulia Verdi'
            WHEN 3 THEN 'Anna Neri'
            WHEN 4 THEN 'Paolo Gialli'
            ELSE 'Laura Blu'
        END;
        
        -- Inserisce il record con provvigione NULL
        INSERT INTO vendite (agente, data, importo, provvigione)
        VALUES (agenti, data_vendita, importo_vendita, NULL);
        
        SET i = i + 1;
    END WHILE;
    
    SELECT 'Inseriti 10 record con provvigione NULL' AS risultato;
END //

DELIMITER ;

############# chiamate alle stored procedures
CALL PopolaVendite50();
CALL PopolaVenditeNoProvvigione();

########################################### TEST QUERY
SELECT * FROM vendite;

