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

    <script type="text/javascript" src="view/script/basket/Article.js" defer></script>
    <script type="text/javascript" src="view/script/basket/Basket.js" defer></script>

    <script type="text/javascript" src="view/script/Title.js" defer></script>
    <script type="text/javascript" src="view/script/script.js?version = 0.2" defer></script>

</head>
<body>
<?php require "view/component/navBar/navbar.php" ?>

<main>
    <?php
        if($body == "Connexion"){
            require "view/component/connexion.php";
        }
        elseif ($body == "Catalog"){
            require "controller/catalog.php";
            require "view/component/basket/basketPanel.php";
            require "view/component/accountPanel.php";
        }
    ?>

    <?php ?>
</main>
<?php 
echo $test1."\n";
echo $test2."\n";
echo $test3."\n";
?>
</body>

</html>
