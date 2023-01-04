<?php
    require "Tome.php";



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
            $index = rand(1,17);

            $mangaTest = new Manga($index);

            $mysqli = new mysqli("165.227.152.225", "p2", "FicsiT22!", "db",3306);
            $tomeArray = array();
            $result = $mysqli->query("SELECT p.idProduit FROM PRODUIT p WHERE p.idManga =".$mangaTest->getId());
            $tome = $result->fetch_all();
            foreach($tome as $row){
                array_push($tomeArray,new Tome($row[0]));
            }

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
