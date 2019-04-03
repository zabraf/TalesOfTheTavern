<?php
require_once ("./ConnextionDB.php");
function AjouterUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO utilisateur(nom, email, motDePasse) VALUES (:nom,:email,:motDePasse)");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":motDePasse", $motDePasse, PDO::PARAM_STR);
    $requete->execute();
}