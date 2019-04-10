<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 08.04.19
 *  Version : 1.0
 *  Fichier : modifierHistoire.php
 */

session_start();
if(!isset($_SESSION["utilisateur"]))
{
    header("Location: index.php");
    exit();
}
require_once("./Controlleur/controlleur.php");
require_once("./Controlleur/ModifierHistoire.inc.php");

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
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Titre*</label>
            <input type="text" name="titre" class="form-control" value="<?= $titreHistoire ?>" required>
        </div>
        <div class="form-group">
            <label>Histoire*</label>
            <textarea class="form-control" rows="5" name="histoire" required> <?= $chaineHistoire ?> </textarea>
        </div>
        <div class="form-group">
            <label>Catégorie*</label>
            <select class="form-control" name="categorie">
                <?php
                if(isset($_GET["id"]))
                {
                    AfficherTouteLesCategorieAvecUneSelectioner($categorieHistoire);
                }
                else
                {
                    AfficherTouteLesCategorie();
                }
                ?>
            </select>
        </div>
        <input type="file" id="image" name="image" accept="image/*">
        <br/>
        <label style="color: red"><?php if($erreurMessage !== true){echo $erreurMessage;} ?></label>
        <small>*Champs obligatoires</small>
        <br/>
        <button type="submit" class="btn btn-primary"><?= $texteButton ?></button>
    </form>
</div>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>