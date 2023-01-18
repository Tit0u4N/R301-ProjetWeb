<?php
session_start();

/* Destroy session after 5 min of inactivity */
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    session_unset();    
    session_destroy();   
}
$_SESSION['LAST_ACTIVITY'] = time();

/* Regenerate the session ID periodically to avoid attacks*/
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    session_regenerate_id(true);   
    $_SESSION['CREATED'] = time();  
}

$connected = false;
$connexionValidation = false;
if(isset($_SESSION["userId"])){
    $connected = true;
    $email = $_SESSION["emailMangaFlow"];
    $password = $_SESSION["passwordMangaFlow"];
    $connexionValidation = true;
}
else if(isset($_POST["userId"]) && isset($_POST["passwordMangaFlow"])){
    $connected = true;
    session_cache_expire(2);
    session_cache_limiter('private');
    $test1 =  $_POST["userId"];
    $_SESSION['CREATED'] = time();
    $_SESSION["userId"] = $_POST["userId"];
    $_SESSION["emailMangaFlow"]= $_POST["emailMangaFlow"];
    $_SESSION["webMaster"] = $_POST["webMaster"];
    $_POST["webMaster"] = null;
    $_POST["userId"] = null;
    $connexionValidation = true;
}

