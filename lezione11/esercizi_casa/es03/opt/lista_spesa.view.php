<?php

    # COSTRUZIONE TABELLA

        if (isset($_POST['idp']) && !empty($_POST['idp'])) {

            #creazione righe della TABELLA
            $righe_tabella = '';
            foreach(Lista_spesa\menu_scelto($_POST['idp']) as $k => $value) {
                foreach($value as $k2 => $v2) {
                    if ($k2 == 'nome_i') {
                        $righe_tabella .= '<li>' . $v2 . '</li>';
                    }
                }
            }
    
            #preparazione TABELLA per il render (aggiunta all'array pagine)
            $p['contenuto']['tabella'] = '<ul>' . $righe_tabella . '</ul>';
        }
    
    
    # COSTRUZIONE FORM/SELECT
        $form = file_get_contents('tpl/lista_spesa.form.html');
    
        #costruzione della select
        $options = '';
        foreach(Lista_spesa\piatti_associati() as $k => $v) {

            $options .= "<option value=\"" .$v['idp'] . "\">" . $v['nome_p'] . "</option>";
        }
        $form = str_replace('{{piatti_abbinati}}', $options, $form);
        
        #preparazione per il render finale
        $p['contenuto']['form'] = $form;