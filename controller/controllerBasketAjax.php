<?php
    //$_GET['dev'] = true;

//todo session controller pour verifier si user connecté

//Type : addArticle = 0
//     : removeArticle = 1
// return ["idArticle" => -1, "nbArticle" => -1] si erreur

    
    $update = true;
    require "sessionController.php";
    if(isset($_POST['basketActuIdProduit']) && isset($_POST['basketActuType'])){
        $validation = false;

        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');

        

        if($_POST['basketActuType'] == 0 ){
            echo json_encode(addArticle($_POST['basketActuIdProduit']));

        } else if($_POST['basketActuType'] == 1 ) {
            echo json_encode(removeArticle($_POST['basketActuIdProduit']));
        }

        if(isset($_SESSION["userId"])){
            /* Get Basket ID */
            $basketId = $pdo->query("SELECT f.idFacturation FROM FACTURATION f WHERE f.idClient = ".$_SESSION["userId"]." AND f.fini = FALSE")->fetchAll()[0][0];
            
            /* Update BDD */
            $pdo->query("DELETE FROM PRODUIT_FACTURATION pf WHERE pf.idFacturation = ".$basketId);
            foreach($_SESSION['basket'] as $prod){
                $bddProduct= $pdo->query("SELECT pf.idProduit,pf.nombreProduit FROM PRODUIT_FACTURATION pf WHERE pf.idFacturation = ".$basketId."  AND pf.idProduit = ".$prod[0])->fetchAll();
                if(empty($bddProduct)){
                    $pdo->query("INSERT INTO PRODUIT_FACTURATION(idProduit,idFacturation,nombreProduit) VALUES (".$prod[0].",".$basketId.",".$prod[1].")");
                }
                else{
                    $pdo->query("UPDATE PRODUIT_FACTURATION SET nombreProduit=".$prod[1]."  WHERE pf.idFacturation = ".$basketId." AND pf.idProduit = ".$prod[0]);
                }
            }
        }

    }

    function addArticle($idArticle){
        if (isset($_GET["dev"])){
            $nbArticle = 5;
            return ["idArticle" => $idArticle, "nbArticle" => $nbArticle];
        }
        else{
            $idArticleBDD = intval(str_replace("tome-","",$idArticle));
            if(!isset($_SESSION['basket'][$idArticleBDD])){
                $_SESSION['basket'][$idArticleBDD] = array($idArticleBDD,0);
            }
            $_SESSION['basket'][$idArticleBDD][1] = $_SESSION['basket'][$idArticleBDD][1] + 1;
            return ["idArticle" => $idArticle, "nbArticle" => $_SESSION['basket'][$idArticleBDD][1]];
        }

        

        return ["idArticle" => -1, "nbArticle" => -1];
    }

    function removeArticle($idArticle){
        if (isset($_GET["dev"])){
            $nbArticle = 4;
            return ["idArticle" => $idArticle, "nbArticle" => $nbArticle];
        }
        else{
            $idArticleBDD = str_replace("tome-","",$idArticle);
            if(isset($_SESSION['basket'][$idArticleBDD])){
                $_SESSION['basket'][$idArticleBDD][1] = $_SESSION['basket'][$idArticleBDD][1] - 1;
                if($_SESSION['basket'][$idArticleBDD][1] == 0){
                    $_SESSION['basket'][$idArticleBDD][1] = null;
                }
            }
            return ["idArticle" => $idArticle, "nbArticle" => $_SESSION['basket'][$idArticleBDD][1]];
        } 

        return ["idArticle" => -1, "nbArticle" => -1];
    }