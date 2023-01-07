<?php
if(isset($_GET['categories'])&&isset($_GET['search'])){
    if($_GET['categories'] == 'type'){
        ?>
        <h2><?= $_GET['search']?>:</h2>
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