<?php
    require "Tome.php";

    function transformSearchQuery(String $search){
        $searchTab = array();
        $searchTab = str_split($search);
        return str_replace("'","''","%".implode("%",$searchTab)."%");
    }

    function searchManga(String $search){
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');
        $mangaSQL = $pdo->query("SELECT DISTINCT (m.idManga) FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre LIKE '".$search."' OR m.titreManga LIKE '".$search."')")->fetchAll()[0];

        return new Manga($mangaSQL[0]);

    }



    if (isset($_GET['dev'])) {
        
    }
    else{
        
        if(isset($_GET['categories'])&&isset($_GET['search'])){
            if($_GET['categories'] == "Manga"){
                $manga = searchManga($_GET['search']);
                $tomeArray = $manga->getTomes();
            }
        }
        else{
            $index = rand(1,18);
            $manga = new Manga($index);
            $tomeArray = $manga->getTomes();
            
        }
    }

    if(isset($_GET['categories'])&&isset($_GET['search'])){
        ?>
        <h2>
            <?php
                echo $manga->getTitle().":";
            ?>
        </h2>
        <?php
    }
    else{
        ?>
        <h2>Selection :</h2>
        <?php
    }

    ?>


    <section class="catalog">
    <?php
        foreach ($tomeArray as $tome) {
            $tome->echoHTMLCard();
        }
    ?>
    </section>


    <section class="descCardsContainer" id="descCardsContainer">

    <?php
        foreach ($tomeArray as $tome) {
            $tome->echoHTMLDescCard();
        }
    ?>

    </section>

<?php require "component/basket/basketPanel.php";
