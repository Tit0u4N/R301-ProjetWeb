<?php

// Définition des variables
//    $title = "Berserk";
//    $img = "https://www.nautiljon.com/images/manga/00/50/berserk_205.webp?1659201541";
//    $vol = "Vol. 1";
//    $price = "6.50€";


$alt = "Cover de " . $title . " " . $vol;
$title = str_replace(" ","&nbsp;",$title);

?>

<article class="productCard" onclick="openDescCard('<?= $id ?>')">
    <img src=<?= $img ?> alt="<?= $alt ?>">
    <div class="titleCard">
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $vol ?></h4>
    </div>
    <hr class="divider">
    <div class="priceContainer">
        <h4><?= $price ?></h4>
        <button>
            <img src="../../../ressources/icons/basket.svg">
        </button>
    </div>
</article>