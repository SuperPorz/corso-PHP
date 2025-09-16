########################################### DATABASE
CREATE DATABASE estate_es16;
USE estate_es16;
SET SQL_SAFE_UPDATES = 0;

# CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY 'admin';
# GRANT ALL PRIVILEGES ON `database`.* TO 'userphp'@'localhost';
# FLUSH PRIVILEGES;


########################################### TABELLE
-- Creazione tabella articolo da zero con tutti i vincoli
CREATE TABLE articolo (
    ida INT PRIMARY KEY AUTO_INCREMENT,
    autore VARCHAR(100) NOT NULL,
    titolo VARCHAR(100) NOT NULL,
    argomento ENUM(
		'INTELLIGENZA ARTIFICIALE', 
		'SOSTENIBILITÀ DIGITALE', 
		'CYBERSICUREZZA', 
		'IOT', 
		'QUANTUM COMPUTING', 
		'BIOTECNOLOGIE DIGITALI', 
		'SISTEMI OPERATIVI', 
		'BIG DATA'
	) NOT NULL,
    testo TEXT NOT NULL,
    lunghezza INT GENERATED ALWAYS AS (LENGTH(testo)) STORED,
    CONSTRAINT chk_testo_lunghezza CHECK (LENGTH(testo) >= 200 AND LENGTH(testo) <= 500)
);


########################################### POPOLAMENTO DATABASE

DELIMITER //

CREATE PROCEDURE PopulaArticoli()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE random_autore VARCHAR(100);
    DECLARE random_titolo VARCHAR(100);
    DECLARE random_argomento VARCHAR(50);
    DECLARE random_testo TEXT;
    DECLARE arg_index INT;
    DECLARE autore_index INT;
    
    WHILE i <= 100 DO
        -- Seleziona autore casuale
        SET autore_index = FLOOR(1 + RAND() * 20);
        SET random_autore = CASE autore_index
            WHEN 1 THEN 'Marco Rossi'
            WHEN 2 THEN 'Anna Bianchi'
            WHEN 3 THEN 'Giuseppe Verdi'
            WHEN 4 THEN 'Elena Ferrari'
            WHEN 5 THEN 'Luca Neri'
            WHEN 6 THEN 'Sofia Romano'
            WHEN 7 THEN 'Andrea Costa'
            WHEN 8 THEN 'Giulia Ricci'
            WHEN 9 THEN 'Francesco Leone'
            WHEN 10 THEN 'Chiara Bruno'
            WHEN 11 THEN 'Alessandro Galli'
            WHEN 12 THEN 'Valentina Russo'
            WHEN 13 THEN 'Matteo Conti'
            WHEN 14 THEN 'Federica Marino'
            WHEN 15 THEN 'Davide Greco'
            WHEN 16 THEN 'Silvia Fontana'
            WHEN 17 THEN 'Roberto Caruso'
            WHEN 18 THEN 'Martina Villa'
            WHEN 19 THEN 'Simone Lombardi'
            ELSE 'Francesca Rizzo'
        END;
        
        -- Seleziona argomento casuale
        SET arg_index = FLOOR(1 + RAND() * 8);
        SET random_argomento = CASE arg_index
            WHEN 1 THEN 'INTELLIGENZA ARTIFICIALE'
            WHEN 2 THEN 'SOSTENIBILITÀ DIGITALE'
            WHEN 3 THEN 'CYBERSICUREZZA'
            WHEN 4 THEN 'IOT'
            WHEN 5 THEN 'QUANTUM COMPUTING'
            WHEN 6 THEN 'BIOTECNOLOGIE DIGITALI'
            WHEN 7 THEN 'SISTEMI OPERATIVI'
            ELSE 'BIG DATA'
        END;
        
        -- Genera titolo e testo basati sull'argomento
        IF random_argomento = 'INTELLIGENZA ARTIFICIALE' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Machine Learning e il Futuro dell Automazione'
                WHEN 2 THEN 'Reti Neurali Artificiali: Principi Base'
                WHEN 3 THEN 'L Impatto dell AI sulla Società Moderna'
                WHEN 4 THEN 'Algoritmi di Deep Learning Spiegati'
                ELSE 'ChatGPT e i Large Language Models'
            END;
            SET random_testo = 'L intelligenza artificiale rappresenta una delle rivoluzioni tecnologiche più significative del nostro tempo. I sistemi di machine learning stanno trasformando settori dalla medicina alla finanza. Gli algoritmi di deep learning sono capaci di apprendere pattern complessi e prendere decisioni autonome. Tuttavia questa evoluzione porta sfide etiche importanti.';
            
        ELSEIF random_argomento = 'SOSTENIBILITÀ DIGITALE' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Green Computing: Ridurre l Impatto Ambientale'
                WHEN 2 THEN 'Data Center Sostenibili e Energia Rinnovabile'
                WHEN 3 THEN 'Economia Circolare nel Settore Tech'
                WHEN 4 THEN 'Cloud Computing Verde: Strategie e Benefici'
                ELSE 'E-waste: Gestione Responsabile dei Rifiuti'
            END;
            SET random_testo = 'La sostenibilità digitale è diventata una priorità per le aziende tecnologiche globali. Il consumo energetico dei data center rappresenta una percentuale significativa del fabbisogno mondiale. Le organizzazioni investono in fonti rinnovabili e tecnologie efficienti. Il green computing include anche software ottimizzato che richiede meno risorse computazionali.';
            
        ELSEIF random_argomento = 'CYBERSICUREZZA' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Protezione da Ransomware: Strategie Difensive'
                WHEN 2 THEN 'Zero Trust Architecture: Il Futuro della Sicurezza'
                WHEN 3 THEN 'Phishing e Social Engineering: Come Riconoscerli'
                WHEN 4 THEN 'Crittografia Quantistica e Sicurezza dei Dati'
                ELSE 'Incident Response: Gestire le Violazioni'
            END;
            SET random_testo = 'La cybersicurezza è una componente critica per le organizzazioni moderne. Gli attacchi informatici sono sempre più sofisticati richiedendo approcci difensivi proattivi. La filosofia Zero Trust assume che nessun utente sia intrinsecamente fidato. La formazione del personale rimane fondamentale poiché molte violazioni hanno origine da errori umani.';
            
        ELSEIF random_argomento = 'IOT' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Smart Home: Automazione Domestica Intelligente'
                WHEN 2 THEN 'Industrial IoT: Industria 4.0 in Azione'
                WHEN 3 THEN 'Sensori IoT e Big Data Analytics'
                WHEN 4 THEN 'Edge Computing nell Internet delle Cose'
                ELSE 'Protocolli di Comunicazione per Dispositivi IoT'
            END;
            SET random_testo = 'L Internet delle Cose rivoluziona l interazione con il mondo fisico attraverso la tecnologia. Miliardi di dispositivi connessi raccolgono dati in tempo reale creando ecosistemi intelligenti. I sensori IoT permettono monitoraggio continuo di parametri ambientali abilitando decisioni basate sui dati. Tuttavia presenta sfide di sicurezza e privacy significative.';
            
        ELSEIF random_argomento = 'QUANTUM COMPUTING' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Principi Base del Calcolo Quantistico'
                WHEN 2 THEN 'Algoritmi Quantistici vs Algoritmi Classici'
                WHEN 3 THEN 'Quantum Supremacy: Stato dell Arte'
                WHEN 4 THEN 'Applicazioni del Quantum Computing nella Ricerca'
                ELSE 'Quantum Error Correction: Sfide e Soluzioni'
            END;
            SET random_testo = 'Il calcolo quantistico rappresenta un paradigma computazionale che sfrutta principi della meccanica quantistica. I qubit possono esistere in stati di sovrapposizione permettendo di esplorare multiple soluzioni simultaneamente. Algoritmi come Shor e Grover promettono velocità esponenzialmente superiori. Tuttavia i sistemi attuali sono fragili e richiedono ambienti criogenici.';
            
        ELSEIF random_argomento = 'BIOTECNOLOGIE DIGITALI' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Bioinformatica: Analisi Genomica Computazionale'
                WHEN 2 THEN 'Digital Health: Telemedicina e Wearables'
                WHEN 3 THEN 'CRISPR e Editing Genomico Assistito da AI'
                WHEN 4 THEN 'Simulazioni Molecolari per Drug Discovery'
                ELSE 'Bioprinting 3D: Il Futuro della Medicina'
            END;
            SET random_testo = 'Le biotecnologie digitali trasformano il settore sanitario integrando strumenti computazionali con scienze biologiche. L analisi di dataset genomici con machine learning accelera la ricerca medica personalizzata. I dispositivi wearable permettono monitoraggio continuo dei parametri vitali. La simulazione computazionale rivoluziona lo sviluppo farmaci riducendo tempi e costi.';
            
        ELSEIF random_argomento = 'SISTEMI OPERATIVI' THEN
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Architettura del Kernel: Monolitico vs Microkernel'
                WHEN 2 THEN 'Gestione della Memoria nei SO Moderni'
                WHEN 3 THEN 'Scheduling dei Processi: Algoritmi e Performance'
                WHEN 4 THEN 'File System Distribuiti e Cloud Storage'
                ELSE 'Containerizzazione: Docker e Kubernetes'
            END;
            SET random_testo = 'I sistemi operativi moderni gestiscono complessità crescenti legate a virtualizzazione e containerizzazione. L architettura del kernel determina performance, sicurezza e stabilità del sistema. La gestione efficiente della memoria e lo scheduling sono cruciali per responsività in ambienti multi-core. L evoluzione cloud ha introdotto paradigmi come container e orchestrazione.';
            
        ELSE -- big data
            SET random_titolo = CASE FLOOR(1 + RAND() * 5)
                WHEN 1 THEN 'Apache Spark: Processing Distribuito su Larga Scala'
                WHEN 2 THEN 'Data Mining e Pattern Recognition'
                WHEN 3 THEN 'NoSQL vs SQL: Scegliere il Database Giusto'
                WHEN 4 THEN 'Stream Processing in Tempo Reale'
                ELSE 'Data Visualization: Trasformare Dati in Insights'
            END;
            SET random_testo = 'I Big Data rappresentano un trend significativo nell era digitale caratterizzato dalle cinque V: Volume, Velocity, Variety, Veracity e Value. La capacità di processare dataset massivi in tempo reale è un vantaggio competitivo cruciale. Tecnologie come Hadoop e Spark gestiscono petabyte di dati. Il machine learning applicai abilita scoperte di pattern nascosti e predizioni accurate.';
        END IF;
        
        -- Inserisce il record
        INSERT INTO articolo (autore, titolo, argomento, testo) 
        VALUES (random_autore, random_titolo, random_argomento, random_testo);
        
        SET i = i + 1;
    END WHILE;
    
    SELECT CONCAT('Inseriti ', i-1, ' articoli con successo!') AS Risultato;
END //

DELIMITER ;

-- Esegui la stored procedure
CALL PopulaArticoli();

-- OPZIONALE: Verifica i risultati
SELECT argomento, COUNT(*) as numero_articoli FROM articolo GROUP BY argomento;
SELECT MIN(lunghezza), MAX(lunghezza), AVG(lunghezza) FROM articolo;

########################################### TEST QUERY
SELECT *
FROM articolo;

