<?php
    require "Tome.php";

    function formatSearchQueryAll(String $search,bool $firstWord){
        $searchTab = str_split($search);
        foreach($searchTab as $key => $val){
            if(preg_match("/[a-zA-Z]/",$val)){
                $searchTab[$key] = "(".strtoupper($val)."|".strtolower($val).")";
            }
        }
        $searchTemp = implode("",$searchTab);
        $searchTab = explode(" ", $searchTemp);
        if(strlen($search)<=2 ||$firstWord ){
            return str_replace("'","''","^(.* )?".implode(".*",$searchTab).".*");
        }
        else{
            return str_replace("'","''",implode(".*",$searchTab).".*");
        }
    }

    function formatSearchQueryInitials(String $search,bool $firstWord){
        $searchTab = str_split($search);
        foreach($searchTab as $key => $val){
            if(preg_match("/[a-zA-Z]/",$val)){
                $searchTab[$key] = "(".strtoupper($val)."|".strtolower($val).")";
            }
        }
        if($firstWord){
            return str_replace("'","''","^".implode(".*(-| )",$searchTab).".*");
        }
        else{
            return str_replace("'","''","^(.* )?".implode(".*(-| )",$searchTab).".*");
        }
    }



    function searchManga(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryInitials($search,true);
        $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.titreManga REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();

        $searchQuery = formatSearchQueryInitials($search,false);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '".$searchQuery."' OR m.titreManga REGEXP '".$searchQuery."') ORDER BY m.titreManga")->fetchAll();
        $mangaList = mergeMangaList($mangaList,$mangaList2);

        $searchQuery = formatSearchQueryAll($search,true);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '".$searchQuery."' OR m.titreManga REGEXP '".$searchQuery."') ORDER BY m.titreManga")->fetchAll();
        $mangaList = mergeMangaList($mangaList,$mangaList2);

        $searchQuery = formatSearchQueryAll($search,false);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '".$searchQuery."' OR m.titreManga REGEXP '".$searchQuery."') ORDER BY m.titreManga")->fetchAll();
        return mergeMangaList($mangaList,$mangaList2);
        
    }

    function searchAutor(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,true);
        $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.auteur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();

        $searchQuery = formatSearchQueryAll($search,false);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.auteur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();
        
        return mergeMangaList($mangaList,$mangaList2);
    }

    function searchTypeInfo(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,false);
        $type = $pdo->query("SELECT t.idType,t.nom FROM TYPE t WHERE t.nom REGEXP '".$searchQuery."'")->fetchAll();
        return $type;
    }

    function searchTypeManga(int $idType,PDO $pdo){
        $mangas = $pdo->query("SELECT m.idManga FROM MANGA m WHERE m.idType = ".$idType)->fetchAll();
        return $mangas;
    }

    function searchType(String $search,PDO $pdo){
        $type = searchTypeInfo($search,$pdo);
        if(!empty($type)){
            $_GET['search'] = $type[0][1];
            return searchTypeManga($type[0][0],$pdo);
        }
        return null;
    }



    function mergeMangaList($mangaList, $additionalManga){
        foreach($additionalManga as $key => $val){
            if(!in_array($val,$mangaList)){
                array_push($mangaList,$val);
            }
        }
        return $mangaList;
    }






    
      
     
    if(isset($_GET['categories'])&&isset($_GET['search'])){
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!'); 
        $mangaArray = array();
        $mangas = array();
        if($_GET['categories'] =='auteur'){
            $mangas = searchAutor($_GET['search'],$pdo);
        }
        if($_GET['categories'] =='manga'){
            $mangas = searchManga($_GET['search'],$pdo);
        }
        if($_GET['categories'] =='type'){
            $mangas = searchType($_GET['search'],$pdo);
        }
        foreach($mangas as $manga){
            array_push($mangaArray, new Manga($manga[0]));
        }
    }
    else{
        $index = rand(1,18);
        $manga = new Manga($index);
        $tomeArray = $manga->getTomes();
        
    }



    require "component/catalog/titleGen.php";


    if(isset($_GET['categories'])&&isset($_GET['search'])){
        foreach($mangaArray as $manga){
            echo $manga->echoHTMLSection();
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
