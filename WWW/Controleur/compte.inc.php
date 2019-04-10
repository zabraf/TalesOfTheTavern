<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 05.04.19
 *  Version : 1.0
 *  Fichier : compte.inc.php
 */
$nouveauNom = isset($_POST["nom"]) ? trim(filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING)): "";
$nouvelEmail = isset($_POST["email"]) ? trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL)): "";
$mdp = isset($_POST["motDePasse"]) ? trim(filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING)): "";
$nouveauMdp = isset($_POST["nouveauMotDePasse"]) ? trim(filter_input(INPUT_POST,'nouveauMotDePasse',FILTER_SANITIZE_STRING)): "";
$confMdp = isset($_POST["confirmerNouveauMotDePasse"]) ? trim(filter_input(INPUT_POST,'confirmerNouveauMotDePasse',FILTER_SANITIZE_STRING)): "";

if(isset($_POST["supprimer"]))
{

}
if($nouveauNom != "" && $nouvelEmail != "" && $mdp != "")
{
    if(strtolower($nouvelEmail) == strtolower($_SESSION["utilisateur"]) || !UtilisateurExiste($nouvelEmail))
    {
        $erreurMessage = ModifierUtilisateurParEmail($nouveauNom,$_SESSION["utilisateur"],$nouvelEmail,$mdp,$nouveauMdp,$confMdp);
        if($erreurMessage === true)
        {
            $_SESSION["utilisateur"] = $nouvelEmail;
            header("location: index.php");
            exit();
        }
        elseif ($erreurMessage !== false)
        {
            $_SESSION["utilisateur"] = $nouvelEmail;
            $erreurMessage = "le mot de passe n'a pas été modifier, car " . $erreurMessage;
        } else
        {
            $erreurMessage = "le mot de passe est faux";
        }
    }else
    {
        $erreurMessage = "cette e-mail existe déja";
    }
}
$utilisateur =  RetournerUtilisateur($_SESSION["utilisateur"]);
$nom = $utilisateur["nom"];
$email = $utilisateur["email"];

function afficherHitoires()
{
    $histoire = RetournerTouteHistoireCreerParUnUtilisateur($_SESSION["utilisateur"]);
    for($i = 0; $i < count($histoire); $i++)
    {
        if($histoire[$i]["urlImageHistoire"] == null)
        {
            $histoire[$i]["urlImageHistoire"] = $histoire[$i]["urlImageCategorie"];
        }
        echo AfficherHistoire($histoire["$i"]["idHistoire"],$histoire["$i"]["urlImageHistoire"],$histoire[$i]["titre"],$histoire[$i]["nom"],$histoire["$i"]["nomCategorie"],$histoire[$i]["histoire"],true);
    }
}