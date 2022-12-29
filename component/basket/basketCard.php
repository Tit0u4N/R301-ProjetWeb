<?php

?>
<section id="basket">
    <h2>Panier :</h2>
    <div>
        <div class="caroussel">
            <?php
            if (isset($_GET['dev'])) {
                if ($_GET['dev'] == True) {
                    $testTome1->echoHTMLCard();
                    $testTome2->echoHTMLCard();
                    $testTome3->echoHTMLCard();
                }
            }
            ?>
        </div>
    </div>
</section>