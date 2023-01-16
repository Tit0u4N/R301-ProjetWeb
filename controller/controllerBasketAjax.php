<?php
    $_GET['dev'] = true;

//todo session controller pour verifier si user connecté

//Type : addArticle = 0
//     : removeArticle = 1
// return ["idArticle" => -1, "nbArticle" => -1] si erreur


    if(isset($_POST['basketActuIdProduit']) && isset($_POST['basketActuType'])){
        $validation = false;


        if($_POST['basketActuType'] == 0 ){
            echo json_encode(addArticle($_POST['basketActuIdProduit']));

        } else if($_POST['basketActuType'] == 1 ) {
            echo json_encode(removeArticle($_POST['basketActuIdProduit']));
        }

        //todo faire le traitement dans la BDD (mettre a true ou false tu connais)


    }

    function addArticle($idArticle){
        if (isset($_GET["dev"])){
            $nbArticle = 5;
            return ["idArticle" => $idArticle, "nbArticle" => $nbArticle];
        }


        //todo faire le traitement dans la BDD (mettre a true ou false tu connais)


        return ["idArticle" => -1, "nbArticle" => -1];
    }

    function removeArticle($idArticle){
        if (isset($_GET["dev"])){
            $nbArticle = 4;
            return ["idArticle" => $idArticle, "nbArticle" => $nbArticle];
        }

        //todo faire le traitement dans la BDD (mettre a true ou false tu connais)

        return ["idArticle" => -1, "nbArticle" => -1];
    }