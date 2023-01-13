<?php

class Manga
{
    private String $id ;
    private String $title ;
    private String $titleAlt ;
    private String $author ;
    private String $drawer ;
    private String $type ;
    private String $genre ;
    private String $desc ;
    private String $editor ;


    public function __construct(String $id)
    {
        //todo devMOD
        if(isset($_GET["dev"])){

            $array = [
                array(
                    "Tokyo Ghoul","Ishida Sui","Ishida Sui", "A Tokyo, de nos jours. Plusieurs cadavres mutilés ont été retrouvés par la police qui recherche vainement un coupable. Quelques spécialistes évoquent les goules, créatures monstrueuses qui chassent les humains pour les manger. Kaneki Ken, jeune homme de 18 ans étudiant à l'université, ne se préoccupe pas plus que ça de ces incidents, mais la réalité va le rattraper ! En effet, la jolie fille pour laquelle il a eu le coup de foudre dans un café et avec qui il sort n'est autre que la goule qui sévit dans le quartier ! Celle-ci tente de le dévorer et lui broie l'abdomen, mais elle est achevée par la chute de poutres en métal d'un chantier avant d'avoir pu mettre son sinistre dessein à exécution. Tout pourrait être bien qui finit bien, mais les médecins qui retrouvent Kaneki à moitié mort ne trouvent pas d'autre moyen pour le sauver que de transplanter les organes du monstre dans son corps ! Après son opération, le jeune homme constate avec horreur qu'il se transforme petit à petit en goule... La descente aux enfers de Kaneki commence !!","Seinen",1
                ),
                array(
                    "Kaguya-sama - Love is War","Akasaka Aka","Akasaka Aka","Kaguya Shinomiya, vice-présidente du conseil des élèves ne voit pas l'amour comme tout le monde. Pour elle, c'est un combat qu'elle doit livrer avec la personne dont elle est amoureuse, Miyuki Shirogane, qui n'est autre que le président du conseil des élèves et qui partage une vision de l'amour assez similaire. Bien que tous les deux éprouvent des sentiments réciproques, leur orgueil fait que le premier qui osera se déclarer devra alors se soumettre à l'autre...","Seinen",9
                ),
                array(
                    "One Piece","Oda Eiichiro","Oda Eiichiro","Gloire, fortune et puissance, c'est ce que possédait Gold Roger, le tout puissant roi des pirates, avant de mourir sur l'échafaud. Mais ses dernières paroles ont éveillées bien des convoitises, et lança la fabuleuse ère de la piraterie, chacun voulant trouver le fabuleux trésor qu'il disait avoir laissé. Bien des années plus tard, Shanks, un redoutable pirate aux cheveux rouges, rencontre Luffy, un jeune garçon d'une dizaine d'années dans un petit port de pêche. Il veut devenir pirate et le rejoindre, mais Shanks lui répond qu'il est trop jeune. Plus tard, Luffy avalera accidentellement le fruit Gomu Gomu qui rendra son corps élastique, mais aussi maudit par les eaux. Incapable de nager, Luffy ne veut pourtant pas renoncer à son rêve. Pour le consoler lorsqu'il part, Shanks lui offre son chapeau. Luffy jure alors de le rejoindre un jour avec son propre équipage. A 17 ans, Luffy prend la mer dans une petite barque avec pour but de réunir un équipage de pirates, mais de pirates pas comme les autres, qui devront partager sa conception un peu étrange de la piraterie. L'aventure est lancée.","Shonen",2
                ),
                array(
                    "Dr. STONE","Inagaki Riichiro","Boichi","Un jour, une lumière éclaira la Terre, changeant tous les humains en pierre. Ainsi, l'humanité s'éteignit. Plusieurs millénaires plus tard, Taiju parvient à s'échapper de son enveloppe de pierre pour découvrir un monde dans lequel la nature a repris ses droits. Avec son ami Senku, ils décident de tout mettre en œuvres pour faire renaître l'humanité de ses cendres et survivre.","Shonen",3
                )
            ];

//            print_r($array);
            $array = $array[rand(0,3)];

            $this->title =  $array[0];
            $this->author = $array[1];
            $this->drawer = $array[2];
            $this->desc =   $array[3];
            $this->genre =  $array[4];
            $this->id =     $array[5];

            $this->type = "Shonen";

            return;
        }








        $this->id = $id;
        $pdo = new PDO('mysql:host=165.227.152.225;dbname=db','p2','FicsiT22!');

        $mangaSQL = $pdo->query("SELECT * FROM MANGA m WHERE m.idManga = ".$id)->fetchAll()[0];
        $this->title = $mangaSQL[2];
        $this->author = $mangaSQL[3];
        $this->drawer = $mangaSQL[4];
        $this->desc = $mangaSQL[5];

        $type = $pdo->query("SELECT t.nom FROM TYPE t WHERE t.idType  = ".$mangaSQL[1])->fetchAll()[0][0];
        $this->type = $type;
        
        $genresSQL = $pdo->query("SELECT g.nom FROM GENRE g, GENRE_MANGA gm WHERE gm.idGenre=g.idGenre AND gm.idManga = ".$id)->fetchAll();
        $genres = array();
        foreach($genresSQL as $values){
            array_push($genres,$values[0]);
        }
        $this->genre = implode(" - ",$genres);


        $titles = $pdo->query("SELECT tm.titre FROM TITRE_MANGA tm WHERE tm.isOriginal = false AND tm.idManga = ".$id)->fetchAll();
        $titlesAlt = array();
        foreach($titles as $values){
            array_push($titlesAlt,$values[0]);
        }
        if(!empty($titlesAlt)){
            $this->titleAlt = implode(", ",$titlesAlt);
        }
        else{
            $this->titleAlt = "";
        }


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
        //todo devMOD
        if(isset($_GET["dev"])){
            return [new Tome(0),new Tome(0),new Tome(0),new Tome(0),new Tome(0),new Tome(0),new Tome(0)];
        }

        $pdo = new PDO('mysql:host=165.227.152.225;dbname=db','p2','FicsiT22!');
        $tome = $pdo->query("SELECT p.idProduit FROM PRODUIT p WHERE p.idManga =".$this->id)->fetchAll();
        $tomeArray = array();
        foreach($tome as $row){
            array_push($tomeArray,new Tome($row[0]));
        }
        return $tomeArray;
    }


    public function getImg(){
        //todo devMOD
        if(isset($_GET["dev"])){
            return "img/AttackonTitan/1.1.webp";
        }

        $pdo = new PDO('mysql:host=165.227.152.225;dbname=db','p2','FicsiT22!');
        $img = $pdo->query("SELECT i.lienImage FROM PRODUIT p, IMAGE i WHERE p.idManga = ".$this->id." AND p.numTome = 1 AND i.idProduit = p.idProduit")->fetchAll()[0][0];
        return $img;
    }


    public function echoHTMLSection(){
        $this->echoHTMLCard();
        $tomes = $this->getTomes();
        ?>
        <section class="catalog carousselMod">
        <?php
            foreach ($tomes as $tome) {
                $tome->echoHTMLCard();
            }
        ?>
        </section>
        <section class="descCardsContainer" id="descCardsContainer">

        <?php
            foreach ($tomes as $tome) {
                $tome->echoHTMLDescCard();
            }
        ?>
        </section>
    <?php
    }




    public function echoHTMLCardDesc(){
        $title = $this->title;
        $titleAlt = $this->titleAlt;
        $img = $this->getImg();
        $author = $this->author;
        $editor = $this->editor;
        $drawer = $this->drawer;
        $type = $this->type;
        $genre = $this->genre;
        $desc = $this->desc;
        require "view/component/card/mangaCardDescTemplate.php";
    }


    public function echoHTMLCard(){
        $title = $this->title;
        $titleAlt = $this->titleAlt;
        $img = $this->getImg();
        $author = $this->author;
        $drawer = $this->drawer;
        $editor = $this->editor;
        $type = $this->type;
        $genre = $this->genre;
        $desc = $this->desc;
        $link = "index.php?manga=".$this->id;
        require "view/component/card/mangaCardTemplate.php";
    }

}