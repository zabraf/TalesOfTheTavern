<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : creerCompte.inc.php
 */
$erreurMessage = "";
// Récupere les valeurs en POST et filtre les inputs
$nom = isset($_POST["nom"]) ? trim(filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING)): "";
$email = isset($_POST["email"]) ? trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL)): "";
$mdp = isset($_POST["motDePasse"]) ? trim(filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING)): "";
$confMdp = isset($_POST["confirmerMotDePasse"]) ? trim(filter_input(INPUT_POST,'confirmerMotDePasse',FILTER_SANITIZE_STRING)): "";

if($nom != "" && $email != "" && $mdp != "" && $confMdp != "")
{
    // Vérifie que le l'utilisateur peux bien ètre creer
    $erreurMessage = InsererUtilisateur($nom,$email,$mdp,$confMdp);
    if($erreurMessage === true)
    {
        //Créer l'utilisateur, met son E-mail dans la session et le redirigé vers la page principale
        $_SESSION["utilisateur"] = $email;
        header("Location: index.php");
        exit();
    }
}