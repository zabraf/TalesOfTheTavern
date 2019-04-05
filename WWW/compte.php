<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : compte.php
 */
require_once("./Controlleur/controlleur.php");
session_start();
$erreurMessage = "";

if(!isset($_SESSION["utilisateur"]))
{
    header("location: index.php");
    exit();
}
$utilisateur =  RetrouverUtilisateur($_SESSION["utilisateur"]);
var_dump($utilisateur);
$nom = $utilisateur["nom"];
$email = $utilisateur["email"];
?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<div>
<?php include_once("./navbar.php");?>
<div class="container col-sm-12 col-md-6 c border-1">
    <form action="#" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= $nom ?>" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" name="email" value="<?= $email ?>" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" name="motDePasse" required>
            <small>Le mot de passe doit contenir au moins 8 caractères et au moins 1 chiffre</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmer mot de passe</label>
            <input type="password" class="form-control" name="confirmerMotDePasse" required>
        </div>
        <label style="color: red"><?php if($erreurMessage !== true){echo $erreurMessage;} ?></label>
        <br/>
        <button type="submit" class="btn btn-primary">Mettre a jour les informations</button>
    </form>
</div>
<div class="container col-12"></div>
    <div class="row">
        <div class="card col-12 col-sm-4">
            <h1 class="display-4">Titre</h1>
            <p class="lead">Auteur</p>
            <p>HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE ...</p>
            <div class="row">
                <a class="col-6 btn btn-primary btn-lg" href="#" role="button">Modifier</a><a class=" col-6 btn btn-danger btn-lg" href="#" role="button">Supprimer</a>
            </div>
        </div>
        <div class="card col-12 col-sm-4">
            <h1 class="display-4">Titre</h1>
            <p class="lead">Auteur</p>
            <p>HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE ...</p>
            <div class="row">
                <a class="col-6 btn btn-primary btn-lg" href="#" role="button">Modifier</a><a class=" col-6 btn btn-danger btn-lg" href="#" role="button">Supprimer</a>
            </div>
        </div>
        <div class="card col-12 col-sm-4">
            <h1 class="display-4">Titre</h1>
            <p class="lead">Auteur</p>
            <p>HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE HISTOIRE ...</p>
            <div class="row">
                <a class="col-6 btn btn-primary btn-lg" href="#" role="button">Modifier</a><a class=" col-6 btn btn-danger btn-lg" href="#" role="button">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>