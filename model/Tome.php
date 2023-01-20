<?php
require "model/Manga.php";
require "model/Editeur.php";

class Tome
{
    private String $id;
    private int $idManga;
    private int $idEditeur;
    private int $vol;
    private String $date;
    private String $desc;
    private String $imgPath;
    private float $price ;


    public function __construct(String $id)
    {
        //todo devMOD
        if(isset($_GET["dev"])) {

            $array = [
                array(
                    273, 26, 6.7, "A Heart, les disciples de Vanica se sont régénérés grâce au pouvoir de leur maîtresse et se préparent pour un deuxième round. Le dernier pilier de la Triade Sombre est désormais face à Lolopechka et Noelle ! En unissant leurs forces, parviendront-elles à tenir tête au redoutable Megicula ?! Au même moment, Dante, bien décidé à capturer Yami, sort le grand jeu !", "2021-02-17", 6, "Crunchyroll Kazé", "img/BlackClover/26.1.webp"
                ),
                array(
                    282, 3, 7.2, "A cause de son comportement suspect, Eren est considéré comme un traître nuisant à la survie de l'humanité, quand bien même il a contribué à la mort de nombreux titans. Et pour cause : Eren n'est autre que le fruit d'une expérience de son père ; il a le pouvoir de se métamorphoser en titan !! Le jeune homme se rend compte que son père connaissait la vérité sur les titans, mais qu'il la cachait. Pour quelle raison aurait-il dissimulé une chose pour laquelle tant de soldats se sont sacrifiés ?!", "2013-09-04", 7, "Pika", "img/AttackonTitan/3.1.webp"
                ),
                array(
                    270, 23, 6.7, "Accusé par Damnatio d'être possédé, Asta va devoir prouver son innocence ! Avec ses camarades du Taureau Noir, il part à la recherche de la véritable source du mal : un démon qui se tapit quelque part dans le monde ! Leur enquête les conduit tout d'abord au royaume de Heart...", "2020-06-24", 6, "Crunchyroll Kazé", "img/BlackClover/23.1.webp"
                ),
                array(
                    60, 46, 6.9, "Ace a enfin trouvé Barbe Noire et l'affrontement commence. Chacun des deux adversaires détient le pouvoir d'un logia, mais celui de Marshall D. Teach est étrange. De leur côté, Luffy et son équipage se la coulent douce après avoir échappé au vice-amiral Garp. Chacun visite le nouveau bateau où se détend tranquillement lorsqu'un étrange tonneau parvient jusqu'au bateau. Une fois ouvert, une sorte de fusée s'en échappe et peu à peu, le Thousand Sunny est cerné par la brume. C'est alors qu'un étrange bateau fantôme s'approche avec à son bord : Brook le squelette vivant.", "2008-11-18", 2, "Glénat", "img/OnePiece/46.1.webp"
                ),
                array(
                    174, 1, 6.9, "Adolescent de quinze ans, Ichigo Kurosaki possède un don particulier : celui de voir les esprits. Un jour, il croise la route d'une belle Shinigami (un être spirituel) en train de pourchasser une âme perdue, un esprit maléfique qui hante notre monde et n'arrive pas à trouver le repos. Mise en difficulté par son ennemi, la jeune fille décide alors de prêter une partie de ses pouvoirs à Ichigo, mais ce dernier hérite finalement de toute la puissance du Shinigami. Contraint d'assumer son nouveau statut, Ichigo va devoir gérer ses deux vies : celle de lycéen ordinaire, et celle de chasseur de démons...", "2003-07-11", 5, "Glénat", "img/Bleach/1.1.webp"
                ),
            ];

//            print_r($array);
            $array = $array[rand(0,4)];
//            print_r($array);

            $this->id =         $array[0];
            $this->vol =        $array[1];
            $this->price =      $array[2];
            $this->desc =       $array[3];
            $this->date =       $array[4];
            $this->idManga =    $array[5];
            $this->idEditeur =  0;
            $this->imgPath = $array[7];

            return;
        }



        $this->id = $id;
        $pdo = new PDO('mysql:host=165.227.152.225;dbname=db','p2','FicsiT22!');
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

        require "view/component/card/productCardTemplate.php";
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
        require "view/component/card/productDescCardTemplate.php";
    }


    public function echoHTMLCardBasket($qte){
        if(!isset($qte)){
            $qte = 1;
        }
        $manga =  new Manga($this->idManga);
        
        $edit = new Editeur($this->idEditeur);
        $editor = $edit->getName();
        $editorImg = $edit->getImgPath();
        $title = $manga->getTitle();
        $img = $this->imgPath;
        $price = $this->price;
        if ($this->vol == -1)
            $vol = "Hors Serie";
        else
            $vol = "Vol. ".$this->vol;

        $id = "basket-tome-".$this->id;
        require "view/component/card/productCardBasketTemplate.php";
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }



}