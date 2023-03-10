<?php

$alt = "Cover de " . $title . " " . $vol;

require "view/component/card/formatTitle.php"

?>

<article class="productCard" id="<?= $id ?>" >
    <div class="imageContainer">
        <img src="" data-src="<?= $img ?>"alt="<?= $alt ?>" onclick="openPanel('<?= $idDescCard ?>')">

    </div>
    <div class="productTitle">
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $vol ?></h4>
    </div>
    <hr class="divider">
    <div class="priceContainer">
        <h4><?= $price ?></h4>
        <button onclick="basket.addArticle('<?= $id ?>')">
            <img src="" data-src="view/ressources/icons/basket.svg">
        </button>
    </div>
</article>