<?php

class ControllerArticoli {

    private $tab_articolo;

    public function __construct(DatabaseTable $tab_articolo)
    {
        $this->tab_articolo = $tab_articolo;
    }

    # GESTIONE AZIONI ARTICOLI
    public function gestione_azioni_articoli() {
        // Inserimento articolo
        if (isset($_POST['azione']) && $_POST['azione'] == 'registra') {
            $this->registra_articolo(
                $_POST['autore'],
                $_POST['titolo'],
                $_POST['argomento'],
                $_POST['testo'],
                $_POST['lunghezza']
            );
            $this->redirectToIndex();
        }

        // Modifica articolo
        if (isset($_GET['azione']) && $_GET['azione'] == 'modifica' && isset($_GET['ida'])) {
            $data = [
                'ida' => $_GET['ida'],
                'autore' => $_POST['autore'],
                'titolo' => $_POST['titolo'],
                'argomento' => $_POST['argomento'],
                'testo' => $_POST['testo'],
                'lunghezza' => $_POST['lunghezza']
            ];
            $this->modifica_articolo($data);
            $this->redirectToIndex();
        }

        // Eliminazione articolo
        if (isset($_GET['azione']) && $_GET['azione'] == 'elimina_articolo' && isset($_GET['ida'])) {
            $this->elimina_articolo($_GET['ida']);
            $this->redirectToIndex();
        }
    }

    # OPERAZIONI CRUD
    public function registra_articolo($autore, $titolo, $argomento, $testo, $lunghezza)
    {
        $array = [
            'autore' => $autore,
            'titolo' => $titolo,
            'argomento' => $argomento,
            'testo' => $testo,
            'lunghezza' => intval($lunghezza)
        ];
        
        return $this->tab_articolo->save($array);
    }

    public function modifica_articolo($array) {
        return $this->tab_articolo->save($array);
    }

    public function elimina_articolo($id) {
        return $this->tab_articolo->delete($id);
    }

    public function trova_articolo($id) {
        return $this->tab_articolo->find_by_id($id);
    }

    public function lista_tutti_articoli() {
        return $this->tab_articolo->find_all();
    }

    # REDIRECT
    private function redirectToIndex() {
        header('Location: index.php');
        exit;
    }
}

class ControllerRiviste {

    private $obj_riviste;

    public function __construct(ComponiRivista $obj_riviste)
    {
        $this->obj_riviste = $obj_riviste;
    }

    # GESTIONE AZIONI RIVISTE
    public function gestione_azioni_riviste() {
        // Generazione nuove riviste
        if (isset($_POST['numeri']) && is_numeric($_POST['numeri'])) {
            return $this->genera_riviste(intval($_POST['numeri']));
        }

        // Eliminazione pianificazione
        if (isset($_GET['azione']) && $_GET['azione'] == 'elimina_pianificazione') {
            $this->elimina_pianificazione();
            $this->redirectToIndex();
        }

        // Caricamento riviste esistenti
        return $this->carica_riviste_esistenti();
    }

    # OPERAZIONI RIVISTE - CON LIMITE PER EVITARE TIMEOUT
    public function genera_riviste($num_riviste) {        
        $array_riviste = $this->obj_riviste->componi_riviste($num_riviste);
        $this->obj_riviste->scrittura($array_riviste);
        return $array_riviste;
    }

    public function carica_riviste_esistenti() {
        return $this->obj_riviste->lettura();
    }

    public function elimina_pianificazione() {
        return $this->obj_riviste->elimina_temp_db();
    }

    # REDIRECT
    private function redirectToIndex() {
        header('Location: index.php');
        exit;
    }
}

class ControllerTemplate {

    private $twig;
    private $array_riviste;

    public function __construct($twig, $array_riviste) {
        $this->twig = $twig;
        $this->array_riviste = $array_riviste;
    }

    # RENDERING TEMPLATE
    public function render() {
        $page = $_REQUEST['p'] ?? 'index';
        $numero_rivista = isset($_REQUEST['rivista']) ? intval($_REQUEST['rivista']) : null;
        
        $template_data = $this->prepare_template_data();
        
        if ($page == 'index' || empty($page)) {
            $template = $this->twig->load('index.twig');
        } else {
            $template = $this->twig->load('magazine.twig');
            
            // Se è specificato un numero rivista, converti in indice array (numero - 1)
            if ($numero_rivista !== null && $numero_rivista >= 1) {
                $indice_array = $numero_rivista - 1; // Converte 1,2,3... in 0,1,2...
                
                if (isset($this->array_riviste[$indice_array])) {
                    $template_data['pagine'] = $this->array_riviste[$indice_array];
                    $template_data['numero_rivista'] = $numero_rivista;
                    $template_data['rivista_corrente'] = $indice_array;
                } else {
                    // Se il numero non esiste, mostra la prima rivista
                    if (!empty($this->array_riviste)) {
                        $template_data['pagine'] = $this->array_riviste[0];
                        $template_data['numero_rivista'] = 1;
                        $template_data['rivista_corrente'] = 0;
                    }
                }
            } else {
                // Se non è specificato un numero, mostra la prima rivista disponibile
                if (!empty($this->array_riviste)) {
                    $template_data['pagine'] = $this->array_riviste[0];
                    $template_data['numero_rivista'] = 1;
                    $template_data['rivista_corrente'] = 0;
                }
            }
        }

        return $template->render($template_data);
    }

    # PREPARAZIONE DATI TEMPLATE
    private function prepare_template_data() {
        return [
            'riviste' => $this->array_riviste,
            'pagine' => $this->array_riviste,
            'total_riviste' => count($this->array_riviste),
            'has_riviste' => count($this->array_riviste) > 0
        ];
    }
}