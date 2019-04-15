<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 05.04.19
 *  Version : 1.0
 *  Fichier : compte.php
 */
session_start();
if(!isset($_SESSION["utilisateur"]))
{
    header("location: index.php");
    exit();
}
$erreurMessage = "";
require_once("../Controleur/controleur.inc.php");
require_once("../Controleur/compte.inc.php");
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
<?php include_once("./navbar.php");?>
<div class="container col-sm-12 col-md-6 c border-1 mb-5">
    <form action="#" method="post">
        <div class="form-group">
            <label>Nom*</label>
            <input type="text" name="nom" class="form-control" value="<?= $nom ?>" required>
        </div>
        <div class="form-group">
            <label>E-mail*</label>
            <input type="email" class="form-control" name="email" value="<?= $email ?>" required>
        </div>
        <div class="form-group">
            <label>Ancien mot de passe*</label>
            <input type="password" class="form-control" name="motDePasse" required>
        </div>
        <div class="form-group">
            <label>Nouveau Mot de passe</label>
            <input type="password" class="form-control" name="nouveauMotDePasse">
            <small>Le mot de passe doit contenir minimum 8 caractères,  un chiffre (0 à 9) et une lettre (a à Z)</small>
        </div>
        <div class="form-group">
            <label>Confirmer Nouveau mot de passe</label>
            <input type="password" class="form-control" name="confirmerNouveauMotDePasse">
        </div>
        <small>*Champs obligatoires</small>
        <br/>
        <label style="color: red"><?php if($erreurMessage !== true){echo $erreurMessage;} ?></label>
        <br/>
        <button type="submit" class="btn btn-primary">Mettre a jour les informations</button>
    </form>
</div>
<div class="container col-12">
    <h1>Mes histoires <a class="col-6 btn btn-primary" href="modifierHistoire.php" role="button">+</a></h1>
    <div >

    </div>
</div>
<div class="row">0
    <?php
        afficherHitoires();
    ?>
</div>
<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>