<?php
if (isset($_GET['dev'])) {
    if ($_GET['dev'] == True) {

        $testTome1->echoHTMLCard();
        $testTome2->echoHTMLCard();
        $testTome3->echoHTMLCard();
        $testTome4->echoHTMLCard();
        $testTome1->echoHTMLCard();
        $testTome2->echoHTMLCard();
        $testTome3->echoHTMLCard();
        $testTome4->echoHTMLCard();
        $testTome1->echoHTMLCard();
        $testTome2->echoHTMLCard();
        $testTome3->echoHTMLCard();
        $testTome4->echoHTMLCard();

    }
} else {

    foreach ($tomeArray as $tome) {
        $tome->echoHTMLCard();
    }
}

?>