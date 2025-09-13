########################################### DATABASE
CREATE DATABASE estate_es13;
USE estate_es13;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
CREATE TABLE viaggio (
	idv INT NOT NULL AUTO_INCREMENT,
	luogo_partenza VARCHAR(255) NOT NULL,
	luogo_arrivo VARCHAR(255) NOT NULL,
	distanza VARCHAR(255) NOT NULL,
    consumo INT NOT NULL,
	PRIMARY KEY (idv)
);

########################################### POPOLAMENTO DATABASE
-- Inserimento di 30 viaggi di test
INSERT INTO viaggio (luogo_partenza, luogo_arrivo, distanza, consumo) VALUES
('Roma', 'Milano', '575', '65'),
('Milano', 'Napoli', '840', '78'),
('Firenze', 'Venezia', '256', '32'),
('Torino', 'Bologna', '385', '45'),
('Palermo', 'Catania', '190', '28'),
('Genova', 'Pisa', '155', '22'),
('Bari', 'Lecce', '150', '25'),
('Verona', 'Padova', '80', '15'),
('Bologna', 'Firenze', '105', '18'),
('Napoli', 'Salerno', '55', '12'),
('Cagliari', 'Sassari', '250', '38'),
('Trieste', 'Udine', '70', '14'),
('Perugia', 'Ancona', '165', '26'),
('Livorno', 'Grosseto', '120', '20'),
('Modena', 'Reggio Emilia', '45', '10'),
('Parma', 'Piacenza', '85', '16'),
('Bolzano', 'Trento', '60', '13'),
('Brescia', 'Bergamo', '50', '11'),
('Foggia', 'Taranto', '120', '21'),
('Siracusa', 'Ragusa', '85', '17'),
('Matera', 'Potenza', '75', '15'),
('Novara', 'Vercelli', '40', '9'),
('Alessandria', 'Asti', '35', '8'),
('Pescara', 'Chieti', '25', '7'),
('Brindisi', 'Lecce', '40', '9'),
('Como', 'Varese', '45', '10'),
('Imola', 'Faenza', '25', '6'),
('Lucca', 'Pistoia', '35', '8'),
('Cremona', 'Mantova', '65', '14'),
('Viterbo', 'Rieti', '70', '15');


########################################### TEST QUERY
SELECT *
FROM viaggio;

-- Verifica degli inserimenti
SELECT COUNT(*) as totale_viaggi FROM viaggio;
SELECT * FROM viaggio ORDER BY idv;