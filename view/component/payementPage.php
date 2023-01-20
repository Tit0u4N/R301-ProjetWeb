<?php

if(!isset($_SESSION['userId'])){
    header("Location: index.php?Connexion");
    exit;
}
else{
    ?>
    <section class="basketContainer">
        <h2>Panier :</h2>
    <div id="basket">
        <div>
            <div class="caroussel">
                <?php

    //                if (isset($_GET["dev"])){
    //
    //                    foreach ($tomeArray as $tome){
    //                        $tome->echoHTMLCardBasket();
    //
    //                    }
    //                }
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
                </div>
            </article>
        </div>
    </div>
    <div>
        <form action="index.php?Payement=Stripe" method="POST">
            <button type="submit" id="checkout-button">Checkout</button>
        </form>
    </div>
    </section>
<?php
}