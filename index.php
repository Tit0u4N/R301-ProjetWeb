<?php



$payment = false;

require "controller/sessionController.php";
if(isset($_GET['Connexion'])){
    
    $connexionValidation = false;
    if(isset($_GET['method'])){
        if($_GET['method']=="login"){
            require "controller/conexionController.php";
        }
        else if($_GET['method']=="register"){
            require "controller/inscriptionController.php";
        }
    }
    $stylePages = [
        "view/style/styleConnexion.css"
    ];
    $scripts = [
        "view/script/connexion.js"
    ];

    $titlePage = "MangaFlow | Connexion";
    $fullNavBar = false;

    $body = "Connexion";
}
else if(isset($_GET['Payement'])) {
    $body = "Payement";
    if ($_GET['Payement'] == "Stripe"){
        $payment = true;
        require "controller/createCheckoutSession.php";
        exit;
    }
    else if ($_GET['Payement'] == "Success"){
        require "controller/payemantSuccessController.php";
    }


    $stylePages = [
        "view/style/styleBasket.css"
    ];
    $scripts = [
        "view/script/Title.js",
        "view/script/ImageCharger.js",
    ];

    $titlePage = "MangaFlow | Paiement";

    $fullNavBar = false;
}
else if (isset($_GET['Stock'])) {
    $stylePages = [
        "view/style/styleStock.css"
    ];
    $scripts = [
        "view/script/Stock.js",
        "view/script/ImageCharger.js"
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
        "view/script/basket/Article.js?version = 0.3",
        "view/script/basket/Basket.js?version = 0.3",
        "view/script/Title.js",
        "view/script/ImageCharger.js?version = 0.3",
        "view/script/script.js?version = 0.3"
    ];

    $titlePage = "MangaFlow";
    $body = "Catalog";
}

if(!$payment){
    require "mainStructure.php";
}


