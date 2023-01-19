<?php
function getBasket(bool $connected,&$test1){
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array();
    }
    if(isset($_SESSION["userId"])){
        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');

        /* Get Basket ID */
        $basketId = $pdo->query("SELECT f.idFacturation FROM FACTURATION f WHERE f.idClient = ".$_SESSION["userId"]." AND f.fini = FALSE")->fetchAll()[0][0];
        if(empty($basketId)){
            $pdo->query("INSERT INTO FACTURATION(idClient,date,fini) VALUES(".$_SESSION["userId"].",'".date("Y-m-d")."',0)");
            $basketId = $pdo->query("SELECT f.idFacturation FROM FACTURATION f WHERE f.idClient = ".$_SESSION["userId"]." AND f.fini = FALSE")->fetchAll()[0][0];
        }
        

        if($connected){
            /* Merge Session basket and BBD Basket */
            $basketBDD = $pdo->query("SELECT pf.idProduit,pf.nombreProduit FROM PRODUIT_FACTURATION pf WHERE pf.idFacturation = ".$basketId)->fetchAll();
            
            foreach($basketBDD as $products){
                if(isset($_SESSION['basket'][$products[0]])){
                    $_SESSION['basket'][$products[0]][1] = $_SESSION['basket'][$products[0]][1] + $products[1];
                }
                else{
                    $_SESSION['basket'][$products[0]] = array($products[0],$products[1]);
                }
            }
            
            /* Update BDD */
            foreach($_SESSION['basket'] as $id => $tome){
                $bddProduct= $pdo->query("SELECT pf.idProduit,pf.nombreProduit FROM PRODUIT_FACTURATION pf WHERE pf.idFacturation = ".$basketId."  AND pf.idProduit = ".$tome[0])->fetchAll();
                
                if(empty($bddProduct)){
                    $pdo->query("INSERT INTO PRODUIT_FACTURATION(idProduit,idFacturation,nombreProduit) VALUES (".$tome[0].",".$basketId.",".$tome[1].")");
                }
                else{
                    $pdo->query("UPDATE PRODUIT_FACTURATION SET nombreProduit=".$tome[1]."  WHERE pf.idFacturation = ".$basketId." AND pf.idProduit = ".$tome[0]);
                }
            }
        }
    }


    if(isset($update)){
        require "./../model/Tome.php";
    }
    else{
        require_once "model/Tome.php";
    }

    $basket = array();
    foreach($_SESSION['basket'] as $tomeBasket){
        array_push($basket, array(new Tome($tomeBasket[0]),$tomeBasket[1]) );
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
    $email = $_SESSION["emailMangaFlow"];
    $password = $_SESSION["passwordMangaFlow"];
    $connexionValidation = true;
}
else if(isset($_POST["userId"]) && isset($_POST["emailMangaFlow"])){
    $test2  ="connection";
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

if($body == "Payement" || $body == "Catalog"){
    $basket = getBasket(true,$test1);
}
