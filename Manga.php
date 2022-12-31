<?php

class Manga
{
    private $title ;
    private $author ;
    private $type ;
    private $genre ;

    /**
     * @param $title
     * @param $autor
     * @param $type
     * @param $genre
     */
    public function __construct($title, $autor,  $type, $genre)
    {
        $this->title = $title;
        $this->author = $autor;
        $this->type = $type;
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }



}