<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : index.inc.php
 */
$histoires = "";
if(isset($_GET["ordre"]))
{
    $post = $_GET["ordre"];
}
else
{
    $post = "default";
}
    switch ($post) {
        case "note":
            $histoires = "";
            break;
        default:
            $histoires = RetournerTouteHistoireParDateDeCreation($histoires);
            break;
    }

function afficherHitoires($histoires)
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