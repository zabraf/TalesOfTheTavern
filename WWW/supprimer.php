<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 05.04.19
 *  Version : 1.0
 *  Fichier : supprimer.php
 */
session_start();
if(!isset($_SESSION["utilisateur"]))
{
    header("location: index.php");
    exit();
}

require_once("./Controlleur/controlleur.php");
$idHistoire = isset($_GET["id"]) ? trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT)): "";
$histoire = RetournerHistoireParId($idHistoire);
if ($histoire === null || strtolower($histoire["email"]) != strtolower($_SESSION["utilisateur"]))
{
   header("Location: compte.php");
   exit();
}
if(isset($_POST["supprimer"]))
{
    SuppprimerHisoireParId($idHistoire);
    header("Location: compte.php");
    exit();
}
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
<div class="container col-sm-12 col-md-6 c border-1 mb-5">
    <h1>
        Êtes-vous sûr de vouloir supprimer cette histoire ?
    </h1>
    <form action="#" method="post">
        <div class="row">
            <button type="submit" class="btn btn-danger col-12 col-md-6 btn-lg" name="supprimer">Oui</button>
            <a class="col-6 col-md-6 btn btn-primary btn-lg" href="compte.php" role="button">Non</a>
        </div>
    </form>
</div>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
