<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 05.04.19
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
$nouveauNom = isset($_POST["nom"]) ? trim(filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING)): "";
$nouvelEmail = isset($_POST["email"]) ? trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL)): "";
$mdp = isset($_POST["motDePasse"]) ? trim(filter_input(INPUT_POST,'motDePasse',FILTER_SANITIZE_STRING)): "";
$nouveauMdp = isset($_POST["nouveauMotDePasse"]) ? trim(filter_input(INPUT_POST,'nouveauMotDePasse',FILTER_SANITIZE_STRING)): "";
$confMdp = isset($_POST["confirmerNouveauMotDePasse"]) ? trim(filter_input(INPUT_POST,'confirmerNouveauMotDePasse',FILTER_SANITIZE_STRING)): "";
if($nouveauNom != "" && $nouvelEmail != "" && $mdp != "")
{
    if($nouvelEmail == $_SESSION["utilisateur"] || !UtilisateurExiste($nouvelEmail))
    {
        $erreurMessage = ModifierUtilisateurParEmail($nouveauNom,$_SESSION["utilisateur"],$nouvelEmail,$mdp,$nouveauMdp,$confMdp);
        if($erreurMessage === true)
        {
            $_SESSION["utilisateur"] = $nouvelEmail;
            header("location: index.php");
            exit();
        }
        elseif ($erreurMessage !== false)
        {
            $_SESSION["utilisateur"] = $nouvelEmail;
            $erreurMessage = "le mot de passe n'a pas été modifier car : " . $erreurMessage;
        } else
        {
            $erreurMessage = "le mot de passe est faux";
        }
    }else
    {
        $erreurMessage = "cette email existe déja";
    }
}
$utilisateur =  RetournerUtilisateur($_SESSION["utilisateur"]);
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
    <link rel="stylesheet" type="text/css"  href="MyCss.css">
    <title>Hello, world!</title>
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
<div class="container mb-5">
    <h1>Mes histoires</h1>
    <a class="col-6 btn btn-primary btn-lg" href="#" role="button">Ajouter une Histoire</a>
</div>
<div class="row">
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>