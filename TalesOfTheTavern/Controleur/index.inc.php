<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : index.inc.php
 */
$histoires = "";
$favoris = "";
if(isset($_GET["ordre"]))
{
    $get = $_GET["ordre"];
}
else
{
    $get = "default";
}
$histoires = RetournerTouteHistoire($get);
if(isset($_SESSION["utilisateur"]))
{

    $favoris = RetournerToutFavoris($get,$_SESSION["utilisateur"]);
}
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