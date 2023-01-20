<?php
require_once "model/Tome.php";

function formatSearchQueryAll(string $search, bool $firstWord)
{
    $searchTab = str_split($search);
    foreach ($searchTab as $key => $val) {
        if (preg_match("/[a-zA-Z]/", $val)) {
            $searchTab[$key] = "(" . strtoupper($val) . "|" . strtolower($val) . ")";
        }
    }
    $searchTemp = implode("", $searchTab);
    $searchTab = explode(" ", $searchTemp);
    if (strlen($search) <= 2 || $firstWord) {
        return str_replace("'", "''", "^(.* )?" . implode(".*", $searchTab) . ".*");
    } else {
        return str_replace("'", "''", implode(".*", $searchTab) . ".*");
    }
}

function formatSearchQueryInitials(string $search, bool $firstWord)
{
    $searchTab = str_split($search);
    foreach ($searchTab as $key => $val) {
        if (preg_match("/[a-zA-Z]/", $val)) {
            $searchTab[$key] = "(" . strtoupper($val) . "|" . strtolower($val) . ")";
        }
    }
    if ($firstWord) {
        return str_replace("'", "''", "^" . implode(".*(-| )", $searchTab) . ".*");
    } else {
        return str_replace("'", "''", "^(.* )?" . implode(".*(-| )", $searchTab) . ".*");
    }
}


/* Search manga */
function searchManga(string $search, PDO $pdo)
{
    $searchQuery = formatSearchQueryInitials($search, true);
    $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.titreManga REGEXP '" . $searchQuery . "' ORDER BY m.titreManga")->fetchAll();

    $searchQuery = formatSearchQueryInitials($search, false);
    $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '" . $searchQuery . "' OR m.titreManga REGEXP '" . $searchQuery . "') ORDER BY m.titreManga")->fetchAll();
    $mangaList = mergeMangaList($mangaList, $mangaList2);

    $searchQuery = formatSearchQueryAll($search, true);
    $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '" . $searchQuery . "' OR m.titreManga REGEXP '" . $searchQuery . "') ORDER BY m.titreManga")->fetchAll();
    $mangaList = mergeMangaList($mangaList, $mangaList2);

    $searchQuery = formatSearchQueryAll($search, false);
    $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM TITRE_MANGA tm, MANGA m WHERE tm.idManga = m.idManga AND (tm.titre REGEXP '" . $searchQuery . "' OR m.titreManga REGEXP '" . $searchQuery . "') ORDER BY m.titreManga")->fetchAll();
    return mergeMangaList($mangaList, $mangaList2);

}

/* Search autor */
function searchAutor(string $search, PDO $pdo)
{
    $searchQuery = formatSearchQueryAll($search, true);
    $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.auteur REGEXP '" . $searchQuery . "' ORDER BY m.titreManga")->fetchAll();

    $searchQuery = formatSearchQueryAll($search, false);
    $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.auteur REGEXP '" . $searchQuery . "' ORDER BY m.titreManga")->fetchAll();

    return mergeMangaList($mangaList, $mangaList2);
}

/* Search drawer */
function searchDrawer(string $search, PDO $pdo)
{
    $searchQuery = formatSearchQueryAll($search, true);
    $mangaList = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.dessinateur REGEXP '" . $searchQuery . "' ORDER BY m.titreManga")->fetchAll();

    $searchQuery = formatSearchQueryAll($search, false);
    $mangaList2 = $pdo->query("SELECT DISTINCT (m.idManga),m.titreManga FROM MANGA m WHERE m.dessinateur REGEXP '" . $searchQuery . "' ORDER BY m.titreManga")->fetchAll();

    return mergeMangaList($mangaList, $mangaList2);
}

/* Search type */
function searchTypeInfo(string $search, PDO $pdo)
{
    $searchQuery = formatSearchQueryAll($search, false);
    $type = $pdo->query("SELECT t.idType,t.nom FROM TYPE t WHERE t.nom REGEXP '" . $searchQuery . "'")->fetchAll();
    return $type;
}

function searchTypeManga(int $idType, PDO $pdo)
{
    $mangas = $pdo->query("SELECT m.idManga,m.titreManga FROM MANGA m WHERE m.idType = " . $idType . " ORDER BY m.titreManga")->fetchAll();
    $mangaArray = array();
    foreach ($mangas as $manga) {
        array_push($mangaArray, new Manga($manga[0]));
    }
    return $mangaArray;
}

/* Search Genre */
function searchGenreInfo(string $search, PDO $pdo)
{
    $searchQuery = formatSearchQueryAll($search, true);
    $genres = $pdo->query("SELECT g.idGenre,g.nom FROM GENRE g WHERE g.nom REGEXP '" . $searchQuery . "'")->fetchAll();
    return $genres;
}

function searchGenreManga(int $idGenre, PDO $pdo)
{
    $mangas = $pdo->query("SELECT gm.idManga,m.titreManga FROM GENRE_MANGA gm, MANGA m WHERE gm.idManga = m.idManga AND gm.idGenre = " . $idGenre . " ORDER BY m.titreManga")->fetchAll();
    $mangaArray = array();
    foreach ($mangas as $manga) {
        array_push($mangaArray, new Manga($manga[0]));
    }
    return $mangaArray;
}

/* Search editeur */
function searchEditorInfo(string $search, PDO $pdo)
{
    $searchQuery = formatSearchQueryAll($search, false);
    $genres = $pdo->query("SELECT e.idEditeur,e.nom FROM EDITEUR e WHERE e.nom REGEXP '" . $searchQuery . "'")->fetchAll();
    return $genres;
}

function searchEditorManga(int $idEditeur, PDO $pdo)
{
    $mangas = $pdo->query("SELECT DISTINCT(p.idManga) FROM PRODUIT p, EDITEUR e WHERE  e.idEditeur = " . $idEditeur . " AND e.idEditeur = p.idEditeur")->fetchAll();
    $mangaArray = array();
    foreach ($mangas as $manga) {
        array_push($mangaArray, new Manga($manga[0]));
    }
    return $mangaArray;
}

/* Merge manga list */
function mergeMangaList($mangaList, $additionalManga)
{
    foreach ($additionalManga as $key => $val) {
        if (!in_array($val, $mangaList)) {
            array_push($mangaList, $val);
        }
    }
    return $mangaList;
}


/* Manga list or manga Tome */
function makeMangas(array $mangaArray,bool $onLine){
    require "view/component/catalog/titleGen.php";
    if($onLine){
        require "view/component/catalog/catalogManga.php";
    }
    else{
        foreach ($mangaArray as $manga) {
            require "view/component/catalog/catalogMangaTome.php";
        }
    }
}



/* Setup catalog */
if(isset($_GET['manga'])){
    $manga = new Manga($_GET['manga']);
}
else if (isset($_GET['categories']) && isset($_GET['search'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=db', 'public', 'phpClient22!');
    $mangas = array();
    if ($_GET['categories'] == 'categorie') {
        if($_GET['search'] == ""){
            $types = searchTypeInfo($_GET['search'], $pdo);
        }
        else{
            $types = searchTypeInfo($_GET['search'], $pdo);
            $genres = searchGenreInfo($_GET['search'], $pdo);
            $editors = searchEditorInfo($_GET['search'], $pdo);
            $mangasAutor = searchAutor($_GET['search'], $pdo);
            $mangasDrawer = searchDrawer($_GET['search'], $pdo);
            $mangas = searchManga($_GET['search'], $pdo);
            
            $mangaArray = array();
            foreach ($mangas as $manga) {
                array_push($mangaArray, new Manga($manga[0]));
            }
        }

    }else if ($_GET['categories'] == 'type') {
        $types = searchTypeInfo($_GET['search'], $pdo);
    } else if ($_GET['categories'] == 'genre') {
        $genres = searchGenreInfo($_GET['search'], $pdo);
    } else if ($_GET['categories'] == 'editeur') {
        $editors = searchEditorInfo($_GET['search'], $pdo);
    } else {
        if ($_GET['categories'] == 'auteur') {
            $mangas = searchAutor($_GET['search'], $pdo);
        }
        if ($_GET['categories'] == 'drawer') {
            $mangas = searchDrawer($_GET['search'], $pdo);
        }
        if ($_GET['categories'] == 'manga') {
            $mangas = searchManga($_GET['search'], $pdo);
        }
        $mangaArray = array();
        foreach ($mangas as $manga) {
            array_push($mangaArray, new Manga($manga[0]));
        }
    }
} else {
    $listSelection = array(615, 295, 133, 190, 364, 462, 463, 496, 329, 1, 497, 817);
    $tomeArray = array();
    foreach ($listSelection as $val) {
        array_push($tomeArray, new Tome($val));
    }

}


/* Call view */
if(isset($_GET['manga'])){
    require "view/component/catalog/catalogMangaTome.php";
}
else if (isset($_GET['categories']) && isset($_GET['search'])) {
    if ($_GET['categories'] == 'categorie') {
        if(!empty($types)){
            $_POST['title'] = "Types";
            $_POST['subtitle'] = false;
            require "view/component/catalog/titleGen.php";
            foreach ($types as $val) {
                $mangaArray = searchTypeManga($val[0], $pdo);
                $_POST['title'] = $val[1];
                $_POST['subtitle'] = true;
                makeMangas($mangaArray,true);
            }
        }
        if(!empty($genres)){
            $_POST['title'] = "Genres";
            $_POST['subtitle'] = false;
            require "view/component/catalog/titleGen.php";
            foreach ($genres as $val) {
                $mangaArray = searchGenreManga($val[0], $pdo);
                $_POST['title'] = $val[1];
                $_POST['subtitle'] = true;
                makeMangas($mangaArray,true);
            }
        }
        if(!empty($editors)){
            $_POST['title'] = "Editeurs";
            $_POST['subtitle'] = false;
            require "view/component/catalog/titleGen.php";
            foreach ($editors as $val) {
                $mangaArray = searchEditorManga($val[0], $pdo);
                $_POST['title'] = $val[1];
                $_POST['subtitle'] = true;
                makeMangas($mangaArray,true);
            }
        }
        
        $_POST['subtitle'] = false;

        if(!empty($mangaAutor)){
            $_POST['title'] = "Auteur";
            $mangaArray = array();
            foreach ($mangaAutor as $manga) {
                array_push($mangaArray, new Manga($manga[0]));
            }
            makeMangas($mangaArray,true);
        }

        if(!empty($mangaDrawer)){
            $_POST['title'] = "Dessinateur";
            $mangaArray = array();
            foreach ($mangaDrawer as $manga) {
                array_push($mangaArray, new Manga($manga[0]));
            }
            makeMangas($mangaArray,true);
        }

        if(!empty($mangas)){
    
            $_POST['title'] = "Manga";
            $mangaArray = array();
            foreach ($mangas as $manga) {
                array_push($mangaArray, new Manga($manga[0]));
            }
            makeMangas($mangaArray,true);
        }

    }else if ($_GET['categories'] == 'type') {
        foreach ($types as $val) {
            /* get mangas */
            $mangaArray = searchTypeManga($val[0], $pdo);
            $_POST['title'] = $val[1];

            /* echo mangas */
            makeMangas($mangaArray,true);
        }
    } else if ($_GET['categories'] == 'genre') {
        foreach ($genres as $val) {
            /* get mangas */
            $mangaArray = searchGenreManga($val[0], $pdo);
            $_POST['title'] = $val[1];

            /* echo mangas */
            makeMangas($mangaArray,true);
        }
    } else if ($_GET['categories'] == 'editeur') {
        foreach ($editors as $val) {
            /* get mangas */
            $mangaArray = searchEditorManga($val[0], $pdo);
            $_POST['title'] = $val[1];

            /* echo mangas */
            makeMangas($mangaArray,true);
        }
    } else {
        makeMangas($mangaArray,count($mangaArray)>2);
    }
} else {
    require "view/component/catalog/catalogSelection.php";
}
?>

</section>

<?php require_once "view/component/basket/basketPanel.php"; ?>
