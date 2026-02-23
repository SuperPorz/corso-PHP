//////////////////////
TESTO ESERCITAZIONE:

ristorante -> elenco piatti

piatto -> primo/secondo/dolce -> ingredienti

menu -> cambia ogni mese -> quindi ogni mese cambia primo/secondo/dolce

prenotazioni -> da questa lista estraiamo la quantità (data + numero di persone)

da piatto + prenotazioni -> lista della spesa giornaliera a richiesta

/////////////////
PUNTI SALIENTI INSTALLAZIONE:
1) git clone della repository
2) cd verifica-finale-php
3) creare database locale eseguendo le prime 2 istruzioni dal file popolamento_db.sql
4) se composer non è installato sul pc, installarlo
5) tornando al terminale avviato dalla cartella del progetto, eseguire "composer update"
6) rinominare il file .env.example in ".env"
7) editare .env con i dati di connessione locali (admin+psw)
8) editare .env: cambiare "SESSION_DRIVER=database" in "SESSION_DRIVER=file"
9) eseguire "php artisan key:generate"
10) eseguire "php artisan migrate:fresh"
11) avviare popolamento database con lo script (tutte le istruzioni escluse le prime due, gia eseguite al punto 3)
12) lanciare app eseguendo il comando "php artisan serve"
13) sul browser, accedere a "http://127.0.0.1:8000"


//////////////////
link pubblico prompt CLAUDE usato per velocizzare alcune parti:
https://claude.ai/share/dc1af6bd-8c35-4f5b-9c7f-0436dc5bb991