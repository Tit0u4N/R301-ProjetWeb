<?php
//$_GET['dev'] = True;

session_start();

//require "controller/conexionController.php";


if(isset($_GET['Connexion'])){
    $stylePages = [
        "view/style/styleConnexion.css",
    ];

    $titlePage = "MangaFlow | Connexion";
    $fullNavBar = false;

    $body = "Connexion";
}
else {
    $stylePages = [
        "view/style/catalog/styleCatalog.css",
        "view/style/catalog/styleCatalogSearch.css",
        "view/style/styleBasket.css"
    ];

    $titlePage = "MangaFlow";
    $body = "Catalog";
}

if($connexionValidation){
    echo "Connexion Validation " . $email . " mdp " . $password;

}

require "mainStructure.php";
