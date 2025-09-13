########################################### DATABASE
CREATE DATABASE estate_es15;
USE estate_es15;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
-- Tabella musicisti
CREATE TABLE musicista (
    idm INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    compenso DECIMAL(10,2) NOT NULL
);

-- Tabella utenti
CREATE TABLE utente (
    idu INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE
);

-- Tabella preferenze (relazione many-to-many)
CREATE TABLE preferenza (
    idp INT PRIMARY KEY AUTO_INCREMENT,
    utente_id INT,
    musicista_id INT,
    FOREIGN KEY (utente_id) REFERENCES utente(idu) ON DELETE CASCADE,
    FOREIGN KEY (musicista_id) REFERENCES musicista(idm) ON DELETE CASCADE
);

/*
-- Tabella concerti potenziali
CREATE TABLE concerti (
    id INT PRIMARY KEY AUTO_INCREMENT,
    musicista_id INT,
    prezzo_biglietto DECIMAL(8,2) NOT NULL,
    capacita_venue INT DEFAULT 1000,
    FOREIGN KEY (musicista_id) REFERENCES musicista(idm)
);
*/
########################################### POPOLAMENTO DATABASE INIZIALE
-- Script SQL per popolare il database concerti
-- Ottimizzato per ridurre il numero di operazioni

-- Disabilita controlli chiavi esterne temporaneamente per velocizzare
SET FOREIGN_KEY_CHECKS = 0;

-- Svuota tabelle esistenti
TRUNCATE TABLE preferenza;
TRUNCATE TABLE utente;  
TRUNCATE TABLE musicista;

-- INSERIMENTO MUSICISTI (8 musicisti)
-- Compensi calcolati per ottenere prezzi biglietto ragionevoli (15-35€)
INSERT INTO musicista (nome, compenso) VALUES 
('The Disco Kings', 12000.00),
('Funk Revolution', 18000.00),
('Soul Sisters', 9000.00),
('Rock Legends', 24000.00),
('Jazz Collective', 6000.00),
('Pop Sensation', 15000.00),
('Blues Brothers Revival', 21000.00),
('Electronic Dreams', 13500.00);

-- INSERIMENTO UTENTI (16 utenti - ottimizzato in batch)
INSERT INTO utente (nome, email) VALUES 
('Marco Rossi', 'marco.rossi@email.com'),
('Giulia Bianchi', 'giulia.bianchi@email.com'),
('Luca Verdi', 'luca.verdi@email.com'),
('Anna Neri', 'anna.neri@email.com'),
('Francesco Romano', 'francesco.romano@email.com'),
('Chiara Ricci', 'chiara.ricci@email.com'),
('Andrea Marino', 'andrea.marino@email.com'),
('Valentina Costa', 'valentina.costa@email.com'),
('Stefano Ferrari', 'stefano.ferrari@email.com'),
('Elena Esposito', 'elena.esposito@email.com'),
('Matteo Conti', 'matteo.conti@email.com'),
('Sofia Greco', 'sofia.greco@email.com'),
('Alessandro Bruno', 'alessandro.bruno@email.com'),
('Martina Galli', 'martina.galli@email.com'),
('Davide Lombardi', 'davide.lombardi@email.com'),
('Federica Barbieri', 'federica.barbieri@email.com');

-- INSERIMENTO PREFERENZE (distribuzione strategica per ottimizzare i prezzi)
-- Ottimizzato in batch per ridurre le operazioni

-- The Disco Kings (id 1) - 8 preferenze -> prezzo stimato: ~19.50€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(1, 1), (2, 1), (3, 1), (4, 1), (5, 1), (6, 1), (7, 1), (8, 1);

-- Funk Revolution (id 2) - 6 preferenze -> prezzo stimato: ~39.00€  
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(9, 2), (10, 2), (11, 2), (12, 2), (13, 2), (14, 2);

-- Soul Sisters (id 3) - 5 preferenze -> prezzo stimato: ~23.40€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(1, 3), (3, 3), (5, 3), (7, 3), (9, 3);

-- Rock Legends (id 4) - 12 preferenze -> prezzo stimato: ~26.00€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(2, 4), (4, 4), (6, 4), (8, 4), (10, 4), (12, 4),
(14, 4), (16, 4), (1, 4), (11, 4), (13, 4), (15, 4);

-- Jazz Collective (id 5) - 4 preferenze -> prezzo stimato: ~19.50€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(3, 5), (7, 5), (11, 5), (15, 5);

-- Pop Sensation (id 6) - 10 preferenze -> prezzo stimato: ~19.50€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(4, 6), (8, 6), (12, 6), (16, 6), (2, 6),
(6, 6), (10, 6), (14, 6), (1, 6), (5, 6);

-- Blues Brothers Revival (id 7) - 7 preferenze -> prezzo stimato: ~39.00€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(9, 7), (13, 7), (1, 7), (5, 7), (11, 7), (15, 7), (3, 7);

-- Electronic Dreams (id 8) - 6 preferenze -> prezzo stimato: ~29.25€
INSERT INTO preferenza (utente_id, musicista_id) VALUES 
(2, 8), (6, 8), (10, 8), (14, 8), (4, 8), (16, 8);

-- Riabilita controlli chiavi esterne
SET FOREIGN_KEY_CHECKS = 1;


########################################### TEST QUERY
SELECT *
FROM musicista;

SELECT *
FROM utente;

SELECT *
FROM preferenza;

SELECT m.idm, m.nome, m.compenso, COUNT(*) AS spettatori
FROM musicista m
JOIN preferenza p ON m.idm = p.musicista_id
GROUP BY m.idm
ORDER BY spettatori DESC;

########################################### QUERY proposte da claude.ai
-- QUERY DI VERIFICA E CALCOLO PREZZI
-- Calcola il prezzo biglietto per ogni musicista secondo la formula:
-- (compenso + 30% profitto organizzazione) / totale preferenze

SELECT 
    m.idm,
    m.nome AS musicista,
    m.compenso,
    COUNT(p.idp) AS totale_preferenze,
    ROUND((m.compenso * 1.3) / COUNT(p.idp), 2) AS prezzo_biglietto,
    ROUND(((m.compenso * 1.3) / COUNT(p.idp)) * COUNT(p.idp), 2) AS incasso_totale,
    ROUND(((m.compenso * 1.3) / COUNT(p.idp)) * COUNT(p.idp) - m.compenso, 2) AS profitto_organizzazione
FROM musicista m
LEFT JOIN preferenza p ON m.idm = p.musicista_id
GROUP BY m.idm, m.nome, m.compenso
ORDER BY profitto_organizzazione DESC;

-- STATISTICHE GENERALI
SELECT 
    (SELECT COUNT(*) FROM musicista) AS totale_musicisti,
    (SELECT COUNT(*) FROM utente) AS totale_utenti, 
    (SELECT COUNT(*) FROM preferenza) AS totale_preferenze,
    (SELECT ROUND(AVG(sub.prezzo), 2) FROM 
        (SELECT (m.compenso * 1.3) / 
            GREATEST((SELECT COUNT(*) FROM preferenza WHERE musicista_id = m.idm), 1) AS prezzo 
         FROM musicista m) sub
    ) AS prezzo_medio_biglietto;

-- QUERY PER TROVARE I MUSICISTI PIÙ POPOLARI
SELECT 
    m.nome,
    COUNT(p.idp) AS numero_fan,
    m.compenso,
    ROUND((m.compenso * 1.3) / COUNT(p.idp), 2) AS prezzo_biglietto
FROM musicista m
LEFT JOIN preferenza p ON m.idm = p.musicista_id
GROUP BY m.idm, m.nome, m.compenso
ORDER BY numero_fan DESC;



########################################### POPOLAMENTO DATABASE FINALE
-- ====================================================================
-- STORED PROCEDURE SEMPLICE - 5000 UTENTI FISSI
-- ====================================================================

-- ====================================================================
-- STORED PROCEDURE SEMPLICE - 5000 UTENTI FISSI
-- ====================================================================

-- ====================================================================
-- STORED PROCEDURE SEMPLICE - 5000 UTENTI FISSI
-- ====================================================================

DELIMITER //

CREATE PROCEDURE InserisciUtentiBulk()
BEGIN
    -- TUTTE LE DICHIARAZIONI PRIMA DI TUTTO
    DECLARE i INT DEFAULT 1;
    DECLARE nome_utente VARCHAR(100);
    DECLARE email_utente VARCHAR(100);
    DECLARE musicista_preferito INT;
    DECLARE utente_id INT;
    DECLARE nome_casuale INT;
    DECLARE dominio_email INT;
    DECLARE num_preferenze INT;
    DECLARE j INT;
    DECLARE nomi TEXT DEFAULT 'Alessandro Rossi,Marco Bianchi,Luca Ferrari,Andrea Russo,Francesco Romano,Matteo Esposito,Lorenzo Colombo,Davide Ricci,Riccardo Marino,Simone Greco,Giuseppe Bruno,Antonio Gallo,Stefano Conti,Gabriele Costa,Nicola Rizzo,Roberto Lombardi,Emanuele Moretti,Daniele Barbieri,Paolo Fontana,Michele Santoro,Giovanni Mariani,Fabio Rinaldi,Alberto Caruso,Tommaso Ferrara,Federico Galli,Cristian Martini,Vincenzo Leone,Salvatore Longo,Claudio Gentile,Massimo Martinelli,Diego Vitale,Giulio Lombardo,Enrico Serra,Valerio Coppola,Jacopo Villa,Manuel Conte,Dario Ferretti,Mario Sala,Sergio Benedetti,Franco Fabbri,Valentino Caputo,Alessio Bianco,Mirko Piras,Edoardo Negri,Samuele Pellegrini,Alessia Rossi,Chiara Bianchi,Francesca Ferrari,Martina Russo,Sara Romano';
    DECLARE domini TEXT DEFAULT 'gmail.com,yahoo.it,hotmail.com,libero.it,outlook.com,virgilio.it,alice.it,fastwebnet.it,tin.it,live.it';
    
    -- LOGICA DELLA PROCEDURA
    SET FOREIGN_KEY_CHECKS = 0;
    SET UNIQUE_CHECKS = 0;
    
    START TRANSACTION;
    
    WHILE i <= 5000 DO
        -- Genera nome casuale
        SET nome_casuale = FLOOR(1 + (RAND() * 50));
        SET nome_utente = SUBSTRING_INDEX(SUBSTRING_INDEX(nomi, ',', nome_casuale), ',', -1);
        
        -- Genera email casuale
        SET dominio_email = FLOOR(1 + (RAND() * 10));
        SET email_utente = CONCAT(
            'user',
            LPAD(i, 5, '0'),
            '@',
            SUBSTRING_INDEX(SUBSTRING_INDEX(domini, ',', dominio_email), ',', -1)
        );
        
        -- Inserisci utente (SOLO nome ed email!)
        INSERT INTO utente (nome, email) 
        VALUES (nome_utente, email_utente);
        
        -- Ottieni l'ID dell'utente appena inserito
        SET utente_id = LAST_INSERT_ID();
        
        -- Genera preferenze casuali per questo utente (1-4 preferenze)
        SET num_preferenze = FLOOR(1 + (RAND() * 4));
        SET j = 1;
        
        WHILE j <= num_preferenze DO
            -- Scegli un musicista casuale (1-8)
            SET musicista_preferito = FLOOR(1 + (RAND() * 8));
            
            -- Inserisci preferenza (ignora duplicati con IGNORE)
            INSERT IGNORE INTO preferenza (utente_id, musicista_id) 
            VALUES (utente_id, musicista_preferito);
            
            SET j = j + 1;
        END WHILE;
        
        -- Commit ogni 1000 inserimenti
        IF i % 1000 = 0 THEN
            COMMIT;
            START TRANSACTION;
            SELECT CONCAT('Inseriti ', i, ' utenti') AS Progresso;
        END IF;
        
        SET i = i + 1;
    END WHILE;
    
    COMMIT;
    
    SET FOREIGN_KEY_CHECKS = 1;
    SET UNIQUE_CHECKS = 1;
    
    -- Statistiche finali
    SELECT 
        'Operazione completata!' AS Messaggio,
        (SELECT COUNT(*) FROM utente) AS TotaleUtenti,
        (SELECT COUNT(*) FROM preferenza) AS TotalePreferenze;
        
END //

DELIMITER ;

-- ESECUZIONE
CALL InserisciUtentiBulk();


-- QUERY DI VERIFICA
SELECT 
    m.nome AS Musicista,
    COUNT(p.idp) AS NumeroFan,
    ROUND((m.compenso * 1.3) / COUNT(p.idp), 2) AS PrezzoBiglietto
FROM musicista m
LEFT JOIN preferenza p ON m.idm = p.musicista_id
GROUP BY m.idm, m.nome, m.compenso
ORDER BY NumeroFan DESC;


