<?php
?>
<section id="basket" class="default-panel hide">
    <button onclick="closePanel()"><span class="material-symbols-outlined">arrow_forward_ios</span></button>
    <h2>Panier :</h2>
    <div>
        <div class="caroussel">
            <?php
            foreach($basket as $product){
                $product[0]->echoHTMLCardBasket($product[1]);
            }
            ?>

        </div>
        <article id="totalBasket">
            <div>
                <div>
                    <div>
                        <p>Total du panier</p>
                        <span>Article :</span>
                    </div>
                    <h4></h4>
                </div>
                <form action="index.php?Payement=Stripe" method="POST">
            <button type="submit" id="checkout-button"><span>Payer</span></button>
        </form>
            </div>
        </article>
    </div>
</section>