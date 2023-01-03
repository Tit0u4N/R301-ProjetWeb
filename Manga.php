<?php

class Manga
{
    private String $title ;
    private String $titleOriginal ;
    private String $author ;
    private String $drawer ;
    private String $type ;
    private String $genre ;
    private String $desc ;


    public function __construct(String $title, String $type, String $titleOrginal, String $autor, String $drawer)
    {
        $this->title = $title;
        $this->titleOriginal = $titleOrginal;
        $this->author = $autor;
        $this->type = $type;
        if(!empty($drawer)){
            $this->drawer = $drawer;
        }
    }





}