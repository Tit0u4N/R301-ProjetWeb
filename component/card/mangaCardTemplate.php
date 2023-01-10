<?php
// Définition des variables
    $title = "Code Geass - Lelouch of the Rebellion";
    $img = "https://www.nautiljon.com/images/manga/00/50/berserk_205.webp?1659201541";
    $editor = "kana";
    $id = "test";
    $alt = "Cover de " . $title . " " ;

    require "component/card/formatTitle.php"
?>

<a class="productCard" id="<?= $id ?>" href="" >
    <img src="" data-src="<?= $img ?>"alt="<?= $alt ?>">
    <div class="productTitle">
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $editor ?></h4>
    </div>
</a>
