<section class="descCardContainer" id="descCardsContainer">
    <?php

    foreach ($tomeArray as $tome) {
        $tome->echoHTMLDescCard();
    }


    ?>
</section>