<?php

class Manga
{
    private String $id ;
    private String $title ;
    private String $author ;
    private String $drawer ;
    private String $type ;
    private String $genre ;
    private String $desc ;
    private String $editor ;


    public function __construct(String $id)
    {
        $this->id = $id;
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');

        $mangaSQL = $pdo->query("SELECT * FROM MANGA m WHERE m.idManga = ".$id)->fetchAll()[0];
        $this->title = $mangaSQL[2];
        $this->author = $mangaSQL[3];
        $this->drawer = $mangaSQL[4];
        $this->desc = $mangaSQL[5];


        $resultType = $pdo->query("SELECT t.nom FROM TYPE t WHERE t.idType  = ".$mangaSQL[1])->fetchAll()[0];
        $type = $resultType[0];
        $this->type = $type;
        
        $resultGenres = $pdo->query("SELECT g.nom FROM GENRE g, GENRE_MANGA gm WHERE gm.idGenre=g.idGenre AND gm.idManga = ".$id)->fetchAll();
        $genres = array();
        foreach($resultGenres as $values){
            array_push($genres,$values[0]);
        }
        $this->genre = implode(" - ",$genres);

        
        $this->editor = $pdo->query("SELECT Distinct(e.idEditeur),e.nom FROM PRODUIT p, EDITEUR e WHERE  p.idManga = ".$id." AND e.idEditeur = p.idEditeur")->fetchAll()[0][1];

    }

    public function getTitle(){
        return $this->title;
    }

    public function getType(){
        return $this->type;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getDrawer(){
        return $this->drawer;
    }

    public function getGenre(){
        return $this->genre;
    }


    public function getId(){
        return $this->id;
    }


    public function getTomes(){
        $tomeArray = array();
        
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');
        $tome = $pdo->query("SELECT p.idProduit FROM PRODUIT p WHERE p.idManga =".$this->id)->fetchAll();

        foreach($tome as $row){
            array_push($tomeArray,new Tome($row[0]));
        }

        return $tomeArray;
    }


    public function getImg(){
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');
        $img = $pdo->query("SELECT i.lienImage FROM PRODUIT p, IMAGE i WHERE p.idManga = ".$this->id." AND p.numTome = 1 AND i.idProduit = p.idProduit")->fetchAll()[0][0];
        return $img;
    }

    
    public function echoHTMLSection(){
        $this->echoHTMLCard();
        ?>
        <section class="catalog carousselMod">
        <?php
            foreach ($this->getTomes() as $tome) {
                $tome->echoHTMLCard();
            }
        ?>
        </section>
    <?php
    }



    public function echoHTMLCard(){
        $title = $this->title;
        $img = $this->getImg();
        $author = $this->author;
        $drawer = $this->drawer;
        $editor = $this->editor;
        $type = $this->type;
        $genre = $this->genre;
        $desc = $this->desc;
        require "component/card/mangaCardTemplate.php";
    }

}