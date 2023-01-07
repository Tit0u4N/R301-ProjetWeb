<?php
$alt = "Cover de " . $title;
$title = str_replace(" ", "&nbsp;", $title);
?>

<section class="manga">
    <div class="imageContainer">
        <img src="<?= $img ?>" alt="<?= $alt ?>">
    </div>
    <div class="descCardContainer">
        <div class="productTitle">
            <h3><?= $title ?></h3>
        </div>
        <div class="infoCard">
            <p>Auteur : <span><?= $author ?> </span></p>
            <p>Déssinateur : <span><?= $drawer ?> </span></p>
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
