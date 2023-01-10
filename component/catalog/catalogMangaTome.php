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
        require "component/catalog/catalogTome.php"; 
        ?>
    </section>

    <hr class="divider">
</div>
<?php require "component/catalog/catalogDescCard.php"; ?>