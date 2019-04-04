<?php
require_once("../Model/fonctionBD.php");
function  InsererUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse,$motDePasseConfirmation)
{
    if($motDePasse === $motDePasseConfirmation)
    {
        AjouterUtilisateur($nomUtilisateur,$emailUtilisateur,hash("sha256",$motDePasse));

        return true;
    }else
    {
        return "le login est faux";
    }
}