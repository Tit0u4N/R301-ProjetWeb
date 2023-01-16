<?php
$_GET['dev'] = True;

session_start();

require "controller/conexionController.php";


if(isset($_GET['Connexion'])){
    $stylePages = [
        "view/style/styleConnexion.css",
    ];
    $scripts = [

    ];

    $titlePage = "MangaFlow | Connexion";
    $fullNavBar = false;

    $body = "Connexion";
}
else if(isset($_GET['Payement'])) {
    $stylePages = [
        "view/style/styleBasket.css",
    ];
    $scripts = [
        "view/script/Title.js"
    ];

    $titlePage = "MangaFlow | Paiement";

    $fullNavBar = false;
    $body = "Payement";
}
else if (isset($_GET['Stock'])) {
    $stylePages = [
        "view/style/styleStock.css",
    ];
    $scripts = [
        "view/script/Stock.js"
    ];

    $titlePage = "MangaFlow | Stock";

    $fullNavBar = false;
    $body = "Stock";
}
else {
    $stylePages = [
        "view/style/catalog/styleCatalog.css",
        "view/style/catalog/styleCatalogSearch.css",
        "view/style/styleBasket.css"
    ];
    $scripts = [
        "view/script/basket/Article.js",
        "view/script/basket/Basket.js",
        "view/script/Title.js",
        "view/script/script.js?version = 0.2"
    ];

    $titlePage = "MangaFlow";
    $body = "Catalog";
}

require "mainStructure.php";
