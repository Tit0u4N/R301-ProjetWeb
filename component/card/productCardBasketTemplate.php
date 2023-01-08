<?php

$alt = "Cover de " . $title . " " . $vol;
$title = str_replace(" ", "&nbsp;", $title);
$title = str_replace("-", "&#8209;", $title);

//require "component/card/formatTitle.php"
?>

<article class="productCard" id="<?= $id ?>">
    <img src="" data-src="<?= $img ?>"alt="<?= $alt ?>">
    <div class="productTitle">
        <h4><?= "kana" ?></h4>
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $vol ?></h4>
    </div>
    <div class="productCounter">
        <div>
            <button>
                <rect>&nbsp;</rect>
            </button>
            <div><h4><?= rand(1, 9) ?></h4></div>
            <button>
                <rect>&nbsp;</rect>
                <rect>&nbsp;</rect>
            </button>
        </div>
    </div>
    <div class="priceContainer">
        <h4><?= $price ?></h4>
    </div>
</article>
