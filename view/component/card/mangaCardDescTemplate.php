<?php
$alt = "Cover de " . $title;
$title = str_replace(" ", "&nbsp;", $title);
$title = str_replace("-", "&#8209;", $title);

?>

<section class="manga">
    <div class="imageContainer">
        <img src="" data-src="<?= $img ?>"alt="<?= $alt ?>">
    </div>
    <div class="descCardContainer">
        <div class="productTitle">
            <h3><?= $title ?></h3>
        </div>
        <div class="infoCard">
            <?php 
            if(!empty($titleAlt)){
                ?>
                <p>Titres alternatifs : <span><?= $titleAlt ?> </span></p>
                <?php
            }?>
            <p>Auteur : <span><?= $author ?> </span></p>
            <p>Dessinateur : <span><?= $drawer ?> </span></p>
            <p>Éditeur : <span><?= $editor ?> </span></p>
            <p>Type : <span><?= $type ?> </span></p>
            <p>Genre : <span><?= $genre ?> </span></p>
        </div>
        <div class="synopsisCard">
            <h4> Synopsis :</h4>
            <p>
                <?= $desc ?>
            </p>
        </div>

    </div>

</section>
