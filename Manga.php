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


    public function __construct(String $id)
    {
        $this->id = $id;

        $mysqli = new mysqli("165.227.152.225", "p2", "FicsiT22!", "db",3306);
        $result = $mysqli->query("SELECT * FROM MANGA m WHERE m.idManga = ".$id);
        $mangaSQL = $result->fetch_all()[0];
        
        $this->title = $mangaSQL[2];
        $this->author = $mangaSQL[3];
        $this->drawer = $mangaSQL[4];
        $this->desc = $mangaSQL[5];


        $resultType = $mysqli->query("SELECT t.nom FROM TYPE t WHERE t.idType  = ".$mangaSQL[1]);
        $type = $resultType->fetch_all()[0][0];
        $this->type = $type;

        
        $resultGenres = $mysqli->query("SELECT g.nom FROM GENRE g, GENRE_MANGA gm WHERE gm.idGenre=g.idGenre AND gm.idManga = ".$id);
        $genresSQL = $resultGenres->fetch_all();
        $genres = array();
        foreach($genresSQL as $values){
            array_push( $genres,$values[0]);
        }
        $this->genre = implode(" - ",$genres);

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



}