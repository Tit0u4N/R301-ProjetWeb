<?php
require "Manga.php";

class Tome
{
    private Manga $manga;
    private int $vol;
    private $date;
    private $desc;
    private $imgPath;
    private $price ;
    private int $id;

    /**
     * @param Manga $manga
     * @param int $vol
     * @param $date
     * @param $desc
     * @param $imgPath
     */
    public function __construct(Manga $manga, int $vol, $date, $desc, $imgPath, $price, int $id)
    {
        $this->manga = $manga;
        $this->vol = $vol;
        $this->date = $date;
        $this->desc = $desc;
        $this->imgPath = $imgPath;
        $this->price = $price;
        $this->id = $id;
    }

    public function echoHTMLCard(){
        $title = $this->manga->getTitle();
        $img = $this->imgPath;
        $price = $this->price;
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $id = "tome-".$this->id;
        $idDescCard = "desc-tome-".$this->id;
        require "component/card/productCardTemplate.php";
    }

    public function echoHTMLDescCard(){
        $title = $this->manga->getTitle();
        $img = $this->imgPath;
        $price = $this->price;
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $author = $this->manga->getAuthor();
        $editor = $this->manga->getEditor();
        $publicationDate = $this->date;
        $type = $this->manga->getType();
        $genre = $this->manga->getGenre();
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

