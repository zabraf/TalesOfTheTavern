<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : fonctionBD.php
 */
require_once("./Model/connextionDB.php");
/// Fonction : Permettant d'insérer un utilisateur dans la base
/// paramètre : nom de l'utilisateur, email de l'utilisateur, mot de passe hasher
function AjouterUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO utilisateur(nom, email, motDePasse) VALUES (:nom,:email,:motDePasse)");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":motDePasse", $motDePasse, PDO::PARAM_STR);
    $requete->execute();
}

function ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("UPDATE utilisateur SET nom=:nom,email=:email,motDePasse=:motDePasse WHERE email=:email");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":motDePasse", $motDePasse, PDO::PARAM_STR);
    $requete->execute();
}
/// Fonction : Permettant de recuperer un utilisateur avec son email
/// paramètre : email de l'utilisateur
function RetrouverUtilisateur($emailUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat[0];
}
?>