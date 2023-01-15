<?php

$connected = false;
    if(isset($_SESSION["emailMangaFlow"]) && isset($_SESSION["passwordMangaFlow"])){
        $connected = true;
        $email = $_SESSION["emailMangaFlow"];
        $password = $_SESSION["passwordMangaFlow"];
    }
    elseif(isset($_COOKIE["emailMangaFlow"]) && isset($_COOKIE["passwordMangaFlow"])){
        $connected = true;
        $email = $_POST["emailMangaFlow"];
        $password = $_POST["passwordMangaFlow"];
    }
    elseif(isset($_POST["emailMangaFlow"]) && isset($_POST["passwordMangaFlow"])){
        $connected = true;
        $email = $_POST["emailMangaFlow"];
        $password = $_POST["passwordMangaFlow"];
    }