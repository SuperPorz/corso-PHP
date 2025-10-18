TESTO DELL'ESERCIZIO:

* Realizzare un'applicazione di una pagina che gestisce un elenco di vendite (agente, data, importo)
  con possibilità di inserimento, modifica e cancellazione; FATTO
* Realizzare il relativo database; FATTO
* Realizzare uno script python che scorra le righe delle vendite nel database e calcoli la provvigione del 10% dove manca, inserendola poi nella colonna provvigione; FATTO
* In javascript realizzare un sistema che aggiorni la pagina php ogni 60 secondi in modo da mostrare le provvigioni aggiunte da python



STRUTTURA DEL PROGETTO (componenti principali):
Fullstack
├── public/
│   ├── index.php
|   ├── js/
│   ├── css/
│   └── tpl/
|  
├── res/
│   └── inc/
|
├── api/
│   ├── python/
│   │   ├── provvigioni.py
│   │   ├── requirements.txt
│   │   └── venv/
│   └── php/
│       └── api\_proxy.php  ← Proxy PHP per chiamare Python
|
├── venv/
├── sql/
├── composer.json
├── requirements.txt



INSTALLAZIONE:
1: in una cartella di lavoro, da prompt comandi, digitare "git clone ...";
2: spostarsi nella directory dal prompt;

3: nel prompt, effetturare un "composer update"
4: configurare ambiente python: "py -m venv venv" (oppure usare 'python' al posto di 'py)
5: attivare il virtual env: "venv\\Scripts\\activate"
6: installare dipendenze: "pip install -r requirements.txt"
7: attivare l'app per l'API di python: "py api/python/provvigioni.py"
8: su browser, portarsi su "http://localhost/corso-PHP/lez\_recupero\_03/public/"

