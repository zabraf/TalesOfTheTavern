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
function ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,$nouvelEmail,$motDePasse)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("UPDATE utilisateur SET nom=:nom,email=:nouvelEmail,motDePasse=:motDePasse WHERE email=:email");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":nouvelEmail", $nouvelEmail, PDO::PARAM_STR);
    $requete->bindParam(":motDePasse", $motDePasse, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
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
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;
}
function RetrouverTouteLesCatégories()
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT * FROM categorie");
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
function AjouterHitoire($titre,$histoire,$idImage,$idCatégorie,$idUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO histoire(titre, DateCreation, histoire, idImage, idCategorie, idUtilisateur) VALUES (:titre,NOW(),:histoire,:idImage,:idCategorie,:idUtilisateur)");
    $requete->bindParam(":titre", $titre, PDO::PARAM_STR);
    $requete->bindParam(":histoire", $histoire, PDO::PARAM_STR);
    $requete->bindParam(":idImage", $idImage, PDO::PARAM_INT);
    $requete->bindParam(":idCategorie", $idCatégorie, PDO::PARAM_INT);
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
}
function AjouterImage($urlImage)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO image(urlImageHistoire) VALUES (:url)");
    $requete->bindParam(":url", $urlImage, PDO::PARAM_STR);
    $requete->execute();
    return $connexion->lastInsertId();
}
function ModifierHitoire($idHistoire, $titre,$histoire,$idImage,$idCategorie)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("UPDATE histoire SET titre=:titre,histoire=:histoire,idImage=:idImage,idCategorie=:idCategorie WHERE idHistoire = :idHistoire");
    $requete->bindParam(":titre", $titre, PDO::PARAM_STR);
    $requete->bindParam(":histoire", $histoire, PDO::PARAM_STR);
    $requete->bindParam(":idImage", $idImage, PDO::PARAM_INT);
    $requete->bindParam(":idCategorie", $idCategorie, PDO::PARAM_INT);
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->execute();
}
function SupprimerHistoire($idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("DELETE FROM histoire WHERE idHistoire = :idHistoire");
    $requete->bindParam(":idHistoire", $id, $idHistoire::PARAM_INT);
    $requete->execute();
}
function RetrouverHistoireParId($idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT titre, histoire, idImage, idCategorie, email FROM histoire as his INNER JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur WHERE idHistoire = :id");
    $requete->bindParam(":id", $idHistoire, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;
}
function RetrouverTouteHistoireparUtilisateur($idUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT idHistoire, titre, histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom  
                                              FROM histoire as his 
                                              LEFT  JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur
                                              LEFT  JOIN categorie as cat ON his.idCategorie = cat.idCategorie
                                              LEFT  JOIN image as ima ON his.idImage = ima.idImage
                                              WHERE  his.idUtilisateur = :idUtilisateur
                                              ORDER BY his.dateCreation ASC");
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
?>