<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 05.04.19
 *  Version : 1.0
 *  Fichier : compte.inc.php
 */
$nouveauNom = isset($_POST["nom"]) ? trim(filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING)): "";
$nouvelEmail = isset($_POST["email"]) ? trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL)): "";
$mdp = isset($_POST["motDePasse"]) ? trim(filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING)): "";
$nouveauMdp = isset($_POST["nouveauMotDePasse"]) ? trim(filter_input(INPUT_POST,'nouveauMotDePasse',FILTER_SANITIZE_STRING)): "";
$confMdp = isset($_POST["confirmerNouveauMotDePasse"]) ? trim(filter_input(INPUT_POST,'confirmerNouveauMotDePasse',FILTER_SANITIZE_STRING)): "";
$moyenneAuteur = RetournerMoyenneUtilisateur($_SESSION["utilisateur"]);
if($nouveauNom != "") {
    if(strtolower($nouvelEmail) == strtolower($_SESSION["utilisateur"]) || !UtilisateurExiste($nouvelEmail)) {
        if (filter_var($nouvelEmail, FILTER_VALIDATE_EMAIL)) {
            if (UtilisateurExisteEtMotDePasseJuste($_SESSION["utilisateur"], $mdp)) {

                $MotDePasseEstJuste = VerfieMotDePasse($nouveauMdp, $confMdp);
                if ($MotDePasseEstJuste === true) {
                    ModifierUtilisateurNomEmailMotDePasse($_SESSION["utilisateur"],$nouveauNom,$nouvelEmail,hash("sha256",$nouveauMdp));
                    $_SESSION["utilisateur"] = $nouvelEmail;
                    true;
                } else {
                    ModifierUtilisateurNomEmail($_SESSION["utilisateur"],$nouveauNom,$nouvelEmail);
                    $_SESSION["utilisateur"] = $nouvelEmail;
                    $erreurMessage = "le mot de passe n'a pas été modifier, car " . $MotDePasseEstJuste;
                }
            } else {
                ModifierUtilisateurNom($_SESSION["utilisateur"],$nouveauNom);
                $erreurMessage = "le nom a bien été modifier mais, le mot de passe et email non car, le mot de passe est faux";
            }
        }

        else {
            ModifierUtilisateurNom($_SESSION["utilisateur"],$nouveauNom);
            $erreurMessage = "le nom a bien été modifier mais, le mot de passe et email non car, $nouvelEmail n'est pas une adresse email valide ";
        }
    }
    else
    {
        ModifierUtilisateurNom($_SESSION["utilisateur"],$nouveauNom);
        $erreurMessage = "le nom a bien été modifier mais, le mot de passe et email non car, cette adresse email existe déja";
    }
}
$utilisateur =  RetournerUtilisateur($_SESSION["utilisateur"]);
$nom = $utilisateur["nom"];
$email = $utilisateur["email"];
/** Affiche toute les histoire d'un utilisateur avec les button supprimer et ajouter
 * @return array listes histoires
 */
function afficherHistoiresUilisateur()
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