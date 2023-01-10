<?php

//
//        $title = "Berserk";
//        $img = "https://www.nautiljon.com/images/manga/00/50/berserk_205.webp?1659201541";
//        $price = "8.50€";
//        $vol = "Vol. 1";
//        $author = "Syouko Kinugasa";
//        $editor = "Kana";
//        $publicationDate = "12/02/2019";
//        $type = "Seinen";
//        $genre = "Shool Life";
//        $desc = "Yōkoso jitsuryoku shijō shugi no kyōshitsu e, abrégée Youzitsu, est une série de light novel
//                japonais écrite par Shōgo Kinugasa et illustrée par Shunsaku Tomose. Media Factory a publié dix-huit
//                volumes depuis 2015 dans leur collection MF Bunko J. La série est aussi appelée Classroom of the
//                Elite à l'étranger.";
//


    $alt = "Cover de ".$title." ".$vol;

require "component/card/formatTitle.php"

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
            <button class="priceContainer">
                <h4><?= $price ?></h4>
                <div>
                    <img src="" data-src="/ressources/icons/basket.svg">
                </div>
            </button>
        </section>

    </article>

