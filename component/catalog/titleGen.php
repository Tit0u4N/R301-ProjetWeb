<?php
if(isset($_GET['categories'])&&isset($_GET['search'])){
    if($_GET['categories'] == 'type'){
        ?>
        <h2><?= $_POST['title']?>:</h2>
        <?php
    }
    else if($_GET['categories'] == 'drawer'){
        ?>
        <h2>Dessinateur:</h2>
        <?php
    }
    else if($_GET['categories'] == 'genre'){
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