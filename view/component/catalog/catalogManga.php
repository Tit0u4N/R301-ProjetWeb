<div class="mangaContainer">
    <section class="catalog classicMod">
        <?php
            foreach ($mangaArray as $manga) {
                $manga->echoHTMLCard();
            }
        ?>
    </section>
    <hr class="divider">
</div>

