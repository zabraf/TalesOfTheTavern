<?php
/* fonction pour connecter la base de donnéés */
require_once("../Model/constanteDB.php");

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
