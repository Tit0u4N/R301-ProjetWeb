<?php

// Définition des variables
//    $title = "Code Geass - Lelouch of the Rebellion";
//    $img = "https://www.nautiljon.com/images/manga/00/50/berserk_205.webp?1659201541";
//    $vol = "Vol. 1";
//    $price = "6.50€";
//    $id = 1;


$alt = "Cover de " . $title . " " . $vol;

require "component/card/formatTitle.php"

?>

<article class="productCard" id="<?= $id ?>" >
    <img src=<?= $img ?> alt="<?= $alt ?>" onclick="openPanel('<?= $idDescCard ?>')">
    <div class="productTitle">
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $vol ?></h4>
    </div>
    <hr class="divider">
    <div class="priceContainer">
        <h4><?= $price ?></h4>
        <button onclick="panier.addArticle('<?= $id ?>')">
            <img src="/ressources/icons/basket.svg">
        </button>
    </div>
</article>