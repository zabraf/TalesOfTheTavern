<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : controlleur.php
 */
require_once("./Model/fonctionBD.php");
function  InsererUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse,$motDePasseConfirmation)
{
    if($motDePasse === $motDePasseConfirmation)
    {
        $utilisateur = RetrouverUtilisateur($emailUtilisateur);
        if($utilisateur == null)
        {
            AjouterUtilisateur($nomUtilisateur,$emailUtilisateur,hash("sha256",$motDePasse));
            return true;
        }
        else
        {
            return "Cette adresse e-mail est déjà utilisée";
        }

    }else
    {
        return "le login est faux";
    }
}



function  UtilisateurExisteEtMotDePasseJuste($emailUtilisateur,$motDePasse)
{
    $utilisateur = RetrouverUtilisateur($emailUtilisateur)[0];
    if($utilisateur != null)
    {
        if($motDePasse == $utilisateur["motDePasse"])
            return true;
    }
    return false;
}
