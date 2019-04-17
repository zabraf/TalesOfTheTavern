<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : fonctionBD.php
 */
require_once("../Modele/connexionBD.php");
/** ceci Permet d'insérer un utilisateur dans la base
 * @param $nomUtilisateur string non utilisateur
 * @param $emailUtilisateur string email utilisateur
 * @param $motDePasse string mot de passe
 */
function AjouterUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO utilisateur(nom, email, motDePasse) VALUES (:nom,:email,:motDePasse)");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":motDePasse", $motDePasse, PDO::PARAM_STR);
    $requete->execute();
}

/** ceci Permet de modifier nom d'un utilisateur dans la base
 * @param $emailUtilisateur string email de l'utilisateur
 * @param $nomUtilisateur string nouveau nom de l'utilisateur
 */
function ModifierUtilisateurNom($emailUtilisateur,$nomUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("UPDATE utilisateur SET nom=:nom WHERE email=:email");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
}

/**  ceci Permet de modifier nom et email d'un utilisateur dans la base
 * @param $emailUtilisateur string ancien email de l'utilisateur
 * @param $nomUtilisateur string  nouveau nom de l'utilisateur
 * @param $nouvelEmail string nouvel email de l'utilisateur
 */
function ModifierUtilisateurNomEmail($emailUtilisateur,$nomUtilisateur,$nouvelEmail)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("UPDATE utilisateur SET nom=:nom,email=:nouvelEmail WHERE email=:email");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":nouvelEmail", $nouvelEmail, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
}

/** ceci Permet de modifier nom, email et mot de passe d'un utilisateur dans la base
 * @param $emailUtilisateur string ancien email de l'utilisateur
 * @param $nomUtilisateur string nouveau nom de l'utilisateur
 * @param $nouvelEmail string nouvel email de l'utilisateur
 * @param $motDePasse string nouveau mot de passe de l'utilisateur
 */
function ModifierUtilisateurNomEmailMotDePasse($emailUtilisateur,$nomUtilisateur,$nouvelEmail,$motDePasse)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("UPDATE utilisateur SET nom=:nom,email=:nouvelEmail,motDePasse=:motDePasse WHERE email=:email");
    $requete->bindParam(":nom", $nomUtilisateur, PDO::PARAM_STR);
    $requete->bindParam(":nouvelEmail", $nouvelEmail, PDO::PARAM_STR);
    $requete->bindParam(":motDePasse", $motDePasse, PDO::PARAM_STR);
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
}
/**  ceci Permet de recuperer un utilisateur avec son email
 * @param $emailUtilisateur string email de l'utilisateur
 * @return array|bool retourne un utilisateur si l'utilisateur le trouve | false si il n'y a rien
 */
function RetrouverUtilisateur($emailUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;
}

/** ceci Permet de récuperer toute les catégories
 * array|bool retourne toute les catégorie | false si il n'y a rien
 */
function RetrouverTouteLesCatégories()
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT * FROM categorie");
    $requete->bindParam(":email", $emailUtilisateur, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

/** ceci permet de rajouter une histoire dans la base de données
 * @param $titre string titre de l'histoire
 * @param $histoire string texte de l'hitoire
 * @param $idImage int id de l'image
 * @param $idCatégorie int id de la catégorie
 * @param $idUtilisateur int id de l'utilisateur
 */
function AjouterHistoire($titre,$histoire,$idImage,$idCatégorie,$idUtilisateur)
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

/** ceci permet de rajouter une image (url) dans la db
 * @param $urlImage string url de l'image
 * @return int last inserted id
 */
function AjouterImage($urlImage)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO image(urlImageHistoire) VALUES (:url)");
    $requete->bindParam(":url", $urlImage, PDO::PARAM_STR);
    $requete->execute();
    return $connexion->lastInsertId();
}

/** ceci permet de modifier une histoire
 * @param $idHistoire int id de l'histoire
 * @param $titre string titre de l'histoire
 * @param $histoire string texte de l'histoire
 * @param $idImage int id de l'image
 * @param $idCategorie int id catégorie
 */
function ModifierHistoire($idHistoire, $titre,$histoire,$idImage,$idCategorie)
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

/** ceci permet de supprimer une histoire
 * @param $idHistoire int id de l'histoire
 */
function SupprimerHistoire($idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("DELETE FROM histoire WHERE idHistoire = :idHistoire");
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->execute();
}

/** ceci permet de retouver une histoire la personne qui l'a créer sa catégorie son email et les 5 moyennes de l'histoires
 * @param $idHistoire int id de l'histoire
 * @return array|bool retourne histoire, utilisateur, catégorie, moyenne | false si il n'y a rien
 */
function RetrouverHistoireParId($idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, his.idImage, his.idCategorie, email, urlImageHistoire,urlImageCategorie, nomCategorie, nom,
                                             (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne,
                                             AVG(style) as moyenneStyle,
                                             AVG(eva.histoire) as moyenneHistoire,
                                             AVG(orthographe) as moyenneOrthographe,
                                             AVG(originalite) as moyenneOriginalite
                                             FROM histoire as his
                                             LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur
                                             LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie
                                             LEFT JOIN image as ima ON his.idImage = ima.idImage
                                             LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire
                                             WHERE his.idHistoire = :idHistoire
                                             GROUP BY idHistoire");
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;
}

/** ceci permet de retouver une histoire la personne qui l'a créer sa catégorie son email et les 5 moyennes de l'histoires
 * @param $idUtilisateur int id de l'utilisateur
 * @return array|bool retourne histoire, utilisateur, catégorie, moyenne | false si il n'y a rien
 */
function RetrouverTouteHistoireParUtilisateur($idUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire, urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM histoire as his
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
					                          WHERE  his.idUtilisateur = :idUtilisateur
                                              GROUP BY idHistoire");
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

/** ceci permet de retouver les favoris d'un utilisateur trier par date
 * @param $idUtilisateur int id de l'utilisateur
 * @return array|bool retourne des histoires | false si il n'y a rien
 */
function RetrouverTouteFavorisTrierParDate($idUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM estfavoris as fav 
                                              LEFT JOIN histoire as his ON fav.idHistoire = his.idHistoire 
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
                                              WHERE fav.idUtilisateur = :idUtilisateur
                                              GROUP BY idHistoire 
                                              ORDER By dateCreation DESC");
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
/** ceci permet de retouver toute les histoires trier par date
 * @return array|bool retourne des histoires | false si il n'y a rien
 */
function RetrouverTouteHistoireTrierParDate()
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM histoire as his
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
                                              GROUP BY idHistoire 
                                              ORDER By dateCreation DESC");
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
/** ceci permet de retouver les favoris d'un utilisateur trier par moyenne
 * @param $idUtilisateur int id de l'utilisateur
 * @return array|bool retourne des histoires | false si il n'y a rien
 */
function RetrouverTouteFavorisTrierParMoyenne($idUtilisateur)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM estfavoris as fav 
                                              LEFT JOIN histoire as his ON fav.idHistoire = his.idHistoire 
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
                                              WHERE fav.idUtilisateur = :idUtilisateur
                                              GROUP BY idHistoire 
                                              ORDER By moyenne DESC");
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
/** ceci permet de retouver toute les histoires trier par moyenne
 * @return array|bool retourne des histoires | false si il n'y a rien
 */
function RetrouverTouteHistoireTrierParMoyenne()
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM histoire as his
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
                                              GROUP BY idHistoire 
                                              ORDER By moyenne DESC");
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

/** ceci permet d'ajouter une nouvelle évaluation a une histoire
 * @param $noteStyle int note sur le style
 * @param $noteHistoire int note sur le histoire(texte)
 * @param $noteOrthographe int note sur le Orthographe
 * @param $noteOriginialite int note sur le Originalité
 * @param $idHistoire int id de l'histoire
 */
function AjouterEvaluation($noteStyle, $noteHistoire,$noteOrthographe,$noteOriginialite,$idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO evaluation(style, histoire, orthographe, originalite, idHistoire) VALUES (:noteStyle,:noteHistoire,:noteOrthographe,:noteOriginialite,:idHistoire)");
    $requete->bindParam(":noteStyle", $noteStyle, PDO::PARAM_INT);
    $requete->bindParam(":noteHistoire", $noteHistoire, PDO::PARAM_INT);
    $requete->bindParam(":noteOrthographe", $noteOrthographe, PDO::PARAM_INT);
    $requete->bindParam(":noteOriginialite", $noteOriginialite, PDO::PARAM_INT);
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->execute();
}

/** ceci pemet d'ajouter une histoire en favoris a un utilisateur
 * @param $idUtilisateur int id de l'utilisateur
 * @param $idHistoire int id de l'histoire
 */
function AjouterFavoris($idUtilisateur,$idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("INSERT INTO estfavoris(idHistoire, idUtilisateur) VALUES (:idHistoire,:idUtilisateur)");
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
}
/** ceci pemet de supprimer une histoire en favoris a un utilisateur
 * @param $idUtilisateur int id de l'utilisateur
 * @param $idHistoire int id de l'histoire
 */
function SupprimerFavoris($idUtilisateur,$idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("DELETE FROM estfavoris WHERE idHistoire = :idHistoire AND idUtilisateur = :idUtilisateur");
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
}

/** ceci permet de retrouver si un utilisateur est a une histoire en favoris
 * @param $idUtilisateur int id de utilisateur
 * @param $idHistoire int id de l'histoire
 * @return array|bool retourne un favoris | false si il n'y a rien
 */
function RetrouverFavoris($idUtilisateur,$idHistoire)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT * FROM estfavoris WHERE idHistoire = :idHistoire AND idUtilisateur = :idUtilisateur");
    $requete->bindParam(":idHistoire", $idHistoire, PDO::PARAM_INT);
    $requete->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;
}

/** ceci retourne toute les histoire qui on se titre
 * @param $titre string titre de l'histoire
 * @return array|bool retourne des histoires | false si il n'y a rien
 */
function RetrouverHistoireParTitre($titre)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM histoire as his
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
                                              WHERE titre LIKE :titre
                                              GROUP BY idHistoire 
                                              ORDER By dateCreation DESC");
    $requete->bindParam(":titre", $titre, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
/** ceci retourne toute les histoire ou le nom de l'auteur est égale au nom au paramètre
 * @param $titre string titre de l'histoire
 * @return array|bool retourne des histoires | false si il n'y a rien
 */
function RetrouverHistoireParNom($nom)
{
    $connexion = RecupererConnexion();
    $requete = $connexion->prepare("SELECT his.idHistoire, titre, his.histoire, urlImageHistoire,urlImageCategorie, nomCategorie, nom, 
                                              (AVG(style) + AVG(eva.histoire) + AVG(orthographe) + AVG(originalite))/4 as moyenne 
                                              FROM histoire as his
                                              LEFT JOIN utilisateur as uti ON his.idUtilisateur = uti.idUtilisateur 
                                              LEFT JOIN categorie as cat ON his.idCategorie = cat.idCategorie 
                                              LEFT JOIN image as ima ON his.idImage = ima.idImage 
                                              LEFT JOIN evaluation as eva ON his.idHistoire = eva.idHistoire 
                                              WHERE nom LIKE :nom
                                              GROUP BY idHistoire 
                                              ORDER By nom ASC, dateCreation DESC");
    $requete->bindParam(":nom", $nom, PDO::PARAM_STR);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
    ?>