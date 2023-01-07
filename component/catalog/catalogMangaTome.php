<?php
    require "component/catalog/catalog.php";

?>
<div class="mangaContainer">
    <?php
        if (isset($_GET['dev'])) {
            if ($_GET['dev'] == True) {
                $JJK->echoHTMLCard();
            }
        }
    ?>
    <section class="catalog carousselMod">
        <?php require "component/catalog/catalogTome.php"; ?>
    </section>

    <hr class="divider">
</div>
<?php require "component/catalog/catalogDescCard.php"; ?>