<?php
    $alt = "Cover de ".$title." ".$vol;

require "view/component/card/formatTitle.php"

?>
    <article class="default-panel productCard hide" id="<?= $id ?>">
        <button onclick="closePanel()"><span class="material-symbols-outlined">arrow_forward_ios</span></button>
        <section class="headerCardFull">
            <div>
                <div class="productTitle">
                    <h3><?= $title ?> </h3>
                    <h4 class="vol"><?= $vol ?> </h4>
                </div>
                <div class="infoCard">
                    <p>Auteur : <span><?= $author ?> </span></p>
                    <p>Éditeur : <span><?= $editor ?> </span></p>
                    <p>Date de parution : <span><?= $publicationDate ?> </span></p>
                    <p>Type : <span><?= $type ?> </span></p>
                    <p>Genre : <span><?= $genre ?> </span></p>
                </div>
            </div>
            <div class="imageContainer">
                <img src="" data-src="<?= $img ?>" alt="<?= $alt ?>">
            </div>
        </section>
        <section class="synopsisCard">
            <h4> Synopsis :</h4>
            <p>
                <?= $desc ?>
            </p>
        </section>
        <section>
            <button class="priceContainer" onclick="basket.addArticle('<?= $id ?>')">
                <h4><?= $price ?></h4>
                <div>
                    <img src="" data-src="view/ressources/icons/basket.svg">
                </div>
            </button>
        </section>

    </article>

