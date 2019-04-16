<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : controleur.inc.php
 */
require_once("../Modele/fonctionBD.php");
define("CHARMIN", 8);

function  InsererUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse)
{
    AjouterUtilisateur($nomUtilisateur, $emailUtilisateur,$motDePasse);
}
function ModifierUtilisateurParEmail($nomUtilisateur,$emailUtilisateur,$nouvelEmail,$motDePasse)
{
    ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,$nouvelEmail,hash("sha256", $motDePasse));
}
function VerfieMotDePasse($motDePasse,$motDePasseConfirmation)
{
    if (preg_match('~[0-9]~', $motDePasse) >= 1 && preg_match('~[a-zA-Z]~', $motDePasse) >= 1) {
        if (strlen($motDePasse) >= CHARMIN) {
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
function AfficherHistoire($idHistoire,$urlImage,$titre,$auteur,$catégorie,$histoire,$afficherBouton)
{
    $histoireHTML = '<a style="color:inherit; text-decoration:none;" href="histoire.php?id=' . $idHistoire . '"><div class="h-100 card col-md-12 col-lg-4 mb-3">'
        . '<img class="card-img-top" src="Img/' . $urlImage . '" alt="Image de l\'histoire">'
        . '<h1 class="display-4">' . $titre . '</h1>'
        . '<p class="lead"> ' . $auteur . '</p>'
        . '<p class="lead"> ' . $catégorie . '</p>'
        . '<p>'. substr($histoire,0,140) . "..." . '</p></a>';
    if($afficherBouton) {
        $histoireHTML .= '<div class="row"><a class="col-6 btn btn-primary btn-lg" href="modifierHistoire.php?id=' . $idHistoire . '" role="button">Modifier</a>'
            . '<a class=" col-6 btn btn-danger btn-lg" href="supprimer.php?id=' . $idHistoire . '" role="button">Supprimer</a></div>';
    }
    $histoireHTML .= '</div>';
    return $histoireHTML;
}
function UtilisateurExiste($emailUtilisateur)
{
    $utilisateur = RetrouverUtilisateur($emailUtilisateur);
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
    $utilisateur = RetrouverUtilisateur($emailUtilisateur);
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
    $idUtilisateur =  $utilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    AjouterHitoire($titre,$histoire,$idImage,$idCatégorie,$idUtilisateur);
}
function RetournerHistoireParId($idHistoire)
{
    $histoire =  RetrouverHistoireParId($idHistoire);
    return $histoire;
}
function RetournerTouteHistoireCreerParUnUtilisateur($emailUtilisateur)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    return RetrouverTouteHistoireParUtilisateur($idUtilisateur);
}
function RetournerTouteHistoire($trie)
{
    switch ($trie)
    {
        case "note":
            return RetrouverTouteHistoireTrierParMoyenne();
            break;
        default:
            return RetrouverTouteHistoireTrierParDate();
            break;
    }
}
function RetournerToutFavoris($trie,$emailUtilisateur)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    switch ($trie)
    {
        case "note":
            return RetrouverTouteFavorisTrierParMoyenne($idUtilisateur);
            break;
        default:
            return RetrouverTouteFavorisTrierParDate($idUtilisateur);
            break;
    }
}
function SuppprimerHisoireParId($idHistoire)
{
    SupprimerHistoire($idHistoire);
}
function InsererEvaluation($noteStyle,$noteHistoire,$noteOrthographe,$noteOriginialite,$idHistoire)
{
    AjouterEvaluation($noteStyle, $noteHistoire,$noteOrthographe,$noteOriginialite,$idHistoire);
}
function InsererFavoris($emailUtilisateur,$idHistoire)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    AjouterFavoris($idUtilisateur,$idHistoire);
}
function SupprimerFavorisParId($emailUtilisateur,$idHistoire)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    SupprimerFavoris($idUtilisateur,$idHistoire);
}
function EstFavoris($emailUtilisateur,$idHistoire)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    if(RetrouverFavoris($idUtilisateur,$idHistoire) !== false)
    {
        return true;
    }
    else{
        return false;
    }
}
function RetournerMoyenneUtilisateur($emailUtilisateur)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    $histoires =  RetrouverTouteHistoireParUtilisateur($idUtilisateur);
    $sommeMoyenne = 0;
    $cptHistoires = 0;
    for($i = 0; $i < count($histoires); $i++)
    {
        $sommeMoyenne += $histoires[$i]["moyenne"];
        $cptHistoires += 1;
    }
    if($cptHistoires == 0)
    {
        return 0;
    }
    return round($sommeMoyenne / $cptHistoires,1);
}

function RetournerHistoireParTitre($titre)
{
    $titre = "%" . $titre . "%";
    return RetrouverHistoireParTitre($titre);
}

function RetournerHistoireParNom($nom)
{
    $nom = "%" . $nom . "%";
    return RetrouverHistoireParNom($nom);
}