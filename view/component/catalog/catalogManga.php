<?php

?>

<section class="catalog classicMod">
    <?php
        foreach ($mangaArray as $manga) {
            $manga->echoHTMLCard();
        }
    ?>
</section>

