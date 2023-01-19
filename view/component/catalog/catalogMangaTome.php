<?php
    //todo devMod
    if (isset($_GET['dev'])){
        $manga = new Manga(0);
    }
?>
<div class="mangaContainer">
    <?php
        $manga->echoHTMLCardDesc();
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