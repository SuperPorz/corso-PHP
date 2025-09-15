<?php

    /**
     * libreria per la gestione delle persone
     * =================================
     * 
     * 
     */

    // namespace
    namespace Persone;

    /**
     * aggiunta di una persona alla lista
     * ------------------------------
     * 
     * 
     */
    function aggiungi($nome, $numero) {

        if( ! empty($nome) && ! empty($numero) ) {
            $nome = trim($nome);
            $numero = intval($numero);
            $sql = "INSERT INTO persone (nome, numero) VALUES ( ?, ? )";
            $stmt = mysqli_prepare( \DB\getConnection(), $sql );
            mysqli_stmt_bind_param( $stmt, 'si', $nome, $numero );
            return mysqli_stmt_execute( $stmt );
        } else {
            return false;
        }

    }

    /**
     * eliminazione di una persona dalla lista
     * -----------------------------------
     * 
     * 
     */
    function elimina($id) {
        if( ! empty($id) && is_numeric($id) ) {
            $id = intval($id);
            $sql = "DELETE FROM persone WHERE id = ?";
            $stmt = mysqli_prepare( \DB\getConnection(), $sql );
            mysqli_stmt_bind_param( $stmt, 'i', $id );
            return mysqli_stmt_execute( $stmt );
        } else {
            return false;
        }
    }

    /**
     * elenco persone presenti nel database
     * -------------------------------------
     * 
     * 
     */
    function lista() {
        $sql = "SELECT * FROM persone";
        $result = mysqli_query( \DB\getConnection(), $sql );
        $lista = [];
        while( $row = mysqli_fetch_assoc($result) ) {
            $lista[] = $row;
        }
        return $lista;
    }

    /**
     * restituzione dei dettagli di una persona
     * ------------------------------------
     * 
     * 
     */
    function dettagli($id) {
        if( ! empty($id) && is_numeric($id) ) {
            $id = intval($id);
            $sql = "SELECT * FROM persone WHERE id = ?";
            $stmt = mysqli_prepare( \DB\getConnection(), $sql );
            mysqli_stmt_bind_param( $stmt, 'i', $id );
            mysqli_stmt_execute( $stmt );
            $result = mysqli_stmt_get_result( $stmt );
            return mysqli_fetch_assoc( $result );
        } else {
            return false;
        }
    }

    /**
     * modifica di una persona
     * -------------------
     * 
     * 
     */
    function modifica($id, $nome, $numero) {
        if( ! empty($id) && is_numeric($id) && ! empty($nome) && ! empty($numero) ) {
            $id = intval($id);
            $nome = trim($nome);
            $numero = intval($numero);
            $sql = "UPDATE persone SET nome = ?, numero = ? WHERE id = ?";
            $stmt = mysqli_prepare( \DB\getConnection(), $sql );
            mysqli_stmt_bind_param( $stmt, 'sii', $nome, $numero, $id );
            return mysqli_stmt_execute( $stmt );
        } else {
            return false;
        }
    }
