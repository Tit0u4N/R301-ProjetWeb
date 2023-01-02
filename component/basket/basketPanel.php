<?php

?>
<section id="basket" class="default-panel ">
    <button onclick="closePanel()"><span class="material-symbols-outlined">arrow_forward_ios</span></button>
    <h2>Panier :</h2>
    <div>
        <div class="caroussel">
            <?php
            if (isset($_GET['dev'])) {
                if ($_GET['dev'] == True) {
                    $testTome1->echoHTMLCardBasket();
                    $testTome2->echoHTMLCardBasket();
                    $testTome3->echoHTMLCardBasket();
                    $testTome1->echoHTMLCardBasket();
                    $testTome2->echoHTMLCardBasket();
                    $testTome3->echoHTMLCardBasket();
                }
            }
            ?>
        </div>
        <article id="totalBasket">
            <div>
                <div>
                    <div>
                        <p>Total du panier</p>
                        <span>Article : <?= rand(0,9) ?></span>
                    </div>
                    <h4><?= rand(1,9) . rand(0,9) . "," . rand(0,9) . "0€" ?> </h4>
                </div>
                <button><span>Payer</span></button>
            </div>
        </article>
    </div>
</section>