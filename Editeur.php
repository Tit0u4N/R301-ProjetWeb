<?php

class Editeur{
    private String $id ;
    private String $name ;
    private String $imgPath ;

    public function __construct(String $id)
    {
        $this->id = $id;

        $pdo = new PDO('mysql:host=localhost;dbname=db','public','phpClient22!');
        $editSQL = $pdo->query("SELECT * FROM EDITEUR e WHERE e.idEditeur = ".$id)->fetchAll()[0];
        $this->name = $editSQL[1];
        if(isset($editSQL[2])){
            $this->imgPath = $editSQL[2];
        }

    }

    public function getName(){
        return $this->name;
    }

    public function getImgPath(){
        return $this->imgPath;
    }

}