<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 05.04.19
 *  Version : 1.0
 *  Fichier : supprimer,inc.php
 */
$idHistoire = isset($_GET["id"]) ? trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT)): "";
$histoire = RetournerHistoireParId($idHistoire);
if ($histoire === null || strtolower($histoire["email"]) != strtolower($_SESSION["utilisateur"]))
{
    header("Location: compte.php");
    exit();
}
if(isset($_POST["supprimer"]))
{
    SuppprimerHisoireParId($idHistoire);
    header("Location: compte.php");
    exit();
}