<?php

    ####### ORGANIGRAMMA AZIENDALE #########
    $lorenzoni_SPA = array(

        'titolare' => array(

            'nome' => 'Mastro Lorenzoni',
            'capo' => 'Shareholder Mastro Stega',
            'sottoposti' => array(

                'manager' => array(

                    'nome' => 'Capitano Andrea',
                    'capo' => 'Mastro Lorenzoni',
                    'sottoposti' => array(

                        'capo_area_1' => array(

                            'nome' => 'Mauro',
                            'capo' => 'Capitano Andrea',
                            'sottoposti' => array(

                                'capo_ufficio_1' => array(

                                    'nome' => 'Franco',
                                    'capo' => 'Mauro',
                                    'sottoposti' => array(

                                        'dipentente_02' => ['nome'=>'Anna', 'capo'=>'Franco'],
                                        'dipentente_03' => ['nome'=>'Michela', 'capo'=>'Franco']
                                    )
                                )
                            )
                        ),
                        'capo_area_2' => array(

                            'nome' => 'Sandra',
                            'capo' => 'Capitano Andrea',
                            'sottoposti' => array(

                                'capo_ufficio_2' => array(

                                    'nome' => 'Giuseppe',
                                    'capo' => 'Sandra',
                                    'sottoposti' => array(

                                        'dipentente_02' => ['nome'=>'Maria', 'capo'=>'Giuseppe'],
                                        'dipentente_03' => ['nome'=>'Alberto', 'capo'=>'Giuseppe']
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    );


    ####### MAIN PROGRAM #########
    function capo_foglia_radice($nome_cercato, $array_azienda) {

        foreach($array_azienda as $k1 => $v1) { // 1° liv: array -> azienda; k1: 'titolare', v1: dati del titolare -> array(nome/capo/sottoposti)
            foreach($v1['sottoposti'] as $k2 => $v2) { // 2° liv: array -> v1[sottoposti]; k2: 'manager', v2: array(nome/capo/sottoposti)
                foreach($v2['sottoposti'] as $k3 => $v3) { // 3° liv: array -> v2[sottoposti]; k3: 'capo_area_1, capo_area_2', v3: array(nome/capo/sottoposti) (2 array totali)
                    foreach($v3['sottoposti'] as $k4 => $v4) { // 4° liv: array -> v3[sottoposti]; k4: 'capo_ufficio_1', v4: array(nome/capo/sottoposti)
                        foreach($v4['sottoposti'] as $k5 => $v5) { // 5° liv: array -> v4[sottoposti]; k5: 'dipendente_01, dipendente_02', v5: array(nome/capo) SIAMO ARRIVATI AI DIPENDENTI
                            
                            if ($v5['nome'] == $nome_cercato) {
                                return $v5['capo'];
                            }
                            else { continue;}
                        }
                        if ($v4['nome'] == $nome_cercato) {
                                return $v4['capo'];
                            }
                            else { continue;} 
                    }
                    if ($v3['nome'] == $nome_cercato) {
                                return $v3['capo'];
                            }
                            else { continue;} 
                }
                if ($v2['nome'] == $nome_cercato) {
                                return $v2['capo'];
                            }
                            else { continue;} 
            }
            if ($v1['nome'] == $nome_cercato) {
                                return $v1['capo'];
                            }
                            else { continue;} 
        }
    }


    # CALCOLO FUNZIONE
    if(isset($_POST['nome_cercato']) && !empty($_POST['nome_cercato'])) {
        
        $capo_del_dipendente = capo_foglia_radice($_POST['nome_cercato'], $lorenzoni_SPA);
    }
    else {
        $capo_del_dipendente = '';
    }


    # CREAZIONE SELECT
    $select = "<option value=\"vuoto\">SCEGLI NOME</option>"; //aggiunta Mastro Lorenzoni;
    foreach($lorenzoni_SPA as $k1 => $v1) {
        $select .= "<option value=\"" .$v1['nome'] . "\">" . $v1['nome'] . "</option>"; //aggiunta Mastro Lorenzoni
        
        foreach($v1['sottoposti'] as $k2 => $v2) {
            $select .= "<option value=\"" . $v2['nome'] . "\">" . $v2['nome'] . "</option>"; // aggiunta Capitano Andrea
            
            foreach($v2['sottoposti'] as $k3 => $v3) {
                $select .= "<option value=\"" . $v3['nome'] . "\">" . $v3['nome'] . "</option>"; // aggiunta di Mauro e Sandra
                
                foreach($v3['sottoposti'] as $k4 => $v4) {
                    $select .= "<option value=\"" . $v4['nome'] . "\">" . $v4['nome'] . "</option>"; // aggiunta di Franco e Giuseppe

                    foreach($v4['sottoposti'] as $k5 => $v5) {
                        $select .= "<option value=\"" . $v5['nome'] . "\">" . $v5['nome'] . "</option>"; // aggiunta di: Anna, Michela, Maria, Alberto
                    }
                }
            }
        }
    }
    

    # RENDER PAGINA
    $render = file_get_contents('main.html');
    $render = str_replace('{{select}}', $select, $render);
    $render = str_replace('{{nome_capo}}', $capo_associato, $render);
    echo $render;