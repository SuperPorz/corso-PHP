<?php

use Model\VenditeModel;

class VenditeController {

    private static $tab_vendite;

    public static function init(VenditeModel $tab_vendite) {
        self::$tab_vendite = $tab_vendite;
    }

    public static function elenco_vendite() {
        return self::$tab_vendite->find_all();
    }

    public static function cerca_vendita($id) {
        return self::$tab_vendite->find_by_id($id);
    }

    public static function inserisci_vendita($array) {
        try {
            self::$tab_vendite->save($array);
            echo 'Inserimento avvenuto!';
            return true;
        } 
        catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage() . ' in '
                . $e->getFile() . ':' . $e->getLine();
            echo $output;
        }
    }

    public static function modifica_vendita($array) {
        try {
            self::$tab_vendite->save($array);
            echo 'Modifica avvenuta!';
            return true;
        } 
        catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage() . ' in '
                . $e->getFile() . ':' . $e->getLine();
            echo $output;
        }
    }

    public static function elimina_vendita($idv) {
        try {
            self::$tab_vendite->delete($idv);
            echo 'Eliminazione eseguita!';
            return true;
        } 
        catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage() . ' in '
                . $e->getFile() . ':' . $e->getLine();
            echo $output;
        }
    }
}