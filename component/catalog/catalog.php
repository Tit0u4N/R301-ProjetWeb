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

    function searchDrawer(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,true);
        $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.dessinateur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();

        $searchQuery = formatSearchQueryAll($search,false);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.dessinateur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();
        
        return mergeMangaList($mangaList,$mangaList2);
    }

    function searchTypeInfo(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,false);
        $type = $pdo->query("SELECT t.idType,t.nom FROM TYPE t WHERE t.nom REGEXP '".$searchQuery."'")->fetchAll();
        return $type;
    }

    function searchTypeManga(int $idType,PDO $pdo){
        $mangas = $pdo->query("SELECT m.idManga,m.titreManga FROM MANGA m WHERE m.idType = ".$idType." ORDER BY m.titreManga")->fetchAll();
        return $mangas;
    }

    function searchGenreInfo(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,true);
        $genres = $pdo->query("SELECT g.idGenre,g.nom FROM GENRE g WHERE g.nom REGEXP '".$searchQuery."'")->fetchAll();
        return $genres;
    }

    function searchGenreManga(int $idGenre,PDO $pdo){
        $mangas = $pdo->query("SELECT gm.idManga,m.titreManga FROM GENRE_MANGA gm, MANGA m WHERE gm.idManga = m.idManga AND gm.idGenre = ".$idGenre." ORDER BY m.titreManga")->fetchAll();
        return $mangas;
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
        $mangas = array();
        if($_GET['categories'] =='type'){
            $types = searchTypeInfo($_GET['search'],$pdo);
        }
        if($_GET['categories'] =='genre'){
            $genres = searchGenreInfo($_GET['search'],$pdo);
        }
        else{
            if($_GET['categories'] =='auteur'){
                $mangas = searchAutor($_GET['search'],$pdo);
            }
            if($_GET['categories'] =='drawer'){
                $mangas = searchDrawer($_GET['search'],$pdo);
            }
            if($_GET['categories'] =='manga'){
                $mangas = searchManga($_GET['search'],$pdo);
            }
            $mangaArray = array();
            foreach($mangas as $manga){
                array_push($mangaArray, new Manga($manga[0]));
            }
        }
    }
    else{
        $listSelection = array(599,279,117,174,348,446,447,480,313,1);//18/6/2/[5]/9/11/[12]/14/7/1
        $tomeArray = array();
        foreach($listSelection as $val){
            array_push($tomeArray,new Tome($val));
        }
        
    }





    


    if(isset($_GET['categories'])&&isset($_GET['search'])){
        if($_GET['categories'] =='type'){
            foreach($types as $val){
                $mangas = searchTypeManga($val[0],$pdo);
                $_POST['title'] = $val[1];
                $mangaArray = array();
                foreach($mangas as $manga){
                    array_push($mangaArray, new Manga($manga[0]));
                }

                require "component/catalog/titleGen.php";
                foreach($mangaArray as $manga){
                    echo $manga->echoHTMLSection();
                }
            }
        }
        else if($_GET['categories'] =='genre'){
            foreach($genres as $val){
                $mangas = searchGenreManga($val[0],$pdo);
                $_POST['title'] = $val[1];
                $mangaArray = array();
                foreach($mangas as $manga){
                    array_push($mangaArray, new Manga($manga[0]));
                }
                
                require "component/catalog/titleGen.php";
                foreach($mangaArray as $manga){
                    echo $manga->echoHTMLSection();
                }
            }
        }
        else{
            require "component/catalog/titleGen.php";
            foreach($mangaArray as $manga){
                echo $manga->echoHTMLSection();
            }
        }
    }
    else{
        require "component/catalog/titleGen.php";
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
                        
    }
    ?>

    </section>

<?php require "component/basket/basketPanel.php";
