<?php
/*  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 08.04.19
 *  Version : 1.0
 *  Fichier : modifierHistoire.inc.php
 */
$titreHistoire = "";
$chaineHistoire = "";
$categorieHistoire = "";
$imageHistoire = "";
$texteButton = "Ajouter une histoire";
$idImage = null;

if(isset($_GET["id"]))
{
    $idHistoire = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));
    $texteButton = "Modifier l'histoire";
    $histoire = RetournerHistoireParId($idHistoire);
    if ($histoire === null || strtolower($histoire["email"]) != strtolower($_SESSION["utilisateur"]))
    {
        header("Location: compte.php");
        exit();
    }
    $titreHistoire = $histoire["titre"];
    $chaineHistoire = $histoire["histoire"];
    $categorieHistoire = $histoire["idCategorie"];
    $idImage = $histoire["idImage"];
}
$erreurMessage = "";
$titre = isset($_POST["titre"]) ? trim(filter_input(INPUT_POST,'titre',FILTER_SANITIZE_STRING)): "";
$histoire = isset($_POST["histoire"]) ?  trim(filter_input(INPUT_POST,'histoire',FILTER_SANITIZE_STRING)): "";
$categorie = isset($_POST["categorie"]) ?  trim(filter_input(INPUT_POST,'categorie',FILTER_SANITIZE_NUMBER_INT)): "";
if($titre != "" && $histoire != "" && $categorie != "") {
    if($_FILES["image"]["error"] != 4) // verifie si utilisateur a mis une image ou non
    {
        $Dossier = "Img/";
        $extensionsAccepter = ['jpeg', 'jpg', 'png'];
        $nomFichier = $_FILES['image']['name'];
        $tailleFichier = $_FILES['image']['size'];
        $NomTemporaire = $_FILES['image']['tmp_name'];
        $typeDeFichier = $_FILES['image']['type'];
        $extension = explode('.', $nomFichier);
        $extension = strtolower(end($extension));
        $nomFichier = uniqid() . $nomFichier;
        $cheminUpload =  $Dossier . basename($nomFichier);
        if (!in_array($extension, $extensionsAccepter)) {
            $erreurMessage = "ce type d'extension n'est pas accepté (jpeg, jpg, png)";
        }

        if ($tailleFichier > 5000000) { // 5000000 = 5MB
            $erreurMessage = "Ce fichier fait plus que 5 Mb. Il doit être moins ou égal à 5 Mb.";
        }
        if ($erreurMessage == "" && $_FILES["image"]["error"] == 0) {
            var_dump($cheminUpload);
           move_uploaded_file($NomTemporaire, $cheminUpload);
           $idImage = InsererImage($nomFichier);
        }
    }

    //TODO Modifier gestion d'erreur
    if(isset($_GET["id"]))
    {
       ModifierHistoire($idHistoire,$titre,$histoire,$idImage,$categorie);
    }
    else
    {
        InsererHistoire($titre,$histoire,$idImage,$categorie,$_SESSION["utilisateur"]);
    }
    /*if($erreurMessage == "")
    {*/
       header("Location: compte.php");
       exit();
    //}


}
/** affiche tout les catégorie dans la base
 *
 */
function AfficherTouteLesCategorie()
{
    $touteLescategorie = RetournerTouteLesCategories();
    for ($i = 0; $i < count($touteLescategorie) ; $i++) {
        echo "<option value=\"".  $touteLescategorie[$i]["idCategorie"] . "\"> " .$touteLescategorie[$i]["nomCategorie"] . "</option>";
    }
}

/** affiche tout les catégorie dans la base avec un selectioner
 * @param $id int id de la catégorie
 */
function AfficherTouteLesCategorieAvecUneSelectioner($id)
{
    $touteLescategorie = RetournerTouteLesCategories();
    for ($i = 0; $i < count($touteLescategorie) ; $i++) {
        if($id == $touteLescategorie[$i]["idCategorie"])
        {
            echo "<option value=\"".  $touteLescategorie[$i]["idCategorie"] . "\" selected > " .$touteLescategorie[$i]["nomCategorie"] . "</option>";
        }
        else
        {echo "<option value=\"".  $touteLescategorie[$i]["idCategorie"] . "\"> " .$touteLescategorie[$i]["nomCategorie"] . "</option>";

        }
    }
}
