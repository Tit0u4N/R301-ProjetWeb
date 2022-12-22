<?php

class Manga
{
    private $title ;
    private $author ;
    private $editor;
    private $type ;
    private $genre ;

    /**
     * @param $title
     * @param $autor
     * @param $editor
     * @param $type
     * @param $genre
     */
    public function __construct($title, $autor, $editor, $type, $genre)
    {
        $this->title = $title;
        $this->author = $autor;
        $this->editor = $editor;
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
    public function getEditor()
    {
        return $this->editor;
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