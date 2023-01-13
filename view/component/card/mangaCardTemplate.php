<?php
// Définition des variables
    $id = "test";
    $alt = "Cover de " . $title . " " ;

require "view/component/card/formatTitle.php"
?>

<a class="productCard" id="<?= $id ?>" href="" >
    <div class="imageContainer">
        <img src="" data-src="<?= $img ?>"alt="<?= $alt ?>">
    </div>
    <div class="productTitle">
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $editor ?></h4>
    </div>
</a>
