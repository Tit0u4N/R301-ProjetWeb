<?php

function getBasket(){
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array();
    }
    if($_SESSION["userId"]){
        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');

        /* Get Basket ID */
        $basketId = $pdo->query("SELECT f.idFacturation FROM FACTURATION f WHERE f.idClient = ".$_SESSION["userId"]." AND f.fini = FALSE");
        if(empty($basketId)){
            $pdo->query("INSERT INTO FACTURATION(idClient,date,fini) VALUES(".$_SESSION["userId"].",".date("Y-m-d").",FALSE)");
            $basketId = $pdo->query("SELECT f.idFacturation FROM FACTURATION f WHERE f.idClient = ".$_SESSION["userId"]." AND f.fini = FALSE");
        }

        if(isset($_POST["emailMangaFlow"])){
            /* Merge Session basket and BBD Basket */
            $basket = $pdo->query("SELECT pf.idProduit,pf.qte FROM PRODUIT_FACTURATION pf WHERE pf.idFacturation = ".$basketId);
            foreach($basket as $procucts){
                if(isset($_SESSION['basket'][$procucts[0]])){
                    $_SESSION['basket'][$procucts[0]] = $_SESSION['basket'][$procucts[0]] + $procucts[1];
                }
                else{
                    $_SESSION['basket'][$procucts[0]] = $procucts[1];
                }
            }

            /* Update BDD */
            foreach($_SESSION['basket'] -> $id as $qte){
                $bddProduct= $pdo->query("SELECT pf.idProduit,pf.qte FROM PRODUIT_FACTURATION pf WHERE pf.idFacturation = ".$basketId."  AND pf.idProduit = ".$id);
                if(empty($bddProduct)){
                    $pdo->query("INSERT INTO PRODUIT_FACTURATION(idProduit,idFacturation,nombreProduit) VALUES (".$id.",".$basketId.",".$qte.")");
                }
                else{
                    $pdo->query("UPDATE PRODUIT_FACTURATION SET nombreProduit=".$qte."  WHERE pf.idFacturation = ".$basketId." AND pf.idProduit = ".$id);
                }
            }
        }
    }
    $basket = array();
    foreach($_SESSION['basket'] -> $id as $qte){
        array_push($basket, array(new Tome($id),$qte));
    }
    return $basket;
}

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
else if(isset($_POST["userId"]) && isset($_POST["emailMangaFlow"])){

    $connected = true;
    session_cache_limiter('private');
    $_SESSION['CREATED'] = time();
    $_SESSION["userId"] = $_POST["userId"];
    $_SESSION["emailMangaFlow"] = $_POST["emailMangaFlow"];
    $_SESSION["webMaster"] = $_POST["webMaster"];

    $_POST["webMaster"] = null;
    $_POST["userId"] = null;
    $connexionValidation = true;
}

$basket = getBasket();
