<?php
$_GET['dev'] = True;
$__DIR__ = '/'
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/catalog/styleCatalog.css">
    <link rel="stylesheet" type="text/css" href="style/catalog/styleCatalogSearch.css">
    <link rel="stylesheet" type="text/css" href="style/styleBasket.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>MangaFlow</title>
    <script src="script/script.js"></script>
</head>
<body>
<?php require "component/navBar/navbar.php" ?>


<main>
    <h2>Selection :</h2>
    <?php require "component/catalog/catalogManga.php" ?>
    <?php require "component/catalog/catalogMangaTome.php" ?>

    <?php require "component/basket/basketPanel.php";?>
</main>
</body>
<script>
    window.onresize = () => {
        console.log("boot")
    }
    Title.createTitles()
    setTimeout(() => {
        Title.autoSizeTitles()
    }, 50)

    window.onresize = () => {
        if(window.screen.width < 1201)
            Title.autoSizeTitles()
    }

    let panier = new Basket();

    let images = document.querySelectorAll("main img")

    const imageLoader = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting)
                entry.target.src = entry.target.dataset.src;
            else
                entry.target.src = "";
        })
    })

    imageLoader.root = document.querySelector("main")

    images.forEach(img => imageLoader.observe(img))

    // test = document.querySelector("main > .catalog .productCard .productTitle > h3 ")
    // console.log(test + " : " + title.splitSpan(test))
    // test = document.querySelector("main > .catalog .productCard .productTitle")
    // test = window.getComputedStyle(test, null).paddingLeft;
    // console.log(test)
</script>
</html>
