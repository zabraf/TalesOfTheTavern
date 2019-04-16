<!--
 *  auteur : Raphael Lopes
 *  Projet : Tales of the Tavern
 *  description : Site internet permettant de stocker des histoires et que les autres utilisateurs puissent les noter
 *  date : 04.04.19
 *  Version : 1.0
 *  Fichier : navbar.php
-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php" ><img src="Img/TalesOfTheTavern.svg" style="width: 300px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <?php
            if(isset($_SESSION["utilisateur"]))
            {
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="./compte.php">Mon compte<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="deconnecter.php">Déconnecter<span class="sr-only">(current)</span></a>
                </li>
                <?php
            } else {
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="connexion.php">Se connecter<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="creerCompte.php">Créer un compte<span class="sr-only">(current)</span></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="rechercher.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" name="recherche">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
    </div>
</nav>