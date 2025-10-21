CREATE DATABASE php_lez18;
USE php_lez18;

CREATE TABLE notizie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(100) NOT NULL,
    testo VARCHAR(255) NOT NULL
);

INSERT INTO notizie (titolo, testo) VALUES
('Nuova scoperta scientifica', 'Trovato un nuovo pianeta simile alla Terra'),
('Meteo favorevole', 'Sole e temperature miti per tutto il weekend'),
('Vittoria sportiva', 'La squadra locale vince il campionato'),
('Apertura nuovo museo', 'Inaugurato il museo di arte moderna in centro'),
('Record di visitatori', 'Il parco nazionale registra cifre record');