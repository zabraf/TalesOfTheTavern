<?php
require_once "../Model/FonctionBD.php";
function  InsererUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse,$motDePasseConfirmation)
{
    if($motDePasse == $motDePasseConfirmation)
    {
        AjouterUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse);
        return true;
    }
    else
    {
        return "le login est faux";
    }
}