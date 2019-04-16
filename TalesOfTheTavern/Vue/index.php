<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : index.php
 */
session_start();
require_once("../Controleur/controleur.inc.php");
require_once("../Controleur/index.inc.php");
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
<div class="container col-sm-12 col-md-6">
    <div class="row">
        <a class=" col-3 offset-2 btn btn-primary " href="index.php" role="button">Trier par date</a>
        <a class=" col-3 offset-2 btn btn-primary " href="index.php?ordre=note" role="button">Trier par moyenne</a>
    </div>
</div>
<br/>
<?php
if (isset($_SESSION["utilisateur"])){
    if(!empty($favoris) || $favoris = ""){
        echo "<h1>Mes favoris</h1><div class=\"row\">";
        afficherHistoires($favoris);
        echo "</div>";
    }
    else{
        echo "<h4>Vous n'avez pas de favoris</h4>";
    }

}
?>
<h1>Les histoires</h1>
<div class="row">
    <?php afficherHistoires($histoires); ?>
</div>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>