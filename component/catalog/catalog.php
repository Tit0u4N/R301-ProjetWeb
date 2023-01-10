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


    /* Search manga */
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

    /* Search autor */
    function searchAutor(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,true);
        $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.auteur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();

        $searchQuery = formatSearchQueryAll($search,false);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.auteur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();
        
        return mergeMangaList($mangaList,$mangaList2);
    }
    
    /* Search drawer */
    function searchDrawer(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,true);
        $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.dessinateur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();

        $searchQuery = formatSearchQueryAll($search,false);
        $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.dessinateur REGEXP '".$searchQuery."' ORDER BY m.titreManga")->fetchAll();
        
        return mergeMangaList($mangaList,$mangaList2);
    }

    /* Search type */
    function searchTypeInfo(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,false);
        $type = $pdo->query("SELECT t.idType,t.nom FROM TYPE t WHERE t.nom REGEXP '".$searchQuery."'")->fetchAll();
        return $type;
    }

    function searchTypeManga(int $idType,PDO $pdo){
        $mangas = $pdo->query("SELECT m.idManga,m.titreManga FROM MANGA m WHERE m.idType = ".$idType." ORDER BY m.titreManga")->fetchAll();
        return $mangas;
    }

    /* Search Genre */
    function searchGenreInfo(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,true);
        $genres = $pdo->query("SELECT g.idGenre,g.nom FROM GENRE g WHERE g.nom REGEXP '".$searchQuery."'")->fetchAll();
        return $genres;
    }

    function searchGenreManga(int $idGenre,PDO $pdo){
        $mangas = $pdo->query("SELECT gm.idManga,m.titreManga FROM GENRE_MANGA gm, MANGA m WHERE gm.idManga = m.idManga AND gm.idGenre = ".$idGenre." ORDER BY m.titreManga")->fetchAll();
        return $mangas;
    }

    /* Search editeur */
    function searchEditorInfo(String $search,PDO $pdo){
        $searchQuery = formatSearchQueryAll($search,false);
        $genres = $pdo->query("SELECT e.idEditeur,e.nom FROM EDITEUR e WHERE e.nom REGEXP '".$searchQuery."'")->fetchAll();
        return $genres;
    }

    function searchEditorManga(int $idEditeur,PDO $pdo){
        $mangas = $pdo->query("SELECT DISTINCT(p.idManga) FROM PRODUIT p, EDITEUR e WHERE  e.idEditeur = ".$idEditeur." AND e.idEditeur = p.idEditeur")->fetchAll();
        return $mangas;
    }



    /* Merge manga list */
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
        else if($_GET['categories'] =='genre'){
            $genres = searchGenreInfo($_GET['search'],$pdo);
        }
        else if($_GET['categories'] =='editeur'){
            $editors = searchEditorInfo($_GET['search'],$pdo);
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

    
    if (isset($_GET['dev'])) {
        if ($_GET['dev'] == True) {
            $JJK = new Manga("Jujutsu Kaisen", "Kishimoto Masashi", "Kana", "Shonen", "Action");
            $code = new Manga("Code Geass - Lelouch of the Rebellion", "Kishimoto Masashi", "Kana", "Shonen", "Action");
            $love = new Manga("Kaguya-sama - Love is War", "Kishimoto Masashi", "Kana", "Shonen", "Action");

            $testTome1 = new Tome($JJK, 1, "03/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/11/54/jujutsu_kaisen_11931845.webp?1649609261", "6.50", 1);
            $testTome2 = new Tome($JJK, 2, "06/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/48/35484.webp?1649609175", "6.50", 2);
            $testTome3 = new Tome($code, -1, "06/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga/00/57/code_geass_-_lelouch_of_the_rebellion_75.webp?1666957492", "15.50", 3);
            $testTome4 = new Tome($love, -1, "06/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "http://165.227.152.225/img/Kaguya-sama-LoveisWar/1.1.webp", "15.50", 3);

        }
    }



    


    if(isset($_GET['categories'])&&isset($_GET['search'])){
        if($_GET['categories'] =='type'){
            foreach($types as $val){
                /* get mangas */
                $mangas = searchTypeManga($val[0],$pdo);
                $_POST['title'] = $val[1];
                $mangaArray = array();
                foreach($mangas as $manga){
                    array_push($mangaArray, new Manga($manga[0]));
                }

                /* echo mangas */
                require "component/catalog/titleGen.php";
                foreach($mangaArray as $manga){
                    echo $manga->echoHTMLSection();
                }
            }
        }
        else if($_GET['categories'] =='genre'){
            foreach($genres as $val){
                /* get mangas */
                $mangas = searchGenreManga($val[0],$pdo);
                $_POST['title'] = $val[1];
                $mangaArray = array();
                foreach($mangas as $manga){
                    array_push($mangaArray, new Manga($manga[0]));
                }
                
                /* echo mangas */
                require "component/catalog/titleGen.php";
                foreach($mangaArray as $manga){
                    echo $manga->echoHTMLSection();
                }
            }
        }
        else if($_GET['categories'] =='editeur'){
            foreach($editors as $val){
                /* get mangas */
                $mangas = searchEditorManga($val[0],$pdo);
                $_POST['title'] = $val[1];
                $mangaArray = array();
                foreach($mangas as $manga){
                    array_push($mangaArray, new Manga($manga[0]));
                }
                
                /* echo mangas */
                require "component/catalog/titleGen.php";
                foreach($mangaArray as $manga){
                    echo $manga->echoHTMLSection();
                }
            }
        }
        else{
            require "component/catalog/titleGen.php";
            foreach($mangaArray as $manga){
                require "component/catalog/catalogMangaTome.php";
            }
        }
    }
    else{
        require "component/catalog/catalogSelection.php";
    }
    ?>

    </section>

<?php require "component/basket/basketPanel.php";




?>
