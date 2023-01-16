<?php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="view/style/style.css">
    <?php
        foreach($stylePages as $page){
            echo '<link rel="stylesheet" type="text/css" href="' . $page . '">';
        }
    ?>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title><?= $titlePage ?></title>


    <?php
    foreach($scripts as $script){
        echo '<script type="text/javascript" src="' . $script . '" defer></script>';
    }
    ?>
<!--    <script type="text/javascript" src="view/script/basket/Article.js" defer></script>-->
<!--    <script type="text/javascript" src="view/script/basket/Basket.js" defer></script>-->
<!---->
<!--    <script type="text/javascript" src="view/script/Title.js" defer></script>-->
<!--    <script type="text/javascript" src="view/script/script.js?version = 0.2" defer></script>-->
<!--    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>-->
<!--    <script type="text/javascript" src="view/script/Stock.js"></script>-->

</head>
<body>
<?php require "view/component/navBar/navbar.php" ?>

<main>
    <?php
        if($body == "Connexion"){
            require "view/component/connexion.php";
        }
        else if ($body == "Catalog"){
            require "controller/catalog.php";
            require "view/component/accountPanel.php";
        }
        else if ($body == "Payement") {
            require "view/component/payementPage.php";
        }
        else if ($body == "Stock"){
            require "view/component/stockPage.php";
        }
    ?>

</main>

</body>

</html>
