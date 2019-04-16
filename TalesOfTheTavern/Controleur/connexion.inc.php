<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : connexion.inc.php
 */
$erreurMessage = "";
$email = isset($_POST["email"]) ? trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL)): "";
$mdp = isset($_POST["motDePasse"]) ? trim(filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING)): "";
if( $email != "" && $mdp != "") {
    if (UtilisateurExisteEtMotDePasseJuste($email, $mdp)) {
        //Mets l’email dans la session et le redirige à la page index.php
        $_SESSION["utilisateur"] = $email;
        header("Location: index.php");
        exit();
    } else {
        $erreurMessage = "Le mot de passe ou l'Email est faux";
    }
}