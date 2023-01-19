<?php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="view/ressources/icons/favico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="view/ressources/icons/favico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="view/ressources/icons/favico/favicon-16x16.png">

    <link rel="stylesheet" type="text/css" href="view/style/style.css">
    <?php
    foreach ($stylePages as $page) {
        echo '<link rel="stylesheet" type="text/css" href="' . $page . '">';
    }
    ?>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title><?= $titlePage ?></title>


    <?php
    foreach ($scripts as $script) {
        echo '<script type="text/javascript" src="' . $script . '" defer></script>';
    }
    ?>

</head>
<body>
<?php require "view/component/navBar/navbar.php" ?>

<div class="corpus">
    <main>
        <?php
        if ($body == "Connexion") {
            require "view/component/connexion.php";
        } else if ($body == "Catalog") {
            require "controller/catalog.php";
            require "view/component/accountPanel.php";
        } else if ($body == "Payement") {
            require "view/component/payementPage.php";
        } else if ($body == "Stock") {
            require "view/component/stockPage.php";
        }
        //        require "view/component/catalog/catalogMangaTome.php";
        ?>

    </main>
    <?php
    require "view/component/footer.php";
    ?>
</body>

</html>
