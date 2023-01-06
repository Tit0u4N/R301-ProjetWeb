<?php
    require "Tome.php";

    function transformSearchQueryAll(String $search){
        $searchTab = str_split($search);
        foreach($searchTab as $key => $val){
            if(preg_match("/[a-zA-Z]/",$val)){
                $searchTab[$key] = "(".strtoupper($val)."|".strtolower($val).")";
            }
        }
        $searchTemp = implode("",$searchTab);
        $searchTab = explode(" ", $searchTemp);
        if(strlen($search)<=2){
            return str_replace("'","''","^".implode(".*",$searchTab).".*");
        }
        else{
            return str_replace("'","''",implode(".*",$searchTab).".*");
        }
    }

    function transformSearchQueryInitials(String $search){
        $searchTab = str_split($search);
        foreach($searchTab as $key => $val){
            if(preg_match("/[a-zA-Z]/",$val)){
                $searchTab[$key] = "(".strtoupper($val)."|".strtolower($val).")";
            }
        }
        return str_replace("'","''","^(.* )?".implode(".*(-| )",$searchTab).".*");
    }


    function searchManga(String $search){
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');

        $searchQuery = transformSearchQueryInitials($search);
        $mangaSQL = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '".$searchQuery."' OR m.titreManga REGEXP '".$searchQuery."') ORDER BY m.titreManga")->fetchAll();



        $searchQuery = transformSearchQueryAll($search);
        $mangaSQLAll = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '".$searchQuery."' OR m.titreManga REGEXP '".$searchQuery."') ORDER BY m.titreManga")->fetchAll();
        
        foreach($mangaSQLAll as $key => $val){
            if(!in_array($val,$mangaSQL)){
                array_push($mangaSQL,$val);
            }
        }


        return $mangaSQL;

    }



    if (isset($_GET['dev'])) {
        
    }
    else{
        
        if(isset($_GET['categories'])&&isset($_GET['search'])){
            $mangaArray = array();
            if($_GET['categories'] =='manga'){
                $mangas = searchManga($_GET['search']);
                foreach($mangas as $mangaN){
                    array_push($mangaArray, new Manga($mangaN[0]));
                }
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
        <h2><?= $_GET['categories']?>:</h2>
        <?php
    }
    else{
        ?>
        <h2>Selection :</h2>
        <?php
    }


    if(isset($_GET['categories'])&&isset($_GET['search'])){
        if($_GET['categories'] =='manga'){
            foreach($mangaArray as $manga){
                $manga->echoHTMLCard();
            }
        }
    }

    ?>
        

    <section class="catalog">
    <?php
        if(isset($_GET['categories'])&&isset($_GET['search'])){
            if($_GET['categories'] =='manga'){
                foreach($tomeArray as $manga){
                    $tome->echoHTMLCard();
                }
            }
        }
        else{
            foreach ($tomeArray as $tome) {
                $tome->echoHTMLCard();
            }                
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
