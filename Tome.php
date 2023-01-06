<?php
require "Manga.php";
require "Editeur.php";

class Tome
{
    private int $id;
    private int $idManga;
    private int $idEditeur;
    private int $vol;
    private String $date;
    private String $desc;
    private String $imgPath;
    private float $price ;

    
    public function __construct(String $id)
    {
        $this->id = $id;
        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');
        $tomeSQL = $pdo->query("SELECT * FROM PRODUIT p WHERE p.idProduit = ".$id)->fetchAll()[0];
        
        $this->idManga = $tomeSQL[1];
        $this->idEditeur = $tomeSQL[2];
        $this->vol = $tomeSQL[4];
        $this->price = $tomeSQL[5];
        $this->desc = $tomeSQL[7];
        $this->date = $tomeSQL[8];

        $this->imgPath = $pdo->query("SELECT i.lienImage FROM IMAGE i WHERE i.idProduit =".$id)->fetchAll()[0][0];

        //destruct object SQL
        $pdo = null;

    }

    public function echoHTMLCard(){
        
        $manga =  new Manga($this->idManga);
        $title = $manga->getTitle();
        $img = $this->imgPath;
        $price = sprintf('%.2f',$this->price);
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $id = "tome-".$this->id;
        $idDescCard = "desc-tome-".$this->id;
        require "component/card/productCardTemplate.php";
    }

    public function echoHTMLDescCard(){
        $manga =  new Manga($this->idManga);
        $title = $manga->getTitle();
        $img = $this->imgPath;
        $price = sprintf('%.2f',$this->price);
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

        $id = "desc-tome-".$this->id;

        require "component/card/productDescCardTemplate.php";
    }


    public function echoHTMLCardBasket(){
        $title = $this->manga->getTitle();
        $img = $this->imgPath;
        $price = $this->price;
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $id = "basket-tome-".$this->id;
        require "component/card/productCardBasketTemplate.php";
    }
}

