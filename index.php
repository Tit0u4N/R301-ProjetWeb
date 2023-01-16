<?php
$_GET['dev'] = True;

session_start();

require "controller/conexionController.php";


if(isset($_GET['Connexion'])){
    $stylePages = [
        "view/style/styleConnexion.css",
    ];

    $titlePage = "MangaFlow | Connexion";
    $fullNavBar = false;

    $body = "Connexion";
}
else if(isset($_GET['Payement'])) {
    $stylePages = [
        "view/style/styleBasket.css",
    ];

    $titlePage = "MangaFlow | Paiement";

    $fullNavBar = false;
    $body = "Payement";
}
else {
    $stylePages = [
        "view/style/catalog/styleCatalog.css",
        "view/style/catalog/styleCatalogSearch.css",
        "view/style/styleBasket.css",
    ];

    $titlePage = "MangaFlow";
    $body = "Catalog";
}

require "mainStructure.php";
