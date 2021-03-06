<?php
/*  auteur : Raphael Lopes
*  Projet : Tales of the Tavern
*  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
*  date : 11.04.19
*  Version : 1.0
*  Fichier : histoire.php
*/
session_start();
if(!isset($_GET["id"]))
{
    header("location: index.php");
    exit();
}
require_once("../Controleur/controleur.inc.php");
require_once("../Controleur/histoire.inc.php");
?>
<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Tales of the tavern</title>
</head>
<body>
<?php include_once("./navbar.php");?>
<br/>
<div class="container col-sm-12 col-md-6 c border-1">
    <div class="card col-md-12">
        <?php

        echo '<img class="card-img-top" src="Img/' . $urlImage . '" alt="Image de l\'histoire">';
        echo '<h1 class="display-4">' . $titre . ' (moyenne : ' . $moyenneGlobalHistoire .')</h1>';
        echo '<p class="lead"> ' . $auteur . ' (moyenne de l\'auteur : ' . $moyenneAuteur .')</p>';
        echo '<p class="lead"> ' . $categorie . '</p>';
        echo '<p>'. nl2br($texteHistoire) .  '</p>';
        ?>


        <form action="#" method="post">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>Style (moyenne : <?= $moyenneStyle ?>)</label>
                        <select class="form-control" name="noteStyle">
                            <?php
                            AfficherNotation();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>Histoire (moyenne : <?= $moyenneHistoire ?>)</label>
                        <select class="form-control" name="noteHistoire">
                            <?php
                            AfficherNotation();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>Orthographe (moyenne : <?= $moyenneOrthographe ?>)</label>
                        <select class="form-control" name="noteOrthographe">
                            <?php
                            AfficherNotation();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>Orignialite (moyenne : <?= $moyenneOriginalite ?>)</label>
                        <select class="form-control" name="noteOriginialite">
                            <?php
                            AfficherNotation();
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-12">Voter</button>
            <?php
            if(isset($_SESSION["utilisateur"]))
                echo  '</br></br><button type="submit" class="btn btn-primary col-12" name="favoris">' . $buttonText . '</button>'
            ?>

        </form>
    </div>

    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>