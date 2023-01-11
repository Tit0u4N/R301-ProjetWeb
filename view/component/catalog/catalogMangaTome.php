<?php

?>
<div class="mangaContainer">
    <?php
        if (isset($_GET['dev'])) {
            if ($_GET['dev'] == True) {
                $JJK->echoHTMLCardDesc();
            }
        }
        else{
            $manga->echoHTMLCardDesc();
        }
    ?>
    <section class="catalog carousselMod">
        <?php 
        $tomeArray = $manga->getTomes();
        require "view/component/catalog/catalogTome.php";
        ?>
    </section>

    <hr class="divider">
</div>
<?php require "view/component/catalog/catalogDescCard.php"; ?>