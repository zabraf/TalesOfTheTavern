<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : connexionBD.php
 */
/* fonction pour connecter la base de donnéés */
require_once("../Modele/constanteBD.php");

function RecupererConnexion() {
    static $dbc = null;

    if ($dbc == null) {
        try {
            $dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_PERSISTENT => true));
        }
        catch (Exception $e) {
            die('impossible de se connecter a la base de donnée');
        }
    }
    return $dbc;
}
