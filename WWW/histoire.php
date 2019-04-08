<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres puissent les noter
 *  date : 08.04.19
 *  Version : 1.0
 *  Fichier : histoire.php
 */

session_start();
if(!isset($_SESSION["utilisateur"]))
{
    header("Location: index.php");
    exit();
}
require_once("./Controlleur/controlleur.php");

$erreurMessage = "";
$touteLescategorie = RetournerTouteLesCategories();
$titre = isset($_POST["titre"]) ? trim(filter_input(INPUT_POST,'titre',FILTER_SANITIZE_STRING)): "";
$histoire = isset($_POST["histoire"]) ?  trim(filter_input(INPUT_POST,'histoire',FILTER_SANITIZE_STRING)): "";
$categorie = isset($_POST["categorie"]) ?  trim(filter_input(INPUT_POST,'categorie',FILTER_SANITIZE_NUMBER_INT)): "";
var_dump($titre);
var_dump($histoire);
var_dump($categorie);
if($titre != "" && $histoire != "" && $categorie != "") {
    $idImage = null;
    if(isset($_FILES["image"]))
    {
        $Dossier = "/Img/";
        $extensionsAccepter = ['jpeg', 'jpg', 'png']; // Get all the file extensions
        $nomFichier = $_FILES['image']['name'];
        $tailleFichier = $_FILES['image']['size'];
        $NomTemporaire = $_FILES['image']['tmp_name'];
        $typeDeFichier = $_FILES['image']['type'];
        $extension = strtolower(end(explode('.', $nomFichier)));

        $cheminUpload =  $Dossier . basename(uniqid() . $nomFichier);
        var_dump($cheminUpload);
        if (!in_array($extension, $extensionsAccepter)) {
            $erreurMessage = "se type d'extension n'est pas accepté (jpeg,jpg,png)";
        }

        if ($tailleFichier > 5000000) { // 5000000 = 5MB
            $erreurMessage = "Ce fichier fait plus que 5 MB. il doit être moins ou égale à 5 MB";
        }

        if ($erreurMessage == "") {
            move_uploaded_file($NomTemporaire, $cheminUpload);
            $idImage = InsererImage($cheminUpload);
        }
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
<?php include_once("./navbar.php");?>
<br/>
<div class="container col-sm-12 col-md-6 c border-1">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Titre*</label>
            <input type="text" name="titre" class="form-control" value="" required>
        </div>
        <div class="form-group">
            <label>Histoire*</label>
            <textarea class="form-control" rows="5" name="histoire" required></textarea>
        </div>
        <div class="form-group">
            <label>Catégorie*</label>
            <select class="form-control" name="categorie">
            <?php
            for ($i = 0; $i < count($touteLescategorie) ; $i++) {
               echo "<option value=\"".  $touteLescategorie[$i]["idCategorie"] . "\"> " .$touteLescategorie[$i]["nomCategorie"] . "</option>";
            }
            ?>
            </select>
        </div>
        <input type="file" id="image" name="image" accept="image/*">
        <br/>
        <label style="color: red"><?php if($erreurMessage !== true){echo $erreurMessage;} ?></label>
        <small>*Champs obligatoires</small>
        <br/>
        <button type="submit" class="btn btn-primary">Ajouter une histoire</button>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>