<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : controlleur.php
 */
require_once("./Model/fonctionBD.php");
define("CHARMAX", 8);
/// Fonction : Permettant d'insérer un utilisateur en vérifiant qu'il n'existe pas dans la base de données et que les 2 mot de passe son pareille
/// paramètre : nom de l'utilisateur, email de l'utilisateur, mot de passe , Confirmation du mot de passe
/// retourne : TRUE = l’utilisateur a été insérer dans la base, String = un message d'erreur
function  InsererUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse,$motDePasseConfirmation)
{
    //verfie que le mot de passe fait plus que 8 caractères et contient au mins un chiffre
    $MotDePasseEstJuste = VerfieMotDePasse($motDePasse,$motDePasseConfirmation);
    if ($MotDePasseEstJuste === true) {

        if (!UtilisateurExiste($emailUtilisateur)) {
            AjouterUtilisateur($nomUtilisateur, $emailUtilisateur, hash("sha256", $motDePasse));
            return true;
        } else {
            return "Cette adresse e-mail est déjà utilisée.";
        }
    }
    else {
        return $MotDePasseEstJuste;
    }



}
function ModifierUtilisateurParEmail($nomUtilisateur,$emailUtilisateur,$nouvelEmail,$motDePasse,$nouveauMotDePasse,$motDePasseConfirmation)
{
    if(UtilisateurExisteEtMotDePasseJuste($emailUtilisateur,$motDePasse)) {
        $MotDePasseEstJuste = VerfieMotDePasse($nouveauMotDePasse,$motDePasseConfirmation);
        if ($MotDePasseEstJuste === true) {
        ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,$nouvelEmail,hash("sha256", $nouveauMotDePasse));
        return true;
        } else
        {
            ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,$nouvelEmail,hash("sha256", $motDePasse));
            return $MotDePasseEstJuste;
        }
    } else{
        return false;
    }

}
function VerfieMotDePasse($motDePasse,$motDePasseConfirmation)
{
    if (preg_match('~[0-9]~', $motDePasse) >= 1 && preg_match('~[a-zA-Z]~', $motDePasse) >= 1) {
        if (strlen($motDePasse) >= CHARMAX) {
            if ($motDePasse === $motDePasseConfirmation) {
                return true;
            } else {
                return "les mots de passe ne correspondent pas";
            }
        } else {
            return "le mot de passe doit contenir au minimum de 8 caractères";
        }
    } else {
        return "Le mot de passe doit contenir au minimum 8 caractères";
    }
}
function RetournerUtilisateur($emailUtilisateur)
{
    $utilisateur = RetrouverUtilisateur($emailUtilisateur);
    return $utilisateur;
}
function RetournerTouteLesCategories()
{
    $catégorie = RetrouverTouteLesCatégories();
    return $catégorie;
}
function AfficherHistoire($idHistoire,$urlImage,$titre,$auteur,$catégorie,$histoire)
{
        $histoireHTML = '<div class="card col-md-12 col-lg-4 mb-3">'
        . '<img class="card-img-top" src="' . $urlImage . '" alt="Image de l\'histoire">'
        . '<h1 class="display-4">' . $titre . '</h1>'
        . '<p class="lead"> ' . $auteur . '</p>'
        . '<p class="lead"> ' . $catégorie . '</p>'
        . '<p>'. substr($histoire,0,140) . "..." . '</p>'
        . '<div class="row">'
        . '<a class="col-6 btn btn-primary btn-lg" href="histoire.php?id='. $idHistoire.'" role="button">Modifier</a><a class=" col-6 btn btn-danger btn-lg" href="#" role="button">Supprimer</a>'
        . '</div>'
        . '</div>';
        return $histoireHTML;

}
function UtilisateurExiste($emailUtilisateur)
{
    $utilisateur = RetournerUtilisateur($emailUtilisateur);
    if($utilisateur != null)
    {
        return true;
    }else{
        return false;
    }
}
/// Fonction : Permettant de savoir si un utilisateur existe et le mot de passe est égale a celuil
/// paramètre :  email de l'utilisateur, mot de passe
/// retourne : TRUE = l’utilisateur existe et le mot de passe est juste, FALSE = si le mot de passe est faux ou l'utilisateur n'existe pas
function  UtilisateurExisteEtMotDePasseJuste($emailUtilisateur,$motDePasse)
{
    $utilisateur = RetournerUtilisateur($emailUtilisateur);
    if(UtilisateurExiste($emailUtilisateur))
    {
        if(hash("sha256",$motDePasse )== $utilisateur["motDePasse"])
            return true;
    }
    return false;
}

function InsererImage($urlImage)
{
    return AjouterImage($urlImage);
}
function InsererHistoire($titre,$histoire,$idImage,$idCatégorie,$emailUtilisateur){
    $idUtilisateur =  $utilisateur = RetournerUtilisateur($emailUtilisateur)["idUtilisateur"];
    AjouterHitoire($titre,$histoire,$idImage,$idCatégorie,$idUtilisateur);
}
function RetournerHistoireParId($idHistoire)
{
    $histoire =  RetrouverHistoireParId($idHistoire);
    return $histoire;
}
function RetournerTouteHistoireCreerParUnUtilisateur($emailUtilisateur)
{
    $idUtilisateur = RetournerUtilisateur($emailUtilisateur)["idUtilisateur"];
    return RetrouverTouteHistoireparUtilisateur($idUtilisateur);
}
