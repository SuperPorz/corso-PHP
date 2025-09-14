########################################### DATABASE
CREATE DATABASE estate_es15;
USE estate_es15;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
CREATE TABLE giocatore (
    idg INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    ruolo ENUM('playmaker', 'guardia', 'ala_piccola', 'ala_grande', 'pivot') NOT NULL,
    punti INT NOT NULL,
    rimbalzi INT NOT NULL,
    assist INT NOT NULL,
    resistenza INT NOT NULL,
    palle_perse INT NOT NULL,
    falli INT NOT NULL,
    ranking INT GENERATED ALWAYS AS
		(((punti + rimbalzi + assist + resistenza) * 75) / (palle_perse * 1.15 + falli * 1.35)) STORED
);


########################################### POPOLAMENTO DATABASE
-- Creazione della stored procedure per il popolamento della tabella giocatore
DELIMITER $$

CREATE PROCEDURE PopolaGiocatoriBasket()
BEGIN
    DECLARE i INT DEFAULT 0;
    DECLARE nome_casuale VARCHAR(100);
    DECLARE cognome_casuale VARCHAR(100);
    DECLARE ruolo_casuale ENUM('playmaker', 'guardia', 'ala_piccola', 'ala_grande', 'pivot');

    -- Creazione di una tabella temporanea per i nomi
    CREATE TEMPORARY TABLE IF NOT EXISTS nomi_temp (
        nome VARCHAR(50),
        cognome VARCHAR(50)
    );

    -- Popolamento della tabella temporanea con nomi e cognomi internazionali
    INSERT INTO nomi_temp (nome, cognome) VALUES
    ('Michael', 'Jordan'), ('LeBron', 'James'), ('Kobe', 'Bryant'), ('Stephen', 'Curry'), ('Kevin', 'Durant'),
    ('Giannis', 'Antetokounmpo'), ('Luka', 'Doncic'), ('Nikola', 'Jokic'), ('Kawhi', 'Leonard'), ('Paul', 'George'),
    ('Kyrie', 'Irving'), ('Damian', 'Lillard'), ('James', 'Harden'), ('Chris', 'Paul'), ('Russell', 'Westbrook'),
    ('Joel', 'Embiid'), ('Jayson', 'Tatum'), ('Devin', 'Booker'), ('Donovan', 'Mitchell'), ('Jimmy', 'Butler'),
    ('Anthony', 'Davis'), ('Zion', 'Williamson'), ('Ja', 'Morant'), ('Trae', 'Young'), ('Karl-Anthony', 'Towns'),
    ('Jason', 'Kidd'), ('Allen', 'Iverson'), ('Dirk', 'Nowitzki'), ('Shaquille', 'O\'Neal'), ('Tim', 'Duncan'),
    ('Steve', 'Nash'), ('Dwyane', 'Wade'), ('Kevin', 'Garnett'), ('Ray', 'Allen'), ('Vince', 'Carter'),
    ('Carmelo', 'Anthony'), ('Tracy', 'McGrady'), ('Yao', 'Ming'), ('Tony', 'Parker'), ('Manu', 'Ginobili'),
    ('Derrick', 'Rose'), ('Blake', 'Griffin'), ('Dwight', 'Howard'), ('Pau', 'Gasol'), ('Rajon', 'Rondo');

    -- Ciclo per l'inserimento di 125 record (25 per ogni ruolo)
    WHILE i < 125 DO
        -- Assegna un ruolo ogni 25 iterazioni
        IF i < 25 THEN SET ruolo_casuale = 'playmaker';
        ELSEIF i < 50 THEN SET ruolo_casuale = 'guardia';
        ELSEIF i < 75 THEN SET ruolo_casuale = 'ala_piccola';
        ELSEIF i < 100 THEN SET ruolo_casuale = 'ala_grande';
        ELSE SET ruolo_casuale = 'pivot';
        END IF;

        -- Seleziona un nome casuale dalla tabella temporanea
        SELECT nome, cognome INTO nome_casuale, cognome_casuale
        FROM nomi_temp ORDER BY RAND() LIMIT 1;

        -- Inserimento del record con valori casuali
        INSERT INTO giocatore (nome, ruolo, punti, rimbalzi, assist, resistenza, palle_perse, falli)
        VALUES (
            CONCAT(nome_casuale, ' ', cognome_casuale),
            ruolo_casuale,
            FLOOR(10 + (RAND() * 91)),  -- da 10 a 100
            FLOOR(5 + (RAND() * 71)),   -- da 5 a 75
            FLOOR(RAND() * 41),         -- da 0 a 40
            FLOOR(5 + (RAND() * 46)),   -- da 5 a 50
            FLOOR(1 + (RAND() * 50)),   -- da 1 a 50
            FLOOR(RAND() * 31)          -- da 0 a 30
        );

        SET i = i + 1;
    END WHILE;

    -- Eliminazione della tabella temporanea
    DROP TEMPORARY TABLE IF EXISTS nomi_temp;
END$$

DELIMITER ;

-- Chiamata alla stored procedure per eseguire il popolamento
CALL PopolaGiocatoriBasket();

########################################### TEST QUERY
SELECT *
FROM giocatore;

ALTER TABLE giocatori AUTO_INCREMENT = 125;

DELETE FROM giocatore WHERE idg = 128