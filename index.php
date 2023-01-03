<?php
    //$_GET['dev'] = True;
    $__DIR__ = '/';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/styleMainPage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>MangaFlow</title>
    <script src="script/script.js"></script>
</head>
<body>
<?php require "component/navBar/navbar.php" ?>
<main>
    <h2>Selection :</h2>
    <?php require "component/catalog/catalog.php" ?>
</main>
</body>
<script>
    autoFontSizeTitle()
    setTimeout(() => {
        autoFontSizeTitle()
    },1)
    window.onresize = () => {
        console.log(window.screen.height)
        autoFontSizeTitle()
    }
</script>
</html>
