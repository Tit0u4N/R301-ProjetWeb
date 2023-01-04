<?php

class Editeur{
    private String $id ;
    private String $name ;
    private String $imgPath ;

    public function __construct(String $id)
    {
        $this->id = $id;

        $mysqli = new mysqli("localhost", "public", "phpClient22!", "db",3306);
        $result = $mysqli->query("SELECT * FROM EDITEUR e WHERE e.idEditeur = ".$id);
        $editSQL = $result->fetch_all()[0];
        $this->name = $editSQL[1];
        $this->imgPath = $editSQL[2];

    }

    public function getName(){
        return $this->name;
    }

    public function getImgPath(){
        return $this->imgPath;
    }

}