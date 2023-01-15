<?php
//$_GET['dev'] = True;

session_start();




if(isset($_GET['Connexion'])){
    if(isset($_GET['method'])){
        if($_GET['method']=="login"){
            require "controller/conexionController.php";
        }
        else if($_GET['method']=="register"){
            require "controller/inscriptionController.php";
        }
    }
    $connexionValidation = false;
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
