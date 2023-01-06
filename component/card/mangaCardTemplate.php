<?php
$alt = "Cover de " . $title;
$title = str_replace(" ", "&nbsp;", $title);
$desc = "Odio definitionem dapibus affert atomorum. Dicat persequeris honestatis faucibus dicam mei. Esse signiferumque vim duis inciderint corrumpit quem definitionem qui diam. Sea aperiri vidisse graece disputationi melius quam imperdiet. Parturient legere hendrerit persequeris reprehendunt vocent quas inimicus.Omittam dicat integer reprimique cetero vituperata fames decore donec viderer. Periculis falli deterruisset persecuti sodales imperdiet gloriatur. Lorem possit verear potenti quaestio nullam. Esse tantas ornatus tincidunt oporteat magna tota ex. Fuisset nihil expetendis numquam cum lorem."
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
            <p>Éditeur : <span><?= $editor ?> </span></p>
            <p>Déssinateur : <span><?= $editor ?> </span></p>
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
