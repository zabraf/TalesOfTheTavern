<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : deconnecter.php
 */
session_start();
if(isset($_SESSION["utilisateur"]))
{
    session_destroy();
}
header("Location: index.php");
exit();