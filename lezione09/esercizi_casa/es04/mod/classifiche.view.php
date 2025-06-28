<?php

    # CALCOLO CLASSIFICHE (sorting degli arrays)

    #lettura dai database
    $elenco_piloti = Piloti\lista();
    $elenco_teams = Team\lista();

    #calcolo con funzioni SORTING
    $elenco_piloti = Classifiche\sorting($elenco_piloti);
    $elenco_teams = Classifiche\sorting($elenco_teams);    

    # COSTRUZIONE TABELLE  
    $p['contenuto']['table1'] = Render\build_tab($elenco_piloti, ''); // tabella piloti
    $p['contenuto']['table2'] = Render\build_tab($elenco_teams, ''); // tabella teams