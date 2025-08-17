<?php
session_start();

/* 
Gestione assegnazione camere gita scolastica
- Array associativo per memorizzare studenti
- Preferenze per amicizie
- Nessuna camera mista
- Massimizzare studenti con amici
- Minimizzare camere singole
*/

class GestoreCamere {
    private $studenti = [];
    private $camere_uomini = [];
    private $camere_donne = [];
    private $camere_singole = [];
    private $lista_chiusa = false;
    
    public function __construct() {
        // Ripristina dati dalla sessione
        if (isset($_SESSION['studenti'])) {
            $this->studenti = $_SESSION['studenti'];
        }
        if (isset($_SESSION['lista_chiusa'])) {
            $this->lista_chiusa = $_SESSION['lista_chiusa'];
        }
    }
    
    public function aggiungiStudente($nome, $genere, $preferenze_str) {
        if ($this->lista_chiusa) {
            return false; // Non si possono aggiungere studenti dopo la chiusura
        }
        
        // Pulisci e prepara le preferenze
        $preferenze = array_map('trim', explode(',', $preferenze_str));
        $preferenze = array_filter($preferenze); // Rimuovi elementi vuoti
        
        // Controlla se lo studente esiste già
        foreach ($this->studenti as $studente) {
            if (strtolower($studente['nome']) === strtolower($nome)) {
                return false; // Studente già esistente
            }
        }
        
        $this->studenti[] = [
            'nome' => trim($nome),
            'genere' => $genere,
            'preferenze' => $preferenze
        ];
        
        // Salva nella sessione
        $_SESSION['studenti'] = $this->studenti;
        return true;
    }
    
    public function chiudiLista() {
        $this->lista_chiusa = true;
        $_SESSION['lista_chiusa'] = true;
        $this->assegnaCamere();
    }
    
    private function assegnaCamere() {
        $this->camere_uomini = [];
        $this->camere_donne = [];
        $this->camere_singole = [];
        
        // Separa studenti per genere
        $uomini = array_filter($this->studenti, fn($s) => $s['genere'] === 'U');
        $donne = array_filter($this->studenti, fn($s) => $s['genere'] === 'D');
        
        // Assegna camere per uomini e donne
        $this->camere_uomini = $this->assegnaCamerePerGenere($uomini, 'U');
        $this->camere_donne = $this->assegnaCamerePerGenere($donne, 'D');
    }
    
    private function assegnaCamerePerGenere($studenti, $genere) {
        $camere = [];
        $assegnati = [];
        $camera_counter = 1;
        
        // Prima passata: cerca di creare coppie con preferenze reciproche
        foreach ($studenti as $studente1) {
            if (in_array($studente1['nome'], $assegnati)) continue;
            
            $migliore_match = null;
            $max_preferenze_comuni = 0;
            
            foreach ($studenti as $studente2) {
                if ($studente1['nome'] === $studente2['nome'] || 
                    in_array($studente2['nome'], $assegnati)) continue;
                
                // Controlla preferenze reciproche o unidirezionali
                $preferenze_comuni = 0;
                if (in_array($studente2['nome'], $studente1['preferenze'])) {
                    $preferenze_comuni++;
                }
                if (in_array($studente1['nome'], $studente2['preferenze'])) {
                    $preferenze_comuni++;
                }
                
                if ($preferenze_comuni > $max_preferenze_comuni) {
                    $max_preferenze_comuni = $preferenze_comuni;
                    $migliore_match = $studente2;
                }
            }
            
            // Se trovato un match, crea la camera
            if ($migliore_match && $max_preferenze_comuni > 0) {
                $nome_camera = "Camera-{$genere}{$camera_counter}";
                $camere[$nome_camera] = [
                    $studente1['nome'], 
                    $migliore_match['nome']
                ];
                $assegnati[] = $studente1['nome'];
                $assegnati[] = $migliore_match['nome'];
                $camera_counter++;
            }
        }
        
        // Seconda passata: prova a completare camere esistenti o crea nuove coppie
        foreach ($studenti as $studente) {
            if (in_array($studente['nome'], $assegnati)) continue;
            
            $camera_trovata = false;
            
            // Cerca una camera esistente con spazio
            foreach ($camere as $nome_camera => &$occupanti) {
                if (count($occupanti) < 2) {
                    // Controlla se ha preferenze con gli occupanti
                    $ha_preferenze = false;
                    foreach ($occupanti as $occupante) {
                        if (in_array($occupante, $studente['preferenze'])) {
                            $ha_preferenze = true;
                            break;
                        }
                    }
                    
                    if ($ha_preferenze) {
                        $occupanti[] = $studente['nome'];
                        $assegnati[] = $studente['nome'];
                        $camera_trovata = true;
                        break;
                    }
                }
            }
            
            // Se non trovata, cerca un altro studente non assegnato per fare coppia
            if (!$camera_trovata) {
                foreach ($studenti as $altro_studente) {
                    if ($studente['nome'] === $altro_studente['nome'] || 
                        in_array($altro_studente['nome'], $assegnati)) continue;
                    
                    $nome_camera = "Camera-{$genere}{$camera_counter}";
                    $camere[$nome_camera] = [
                        $studente['nome'], 
                        $altro_studente['nome']
                    ];
                    $assegnati[] = $studente['nome'];
                    $assegnati[] = $altro_studente['nome'];
                    $camera_counter++;
                    $camera_trovata = true;
                    break;
                }
            }
            
            // Se ancora non assegnato, camera singola
            if (!$camera_trovata) {
                $nome_camera = "Singola-{$genere}{$camera_counter}";
                $this->camere_singole[$nome_camera] = [$studente['nome']];
                $assegnati[] = $studente['nome'];
                $camera_counter++;
            }
        }
        
        return $camere;
    }
    
    public function getStudenti() {
        return $this->studenti;
    }
    
    public function getCamereUomini() {
        return $this->camere_uomini;
    }
    
    public function getCamereDonne() {
        return $this->camere_donne;
    }
    
    public function getCamereSingole() {
        return $this->camere_singole;
    }
    
    public function isListaChiusa() {
        return $this->lista_chiusa;
    }
    
    public function reset() {
        $this->studenti = [];
        $this->camere_uomini = [];
        $this->camere_donne = [];
        $this->camere_singole = [];
        $this->lista_chiusa = false;
        session_destroy();
    }
}

// Inizializza il gestore
$gestore = new GestoreCamere();

// Gestione form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'], $_POST['genere'], $_POST['preferenze'])) {
        $successo = $gestore->aggiungiStudente(
            $_POST['nome'], 
            $_POST['genere'], 
            $_POST['preferenze']
        );
        
        if (!$successo) {
            $errore = $gestore->isListaChiusa() ? 
                "La lista è chiusa, non si possono aggiungere altri studenti." :
                "Studente già esistente.";
        }
    }
}

// Gestione chiusura lista
if (isset($_GET['lista_chiusa'])) {
    $gestore->chiudiLista();
    header('Location: index.php');
    exit;
}

// Gestione reset
if (isset($_GET['reset'])) {
    $gestore->reset();
    header('Location: index.php');
    exit;
}

// Funzioni di utilità per il rendering
function renderListaStudenti($studenti) {
    if (empty($studenti)) {
        return '<p>Nessuno studente registrato.</p>';
    }
    
    $html = '<ul>';
    foreach ($studenti as $studente) {
        $preferenze_str = implode(', ', $studente['preferenze']);
        $genere_str = $studente['genere'] === 'U' ? 'Uomo' : 'Donna';
        $html .= "<li><strong>{$studente['nome']}</strong> ({$genere_str}) - Preferenze: {$preferenze_str}</li>";
    }
    $html .= '</ul>';
    return $html;
}

function renderCamere($camere, $tipo = 'normali') {
    if (empty($camere)) {
        return '<p>Nessuna camera assegnata.</p>';
    }
    
    $html = '<ul>';
    foreach ($camere as $nome_camera => $occupanti) {
        $occupanti_str = implode(', ', $occupanti);
        $html .= "<li><strong>{$nome_camera}:</strong> {$occupanti_str}</li>";
    }
    $html .= '</ul>';
    return $html;
}

// Render del template
$template = file_get_contents('main.html');

$template = str_replace('{{lista_studenti}}', renderListaStudenti($gestore->getStudenti()), $template);
$template = str_replace('{{camere_uomini}}', renderCamere($gestore->getCamereUomini()), $template);
$template = str_replace('{{camere_donne}}', renderCamere($gestore->getCamereDonne()), $template);
$template = str_replace('{{camere_singole}}', renderCamere($gestore->getCamereSingole()), $template);

// Aggiungi messaggio di errore se presente
if (isset($errore)) {
    $template = str_replace('<h1>', "<div style='color: red; margin: 10px 0;'>{$errore}</div><h1>", $template);
}

// Aggiungi pulsante reset se la lista è chiusa
if ($gestore->isListaChiusa()) {
    $template = str_replace(
        '<a href="index.php?lista_chiusa">CHIUDI LA LISTA</a>', 
        '<p><em>Lista chiusa - Camere assegnate!</em></p><a href="index.php?reset" style="color: red;">RESET E RICOMINCIA</a>', 
        $template
    );
}

echo $template;
?>