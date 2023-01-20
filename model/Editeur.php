<?php

class Editeur{
    private String $id ;
    private String $name ;
    private String $imgPath ;

    public function __construct(String $id)
    {
        //todo devMod
        if(isset($_GET["dev"])){
            $this->name = "kana";

            return;
        }

        $this->id = $id;

        $pdo = new PDO('mysql:host=165.227.152.225;dbname=db','p2','FicsiT22!');
        $editSQL = $pdo->query("SELECT * FROM EDITEUR e WHERE e.idEditeur = ".$id)->fetchAll()[0];
        $this->name = $editSQL[1];
        if(isset($editSQL[2])){
            $this->imgPath = $editSQL[2];
        }
        else{
            $this->imgPath = "";
        }

    }

    public function getName(){
        return $this->name;
    }

    public function getImgPath(){
        return $this->imgPath;
    }

}