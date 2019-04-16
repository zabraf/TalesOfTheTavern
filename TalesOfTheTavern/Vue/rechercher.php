<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 12.04.19
 *  Version : 1.0
 *  Fichier : rechecher.php
 */
session_start();
if(!isset($_GET["recherche"])){
   header("location: index.php");
   exit();
}
require_once("../Controleur/controleur.inc.php");
require_once("../Controleur/rechercher.inc.php");
?>
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="MyCss.css">
    <title>Tales of the tavern</title>
</head>
<body>
<?php include_once("navbar.php");?>
<h1>Histoire par titre</h1>
<?php
if(!empty($histoiresParTitre) || $histoiresParTitre = ""){
    echo "<div class=\"row\">";
    afficherHistoires($histoiresParTitre);
    echo "</div>";
}
else{
    echo "<h4>Il n' y pas d'histoire avec se titre</h4>";
}
?>
<h1>Histoire par nom</h1>
<?php
if(!empty($histoiresParAuteur) || $histoiresParAuteur = ""){
    echo "<div class=\"row\">";
    afficherHistoires($histoiresParAuteur);
    echo "</div>";
}
else{
    echo "<h4>Il n'y a pas d'utilisateur avec se nom</h4>";
}
?>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>