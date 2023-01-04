<?php
require "Manga.php";
require "Editeur.php";

class Tome
{
    private int $id;
    private int $idManga;
    private int $idEditeur;
    private int $vol;
    private $date;
    private $desc;
    private $imgPath;
    private $price ;

    
    public function __construct(String $id)
    {
        $this->id = $id;
        $mysqli = new mysqli("localhost", "public", "phpClient22!", "db",3306);
        $result = $mysqli->query("SELECT * FROM PRODUIT p WHERE p.idProduit = ".$id);
        $tomeSQL = $result->fetch_all()[0];
        
        $this->idManga = $tomeSQL[1];
        $this->idEditeur = $tomeSQL[2];
        $this->vol = $tomeSQL[4];
        $this->price = $tomeSQL[5];
        $this->desc = $tomeSQL[7];
        $this->date = $tomeSQL[8];

        $resultImg = $mysqli->query("SELECT i.lienImage FROM IMAGE i WHERE i.idProduit =".$id);
        $this->imgPath = $resultImg->fetch_all()[0][0];

        //destruct object SQL
        $mysqli = null;

    }

    public function echoHTMLCard(){
        
        $manga =  new Manga($this->idManga);
        $title = $manga->getTitle();
        $img = $this->imgPath;
        $price = $this->price;
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $id = "tome-".$this->id;
        require "component/catalog/card/productCardTemplate.php";
    }

    public function echoHTMLDescCard(){
        $manga =  new Manga($this->idManga);
        $title = $manga->getTitle();
        $img = $this->imgPath;
        $price = $this->price;
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $author = $manga->getAuthor();

        $edit = new Editeur($this->idEditeur);
        $editor = $edit->getName();

        $publicationDate = $this->date;
        $type = $manga->getType();
        $genre = $manga->getGenre();
        $desc = $this->desc;

        $id = "tome-".$this->id;

        require "component/catalog/card/productDescCardTemplate.php";
    }
}

