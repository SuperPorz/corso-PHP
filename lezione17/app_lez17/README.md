COME UTILIZZARE L'APP:

1 - download repository da github
2 - dopo estrazione, entrare nella cartella e digitare su terminale: 'composer install'
3 - dopo install da composer, rinominare .env.example in '.env';
4 - modificare i campi desiderati in .env, ad esempio quelli relativi al DB
5 - creare DB su phpmyadmin oppure su MySQL Workbench (o su altri DBMS), sempre che il progetto non sia su sqlite
6 - da terminale attivo nella cartella: 'php artisan migrate'
7 - da terminale attivo nella cartella: 'php artisan key:generate'
8 - da terminale attivo nella cartella: 'php artisan storage:link'
9 - (opzionale): se non si ha xampp: 'php artisan serve' -> dopo si può andare su 127.0.0.1:8000 per etstare l'app