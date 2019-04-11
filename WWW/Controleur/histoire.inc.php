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
$moyenneHistoire = $histoire["moyenne"];
if($moyenneHistoire == null)
{
    $moyenneHistoire = 0;
}
$moyenneHistoire = $histoire["moyenne"];
$auteur = $histoire["nom"];
$moyenneAuteur = RetournerMoyenneUtilisateur($_SESSION["utilisateur"]);
$categorie = $histoire["nomCategorie"];
$histoire = $histoire["histoire"];
$buttonText = "Ajouter au favoris";


function AfficherNotation()
{
    for($i = 1; $i <= 5; $i++)
    {
        echo "<option value=\"" . $i . "\" selected > " . $i . "</option>";
    }
}