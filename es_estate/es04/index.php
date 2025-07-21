<?php

    $azienda = array(

        'Mastro Stega' => array(

            'capo_area_1' => array(
                'nome' => 'Mauro',
                'capo' => 'Mastro Stega',
                'sottoposti' => array(

                    'dipentente_01' => ['nome'=>'Franco', 'capo'=>'Mauro'],
                    'dipentente_02' => ['nome'=>'Anna', 'capo'=>'Mauro'],
                    'dipentente_03' => ['nome'=>'Michela', 'capo'=>'Mauro'],
                )
            ),

            'capo_area_2' => array(
                'nome' => 'Sandra',
                'capo' => 'Mastro Stega',
                'sottoposti' => array(

                    'dipentente_04' => ['nome'=>'Giuseppe', 'capo'=>'Sandra'],
                    'dipentente_05' => ['nome'=>'Maria', 'capo'=>'Sandra'],
                    'dipentente_06' => ['nome'=>'Alberto', 'capo'=>'Sandra'],
                )
            ),                              
        )
    );

    ####### MAIN PROGRAM #########

    function capo($nome_cercato, $array_azienda) {

        if ($nome_cercato == 'Mastro Stega') {
            return 'Nessuno';
        }
        else {
            foreach($array_azienda as $k => $value) {
                foreach($value as $k2 => $v2) {
                    if($v2['nome'] == $nome_cercato) {
                        return 'Mastro Stega';
                    }
                    else {
                        foreach($v2['sottoposti'] as $k3 => $v3) {
                            if ($v3['nome'] == $nome_cercato) {
                                return $v3['capo'];
                            }
                        }
                    }
                }
            }
        }
    }

    # CALCOLO FUNZIONE
    if(isset($_POST['nome_cercato']) && !empty($_POST['nome_cercato'])) {
        
        $capo_associato = capo($_POST['nome_cercato'], $azienda);
    }
    else {
        $capo_associato = '';
    }

    # CREAZIONE SELECT
    $select = '';
    foreach($azienda as $k => $value) {
        
        $select .= "<option value=\"" .$k . "\">" . $k . "</option>"; //aggiungta Mastro Stega
        foreach($value as $k2 => $v2) {
            
            $select .= "<option value=\"" . $v2['nome'] . "\">" . $v2['nome'] . "</option>"; // aggiunta Mauro e Sandra
            foreach($v2['sottoposti'] as $k3 => $v3) {
                
                $select .= "<option value=\"" . $v3['nome'] . "\">" . $v3['nome'] . "</option>"; // aggiunta di: Franco, Anna, Michela, Giuseppe, Maria, Alberto
            }
        }
    }
    

    # RENDER PAGINA
    $render = file_get_contents('main.html');
    $render = str_replace('{{select}}', $select, $render);
    $render = str_replace('{{nome_capo}}', $capo_associato, $render);
    echo $render;