########################################### DATABASE
CREATE DATABASE estate_es12_officina;
USE estate_es12_officina;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
CREATE TABLE intervento (
	id_interv INT NOT NULL AUTO_INCREMENT,
	targa VARCHAR(255) NOT NULL,
	lavorazione VARCHAR(255) NOT NULL,
	operatore VARCHAR(255) NOT NULL,
    tempo INT NOT NULL,
    costo_h INT NOT NULL,
	PRIMARY KEY (id_interv)
);


########################################## POPOLAMENTO DATABASE
-- Script per inserire 100 record casuali nella tabella intervento
-- con procedura stored per inserimento automatico:
DELIMITER //
DROP PROCEDURE IF EXISTS InsertRandomRecords//
CREATE PROCEDURE InsertRandomRecords()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE random_targa VARCHAR(255);
    DECLARE random_lavorazione VARCHAR(100);
    DECLARE random_operatore VARCHAR(50);
    DECLARE random_tempo INT;
    DECLARE random_costo INT;
    
    -- Array di targhe
    DECLARE targhe_array TEXT DEFAULT 'AB123CD,EF456GH,IJ789KL,MN012OP,QR345ST,UV678WX,YZ901AB,CD234EF,GH567IJ,KL890MN,OP123QR,ST456UV,WX789YZ,AB012CD,EF345GH,IJ678KL,MN901OP,QR234ST,UV567WX,YZ890AB,BC123DE,FG456HI,JK789LM,NO012PQ,RS345TU,VW678XY,ZA901BC,DE234FG,HI567JK,LM890NO';
    
    -- Array di lavorazioni reali
    DECLARE lavorazioni_array TEXT DEFAULT 'Cambio olio,Verniciatura,Cambio frizione,Riparazione freni,Tagliando,Sostituzione pneumatici,Riparazione carrozzeria,Controllo impianto elettrico';
    
    -- Array di nomi operatori
    DECLARE operatori_array TEXT DEFAULT 'Mario,Marco,Giovanna,Sandra,Luigi,Anna,Paolo,Elena,Roberto,Francesca,Giuseppe,Chiara,Antonio,Valentina,Francesco';
    
    WHILE i <= 100 DO
        -- Genera valori casuali
        SET random_targa = SUBSTRING_INDEX(SUBSTRING_INDEX(targhe_array, ',', 1 + FLOOR(RAND() * 30)), ',', -1);
        SET random_lavorazione = SUBSTRING_INDEX(SUBSTRING_INDEX(lavorazioni_array, ',', 1 + FLOOR(RAND() * 8)), ',', -1);
        SET random_operatore = SUBSTRING_INDEX(SUBSTRING_INDEX(operatori_array, ',', 1 + FLOOR(RAND() * 15)), ',', -1);
        SET random_tempo = 1 + FLOOR(RAND() * 100);      -- tempo da 1 a 100 ore
        SET random_costo = 15 + FLOOR(RAND() * 61);      -- costo orario da 15 a 75 euro
        
        -- Inserisci il record
        INSERT INTO intervento (targa, lavorazione, operatore, tempo, costo_h) 
        VALUES (random_targa, random_lavorazione, random_operatore, random_tempo, random_costo);
        
        SET i = i + 1;
    END WHILE;
END//
DELIMITER ;
CALL InsertRandomRecords();
-- FINE ESECUZIONE

    
########################################## TEST QUERY
-- Opzionalmente, elimina la procedura dopo l'uso
DROP PROCEDURE IF EXISTS InsertRandomRecords;

-- Query di verifica per controllare i dati inseriti
SELECT 
    COUNT(*) as totale_record,
    COUNT(DISTINCT targa) as targhe_uniche,
    COUNT(DISTINCT lavorazione) as tipi_lavorazione,
    COUNT(DISTINCT operatore) as operatori_coinvolti,
    MIN(tempo) as tempo_min_ore,
    MAX(tempo) as tempo_max_ore,
    AVG(tempo) as tempo_medio_ore,
    MIN(costo_h) as costo_min_euro,
    MAX(costo_h) as costo_max_euro,
    AVG(costo_h) as costo_medio_euro
FROM intervento;

-- Query per vedere le lavorazioni più frequenti
SELECT 
    lavorazione,
    COUNT(*) as frequenza,
    ROUND((COUNT(*) * 100.0 / (SELECT COUNT(*) FROM intervento)), 2) as percentuale
FROM intervento 
GROUP BY lavorazione 
ORDER BY frequenza DESC;

-- Query per vedere gli operatori e quante lavorazioni hanno fatto
SELECT 
    operatore,
    COUNT(*) as lavorazioni_totali,
    AVG(tempo) as tempo_medio_ore,
    AVG(costo_h) as costo_medio_orario
FROM intervento 
GROUP BY operatore 
ORDER BY lavorazioni_totali DESC;

-- Quert per svuotare database
DELETE FROM intervento;

-- Opzionale: resetta il contatore AUTO_INCREMENT per ripartire da 1
ALTER TABLE intervento AUTO_INCREMENT = 1;

-- QUERY TOTALE
SELECT *
FROM intervento;