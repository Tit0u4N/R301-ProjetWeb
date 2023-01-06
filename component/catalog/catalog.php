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
        if ($_GET['dev'] == True) {
            /*
            $naruto = new Manga("My heroes academia","Kishimoto Masashi","Shonen","Action");
            $testTome1 = new Tome($naruto, 1,"03/03/2000","Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/59/595.webp?1638617300","6,50",1);
            $testTome2 = new Tome($naruto, 2,"06/03/2000","Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/67/1176.webp?1585684568","6,50",2);
            $testTome3 = new Tome($naruto, -1,"06/03/2000","Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/35/mini/8653.webp?11556873652","15,50",3);
        */
        }
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
        if (isset($_GET['dev'])) {/*
            if ($_GET['dev'] == True) {

                $testTome1->echoHTMLCard();
                $testTome2->echoHTMLCard();
                $testTome3->echoHTMLCard();
                $testTome1->echoHTMLCard();
                $testTome2->echoHTMLCard();
                $testTome3->echoHTMLCard();
                $testTome1->echoHTMLCard();
                $testTome2->echoHTMLCard();
                $testTome3->echoHTMLCard();
            }*/
        }
        else {
            foreach ($tomeArray as $tome){
                $tome->echoHTMLCard();
            }
        }

    ?>


</section>
<section class="descCardsContainer" id="descCardsContainer">
    <?php
    if (isset($_GET['dev'])) {/*
        if ($_GET['dev'] == True) {

            $testTome1->echoHTMLDescCard();
            $testTome2->echoHTMLDescCard();
            $testTome3->echoHTMLDescCard();
        }*/
    }
    else {
        foreach ($tomeArray as $tome){
            $tome->echoHTMLDescCard();
        }
    }

    ?>

</section>

<?php require "component/basket/basketCard.php";
