<?php
require_once "./Controlleur/Controleurleur.php";
$erreurmessage = "";
$nom = isset($_POST["nom"]) ? filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING): "";
$email = isset($_POST["email"]) ? filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL): "";
$mdp = isset($_POST["motDePasse"]) ? filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING): "";
$confMdp = isset($_POST["confirmerMotDePasse"]) ? filter_input(INPUT_POST,'confirmerMotDePasse',FILTER_SANITIZE_STRING): "";
if($nom != "" && $email != "" && $mdp != "" && $confMdp != "")
{
    if(AjouterUtilisateur($nom,$email,$mdp,$confMdp) === true)
    {

    }
    else{
        $php_errormsg =
    }
}
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
<body>
<br/>
<div class="container col-xl-6 border-1">
<form action="#" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Mot de passe</label>
        <input type="password" class="form-control" name="motDePasse" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirmer mot de passe</label>
        <input type="password" class="form-control" name="confirmerMotDePasse" required>
    </div>
    <label style="color: red"><?= $erreurmessage ?></label>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>