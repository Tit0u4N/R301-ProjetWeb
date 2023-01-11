<section class="descCardContainer" id="descCardsContainer">
    <?php
    if (isset($_GET['dev'])) {
        if ($_GET['dev'] == True) {
            $testTome1->echoHTMLDescCard();
            $testTome2->echoHTMLDescCard();
            $testTome3->echoHTMLDescCard();
            $testTome4->echoHTMLDescCard();
        }
    } else {
        foreach ($tomeArray as $tome) {
            $tome->echoHTMLDescCard();
        }
    }

    ?>
</section>