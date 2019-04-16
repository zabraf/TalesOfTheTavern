<?php
/*  auteur : Raphael Lopes
*  Projet : Tales of the Tavern
*  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
*  date : 11.04.19
*  Version : 1.0
*  Fichier : histoire.inc.php
*/

$idHistoire = isset($_GET["id"]) ? trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT)): "";
$histoire = RetournerHistoireParId($idHistoire);
if($histoire === false){
    header("location: index.php");
    exit();
}
$noteStyle = isset($_POST["noteStyle"]) ? trim(filter_input(INPUT_POST,'noteStyle',FILTER_SANITIZE_NUMBER_INT)): "";
$noteHistoire = isset($_POST["noteHistoire"]) ? trim(filter_input(INPUT_POST,'noteHistoire',FILTER_SANITIZE_NUMBER_INT)): "";
$noteOrthographe = isset($_POST["noteOrthographe"]) ? trim(filter_input(INPUT_POST,'noteOrthographe',FILTER_SANITIZE_NUMBER_INT)): "";
$noteOriginialite = isset($_POST["noteOriginialite"]) ? trim(filter_input(INPUT_POST,'noteOriginialite',FILTER_SANITIZE_NUMBER_INT)): "";

if(isset($_SESSION["utilisateur"])) {
    if(isset($_POST["favoris"])) {
        if (EstFavoris($_SESSION["utilisateur"], $idHistoire)) {
            SupprimerFavorisParId($_SESSION["utilisateur"], $idHistoire);
        } else {
            InsererFavoris($_SESSION["utilisateur"], $idHistoire);
        }
    }
    if(EstFavoris($_SESSION["utilisateur"],$idHistoire))
    {
        $buttonText = "Supprimer aux favoris";
    }
    else{
        $buttonText = "Ajouter aux favoris";
    }
}

if($noteStyle != "" && $noteHistoire != "" && $noteOrthographe != "" && $noteOriginialite != "" && !isset($_POST["favoris"]))
{
    InsererEvaluation($noteStyle,$noteHistoire,$noteOrthographe,$noteOriginialite,$idHistoire);
    header("location: index.php");
    exit();
}

if($histoire["urlImageHistoire"] === null){
    $urlImage = $histoire["urlImageCategorie"];
}
else{
    $urlImage = $histoire["urlImageHistoire"];
}
$titre = $histoire["titre"];
$moyenneGlobalHistoire = round($histoire["moyenne"],1);
$auteur = $histoire["nom"];
$moyenneAuteur = RetournerMoyenneUtilisateur($histoire["email"]);
$categorie = $histoire["nomCategorie"];
$texteHistoire = $histoire["histoire"];
$moyenneStyle = round($histoire["moyenneStyle"],1);
$moyenneHistoire = round($histoire["moyenneHistoire"],1);
$moyenneOrthographe = round($histoire["moyenneOrthographe"],1);
$moyenneOriginalite =round($histoire["moyenneOriginalite"],1);

function AfficherNotation()
{
    for($i = 1; $i <= 5; $i++)
    {
        echo "<option value=\"" . $i . "\" selected > " . $i . "</option>";
    }
}