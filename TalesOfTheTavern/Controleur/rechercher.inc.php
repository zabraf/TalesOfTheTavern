<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 12.04.19
 *  Version : 1.0
 *  Fichier : rechercher.inc.php
 */

$histoiresParTitre = "";
$histoiresParAuteur = "";
$recherche = isset($_GET["recherche"]) ? trim(filter_input(INPUT_GET,'recherche',FILTER_SANITIZE_STRING)): "";
if($recherche == "")
{
   header("location: index.php");
   exit();
}
$histoiresParTitre = RetournerHistoireParTitre($recherche);
$histoiresParAuteur = RetournerHistoireParNom($recherche);
/** Affiche une histoire
 * @param $histoires int id histoire a retourner
 */
function afficherHistoires($histoires)
{
    for($i = 0; $i < count($histoires); $i++)
    {
        if($histoires[$i]["urlImageHistoire"] == null)
        {
            $histoires[$i]["urlImageHistoire"] = $histoires[$i]["urlImageCategorie"];
        }
        echo AfficherHistoire($histoires["$i"]["idHistoire"],$histoires["$i"]["urlImageHistoire"],$histoires[$i]["titre"],$histoires[$i]["nom"],$histoires["$i"]["nomCategorie"],$histoires[$i]["histoire"],false);
    }
}