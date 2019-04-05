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
    $MotDePasseJuste = VerfieMotDePasse($motDePasse,$motDePasseConfirmation);
    if ($MotDePasseJuste === true) {
        $utilisateur = RetrouverUtilisateur($emailUtilisateur);
        if ($utilisateur == null) {
            AjouterUtilisateur($nomUtilisateur, $emailUtilisateur, hash("sha256", $motDePasse));
            return true;
        } else {
            return "Cette adresse e-mail est déjà utilisée";
        }
    }
    else {
        return $MotDePasseJuste;
    }



}
function ModifierUtilisateurParEmail($nomUtilisateur,$emailUtilisateur,$motDePasse,$motDePasseConfirmation)
{
    $MotDePasseJuste = VerfieMotDePasse($motDePasse,$motDePasseConfirmation);
    if ($MotDePasseJuste === true) {
        if(UtilisateurExisteEtMotDePasseJuste()) {
            ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,hash("sha256", $motDePasse));
        }
        else{
            return "le mot de passe est faux";
        }
    } else {
        return $MotDePasseJuste;
    }

}
function VerfieMotDePasse($motDePasse,$motDePasseConfirmation)
{
    if (preg_match('#[0-9]#', $motDePasse) == 1) {
        if (strlen($motDePasse) >= CHARMAX) {
            if ($motDePasse === $motDePasseConfirmation) {
                return true;
            } else {
                return "les mots de passe ne correspondent pas";
            }
        } else {
            return "le mot de passe doit contenir au moins de 8 caractères";
        }
    } else {
        return "le mot de passe doit contenir au moins 1 chiffre";
    }
}
function RetournerUtilisateur($emailUtilisateur)
{
    return RetrouverUtilisateur($emailUtilisateur);
}
/// Fonction : Permettant de savoir si un utilisateur existe et le mot de passe est égale a celuil
/// paramètre :  email de l'utilisateur, mot de passe
/// retourne : TRUE = l’utilisateur existe et le mot de passe est juste, FALSE = si le mot de passe est faux ou l'utilisateur n'existe pas
function  UtilisateurExisteEtMotDePasseJuste($emailUtilisateur,$motDePasse)
{
    $utilisateur = RetrouverUtilisateur($emailUtilisateur);
    if($utilisateur != null)
    {
        if(hash("sha256",$motDePasse )== $utilisateur["motDePasse"])
            return true;
    }
    return false;
}
