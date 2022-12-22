<?php

// Définition des variables
//    $title = "Berserk";
//    $img = "https://www.nautiljon.com/images/manga/00/50/berserk_205.webp?1659201541";
//    $vol = "Vol. 1";
//    $price = "6.50€";


$alt = "Cover de " . $title . " " . $vol;

?>

<article class="productCard" onclick="openDescCard('<?= $id ?>')">
    <img src=<?= $img ?> alt="<?= $alt ?>">
    <h3><?= $title ?></h3>
    <h4 class="vol"><?= $vol ?></h4>
    <hr class="divider">
    <div class="priceContainer">
        <h4><?= $price ?></h4>
        <button>
            <svg viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.7625 12.2887V3.4679" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M21.0613 8.97791L17.7625 12.2887L14.4517 8.97791" stroke="white" stroke-width="2"
                      stroke-miterlimit="10"/>
                <path d="M12.2404 26.6438C13.4617 26.6438 14.4517 25.6538 14.4517 24.4326C14.4517 23.2113 13.4617 22.2213 12.2404 22.2213C11.0192 22.2213 10.0292 23.2113 10.0292 24.4326C10.0292 25.6538 11.0192 26.6438 12.2404 26.6438Z"
                      stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M22.1729 26.6438C23.3942 26.6438 24.3842 25.6538 24.3842 24.4326C24.3842 23.2113 23.3942 22.2213 22.1729 22.2213C20.9517 22.2213 19.9617 23.2113 19.9617 24.4326C19.9617 25.6538 20.9517 26.6438 22.1729 26.6438Z"
                      stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M1.20833 2.41668H4.2775C4.97909 2.41279 5.66378 2.63189 6.23279 3.04235C6.80179 3.45282 7.22569 4.03343 7.44333 4.70043L11.1408 16.7113H10.585C9.85433 16.7113 9.15358 17.0015 8.63692 17.5182C8.12026 18.0348 7.83 18.7356 7.83 19.4663V19.4663C7.83 20.1969 8.12026 20.8977 8.63692 21.4143C9.15358 21.931 9.85433 22.2213 10.585 22.2213H22.1729"
                      stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M26.5833 6.77881V8.97797L24.3721 16.7113H11.1408" stroke="white" stroke-width="2"
                      stroke-miterlimit="10"/>
            </svg>
        </button>
    </div>
</article>