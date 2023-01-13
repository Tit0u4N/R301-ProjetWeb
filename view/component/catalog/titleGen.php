<?php
if(isset($_GET['categories'])&&isset($_GET['search'])){
    if($_GET['categories'] == 'categorie'){
        if($_POST['subtitle'] == true ){
            ?>
            <h3><?= $_POST['title']?>:</h3>
        <?php
        }
        else{
            ?>
            <h2 class="sectionTitle"><?= $_POST['title']?>:</h2>
        <?php
        }
    }
    else if($_GET['categories'] == 'type'||$_GET['categories'] == 'genre'||$_GET['categories'] == 'editeur'||$_GET['categories'] == 'categorie'){
        ?>
        <h2 class="sectionTitle"><?= $_POST['title']?>:</h2>
        <h3><?= $_POST['title']?>:</h3>
        <?php
    }
    else if($_GET['categories'] == 'drawer'){
        ?>
        <h2>Dessinateur:</h2>
        <?php
    }
    else{
        ?>
        <h2><?= $_GET['categories']?>:</h2>
        <?php
        }
    }
else{
    ?>
    <h2>Selection :</h2>
    <?php
}