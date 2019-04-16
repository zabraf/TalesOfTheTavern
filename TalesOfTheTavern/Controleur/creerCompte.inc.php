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

    $erreurMessage = VerfieMotDePasse($mdp,$confMdp);
    if ($erreurMessage === true) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            if (!UtilisateurExiste($email)) {
                InsererUtilisateur($nom, $email, hash("sha256", $mdp));
                $_SESSION["utilisateur"] = $email;
                header("Location: index.php");
                exit();
            } else {
                $erreurMessage = "Cette adresse e-mail est déjà utilisée.";
            }
        }
        else {
            $erreurMessage = "$email n'est pas une adresse email valide";
        }
    }
}