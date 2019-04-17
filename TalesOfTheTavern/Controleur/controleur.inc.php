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
/** appelle la fonction pour ajouter un utilisateur
 * @param $nomUtilisateur string nom de l'utilisateur
 * @param $emailUtilisateur string email de lutilisateur
 * @param $motDePasse string mot de passe de l'utilisateur
 */
function  InsererUtilisateur($nomUtilisateur,$emailUtilisateur,$motDePasse)
{
    AjouterUtilisateur($nomUtilisateur, $emailUtilisateur,$motDePasse);
}

/** appelle la fonction pour modfifier un utilisateur
 * @param $nomUtilisateur string nom de l'utilisateur
 * @param $emailUtilisateur string ancien email de l'utilisateur
 * @param $nouvelEmail string nouvel email de l'utilisateur
 * @param $motDePasse string mot de passe de l'utilisateur
 */
function ModifierUtilisateurParEmail($nomUtilisateur,$emailUtilisateur,$nouvelEmail,$motDePasse)
{
    ModifierUtilisateur($nomUtilisateur,$emailUtilisateur,$nouvelEmail,hash("sha256", $motDePasse));
}

/** vérifie que les 2 mot de passe sont égale et sont 8 charactère de long et contien au moins une lettre et un chiffre
 * @param $motDePasse string mot de passe
 * @param $motDePasseConfirmation string deuxième mot de passe
 * @return bool|string true si tout c'est bien passer | le text d'erreur
 */
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

/** appelle la fonction pour retourner un utilisateur
 * @param $emailUtilisateur $email de l'utilisateur
 * @return array|bool liste contenant un utilisateur | false si il n'existe pas
 */
function RetournerUtilisateur($emailUtilisateur)
{
    $utilisateur = RetrouverUtilisateur($emailUtilisateur);
    return $utilisateur;
}
/** appelle la fonction pour retourner toute les catégorie
 * @return array|bool liste contenant toute les catégories | false si elles n'existent pas
 */
function RetournerTouteLesCategories()
{
    $catégorie = RetrouverTouteLesCatégories();
    return $catégorie;
}

/** fonction permmetant de creer une carte histoire
 * @param $idHistoire int id de l'histoire
 * @param $urlImage string url de l'image
 * @param $titre string titre de l'histoire
 * @param $auteur string auteur de l'histoire
 * @param $catégorie string catégorie de l'histoire
 * @param $histoire string texte de l'histoire
 * @param $afficherBouton bool afficher les bouton supprimer / modifier
 * @return string HTML a afficher
 */
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

/** vérifie si l'histoire existe
 * @param $emailUtilisateur string email de l'utilisateur
 * @return bool true si il existe | false si il n'existe pas
 */
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
/** Permettant de savoir si un utilisateur existe et le mot de passe est égale a celuil
 * @param $emailUtilisateur string email de l'utilisateur
 * @param $motDePasse string mot de passe
 * @return bool true si l’utilisateur existe et le mot de passe est juste | false si le mot de passe est faux ou l'utilisateur n'existe pas
 */
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

/** appelle la fonction pour ajouter une image
 * @param $urlImage string url de l'image
 * @return int last inserted id
 */
function InsererImage($urlImage)
{
    return AjouterImage($urlImage);
}
function InsererHistoire($titre,$histoire,$idImage,$idCatégorie,$emailUtilisateur){
    $idUtilisateur =  $utilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    AjouterHistoire($titre,$histoire,$idImage,$idCatégorie,$idUtilisateur);
}

/** appelle la fonction pour retourner une histoire
 * @param $idHistoire
 * @return array|boolliste contenant une histoire | false si elle n'existe pas
 */
function RetournerHistoireParId($idHistoire)
{
    $histoire =  RetrouverHistoireParId($idHistoire);
    return $histoire;
}

/** appelle la fonction pour retourner toutes les histoires d'un utilisateur
 * @param $emailUtilisateur string email de l'utilisateur
 * @return  array|bool liste contenant des histoires | false si elles n'existent pas
 */
function RetournerTouteHistoireCreerParUnUtilisateur($emailUtilisateur)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    return RetrouverTouteHistoireParUtilisateur($idUtilisateur);
}

/** retourne tout les histoire trier d'une manière
 * @param $trie string trie
 * @return array|bool liste contenant des histoires | false si elles n'existent pas
 */
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

/** retourne les favoris d'un utilisateur
 * @param $trie string trie
 * @param $emailUtilisateur string email utilisateur
 * @return array|bool liste contenant des histoires | false si elles n'existent pas
 */
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

/** appelle la fonction pour supprimer une histoire
 * @param $idHistoire int id de l'hitoire
 */
function SuppprimerHisoireParId($idHistoire)
{
    SupprimerHistoire($idHistoire);
}

/** appelle la fonction pour inserer une évaluation
 * @param $noteStyle int note style
 * @param $noteHistoire int note style
 * @param $noteOrthographe int note Orthographe
 * @param $noteOriginialite int note Originalité
 * @param $idHistoire int id de l'histoire
 */
function InsererEvaluation($noteStyle,$noteHistoire,$noteOrthographe,$noteOriginialite,$idHistoire)
{
    AjouterEvaluation($noteStyle, $noteHistoire,$noteOrthographe,$noteOriginialite,$idHistoire);
}

/** appelle la fonction pour inserer un favoris
 * @param $emailUtilisateur string email de l'utilisateur
 * @param $idHistoire int id de l'histoire
 */
function InsererFavoris($emailUtilisateur,$idHistoire)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    AjouterFavoris($idUtilisateur,$idHistoire);
}

/** appelle la fonction pour supprimer un favoris
 * @param $emailUtilisateur string email de l'utilisateur
 * @param $idHistoire int id de l'histoire
 */
function SupprimerFavorisParId($emailUtilisateur,$idHistoire)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    SupprimerFavoris($idUtilisateur,$idHistoire);
}

/** vérifie si l'utilisateur est favoris ou non
 * @param $emailUtilisateur string email de l'utilisateur
 * @param $idHistoire int id de l'histoire
 * @return bool true si l’utilisateur est favoris a une histoire | false si l’utilisateur n'est pas favoris a une histoire
 */
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

/** retourne la moyenne d'un utilisateur si il n'y en a pas alors retourne 0
 * @param $emailUtilisateur string email de l'utilsateur
 * @return float|int moyenne
 */
function RetournerMoyenneUtilisateur($emailUtilisateur)
{
    $idUtilisateur = RetrouverUtilisateur($emailUtilisateur)["idUtilisateur"];
    $histoires =  RetrouverTouteHistoireParUtilisateur($idUtilisateur);
    $sommeMoyenne = 0;
    $cptHistoires = 0;
    if(count($histoires) == 0)
    {
        return 0;
    }
    for($i = 0; $i < count($histoires); $i++)
    {
        $sommeMoyenne += $histoires[$i]["moyenne"];
        $cptHistoires += 1;
    }

    return round($sommeMoyenne / $cptHistoires,1);
}

/** Retourne les histoires qui contiennent la recherche
 * @param $recherche string text a chercher
 * @return array histoires
 */
function RetournerHistoireParTitre($recherche)
{
    $titre = "%" . $recherche . "%";
    return RetrouverHistoireParTitre($recherche);
}
/** Retourne les histoires des utilisateur qui contiennent la recherche
 * @param $recherche string text a chercher
 * @return array histoires
 */
function RetournerHistoireParNom($recherche)
{
    $nom = "%" . $recherche . "%";
    return RetrouverHistoireParNom($recherche);
}